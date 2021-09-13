<?php

class Connection
{
    private static $instance;

    public static function getInstance(): \PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        return new \PDO("mysql:host=mysql;dbname=analiza_i_projektowanie", 'mysql', 'dr3wGpoLbmuiJ2IyMhZH');
    }
}

class AddressValidator
{
    public const EMPTY_LIST = [0, 2, 3, 7, 8, 9, 10, 12, 13, 14, 20, 25, 26, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37];

    public function validate(array $values)
    {
        return (count($values) - count(self::EMPTY_LIST) !== 15);
    }
}

class Address
{
    /** @var string */
    private $textContent;

    public function __construct(array $element)
    {
        $this->textContent = $element;
        $this->parse();
    }

    private function parse(): void
    {
        $addressVO = new AddressValueObject(
            new DateTimeImmutable(trim($this->textContent['prg-ad:cyklZycia'])),
            $this->textContent['prg-ad:jednostkaAdmnistracyjna1'],
            $this->textContent['prg-ad:jednostkaAdmnistracyjna2'],
            $this->textContent['prg-ad:jednostkaAdmnistracyjna3'],
            $this->textContent['prg-ad:jednostkaAdmnistracyjna4'],
            $this->textContent['prg-ad:miejscowosc'],
            $this->textContent['prg-ad:ulica'],
            $this->textContent['prg-ad:numerPorzadkowy'],
            $this->textContent['prg-ad:kodPocztowy'],
            sha1(trim($this->textContent['prg-ad:cyklZycia']) . trim($this->textContent['prg-ad:miejscowosc']) . trim($this->textContent['prg-ad:ulica']) . trim($this->textContent['prg-ad:numerPorzadkowy']))
        );

        $addressHandler = new AddressHandler($addressVO);
    }
}

class AddressProperty
{
    private static $list;

    public static function getExistingRecords(): array
    {
        if (self::$list === null) {
            $conn = Connection::getInstance();

            $sql = 'SELECT * FROM helper_address';
            $sth = $conn->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

            $hashes = [];
            foreach ($rows as $row) {
                $hashes[$row['hash']] = 1;
            }

            self::$list = $hashes;
        }

        return self::$list;
    }
}

class AddressHandler
{
    public function __construct(AddressValueObject $addressValueObject)
    {
//        try {
//            $this->createTable($addressValueObject);
//        } catch (Throwable $e) {
//            // do nothing
//        }

        //if ($this->notExists($addressValueObject)) {
            $this->saveAddress($addressValueObject);
        //}
    }

    private function notExists(AddressValueObject $addressValueObject): bool
    {
        return !array_key_exists($addressValueObject->getHash(), AddressProperty::getExistingRecords());
    }

    private function saveAddress(AddressValueObject $addressValueObject): void
    {
        //$conn = Connection::getInstance();
        $conn = new class() { public function quote(string $string) { return sprintf("'%s'", addslashes($string)); } };

        $sql = "INSERT INTO `total_address` SET  create_date = :createDate, country = :country, district = :district, community = :community, city = :city, street = :street, number = :number, postal_code = :postal_code, hash = :hash";
        $createDate = $addressValueObject->getCreatedDate()->format('Y-m-d H:i:s');
        $country = $addressValueObject->getCountry();
        $district = $addressValueObject->getDistrict();
        $community = $addressValueObject->getCommunity();
        $city = $addressValueObject->getCity();
        $street = $addressValueObject->getStreet();
        $number = $addressValueObject->getnumber();
        $postalCode = $addressValueObject->getPostalCode();
        $hash = $addressValueObject->getHash();

//        $statement = $conn->prepare($sql);
//        $statement->bindParam(':createDate', $createDate);
//        $statement->bindParam(':country', $country);
//        $statement->bindParam(':district', $district);
//        $statement->bindParam(':community', $community);
//        $statement->bindParam(':city', $city);
//        $statement->bindParam(':street', $street);
//        $statement->bindParam(':number', $number);
//        $statement->bindParam(':postal_code', $postalCode);
//        $statement->bindParam(':hash', $hash);

        $sql = str_replace(':createDate', $conn->quote($createDate), $sql);
        $sql = str_replace(':country', $conn->quote($country), $sql);
        $sql = str_replace(':district', $conn->quote($district), $sql);
        $sql = str_replace(':community', $conn->quote($community), $sql);
        $sql = str_replace(':city', $conn->quote($city), $sql);
        $sql = str_replace(':street', $conn->quote($street), $sql);
        $sql = str_replace(':number', $conn->quote($number), $sql);
        $sql = str_replace(':postal_code', $conn->quote($postalCode), $sql);
        $sql = str_replace(':hash', $conn->quote($hash), $sql);

        $handler = fopen('queries.txt', 'a');
        fwrite($handler, $sql."\n");
        fclose($handler);


        //$result = $statement->execute();
    }

    private function createTable(AddressValueObject $addressValueObject): void
    {
        $conn = Connection::getInstance();

        $sql = "CREATE TABLE helper_address (
  id int NOT NULL AUTO_INCREMENT,
  create_date DATETIME NULL DEFAULT NULL,
  country VARCHAR(255) NULL,
  district VARCHAR(255) NULL,
  community VARCHAR(255) NULL,
  city VARCHAR(255) NULL,
  street VARCHAR(255) NULL,
  number VARCHAR(255) NULL,
  postal_code VARCHAR(255) NULL,
  hash VARCHAR(255) NULL UNIQUE,
  PRIMARY KEY (id)";

        $sql .= ', change_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)';

        $statement = $conn->prepare($sql);
        $result = $statement->execute();

        if ($result === false) {
            throw new Exception('table not saved.');
        }
    }
}

class AddressValueObject
{
    /** @var DateTimeImmutable|null */
    private $createdDate;
    /** @var string */
    private $country;
    /** @var string */
    private $voivodeship;
    /** @var string */
    private $district;
    /** @var string */
    private $community;
    /** @var string */
    private $city;
    /** @var string */
    private $street;
    /** @var string */
    private $number;
    /** @var string */
    private $postalCode;
    /** @var string */
    private $hash;

    public function __construct(
        ?DateTimeImmutable $createdDate,
        string $country,
        string $voivodeship,
        string $district,
        string $community,
        string $city,
        string $street,
        string $number,
        string $postalCode,
        string $hash
    )
    {
        $this->createdDate = $createdDate;
        $this->country = $country;
        $this->voivodeship = $voivodeship;
        $this->district = $district;
        $this->community = $community;
        $this->city = $city;
        $this->street = $street;
        $this->number = $number;
        $this->postalCode = $postalCode;
        $this->hash = $hash;
    }

    public function getCreatedDate(): ?DateTimeImmutable
    {
        return $this->createdDate;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getVoivodeship(): ?string
    {
        return $this->voivodeship;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getCommunity(): ?string
    {
        return $this->community;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }
}

$xmlFile = '../../../../resources/address_list_slask.xml';
$primEL  = 'PRG_PunktAdresowy';
// open the XML file
$reader = new XMLReader();
$reader->open($xmlFile);

// prepare a DOM document
$document = new DOMDocument();
$xpath = new DOMXpath($document);

// find the first `book` element node at any depth
while ($reader->read() && $reader->localName !== $primEL) {
    continue;
}

// as long as here is a node with the name "book"
while ($reader->localName === $primEL) {
    // expand the node into the prepared DOM
    $book = $reader->expand($document);

    $data = [];
    $i = 1;
    foreach ($book->childNodes as $node) {
        $key = $node->nodeName;
        if ($node->nodeName === 'prg-ad:jednostkaAdmnistracyjna') {
            $key .= $i;
            $i += 1;
        }

        $data[$key] = $node->nodeValue;
    }
    $address = new Address($data);
    unset($address);
    unset($data);

    // use Xpath expressions to fetch values
//    var_dump(
//        $xpath->evaluate('string(title/@isbn)', $book),
//        $xpath->evaluate('string(title)', $book)
//    );
    // move to the next book sibling node
    $reader->next($primEL);
}
$reader->close();

$conn = Connection::getInstance();

$file = fopen('queries.txt', 'r');
while(! feof($file))
{
    $sql = fgets($file);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}















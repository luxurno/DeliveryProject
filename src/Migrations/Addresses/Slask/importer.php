<?php

class Connection
{
    private static $instance;

    public static function getInstance(): PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        return new PDO("mysql:host=mysql;dbname=analiza_i_projektowanie", 'mysql', 'dr3wGpoLbmuiJ2IyMhZH');
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

        $sql = "INSERT INTO `total_address` SET  create_date = :createDate, kraj = :kraj, powiat = :powiat, gmina = :gmina, miasto = :miasto, ulica = :ulica, numer = :numer, kod_pocztowy = :kod_pocztowy, hash = :hash";
        $createDate = $addressValueObject->getCreatedDate()->format('Y-m-d H:i:s');
        $kraj = $addressValueObject->getKraj();
        $powiat = $addressValueObject->getPowiat();
        $gmina = $addressValueObject->getGmina();
        $miasto = $addressValueObject->getMiasto();
        $ulica = $addressValueObject->getUlica();
        $numer = $addressValueObject->getNumer();
        $kodPocztowy = $addressValueObject->getKodPocztowy();
        $hash = $addressValueObject->getHash();

//        $statement = $conn->prepare($sql);
//        $statement->bindParam(':createDate', $createDate);
//        $statement->bindParam(':kraj', $kraj);
//        $statement->bindParam(':powiat', $powiat);
//        $statement->bindParam(':gmina', $gmina);
//        $statement->bindParam(':miasto', $miasto);
//        $statement->bindParam(':ulica', $ulica);
//        $statement->bindParam(':numer', $numer);
//        $statement->bindParam(':kod_pocztowy', $kodPocztowy);
//        $statement->bindParam(':hash', $hash);

        $sql = str_replace(':createDate', $conn->quote($createDate), $sql);
        $sql = str_replace(':kraj', $conn->quote($kraj), $sql);
        $sql = str_replace(':powiat', $conn->quote($powiat), $sql);
        $sql = str_replace(':gmina', $conn->quote($gmina), $sql);
        $sql = str_replace(':miasto', $conn->quote($miasto), $sql);
        $sql = str_replace(':ulica', $conn->quote($ulica), $sql);
        $sql = str_replace(':numer', $conn->quote($numer), $sql);
        $sql = str_replace(':kod_pocztowy', $conn->quote($kodPocztowy), $sql);
        $sql = str_replace(':hash', $conn->quote($hash), $sql);

        $handler = fopen('queries.txt', 'a');
        fwrite($handler, $sql."\n");
        fclose($handler);


        //$result = $statement->execute();
    }

    private function createTable(AddressValueObject $addressValueObject): void
    {
        //$conn = Connection::getInstance();

        $sql = "CREATE TABLE helper_address (
  id int NOT NULL AUTO_INCREMENT,
  create_date DATETIME NULL DEFAULT NULL,
  kraj VARCHAR(255) NULL,
  powiat VARCHAR(255) NULL,
  gmina VARCHAR(255) NULL,
  miasto VARCHAR(255) NULL,
  ulica VARCHAR(255) NULL,
  numer VARCHAR(255) NULL,
  kod_pocztowy VARCHAR(255) NULL,
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
    private $kraj;
    /** @var string */
    private $wojewodztwo;
    /** @var string */
    private $powiat;
    /** @var string */
    private $gmina;
    /** @var string */
    private $miasto;
    /** @var string */
    private $ulica;
    /** @var string */
    private $numer;
    /** @var string */
    private $kodPocztowy;
    /** @var string */
    private $hash;

    public function __construct(
        ?DateTimeImmutable $createdDate,
        string $kraj,
        string $wojewodztwo,
        string $powiat,
        string $gmina,
        string $miasto,
        string $ulica,
        string $numer,
        string $kodPocztowy,
        string $hash
    )
    {
        $this->createdDate = $createdDate;
        $this->kraj = $kraj;
        $this->wojewodztwo = $wojewodztwo;
        $this->powiat = $powiat;
        $this->gmina = $gmina;
        $this->miasto = $miasto;
        $this->ulica = $ulica;
        $this->numer = $numer;
        $this->kodPocztowy = $kodPocztowy;
        $this->hash = $hash;
    }

    public function getCreatedDate(): ?DateTimeImmutable
    {
        return $this->createdDate;
    }

    public function getKraj(): ?string
    {
        return $this->kraj;
    }

    public function getWojewodztwo(): ?string
    {
        return $this->wojewodztwo;
    }

    public function getPowiat(): ?string
    {
        return $this->powiat;
    }

    public function getGmina(): ?string
    {
        return $this->gmina;
    }

    public function getMiasto(): ?string
    {
        return $this->miasto;
    }

    public function getUlica(): ?string
    {
        return $this->ulica;
    }

    public function getNumer(): ?string
    {
        return $this->numer;
    }

    public function getKodPocztowy(): ?string
    {
        return $this->kodPocztowy;
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















<?php

declare(strict_types = 1);

namespace App\Bundle\ImporterGenerator\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Bundle\ImporterGenerator\Repository\TotalAddressRepository")
 */
class TotalAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createDate;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kraj;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voivodeship;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $powiat;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gmina;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $miasto;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ulica;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numer;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kodPocztowy;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;
    /**
     * @ORM\Column(type="datetime")
     */
    private $changeDate;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getVoivodeship(): string
    {
        return $this->voivodeship;
    }

    public function setVoivodeship(string $voivodeship): void
    {
        $this->voivodeship = $voivodeship;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate): void
    {
        $this->createDate = $createDate;
    }

    public function getKraj()
    {
        return $this->kraj;
    }

    public function setKraj($kraj): void
    {
        $this->kraj = $kraj;
    }

    public function getPowiat()
    {
        return $this->powiat;
    }

    public function setPowiat($powiat): void
    {
        $this->powiat = $powiat;
    }

    public function getGmina()
    {
        return $this->gmina;
    }

    public function setGmina($gmina): void
    {
        $this->gmina = $gmina;
    }

    public function getMiasto()
    {
        return $this->miasto;
    }

    public function setMiasto($miasto): void
    {
        $this->miasto = $miasto;
    }

    public function getUlica()
    {
        return $this->ulica;
    }

    public function setUlica($ulica): void
    {
        $this->ulica = $ulica;
    }

    public function getNumer()
    {
        return $this->numer;
    }

    public function setNumer($numer): void
    {
        $this->numer = $numer;
    }

    public function getKodPocztowy()
    {
        return $this->kodPocztowy;
    }

    public function setKodPocztowy($kodPocztowy): void
    {
        $this->kodPocztowy = $kodPocztowy;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash): void
    {
        $this->hash = $hash;
    }

    public function getChangeDate()
    {
        return $this->changeDate;
    }

    public function setChangeDate($changeDate): void
    {
        $this->changeDate = $changeDate;
    }
}
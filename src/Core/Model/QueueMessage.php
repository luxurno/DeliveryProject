<?php

declare(strict_types = 1);

namespace App\Core\Model;

interface QueueMessage
{
    public function getCountry(): string;
    public function getVoivodeship(): string;
    public function getDistrict(): string;
    public function getCommunity(): string;
    public function getCity(): string;
    public function getStreet(): string;
    public function getNumber(): string;
    public function getPostalCode(): string;
    public function getFormatted(): string;
}

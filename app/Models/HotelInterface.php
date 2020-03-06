<?php
declare(strict_types=1);

namespace App\Models;


interface HotelInterface
{

    public function getName(): string;

    public function getRate(): int;

    public function getPrice(): int;

    public function getAmenities(): array;
}

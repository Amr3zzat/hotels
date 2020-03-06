<?php

declare(strict_types=1);

namespace App\Models;


class HotelsProviderBAdapter implements HotelInterface
{
    private $hotel;


    public function __construct($hotel)
    {
        $this->hotel = $hotel;
    }

    public function getName(): string
    {
        return $this->hotel['hotelName'];
    }

    public function getRate(): int
    {
        return strlen($this->hotel['Rate']);


    }

    public function getPrice(): int
    {
        $discount = $this->hotel['discount'] ?? 0;
        return (int)$this->hotel['Price'] - $discount;

    }

    public function getAmenities(): array
    {
        return $this->hotel['amenities'];

    }

}

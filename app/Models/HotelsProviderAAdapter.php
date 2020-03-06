<?php

declare(strict_types=1);

namespace App\Models;


class HotelsProviderAAdapter implements HotelInterface
{
    private $hotel;


    public function __construct($hotel)
    {
        $this->hotel = $hotel;
    }

    public function getName(): string
    {
        return $this->hotel['Hotel'];
    }

    public function getRate(): int
    {
        return $this->hotel['Rate'];


    }

    public function getPrice(): int
    {
        return $this->hotel['Fare'];

    }

    public function getAmenities(): array
    {
        return explode(',', $this->hotel['roomAmenities']);

    }

}

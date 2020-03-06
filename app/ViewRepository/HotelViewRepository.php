<?php
declare(strict_types=1);

namespace App\ViewRepository;


use App\Models\HotelInterface;
use App\Views\HotelView;

class HotelViewRepository
{

    public function create(HotelInterface $hotel): HotelView
    {
        $hotelView = new HotelView();
        $hotelView->name = $hotel->getName();
        $hotelView->price = $hotel->getPrice();
        $hotelView->rate = $hotel->getRate();
        $hotelView->amenities = $hotel->getAmenities();
        return $hotelView;
    }
}

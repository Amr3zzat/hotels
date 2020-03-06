<?php
declare(strict_types=1);

namespace App\Views;


class HotelView
{
    /**
     * @var string
     */
    public $name;

    /** @var int */
    public $rate;

    /** @var int */
    public $price;

    /** @var array */
    public $amenities = [];
}

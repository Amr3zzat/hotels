<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\HotelInterface;
use App\Models\HotelsProviderAAdapter;
use App\ViewRepository\HotelViewRepository;
use Illuminate\Support\Facades\Http;

class HotelsProviderA implements HotelsProviderInterface
{
    private $hotelViewRepository;

    /**
     * HotelsProviderA constructor.
     * @param $hotelViewRepository
     */
    public function __construct(HotelViewRepository $hotelViewRepository)
    {
        $this->hotelViewRepository = $hotelViewRepository;
    }

    public function search($filters)
    {
        $hotels = $this->fetch($filters);
        if (null === $hotels)
        {
            return $hotels;
        }
        $hotelsList = [];
        foreach ($hotels as $hotel) {
            /** @var HotelInterface $adapted */
            $adapted = new HotelsProviderAAdapter($hotel);
            $hotelsList[] = $this->hotelViewRepository->create($adapted);
        }
        return $hotelsList;
    }

    private function fetch($filters)
    {
        $query = ['dateFrom' => $filters['dateFrom'],
            'dateTo' => $filters['dateTo'],
            'city' => $filters['city'],
            'adults' => $filters['adults']
        ];
        $response = Http::get('http://www.mocky.io/v2/5e400f423300005500b04d0c', $query);
        if (null === $response->body()) {
            return;
        }
        return json_decode($response->body(), true);
    }
}

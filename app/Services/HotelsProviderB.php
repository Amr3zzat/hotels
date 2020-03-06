<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\HotelInterface;
use App\Models\HotelsProviderBAdapter;
use App\ViewRepository\HotelViewRepository;
use Illuminate\Support\Facades\Http;

class HotelsProviderB implements HotelsProviderInterface
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
        if (null === $hotels) {
            return;
        }
        $hotelsList = [];
        foreach ($hotels as $hotel) {
            /** @var HotelInterface $adapted */
            $adapted = new HotelsProviderBAdapter($hotel);
            $hotelsList[] = $this->hotelViewRepository->create($adapted);
        }

        return $hotelsList;
    }

    private function fetch($filters)
    {
        $query = ['dateFrom' => $filters['from_date:'],
            'dateTo' => $filters['to_date:'],
            'city' => $filters['city_code'],
            'adults' => $filters['no_adults']
        ];
        $response = Http::get('http://www.mocky.io/v2/5e4010ad3300004200b04d15', $query);
        if (null === $response->body()) {
            return;
        }
        return json_decode($response->body(), true);
    }

}

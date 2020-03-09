<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelsController extends Controller
{

    private $hotelsProviders;


    public function __construct(array $hotelsProviders)
    {
        $this->hotelsProviders = $hotelsProviders;
    }

    public function list(Request $request): JsonResponse
    {
        $hotels = [];
        foreach ($this->hotelsProviders as $hotelProvider) {

            $hotels = array_merge($hotels, $hotelProvider->search($request));
        }
        $this->sortByRate($hotels);

        return response()->json($hotels, 200);
    }

    private function sortByRate(&$hotels): void
    {
        $rate = array_column($hotels, 'rate');

        array_multisort($rate, SORT_DESC, $hotels);

    }
}

<?php

namespace Tests\Feature;


use Tests\TestCase;

class HotelsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSearchHotelsSuccessfully()
    {
        $query = ['dateFrom' => '15/06/2020',
            'dateTo' => '19/06/2020',
            'adults' => 12,
            'city' => 'CA'
        ];
        $query = http_build_query($query);
        $response = $this->get('/api/hotels?' . $query);

        $response->assertStatus(200)
            ->assertJsonStructure([[
                'name',
                'rate',
                'price',
                'amenities'
            ]]);

    }
}

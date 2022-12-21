<?php

namespace App\Domains\CoordinateResolver\Providers;

use App\Domains\CoordinateResolver\Interfaces\CoordinateResolverInterface;
use GuzzleHttp\Client;

class StrategyHereMaps implements CoordinateResolverInterface {

    protected $city, $street, $postal_code, $country_code;

    public function __construct($city, $street, $postal_code, $country_code)
    {
        $this->city = $city;
        $this->street = $street;
        $this->postal_code = $postal_code;
        $this->country_code = $country_code;
    }
    
    public function getCoordinates()
    {
        $location = $this->hmapsAction();

        if (count($location['items']) === 0) {
            return [];
        }

        $firstItem = $location['items'][0];

        if ($firstItem['resultType'] !== 'houseNumber') {
            return [];
        }

        return $firstItem['position'];
    }

    public function hmapsAction()
    {
        
        $params = [
            'query' => [
                'qq'     => implode(';', ["country={$this->country_code}", "city={$this->city}", "street={$this->street}", "postalCode={$this->postal_code}"]),
                'apiKey' => config('coordinates.google_maps.api_key'),
            ],
        ];

        $client = new Client();

        $response = $client->get(config('coordinates.google_maps.api_url'), $params);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
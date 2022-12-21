<?php

namespace App\Domains\CoordinateResolver\Providers;

use App\Domains\CoordinateResolver\Interfaces\CoordinateResolverInterface;
use GuzzleHttp\Client;

class StrategyGoogleMaps implements CoordinateResolverInterface {

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
        $location = $this->gmapsAction();

        if (count($location['results']) === 0) {
            return [];
        }

        $firstResult = $location['results'][0];

        if ($firstResult['geometry']['location_type'] !== 'ROOFTOP') {
            return [];
        }

        return $firstResult['geometry']['location'];
    }

    public function gmapsAction()
    {

        $params = [
            'query' => [
                'address'    => $this->street,
                'components' => implode('|', ["country:{$this->country_code}", "locality:{$this->city}", "postal_code:{$this->postal_code}"]),
                'key'        => config('coordinates.here_maps.api_key'),
            ],
        ];
        $client = new Client();

        $response = $client->get(config('coordinates.google_maps.api_url'), $params);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

    }
}
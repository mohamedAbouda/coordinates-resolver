<?php

namespace App\Repositories;

use App\Models\Coordinate;

class CoordinatesRepository
{
    public function getLocation($country, $city, $postal_code, $street)
    {
        return Coordinate::where([
            'country_code'       => $country,
            'city'               => $city,
            'postal_code'        => $postal_code,
            'street'             => $street,
        ])->select(['lat', 'long'])->first();
    }

    public function saveLocation($data)
    {
        return Coordinate::firstOrCreate([
            'country_code'       => $data['country'],
            'city'               => $data['city'],
            'postal_code'        => $data['postal_code'],
            'street'             => $data['street'],
        ], [
            'lat' => $data['lat'],
            'long' => $data['long'],
            'provider' => $data['provider']
        ]);
    }
}

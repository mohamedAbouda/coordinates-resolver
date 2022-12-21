<?php

namespace App\Domains\CoordinateResolver\Providers;

use App\Domains\CoordinateResolver\Interfaces\CoordinateResolverInterface;
use App\Repositories\CoordinatesRepository;

class StrategyDataBase implements CoordinateResolverInterface {

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
        $location = $this->databaseAction();
        
        if(!$location){
            return [];
        }
        
        return [
            'lat'  => $location->lat,
            'long' => $location->long,
        ];
    }

    public function databaseAction()
    {
        return (new CoordinatesRepository)->getLocation($this->country_code, $this->city, $this->postal_code, $this->street);
    }
}
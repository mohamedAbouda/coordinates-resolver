<?php

namespace App\Domains\CoordinateResolver;

use App\Domains\CoordinateResolver\Providers\StrategyDataBase;
use App\Domains\CoordinateResolver\Providers\StrategyGoogleMaps;
use App\Domains\CoordinateResolver\Providers\StrategyHereMaps;

class CoordinateResolverStrategy
{

    private $strategy;

    public function __construct($strategy, $data)
    {
        switch ($strategy) {
            case "google_maps":
                $this->strategy = new StrategyGoogleMaps($data['city'], $data['street'], $data['postal_code'], $data['country_code']);
                break;
            case "here_maps":
                $this->strategy = new StrategyHereMaps($data['city'], $data['street'], $data['postal_code'], $data['country_code']);
                break;
            case "database":
                $this->strategy = new StrategyDataBase($data['city'], $data['street'], $data['postal_code'], $data['country_code']);
                break;
        }
    }

    public function getCoordinates()
    {
        return $this->strategy->getCoordinates();
    }
}

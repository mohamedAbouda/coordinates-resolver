<?php

namespace App\Services;

use App\Domains\CoordinateResolver\CoordinateResolverStrategy;
use App\Repositories\CoordinatesRepository;

class CoordinatesService
{

    protected $coordinatesRepository;

    private const PROVIDERS = [
        'google_maps',
        'here_maps',
        'database'
    ];

    public function __construct($coordinatesRepository)
    {
        $this->coordinatesRepository = $coordinatesRepository;
    }

    public function fetchCoordinates($request)
    {
        $data = $request->all();
        $providers = $request->search ?? self::PROVIDERS;

        foreach ($providers as $provider) {
            $location = (new CoordinateResolverStrategy($provider, $data))->getCoordinates();

            if (!empty($location['lat']) && !empty($location['long'])) {

                $data['lat'] = $location['lat'];
                $data['long'] = $location['long'];
                $data['provider'] = $location['provider'];

                (new CoordinatesRepository)->saveLocation($data);
                
                return [
                    'status' => true,
                    'message' => 'data found',
                    'data' => [
                        'lat'      => $location['lat'],
                        'long'     => $location['long'],
                        'provider' => $provider
                    ]
                ];
                break;
            }
        }

        return [
            'status' => false,
            'message'  => 'data not found',
            'data' => []
        ];
    }
}

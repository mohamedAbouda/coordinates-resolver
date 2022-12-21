<?php

namespace App\Http\Controllers;

use App\Http\Requests\FetchCoordinatesRequest;
use App\Repositories\CoordinatesRepository;
use App\Services\CoordinatesService;

class CoordinatesResolverController extends Controller
{

    protected $coordinatesSerivce;

    public function __construct()
    {
        $this->coordinatesSerivce = new CoordinatesService(new CoordinatesRepository());
    }

    public function getCoordinates()
    {
        return view('coordinates');
    }

    public function fetchCoordinates(FetchCoordinatesRequest $request)
    {
        return $this->coordinatesSerivce->fetchCoordinates($request);
    }
}

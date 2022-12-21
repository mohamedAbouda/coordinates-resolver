<?php

return [
    'google_maps' => [
        'api_url' => env('GOOGLE_MAPS_API_URL', 'https://maps.googleapis.com/maps/api/geocode/json'),
        'api_key' => env('GOOGLE_MAPS_API_KEY', 'AIzaSyA2xxrdBgfdXviXhq-xj32MJ3vEv9PrWAg')
    ],
    'here_maps' => [
        'api_url' => env('HERE_MAPS_API_URL', 'https://geocode.search.hereapi.com/v1/geocode'),
        'api_key' => env('HERE_MAPS_API_KEY', 'ElC_PzZquF22HgW8mAXX2B5nyaEnlVOvAXYe311oilI')
    ]
];
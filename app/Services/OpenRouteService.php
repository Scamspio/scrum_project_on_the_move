<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class OpenRouteService
{
    protected $baseUrl = 'https://api.openrouteservice.org';
    protected $origin = [5.640616, 52.654189];

    /**
     * The master method: Takes addresses, returns a single GeoJSON route.
     */
    public function getRouteFromAddresses(array $addresses)
    {
        // 1. Geocode all addresses concurrently
        $responses = Http::pool(fn (Pool $pool) => 
            collect($addresses)->map(fn ($address) => 
                $pool->as($address)->withHeaders([
                    'Authorization' => config('services.ors.key')
                ])->get("{$this->baseUrl}/geocode/search", [
                    'text' => $address,
                    'boundary.country' => 'NL',
                    'size' => 1
                ])
            )
        );

        // 2. Extract coordinates [lon, lat]
        $coordinates = [];
        foreach ($addresses as $address) {
            $data = $responses[$address]->json();
            
            if (empty($data['features'])) {
                throw new \Exception("Could not find coordinates for: {$address}");
            }
            
            // Geocode returns [lat, lon] in features[0]['geometry']['coordinates']
            // This is reversed because the directions API expects [lon, lat]
            $coordinates[] = $data['features'][0]['geometry']['coordinates'];
        }

        // dd($coordinates);

        // 3. Generate the route using the collected coordinates
        return $coordinates;
    }

    public function getDirections(array $addresses)
    {
        $coordinates = $this->getRouteFromAddresses($addresses);
        $coordinates[] = $this->origin;

        // dd($coordinates);
        
        $response = Http::withHeaders([
            'Authorization' => config('services.ors.key'),
        ])
        ->post("{$this->baseUrl}/v2/directions/driving-hgv/geojson", [
            'coordinates' => $coordinates,
            'maximum_speed' => 80,
            'options' => ['avoid_borders' => 'all']
        ]);

        // dd($response->json());
        return response()->json($response->json());
    }
}
<?php

namespace App\Services;

use GuzzleHttp\Client;

class RajaOngkirService
{
    private $baseUri = 'https://api.rajaongkir.com/starter/';
    private $client;

    /**
     * RajaOngkirService Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        $headers = [
            'key' => config('app.raja_ongkir_key'),
        ];
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'headers'  => $headers
        ]);
    }

    /**
     * Get Province Data Source from Raja Ongkir then insert to provinces table
     * 
     * @param int|null $id
     * @return array
     */
    public function getProvincesData(?int $id): array
    {
        $params = [
            'query' => [
                'id' => $id ?? ''
            ]
        ];
        $request = $this->client->get('province', $params);
        $result = $request->getBody();
        $data = json_decode($result, 1);
        return $data['rajaongkir'];
    }

    /**
     * Get Cities Data Source from Raja Ongkir then insert to cities table
     * 
     * @param int|null $id
     * @return void
     */
    public function getCitiesData(?int $id): array
    {
        $params = [
            'query' => [
                'id' => $id ?? ''
            ]
        ];
        $request = $this->client->get('city', $params);
        $result = $request->getBody();
        $data = json_decode($result, 1);
        return $data['rajaongkir'];
    }
}
<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Province;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GetRajaOngkirDataSource extends Command
{
    private $baseUri = 'https://api.rajaongkir.com/starter/';
    private $client;

    /**
     * GetRajaOngkirDataSource Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $headers = [
            'key' => config('app.raja_ongkir_key'),
        ];
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'headers'  => $headers
        ]);
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:data-source {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Raja Ongkir data source such as Provinces and Cities ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running command......');
        $this->info('===========================================');
        $type = $this->argument('type');
        if (empty($type)) {
            $this->insertBotSourceData();
        } else if ($type == 'provinces') {
            $this->getProvincesData();
        } else if ($type == 'cities') {
            $this->getCitiesData();
        }
        $this->info('===========================================');
        $this->info('Command finished already......');
    }

    /**
     * Insert Both source data if argument is not writed
     * 
     * @return void
     */
    private function insertBotSourceData(): void
    {
        $this->getProvincesData();
        $this->getCitiesData();
    }

    /**
     * Get Province Data Source from Raja Ongkir then insert to provinces table
     * 
     * @return void
     */
    private function getProvincesData(): void
    {
        $request = $this->client->get('province');
        $result = $request->getBody();
        $data = json_decode($result, 1);
        $json = $data['rajaongkir'];
        if ($json['status']['code'] == 200) {
            foreach($json['results'] as $item) {
                Province::updateOrCreate([
                    'id' => $item['province_id']
                ],[
                    'id'   => $item['province_id'],
                    'name' => $item['province'],
                ]);
            }
        }
    }
    
    /**
     * Get Cities Data Source from Raja Ongkir then insert to cities table
     * 
     * @return void
     */
    private function getCitiesData(): void
    {
        $request = $this->client->get('city');
        $result = $request->getBody();
        $data = json_decode($result, 1);
        $json = $data['rajaongkir'];
        if ($json['status']['code'] == 200) {
            foreach($json['results'] as $item) {
                // NEED TO CHECK IF PROVINCE IS EXISTS OR NOT
                // THIS IS TO PREVENT ERROR WHEN INSERTING `province_id` in cities table
                $provinceExists = Province::where('id', $item['province_id'])->exists();
                if ($provinceExists) {
                    City::updateOrCreate([
                        'id' => $item['city_id']
                    ], [
                        'id'          => $item['city_id'],
                        'province_id' => $item['province_id'],
                        'type'        => $item['type'],
                        'name'        => $item['city_name'],
                        'postal_code' => $item['postal_code'],
                    ]);
                }
            }
        }
    }
}

<?php

namespace App\Services;

use App\Models\City;
use App\Models\Province;
use App\Repositories\DataSource\DataSourceInterface;
use Illuminate\Database\Eloquent\Collection;

class LocalDataSourceService
{
    protected $interface;

    /**
     * LocalDataSourceService Constructor
     * 
     * @return void
     */
    public function __construct(DataSourceInterface $interface)
    {
        $this->interface = $interface;
    }

    /**
     * Get province local data sources
     * 
     * @param int|null $id
     * @return Province|Collection
     */
    public function getProvinceSource(?int $id): Province|Collection
    {
        $data = $this->interface->getProvincesData($id ?? null);
        return $data;
    }

    /**
     * Get province local data sources
     * 
     * @param int|null $id
     * @return City|Collection
     */
    public function getCitiesSource(?int $id): City|Collection
    {
        $data = $this->interface->getCitiesData($id ?? null);
        return $data;
    }

}
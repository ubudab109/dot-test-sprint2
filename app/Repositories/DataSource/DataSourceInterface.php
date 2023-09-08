<?php

namespace App\Repositories\DataSource;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Eloquent\Collection;

interface DataSourceInterface
{
    /**
     * Get provinces data from database
     * 
     * @param int|null $id
     */
    public function getProvincesData(?int $id): Province|Collection;

    /**
     * Get cities data from database
     * 
     * @param int|null $id
     */
    public function getCitiesData(?int $id): City|Collection;
}
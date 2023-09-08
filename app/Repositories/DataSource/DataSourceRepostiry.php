<?php

namespace App\Repositories\DataSource;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Eloquent\Collection;

class DataSourceRepostiry implements DataSourceInterface
{
    /**
    * @var ModelName
    */
    protected $provinces, $cities;

    public function __construct(Province $provinces, City $cities)
    {
		$this->provinces = $provinces;
		$this->cities = $cities;
    }

	/**
     * Get provinces data from database
     * 
     * @param int|null $id
	 * @return Province|Collection
     */
	public function getProvincesData(?int $id): Province|Collection
	{
		if(!is_null($id)) {
			return $this->provinces->find($id);
		}
		return $this->provinces->all();
	}

	/**
     * Get cities data from database
     * 
     * @param int|null $id
	 * @return City|Collection
     */
	public function getCitiesData(?int $id): City|Collection
	{
		if(!is_null($id)) {
			return $this->cities->find($id);
		}
		return $this->cities->all();
	}
}
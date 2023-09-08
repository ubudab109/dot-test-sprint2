<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class GetDataSourceTest extends TestCase
{
    /**
     * Test get province datasource.
     * Whether the data source reference is local or external
     */
    public function test_get_province_datasource(): void
    {
        $user = User::create(['email' => 'test@test.com', 'name' => 'test', 'password' => Hash::make('123456')]);
        $token = $user->createToken('token')->plainTextToken;
        $response = $this->get('api/search/provinces', [
            'Authorization' => 'Bearer '. $token
        ]);
        User::find($user->id)->delete();

        if (config('app.data_source') == 'local') {
            $results = [
                'id',
                'name',
                'created_at',
                'updated_at',
            ];
        } else if (config('app.data_source') == 'external') {
            $results = [
                'province_id',
                'province',
            ];
        }
        $response->assertJsonStructure([
            'query' => [],
            'status' => [
                'code',
                'description',
            ],
            'results' => [
                '*' => $results
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test get cities datasource.
     * Whether the data source reference is local or external
     */
    public function test_get_cities_datasource(): void
    {
        $user = User::create(['email' => 'test@test.com', 'name' => 'test', 'password' => Hash::make('123456')]);
        $token = $user->createToken('token')->plainTextToken;
        $response = $this->get('api/search/cities', [
            'Authorization' => 'Bearer '. $token
        ]);
        User::find($user->id)->delete();

        if (config('app.data_source') == 'local') {
            $results = [
                'id',
                'province_id',
                'name',
                'type',
                'postal_code',
                'created_at',
                'updated_at',
            ];
        } else if (config('app.data_source') == 'external') {
            $results = [
                'city_id',
                'province_id',
                'province',
                'type',
                'city_name',
                'postal_code',
            ];
        }
        $response->assertJsonStructure([
            'query' => [],
            'status' => [
                'code',
                'description',
            ],
            'results' => [
                '*' => $results
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test get single provinces datasource
     * Whether the data source reference is local or external
     */
    public function test_get_single_provincy_datasource(): void
    {
        $user = User::create(['email' => 'test@test.com', 'name' => 'test', 'password' => Hash::make('123456')]);
        $provinces = Province::first();
        $token = $user->createToken('token')->plainTextToken;
        $response = $this->get('api/search/provinces?id='. $provinces->id, [
            'Authorization' => 'Bearer '. $token
        ]);
        User::find($user->id)->delete();
        if (config('app.data_source') == 'local') {
            $results = [
                'id',
                'name',
                'created_at',
                'updated_at',
            ];
        } else if (config('app.data_source') == 'external') {
            $results = [
                'province_id',
                'province',
            ];
        }
        $response->assertJsonStructure([
            'query' => [
                'id'
            ],
            'status' => [
                'code',
                'description',
            ],
            'results' => $results
        ]);
    }

    /**
     * Test get single provinces datasource
     * Whether the data source reference is local or external
     */
    public function test_get_single_cities_datasource(): void
    {
        $user = User::create(['email' => 'test@test.com', 'name' => 'test', 'password' => Hash::make('123456')]);
        $token = $user->createToken('token')->plainTextToken;
        $cities = City::first();
        $response = $this->get('api/search/cities?id='. $cities->id, [
            'Authorization' => 'Bearer '. $token
        ]);
        User::find($user->id)->delete();

        if (config('app.data_source') == 'local') {
            $results = [
                'id',
                'province_id',
                'name',
                'type',
                'postal_code',
                'created_at',
                'updated_at',
            ];
        } else if (config('app.data_source') == 'external') {
            $results = [
                'city_id',
                'province_id',
                'province',
                'type',
                'city_name',
                'postal_code',
            ];
        }
        $response->assertJsonStructure([
            'query' => [
                'id'
            ],
            'status' => [
                'code',
                'description',
            ],
            'results' => $results
        ]);
        $response->assertStatus(200);
    }
}

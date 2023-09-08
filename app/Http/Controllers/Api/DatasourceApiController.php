<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Services\LocalDataSourceService;
use App\Services\RajaOngkirService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DatasourceApiController extends Controller
{
    private $localServices, $externalServices, $dataSources;

    /**
     * DatasourceApiController Constructor
     * 
     * @return void
     */
    public function __construct(LocalDataSourceService $localServices, RajaOngkirService $externalServices)
    {
        $this->localServices = $localServices;
        $this->externalServices = $externalServices;
        $this->dataSources = config('app.data_source');
    }

    /**
     * The function retrieves provinces data based on the provided ID or returns all provinces if no ID
     * is provided.
     * 
     * @param Request request The `` parameter is an instance of the `Illuminate\Http\Request`
     * class. It represents an HTTP request made to the server and contains information such as the
     * request method, headers, query parameters, and request body.
     * 
     * @return JsonResponse a JSON response. The response includes the query parameters, status code
     * and message, and the data fetched from the Province model.
     */
    public function provinces(Request $request): JsonResponse
    {
        $id = $request->get('id', null);
        if ($this->dataSources == 'local') {
            $data = $this->localServices->getProvinceSource($id);
            $status = Response::HTTP_OK;
            $message = 'Data Fetched Successfully';
            if (!is_null($id) && empty($data)) {
                $status = Response::HTTP_NOT_FOUND;
                $message = 'Data Not Found';
            }
            return response()->json([
                'query'  => $request->all(),
                'status' => [
                    'code'    => $status,
                    'description' => $message
                ],
                'results' => $data
            ], $status);
        } elseif ($this->dataSources == 'external') {
            $data = $this->externalServices->getProvincesData($id);
            return response()->json($data, $data['status']['code']);
        } else {
            return response()->json([
                'query'  => $request->all(),
                'status' => [
                    'code'    => Response::HTTP_BAD_REQUEST,
                    'description' => 'Data source not applicable',
                ],
            ]);
        }
    }

    /**
     * The function retrieves cities based on an optional ID parameter and returns a JSON response with
     * the query, status code, and data.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains information about the request such as the request
     * method, headers, query parameters, and request body.
     * 
     * @return JsonResponse a JSON response. The response includes the query parameters from the
     * request, the status code, and the data.
     */
    public function cities(Request $request): JsonResponse
    {
        $id = $request->get('id', null);
        if ($this->dataSources == 'local') {
            $data = $this->localServices->getCitiesSource($id);
            $status = Response::HTTP_OK;
            $message = 'Data Fetched Successfully';
            if (!is_null($id) && empty($data)) {
                $status = Response::HTTP_NOT_FOUND;
                $message = 'Data Not Found';
            }
            return response()->json([
                'query'  => $request->all(),
                'status' => [
                    'code'    => $status,
                    'description' => $message
                ],
                'results' => $data
            ], $status);
        } elseif ($this->dataSources == 'external') {
            $data = $this->externalServices->getCitiesData($id);
            return response()->json($data, $data['status']['code']);
        } else {
            return response()->json([
                'query'  => $request->all(),
                'status' => [
                    'code'    => Response::HTTP_BAD_REQUEST,
                    'description' => 'Data source not applicable',
                ],
            ]);
        }
    }
}

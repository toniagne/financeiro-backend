<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServicesResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    protected $service;
    public function __construct(Service $service){
        $this->service  = $service;
    }

    public function index()
    {
        $services = ServicesResource::collection(Service::all());
        return response()->json(['items' => $services, 'totalCount' => $services->count()]);

    }


    public function store(ServiceRequest $request)
    {
        $request->validated();

        $data = $request->all();

        if(!$insert = $this->service->create($data))
            return response()->json(['error' => 'erro ao inserir produto'], 500);

        return response()->json($data);
    }


    public function show(Service $service)
    {
        try {
            $response =  $service->toArray();

        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        try {
            $service->update($request->all());
            $response = [
                'success' => true,
                'item' => $service->toArray(),
                'message' => 'cadastro editado com sucesso'
            ];
        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }
        return response()->json($response);
    }


    public function destroy(Service $service)
    {
        $service->delete();
        $response = [
            'success' => true,
            'message' => 'cadastro deletado com sucesso'
        ];
        return response()->json($response);
    }
}

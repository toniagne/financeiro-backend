<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceTypesRequest;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypesController extends Controller
{

    public function index()
    {
        $types = ServiceType::all();
        return response()->json(['items' => $types, 'totalCount' => $types->count()]);
    }

    public function store(ServiceTypesRequest $request)
    {

        $type = new ServiceType();

        try {
            $request->validated();
            $type->create($request->all());
            $response = [
                'success' => true,
                'item' => $type->toArray(),
                'message' => 'cadastro efetuado com sucesso'
            ];

        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return response()->json($response);
    }


    public function show(ServiceType $serviceType)
    {
        try {
            $response =  $serviceType->toArray();

        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function update(ServiceTypesRequest $request, ServiceType $serviceType)
    {
        try {
            $serviceType->update($request->all());
            $response = [
                'success' => true,
                'item' => $serviceType->toArray(),
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


    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        $response = [
            'success' => true,
            'message' => 'cadastro deletado com sucesso'
        ];
        return response()->json($response);
    }
}

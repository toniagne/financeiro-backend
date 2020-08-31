<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoriesController extends Controller
{

    public function index()
    {
        $categories = ServiceCategory::all();
        return response()->json(['items' => $categories, 'totalCount' => $categories->count()]);
    }

    public function store(CategoryRequest $request)
    {

        $category = new ServiceCategory();

        try {
                $request->validated();
                $category->create($request->all());
                $response = [
                    'success' => true,
                    'item' => $category->toArray(),
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


    public function show(ServiceCategory $serviceCategory)
    {
        try {
            $response =  $serviceCategory->toArray();

        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function update(CategoryRequest $request, ServiceCategory $serviceCategory)
    {
        try {
            $serviceCategory->update($request->all());
            $response = [
                'success' => true,
                'item' => $serviceCategory->toArray(),
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


    public function destroy(ServiceCategory $serviceCategory)
    {
       $serviceCategory->delete();
       $response = [
            'success' => true,
            'message' => 'cadastro deletado com sucesso'
        ];
        return response()->json($response);
    }
}

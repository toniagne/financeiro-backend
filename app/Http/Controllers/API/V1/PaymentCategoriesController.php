<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentCategoryRequest;
use App\Models\PaymentCategory;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class PaymentCategoriesController extends Controller
{

    public function index($type)
    {

        $categories = PaymentCategory::where('type', $type)->get();
        return response()->json(['items' => $categories, 'totalCount' => $categories->count()]);
    }

    public function store(PaymentCategoryRequest $request)
    {

        $category = new PaymentCategory();

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


    public function show(PaymentCategory $category)
    {
        try {
            $response =  $category->toArray();

        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function update(PaymentCategoryRequest $request, PaymentCategory $category)
    {
        try {
            $category->update($request->all());
            $response = [
                'success' => true,
                'item' => $category->toArray(),
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


    public function destroy(PaymentCategory $category)
    {
        $category->delete();
        $response = [
            'success' => true,
            'message' => 'cadastro deletado com sucesso'
        ];
        return response()->json($response);
    }
}

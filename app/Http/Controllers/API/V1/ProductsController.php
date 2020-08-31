<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductMargin;
use App\Services\CurrencyExchange;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        $products = ProductResource::collection(Product::all());
        return response()->json(['items' => $products, 'totalCount' => $products->count()]);
    }

    public function store(ProductRequest $request)
    {
        try{
            $product = Product::create($request->all());

            $product->setDetails($request->get('details'));

            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Produto cadastrado com sucesso'
            ];


        } catch (\Exception $e){

            $response = [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }


    public function show(Product $product)
    {
        $products = new ProductResource($product);
        return response()->json($products);

    }

    public function update(Request $request, Product $product)
    {
        try{
            $product->update($request->all());

            $product->setDetails($request->get('details'));

            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Produto alterado com sucesso'
            ];


        } catch (\Exception $e){

            $response = [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function destroy(Product $product)
    {

       $product->delete();
       return response()->json([
           'success' => true,
           'message' => 'Produto apagado com sucesso'
       ]);
    }

    public function productCategories(){
        return response()->json(ProductCategory::all());
    }

    public function productMargins(){

        $rates = new CurrencyExchange();

        return response()->json([
                ['name' => 'DOLAR', 'id'=>$rates->url('dollar')],
                ['name' => 'EURO', 'id'=>$rates->url('euro')],
            ]);
    }
}

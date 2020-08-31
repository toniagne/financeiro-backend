<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OccupationsRequest;
use App\Models\Occupation;
use Illuminate\Http\Request;
use MongoDB\Driver\Exception\Exception;

class OccupationsController extends Controller
{

    public function index()
    {
       $occupation = Occupation::all();
        return response()->json(['items' => $occupation, 'totalCount' => $occupation->count()]);
    }

    public function search(OccupationsRequest $request)
    {
        $occupation = Occupation::where('name', '%', $request->all());
        return response()->json(['items' => $occupation, 'total_count' => $occupation->count()]);
    }

    public function store(OccupationsRequest $request)
    {

        $request->validated();


        try{
            $occupation = Employee::create($request->all());


            $response = [
                'sucess' => true,
                'data' => $occupation,
                'message' => 'Cadastro efetuado com sucesso '
            ];

        }catch (\Exception $e){
            $response =  [
                'sucess' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }


    public function show($id)
    {
        try{
            $results = Occupation::find($id);

        }catch (\Exception $e){
            $results = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($results);

    }


    public function update(OccupationsRequest $request, Occupation $occupation)
    {

        $request->validated();

        try{
            $occupation->update($request->all());
            $response = [
                'success' => true,
                'item' => $occupation,
                'message' => 'Cadastro alterado com sucesso '
            ];

        }catch (Exception $e){
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }


    public function destroy(Occupation $occupation)
    {
        $occupation->delete();
        return response()->json('success');
    }
}

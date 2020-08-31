<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecurrencesRequest;
use App\Models\Recurrence;

class RecurrencesController extends Controller
{
    public function index()
    {
        $recurrences = Recurrence::all();
        return response()->json(['items' => $recurrences, 'totalCount' => $recurrences->count()]);
    }

    public function store(RecurrencesRequest $request)
    {

        $type = new Recurrence();

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


    public function show(Recurrence $recurrence)
    {
        try {
            $response =  $recurrence->toArray();

        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function update(RecurrencesRequest $request, Recurrence $recurrence)
    {
        try {
            $recurrence->update($request->all());
            $response = [
                'success' => true,
                'item' => $recurrence->toArray(),
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


    public function destroy(Recurrence $recurrence)
    {
        $recurrence->delete();
        $response = [
            'success' => true,
            'message' => 'cadastro deletado com sucesso'
        ];
        return response()->json($response);
    }
}

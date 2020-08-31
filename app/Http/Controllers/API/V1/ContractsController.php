<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractRequest;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    public function index()
    {
        $providers = ContractResource::collection(Contract::all());
        return response()->json(['items' => $providers, 'totalCount' => $providers->count()]);
    }


    public function store(ContractRequest $request)
    {

        try{
            $contract = new Contract();
            $request['date_start'] = $contract->parse_date($request->date_start);
            $request['date_end'] = $contract->parse_date($request->date_end);
            $contract->create($request->all());

            $response = [
                'success' => true,
                'message' => 'Cadastro efetuado com sucesso',
                'data' => $contract,
            ];

        }catch (\Exception $e){
            $response =  [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }


    public function show($id)
    {
        try{
            $results = new ContractResource(Contract::find($id));

        }catch (\Exception $e){
            $results = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($results);

    }


    public function update(ContractRequest $request, Contract $contract)
    {

        try{
            $contract->update($request->all());


            $response = [
                'sucess' => true,
                'data' => $contract,
                'message' => 'Cadastro editado com sucesso '
            ];

        }catch (\Exception $e){
            $response =  [
                'sucess' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }


    public function destroy(Contract $contract)
    {
        $contract->delete();
        return response()->json('success');
    }
}

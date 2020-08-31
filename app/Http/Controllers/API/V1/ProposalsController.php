<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProposalRequest;
use App\Http\Resources\ProposalResource;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalsController extends Controller
{
    public function index()
    {
        $providers = ProposalResource::collection(Proposal::all());
        return response()->json(['items' => $providers, 'totalCount' => $providers->count()]);
    }


    public function store(ProposalRequest $request)
    {

        $request->validated();

        try{
            $proposal = new Proposal();
            $request['validity'] = $proposal->parse_date($request->validity);
            $provider = $proposal->create($request->all());

            $response = [
                'response' => [
                    'success' => true,
                    'message' => 'Cadastro efetuado com sucesso'
                ],
                'data' => $provider,
            ];

        }catch (\Exception $e){
            $response =  [
                'response' => [
                    'success' => false,
                    'message' => $e->getMessage()
                ],
            ];
        }
        return response()->json($response);
    }


    public function show($id)
    {
        try{
            $results = new ProposalResource(Proposal::find($id));

        }catch (\Exception $e){
            $results = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($results);

    }


    public function update(ProposalRequest $request, $id)
    {

        try{
            $request->validated();
            $request->except('data');

            $proposal = Proposal::find($id);
            $request['validity'] = $proposal->parse_date($request->validity);
            $request['file'] = $request->file == "" ? $proposal->file : $request->file;
            $proposal->update($request->all());

            $response = [
                'sucess' => true,
                'data' => $proposal,
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


    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return response()->json('success');
    }
}

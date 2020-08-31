<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Http\Requests\ProviderStore;

class ProvidersController extends Controller
{

    public function index()
    {
        $providers = ProviderResource::collection(Provider::all());
        return response()->json(['items' => $providers, 'totalCount' => $providers->count()]);
    }


    public function store(ProviderStore $request)
    {


        try{
            $provider = Provider::create($request->all());

            // ATUALIZA ENDEREÇO
            $provider->setAddresses($request->get('address', []));

            // ATUALIZA TELEFONES
            $provider->setPhones($request->get('phones', []));

            $response = [
                'sucess' => true,
                'data' => $provider,
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
            $results = new ProviderResource(Provider::find($id));

        }catch (\Exception $e){
            $results = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($results);

    }


    public function update(ProviderStore $request, Provider $provider)
    {

        try{
            $provider->update($request->all());

            // ATUALIZA ENDEREÇO
            $provider->setAddresses($request->get('address', []));

            // ATUALIZA TELEFONES
            $provider->setPhones($request->get('phones', []));

            $response = [
                'sucess' => true,
                'data' => $provider,
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


    public function destroy(Provider $provider)
    {
        $provider->delete();
        return response()->json('success');
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientsRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ClientsController extends Controller
{

    public function index(Request $request)
    {
        $clients = ClientResource::collection(Client::all());
        return response()->json(['items' => $clients, 'totalCount' => $clients->count()]);
    }


    public function store(ClientsRequest $request)
    {

        try{
            $client = Client::create($request->all());

            // ATUALIZA ENDEREÇO
            $client->setAddresses($request->get('address', []));

            // ATUALIZA TELEFONES
            $client->setPhones($request->get('phones', []));

            // ATUALIZA CONTATOS
            $client->setContacts($request->get('contacts', []));

            $response = [
                'sucess' => true,
                'data' => $client,
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
            $results = new ClientResource(Client::find($id));

        }catch (\Exception $e){
            $results = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($results);

    }


    public function update(ClientsRequest $request, Client $client)
    {

        try{
            // ATUALIZA BASE
            $client->update($request->all());

            // ATUALIZA ENDEREÇO
            $client->setAddresses($request->get('address', []));

            // ATUALIZA TELEFONES
            $client->setPhones($request->get('phones', []));

            // ATUALIZA CONTATOS
            $client->setContacts($request->get('contacts', []));

            $response = [
                'sucess' => true,
                'data' => $client,
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


    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json('success');
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class CitiesStatesController extends Controller
{
    public function cities(){
        try {
            $response = City::all();

        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function byState($state_id){
        try{
            $response = City::where('state_id', $state_id)->get();

        }   catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }
        return response()->json($response);
    }

    public function states(){
        try {
            $response = State::all();

        } catch (\Exception $e){
            $response = [
                'success' => false,
                'message' =>  $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function ceps($cep){
        $res = Http::get('https://viacep.com.br/ws/'.$cep.'/json');



        try{
            if ($res->getStatusCode() == 200) { // 200 OK
                $response_data = json_decode($res->getBody()->getContents(), true);
            }

            $response = [
                'logradouro' => $response_data['logradouro'],
                'bairro' => $response_data['bairro'],
                'cidade' => City::getCityId($response_data['localidade']),
                'estado' => State::getStateId($response_data['uf']),
                'cep' => $response_data['cep']
            ];
        }catch (\Exception $e) {
            $response = [
                'sucess' => false,
                'error' => $e
            ];
        }
        return response()->json($response);
    }
}

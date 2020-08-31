<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiveRequest;
use App\Http\Resources\BillEntrieResource;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use App\Models\BillEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceivesController extends Controller
{

    public function index()
    {


        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

      $receive =   BillEntry::whereHas('bill', function($query){
            return $query->where('category', 'receive');
        })->orderBy('due', 'ASC')
          ->whereBetween('due', array($start, $end))->get();

        $receives = BillEntrieResource::collection($receive);

        $response = [
            'sucess' => true,
            'items' => $receives,
            'totalCount' => $receives->count()
        ];

        return response()->json($response);
    }



    public function store(ReceiveRequest $request)
    {


        try{

            // CONVERSÕES DE DATAS
                $request['due']      = Carbon::parse($request->get('due'))->format('Y-m-d');
                $request['issue']    = Carbon::parse($request->get('issue'))->format('Y-m-d');
                $request['active']   = 1;
                $request['category'] = 'receive';
                $request['status']   = 'pendent';


                //cadastra a conta
                    $bill = Bill::create($request->all());

                // VERIFICA SE EXISTE ANEXO
                if ($request->get('attachments')){
                    $bill->sendFiles($request->get('attachments'));
                }

                //adiciona as informações da conta
                $bill->setDetails($request->all());

                //adiciona a lista de faturas
                $bill->setEntries($request->get('parcels'));

            // RESPOSTA PARA O FRONT
                $response = [
                    'sucess' => true,
                    'data' => $bill,
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
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChargingRequest;
use App\Http\Resources\BillEntrieResource;
use App\Http\Resources\BillResource;
use App\Http\Resources\ChargingResource;
use App\Models\Bill;
use App\Models\BillEntry;
use App\Models\Charging;
use App\Models\Client;
use App\Notifications\InvoiceOverdue;
use App\Services\CurrencyExchange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Notification;

class ChargingsController extends Controller
{


    public function index()
    {
       $chargings = ChargingResource::collection(Charging::all());

       return response()->json(['items' => $chargings, 'totalCount' => $chargings->count()]);
    }


    public function store(ChargingRequest $request)
    {

        $client = Client::find($request->get('client_id'));

        $start  =  Carbon::parse($request->get('period'))->format('Y-m-d');
        $end    = Carbon::parse($request->get('period'))->endOfMonth()->format('Y-m-d');

        $bills = BillEntry::whereHas('bill', function($query) use ($client){
            return $query->where('client_id', $client->id);
        }) ->whereBetween('due', array($start, $end))->get();

        $client->notify(new InvoiceOverdue($bills, $client));

        try{
            $charging = new Charging();

            if ($charging->verified($request->all())):

                $request['user_id']  = Auth::user()->id;

                $charging->create($request->all());

                $response = [
                   'success' => true,
                   'data' => $charging,
                   'messsage' => 'Cadastro efetuado com sucesso'
                ];

            else:

                $response = [
                    'success' => false,
                    'messsage' => 'Uma cobrança ja foi enviada a menos de 3 dias'
                ];

            endif;
        }
        catch (\Exception $e){

            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function clientBills(Client $client){
        $bills =   BillEntry::whereHas('bill', function($query) use ($client){
            return $query->where('client_id', $client->id);
        })->where('status', 'overdue')->get();


       return response()->json(BillEntrieResource::collection($bills));


    }

    public function show($id)
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

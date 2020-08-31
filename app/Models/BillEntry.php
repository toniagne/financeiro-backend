<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class BillEntry extends Model
{
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'bill_id',
        'amount',
        'description',
        'status',
        'due'
    ];

    protected $dates = [
        'due',
        'deleted_at'
    ];

    public function bill(){
        return $this->belongsTo(Bill::class, 'bill_id');
    }

    public function charging(){
        return $this->hasMany(Charging::class, 'bill_entry_id', 'id');
    }

    public function status(){
        switch ($this->status){
            case 'payed': return 'PAGO'; break;
            case 'pendent': return 'PENDENTE'; break;
            case 'parcial': return 'PARCELA'; break;
            case 'overdue': return 'ATRASADA'; break;
        }
    }

    /*
   |--------------------------------------------------------------------------
   | Retorna o valor conforme o status
   |--------------------------------------------------------------------------
   */
    public function amount(){
        switch ($this->status){

            case 'pendent'; case 'payed'   : return $this->amount;
            case 'parcial'; case 'overdue' : return (
            $this->amount - $this->sumOfPayments()
        );

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna a soma dos pagamentos
    |--------------------------------------------------------------------------
    */
    public function sumOfPayments(){
        return BillEntryPayment::where([
            'idBillEntry' => $this->idBillEntry
        ])->sum('amount');
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna o demonstrativo de serviços
    |--------------------------------------------------------------------------
    */
    public function demonstrative(){

        $demonstrative = '';

        foreach ($this->services as $relation){
            $demonstrative .= "- {$relation->service->name}\n";
        }

        return $demonstrative;
    }


}

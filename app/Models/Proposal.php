<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'category_id',
        'validity',
        'pdf',
        'value',
        'situation',
        'file',
        'observation'
    ];

    protected $dates = [
        'created',
        'updated',
        'deleted_at'
    ];

    protected $casts  = [
        'validity' => 'date:Y-m-d',
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function category(){
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function parse_date($date){
        return Carbon::parse($date)->format('Y-m-d');
    }

    public function situation($situation){
        switch ($situation){
            case 'created':
                $situation = "NOVA"; break;
            case 'unsuccessful':
                $situation = "RECUSADA"; break;
            case 'canceled':
                $situation = "CANCELADA"; break;
        }
        return $situation;
    }
}

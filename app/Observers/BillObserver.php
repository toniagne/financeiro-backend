<?php

namespace App\Observers;

use App\Models\Bill;
use App\Models\BillEntry;

class BillObserver
{

    public function created(Bill $bill)
    {

        for($i = 1;$i<=$bill->recurrence->obj;$i++)
        {
            BillEntry::create([
                'bill_id' => $bill->id,
                'due' => $bill->due->addMonths($i),
                'amount' => $bill->amount,
                'description' => $bill->description,
                'status' => 'pendent'
            ]);
        }

    }


    public function updated(Bill $bill)
    {
        //
    }


    public function deleted(Bill $bill)
    {
        //
    }

    public function restored(Bill $bill)
    {
        //
    }

    public function forceDeleted(Bill $bill)
    {
        //
    }
}

<?php

namespace App\Console\Commands;

use App\Http\Controllers\API\V1\BillsController;
use Illuminate\Console\Command;


class BillsVerify extends Command
{

    protected $signature = 'bill:overdue';


    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

       $bill = new BillsController();

       $bill->setOverdues();


    }
}

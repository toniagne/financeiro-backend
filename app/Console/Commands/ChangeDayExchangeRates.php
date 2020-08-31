<?php

namespace App\Console\Commands;

use App\Models\Config;
use App\Services\CurrencyExchange;
use Illuminate\Console\Command;

class ChangeDayExchangeRates extends Command
{

    protected $signature = 'config:exchange';


    protected $description = 'Atualiza valores das taxas de câmbio do dia';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $rates = new CurrencyExchange();

        $dollar = Config::where('name', 'dollar')->update([
            'value' => $rates->url('dollar')
        ]);

        $euro = Config::where('name', 'euro')->update([
            'value' => $rates->url('euro')
        ]);
    }
}

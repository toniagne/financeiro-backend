<?php

/*
 * File        : Recurrency.php
 * Description : Extensão do manipulador de recorrência
 * Author      : Alef Carvalho <alef.carvalho@inovedados.com.br> - Inove Dados
*/

namespace App\Services;

use When\When;

class Recurrency extends When {

    //desabilita a exception quando a primeira data da recorrência não é válida
    public $RFC5545_COMPLIANT = self::IGNORE;

}

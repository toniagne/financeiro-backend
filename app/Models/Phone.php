<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'phonable_id',
        'phone',
        'contact'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    function formatPhoneNumber($s) {
        $rx = "/
            (1)?\D*     # optional country code
            (\d{3})?\D* # optional area code
            (\d{3})\D*  # first three
            (\d{4})     # last four
            (?:\D+|$)   # extension delimiter or EOL
            (\d*)       # optional extension
             /x";
                preg_match($rx, $s, $matches);
                if(!isset($matches[0])) return false;

                $country = $matches[1];
                $area = $matches[2];
                $three = $matches[3];
                $four = $matches[4];
                $ext = $matches[5];

                $out = "$three-$four";
                if(!empty($area)) $out = "$area-$out";
                if(!empty($country)) $out = "+$country-$out";
                if(!empty($ext)) $out .= "x$ext";

        // check that no digits were truncated
        // if (preg_replace('/\D/', '', $s) != preg_replace('/\D/', '', $out)) return false;
                return $out;
    }

}

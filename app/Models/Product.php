<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
       'product_category_id',
       'name',
       'value',
       'price',
       'profit',
       'currence_rate',
       'fixed_margin',
       'observation',
       'status'
   ];

    public function product_category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function product_details(){
        return $this->morphMany(ProductDetail::class, 'productable');
    }

    public function setDetails(array $details = [])
    {
        $this->product_details()->forceDelete();

        $this->product_details()->createMany($details);
    }

    public function parameterized()
    {
        $calc1 = $this->value * $this->product_margin->dolar_value;
        $calc2 = $calc1 * $this->product_margin->margin;
        $total = $calc1 + $calc2 + $this->product_margin->fixed_margin;

        return $total;
    }
}


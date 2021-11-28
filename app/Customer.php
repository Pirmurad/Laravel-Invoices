<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=['name','address','postcode','city','state','postcode','phone','email','country_id'];

    public function customer_fields()
    {
        return $this->hasMany(CustomersField::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $fillable = ['name', 'postal_code', 'country_id'];



    public static function storeValidation($request)
    {
        return [
            'name'          =>  'max:20|required|unique:cities,name',
            'postal_code'   =>  'max:10|required|unique:cities,postal_code',
            'country_id'    =>  'required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name'          =>  'max:20|required|unique:cities,name,' . $request->route('city'),
            'postal_code'   =>  'max:10|required|unique:cities,postal_code,' . $request->route('city'),
            'country_id'    =>  'required'
        ];
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
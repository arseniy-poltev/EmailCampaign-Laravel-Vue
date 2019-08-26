<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 *
 * @package App
 * @property string $language
 * @property string $locale
 */
class Country extends Model
{
    protected $fillable = ['code', 'name', 'initial_price', 'extra_price', 'activated', 'currency_id', 'map_file_url'];



    public static function storeValidation($request)
    {
        return [
            'code'          =>  'max:2|required|unique:countries,code',
            'name'          =>  'max:20|required|unique:countries,name',
            'currency_id'   =>  'required',
            'initial_price' =>  'required',
            'extra_price'   =>  'required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'code'          =>  'max:2|required|unique:countries,code,' . $request->route('country'),
            'name'          =>  'max:20|required|unique:countries,name,' . $request->route('country'),
            'currency_id'   =>  'required',
            'initial_price' =>  'required',
            'extra_price'   =>  'required'
        ];
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }

    public function cities()
    {
        return $this->hasMany('App\City');
    }
}
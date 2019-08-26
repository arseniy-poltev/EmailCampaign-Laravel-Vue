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
class Currency extends Model
{
    protected $fillable = ['name', 'code', 'symbol'];



    public static function storeValidation($request)
    {
        return [
            'name'          =>  'max:20|required|unique:currencies,name',
            'code'          =>  'max:3|required|unique:currencies,code',
            'symbol'          =>  'max:5|required|unique:currencies,symbol',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name'          =>  'max:20|required|unique:currencies,name,' . $request->route('currency'),
            'code'          =>  'max:3|required|unique:currencies,code,' . $request->route('currency'),
            'symbol'          =>  'max:5|required|unique:currencies,symbol,' . $request->route('currency'),
        ];
    }

    public function countries()
    {
        return $this->hasMany('App\Country');
    }
}
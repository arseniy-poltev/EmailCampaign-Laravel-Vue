<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterKeyTranslation extends Model
{
    //
    protected $table = 'filter_key_translations';
    protected $fillable = ['filter_key_id', 'locale', 'name'];

    public function filterKey()
    {
        return $this->belongsTo('App\FilterKey');
    }
}
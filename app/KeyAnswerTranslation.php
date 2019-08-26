<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyAnswerTranslation extends Model
{
    //
    protected $table = 'key_answer_translations';
    protected $fillable = ['key_answer_id', 'locale', 'title'];

    public function keyAnswer()
    {
        return $this->belongsTo('App\KeyAnswer');
    }
}
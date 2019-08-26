<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class KeyAnswer extends Model
{
    //
    protected $table = 'key_answers';
    protected $fillable = ['filter_key_id'];


    //*******English is default locale:en**************
    public function translation($locale = 'en')
    {
        return $this->translations()->where('locale', $locale);
    }

    public function getTranslation($locale = 'en')
    {
        $translation =  $this->translation($locale)->select('title')->first();
        if ($translation) {
            return $translation->toArray();
        } else {
            return ['title' => null];
        }
    }

    public function insertRecord($data)
    {
        $keyAnswerData = [
            'filter_key_id'   =>  $data['filter_key_id'],
        ];

        $keyAnswer = KeyAnswer::create($keyAnswerData);

        $translationData = [
            'title'               =>  isset($data['title']) ? $data['title'] : null,
            'key_answer_id'       =>  $keyAnswer->id
        ];

        KeyAnswerTranslation::create($translationData);
        return $keyAnswer;
    }
    public function updateRecord($data)
    {
        $locale = 'en';
        if (isset($data['locale']))
            $locale = $data['locale'];
        $keyAnswerData = [
            'filter_key_id'   =>  $data['filter_key_id'],
        ];

        $translationData = [
            'title'               =>  isset($data['title']) ? $data['title'] : null,
        ];

        //$this->update($keyAnswerData);

        $key = [
            'locale'            =>  $locale,
            'key_answer_id'     =>  $this->id,
        ];

        KeyAnswerTranslation::updateOrCreate($key, $translationData);
    }
    public static function storeValidation($request)
    {
        return [
            'title'              =>  'max:100|required',
            'filter_key_id'      =>  'required',
        ];
    }
    public static function updateValidation($request)
    {
        return [
            'title'              =>  'max:100|required',
            'filter_key_id'      =>  'required',
        ];
    }

    //********************relationship******************

    public function filterKey()
    {
        return $this->belongsTo('App\FilterKey');
    }

    public function translations()
    {
        return $this->hasMany('App\KeyAnswerTranslation');
    }

    public function delete()
    {
        $this->translations()->delete();
        return parent::delete();
    }
}
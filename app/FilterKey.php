<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterKey extends Model
{
    //
    protected $table = 'filter_keys';
    protected $fillable = ['json_name', 'type', 'min_value', 'max_value', 'step'];


    //*******English is default locale:en**************
    public function translation($locale = 'en')
    {
        return $this->translations()->where('locale', $locale);
    }

    public function getTranslation($locale = 'en')
    {
        $translation =  $this->translation($locale)->select('name')->first();
        if ($translation) {
            return $translation->toArray();
        } else {
            return ['name' => null];
        }
    }

    public function insertRecord($data)
    {
        $filterKeyData = [
            'type'          =>  $data['type'],
            'json_name'     =>  $data['json_name'],
            'min_value'     =>  isset($data['min_value']) ? $data['min_value'] : null,
            'max_value'     =>  isset($data['max_value']) ? $data['max_value'] : null,
            'step'          =>  isset($data['step']) ? $data['step'] : null,
        ];

        $filterKey = FilterKey::create($filterKeyData);

        $translationData = [
            'name'                =>  isset($data['name']) ? $data['name'] : null,
            'filter_key_id'       =>  $filterKey->id
        ];

        FilterKeyTranslation::create($translationData);
        return $filterKey;
    }
    public function updateRecord($data)
    {
        $locale = 'en';
        if (isset($data['locale']))
            $locale = $data['locale'];
        $filterKeyData = [
            'type'          =>  $data['type'],
            'json_name'     =>  $data['json_name'],
            'min_value'     =>  $data['type'] == 0 ? null : (isset($data['min_value']) ? $data['min_value'] : null),
            'max_value'     =>  $data['type'] == 0 ? null : (isset($data['max_value']) ? $data['max_value'] : null),
            'step'          =>  $data['type'] == 0 ? null : (isset($data['step']) ? $data['step'] : null),
        ];

        $translationData = [
            'name'                =>  isset($data['name']) ? $data['name'] : null,
        ];

        $this->update($filterKeyData);

        $key = [
            'locale'            =>  $locale,
            'filter_key_id'     =>  $this->id,
        ];

        FilterKeyTranslation::updateOrCreate($key, $translationData);
    }
    public static function storeValidation($request)
    {
        return [
            'name'              =>  'max:20|required',
            'json_name'         =>  'max:15|required|unique:filter_keys,json_name',
            'type'              =>  'required',
            'min_value'         =>  'nullable',
            'max_value'         =>  'nullable',
            'step'              =>  'nullable',
        ];
    }
    public static function updateValidation($request)
    {
        return [
            //'txt' => 'max:65535|unique:questions,txt,'.$request->route('question'),
            'name'              =>  'max:20|required',
            'json_name'         =>  'max:15|required|unique:filter_keys,json_name,' . $request->route('filter_key'),
            'type'              =>  'required',
            'min_value'         =>  'nullable',
            'max_value'         =>  'nullable',
            'step'              =>  'nullable',
        ];
    }

    //********************relationship******************

    public function answers()
    {
        return $this->hasMany('App\KeyAnswer');
    }

    public function translations()
    {
        return $this->hasMany('App\FilterKeyTranslation');
    }

    public function delete()
    {
        $answers = $this->answers()->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }
        $this->translations()->delete();
        return parent::delete();
    }
}
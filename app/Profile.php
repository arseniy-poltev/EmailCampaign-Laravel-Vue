<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Profile extends Model
{
    //
    protected $fillable = ['phone', 'country', 'address', 'vat_number', 'user_id'];
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public static function updateValidation($request)
    {
        return [
            'name'          =>  'max:191|required',
            'email'         =>  'email|max:191|required|unique:users,email,' . Auth::id(),
            'phone'         =>  'required',
            'country'       =>  'required',
            'address'       =>  'required',
            'vat_number'    =>  'required'
        ];
    }
}
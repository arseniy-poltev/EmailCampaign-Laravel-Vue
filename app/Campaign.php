<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Campaign
 *
 * @package App
 * @property string $name
 * @property string $sender_name
 * @property string $filter
 * @property string $status
 * @property string $schedule_time
 */
class Campaign extends Model
{
    use FormatsDate;
    //
    protected $fillable = [
        'user_id', 'name', 'sender_name', 'message', 'filter', 'status', 'schedule_time', 'timezone',
        'comment', 'reason', 'count_customers', 'interval_time', 'interval_cnt'
    ];
    public static function storeValidation($request)
    {
        return [
            'name'              =>  'max:50|required',
            'sender_name'       =>  'max:11|required',
            // 'filter'        =>  'required',
            'message'           =>  'max:765|required',
            'count_customers'   =>  'required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name'              =>  'max:50|required',
            'sender_name'       =>  'max:11|required',
            // 'filter'        =>  'required',
            'message'           =>  'max:765|required',
            'count_customers'   =>  'required'
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\User')
            ->select(['name', 'id']);
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice');
    }
}
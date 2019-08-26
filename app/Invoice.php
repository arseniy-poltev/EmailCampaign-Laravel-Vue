<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    use FormatsDate;
    protected $fillable = [
        'campaign_id', 'user_id', 'total_price', 'invoice_number',
        'count_customers', 'initial_price', 'extra_price', 'extra_filter_count', 'status', 'currency_code', 'currency_symbol'
    ];

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    use FormatsDate;
    protected $fillable = ['message', 'status', 'campaign_id', 'from_id', 'to_id', 'is_read'];
}
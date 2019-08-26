<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ResetDeviceInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function setDeviceInfo(Request $request)
    {
        $user = Auth::user();
        $user->device_token = $request->token;
        $user->timezone = $request->timezone;
        $user->save();
    }
}
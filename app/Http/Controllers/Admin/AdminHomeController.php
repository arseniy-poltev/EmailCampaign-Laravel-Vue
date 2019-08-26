<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Service\AdsWebService;
use App\Service\NotificationService;
use Auth;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = new NotificationService();
        $count = $service->getUnreadNotification(Auth::id());
        $recent = $service->getRecentNotification(Auth::id());
        return view('admin.home', [
            'unreadCnt'             =>  $count,
            'recent'    =>  $recent
        ]);
    }
}
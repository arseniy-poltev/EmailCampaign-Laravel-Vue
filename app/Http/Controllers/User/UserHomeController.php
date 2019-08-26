<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Service\NotificationService;
use Auth;
use App\Country;

class UserHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //set server time zone to session

        //get unread notifications' count for a user
        $service = new NotificationService();
        $count = $service->getUnreadNotification(Auth::id());
        $recent = $service->getRecentNotification(Auth::id());
        $maps = Country::where('map_file_url', '!=', null)
            ->select('map_file_url')
            ->get();

        return view('user.home', [
            'unreadCnt' =>  $count,
            'recent'    =>  $recent,
            'maps'      =>  $maps
        ]);
    }
}
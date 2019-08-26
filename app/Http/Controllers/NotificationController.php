<?php

namespace App\Http\Controllers;

use App\Service\NotificationService;
use Auth;

class NotificationController extends Controller
{
    public function clearUnreadNotification()
    {
        $service = new NotificationService();
        $service->clearUnreadNotification(Auth::id());
    }
}
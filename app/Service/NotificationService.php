<?php

namespace App\Service;

use App\Notification;
use App\User;
use function GuzzleHttp\json_decode;
use App\GlobalConstants;

class NotificationService
{
    private $FCM_API_KEY;
    const RECENT_NOTIFICATION_CNT = 5;

    public function __construct()
    {
        $this->FCM_API_KEY    =   \Config::get('constants.FCM_API_KEY');
    }
    public function sendAndSaveNotification($campaign, $from, $to)
    {
        //send
        //testing code
        //admin token 
        $notification = new Notification();

        $notification->message = $campaign->name . " is " . $campaign->status;
        $notification->campaign_id = $campaign->id;
        $notification->status = $campaign->status;
        $notification->from_id = $from;
        $notification->to_id = $to;
        $notification->save();



        $fromUser = User::findOrFail($from);
        $toUser = User::findOrFail($to);
        if ($fromUser == null || $toUser == null) {
            return;
        }
        if ($toUser->device_token == null) {
            return;
        }

        $url = 'https://fcm.googleapis.com/fcm/send';

        $title = '';
        $body = '';

        switch ($campaign->status) {
            case GlobalConstants::CAMPAIGN_STATUS_PENDING:
                $title = GlobalConstants::TITLE_FOR_NEW_CAMPAIGN;
                $body = "Campaign Name:  " . $campaign->name;
                break;
            case GlobalConstants::CAMPAIGN_STATUS_APPROVED:
            case GlobalConstants::CAMPAIGN_STATUS_REJECTED:
                $title = GlobalConstants::TITLE_FOR_CHANGE_STATUS;
                $body = $campaign->name . " is " . $campaign->status;
                break;
            case GlobalConstants::CAMPAIGN_STATUS_DONE:
                $title = GlobalConstants::TITLE_FOR_CHANGE_STATUS;
                $body = $campaign->name . " is paid";
                break;
        }

        $fields = array(
            'to'    =>  $toUser->device_token,
            'data' => array(
                "title"     =>  $title,
                "body"      =>  $body,
                "detail"    =>  $notification,
                "campaign"  =>  $campaign,
                "icon"      =>  "/logo.png"
            )
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . $this->FCM_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $result = curl_exec($ch);
        //var_dump($result);
        //$result = json_decode($result);

        curl_close($ch);
    }
    //get unread notifications' count for a user    
    public function getUnreadNotification($userId)
    {
        return Notification::where('to_id', $userId)
            ->where('is_read', 0)
            ->count();
    }
    public function getRecentNotification($userId)
    {
        return Notification::where('to_id', $userId)->orderBy('created_at', 'desc')->take($this::RECENT_NOTIFICATION_CNT)->get();
    }
    public function clearUnreadNotification($userId)
    {
        Notification::where('to_id', $userId)->where('is_read', 0)->update(['is_read' => 1]);
    }
}
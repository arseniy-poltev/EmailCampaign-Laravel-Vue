<?php

namespace App\Http\Controllers\Api\V1;

use App\Campaign;
use App\Notification;
use App\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Resources\Campaign as CampaignResource;
use App\Http\Requests\Admin\StoreCampaignsRequest;
use App\Http\Requests\Admin\UpdateCampaignsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\GlobalConstants;
use App\Service\NotificationService;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignsController extends Controller
{
    private $NOTIFICATION_SERVICE;
    public function __construct()
    {
        $this->NOTIFICATION_SERVICE = new NotificationService();
    }
    public function index()
    {
        $type = $_GET['type'];

        $this->NOTIFICATION_SERVICE->clearUnreadNotification(Auth::id());

        if ($type == GlobalConstants::CAMPAIGN_STATUS_DRAFT) {
            return abort(401);
        }
        if ($type == GlobalConstants::CAMPAIGN_STATUS_ALL) {
            $campaigns = Campaign::with(['user'])
                ->where('status', '!=', GlobalConstants::CAMPAIGN_STATUS_DRAFT)
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $campaigns = Campaign::with(['user'])
                ->where('status', $type)
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        return new CampaignResource($campaigns);
    }
    public function summary()
    {
        $approvedCnt = Campaign::where('status', GlobalConstants::CAMPAIGN_STATUS_APPROVED)
            ->count();
        $doneCnt = Campaign::where('status', GlobalConstants::CAMPAIGN_STATUS_DONE)
            ->count();
        $pendingCnt = Campaign::where('status', GlobalConstants::CAMPAIGN_STATUS_PENDING)
            ->count();
        $rejectedCnt = Campaign::where('status', GlobalConstants::CAMPAIGN_STATUS_REJECTED)
            ->count();
        $totalCnt = Campaign::where('status', '!=', GlobalConstants::CAMPAIGN_STATUS_DRAFT)
            ->count();

        return new JsonResource([
            'totalCnt'      =>  $totalCnt,
            'approvedCnt'   =>  $approvedCnt,
            'doneCnt'       =>  $doneCnt,
            'pendingCnt'    =>  $pendingCnt,
            'rejectedCnt'   =>  $rejectedCnt
        ]);
    }


    public function show($id)
    {
        // if (Gate::denies('language_view')) {
        //     return abort(401);
        // }

        $campaign = Campaign::with(['user'])->findOrFail($id);
        $cnt = $campaign->count_customers;
        $priceInfo = GlobalConstants::getPriceInfo($campaign->filter, $cnt);
        if ($priceInfo == null) {
            return new CampaignResource($campaign);
        }

        return new CampaignResource(array_merge($campaign->toArray(), [
            'price_per_sms'     =>  $priceInfo['price_per_sms'],
            'total_price'       =>  $priceInfo['total_price'],
            'currency_code'     =>  $priceInfo['total_price'],
            'currency_symbol'   =>  $priceInfo['currency_symbol'],
        ]));
    }

    private function makeInvoice($cId)
    {
        $campaign = Campaign::with(['user'])->findOrFail($cId);

        if ($campaign == null || $campaign->status != GlobalConstants::CAMPAIGN_STATUS_APPROVED) {
            return abort(401);
        }


        $cnt = $campaign->count_customers;
        $priceInfo = GlobalConstants::getPriceInfo($campaign->filter, $cnt);
        if ($priceInfo == null) {
            return;
        }
        $invoice = Invoice::create([
            'campaign_id'       =>  $cId,
            'invoice_number'    =>  '',
            'user_id'           =>  $campaign->user->id,
            'total_price'       =>  $priceInfo['total_price'],
            'count_customers'   =>  $cnt,
            'initial_price'     =>  $priceInfo['initial_price'],
            'extra_price'       =>  $priceInfo['extra_price'],
            'currency_code'     =>  $priceInfo['currency_code'],
            'currency_symbol'   =>  $priceInfo['currency_symbol'],
            'extra_filter_count' =>  $priceInfo['extra_filter_count'],
        ]);
        $year = date("Y");

        $invoice->update([
            'invoice_number'    =>  'INV-' . substr(date("Y"), 2) . '-' . str_pad($invoice->id, 7, "0", STR_PAD_LEFT),
        ]);
    }

    public function update(Request $request, $id)
    {
        // if (Gate::denies('language_edit')) {
        //     return abort(401);
        // }

        $campaign = Campaign::findOrFail($id);

        if ($campaign->status != GlobalConstants::CAMPAIGN_STATUS_PENDING) {
            return abort(401);
        }

        if (isset($request->status)) {
            $status = $request->status == 1 ? GlobalConstants::CAMPAIGN_STATUS_APPROVED : GlobalConstants::CAMPAIGN_STATUS_REJECTED;
            $campaign->update([
                'status'    =>  $status,
                'reason'    =>  isset($request->reason) ? $request->reason : NULL,
            ]);
            //Send FCM to the user
            // and add notification to table

            $this->NOTIFICATION_SERVICE->sendAndSaveNotification($campaign, Auth::id(), $campaign->user_id);

            //make invoice if approved
            if ($request->status == 1) {
                $this->makeInvoice($id);
            }
        }

        return (new CampaignResource($campaign))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        // if (Gate::denies('language_delete')) {
        //     return abort(401);
        // }

        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return response(null, 204);
    }
}
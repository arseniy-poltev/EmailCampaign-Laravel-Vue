<?php

namespace App\Http\Controllers\Api\V2;

use App\Campaign;
use App\Invoice;
use App\Country;
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
use Stripe;
use function GuzzleHttp\json_decode;

class CampaignsController extends Controller
{

    private $STRIPE_PK_KEY;
    private $NOTIFICATION_SERVICE;

    public function __construct()
    {
        $this->STRIPE_PK_KEY    =   \Config::get('constants.stripe_pk_key');
        $this->NOTIFICATION_SERVICE = new NotificationService();
    }

    public function index()
    {
        $type = $_GET['type'];


        $this->NOTIFICATION_SERVICE->clearUnreadNotification(Auth::id());
        if ($type == GlobalConstants::CAMPAIGN_STATUS_ALL) {
            $campaigns = Auth::user()->campaigns()
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $campaigns = Auth::user()->campaigns()
                ->where('status', $type)
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        return new CampaignResource($campaigns);
    }
    public function summary()
    {
        $approvedCnt = Auth::user()->campaigns()
            ->where('status', GlobalConstants::CAMPAIGN_STATUS_APPROVED)
            ->count();
        $doneCnt = Auth::user()->campaigns()
            ->where('status', GlobalConstants::CAMPAIGN_STATUS_DONE)
            ->count();
        $pendingCnt = Auth::user()->campaigns()
            ->where('status', GlobalConstants::CAMPAIGN_STATUS_PENDING)
            ->count();
        $draftCnt = Auth::user()->campaigns()
            ->where('status', GlobalConstants::CAMPAIGN_STATUS_DRAFT)
            ->count();
        $rejectedCnt = Auth::user()->campaigns()
            ->where('status', GlobalConstants::CAMPAIGN_STATUS_REJECTED)
            ->count();
        $totalCnt = Auth::user()->campaigns()
            ->count();
        return new JsonResource([
            'totalCnt'      =>  $totalCnt,
            'approvedCnt'   =>  $approvedCnt,
            'doneCnt'       =>  $doneCnt,
            'pendingCnt'    =>  $pendingCnt,
            'draftCnt'      =>  $draftCnt,
            'rejectedCnt'   =>  $rejectedCnt
        ]);
    }




    public function show($id)
    {
        // if (Gate::denies('language_view')) {
        //     return abort(401);
        // }

        $campaign = Campaign::with([])->findOrFail($id);
        if ($campaign == null) {
            return new CampaignResource([]);
        }
        $userId = Auth::id();
        if ($campaign->user_id != $userId) {
            return abort(401);
        }
        $cnt = $campaign->count_customers;
        $priceInfo = GlobalConstants::getPriceInfo($campaign->filter, $cnt);
        if ($priceInfo == null) {
            return new CampaignResource(array_merge(
                $campaign->toArray(),
                [
                    //'activated_countries'       =>  $activaCont
                ]
            ));
        }

        return new CampaignResource(array_merge($campaign->toArray(), [
            'price_per_sms'             =>  $priceInfo['price_per_sms'],
            'total_price'               =>  $priceInfo['total_price'],
            'currency_code'             =>  $priceInfo['total_price'],
            'currency_symbol'           =>  $priceInfo['currency_symbol'],
        ]));

        return new CampaignResource($campaign);
    }

    public function store(StoreCampaignsRequest $request)
    {
        // if (Gate::denies('language_create')) {
        //     return abort(401);
        // }
        if ($request->count_customers < 1) {
            return abort(401);
        }

        $request->merge(['user_id' => Auth::id()]);
        $status = '';
        if (isset($request->isDraft) && $request->isDraft == 1) {
            $status = GlobalConstants::CAMPAIGN_STATUS_DRAFT;
        } else {
            $status = GlobalConstants::CAMPAIGN_STATUS_PENDING;
        }

        $request['status'] = $status;

        $campaign = Campaign::create($request->all());
        //Send FCM to the administrator
        // and add notification to table
        if ($status != GlobalConstants::CAMPAIGN_STATUS_DRAFT) {

            $this->NOTIFICATION_SERVICE->sendAndSaveNotification($campaign, Auth::id(), 1);
        }



        return (new CampaignResource($campaign))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCampaignsRequest $request, $id)
    {
        // if (Gate::denies('language_edit')) {
        //     return abort(401);
        // }
        if ($request->count_customers < 1) {
            return abort(401);
        }

        $campaign = Campaign::findOrFail($id);
        $userId = Auth::id();
        if ($campaign->user_id != $userId) {
            return abort(401);
        }

        if ($campaign->status != GlobalConstants::CAMPAIGN_STATUS_DRAFT) {
            return abort(401);
        }

        $status = '';
        if (isset($request->isDraft) && $request->isDraft == 1) {
            $status = GlobalConstants::CAMPAIGN_STATUS_DRAFT;
        } else {
            $status = GlobalConstants::CAMPAIGN_STATUS_PENDING;
        }

        $request['status'] = $status;
        if (!isset($request->schedule_time) || !isset($request->timezone)) {
            $request = array_merge($request->toArray(), [
                'schedule_time'     =>  NULL,
                'timezone'          =>  NULL
            ]);
            $campaign->update($request);
        } else {
            $campaign->update($request->all());
        }


        //Send FCM to the administrator
        // and add notification to table
        if ($status != GlobalConstants::CAMPAIGN_STATUS_DRAFT) {

            $this->NOTIFICATION_SERVICE->sendAndSaveNotification($campaign, Auth::id(), 1);
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
        $userId = Auth::id();
        if ($campaign->user_id != $userId) {
            return abort(401);
        }
        $campaign->delete();

        return response(null, 204);
    }

    public function getTarget(Request $request)
    {
        $cnt = random_int(0, 100000);
        $priceInfo = GlobalConstants::getPriceInfo($request->param, $cnt);

        return response($priceInfo);
    }

    public function getInvoice($id)
    {
        $campaign = Campaign::with(['invoice'])->findOrFail($id);
        $userId = Auth::id();
        if ($campaign->user_id != $userId) {
            return abort(401);
        }
        $user = Auth::user();
        // if ($user->profile == null) {
        //     return new JsonResource([
        //         'status'    =>  'error',
        //         'message'   =>  'You have to complete your profile!'
        //     ]);
        // }
        $userPro = GlobalConstants::getProfileOfUser($user);
        $adminPro = GlobalConstants::getProfileOfAdmin();

        return new CampaignResource([
            'invoice'  =>  $campaign->invoice,
            'user_profile'  =>  $userPro,
            'admin_profile' =>  $adminPro
        ]);
        // return new CampaignResource([
        //     $campaign->invoice
        // ]);
    }
    public function stripePay(Request $request)
    {
        if (!isset($request['invoice_id']) || !isset($request['stripeToken'])) {
            return abort(404);
        }


        $invoice = Invoice::findOrFail($request->invoice_id);


        if ($invoice == null) {
            return abort(404);
        }
        $userId = Auth::id();
        if ($invoice->user_id != $userId) {
            return abort(401);
        }

        if ($invoice->status == 1) {
            return new JsonResource([
                'status'    =>  'success',
                'message'   =>  "This invoice is already paid!"
            ]);
        }

        Stripe\Stripe::setApiKey($this->STRIPE_PK_KEY);
        $amount  = ((float) number_format((float) $invoice->total_price, 2, '.', '')) * 100;
        try {
            Stripe\Charge::create([
                "amount" => $amount,
                "currency" => $invoice->currency_code,
                //"source" => $request->stripeToken,
                "source" => 'tok_visa',
                "description" => "Test payment from targetcustomers.net"
            ]);
        } catch (\Stripe\Error\Base $e) {
            // Code to do something with the $e exception object when an error occurs
            return new JsonResource([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        } catch (Exception $e) {
            // Catch any other non-Stripe exceptions
            return new JsonResource([
                'status'    =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }



        $invoice->status = 1;
        $invoice->save();
        $campaign = $invoice->campaign;
        $campaign->status = GlobalConstants::CAMPAIGN_STATUS_DONE;
        $campaign->save();


        $this->NOTIFICATION_SERVICE->sendAndSaveNotification($campaign, Auth::id(), 1);

        //send messsage

        return new JsonResource([
            'status'    =>  'success',
            'message'   =>  "Payment success"
        ]);
    }
}
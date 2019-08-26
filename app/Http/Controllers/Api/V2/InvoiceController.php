<?php

namespace App\Http\Controllers\Api\V2;

use App\Invoice;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Response;
use PDF;
use App\GlobalConstants;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $invoices = Invoice::where('user_id', Auth::id())
            ->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
        $invoiceArr = array();
        foreach ($invoices as $invoice) {
            array_push($invoiceArr, array_merge($invoice->toArray(), [
                'campaign_name' =>  $invoice->campaign['name']
            ]));
        }
        return new JsonResource($invoiceArr);
    }
    public function getInvoicePDF(Request $request, $invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        if ($invoice == null) {
            return abort(404);
        }
        if ($invoice->user_id != Auth::id()) {
            return abort(401);
        }
        if ($invoice->status == 0) {
            return abort(500);
        }

        $user = Auth::user();
        $userPro = GlobalConstants::getProfileOfUser($user);
        $adminPro = GlobalConstants::getProfileOfAdmin();

        $pdf = PDF::loadView('templates.invoice', [
            'invoiceInfo'   => $invoice,
            'userProfile'   => $userPro,
            'adminProfile'  => $adminPro,
            'campaignName'  => $invoice->campaign['name']
        ]);
        return $pdf->download('Invoice_' . $invoice->invoice_number . ".pdf");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
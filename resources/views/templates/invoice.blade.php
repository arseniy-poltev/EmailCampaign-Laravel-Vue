<!DOCTYPE html>
<html>

<head>
    <title>Targetcustomer.net-{{$invoiceInfo->invoice_number}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <!-- Bootstrap 3.3.7 -->
    {{--    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">--}}
    <!-- Font Awesome -->
    {{--<link rel="stylesheet" href="{{ asset('vendor/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">--}}
    <!-- Ionicons -->
    {{--<link rel="stylesheet" href="{{ asset('vendor/adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">--}}
    <!-- Theme style -->
    <style>
        .container {
            width: 100%;
        }

        .row {
            width: 100%;
            /*display: flex;*/
            /*flex-wrap: wrap;*/
            margin-top: 5px;
        }

        /* content */
        .row div {
            /*background-color: #EF5350;*/
            padding: 2%;
            /*border: 1px solid white;*/
            border-radius: 5px;
            /*text-align: right;*/
            /*color: white;*/
            /*transition: background-color 1s;*/
        }

        /*.row div:nth-child(2n):hover {*/
        /*background-color: #42A5F5;*/
        /*}*/

        /*.row div:nth-child(2n+1):hover {*/
        /*background-color: #66BB6A;*/
        /*}*/

        /* 1/12 */
        .col-1 {
            width: 8.33%;
        }

        /* 2/12 */
        .col-2 {
            width: 16.66%;
        }

        /* 3/12 */
        .col-3 {
            width: 25%;
        }

        /* 4/12 */
        .col-4 {
            width: 33.33%
        }

        /* 5/12 */
        .col-5 {
            width: 41.66%;
        }

        /* 6/12 */
        .col-6 {
            width: 50%;
        }

        /* 7/12 */
        .col-7 {
            width: 58.33%;
        }

        /* 8/12 */
        .col-8 {
            width: 66.66%;
        }

        /* 9/12 */
        .col-9 {
            width: 75%;
        }

        /* 10/12 */
        .col-10 {
            width: 83.33%;
        }

        /* 11/12 */
        .col-11 {
            width: 91.66%;
        }

        /* 12/12 */
        .col-12 {
            width: 100%;
        }

        table thead th,
        table tr td {
            text-align: left;
            border: 1px solid #ddd;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
        }

        .detail-info {
            color: sienna
        }
    </style>
</head>

<body style="padding: 20px;">
    <div class="wrapper">

        <section class="invoice">
            <!-- title row -->
            <div class="row" style="border-bottom: 1px solid #ddd;">
                <div class="col-12" style="padding: 5px !important;">
                    <h2 class="page-header">
                        <img src="{{ public_path() . '/img/target_audience-512.png' }}"
                            style="max-height: 50px;margin-top:15px">
                        Targetcustomer.net
                        <small class="pull-right" style="float: right">Date: {{ date('m/d/Y') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info" style="display: inline-block !important;">
                <div class="col-4 invoice-col" style="float: left !important;">
                    <h3>From</h3>
                    {{--  <address>
                        <strong>Name:</strong> {{$userInfo->name}}<br>
                    <strong>Email:</strong>{{$userInfo->email}}<br>
                    {{-- <strong>Data:</strong> Data<br>
                        <strong>Data:</strong> Data<br>
                        <strong>Data:</strong> Data<br> --}}
                    {{--  </address>  --}}
                    <address>
                        <strong>{{$userProfile['name']}}</strong>
                        <br />
                        {{$userProfile['country']}}
                        <br />
                        {{$userProfile['address']}}
                        <br />
                        Phone: {{$userProfile['phone']}}
                        <br />
                        Email: {{$userProfile['email']}}
                        <br />
                        VAT Number: {{$userProfile['vat_number']}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-4 invoice-col" style="float: right !important; text-align: right">
                    <h3>To</h3>
                    <address>
                        <strong>{{$adminProfile['name']}}</strong>
                        <br />
                        {{$adminProfile['country']}}
                        <br />
                        {{$adminProfile['address']}}
                        <br />
                        Phone: {{$adminProfile['phone']}}
                        <br />
                        Email: {{$adminProfile['email']}}
                        <br />
                        VAT Number: {{$adminProfile['vat_number']}}
                    </address>
                </div>
                <!-- /.col -->


                <!-- /.col -->
            </div>
            <div class="row" style="padding-top:80px">
                <div class="col-5 invoice-col" style="margin-top:100px">
                    <b>Invoice:</b> <br># {{$invoiceInfo->invoice_number}}<br>
                    <b>Payment Due:</b><br>
                    {{$invoiceInfo->created_at->setTimezone(Auth::user()->timezone)->toDateTimeString()}}<br>
                    <b>For:</b> <br>{{$campaignName}}(campaign)
                </div>
                <div class="table-responsive" style="padding-left:50px">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 50%;" class="detail-info">Initial Price per SMS:</th>
                                <td style="text-align:right">
                                    {{$invoiceInfo->currency_symbol.$invoiceInfo->initial_price}}</td>
                            </tr>
                            <tr>
                                <th class="detail-info">Extra Price per filter:</th>
                                <td style="text-align:right">{{$invoiceInfo->currency_symbol.$invoiceInfo->extra_price}}
                                </td>
                            </tr>
                            <tr>
                                <th class="detail-info">Extra Filter Count:</th>
                                <td style="text-align:right">{{$invoiceInfo->extra_filter_count}}</td>
                            </tr>
                            <tr>
                                <th style="width: 50%;" class="detail-info">Final Price per SMS:</th>
                                <td style="text-align:right">
                                    {{$invoiceInfo->currency_symbol}}{{$invoiceInfo->extra_price*$invoiceInfo->extra_filter_count+$invoiceInfo->initial_price}}
                                </td>
                            </tr>
                            <tr>
                                <th class="detail-info">Number of SMS:</th>
                                <td style="text-align:right">{{$invoiceInfo->count_customers}}</td>
                            </tr>
                            <tr>
                                <th class="detail-info">Total:</th>
                                <td style="text-align:right">
                                    {{$invoiceInfo->currency_symbol.$invoiceInfo->total_price.' '.$invoiceInfo->currency_code}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped col-12">
                        <thead>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Campaign Name</th>
                                <th>Currency</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$invoiceInfo->invoice_number}}</td>
                                <td>{{$campaignName}}</td>
                                <td>{{$invoiceInfo->currency_code}}</td>
                                <td>{{$invoiceInfo->total_price}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-5">
                    {{-- <p class="lead">Data:</p> --}}
                    {{-- @if($data->payment_type == 'visa')
                    <img src="{{ public_path() . '/vendor/adminlte/dist/img/credit/visa.png' }}" alt="Visa">
                    @elseif($data->payment_type == 'paypal')
                    <img src="{{ public_path() . '/vendor/adminlte/dist/img/credit/paypal2.png' }}" alt="Paypal">
                    @endif --}}
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>

</html>
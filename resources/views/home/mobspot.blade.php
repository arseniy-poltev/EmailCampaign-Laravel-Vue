@extends('home.layouts.app')
@section('contents')
<div align="center"></div>
<div class="mobspot">
    <div class="row mobspot_intro">
        <div class="title_bar">
            <h1>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        @lang('home.app_name') </font>
                </font><br>
                <div class="trattino"></div>
            </h1>
        </div>
        <div class="container">
            <h2>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_1')</font>
                </font>
            </h2>
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_2')</font>
                </font>
            </h3>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_3')</font>
                </font>
            </p>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_4')</font>
                </font>
            </p>
        </div>
    </div>
    <div class="row mobspot_ragioni mobspot--orangeborder">
        <h2>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_5')</font>
            </font>
        </h2>

        <div class="mobspot_ragioni_el ragioni1">
            <img src="../../img/icomobspot/qp.png">
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_6')</font>
                </font>
            </h3>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_7')</font>
                </font>
            </p>
        </div>
        <div class="mobspot_ragioni_el ragioni2">
            <img src="../../img/icomobspot/db.png">
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_8')</font>
                </font>
            </h3>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_9')</font>
                </font>
            </p>
        </div>
        <div class="mobspot_ragioni_el ragioni3">
            <img src="../../img/icomobspot/opt.png">
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_10')</font>
                </font>
            </h3>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_11')</font>
                </font>
            </p>
        </div>
        <div class="mobspot_ragioni_el ragioni4">
            <img src="../../img/icomobspot/prat.png">
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_12')</font>
                </font>
            </h3>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_13')</font>
                </font>
            </p>
        </div>
        <div class="mobspot_ragioni_el ragioni5">
            <img src="../../img/icomobspot/pop.png">
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_14')</font>
                </font>
            </h3>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        @lang('targetcustomer.txt_detail_15')
                    </font>
                </font>
            </p>
        </div>
    </div>

    <div class="row mobspot_car">
        <h2>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_16')</font>
            </font>
        </h2>
        <div class="mobspot_car_cont">
            <div class="mobspot_car1">

                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            @lang('targetcustomer.txt_detail_17')
                        </font>
                    </font><br><br>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_go') </font>
                    </font><a href="/pages/guideline">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_18')</font>
                        </font>
                    </a>
                </p>
                <div>
                    <img src="../../img/icomobspot/ico-inviomin.png">
                </div>
            </div>
            <div class="mobspot_car2">
                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            @lang('targetcustomer.txt_detail_19')
                        </font>
                    </font><br><br>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_go')</font>
                    </font><a href="/pages/faq">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_20')</font>
                        </font>
                    </a>
                </p>
                <div>
                    <img src="../../img/icomobspot/ico-lunghezza.png">
                </div>
            </div>
            <div class="mobspot_car3">
                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            @lang('targetcustomer.txt_detail_21')
                        </font>
                    </font><br><br>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_go')</font>
                    </font><a href="/pages/planningadv">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_22')</font>
                        </font>
                    </a>
                </p>
                <div>
                    <img src="../../img/icomobspot/ico-multimedia.png">
                </div>
            </div>
        </div>
    </div>

    <div class="row mobspot_modalita mobspot--orangeborder">
        <div class="container">
            <h2>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_23')</font>
                </font>
            </h2>
            <div class="mobspot_mod">
                <h3>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_24')</font>
                    </font>
                </h3>
                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            @lang('targetcustomer.txt_detail_25')
                        </font>
                    </font>
                </p>
            </div>
            <div class="mobspot_mod">
                <h3>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_26')</font>
                    </font>
                </h3>
                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            @lang('targetcustomer.txt_detail_27')
                        </font>
                    </font>
                </p>
            </div>
            <div class="mobspot_mod">
                <h3>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_28')</font>
                    </font>
                </h3>
                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            @lang('targetcustomer.txt_detail_29')
                        </font>
                    </font>
                </p>
            </div>
        </div>
    </div>

    <div class="row mobspot_esempi">
        <h2>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_30')</font>
            </font>
        </h2>
        <div class="mobspot_esempio">
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> @lang('targetcustomer.txt_detail_24')</font>
                </font>
            </h3>
            <img src="../../img/esempicamp/es_std.png">
        </div>
        <div class="mobspot_esempio">
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_26')</font>
                </font>
            </h3>
            <img src="../../img/esempicamp/es_pers.png">
        </div>
        <div class="mobspot_esempio">
            <h3>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> @lang('targetcustomer.txt_detail_28')</font>
                </font>
            </h3>
            <img src="../../img/esempicamp/es_int.png">
        </div>
    </div>

    <div class="row mobspot_utenza mobspot--blue">
        <div class="mobspot_utenza_title">
            <img src="../../img/icomobspot/ico-esempiutilizzo.png">
        </div>
        <div class="mobspot_utenza_desc">
            <ul class="mobspot_utenza_row">
                <li>
                    <div class="utenza">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_31')</font>
                        </font>
                    </div>
                    <div class="utenza_arrow"></div>
                </li>
                <li class="utenza2">
                    <div class="utenza">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_32')</font>
                        </font>
                    </div>
                    <div class="utenza_arrow"></div>
                </li>
                <li class="utenza3">
                    <div class="utenza">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_33')</font>
                        </font>
                    </div>
                    <div class="utenza_arrow"></div>
                </li>
            </ul>
            <ul class="mobspot_utenza_row">
                <li>
                    <div class="utenza">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_34')</font>
                        </font>
                    </div>
                    <div class="utenza_arrow"></div>
                </li>
                <li>
                    <div class="utenza">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_35')</font>
                        </font>
                    </div>
                    <div class="utenza_arrow"></div>
                </li>
            </ul>
        </div>
    </div>

    <div class="row mobspot_fondo">
        <div class="dx">
            <h2>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_36')</font>
                </font>
            </h2>
            <a href="/pages/guideline" class="bt bt-arancio">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_18')</font>
                </font>
            </a>
        </div>
        <div class="sx">
            <h2>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_37')</font>
                </font>
            </h2>
            <a href="/users/register" class="bt bt-arancio">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('targetcustomer.txt_detail_38')</font>
                </font>
            </a>
        </div>
    </div>

    {{-- <div class="row mobspot_docs">
        <h3>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Download documents list</font>
            </font>
        </h3>
        <a href="https://www.rdcom.it/docs/upload/WhitePaper_SMSADV.pdf" target="_blank">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">White Paper: SMS Advertising Opportunities, best practices
                    and success stories</font>
            </font>
        </a>
    </div> --}}
    <!--<div class="row">
</div>-->
</div>
@endsection
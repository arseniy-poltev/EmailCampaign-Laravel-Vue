@extends('home.layouts.app')
@section('contents')

<div align="center"></div>
<div class="row splash_planningADV">
    <h1>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">@lang('planingdev.txt_plan_detail_1')</font>
        </font>
    </h1>

    <h2>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">@lang('planingdev.txt_plan_detail_2')</font>
        </font>
    </h2>

</div>

<div class="container row">

    <p>
        <font style="vertical-align: inherit;">
            @lang('planingdev.txt_plan_detail_3')
        </font>
    </p>
    <p>
        <font style="vertical-align: inherit;">
            @lang('planingdev.txt_plan_detail_4')
        </font>
    </p>
    <p>
        <font style="vertical-align: inherit;">
            @lang('planingdev.txt_plan_detail_5')
        </font>
    </p>
    <p>
        <font style="vertical-align: inherit;">
            @lang('planingdev.txt_plan_detail_6')
        </font>
    </p>

    {{-- <p>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">Write to us at </font>
        </font><a href="mailto:advertising@rdcom.it" style="color: #ec7e4b">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">advertising@rdcom.it</font>
            </font>
        </a>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;"> or call 045-8841199.</font>
        </font>
    </p> --}}

</div>
@endsection
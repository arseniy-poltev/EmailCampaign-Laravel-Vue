@extends('home.layouts.app')
@section('contents')

<div align="center"></div>
<div class="row lineeguida">

    <div class="title_bar">
        <h1>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    @lang('guideline.txt_guide_name') </font>
            </font><br>
            <div class="trattino"></div>
        </h1>
    </div>
    <div class="container">
        <h2>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">@lang('guideline.txt_guide_title')</font>
            </font>
        </h2>

        <ol>
            <li>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_1')
                    </font>
                </font>
                <p>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            @lang('guideline.txt_guide_1_detail_1')
                        </font>
                        </b>
                        <font style="vertical-align: inherit;">
                            @lang('guideline.txt_guide_1_detail_2')
                        </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_1_detail_3')
                    </font>
                </p>
            </li>
            <li>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_2')
                    </font>
                </font>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_2_detail_1')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_2_detail_2')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_2_detail_3')
                    </font>
                    </b>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_2_detail_4')
                    </font>
                </p>
            </li>
            <li>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_3')
                    </font>
                </font>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_3_detail_1')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_3_detail_2')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_3_detail_3')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_3_detail_4')
                    </font>
                </p>
            </li>
            <li>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_4')
                    </font>
                </font>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_4_detail_1')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_4_detail_2')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_4_detail_3')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_4_detail_4')
                    </font>
                </p>
                <p>
                    <font style="vertical-align: inherit;">
                        @lang('guideline.txt_guide_4_detail_5')
                    </font>
                </p>
            </li>
        </ol>

        <p class="lineeDisclaimer">
            @lang('guideline.txt_guide_extra')
        </p>
    </div>
</div>


<!--<div class="row">
</div>-->

@endsection
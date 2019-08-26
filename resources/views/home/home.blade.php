@extends('home.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ url('/css/jquery-jvectormap-2.0.3.css') }}" type="text/css">
<style>
    #btnBackToWMap {
        float: right;
        padding-top: 15px;
    }
</style>
@endsection
@section('extra-header')
<div class="slider-bg">
    <div class="row">
        <div id="home-slider" class="royalSlider rsMinW">
            <div class="rsContent">
                <div class="bContainer">
                    <span class="rsABlock span1" data-speed="1000" data-delay="0"
                        data-move-effect="none">@lang('home.txt_img_text1')</span>
                </div>
            </div>
            <div class="rsContent">
                <div class="bContainer">
                    <span class="rsABlock span1" data-speed="1000" data-delay="0"
                        data-move-effect="none">@lang('home.txt_img_text2')</span>
                </div>
            </div>
            <div class="rsContent">
                <div class="bContainer">
                    <span class="rsABlock span1" data-speed="1000" data-delay="0"
                        data-move-effect="none">@lang('home.txt_img_text3')</span>
                </div>
            </div>
            <div class="rsContent">
                <div class="bContainer">
                    <span class="rsABlock span1" data-speed="1000" data-delay="0"
                        data-move-effect="none">@lang('home.txt_img_text4')</span>
                    <span class="rsABlock span2" data-delay="800" data-speed="1000"
                        data-move-effect="none">@lang('home.txt_img_text5')</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="slider-bg-alt">
    <div class="row">
        <h1>@lang('home.txt_img_text1')</h1>
    </div>
</div>
@endsection

@section('contents')
<form action="/pages/create" id="profiler_form" method="post" accept-charset="utf-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
    <div id="profiler" class="clearfix row">
        <p class="profiler_title">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">@lang('home.txt_filter_desc')</font>
            </font>
        </p>
        <div class="profiler_form">
            <div class="col_sx">
                <!-- start box sesso -->
                <div class="box box_sesso">
                    <div class="title_bar_prof clearfix">
                        <p class="title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">1. @lang('home.txt_sex')</font>
                            </font>
                        </p>
                    </div>
                    <div class="box_pad">
                        <div class="input radio">
                            <ul>
                                <li><input type="hidden" name="data[Pages][sesso]" id="PagesSesso_" value="0"><input
                                        type="radio" name="data[Pages][sesso]" id="PagesSesso2" value="2"><label
                                        for="PagesSesso2">@lang('home.txt_female')</label></li>
                                <li><input type="radio" name="data[Pages][sesso]" id="PagesSesso1" value="1"><label
                                        for="PagesSesso1">@lang('home.txt_male')</label></li>
                                <li><input type="radio" name="data[Pages][sesso]" id="PagesSesso" value="2"
                                        checked="checked"><label for="PagesSesso">@lang('home.txt_both_sex')</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end box sesso -->

                <!-- start box età  -->
                <div class="box box_eta" style="margin-bottom: 20px;">
                    <div class="title_bar_prof clearfix">
                        <p class="title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">2. @lang('home.txt_age_group')&nbsp;</font>
                            </font>
                        </p>
                    </div>
                    <div class="box_pad">
                        <input type="hidden" id="idetada" name="data[Pages][etada]" value="18">
                        <input type="hidden" id="idetaa" name="data[Pages][etaa]" value="66+">

                        <div id="profiler_eta" class="clearfix">
                            @lang('home.txt_age_desc1')
                            <select id="minAgeSel">
                                <option value="18">18</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                            </select>
                            @lang('home.txt_age_desc2')
                            <select id="maxAgeSel">
                                <option value="66+">66+</option>

                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                                <option value="66+">66+ </option>

                            </select>
                            @lang('home.txt_age_desc3')
                        </div>

                        <p>
                            {{-- <b>La fascia d'età selezionata è <span id="profiler_eta_value">18/66+</span> anni</b> --}}
                        </p>

                    </div>
                </div>
                <div class="box box_sesso">
                    <div class="title_bar_prof clearfix">
                        <p class="title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">3. @lang('home.txt_area')</font>
                            </font>
                        </p>
                    </div>
                    <div class="box_pad">
                        <div class="riepilogo" style="position: relative;">
                            <p>@lang('home.txt_selected_area')</p>
                            <div id="reset">
                                <span id="btnresetall" hidden
                                    style="text-decoration: underline; cursor: pointer; position: absolute; right: 10px; top: 15px; font-size: smaller">@lang('home.txt_clear_selection')</span>
                            </div>
                            <div id="profiler_summary">
                                <ul id="profiler_prov_selected">


                                </ul>
                                <ul id="profiler_cap_selected"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end box età  -->
            </div>
            <div class="col_dx">
                <div class="box box_area">
                    <div class="title_bar_prof clearfix">
                        <p class="title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">@lang('home.txt_select_area')</font>
                            </font>
                        </p>
                        <ul class="menu" id="profiler_zona_menu">
                            <li><a href="#profiler_mappa" class="active">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">@lang('home.txt_map')</font>
                                    </font>
                                </a></li>
                            <li><a href="#profiler_cap">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">@lang('home.txt_postal_code')</font>
                                    </font>
                                </a></li>
                            <li><a href="#profiler_prov_list">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">@lang('home.txt_province_list')</font>
                                    </font>
                                </a></li>
                        </ul>
                    </div>
                    <div class="box_pad map_view_wrapper clearfix">
                        <div id="profiler_mappa">
                            <div id="world-map" style="width: 100%; height: 450px"></div>
                            {{-- <div id="one-continent" style="width: 100%; height: 400px" hidden></div> --}}
                            <div id="country-map" style="width: 100%; height: 416px" hidden></div>
                            <a href="#" id="btnBackToWMap" hidden>@lang('home.txt_back_map')</a>
                        </div>
                        <div id="profiler_cap">
                            <input type="text" id="profiler_new_code" class="style input-postal"
                                placeholder="Postal Code">
                            <button id="btnCodeAdd" type="button"
                                class="bt bt-small orange btn-add-postal">@lang('home.txt_btn_add')</button>
                        </div>
                        <div id="profiler_prov_list">
                            <p id="state_loading" hidden>@lang('home.txt_loading')</p>
                            <ul id="state_list">
                                <li>

                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="profiler_bottom" class="row">
        <div id="profiler_result">
            <p id="profiler_result_title_pers" style="display:inline-block; width: 250px !important; top:13px;" hidden>
                {{-- <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;" hidden>
                        For </font>
                </font><br>
                <font style="vertical-align: inherit;" hidden>
                    <font style="vertical-align: inherit;">Custom </font>
                    <font style="vertical-align: inherit;">Sender </font>
                    <font style="vertical-align: inherit;">:</font>
                </font><br>
                <strong id="profiler_result_value_pers" style="font-size: 30px !important;" hidden>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">1392786</font>
                    </font>
                </strong> --}}
            </p>
            <p id="profiler_result_title" style="display: inline-block; width: 250px !important;">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('home.txt_recipient')</font>
                </font><br><br>
                <strong id="profiler_result_value">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">2015600</font>
                    </font>
                </strong>
            </p>
            <p id="profiler_result_title_inter" style="display:inline-block; width: 250px !important; top:13px;" hidden>
                {{-- <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        For </font>
                </font><br>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">interactive </font>
                    <font style="vertical-align: inherit;">campaigns </font>
                    <font style="vertical-align: inherit;">:</font>
                </font><br>
                <strong id="profiler_result_value_inter" style="font-size: 30px !important;">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">1392786</font>
                    </font>
                </strong> --}}
            </p>
        </div>
        <button type="button" class="bt bt-arancio" id="btnSubmitProcess">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">@lang('home.txt_search')</font>
            </font>
        </button>
        <br><br>
        <div id="profiler_result_btn_submit">
            <button type="submit" class="bt bt-arancio" id="btnSubmitProcediCampaign" style="display: inline-block;">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('home.txt_create_campaign') </font>
                </font><br><span>
                    {{-- <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">using part or all of your contacts</font>
                    </font> --}}
                </span>
            </button>
            <div class="row" id="esito_inferiore_1000" style="display: none;">
                <p class="profiler_title">
                    <font style="vertical-align: inherit;" hidden>
                        <font style="vertical-align: inherit;">CONTACTS EXTRACTED FROM THE EXECUTED RESEARCH ARE NOT
                            SUFFICIENT TO CREATE A CAMPAIGN (MINIMUM 1000 CONTACTS)</font>
                    </font>
                </p>
            </div>
        </div>
    </div>
    <div id="box-question">
        <div id="pannello_comuni" title="Common search" style="display: none;">
            <p style="font-family:Arial; font-size:13px">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Enter the name of the municipality or part of it to search
                        for the ZIP codes. </font>
                </font><br>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Enter at least 3 characters to perform the search.</font>
                </font>
            </p><br>
            <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><input
                name="data[Pages][ins_comune]" placeholder="Nome comune" class="style ui-autocomplete-input"
                id="ins_comune" type="text" autocomplete="off"> <button id="btncercacomuni" type="button"
                class="bt bt-comuni" disabled="">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">SEARCH FOR</font>
                </font>
            </button>
            <p></p>
            <p id="pausa_cerca" style="font-family:Arial; font-size:13px"></p><br>
            <div id="risultato_comuni" style="display: none;">
                <table id="tabella_ris_comuni" class="tab_ris_comuni" style="width:550px">
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <h2>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">@lang('home.app_name')</font>
        </font>
    </h2>
    <font style="vertical-align: inherit;">
        <font style="vertical-align: inherit;">
            @lang('home.txt_app_desc1')
        </font>
    </font>
    <div class="clearfix" id="home-3box">
        <div class="box boxAdv">
            <div class="pad">
                <div class="bg">
                    <h2>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('home.txt_planner')</font>
                        </font>
                    </h2>
                    <p>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                @lang('home.txt_app_desc2')
                            </font>

                        </font>
                    </p>
                    <p align="center"><a href="/pages/planningadv" class="bt bt-arancio">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">@lang('home.txt_support')</font>
                            </font>
                        </a> </p>
                </div>
            </div>

        </div>
        <div class="box boxRiv">
            <div class="pad">
                <div class="bg">
                    <h2>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('home.txt_collaborate')</font>
                        </font>
                    </h2>
                    <p>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('home.txt_app_desc3')</font>
                        </font>
                    </p>
                    <p align="center"><a href="/pages/contacts" class="bt bt-arancio">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">@lang('home.txt_retailers')</font>
                            </font>
                        </a> </p>
                </div>
            </div>

        </div>
        <div class="box boxPromo">
            <div class="pad">
                <div class="bg">
                    <a href="http://www.rdcom.it/it/pacchetti/top=sms/ric=21/umson=1"><img
                            src="/img/upload/1406100400_blockhome.jpg" alt="Promo"></a> </div>
            </div>

        </div>
        <div class="box">
            <div class="pad">
                <div class="bg">
                    <h2>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('home.txt_buy_online')</font>
                        </font>
                    </h2>
                    <p>
                        <font style="vertical-align: inherit;">

                            @lang('home.txt_app_desc4')

                        </font>
                    </p>
                    <p align="center">
                        {{-- <a href="#" target="_blank" class="bt bt-arancio">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Online shop</font>
                            </font>
                        </a> --}}
                    </p>
                </div>
            </div>
        </div>

    </div>
    <img src="/img/loader-profiler.gif" alt="" hidden />
    <div class="clearfix" id="home-2box">
        <div class="box_sx">
            <div class="pad">
                <h3>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@lang('home.txt_testimonials')</font>
                    </font>
                </h3>
            </div>
        </div>
        <div class="box_dx">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    @lang('home.txt_app_desc5')
                </font>
            </font><a href="/pages/testimonials">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('home.txt_real_all')</font>
                </font>
            </a>
        </div>
    </div>
</div>
<div id="content-credits">
    {{-- <div class="row">
        <div class="clearfix" id="home-2box">
            <div class="box_sx">
                <div class="pad">
                    <img src="/img/logo-rdcom_new.png" alt="Rdcom" class="logo-home"> </div>
            </div>
            <div class="box_dx">
                <strong>mobspot.it</strong> è un servizio di rdcom.it, azienda che dal 2000 fornisce soluzioni complete
                di comunicazione e advertising tramite invio e ricezione di messaggi SMS, MMS e EMAIL in Italia e
                all'estero. </div>
        </div>
    </div> --}}
</div>

@endsection

@section('javascript')
<script type="text/javascript" src={{ url('/js/jquery-jvectormap-2.0.3.min.js')}}></script>
<script type="text/javascript" src={{ url('/js/maps/jquery-jvectormap-world-mill.js')}}></script>

{{--  <script type="text/javascript" src={{ url('/js/maps/jquery-jvectormap-europe-mill.js')}}></script>
<script type="text/javascript" src={{ url('/js/maps/jquery-jvectormap-es-mill.js')}}></script>
<script type="text/javascript" src={{ url('/js/maps/jquery-jvectormap-fr-mill.js')}}></script>
<script type="text/javascript" src={{ url('/js/maps/jquery-jvectormap-it-mill.js')}}></script>
<script type="text/javascript" src={{ url('/js/maps/jquery-jvectormap-de-mill.js')}}></script>
<script type="text/javascript" src={{ url('/js/maps/jquery-jvectormap-pt-mill.js')}}></script> --}}
@foreach ($maps as $map)
<script type="text/javascript" src={{ url($map->map_file_url)}}></script>
@endforeach

<script>
    var isWorldMap = true;
    var urlProcedi = "/pages/getCount";
    var worldMap, countryMap;
    var yourInfo = null;
    var selectedRegion = [];
    var allStates = [];
    var selectedCountry = null;
    var stateLoading = false;
    var genderArr = ['male','female','both'];
    var mapData = [];
    var activeCountry = [];
    //Select tab
    $('#profiler_zona_menu a').on('click', function(e) {
        e.preventDefault();
        // de-active
        var active = $('#profiler_zona_menu a.active');
        active.removeClass('active');
        active = active.attr('href');
        $(active).hide()
        // active
        $(this).addClass('active')
        var h = $(this).attr('href')
        $(h).show();
    });   

    function setLoading(){
        $('#btnSubmitProcediCampaign').hide();
        $("#btnSubmitProcess").hide();
        $("#profiler_result_value").html('<img src="/img/loader-profiler.gif" alt="" />');
        $("#profiler_result_value_pers").html('<img src="/img/loader-profiler.gif" alt="" />');              
        $("#profiler_result_value_inter").html('<img src="/img/loader-profiler.gif" alt="" />');             
    }
    function getRecordCount(){
        var sex = genderArr[$("input[name='data[Pages][sesso]']:checked").val()];
        var minAge = $("#minAgeSel").val();
        var maxAge = $("#maxAgeSel").val();
        if(minAge > maxAge){
            alert("Please select correct age range!");
            return;
        }
        if(!selectedCountry){
            alert("Please select country!");
            return;
        }
        setLoading();
        
        if(countryMap){
            //selectedRegion = countryMap.getSelectedRegions();
        }
        console.log({
            sex: sex,
            minAge: minAge,
            maxAge: maxAge,
            country: selectedCountry,
            region: selectedRegion
        });
        $.ajax({
            type:   "get",
            url:    urlProcedi,
            cache:  false,
            data:   {
                sex:        sex,
                minAge:     minAge,
                maxAge:     maxAge,
                country:    selectedCountry,
                region:     selectedRegion
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                //$('#btnSubmitProcediCampaign').hide();
                $('#esito_inferiore_1000').hide();
                var minimo=1000;
                var personalizzato=0;
                $("#profiler_result_value").text(data.recipients);
                $("#profiler_result_value_pers").text(data.campaigns);
                $("#profiler_result_value_inter").text(data.senders);
                $("#btnSubmitProcess").show();
                $('#btnSubmitProcediCampaign').show();
                if(data.recipients > 0){
                    //$('#btnSubmitProcediCampaign').show();
                }
                /*
                if (parseInt(data.recipients.replace(/\./g, '')) > 0){
                    var creditoUtente = parseInt('0');
                    if ((parseInt(data.recipients.replace(/\./g, '')) >= parseInt(minimo)) ||
                        (parseInt(data.recipients.replace(/\./g, '')) >= parseInt(creditoUtente) && parseInt(creditoUtente) > 0) ||
                        (personalizzato == 1 && parseInt(data.recipients.replace(/\./g, '')) > 0)){
                            $('#btnSubmitProcediCampaign').show();
                        }
                    else{
                        $('#esito_inferiore_1000').show();
                    }
                    $("#profiler_result_value").text(data.recipients);                                                                          
                    $("#profiler_result_value_pers").text(data.campaigns);                                                  
                    $("#profiler_result_value_inter").text(data.senders); 
                }
                else{
                    $('#btnSubmitProcediCampaign').hide();
                    $("#profiler_result_value").text(data.descrizione);
                    $("#profiler_result_value_pers").text(data.descrizione);                          
                    $("#profiler_result_value_inter").text(data.descrizione);                     
                }
                */
            },
            error: function(xhr, textStatus, error) {
                $("#profiler_result_value").text('Errore durante la fase di verifica, riprovare');
                $("#profiler_result_value_pers").text('Errore durante la fase di verifica, riprovare');                      
                $("#profiler_result_value_inter").text('Errore durante la fase di verifica, riprovare');                     
                $('#btnSubmitProcediCampaign').hide();
                $("#btnSubmitProcess").show();
                
            }
        });   
    }
    $('#btnSubmitProcess').on('click', function() {
        getRecordCount();
    });
    $("#btnBackToWMap").on('click',function(e){
        e.preventDefault();
        if(!isWorldMap){
            $("#country-map").fadeOut("easing",function(){
                $("#country-map").empty();
                $("#world-map").fadeIn("easing");
                isWorldMap = true;
                selectedCountry = null;
                $("#btnBackToWMap").hide();
                clearRegions();
            });
        }
    });

    $("#profiler_prov_selected").on('click','label.area-item',function(){
        //remove selected area
        var code = $(this).html()
        var index = selectedRegion.indexOf(code);
        if (index != -1) {
            selectedRegion.splice(index, 1);
            //find state
            for(var i in allStates){
                if(allStates[i]['name'] == code){
                    $("#state_list").find('#state_' + allStates[i]['id']).prop("checked", false);
                    break;
                }
            }
            $(this).remove();
            var obj = {};
            obj[code] = false;
            if (countryMap) {
                countryMap.setSelectedRegions(obj);
            }
        }
        if(selectedRegion.length == 0){
            $("#btnresetall").hide();
        }
        //showAreaList();
    });
    $("#btnresetall").click(function(){
        clearRegions();
    });
    $("#btnCodeAdd").click(function(){
        var postalCode = $("#profiler_new_code").val();
        if(postalCode == ''){
            $("#profiler_new_code").focus();
            return;
        }
        console.log(postalCode);
        var index = selectedRegion.indexOf(postalCode);
        if (index == -1) {
            selectedRegion.push(postalCode);
        }

        $("#profiler_new_code").val('');
        $("#profiler_new_code").focus();
        showAreaList();
    });
    $('#state_list').on('change','input[type="checkbox"]', function() {
        addAreaToList($(this).val());
    });

    function clearRegions() {
      selectedRegion = [];
      showAreaList();
      if (countryMap) {
        countryMap.clearSelectedRegions();
        showStateList();
      }
    }

    function drawMap(){
        var markers = [];
        if(yourInfo && yourInfo != undefined){
            var loc = yourInfo.loc.split(',');
            markers.push({
                latLng: [Number(loc[0]),Number(loc[1])],
                name: yourInfo.city
            });
            if(worldMap){
                worldMap.addMarkers(markers);
                worldMap.setFocus({region: yourInfo.country,animate: true})
            }
        }
    }
    function showAreaList(){
        $("#profiler_prov_selected").html('');
        for(var i in selectedRegion){
            var html = '<div><label class="area-item">'+ selectedRegion[i] +'</label></div>';
            $("#profiler_prov_selected").append(html);
        }
        if(selectedRegion.length > 0){
            $("#btnresetall").show();
        }else{
            $("#btnresetall").hide();
        }
    }
    function drawCountryMap(countryCode){
        var mapName = countryCode + "_mill";
        delete countryMap;
        
        countryMap = new jvm.Map({
            container: $("#country-map"),
            map: mapName,
            regionsSelectable: true,
            regionStyle: {
                initial: {
                    fill: '#656565'
                },
                selected: {
                    fill: '#F4A582'
                },
                hover:{
                    fill: '#c67900'
                }
            },
            regionLabelStyle: {
                initial: {
                    fill: 'black'
                },
                hover: {
                    fill: 'black'
                }
            },
            labels: {
                regions: {
                    render: function(code){
                        return code.split('-')[1];
                    }
                }
            },
            markerStyle:  {
                initial:{
                    fill: '#F8E23B',
                    stroke: '#383f47'
                }
            },
            backgroundColor:'#ffffff',
            onRegionClick: function(e, code){
                console.log(code);
               addAreaToList(code);
            }
        });
        if(yourInfo && yourInfo != undefined){
            var markers = [];
            var loc = yourInfo.loc.split(',');
            markers.push({
                latLng: [Number(loc[0]),Number(loc[1])],
                name: yourInfo.city
            });
            if(countryMap){
                countryMap.addMarkers(markers);
            }
        }           
    }
    function addAreaToList(code){
        var index = selectedRegion.indexOf(code);
        if (index != -1) {
            selectedRegion.splice(index, 1);
        } else {
            selectedRegion.push(code);
        }
        showAreaList();
    }
    function showCountryMap(code){
        console.log(code);
        if(mapData.indexOf(code.toUpperCase()) == -1){
            alert("We dont't support this country!");
            selectedCountry = null;
            return;
        }
        selectedCountry = code;
        $("#world-map").fadeOut("easing",function(){
            isWorldMap = false;
            $("#country-map").fadeIn("easing");
            drawCountryMap(code.toLowerCase());
            $("#btnBackToWMap").show();
        });    
    }
    function showStateList(){
        $("#state_loading").hide();
        $("#state_list").show();
        $("#state_list").html('');
        console.log(allStates);
        for(var i in allStates){
            var html = '<div class="checkbox">'+
                '<input type="checkbox" value="'+ allStates[i]['name'] +'" id="state_'+ allStates[i]['id'] +'">'+
                '<label for="state_' + allStates[i]['id'] + '">'+
                    allStates[i]['name']+'('+allStates[i]['postal_code']+')'+
                '</label>'+
            '</div>';
            $("#state_list").append(html);
        }
    }
    function getAllStates(){
        
      if (selectedCountry == null) {
        allStates = [];
        return;
      }
      allStates = [];
      $("#state_loading").show();
      $("#state_list").hide();
      $.ajax({
            type:'get',
            url:"/api/country/" + selectedCountry + "/states",
            dataType: "json",
            success:function(response){
                console.log(response);
                allStates = response.data;
                showStateList();
            },
            fail:function(error){
                console.log(error);
                showStateList();
            }
        });
    }
    function init(){
        worldMap = new jvm.Map({
            container: $('#world-map'),
            map: 'world_mill',
            markerStyle:  {
                initial:{
                    fill: '#F8E23B',
                    stroke: '#383f47'
                }
            },
            series: {
                regions: [
                    {
                        scale: {
                            active: "#dd4b39",
                            not: "#656565"
                        },
                        attribute: "fill",
                        values: activeCountry,
                        legend: {
                            horizontal: true,
                            title: "Recommened"
                        }
                    }
                ]
            },
            regionStyle: {
                initial: {
                    fill: '#656565'
                },
                selected: {
                    fill: '#F4A582'
                },
                hover:{
                    fill: '#c67900'
                }
            },
            backgroundColor:'#ffffff',
            onRegionClick: function(e, code){
                var temp = selectedCountry;
                showCountryMap(code);
                if(temp != code){
                    getAllStates();
                }
                
            }
        })
        
    }
    function getLocation(){
        $.ajax({
            type:'get',
            url:'https://ipinfo.io/json?token=ec390afea81cee',
            dataType: "jsonp",
            success:function(resp){
                console.log(resp);
                var countryCode = resp && resp.country ? resp.country : "";
                yourInfo = resp;
                selectedCountry = countryCode;
                drawMap(resp);
                getAllStates();
                getRecordCount();
            },
            fail:function(error){
                console.log(error);
            }
        });
    }

    $(function(){
        setLoading();
        $.ajax({
            type:'get',
            url:"/api/get_country_info",
            dataType: "json",
            success:function(response){
                console.log(response);
                mapData = response.data.map;
                activeCountry = response.data.active;
                init();
                getLocation();
            },
            fail:function(error){
                console.log(error);
            }
        });
        
    });
</script>
@endsection
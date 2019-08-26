@extends('home.layouts.app')
@section('contents')
<div align="center"></div>
<div class="row" style="min-height:700px">

    <div class="title_bar">
        <h1>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    @lang('register.txt_register_title')
                </font>
            </font><br>
            <div class="trattino"></div>
        </h1>
    </div>

    <div class="container">
        <p>
            <font style="vertical-align: inherit;">
                @lang('register.txt_register_detail_1')
            </font>
        </p>
        @if (count($errors) > 0)
        <div class="alert alert-danger" style="color:brown">
            <strong>@lang('quickadmin.qa_whoops')</strong>
            @lang('quickadmin.qa_there_were_problems_with_input'):
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/users/register" class="style registration-form" id="UsersRegistrazioneForm" method="post"
            accept-charset="utf-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
            {{-- <div class="cols2 clearfix">
                <div class="col">
                    <label for="UsersNome">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">First name*</font>
                        </font><br>
                    </label><input name="data[Users][nome]" type="text" id="UsersNome"> </div>
                <div class="col">
                    <label for="UsersCognome">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Surname*</font>
                        </font><br>
                    </label><input name="data[Users][cognome]" type="text" id="UsersCognome"> </div>
            </div> --}}

            <div class="cols2 clearfix">
                <div class="col">
                    <label for="UsersEmailutente">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('register.txt_register_field_1')</font>
                        </font><br>
                    </label><input name="email" required="required" type="email" id="UsersEmailutente"> </div>
                <div class="col">
                    <label for="UsersUsername">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('register.txt_register_field_2')</font>
                        </font><br>
                    </label><input name="name" required="required" type="text" id="UsersUsername">
                    <span id="result_username" class="errors" style="display: none;"></span>
                </div>
            </div>
            <div class="cols2 clearfix">
                <div class="col">
                    <div class="input password"><label for="UsersPassword">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">@lang('register.txt_register_field_3')</font>
                            </font><br>
                        </label><input name="password" required="required" type="password" id="UsersPassword"></div>
                </div>
                <div class="col">
                    <label for="UsersConfermaPassword">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">@lang('register.txt_register_field_4')</font>
                        </font><br>
                    </label><input name="password_confirmation" required="required" type="password"
                        id="UsersConfermaPassword"> </div>
            </div>
            <div class="edit_submit">
                <input type="hidden" name="data[Users][user_exist]" id="UsersUserExist">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"><input class="bt upper bt-arancio" type="submit"
                            value="@lang('register.txt_btn_register')"></font>
                </font>
            </div>
        </form>
    </div>
    <!--<div class="row">
</div>-->
</div>
@endsection
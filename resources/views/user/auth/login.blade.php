{{-- @extends('layouts.auth') --}}
@extends('home.layouts.app')

@section('contents')
<div align="center"></div>
<div class="row" style="min-height:700px">
    <h1>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">@lang('login.txt_login_title')</font>
        </font>
    </h1>
    <p>
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">@lang('login.txt_login_detail_1')</font>
        </font>
    </p>

    <div class="cols2 line clearfix" id="login-form">
        <div class="col">
            <h2 class="dark mb-30">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('login.txt_login_detail_2')</font>
                </font>
            </h2>
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
            <form action="{{ url('users/login') }}" class="style login-form" id="UsersLoginForm" method="post"
                accept-charset="utf-8">
                <div style="display:none;">
                    <input type="hidden" name="_method" value="POST">
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="email" placeholder="Email" class="required" required="required" type="email"
                    id="UsersUsername">
                <input name="password" placeholder="Password" class="required" required="required" type="password"
                    id="UsersPassword"> <br>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"><input class="bt upper bt-arancio" type="submit"
                            value="@lang('login.txt_login_btn')"></font>
                </font>
            </form>
            {{-- <p class="recover">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Don't remember your password? </font>
                </font><a href="/users/recovery">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Click here</font>
                    </font>
                </a>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> to retrieve it</font>
                </font>
            </p> --}}
        </div>
        <div class="col">
            <h2 class="dark mb-30">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('login.txt_login_detail_3')</font>
                </font>
            </h2>
            <p class="no-account">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('login.txt_login_detail_4')</font>
                </font>
            </p><br>
            <a href="/users/register" class="bt bt-registrati upper bt-arancio">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">@lang('login.txt_signin_btn')</font>
                </font>
            </a>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">{{ ucfirst(config('app.name')) }} @lang('quickadmin.qa_login')</div>
<div class="panel-body">

    @if (count($errors) > 0)
    <div class="alert alert-danger">
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

    <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="col-md-4 control-label">@lang('quickadmin.qa_email')</label>

            <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">@lang('quickadmin.qa_password')</label>

            <div class="col-md-6">
                <input type="password" class="form-control" name="password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <a href="{{ route('auth.password.reset') }}">@lang('quickadmin.qa_forgot_password')</a>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <label>
                    <input type="checkbox" name="remember"> @lang('quickadmin.qa_remember_me')
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                    @lang('quickadmin.qa_login')
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div> --}}
@endsection
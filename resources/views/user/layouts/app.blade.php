<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.partials.head')
</head>


<body class="hold-transition skin-green sidebar-mini">

    <div id="userApp">
        <div id="wrapper">

            @include('user.partials.topbar')
            @include('user.partials.sidebar')

            <event-hub></event-hub>
            <router-view></router-view>

        </div>
    </div>

    {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
    <button type="submit">Logout</button>
    {!! Form::close() !!}

    @include('user.partials.javascripts')
</body>

</html>
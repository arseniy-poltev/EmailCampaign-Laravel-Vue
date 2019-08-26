<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>


<body class="hold-transition skin-purple sidebar-mini">

    <div id="adminApp">
        <div id="wrapper">

            @include('admin.partials.topbar')
            @include('admin.partials.sidebar')

            <event-hub></event-hub>
            <router-view :key="$route.fullPath"></router-view>

        </div>
    </div>

    {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
    <button type="submit">Logout</button>
    {!! Form::close() !!}

    @include('admin.partials.javascripts')
</body>

</html>
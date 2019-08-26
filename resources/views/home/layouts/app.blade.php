<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.partials.head')
</head>


<body>
    @include('home.partials.header')
    <div id="content">
        @yield('contents')
        {{-- <div id="wrapper">
                @include('home.partials.topbar')
                @include('home.partials.sidebar')
            </div> --}}
    </div>
    @include('home.partials.footer')
    @include('home.partials.javascripts')
</body>

</html>
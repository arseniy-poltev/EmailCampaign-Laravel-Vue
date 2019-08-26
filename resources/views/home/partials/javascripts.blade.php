{{-- Dependencies --}}

<script type="text/javascript" src={{ url('/js/jquery.js')}}></script>
<script type="text/javascript" src={{ url('/js/jquery.migrate.js')}}></script>
<script type="text/javascript" src={{ url('/js/jquery.royalslider.min.js')}}></script>
<script type="text/javascript" src={{ url('/js/jquery.selectize.min.js')}}></script>
<script type="text/javascript" src={{ url('/js/jquery.matchHeight.js')}}></script>
<script type="text/javascript" src={{ url('/js/jquery-ui-1.10.3.custom.min.js')}}></script>
<script type="text/javascript" src={{ url('/js/mobspot.js')}}></script>


{{-- Vue --}}
{{-- <script src="{{ url('/client/js/manifest.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ url('/client/js/vendor.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ url('/client/js/app.js') }}" type="text/javascript" charset="utf-8"></script> --}}

@yield('javascript')
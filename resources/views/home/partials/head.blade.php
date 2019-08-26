<meta charset="utf-8">
<title>
	{{ trans('quickadmin.quickadmin_title') }}
</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="dp-date" content="{{ config('app.date_format_moment') }}">
<meta name="dp-time" content="{{ config('app.time_format_moment') }}">
<meta name="dp-datetime" content="{{ config('app.datetime_format_moment') }}">
<meta name="app-locale" content="{{ App::getLocale() }}">
<link href="{{ url('/img/favicon.png') }}" type="image/x-icon" rel="icon" />
<link href="{{ url('/img/favicon.png') }}" type="image/x-icon" rel="shortcut icon" />
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="{{ url('/css/mobspot.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('/css/selectize.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('/css/jquery.nouislider.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('/css/royalslider.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('/css/royalslider-custom.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('/css/skins/default/rs-default.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('/css/jquery-ui.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('/css/util.css') }}" type="text/css">
<!-- Custom styles for this template -->

<!--[if lt IE 9]>
		<script type="text/javascript" src="/js/html5shiv.js"></script>		<script type="text/javascript" src="/js/respond.min.js"></script>		<![endif]-->

<script type="text/javascript" src="{{ url('/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{ url('/js/analyticstracking.js')}}"></script>
<script language="javascript">
	$(document).ready(function(){
			// Tooltip only Text
			$('.masterTooltip').hover(function(){
				// Hover over code
				var title = $(this).attr('title');
				$(this).data('tipText', title).removeAttr('title');
				$('<p class="tooltip"></p>')
				.html(title)
				.appendTo('body')
				.fadeIn('slow');
			}, function() {
				// Hover out code
				$(this).attr('title', $(this).data('tipText'));
				$('.tooltip').remove();
			}).mousemove(function(e) {
				var mousex = e.pageX + 20; //Get X coordinates
				var mousey = e.pageY + 10; //Get Y coordinates
				$('.tooltip')
				.css({ top: mousey, left: mousex })
			});
		});
</script>

<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '762724983763070');
fbq('track', "PageView");
</script>
<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=762724983763070&ev=PageView&noscript=1" /></noscript>

@yield('css')
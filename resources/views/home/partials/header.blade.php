<!-- topbar start -->
<div id="topbar" class="clearfix">
    <div class="row clearfix">
        <ul class="reset inline socials">
            {{-- <li><a href="https://www.facebook.com/pages/Rdcom/207806069236454?ref=ts" target="_blank"><img
                        src="/img/icosocial/navbar-fb.png" /></a></li>
            <li><a href="https://www.linkedin.com/company/668420" target="_blank"><img
                        src="/img/icosocial/navbar-ln.png" /></a></li>
            <li><a href="https://www.youtube.com/channel/UCVxZj2CKk_8Zjfcyge4c_Ww" target="_blank"><img
                        src="/img/icosocial/navbar-yt.png" /></a></li>
            <li><a href="https://twitter.com/Rdcom_" target="_blank"><img src="/img/icosocial/navbar-tw.png" /></a></li> --}}
        </ul>

        <ul class="reset inline user no-logged">
            <li class="login"><a href="/users/login">@lang('home.txt_login')</a></li>
            <li class="register"><a href="/users/register">@lang('home.txt_register')</a></li>
            {{-- <li class="link_rdcom link_blog"><a href="http://www.smsblog.it">Vai al blog &gt;&gt;</a></li> --}}
            {{-- <li class="link_rdcom">by <a href="http://www.rdcom.it/">rdcom.it &gt;&gt;</a></li> --}}
        </ul>
        <div id="demo">
            <div class="wrapper">
                <div class="content">
                    <ul>
                        <a href="/?locale=en">
                            <li><img src="{{ url('/img/flag/en.png') }}" />English</li>
                        </a>
                        <a href="/?locale=es">
                            <li><img src="{{ url('/img/flag/es.png') }}" />Español</li>
                        </a>
                        <a href="/?locale=fr">
                            <li><img src="{{ url('/img/flag/fr.png') }}" />Français</li>
                        </a>
                        <a href="/?locale=it">
                            <li><img src="{{ url('/img/flag/it.png') }}" />Italiano</li>
                        </a>
                        <a href="/?locale=de">
                            <li><img src="{{ url('/img/flag/de.png') }}" />German</li>
                        </a>
                    </ul>
                </div>
                <div class="parent">
                    <img src="{{ url('/img/flag/'.App::getLocale().'.png') }}" />
                    <?php
                        $languages = [ 'en' => 'English',
                                       'es' => 'Español',
                                       'fr' => 'Français',
                                       'it' => 'Italiano',
                                       'de' => 'German'];
                        echo $languages[App::getLocale()];
                    ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- topbar end -->

<!-- header start -->
<header class="clearfix">
    <div class="menu-bg">
        <div class="row clearfix">
            <div id="menu" class="clearfix">
                <a href="/" id="logo">@lang('home.app_name')</a>
                <nav>
                    <ul class="reset inline">
                        <li><a href="/pages/targetcustomer">@lang('home.app_name')</a></li>
                        <li><a href="/pages/guideline">@lang('home.txt_guide')</a></li>
                        {{-- <li><a href="/pages/download">Risorse</a></li> --}}
                        <li><a href="/pages/planningadv">@lang('home.txt_planning')</a></li>
                        {{-- <li><a href="http://www.rdcom.it/it/shop" target="_blank">Shop</a></li> --}}
                        </li>
                    </ul>
                </nav>

                <select onchange="location.href = $(this).val()" class="mobile-menu">
                    {{-- <option value="">Seleziona una pagina</option> --}}
                    <option value="/pages/targetcustomer">@lang('home.app_name')</option>
                    <option value="/pages/guideline">@lang('home.txt_guide')</option>
                    {{-- <option value="/pages/download">Risorse</option> --}}
                    <option value="/pages/planningadv">@lang('home.txt_planning')</option>
                    {{-- <option value="http://www.rdcom.it/it/shop" target="_blank">Shop</option> --}}
                </select>

            </div>
        </div>
    </div>
    @yield('extra-header')

</header>
<!-- header end -->
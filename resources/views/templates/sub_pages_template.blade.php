<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        @include('partials.head')
    </head>
    <body>
        <header class="fixed_header">
            <section class="top-banner innerPagesHeader @if(!Auth::guest()) dashboardHeader @endif">
                <div class="container">
                    <div class="row menuAndLogoCont">
                        <div class="col-md-6">
                            <div class="logo">
                                <a href="{{ url() }}"><img src="{{ asset('img/front/inner_logo-gray.png') }}" alt="Qondo" /></a>
                            </div>
                            @include('partials.logo_menu')
                        </div>
                        <div class="col-md-6">
                            @include('partials.main_menu')
                        </div>
                    </div>
                </div>
            </section>
        </header>
        @yield('page-content')
        @include('partials.footer')
    </body>
</html>
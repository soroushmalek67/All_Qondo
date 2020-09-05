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
        <section class="registerPageTopStepsCont dashboardPateTopSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-5"><h5>@yield('page_title')</h5></div>
                    @if ($userType == 1)
                        <div class="col-md-7 text-right">
                            <a href="{{url('request-service')}}" class="btn tranparentBtn transparentwhiteBtn">Post New Request</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            @yield('breadCrumps')
                            <li>@yield('page_title')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <!--changes by salman 'msgsection'-->
        @if (Input::get("msg") === 'complete-profile')
        <section class="msgsection">
            <div class="col-xs-12">
                <div class="alert alert-warning fade in text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Welcome!</strong> Please complete your profile information first at <a href='profile'>'My Profile'</a>.
                </div>
            </div>
        </section>
        @endif
        <!--changes by salman 'msgsection'-->
        
        <section class="dashboardPageSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">@include('partials.user_sidebar')</div>
                    <div class="col-md-8">@yield('page-content')</div>
                </div>
            </div>
        </section>
        @include('partials.footer')
    </body>
</html>
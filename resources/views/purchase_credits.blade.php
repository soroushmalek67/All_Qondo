@extends('templates.sub_pages_template')
@section('page-content')


        <section class="registerPageTopStepsCont dashboardPateTopSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-5"><h5>Buyer Dashboard</h5></div>
                </div>
            </div>
        </section>
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            <li>Buyer Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="dashboardPageSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 ">
                        @include('partials.user_sidebar')
                        <!-- <div class="dashboardSidebarMenuCont">
                            <ul class="dashboardSidebarMenu">
                                <li><a href="" class="dashboardLinksquote">My Quotes</a></li>
                                <li><a href="" class="dashboardLinkMyProfile">My Profile</a></li>
                                <li><a href="" class="dashboardLinkmembership">Membership</a></li>
                                <li class="active"><a href="" class="dashboardLinksAddcredit">Purchase Credits</a></li>
                                <li><a href="" class="dashboardLinkMyanalytics">BI and  analytics</a></li>
                                <li><a href="">Settings</a></li>
                                <li><a href="" class="dashboardLinkhelp">Help</a></li>
                                <li><a href="" class="dashboardLinkSignOut">Sign out</a></li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="col-md-8 dashboardMyPostedProjectsCont">
                        <h5>Purchase Credits</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="purchase-credits">
                                    <div class="title">SILVER</div>
                                    <div class="credits"><div>{{getSettings('packageOneQuotes')}}</div>Quotes</div>
                                    <div class="price"><div><span>$</span> {{getSettings('packageOnePrice')}}</div></div>
                                    <div class="pay-with">
                                        <form action="{{url('paypal')}}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="items[0][title]" value="{{getSettings('packageOneQuotes')}} Quotes">
                                            <input type="hidden" name="items[0][price]" value="{{getSettings('packageOnePrice')}}">
                                            <input type="hidden" name="items[0][quantity]" value="1">
                                            <input type="hidden" name="items[0][package]" value="bidsPackageOne">
                                            Pay With<br />
                                            <input type="image" src="{{asset('img/front/paypal.png')}}" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="purchase-credits">
                                    <div class="title">GOLD</div>
                                    <div class="credits"><div>{{getSettings('packageTwoQuotes')}}</div>Quotes</div>
                                    <div class="price"><div><span>$</span> {{getSettings('packageTwoPrice')}}</div>
                                        {{getSettings('packageTwoDiscountText')}}</div>
                                    <div class="pay-with">
                                        <form action="{{url('paypal')}}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="items[0][title]" value="{{getSettings('packageTwoQuotes')}} Quotes">
                                            <input type="hidden" name="items[0][price]" value="{{getSettings('packageTwoPrice')}}">
                                            <input type="hidden" name="items[0][quantity]" value="1">
                                            <input type="hidden" name="items[0][package]" value="bidsPackageTwo">
                                            Pay With<br />
                                            <input type="image" src="{{asset('img/front/paypal.png')}}" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@include('partials.footer_form')
@endsection
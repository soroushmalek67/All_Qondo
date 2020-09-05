@extends('templates.supplier_profile_template')
@section('page-content')


        <section class="registerPageTopStepsCont dashboardPateTopSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-5"><h5>Membership</h5></div>
                </div>
            </div>
        </section>
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            <li>Membership</li>
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
                    </div>
                    <div class="col-md-8 dashboardMyPostedProjectsCont dashboardMembershipCont">
                        <h5>Membership</h5>
<!--                        <div class="row">
                            <div class="col-md-12">
                                <div class="membership-page">
                                    <div class="title">EXCLUSIVE MEMBERSHIP BENEFITS</div>
                                    <div class="text-lines"><strong>Unlimitted</strong> To Send Quotes In<br /> just <span>$500</span>/Month</div>
                                    <div class="price"><a href="">Buy A Membership</a></div>
                                    <div class="pay-with"><img src="{{ asset('img/front/paypal2.png') }}" alt="" /></div>
                                </div>
                            </div>
                        </div>-->
                                    @include("partials.form_errors")
                        <div class="row">
                            <div class="col-md-4">
                                <div class="purchase-credits">
                                    <form action="{{url('paypal')}}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="items[0][title]" value="{{getSettings('packageOneQuotes')}} Quotes">
                                        <input type="hidden" name="items[0][price]" value="{{getSettings('packageOnePrice')}}">
                                        <input type="hidden" name="items[0][quantity]" value="1">
                                        <input type="hidden" name="items[0][package]" value="bidsPackageOne">
                                        
                                        <input type="hidden" name="items[1][title]" value="{{getSettings('packageTwoQuotes')}} Quotes">
                                        <input type="hidden" name="items[1][price]" value="{{getSettings('packageTwoPrice')}}">
                                        <input type="hidden" name="items[1][quantity]" value="1">
                                        <input type="hidden" name="items[1][package]" value="bidsPackageTwo">
                                        
                                        <div class="title">Pro</div>
                                        <div class="credits"><div><span>$</span>{{getSettings('packageOnePrice')}}</div></div>
                                        <div class="price">
                                            <p>
                                                <input type="radio" name="quotesPkg" value="basic" checked/> 
                                                <span><b>{{getSettings('packageOneQuotes')}}</b></span> quotes</p>
                                            {!!getSettings('proPackageOfferings')!!}
                                            <p>
                                                <input type="radio" name="quotesPkg" value="advance"/> 
                                                (${{getSettings('packageTwoPrice')}} for {{getSettings('packageTwoQuotes')}} Quotes, 
                                                <b>{{getSettings('packageTwoDiscountText')}}</b>)</p>
                                        </div>
                                        <div class="pay-with">Pay With<br /><input type="image" src="{{asset('img/front/paypal.png')}}" /></div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="purchase-credits">
                                    <div class="title">Enterprise</div>
                                    <div class="credits"><div><span>$</span>{{getSettings('enterprisePackagePrice')}}</div>/month</div>
                                    <div class="price">
                                        {!!getSettings('enterprisePackageOfferings')!!}
                                    </div>
                                    <div class="pay-with">
                                        <form action="{{url('paypal')}}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="items[0][title]" value="Enterprise Membership">
                                            <input type="hidden" name="items[0][price]" value="{{getSettings('enterprisePackagePrice')}}">
                                            <input type="hidden" name="items[0][quantity]" value="{{$subscrption_mnth}}">
                                            <input type="hidden" name="items[0][package]" value="monthlySubscriptionEnterprise">
                                            Pay With<br />
                                            <input type="image" src="{{asset('img/front/paypal.png')}}" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="purchase-credits">
                                    <div class="title">Dedicated</div>
                                    <div class="credits"><br/>Contact for pricing<div></div></div>
                                    <div class="price">
                                        {!!getSettings('dedicatedPackageOfferings')!!}
                                    </div>
                                    <div class="pay-with"><a href="{{url('dedicated-membership-request')}}" class="btn">Request a Demo</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
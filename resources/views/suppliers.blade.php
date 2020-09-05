<!DOCTYPE html>
<html>
    <head>
        @include('partials.head')
    </head>
    <body>
        @include('partials.outdated_browser')
        <header class="fixed_header">
            <section class="top-banner innerPagesHeader @if(!Auth::guest()) dashboardHeader @endif">
                <div class="container">
                    <div class="row menuAndLogoCont">
                        @include('partials.header_menu')
                    </div>
                </div>
            </section>
        </header>
        <section class="homeHeaderSection supplierHeaderSection">
                <section class="top-banner @if(!Auth::guest()) dashboardHeader homepageLogedinHeader @endif">
                    <div class="container">
                        <div class="row menuAndLogoCont">
                            <div class="col-md-12 text-center">
                                <div class="banner-text">
                                    <h2>Reach Quality Customers</h2>
                                    <h4>Connect with the right leads</h4><br/>
                                    <p><a id="get_started" class="btn">GET STARTED</a><p>
                                    <h6>+1 855 782 6882</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </section>
        <section class="supplierSection supplierSection1">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-justify">
                        <h2 class="text-center">Acquire direct customers with less effort</h2><br/>
                        <p>Reaching greater numbers of potential customers is one of the highest priorities of companies that provide business services. 
                            Local or regional networks often provide a good foundation for initial customer engagement, but fully utilizing those 
                            networks and expanding on them to tap into larger customer channels can be unrealistic for small companies. Even for larger 
                            companies that employ dedicated sales and marketing staff, it can be challenging to reach and attract enough of the right 
                            type of customers.</p>
                        <p>QONDO marketplace allows service providers to maximize their selling potential by creating direct connections between 
                            them and the right type of interested customers.</p><br/><br/>
                        <div class="row text-justify">
                            <div class="col-md-4">
                                <div class="smallBubble">
                                    <div class="divTable">
                                        <div class="col-md-3"><img src="{{url('img/front/supplier_ideal_customers_icon.png')}}" alt=""/></div>
                                        <div class="col-md-9">
                                            <h3>Real Customers</h3>
                                            <p>The QONDO marketplace brings real leads to the table that are actively looking to purchase services.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="smallBubble">
                                    <div class="divTable">
                                        <div class="col-md-3"><img src="{{url('img/front/supplier_your_criteria_icon.png')}}" alt=""/></div>
                                        <div class="col-md-9">
                                            <h3>Your Criteria</h3>
                                            <p>Once you register your company on QONDO and indicate your preferences, you will get linked with the 
                                                customers that match your offerings so you’ll save time filtering out bad leads.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="smallBubble">
                                    <div class="divTable">
                                        <div class="col-md-3"><img src="{{url('img/front/supplier_notification_icon.png')}}" alt=""/></div>
                                        <div class="col-md-9">
                                            <h3>Get Notified</h3>
                                            <p>No need to constantly check your QONDO dashboard for updates on customers. You’ll receive email 
                                                notifications when there are changes you need to know about.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="supplierSection supplierSection3">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h2>Save time and effort with powerful marketplace sales analytics</h2>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <p class="text-center"><img src="{{url('img/front/supplier_section_img.jpg')}}" width="100%" alt=""/></p>
        </section>
        <section class="supplierSection supplierSection3 supplierSectionColered">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-justify">
                        <h2 class="text-center">Understand your competitive landscape and boost your brand reputation</h2><br/>
                        <p>QONDO consolidates large amounts of business ecosystem data and, more importantly, helps you make sense of it. Where does 
                            your company fit, who should you be watching out for, and where are your ideal customers?  When you can answers these 
                            questions, you can develop a more focused strategy and brand - and use QONDO to help get the word out.</p><br/><br/>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="smallBubble">
                                    <div class="divTable">
                                        <div class="col-md-3"><span class="circleForNumber">1</span></div>
                                        <div class="col-md-9">
                                            <p>Tell us about the customers you want to reach</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="smallBubble">
                                    <div class="divTable">
                                        <div class="col-md-3"><span class="circleForNumber">2</span></div>
                                        <div class="col-md-9">
                                            <p>Evaluate your target customer ecosystems – who are they and how can you better reach them?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="smallBubble">
                                    <div class="divTable">
                                        <div class="col-md-3"><span class="circleForNumber">3</span></div>
                                        <div class="col-md-9">
                                            <p>Use QONDO marketplace to advertise your company to the most interested customers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="serviceplans" class="suppliers_membership clearfix">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <h2  class="text-center">Service plans</h2>
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="purchase-credits">
                                <div class="title">Free</div>
                                <div class="credits"><div><span>$0</span></div></div>
                                <div class="price">
                                    <p><span class="glyphicon glyphicon-ok"></span>Unlimited categories</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Basic profile</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Email notification</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Online support</p>
                                </div>
                                <div class="pay-with"><a href="{{url('auth/register')}}" class="btn">Sign Up</a></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="purchase-credits">
                                <form action="{{url('paypal')}}" method="post">
                                    <div class="title">Pro</div>
                                    <div class="credits"><div><span>$99</span></div></div>
                                    <div class="price">
                                        <p><span class="glyphicon glyphicon-ok"></span>Pay per quote</p>
                                        <p><span class="glyphicon glyphicon-ok"></span>Upto 10 quotes</p>
                                        <p><span class="glyphicon glyphicon-ok"></span>Unlimited categories</p>
                                        <p><span class="glyphicon glyphicon-ok"></span>Product/service showcase</p>
                                        <p><span class="glyphicon glyphicon-ok"></span>Advance profile</p>
                                        <p><span class="glyphicon glyphicon-ok"></span>Email & SMS notification</p>
                                        <p><span class="glyphicon glyphicon-ok"></span>Email support</p>
                                    </div>
                                    <div class="pay-with"><a href="{{url('auth/register')}}" class="btn">Sign Up</a></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="purchase-credits">
                                <div class="title">Enterprise</div>
                                <div class="credits"><div><span>$199<sup>/mo</sup></span></div></div>
                                <div class="price">
                                    <p><span class="glyphicon glyphicon-ok"></span>Unlimited quotes</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Unlimited categories</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Promotional adds</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Product/service showcase</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Custom profile</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Embedded analytics</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Email & SMS notification</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Dedicated support</p>
                                </div>
                                <div class="pay-with"><a href="{{url('auth/register')}}" class="btn">Sign Up</a></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="purchase-credits">
                                <div class="title">Dedicated</div>
                                <div class="credits"><br/>Contact for pricing<div></div></div>
                                <div class="price">
                                    <p><span class="glyphicon glyphicon-ok"></span>Unlimited quotes</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Unlimited categories</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Promotional adds</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Multi-users accounts</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Product/service showcase</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Custom profile</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Custom platform with API</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Email & SMS notification</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Custom analytics</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Dedicated support</p>
                                    <p><span class="glyphicon glyphicon-ok"></span>Dedicated account manager</p>
                                </div>
                                <div class="pay-with"><a href="{{url('contact-us')}}" class="btn">Request a Demo</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        @include('partials.footer')
        <script>
            $(function(){
                
                $('#get_started').click(function(){
                    $("html, body").animate({ scrollTop: $('#serviceplans').offset().top - 90 }, 1000);
                    return false;
                });
            });
        </script>
    </body>
</html>
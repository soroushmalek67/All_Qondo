@extends('templates.sub_pages_template')
@section('page-content')
        <section class="howItWorksheader frontpage_section">
           
            <div class="container">
                    <div class="row ">
                        <div class="banner-text how-qondo-works-banner-txt">
                            <h2 class="text-center">How QONDO Works</h2>
                           
                            
                            
                        </div>
                    </div>
                </div>
           
        </section>

        <section class="howItWorks-staratManagers">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>HOW IT WORKS FOR STRATA MANAGERS</h1>
                        <div class="staratManagers-content">
                            <ul>
                                <li> Verified network of vetted contractors for property managers. </li>
                                <li> Day-to-day and premium services.</li>
                                <li> On-demand property repair.</li>
                                <li> Fast turnaround time on all requests in 48 hours.</li>
                                <li> Request for multiple quotes from different vendors.</li>
                                <li> Use our mobile app to send on-demand requests, it makes your life super easy!</li>
                                <li> Happy condo owners/residents and strata councils!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     
<!--        <section id="howItWorks" class="works howItWorks">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1>HOW IT WORKS</h1>
                        <p class="text-center"></p>
                        <div class="row howItWorksStepsCont">
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="img/front/Firmogram_r5_c5.png" alt="">
                                    <h3>Submit a Request</h3>
                                    <p>Give us the details for the services or products you need</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="{{ asset('img/front/Firmogram_r5_c10.png') }}" alt="">
                                    <h3>Get Free Quotes</h3>
                                    <p>Receive quotes from pre-screened and registered local and national suppliers</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="{{ asset('img/front/work1.png') }}" alt="">
                                    <h3>Evaluate and Move Ahead</h3>
                                    <p>Review quotes, select the best options, and complete the deal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-center">
                        <a href="#" class="btn videoIconBtn" data-toggle="modal" data-target="#videoContModal">WATCH THE VIDEO</a>
                    </p>
                </div>
            </div>

            
        </section>-->
        <section id="howItWorks" class="manage-condo howItWorks">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1>DO YOU MANAGE OR LIVE IN CONDO?</h1>
                        <p class="text-center">Then request our free mobile app and hire quality contractors in a SNAP</p>
                        <div class="row howItWorksStepsCont">
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="img/front/condo1.png" alt="">
                                    <h3>Signup</h3>
                                    <p>Signup, take a picture or upload a support document.</p>
                                    <img src="img/front/how-work-Sign-up.png" alt="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="{{ asset('img/front/condo2.png') }}" alt="">
                                    <h3>Best Contractors</h3>
                                    <p>We send you the best contractors on spot or simply send you multiple quotes.</p>
                                   <img src="img/front/how-it-works-category.png" alt="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="{{ asset('img/front/condo3.png') }}" alt="">
                                    <!--<h3>Get a Quality</h3>-->
                                    <h3>Complete Satisfaction</h3>
                                    <p>Get a quality service or review multiple quotes, pay, and rate the service</p>
                                    <img src="img/front/how-it-works-request.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <p class="text-center">
                        <a href="#" class="btn videoIconBtn" data-toggle="modal" data-target="#videoContModal">WATCH THE VIDEO</a>
                    </p>-->
                </div>
            </div>

            <!-- Modal -->
            
        </section>
        <section class="howItWork-app-request-sec">
            <div class="app-request-sec">
                    <div class="container">
                        <div class="row">
                           <div class="col-md-12">
                                <input name="app-req-email" id="app-req-email" value="" placeholder="Enter your email" type="email">
                                <a href="javascript:;" class="app-req-tab">
                                    Request QONDO APP

                                </a>
                                <div class="app-message"></div>
                            </div>
                        </div>
                    </div>
               
               
            </div> 
          
            
        </section>
 
 
<section  class="manage-contractors howItWorks" >
             
            <div class="container">
              
                <div class="row">
                    <div class="col-xs-12">
                        
                        <a name="contractors_hash_tag" id="contractors_hash_tag"></a>
                        <h1>HOW IT WORKS FOR CONTRACTORS AND TRADES</h1>
                        <div class="staratManagers-content">
                            <ul>
                                <li> Work on your own schedule.</li>
                                <li>  Advertise your service and improve your ROI.</li>
                                <li> Get contract works not leads. </li>
                                <li> Issue quotes and introduced to a large network of condo owners and property managers.</li>
                                <li> Guaranteed payments for on-demand services.</li>

                            </ul>
                        </div>
                        <p class="text-center"></p>
                        <div class="row howItWorksStepsCont">
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="img/front/strata1.png" alt="">
                                    <h3>Free Sign Up</h3>
                                    <p>Get a free public profile, upload images and identify your services categories and service areas.</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="{{ asset('img/front/strata2.png') }}" alt="">
                                    <h3>Select Your Membership</h3>
                                    <p>Get the most from Qondo and let us do the hard work of getting right clients for you.</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="howItWorksStep">
                                    <img src="{{ asset('img/front/strata3.png') }}" alt="">
                                    <h3>Stay Connected</h3>
                                    <p>Pay upfront and get on-demand request from condo owners and strata managers. Get a good review and get exposed to new clients.</p>
                                </div>
                            </div>
                            <div class="viewmore-supplier">
                                <a href="{{url("auth/register")}}" class="btn">Get Started Now</a>
                            </div>
                        </div>
                    </div>
<!--                    <p class="text-center">
                        <a href="#" class="btn videoIconBtn" data-toggle="modal" data-target="#videoContModal">WATCH THE VIDEO</a>
                    </p>-->
                </div>
            </div>

            
        </section>
<script type="text/javascript">
     $(document).ready( function () {
        var hash_tag = window.location.hash.substr(1);
        
        var heaser_height = $('.fixed_header').height()-20;
        $('html, body').animate({
            scrollTop: $("#"+hash_tag).offset().top-heaser_height
        }, 1000);
     });
 </script>
 @endsection       
 
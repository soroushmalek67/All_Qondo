@extends('templates.sub_pages_template')
@section('page-content')
        <section class="breadcrumpsSection header_margin">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            <li>About</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="registrationFormSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 terms_conditions">
                        <h1>ABOUT</h1>
                        <p>QONDO is a unique online marketplace for professional service providers to interact directly with motivated local and national business customers. It utilizes business data analytics and visualizations to enhance the entire procurement process, from initial communications to final payment. The platform is presently targeted for services in the multi-family residential and commercial building sector, looking to cut energy costs by considering the greener alternatives.</p>
                         <img src="{{asset('img/about_image1.png ')}}" alt="Fimogram_platform"    />
                         <h2>QONDO simplifies the steps of service and trades procurement for general contractors, condo boards, property managers, and real estate agents.</h2>
                         <p>There are many unnecessary hurdles within traditional service procurement workflow, which typically leads to low quality services, complicated feed-back loops, and unhappy customers.  Service providers and business customers often use a mix of tools for searching and communicating - CRM, online directories, and traditional sales & marketing methods. These each require a lot of time and resources, and don't often provide enough value. </p>
                         <p>Focusing on services for <span style="font-weight:bold">multi-family residential/condos and commercial buildings,</span> QONDO eliminates the complexity of service and trades procurement for condo boards and property managers, thereby increasing revenues for service providers by directly connecting them to real leads and removing workflow hurdles.</p>
                         <p>We just want to make it easier for our members to find what they need when they need it by making our marketplace accessible and affordable.</p>
                         <!--<img src="{{asset('img/about_image2.jpg')}}" alt="Status Quo" />-->
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h3>The old "Status Quo" way</h3>
                                <div class="oldQuoAndNewSmartWayImgCont hidden-lg hidden-md">
                                        <img src="{{asset('img/front/status_quo_img.jpg')}}" alt=""/>
                                        <img src="{{asset('img/front/status_quo_img_and_new_smart_way_mobile_seprator.jpg')}}" alt=""/>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <h3>The new "Fast & Smart" way</h3>
                                <div class="oldQuoAndNewSmartWayImgCont hidden-lg hidden-md">
                                        <img src="{{asset('img/front/new_smart_way.jpg')}}" alt=""/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <img src="{{asset('img/front/status_quo_img_and_new_smart_way.jpg')}}" alt="" class="hidden-xs hidden-sm"/>
                            <br/>
                            <h3 class="text-center"> </h3>
                        </div>
                         
                    </div>
                </div>
            </div>
        </section>
@endsection
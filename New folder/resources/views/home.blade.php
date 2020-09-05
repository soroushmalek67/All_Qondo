<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
    <head>
        @include('partials.head')
    </head>
    <body>
        
        @include('partials.outdated_browser')
        <header id="header_menu" class="header_menu">
            <section class="top-banner innerPagesHeader @if(!Auth::guest()) dashboardHeader @endif">
                <div class="container">
                    <div class="row menuAndLogoCont">
                        @include('partials.header_menu')
                    </div>
                </div>
            </section>
        </header>
        <section class="homeHeaderSection frontpage_section">
            <section class="top-banner @if(!Auth::guest()) dashboardHeader homepageLogedinHeader @endif">
                <div class="container">
                    <div class="row menuAndLogoCont">
                        <div class="banner-text homeTopBannerText">
                            <h2 class="text-center">Any Contractor. Anytime.</h2>
                            <div class="home-search-sec">
                                <span>
                                    <form action="{{url('search-form-submission')}}" id="homeSearchForm" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="selectedOptionType" id="selectedOptionType" value="">
                                        <input type="hidden" name="selectedCatID" id="selectedCatID" value="">
                                        <input type="hidden" name="selectedCatName" id="selectedCatName" value="">
                                       <input type="text" class="firms home-search-bar" id="home-live-search" name="searchKeyword" 
                                               placeholder="Search and request a service"/>
                                       <span id="form-526"> 
                                        <input type="submit" class="submit" value="GET STARTED"/>
                                        <a href="{{url('how-it-works')}}" class="linkToHowItWorks btn tranparentWhiteBtn">Learn More</a>
                                       </span>
                                    </form>
                                </span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </section>
            <section class="services">
                
                <div class="container">
                    <div class="row homeCategories">
                        @if(count($homeCategories) > 0)
                            @foreach($homeCategories as $homeCategory)
                                <div class="col-md-5ths col-xs-3">
                                    <div class="homeCategoryCont HomeCategoriesAnimation">
                                        <div class="homeCategoryimg">
                                            @if($cat_rel_data->value==1)
                                            
                                            <style>
                                                                                                .services .homeCategories div .homeCategoryCont.HomeCategoriesAnimation .homeCategoryimg:hover, 
                                                .InnerPageCategories div .homeCategoryCont.HomeCategoriesAnimation .homeCategoryimg:hover {
                                                    border-width: 3px;
                                                    padding: 0;
                                                }
                                                .services .homeCategories div .homeCategoryCont .homeCategoryimg:hover .homeCategoryDetails, 
                                                .InnerPageCategories div .homeCategoryCont .homeCategoryimg:hover .homeCategoryDetails {
                                                    transform: rotateY(0deg);
                                                    -o-transform: rotateY(0deg);
                                                    -ms-transform: rotateY(0deg);
                                                    -moz-transform: rotateY(0deg);
                                                    -webkit-transform: rotateY(0deg);
                                                }
                                                .services .homeCategories div .homeCategoryCont.HomeCategoriesAnimation .homeCategoryimg:hover img, 
                                                .InnerPageCategories div .homeCategoryCont.HomeCategoriesAnimation .homeCategoryimg:hover img {
                                                    transform: rotateY(180deg);
                                                    -o-transform: rotateY(180deg);
                                                    -ms-transform: rotateY(180deg);
                                                    -moz-transform: rotateY(180deg);
                                                    -webkit-transform: rotateY(180deg);
                                                }
                                                
                                                
                                            </style>
                                            <div class="homeCategoryDetails">
                                                <h2>{{$homeCategory->total_business}}</h2>
                                                <p>Services</p>
                                                <hr/>
                                                <h2>{{$homeCategory->total_request}}</h2>
                                                <p>Requests</p>
                                            </div>

                                            @endif
                                            
                                            <?php
                                            if (!empty($homeCategory->category_icon)) {
                                                $catImgURL = asset('img/category/category_icons/'.$homeCategory->category_icon);
                                            } else {
                                                $catImgURL = asset('img/front/placeholder_home_categories.png');
                                            }
                                            ?>
                                            <img src="{{$catImgURL}}" alt="{{$homeCategory->name}}">
                                        </div>
                                        <h3><a href="{{ url('/categories/'.$homeCategory->slug) }}" >{{$homeCategory->name}}</a></h3>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if($try_it_free_icon->value==1)
                        <div class="col-md-5ths col-xs-3 hidden-sm hidden-xs">
                            <div class="homeCategoryCont">
                                <a href="{{ url('/auth/register') }}">
                                    <div class="homeCategoryimg"><img src="{{ asset('img/front/free_try_icon.png') }}" alt=""></div>
                                    <h3>Try It Free</h3>
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
           
        </section>

<!--        <div class="col-md-12 text-center">
            <div class="add-categories">
                <br/><br/><a href="{{url("categories")}}" class="btn">More Categories</a>
            </div>
        </div>-->
  <section class="services-section">
        <input type="hidden" name="offsdet" value="18" id="offdset">
        <input type="hidden" name="total" value="{{$totalservices[0]->total_services}}" id="total">
        <div class="container">
            <div class="row">
               <div class="col-md-12">
                   <h3 class="our-services-heading">Our Services</h3>
                    <div class="row">
                        <div class="services-list">
                            @foreach ($subcategories as $subcategory) 

                            <a href="{{url('request-service/'.$subcategory->slug)}}">
                                <div class="col-lg-2 col-sm-3 col-xs-6 service-div">
                                    <div class="service-img">
                                        <div class="service-img-outer-div"><img src="@if (!empty($subcategory->category_icon)){{asset('/img/category/category_icons/'.$subcategory->category_icon)}} @else {{asset('img/front/newhome/placehoder_sub_categories.png')}} @endif">
                                        </div>
                                    </div>
                                   
                                    <img class="service-seprator-img" src='{{asset("img/front/newhome/service-arrow.png")}}'>
                                    <p class="service-name">
                                    {{$subcategory->name}}
                                    </p>
                                </div>
                            </a>
                           @endforeach
                        </div>
                        <div class="load-more-services-sec">
                            <a href="{{url('categories')}}" id="load-more-services-on-cat-page">
                                View All Services & Categories
                                <img src="{{asset('img/front/newhome/load-more-services.png')}}">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="home-slider-section">
    <div class="container">
        <div class="row">
<!--            <div class="silder-heading">
                <h4>Slide right to view features of the app!</h4>
            </div>-->
            <div id="myCarousel" class="carousel slide home-slider" >
                <!-- Indicators -->
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="{{asset("img/front/home-slide-1.png")}}" alt=" ">
                       
                    </div>
                    <div class="item">
                         <img src="{{asset("img/front/slide-2-home.png")}}" alt="">
                       
                    </div>
                   
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="app-img-div">
                <a href="{{url('contact-us')}}">
                    <img src="{{asset('img/front/newhome/download-app.png')}}">
                </a>
                <!--<img class="arrow-indication" src="{{asset('img/front/newhome/app-show-arrow.png')}}">-->
            </div>
        </div>
    </div>
</section>


     
                
<section class="firmogram homeWhyFirmogramSection">

    <div class="container">


        <div class="row">
            <div class="col-md-12 text-center top_service_provider_section">
<!--                         <h2 class="text-center">TRUSTED BY HUNDREDS OF LOCAL BUSINESSES</h2>-->


                    <h2 class="text-center">TRUSTED BY CONDO OWNERS AND STRATA MANAGERS</h2>
                    <div class="row">
                 @foreach($top_service_provider as $top_supplier)
                 <div class="col-md-3 top_service_provider_col">
                     <a href="{{url("supplier-profile/".$top_supplier->business_name."/".$top_supplier->id)}}">
                          <div class="top_service_provider">
                         @if (empty($top_supplier->company_logo)) 
                         No Logo 
                         @else
                         <img src="{{asset("img/compay_logos/".getFolderStructureByDate($top_supplier->created_at)."/"
                                                    .$top_supplier->company_logo)}}" />
                         @endif
                     </div>
                     </a>
                 </div>
                 @endforeach
                 </div>
<!--                        <h3 class="text-center">Learn how QONDO can help your business</h3> -->
                     <h3 class="text-center">Are you a contractor or provide condo services? Learn how QONDO can help grow your business</h3> 
                 <a href="{{url("how-it-works#contractors_hash_tag")}}" class="btn">View More</a>
            </div>
        </div>



        @if($latest_requests != null)
        <div class="row">
            <div class="col-md-12 text-center">
                <br><br>
                <h2 class="text-center">LATEST REQUESTS</h2>

                @foreach($latest_requests as $latest_request)
                    <!--<a href='project-details/{{$latest_request->request_id}}'>-->
                    <div class="col-md-4">
                        <div class="latest_requests_home homerequest text-left">


                        <h3> <?php
                            if (strlen($latest_request->request_title) > 20) {
                                echo substr($latest_request->request_title, 0, 20) . "...";
                            } else {
                                echo $latest_request->request_title;
                            }
                        ?>

                        </h3>

                        <h5>{{$latest_request->first_name}} {{$latest_request->last_name[0]}}, {{$latest_request->city_name}} {{$latest_request->iso}}</h5>
                        <div class=" text-left detailprop">
                            <p>


                                <img src="{{asset('img/front/icon_calander.png')}}" alt="" style="margin-right: 2px" /> 
                                {{date('F j, Y', strtotime($latest_request->created_at))}}
                                <img src="{{asset('img/front/clock.png')}}" alt="" style="margin-left : 20px"/> 
                                {{date('h:ia', strtotime($latest_request->created_at))}}
                            </p>
                        </div>
                        <p class="dashboardProjectMainDetails">
                                <span > Budget :@if($latest_request->estimated_budget==null) Not specified @else ${{$latest_request->estimated_budget}} / @if($latest_request->budget_type==0) Project @elseif($latest_request->budget_type==1) Hour @endif @endif</span> 
                       </p>

                            <!--<span>{{$latest_request->description}}</span>-->
                       <p class="descrption">
                        <?php
                            if (strlen($latest_request->description) > 120) {
                                echo substr($latest_request->description, 0, 120) . "...";
                            } else {
                                echo $latest_request->description;
                            }
                        ?>
                        <?php // echo substr($latest_request->description, 0, 30) . "..."; ?>
                        </p>
                        <a href="homepage-project-details/{{$latest_request->request_id}}" class="btn">Read More</a>

                        </div>


                    </div>
                    <!--</a>-->
                @endforeach
            </div>
        </div>

        @endif


    </div>
</section>
<section  class="manage-contractors home-contact-us" >
             
    <div class="container">

        <div class="row">
            <div class="col-xs-12">

                <h3 class="contact-us-heading">CONTACT US</h3>
                <p class="contact-us-caption">
                    We want to know what you think!<br>
                    Reach out to us anytime and we'll happily answer your questions.
                </p>

                <div class="row howItWorksStepsCont">
                    <div class="col-sm-4">
                        <div class="contact-us-step">
                            <img src="img/front/newhome/ipsum.png" alt="">
                            <h3>Request a Demo</h3>
                            <p>Request a free demo to see <br> how registering as a PRO <br> can help your business</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact-us-step">
                            <img src="img/front/newhome/ament.png" alt="">
                            <h3>Sales Inquiry</h3>
                            <p>Directly message our sales <br> team for assistance regarding<br> sales-related inquiries</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact-us-step">
                            <img src="img/front/newhome/tempor-img.png" alt="">
                            <h3>Customer Support</h3>
                            <p>Get in touch with our support <br> staff for best experience with<br> our QONDO application</p>
                        </div>
                    </div>
                    
                   
                </div>
                <div class="contact-us-btn-home">
                        <a href="{{url('contact-us')}}">
                            <input class="btn" type="button" name="" value="Get in touch">
                        </a>
                    </div>
            </div>
<!--                    <p class="text-center">
                <a href="#" class="btn videoIconBtn" data-toggle="modal" data-target="#videoContModal">WATCH THE VIDEO</a>
            </p>-->
        </div>
    </div>


</section>
    
<script>
   

    if(localStorage['location'] != '') {
        $("#selected_location").text(localStorage['location']);
    }
$(document).ready ( function () {
    
    $(".location-options").children('li').children('a').click(function () {
        localStorage['location'] = $(this).text()
        $("#selected_location").text(localStorage['location']);
    });
});
</script>
@include('partials.footer')
       
    </body>
</html>

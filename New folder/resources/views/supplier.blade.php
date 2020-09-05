@extends('templates.sub_pages_template')
@section('page_title') Supplier @endsection
@section('page-content')
<!--        <section class="registerPageTopStepsCont dashboardPateTopSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-5"><h5>Supplier Public Profile</h5></div>
                    <div class="col-md-7 text-right">
                        <a class="btn tranparentBtn transparentwhiteBtn" href="{{url('request-service')}}">Post New Request</a>
                    </div>
                </div>
            </div>
        </section>-->
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            <li>Supplier</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="supplier-banner">
            <div class="container">
                <div class="social-icons-supplier clearfix">
                    <a target="_blank" href="https://www.facebook.com/Door-Filter-Air-purification-for-Condos-318632464825381/" class="pull-left">
                        <img src="{{asset('img/supplier/phone.png')}}">&nbsp;1 855 782 6882</a>
                    <span class="pull-right">
                        <a target="_blank" href=""><img src="{{asset('img/supplier/fb.png')}}" alt=""></a>
                        <a target="_blank" href=""><img src="{{asset('img/supplier/tw.png')}}" alt=""></a>
                        <a target="_blank" href=""><img src="{{asset('img/supplier/gmail.png')}}" alt=""></a>
                    </span>
                </div>
            </div>
        </section>
        <section class="supplier-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 leftContent">

                        <div class="row heading-supplier">
                            <div class="col-md-3 avatar-heading">
                                <div class="supplier-avatar text-center">
                                    <img src="{{asset('img/supplier/door.jpg')}}">
                                </div>
                            </div>
                            <div class="col-md-9 avatar-heading">
                                <h1>Door Filter Technologies</h1>
                                <div class="ratting">
                                    <li>
                                        <a href=""><img src="{{asset('img/supplier/star1.png')}}" alt=""></a>
                                    </li>
                                    <li>
                                        <a href=""><img src="{{asset('img/supplier/star1.png')}}" alt=""></a>
                                    </li>
                                    <li>
                                        <a href=""><img src="{{asset('img/supplier/star1.png')}}" alt=""></a>
                                    </li>
                                    <li>
                                        <a href=""><img src="{{asset('img/supplier/star1.png')}}" alt=""></a>
                                    </li>
                                    <li>
                                        <a href=""><img src="{{asset('img/supplier/star1.png')}}" alt=""></a>
                                    </li>
                                    <li>
                                        3 Reviews
                                    </li>
                                    <li>
                                        <a href="{{url('request-service/environmental')}}" class="qoutes btn btn-small"> Get Quotes </a>
                                    </li>
                                </div>
                                <div class="service-description">
                                    <b>Services/Products Description:</b> Improving Indoor Air Quality
                                </div>
                            </div>
                        </div>
                        
                        <div class="row desc">
                            <div class="col-md-12 description">
                                <p>
                                    The Door Filter™ was born of one of the strongest motivations possible—a father’s desire to protect the well being of his family. As founder, CEO, and most importantly, new father, Andrew Bordin wanted to be sure he had a product he could feel safe using around his own family before he asked you to trust yours with it. The result is a unit that runs continuously without using power and has no moving parts to break down.
       Door Filter™ works because key people have done the research and designed a product that works and lasts. All the necessary details have been meticulously planned and implemented from the interchangeable ends that can be sized to fit the door properly to the dense ABS extension lined with a door sweep and of course the removable multi-stage air filter. Door Filter™ is the end result of that tried and true business journey that moves from prototype to testing to finished product.
                                </p>
                            </div>
                        </div>
                        <span class="border"></span>
                        <div class="clearfix"></div>
                        <div class="row sevice">
                            <div class="col-md-12 headservices">
                                <div class="row sevices">
                                    <div class="col-md-12 service-head">
                                        <h2>PRODUCTS/SERVICES</h2>
                                    </div>
                                    <div class="col-sm-4 service-img">
                                        <img src="{{'img/supplier/projects.png'}}">
                                    </div>
                                    <div class="col-sm-8 service-desc">
                                        <h1 class="text-left">Door Filter™</h1>
                                        <p>
                                            Introducing “Door Filter” – A Newly Developed, Innovative, North American-Made Filtration Product designed to Improve the Indoor Air Quality within Apartment Units and Condos. Door filter will help reduce Dust and odours in buildings that promote door drafts.
                                        </p>
                                    </div>
                                </div>
                                <span class="border"></span>
                                <div class="row sevices1">
                                    <div class="col-sm-4 service-img">
                                        <img src="{{'img/supplier/projects.png'}}">
                                    </div>
                                    <div class="col-sm-8 service-desc">
                                        <h1 class="text-left">Replacement Air Filter</h1>
                                        <p>
                                            Fully integrated interchangeable filter cartridge system reduces odor, pests and various allergens before entering living area.
                                        </p>
                                    </div>
                                </div>
                                <span class="border"></span>
                            </div>
                        </div>
                        <div class="row sevice">
                            <div class="col-md-12 headservices">
                                <div class="row sevices">
                                    <div class="col-md-12 service-head">
                                        <h2>Promotion / coupons</h2>
                                    </div>
                                    <div class="col-md-12 text-center coupn">
                                        <img src="{{'img/supplier/coupons.png'}}">
                                    </div>
                                    <div class="col-md-12 text-center coupn">
                                        <img src="{{'img/supplier/coupons.png'}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <span class="border"></span>
                        <div class="row videoblock">
                            <div class="col-md-12 headservices">
                                <div class="row sevices">
                                    <div class="col-md-12 service-head">
                                        <h2>Video</h2>
                                    </div>
                                    <div class="col-md-12 text-center videodiv">
                                        <iframe width="700" height="400" frameborder="0" allowfullscreen="allowfullscreen" src="//www.youtube.com/embed/G_vhWbmOn2U?rel=0&amp;vq=hd720"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 sidebartop">
                        <div class="col-md-12 ">
                            <div class="row">
                                <form action="{{url('suppliers-list')}}" method="get">
                                    <div class="col-sm-12 search">
                                        <input type="search" class="form-control" name="searchKeywork" placeholder="Enter company name, city, or category" 
                                               id="supplierSearchAutoComplete" />
                                    </div>
                                    <div class="col-sm-7 search1">
                                        <input type="text" class="form-control" name="postal_code" placeholder="Postal Code, e.g. V5B 1A5" />
                                    </div>
                                    <div class="col-sm-5 search-btn">
                                        <input type="submit" class="btn btn-primary search-button" name="suppliersFilter" value="SEARCH" />
                                    </div>
                                </form>
                            </div>
                            <span class="border1"></span>
                            <div class="sidebar">
                                <h1>Contact Details</h1>
                                <div class="contact-detail">
                                    <li>
                                        <img src="{{asset('img/supplier/address.png')}}">
                                        <p><b>Address : </b>35 Silton Road, WOOD BRIDGE, Ontario L4L 7Z8 Canada</p>
                                    </li>
                                </div>
                                <div class="contact-detail">
                                    <li>
                                        <img src="{{asset('img/supplier/website.png')}}">
                                        <p><b>Website : </b>doorfilter.com</p>
                                    </li>
                                </div>
                                <div class="contact-detail">
                                    <li>
                                        <img src="{{asset('img/supplier/user.png')}}">
                                        <p><b>User Since : </b>2016-01-25</p>
                                    </li>
                                </div>
                                <div class="contact-detail">
                                    <li>
                                        <img src="{{asset('img/supplier/home.png')}}">
                                        <p><b>Service Categories : </b></p>
                                        <ul>
                                            <li>Building Maintenance</li>
                                            <li>Consulting Engineering</li>
                                            <ul class="sub-category">
                                                <li>Environmental</li>
                                                <li>Green Technology</li>
                                            </ul>
                                        </ul>
                                        
                                    </li>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <span class="border1"></span>
                            <div class="clearfix"></div>
                            <div class="sidebar">
                                <h1>Certificates & Awards</h1>
                                <div class="contact-detail">
                                    <img src="{{asset('img/supplier/certificates.png')}}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <span class="border1"></span>
                            <div class="sidebar">
                                <h1>Company location</h1>
                                <div class="map-block" id="supplier-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2879.604713481477!2d-79.5471941401977!3d43.801814734169824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b2f9b7cfc4d07%3A0xa24b73d0c5dfc97a!2s35+Silton+Rd%2C+Woodbridge%2C+ON+L4L+7Z8%2C+Canada!5e0!3m2!1sen!2s!4v1455705324066" width="286" height="228" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                            <span class="border1"></span>
                            <div class="sidebar reviews">
                                <img src="{{asset('img/supplier/plus.png')}}"><a href="" class="addreview">Add Reviews</a>
                                <div class="review-block sidebar">
                                    <span>3 Reviews</span>
                                    <div class="sidebar-ratting">
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star2.png')}}">
                                        </li>
                                    </div>
                                    <div class="review-description">
                                        <p>
                                            As a day trader, I have spent many days indoors. With the Doorfilter I have noticed a major difference in the air quality, odors and sound has decreased..” Having a condo situated close to
the elevator is no longer an acoustic issues because of Doorfilters sound absorbing quality. - Norman Martin
                                        </p>
                                        <span><a>More ></a></span>
                                    </div>
                                </div>
                                <span class="border1"></span>
                                <div class="review-block sidebar">
                                    <span>3 Reviews</span>
                                    <div class="sidebar-ratting">
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star2.png')}}">
                                        </li>
                                    </div>
                                    <div class="review-description">
                                        <p>
                                            Since installing our Doorfilter we have noticed a significant change in the amount of dust accumulating in our home, would highly recommend this to anyone living in a condo. - The Lerch Family
                                        </p>
                                        <span><a>More ></a></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <span class="border1"></span>
                                <div class="clearfix"></div>
                                <div class="review-block sidebar">
                                    <span>3 Reviews</span>
                                    <div class="sidebar-ratting">
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star1.png')}}">
                                        </li>
                                        <li>
                                            <img src="{{asset('img/supplier/star2.png')}}">
                                        </li>
                                    </div>
                                    <div class="review-description">
                                        <p>
                                            With the Doorfilter I have noticed a major difference in the air quality in particular odors from other units on my floor. - Jim Lord BBA, FCIP, LEED AP, SMaRT AP ECOVERT | Sustainability Consultants
                                        </p>
                                        <span><a>More ></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>
@endsection
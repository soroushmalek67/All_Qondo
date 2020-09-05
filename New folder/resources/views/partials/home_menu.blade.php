                                
                                <nav id="myNavbar" class="navbar navbar-default homeMainNav" role="navigation">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="topLinks nav navbar-nav">
                                            @if (Auth::guest())
                                            <li class="locations">
                                                        <a href="javascript:;">
                                                            <img class="location-icon-home" src="{{asset('img/front/location-icon-white.png')}}">
                                                            <span id='selected_location'>
                                                              Locations
                                                            </span>
                                                             <img class="arrow-home-icon" src="{{asset('img/front/arrow-icon-white.png')}}">
                                                        </a>
                                                <ul class="location-options">
                                                            <li><a href="javascript:;">Vancouver</a></li>
                                                            <li><a href="javascript:;">Toronto</a></li>
<!--                                                            {{--*/ $categories = header_main_categories() /*--}}
                                                            @foreach ($categories as $category) -->
<!--                                                            <li><a href="{{url('categories/'.$category->slug)}}">{{$category->name}}</a></li>-->
<!--                                                            @endforeach-->
                                                        </ul>
                                                    </li>
                                                @if (!isset($supplierPage))
                                                    <!--<li>
                                                        <a>SOLUTIONS</a>
                                                        <ul>
                                                            <li><a href="{{url('categories')}}">Marketplace</a></li>
                                                            <li><a href="{{url('analytics')}}" target="_blank">B2B Analytics</a></li>
                                                            <li><a href="{{url('suppliers')}}">Marketing & Sales</a></li>
                                                        </ul>
                                                    </li>-->
                                                @endif
                                                    <!--<li>
                                                        <a href="{{url('about/')}}">ABOUT</a>
                                                        <ul>
                                                            <li><a href="{{url('faq')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAQ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                                        </ul>
                                                    </li>-->
                                                
                                                <li><a href="{{ url('auth/login') }}">Login</a></li>
                                                <li><a href="{{ url('auth/register') }}">Signup</a></li>
                                            @else
                                                @if (Auth::userType() == 1)
                                                    
                                                    <li class="selected"><a href="{{url('suppliers-list')}}">Find a Contractor</a></li>
                                                    <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                                @else
                                                {{--*/$companySlug = (empty(Auth::user()->company_slug))?"no-slug":Auth::user()->company_slug/*--}}
                                                    <li class="selected"><a href="{{url('supplier-profile/'.$companySlug.'/'.Auth::id())}}">
                                                            My profile</a></li>
                                                    <!--<li><a href="">My Request2<?php // Auth::getRecaller() ?></a></li>-->
                                                    <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </nav>
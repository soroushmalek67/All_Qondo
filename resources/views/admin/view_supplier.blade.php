@extends('templates.sub_pages_template')
@section('page-content')

      
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
        <section class="supplier-banner"  style="@if (!empty($supplierDetails->banner)) background-image: url('{{url("img/profile_banner/".getFolderStructureByDate($supplierDetails->created_at)."/"
                                                            .$supplierDetails->banner)}}'); min-height: 338px; background-size: 100% @endif">
            <div class="container">
                <div class="social-icons-supplier clearfix">
                    <a target="_blank" href="tel:{{$supplierDetails->userPhoneNumber}}" class="pull-left"><img src="{{asset('img/supplier/phone.png')}}">&nbsp;{{$supplierDetails->userPhoneNumber}}</a>
                    <span class="pull-right">
                        @if($supplierDetails->facebook!=null)
                            
                            <a target="_blank" href="{{$supplierDetails->facebook}}">
                            <img src="{{asset('img/supplier/fb.png')}}" alt=""></a>
                        @endif
                        
                        @if($supplierDetails->twitter!=null)
                              <a target="_blank" href="{{$supplierDetails->twitter}}"><img src="{{asset('img/supplier/tw.png')}}" alt=""></a>
                        
                        @endif
                        
                        @if($supplierDetails->googleplus!=null)
                            
                           <a target="_blank" href="{{$supplierDetails->googleplus}}"><img src="{{asset('img/supplier/gmail.png')}}" alt=""></a>
                        
                        @endif
                        
                        @if($supplierDetails->linked!=null)
                            
                        <a target="_blank" href="{{$supplierDetails->linked}}"><img src="{{asset('img/front/linkdn.png')}}" alt=""></a>

                        @endif
                        
                      
                        @if($videoLink!=null)
                            
                        <a target="_blank" href="{{$videoLink}}"><img src="{{asset('img/front/youtubeSup.png')}}" alt=""></a>

                        @endif
                       
                        
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
                                    @if (empty($supplierDetails->logo)) 
                                                        No Logo 
                                                        @else
                                                        <img src="{{url("img/compay_logos/".getFolderStructureByDate($supplierDetails->created_at)."/"
                                                            .$supplierDetails->logo)}}" 
                                                              
                                                              />
                                                        @endif
                                </div>
                            </div>
                            <div class="col-md-9 avatar-heading">
                                <h1 id="headerSupplier">{{$supplierDetails->business_name}}</h1>
                                {{--*/$avgstar=0/*--}}
                                 @foreach($reviews as $review)
                                    {{--*/$avgstar=$avgstar+$review->stars/*--}}
                                
                                    
                                 @endforeach
                                    
                                     
                                
                                <div class="ratting">
                                    
                                    @if(count($reviews)!=0)
                                    
                                     @for($i=0 ; $i<$avgstar/count($reviews); $i++ )
                                            <li >
                                                <img id="12" src="{{asset('img/supplier/star1.png')}}">
                                            </li>
                                            @endfor
                                    @endif
                                    <li>
                                       
                                        {{count($reviews)}} Reviews
                                    </li>
                                    <li>
                                        <a href="{{url('request-service/supplier')}}/{{$supplierDetails->id}}" class="qoutes btn btn-small"> Get Quotes </a>
                                    </li>
                                </div>
                               
                            </div>
                            
                            <div class="service-description">
                                   
                             </div>
                        </div>
                        
                        <div class="row desc">
                             
                            <div class="col-md-12 description">
                                <p>
                                     <b>Services/Products Description:</b>
                                    {{$supplierDetails->describe_product}}
                                </p>
                            </div>
                        </div>
                       
                        @if(count($products)!=0)
                         <span class="border"></span>
                        <div class="clearfix"></div>
                        <div class="row sevice">
                            <div class="col-md-12 headservices">
                                <?php $i=0;?>
                              @foreach($products as $product)
                                 
                                @if($i==0)
                                <div class="row sevices">
                                    <div class="col-md-12 service-head">
                                        <h2>PRODUCTS/SERVICES</h2>
                                    </div>
                                    <div class="col-sm-4 service-img">
                                        <img src="{{url("img/product/".getFolderStructureByDate($product->created_at)."/"
                                                    .$product->image)}}" />
                                    </div>
                                    <div class="col-sm-8 service-desc">
                                        <h1 class="text-left">{{$product->name}}</h1>
                                        <p>{{$product->description}}</p>
                                    </div>
                                </div>
                                
                                @else
                                <div class="row sevices1">
                                    <div class="col-sm-4 service-img">
                                       <img src="{{url("img/product/".getFolderStructureByDate($product->created_at)."/"
                                                    .$product->image)}}" />
                                    </div>
                                    <div class="col-sm-8 service-desc">
                                        <h1 class="text-left">{{$product->name}}</h1>
                                        <p>{{$product->description}}</p>
                                    </div>
                                </div>
                                
                               @endif
                                
                              <?php $i++; ?>
                                @endforeach

                            </div>
                        </div>
                        @endif
                        @if($supplierDetails->package=='Enterprise' || $supplierDetails->package=='dedicated')
                        
                        @if($supplierDetails->pakage_expires_at > date("Y-m-d h:i:s"))
                        @if(count($coupons)!=0)
                         <span class="border"></span>
                        <div class="row sevice">
                            <div class="col-md-12 headservices">
                                <div class="row sevices">
                                    <div class="col-md-12 service-head">
                                        <h2>Promotion / coupons</h2>
                                    </div>
                                    
                                        @foreach($coupons as $coupon)
                                        
                                        <div class="col-md-12 text-center coupn">
                                            <div class="row">
                                                <div class="col-md-4 couponImg">
                                                    <img src="{{url("img/coupon/".getFolderStructureByDate($coupon->created_at)."/"
                                                    .$coupon->image)}}" />
                                                </div>
                                                <div class="container coponcontain">
                                                    <div class="col-md-5">
                                                        <div class="row">
                                                            <div calss="row" >
                                                                <div class="ratting coupon-stars"> COUPON
                                                                    {{--*/ $couponStars = count($coupon->stars); /*--}}

                                                                    @for($i=0; $i<$coupon->stars; $i++)
                                                                    <li>

                                                                        <a href=""><img src="{{asset('img/supplier/star1.png')}}" alt=""></a>
                                                                    </li>
                                                                    @endfor

                                                                </div>
                                                            </div>
                                                            <div calss="row " >
                                                                <p calss="coupon_offers" style="font-size: 25px;font-weight: bold;margin-top: 10px;color: rgb(255,145,37);"> SEPECIAL OFFER</p>
                                                            </div>
                                                            <div calss="row coupon-description" style="">
                                                                <p> {{$coupon->description}}</p>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-1 line">

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div calss="row coupon-discount" >
                                                            <p class="coupdis">{{$coupon->discount}}%</p>
                                                        </div>
                                                        <div calss="row" >
                                                            <p class="coupdisoff"> OFF </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
<!--                                    <div class="col-md-12 text-center coupn">
                                        <img src="{{asset('img/supplier/coupons.jpg')}}">
                                    </div>
                                    <div class="col-md-12 text-center coupn">
                                        <img src="{{asset('img/supplier/coupons_2.jpg')}}">
                                    </div>-->
                                </div>
                            </div>
                        </div>
                         
                        @endif
                        @endif
                        @endif
                        @if($supplierDetails->package=='Enterprise' || $supplierDetails->package=='dedicated')
                        
                            @if($supplierDetails->pakage_expires_at > date("Y-m-d h:i:s"))
                        @if($videoLink!=null)
                         <div class="clearfix"></div>
                        <span class="border"></span>
                        <div class="row videoblock">
                            <div class="col-md-12 headservices">
                                <div class="row sevices">
                                    <div class="col-md-12 service-head">
                                        <h2>Video</h2>
                                    </div>
                                    <div class="col-md-12 text-center videodiv">
                                      <iframe width="700" height="400" frameborder="0" allowfullscreen="allowfullscreen" src="{{$videoLink}}?rel=0&amp;vq=hd720"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="clearfix"></div>
                        <span class="border"></span>
                        @endif
                        @endif
                        @endif
                        
                        <!--ecosystem start -->
                        
                        <!--                        @if($supplierDetails->package=='Enterprise' || $supplierDetails->package=='dedicated')
                        
                        @if($supplierDetails->pakage_expires_at > date("Y-m-d h:i:s"))
                        <div class="clearfix"></div>
                        <span class="border"></span>
                        <div class="row videoblock">
                            <div class="col-md-12 headservices">
                                <div class="row sevices">
                                    <div class="col-md-12 service-head">
                                        <h2>Discover Similar Businesses</h2>
                                    </div>
                                    <div class="col-md-12 text-center placeholder">
                                        <img src="{{url(asset('img/placeholder/placeholder.png'))}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif-->

                          <!--ecosystem  end-->
                        
                        <div class="clearfix"></div>
                        <span class="border"></span>
                    </div>
                    
                    <div class="col-md-4 sidebartop <?php if ($supplierDetails->status == 6) {echo 'supplierSideBar' ; } ?> ">
                       

                           

                                @if ($supplierDetails->status == 6)
                                <div class="row dashboardProjectContentCont">
                                    <div class="sidebar">
                                        <div class="col-md-12">
                                            <a class="pull-right btn" data-toggle="modal" role="button" href="#myModal">
                                                <span>IS THIS YOUR PROFILE?</SPAN><br/>CLAIM NOW</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                @endif
                         

                       
                        
                        <div class="col-md-12 ">
                             @if(count($awards)!=0)
                         <div class="sidebar" style="margin-top:0px !important;">
                                <h1>Certifications & Awards</h1>
                                <div class="contact-detail">
                                    
                                    <div class="row">
                                       
                                     @foreach($awards as $award)
                                    
                                         <div class="col-md-3 supaward">

                                             <img src="{{url("img/awards/".getFolderStructureByDate($award->created_at)."/"
                                                    .$award->image)}}" />
                                         </div>
                                        
                                    @endforeach
                                    
                                   </div>
                                  
                                 
                                  
                                </div>
                            </div>
                           <div class="clearfix"></div>
                            <span class="border1"></span>
                            <div class="clearfix"></div>
                            @endif
                            <div class="row">
                                <form action="{{url('suppliers-list')}}" method="get">
                                    <div class="col-sm-12 search">
                                        <input type="search" class="form-control" name="searchKeywork" placeholder="Enter company name, city, or category" 
                                               id="supplierSearchAutoComplete" />
                                    </div>
                                    <div class="col-xs-7 search1">
                                        <input type="text" class="form-control" name="postal_code" placeholder="Postal Code, e.g. V5B 1A5" />
                                    </div>
                                    <div class="col-xs-5 search-btn">
                                        <input type="submit" class="btn btn-primary search-button" name="suppliersFilter" value="SEARCH" />
                                    </div>
                                </form>
                            </div>
                             
                             <span class="border1"></span>
                              <div class="sidebar">
                                <h1 >Contact Details</h1>
                                <div class="contact-detail">
                                    <li>
                                        <img src="{{asset('img/supplier/address.png')}}">
                                        <p><b>Address : </b>{{$supplierDetails->street_address}} , {{$supplierDetails->city}}, {{$supplierDetails->state}} {{$supplierDetails->postal_code}} {{$supplierDetails->country}}</p>
                                    </li>
                                </div>
                                <div class="contact-detail">
                                    <li>
                                        <img src="{{asset('img/supplier/website.png')}}">
                                        @if(strpos($supplierDetails->website, 'https://') !== false ||  strpos($supplierDetails->website, 'http://') !== false)
                                      <p><b>Website : </b><a href="{{url($supplierDetails->website)}}" target="_blank">{{$supplierDetails->website}}</a></p>
                                       
                                        @else
                                          <p><b>Website : </b><a href="<?php echo "http://"?>{{($supplierDetails->website)}}" target="_blank">{{$supplierDetails->website}}</a></p>
                                       
                                          
                                        
                                        @endif
                                    </li>
                                </div>
                                @if ($supplierDetails->status != 6)
                                <div class="contact-detail">
                                   <li>
                                        <img src="{{asset('img/supplier/user.png')}}">
                                        <p><b>User Since : </b>{{$supplierDetails->created_at}}</p>
                                    </li>
                                </div>
                                @endif
                                <div class="contact-detail">
                                    <li>
                                        <img src="{{asset('img/supplier/home.png')}}">
                                        <p><b>Service Categories : </b></p>
                                        <ul>
                                           
                                            @foreach($cat_main as $cat_m)
                                            <li style="font-weight:bold">{{$cat_m->name}}</li> 

                                            <ul class="sub-category">
                                                @foreach($cat_child as $cat_ch)
                                                @if($cat_ch->parent_id==$cat_m->category_id)
                                                <li>{{$cat_ch->name}}</li>
                                                @endif
                                                @endforeach

                                            </ul>   
                                            @endforeach

                                           
                                            
                                        </ul>
                                        
                                    </li>
                                </div>
                            </div>
                             
                            
                             <span class="border1"></span>
                              <div class="sidebar">
                                <h1 >Areas Served</h1>
                                <div class="contact-detail">
                                   <p>
                                       {{--*/ $count = 0; /*--}}
                                    @foreach($servedAreas as $servedArea)
                                       {{--*/ $count++ ; /*--}}
                                        {{$servedArea->name}}@if($servedArea->name!=null) , @endif {{$servedArea->iso}} @if(count($servedAreas)!=$count)|@endif
                                   @endforeach
                                   </p>
                                </div>
                                
                            </div>
                             
                            
                            
                           
                           
                            
                           
                            <div class="clearfix"></div>
                            <span class="border1"></span>
                            <div class="sidebar">
                                <h1>Company location</h1>
                                <div class="map-block" id="supplier-map" style="margin-bottom: 20px;">
                                     <div style="height: 240px;  " id="map_canvas"></div>
                                     
                                </div>
                            </div>
                           
                        
                            
                            
                         
                                @if($supplierDetails->package=='Enterprise' || $supplierDetails->package=='dedicated' ||$supplierDetails->package > 0)
                        
                            @if($supplierDetails->pakage_expires_at > date("Y-m-d h:i:s"))
                            
                          
                            
                                 <span class="border1"></span>
                              
                               
                            <div class="sidebar reviews">
                                <!--<img src="{{asset('img/supplier/plus.png')}}"><a href="" class="addreview">Add Reviews</a>-->
                                <div class="review-block sidebar">
                                    <h3><span>Reviews & Testimonials</span></h3>
                                     @if(Auth::id()!=null)
                                    @if(Auth::id()!=$supplierDetails->id)
                                        <div class="row">
                                            <form action="{{url('suppliers-review')}}" method="post">
                                                 <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                                <div class="col-sm-12 search">
                                                    <textarea type="review" class="form-control" name="reviews" placeholder="Enter your review" 
                                                              id="supplierSearchAutoComplete"></textarea>
                                                </div>
                                                  <div class="col-sm-5 search-btn">
                                                    <input type="submit" class="btn btn-primary search-button" name="suppliersreview" value="submit" />
                                                    <input type="hidden" id="supplier-stars"  class="" name="stars" value="" />
                                                    <input type="hidden" id="supplier-id"  class="" name="supplierId" value="{{$supplier_id}}" />
                                                    <input type="hidden" id="supplier-slug"  class="" name="slug" value="{{$supplier_slug}}" />
                                                </div>
                                                <div class="col-sm-7 search1">
                                                    <div class="sidebar-ratting">
                                            <li >
                                                <!--<img id="star1" src="{{asset('img/supplier/star1.png')}}">-->
                                                <img id="star1" src="{{asset('img/front/white-star.png')}}">
                                            </li>
                                            <li>
                                                <!--<img id="star2" src="{{asset('img/supplier/star1.png')}}">-->
                                                <img id="star2" src="{{asset('img/front/white-star.png')}}">
                                            </li>
                                            <li>
                                                <!--<img id="star3" src="{{asset('img/supplier/star1.png')}}">-->

                                                <img id="star3" src="{{asset('img/front/white-star.png')}}">
                                            </li>
                                            <li>
                                                <!--<img id="star4" src="{{asset('img/supplier/star1.png')}}">-->
                                                <img id="star4" src="{{asset('img/front/white-star.png')}}">
                                            </li>
                                            <li>
                                                <!--<img id="star5" src="{{asset('img/supplier/star1.png')}}">-->
                                                <img id="star5" src="{{asset('img/front/white-star.png')}}">
                                            </li>
                                        </div>
                                                </div>

                                            </form>
                                        </div>
                                    @endif
                                    @endif
                                     </div>
                                  
                                    @foreach($reviews as $review)
                                    <div class="review-block sidebar">
                                        <div class="sidebar-ratting">
                                            @for($i=0 ; $i<$review->stars; $i++ )
                                            <li >
                                                <img id="124" src="{{asset('img/supplier/star1.png')}}">
                                            </li>
                                            @endfor
                                        </div>

                                        <div class="review-description">
                                            <p>{{$review->review}}</p>
                                            <!--<span><a>More ></a></span>-->
                                        </div>




                                    </div>
                                    <div class="clearfix"></div>
                                    <!--<div class="clearfix"></div>-->
                                    <div class="clearfix"></div>
                                    <span class="border1"></span>
                                    @endforeach
                                    
                                    
                                    
                                   
                               
                               
                            </div>
                             
                                @endif
                                @endif
                                    
                               
                                
                           
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>
        






        @if ($unregisterd==1)
        <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content claimYourProfilePopup">
                    <div class="modal-header">
                        <button aria-hidden="false" data-dismiss="modal" class="close" type="button">×</button>
                        <h2 id="myModalLabel">Claim Your Profile</h2>
                        <h4 class="text-uppercase">BOOST THE {{$supplierDetails->business_name}} PROFILE</h4>
                    </div>
                    <div class="modal-body">
                        <div id="new">
                            <p>Claim and update your profile to directly connect with motivated customers</p>
                            <h5>{{$supplierDetails->business_name}}</h5>
                            <p>
                                <small>
                                    @if (!empty($supplierDetails->website))
                                        <?php
                                        $url = $supplierDetails->website;
                                        $parsed = parse_url($url);
                                        if (empty($parsed['scheme'])) {
                                            $url = 'http://' . ltrim($url, '/');
                                            $domainURL = ltrim($url, '/');
                                        }
                                        ?>
                                        <a href='{{$url}}' target='_blank'>{{$supplierDetails->website}}</a>
                                    @else
                                        N/A
                                    @endif
                                </small>
                            </p>
                            <form id="claimProfileForm" class="registrationFormCont">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{asset('img/front/form_icon_email.png')}}" />
                                            	<a data-toggle="tooltip" title="Enter your business email ID">
                                                    <i class="glyphicon glyphicon-info-sign"></i></a>
                                            </span>
                                            <input type="text" name="supplierEmail" id="supplierEmail" placeholder="" 
                                                   class="form-control input-lg" required />
                                        </div>
                                    </div>
                                    <?php
                                    $domainNameArray = explode('www.', $supplierDetails->website);
                                    $hostName = (empty($domainNameArray[0]) || $domainNameArray[0] == 'http://') ? $domainNameArray[1] : $domainNameArray[0];
                                    ?>
                                    <div class="col-xs-6"><span class="claimEmailHost">&commat;{{$hostName}}</span></div>
                                </div><br/>
                                <p><a class="btn" onclick="sendClaimYourProfileEmail('{{$supplierDetails->id}}', '{{$hostName}}')">CLAIM PROFILE</a></p>
                                <h5 class="claimProfileSubmitMessageCont"></h5>
                            </form>
                        </div>
                    </div>
<!--                    <div class="modal-footer">
                        <button aria-hidden="true" data-dismiss="modal" class="btn">Close</button>
                    </div>-->
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        @endif
        






        @if ($supplierDetails->status == 6)
        <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content claimYourProfilePopup">
                    <div class="modal-header">
                        <button aria-hidden="false" data-dismiss="modal" class="close" type="button">×</button>
                        <h2 id="myModalLabel">Claim Your Profile</h2>
                        <h4 class="text-uppercase">BOOST THE {{$supplierDetails->business_name}} PROFILE</h4>
                    </div>
                    <div class="modal-body">
                        <div id="new">
                            <p>Claim and update your profile to directly connect with motivated customers</p>
                            <h5>{{$supplierDetails->business_name}}</h5>
                            <p>
                                <small>
                                    @if (!empty($supplierDetails->website))
                                        <?php
                                        $url = $supplierDetails->website;
                                        $parsed = parse_url($url);
                                        if (empty($parsed['scheme'])) {
                                            $url = 'http://' . ltrim($url, '/');
                                            $domainURL = ltrim($url, '/');
                                        }
                                        ?>
                                        <a href='{{$url}}' target='_blank'>{{$supplierDetails->website}}</a>
                                    @else
                                        N/A
                                    @endif
                                </small>
                            </p>
                            <form id="claimProfileForm" class="registrationFormCont">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{asset('img/front/form_icon_email.png')}}" />
                                            	<a data-toggle="tooltip" title="Enter your business email ID">
                                                    <i class="glyphicon glyphicon-info-sign"></i></a>
                                            </span>
                                            <input type="text" name="supplierEmail" id="supplierEmail" placeholder="" 
                                                   class="form-control input-lg" required />
                                        </div>
                                    </div>
                                    <?php
                                    $domainNameArray = explode('www.', $supplierDetails->website);
                                    $hostName = (empty($domainNameArray[0]) || $domainNameArray[0] == 'http://') ? $domainNameArray[1] : $domainNameArray[0];
                                    ?>
                                    <div class="col-xs-6"><span class="claimEmailHost">&commat;{{$hostName}}</span></div>
                                </div><br/>
                                <p><a class="btn" onclick="sendClaimYourProfileEmail('{{$supplierDetails->id}}', '{{$hostName}}')">CLAIM PROFILE</a></p>
                                <h5 class="claimProfileSubmitMessageCont"></h5>
                            </form>
                        </div>
                    </div>
<!--                    <div class="modal-footer">
                        <button aria-hidden="true" data-dismiss="modal" class="btn">Close</button>
                    </div>-->
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        @endif
        
        
        <script type="text/javascript">
    $(window).load(function(){
        $('#myModal2').modal('show');
    });
</script>

        
        <script type="text/javascript">
                            jQuery(window).ready(function() {
                                
                                
                                
                                 
                                
                                
//                                $('#myModal').modal('toggle');
//$('#myModal').modal('hide');
                                
//                                $('#myModal1').modal('show');
                               
//                                  $('#myModal').show();
//                                  window.open("#myModal");
 
                                 

                                
                                
                                
//                                function countLines() {
                                  var divHeight = document.getElementById('headerSupplier').offsetHeight;
                                  var divHeight = $( '#headerSupplier' ).height();
//                                   alert("Lines: " + divHeight);
                                  var lineHeight = 1.1;
                                  var lines = divHeight / lineHeight;
                                  if(lines>40){
                                      $("#headerSupplier").css({ 'margin-top': -5+"px" });
                                  }
//                                    alert("Lines: " + lines);
//                                }
                                
                                $('#star1').click(function(){
                                    console.log('hi');
                                    
                                     if( $('#star1').attr("src")=='{{asset('img/supplier/star1.png')}}'){
                                          $('#supplier-stars').attr("value", 1);
//                                          $('#star1').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star2').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star3').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star4').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star5').attr("src", '{{asset('img/front/white-star.png')}}');
                                     }else{
                                         $('#supplier-stars').attr("value", 1);
                                         $('#star1').attr("src", '{{asset('img/supplier/star1.png')}}');
                                     }
                                     
                                     
                                 });
                                
                                  $('#star2').click(function(){
                                       console.log('hi');
                                      if( $('#star2').attr("src")=='{{asset('img/supplier/star1.png')}}'){
                                          $('#supplier-stars').attr("value", 2);
//                                          $('#star1').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star2').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star3').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star4').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star5').attr("src", '{{asset('img/front/white-star.png')}}');
                                     }else{
                                        $('#supplier-stars').attr("value", 2);
                                        $('#star2').attr("src", '{{asset('img/supplier/star1.png')}}');
                                         $('#star1').attr("src", '{{asset('img/supplier/star1.png')}}');
                                     }
                                      
                                    
                                     
                                 });
                                  $('#star3').click(function(){
                                      
                                       if( $('#star3').attr("src")=='{{asset('img/supplier/star1.png')}}'){
                                          $('#supplier-stars').attr("value", 3);
//                                          $('#star1').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star2').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star3').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star4').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star5').attr("src", '{{asset('img/front/white-star.png')}}');
                                     }else{
                                        $('#supplier-stars').attr("value", 3);
                                        $('#star2').attr("src", '{{asset('img/supplier/star1.png')}}');
                                         $('#star1').attr("src", '{{asset('img/supplier/star1.png')}}');
                                          $('#star3').attr("src", '{{asset('img/supplier/star1.png')}}');
                                     }
                                      
                                      
//                                     $('#supplier-stars').attr("value", 3);
                                    
                                     
                                 });
                                  $('#star4').click(function(){
                                      
                                       if( $('#star4').attr("src")=='{{asset('img/supplier/star1.png')}}'){
                                          $('#supplier-stars').attr("value", 4);
//                                          $('#star1').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star2').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star3').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star4').attr("src", '{{asset('img/front/white-star.png')}}');
                                          $('#star5').attr("src", '{{asset('img/front/white-star.png')}}');
                                     }else{
                                        $('#supplier-stars').attr("value", 4);
                                        $('#star2').attr("src", '{{asset('img/supplier/star1.png')}}');
                                         $('#star1').attr("src", '{{asset('img/supplier/star1.png')}}');
                                          $('#star3').attr("src", '{{asset('img/supplier/star1.png')}}');
                                             $('#star4').attr("src", '{{asset('img/supplier/star1.png')}}');
                                     }
                                      
//                                     $('#supplier-stars').attr("value", 4);
                                  
                                     
                                 });
                                  $('#star5').click(function(){
                                      
                                       if( $('#star5').attr("src")=='{{asset('img/supplier/star1.png')}}'){
                                          $('#supplier-stars').attr("value", 5);
//                                          $('#star1').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star2').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star3').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star4').attr("src", '{{asset('img/front/white-star.png')}}');
//                                          $('#star5').attr("src", '{{asset('img/front/white-star.png')}}');
                                     }else{
                                        $('#supplier-stars').attr("value", 5);
                                        $('#star2').attr("src", '{{asset('img/supplier/star1.png')}}');
                                         $('#star1').attr("src", '{{asset('img/supplier/star1.png')}}');
                                          $('#star3').attr("src", '{{asset('img/supplier/star1.png')}}');
                                             $('#star4').attr("src", '{{asset('img/supplier/star1.png')}}');
                                               $('#star5').attr("src", '{{asset('img/supplier/star1.png')}}');
                                     }
                                  
                                   
                                     
                                 });
                                 
                                 
                            });
                        </script>
                        <script type="text/javascript">
                          $('document').ready(function () {
                              
        console.log(addPinOnMap("{{$supplierDetails->city}}, {{$supplierDetails->state}}"));                        
        addPinOnMap("{{$supplierDetails->city}}, {{$supplierDetails->state}}");
                          });
                                    </script>
      
@endsection
 
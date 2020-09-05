@extends('templates.dashboard_pages_template')
@section('page_title') Project Details @endsection
@section('breadCrumps')
    <li><a href="{{url('dashboard')}}">{{$dashboardUser}} Dashboard</a></li>
@endsection
@section('page-content')

                    <div class="dashboardMyPostedProjectsCont">
                        <div class="dashMyPostedProject">
                            <div class="row dashboardProjectHeaderCont">
                                <div class="col-md-8 dashboardProjectTitleCont">
                                    <h5>{{$request['title']}}</h5>
                                </div>
                                <div class="col-md-4 dashboardProjectDateCont text-right">
                                    <p>
                                        <img src="{{asset('img/front/icon_calander.png')}}" alt=""/> 
                                        {{date('m-d-Y', strtotime($request['created_at']))}}
                                    </p>
                                </div>
                            </div>
                            <div class="row dashboardProjectContentCont">
                                <div class="col-md-8 dashboardProjectMainDetails">
                                    <p>{!!$request['description']!!}</p>
                                    <p>
                                        <span>Main Category:</span> {{$request['mainCat']}} &nbsp; &nbsp; 
                                        <span>Sub Category:</span> {{$request['subCat']}}
                                    </p>
                                    <p>
                                        <?php
                                        	$budgettypes = array('small' => 'Small ($50 - $249)', 'medium' => 'Medium ($250 - $999)', 'large' => 'Large ($1000+)');
                                            $estimated_budget = $budgettypes[$request['estimated_budget']];
                                        ?>
                                        <span>Estimated Budget:</span> {{$estimated_budget}} &nbsp; &nbsp; 
                                    </p>
                                    
                                    <p>
                                        <span>Project Image:</span> 
                                        @if (!empty($request['image']))
                                            <img src="{{url("img/requestservice/".date('Y', strtotime($request['created_at']))."/"
                                                        .date('n', strtotime($request['created_at']))."/"
                                                        .date('d', strtotime($request['created_at']))."/".$request['image'])}}">
                                        @endif
                                    </p>
                                    
                                    @if ($userType == 1)
                                        <p><span>Request Status:</span> {{getRequestStatus($request['status'])}}</p>
                                        @if(count($quotes) !=0  )
                                        <div class="publicmessage">
                                            <a href="{{url('publicMessage')}}/{{$request['id']}}">Send Public Message</a>
                                        </div>
                                        @endif
                                        @if ($request['quoteStatus'] == 1)
                                            <p>
                                                <span>Accepted Quote:</span> {{$request['price']}}
                                                <!--<span>Buyer:</span> {{$request['price']}}-->
                                            </p>
                                        @endif
                                    @else
                                        <p>
                                            <span>Your Quote:</span> ${{($request['price'] == null)?"N/A":$request['price']}} &nbsp; &nbsp; 
                                            <span>Quote Status:</span> 
                                            {{($request['quoteInvitaionStatus'] == 2)?"Rejected by you":getQuoteStatus($request['quoteStatus'])}}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-4 dashboardProjectRightLinksCont">
                                    <ul>
                                        @if ($userType == 1)
                                            <!--<li><a href="">Edit {{$userPostType}}</a></li>-->
                                        @else
                                            @if ($request['quoteInvitaionStatus'] == 0)
                                                 <li><a href="{{url('send-quote/'.$request['id'])}}">Send {{$userPostType}}</a></li>
                                            @endif
                                        @endif
                                        @if ($userType == 2 && $request['quoteInvitaionStatus'] != 1)
                                            <li>
                                                @if ($request['quoteInvitaionStatus'] == 0)
                                                    <a href="{{url('reject-quote/'.$request['quoteInvitaionid'])}}" class="dashboardProjectRightLinkEndBtn"
                                                       onclick="return confirm('Are you sure you want to reject?');">
                                                        Reject {{$userPostType}}</a>
                                                @else
                                                    <a class="dashboardProjectRightLinkEndBtn">Rejected {{$userPostType}}</a>
                                                @endif
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="row dashboardProjectContentCont dashboardProjectContentContNw">
                                <div class="col-md-12">
                                    <div style="height: 240px;" id="map_canvas"></div>
                                    <!--<img src="{{asset('img/front/map_2.png')}}" alt="" />-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 msgs"><h5>Quotes</h5></div>
                                @if (count($quotes) > 0 )
                                    @foreach($quotes as $quote)
                                        <div class="col-sm-12 msgs">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <b>{{$quote['first_name']}} {{substr($quote['last_name'], 0, 1)}}, {{$quote['business_name']}}</b>
                                                </div>
                                                <div class="col-sm-4">
                                                    <b>Price:</b> ${{$quote['price']}}
                                                </div>
                                                <div class="col-sm-2">
                                                    <img src="{{ asset('img/front/time.png') }}"> 
                                                    <label>{{date('m-d-Y', strtotime($quote['created_at']))}}</label>         
                                                </div>
                                                <div class="col-sm-2">
                                                    <img src="{{ asset('img/front/watch.png') }}"> 
                                                    <label>{{date('g:i A', strtotime($quote['created_at']))}}</label>                                       
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="more">{!!$quote['description']!!}</span>
                                                    <div class="row  links">
                                                        <div class="col-sm-6">
                                                            @if (!empty($quote['quoteFile']))
                                                                <a href="{{url("img/requests/".date('Y', strtotime($quote['created_at']))."/"
                                                                            .date('n', strtotime($quote['created_at']))."/"
                                                                            .date('d', strtotime($quote['created_at']))."/".$quote['quoteFile'])}}" 
                                                                            class="link" target="_blank">
                                                                    <img src="{{ asset('img/front/doc.png') }}"> &nbsp Download Attached File
                                                                </a>
                                                            @endif
                                                        </div>

                                                        <div class="col-sm-6 pull-right read"><!-- <a href="#" class="read_more">Read More >> </a> &nbsp &nbsp &nbsp  -->
<!--                                                            <a class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <img src="{{asset('img/front/arrow.png') }}">
                                                            </a>-->
                                                            @if ($request['status'] != 3)
                                                                @if ($userType == 1)
                                                                    <a href="{{url('accept-quote/'.$quote['id'])}}">Accept Quote</a> &nbsp; &nbsp; &nbsp;
                                                                @else
                                                                     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                @endif
                                                                <a href="{{url('message-details/'.$quote['id'])}}">Send Message</a>
                                                            @else
                                                                @if ($quote['status'] == 1) 
                                                                    <a>Accepted Quote</a> &nbsp; &nbsp;
                                                                    <a href="{{url('message-details/'.$quote['id'])}}">Send Message</a>
                                                                    
                                                                    @if($userType == 1 && $request['reviewRequest'] == 0)
                                                                    
                                                                    
                                                                    <div class="row" id="rate">
                                                                        <form action="{{url('suppliers-review')}}" method="post">
                                                                            <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                                                            <div class="col-sm-12 search">
                                                                                <textarea type="review" class="form-control" name="reviews" placeholder="Enter your review" 
                                                                                          ></textarea>
                                                                            </div>
                                                                            <div class="col-sm-5 search-btn">
                                                                                <input type="submit" class="btn btn-primary search-button" name="suppliersreview" value="submit" />
                                                                                <input type="hidden" id="supplier-stars"  class="" name="stars" value="" />
                                                                                <input type="hidden" id="supplier-id"  class="" name="supplierId" value="{{$quote['supplier_id']}}" />
                                                                                <input type="hidden" id="supplier-slug"  class="" name="slug" value="{{$request['id']}}" />
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
                                                            @endif
<!--                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                <li><a href="{{url('accept-quote/'.$quote['id'])}}">Accept Quote</a></li>
                                                                <li><a href="#">Reject Quote</a></li>
                                                                <li><a href="{{url('message-details/'.$quote['id'])}}">Send Message</a></li>
                                                            </ul>-->
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                    @endforeach
                                @else
                                    <p>No Quotes</p>
                                @endif
                            </div>
                            
                        </div>
                    </div>



                    <script type="text/javascript">
                        $(document).ready(function() {
                            // Configure/customize these variables.
                            var showChar = 180;  // How many characters are shown by default
                            var ellipsestext = "";
                            var moretext = "Read more >>";
                            var lesstext = "Read less >>";


                            $('.more').each(function() {
                                var content = $(this).html();

                                if(content.length > showChar) {

                                    var c = content.substr(0, showChar);
                                    var h = content.substr(showChar, content.length - showChar);

                                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<div class="col-sm-3 pull-right read"> <a href="" class="morelink">' + moretext + '</a> </div></span>';

                                    $(this).html(html);
                                }

                            });


                            $(".morelink").click(function(){
                                if($(this).hasClass("less")) {
                                    $(this).removeClass("less");
                                    $(this).html(moretext);
                                } else {
                                    $(this).addClass("less");
                                    $(this).html(lesstext);
                                }
                                $(this).parent().prev().toggle();
                                $(this).prev().toggle();
                                return false;
                            });
                            
                            
                            
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
                            addPinOnMap("{{$request['cityName']}}, {{$request['stateName']}}");
                        });
                    </script>

@endsection
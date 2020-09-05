@extends('templates.dashboard_pages_forhomepage_project')
@section('page_title') Project Details @endsection
@section('breadCrumps')

@endsection
@section('page-content')

                    <div class="dashboardMyPostedProjectsCont">
                        <div class="dashMyPostedProject homepageproject">
                            <div class="row dashboardProjectHeaderCont">
                                <div class="col-md-8 dashboardProjectTitleCont">
                                    <h1 style="text-align:left">{{$request['title']}}</h1>
                                    <h5>{{$buyer_detail->first_name}} {{substr($buyer_detail->last_name, 0, 1)}} , {{$request['cityName']}} {{$request['iso']}} </h5>
                                    
                                    <div class="detailprop">
                                        
                                        
                                    </div>
                                    
                                    <p>
                                        <img src="{{asset('img/front/icon_calander.png')}}" alt=""/> 
                                        {{date('F j, Y', strtotime($request['created_at']))}}
                                        <img src="{{asset('img/front/Job-Detail-clock.png')}}" alt="" style="margin-left : 20px"/> 
                                        {{date('h:ia', strtotime($request['created_at']))}}
                                    </p>
                                    <p class="dashboardProjectMainDetails">
                                        <span> Budget :@if($request['estimated_budget']==null) Not specified @else ${{$request['estimated_budget']}} / @if($request['budget_type']==0) Project @elseif($request['budget_type']==1) Hour @endif @endif</span> 
                                    </p>
                                    
                                </div>
                               
                            </div>
                            
                            
                            <div class="row dashboardProjectContentConts homeprojectdetail_row">
                               
                                
                                
                                <div class="col-md-12 homeprojectdetail">
                                    
                                    <div class="col-md-8 dashboardProjectContentConts homeprojectdetail">
                                   
                                    <h3>Detail </h3>
                                    
                                    <p>{!!$request['description']!!}</p>
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                <div class="col-md-4 dashboardProjectContentConts homeprojectdetail">
                                    
                                   
                                    
                                    <p>
                                        
                                        @if (!empty($request['image']))
                                            <img src="{{url("img/requestservice/".date('Y', strtotime($request['created_at']))."/"
                                                        .date('n', strtotime($request['created_at']))."/"
                                                        .date('d', strtotime($request['created_at']))."/".$request['image'])}}">
                                        @endif
                                    </p>
                                    
                                </div>
                                    
                                </div>
                                @if ($userType == 2)
                                <a href="{{url('Respond_to_request')}}/{{$request['id']}}" class="btn">Respond to this request</a>
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
                        });
                    </script>

                    <script type="text/javascript">
                        $('document').ready(function () {
                            addPinOnMap("{{$request['cityName']}}, {{$request['stateName']}}");
                        });
                    </script>

@endsection
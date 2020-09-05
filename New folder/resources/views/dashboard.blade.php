@extends('templates.dashboard_pages_template')
@section('page_title') {{$dashboardUser}} Dashboard @endsection
@section('page-content')


                    @include("partials.form_errors")
                    <div class="dashboardMyPostedProjectsCont">
                        <h5>My {{$userPostType}}s</h5>
                        @if (!empty($requests ))
                            @foreach($requests as $request)
                            {{--*/ $request = (array) $request; /*--}}
                            <?php // printr($request);exit; ?>
                                <div class="dashMyPostedProject">
                                    <div class="row dashboardProjectHeaderCont">
                                        <div class="col-md-8 dashboardProjectDateCont">
                                            <p>{{$request['title']}}</p>
                                        </div>
                                        <div class="col-md-4 dashboardProjectDateCont text-right">
                                            <p><img src="{{asset('img/front/icon_calander.png')}}" alt=""/> {{date('m-d-Y', strtotime($request['created_at']))}}</p>
                                        </div>
                                    </div>
                                    <div class="row dashboardProjectContentCont">
                                        <div class="col-md-7 dashboardProjectMainDetails">
                                            <p>{!!$request['description']!!}</p>
                                            @if ($userType == 1)
                                                <p>
                                                    <span>Request Status:</span> {{getRequestStatus($request['status'])}}
                                                </p>
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
<!--                                            <p><br />
                                                <a href="">View {{$userPostResponser}} (0)</a> 
                                                <a href="">Send Message</a>
                                            </p>-->
                                        </div>
                                        <div class="col-md-5 dashboardProjectRightLinksCont" id="dashquick-req">
                                            <ul>
                                                <li>
                                                    @if ($userType == 1)
                                                        <!--<a href="">Edit {{$userPostType}}</a>-->
                                                    @else
                                                        @if ($request['quoteInvitaionStatus'] == 0)
                                                            <a href="{{url('send-quote/'.$request['id'])}}">Send {{$userPostType}}</a>
                                                        @endif
                                                    @endif
                                                </li>
                                                <li>
                                                    <a href="{{url('project-details/'.$request['id'])}}" class="dashboardProjectRightLinkViewBtn">
                                                        View Request / Quote</a>
                                                </li>
                                                    @if ($userType == 1)
                                                <li>
                                                    <a href="{{url('requestSupplier/'.$request['id'])}}" class="dashboardProjectRightLinkViewBtn">
                                                        View Contractors</a>
                                                </li>
                                               
                                                @if ($request['quoteStatus'] == 1)
                                                
                                                <li>
                                                    <a href="{{url('project-details/'.$request['id'].'#rate')}}" class="dashboardProjectRightLinkViewBtn">
                                                        Rate Contractor</a>
                                                </li>
                                                
                                                @endif
                                                
                                                @endif
                                                
                                                @if ($userType == 2 && $request['quoteInvitaionStatus'] != 1)
                                                    <li>
                                                        @if ($request['quoteInvitaionStatus'] == 0)
                                                            <a href="{{url('reject-quote/'.$request['quoteInvitaionid'])}}" class="dashboardProjectRightLinkEndBtn"
                                                               onclick="return confirm('Are you sure you want to reject?');">
                                                                Reject {{$userPostType}}</a>
                                                        @else
                                                            <a class="dashboardProjectRightLinkEndBtn">
                                                                Rejected {{$userPostType}}</a>
                                                        @endif
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No {{$userPostType}}s Found</p>
                        @endif
                        
<!--                        <div class="dashMyPostedProject">
                            <div class="row dashboardProjectHeaderCont">
                                <div class="col-md-8 dashboardProjectDateCont">
                                    <p>Electrician - SW1000081</p>
                                </div>
                                <div class="col-md-4 dashboardProjectDateCont text-right">
                                    <p><img src="{{asset('img/front/icon_calander.png')}}" alt=""/> 07/13/2015</p>
                                </div>
                            </div>
                            <div class="row dashboardProjectContentCont">
                                <div class="col-md-7 dashboardProjectMainDetails">
                                    <p>Kitchen Renovation</p>
                                    <p><span>Status:</span> Pending</p>
                                    <p><br />
                                        <a href="">View Supplier (0)</a> 
                                        <a href="">Send Message</a>
                                    </p>
                                </div>
                                <div class="col-md-5 dashboardProjectRightLinksCont">
                                    <ul>
                                        <li><a href="">Edit Request</a></li>
                                        <li><a href="" class="dashboardProjectRightLinkViewBtn">View Request</a></li>
                                        <li><a href="" class="dashboardProjectRightLinkEndBtn">End Request</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>-->
                    </div>
@endsection
@extends('templates.dashboard_pages_template')
@section('page_title') Message @endsection
@section('page-content')

                    @include("partials.form_errors")
                    <form role="form" method="POST" action="{{ url('message-create') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="registrationFormCont">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="formHeadingWithStyle">
                                                <span>Message<span></span></span>
                                            </h1>
                                        </div>
                                        <div class="col-sm-12">
                                            <h3>Request Title: <span class="font-normal">{{$requestDetails->title}}</span></h3>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <label><b>Enter your Message</b></label>
                                            <div class="input-group mbox">
                                                <textarea cols="100" rows="5" class="form-control input-lg" name="message" 
                                                          aria-describedby="basic-addon1"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Upload Files</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-btn input-group-lg">
                                                    <span class="btn btn-primary btn-file">
                                                        <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                                                        <input type="file" name="file">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control input-lg" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label> </label>
                                            <input type="hidden" name="quoteid" value="{{$quoteid}}" />
                                            <input type="submit" class="btn btnWithLeftArrow" value="Send"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                    @if (count($messages) > 0 )
                        <div class="row allMessagesListCont">
                            @foreach($messages as $message)
                                <div class="col-sm-12 msgs @if ($userid == $message['sender_id']) currentUserMessage @endif">
                                    <div class="col-sm-4">
                                        <b>
                                            @if ($userid == $message['sender_id']) 
                                                You
                                            @else 
                                                @if ($userType == 2)
                                                    @if ($message->anonymous == 1)
                                                        {{$message->first_name}} {{substr($message->last_name, 0, 1)}}
                                                    @else 
                                                        {{$message->first_name}} {{substr($message->last_name, 0, 1)}}
                                                    @endif
                                                @else
                                                    {{$message['first_name']}} {{substr($message['last_name'], 0, 1)}}, 
                                                    {{$message['business_name']}}
                                                @endif
                                            @endif
                                        </b>
                                    </div>
                                    <div class="col-sm-2">
                                        <img src="{{ asset('img/front/time.png') }}"> 
                                        <label>{{date('m-d-Y', strtotime($message['created_at']))}}</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ asset('img/front/watch.png') }}">  
                                        <label>{{date('g:i A', strtotime($message['created_at']))}}</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="more">{!!$message['message']!!}</span>
                                        <div class="row  links">
                                            <div class="col-sm-6">
                                                @if (!empty($message['file']))
                                                    <a href="{{url("img/messages/".date('Y', strtotime($message['created_at']))."/"
                                                                .date('n', strtotime($message['created_at']))."/"
                                                                .date('d', strtotime($message['created_at']))."/".$message['file'])}}" 
                                                                class="link" target="_blank">
                                                        <img src="{{ asset('img/front/doc.png') }}"> &nbsp Download Attached File
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

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

@endsection
@extends('templates.dashboard_pages_template')
@section('page_title') Messages @endsection
@section('page-content')

                    <div class="messagelist">          
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle">
                                            <span>Messages<span></span></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            @if (count($messagesList) > 0) 
                                @foreach ($messagesList as $message)
                                    <div class="col-sm-12 singlemessage">
                                        <div class="row">
                                            <a href="{{url('message-details/'.$message->quote_id)}}">
                                                <div class="col-xs-2">
                                                    <div class="name">
                                                        @if ($userid == $message->sender_id)
                                                            You
                                                        @else 
                                                            @if ($userType == 2)
                                                                @if ($message->anonymous == 1)
                                                                    {{$message->first_name}} {{$message->last_name}}
                                                                @else 
                                                                    {{$message->first_name}} {{substr($message->last_name, 0, 1)}}
                                                                @endif
                                                            @else
                                                                {{$message->first_name}} {{$message->last_name}}
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xs-7 {{($userid != $message->sender_id && $message->status == 0)?'text-bold':''}}">
                                                    <div class="message" title="{{$message->message}}">{{str_limit(strip_tags($message->message), $limit = 50, $end = '...')}}</div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="project" title="{{$message->title}}">{{str_limit($message->title, $limit = 20, $end = '...')}}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No Messages Found</p>
                            @endif

                        </div>
                    </div>









@endsection
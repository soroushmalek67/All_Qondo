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
                                                <span>Public Message<span></span></span>
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
                                                <input type="hidden" name="request_id" value="{{$requestDetails->requestId}}">
                                                <input type="text" class="form-control input-lg" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Supplier *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_state.png') }}" alt="" /></span>
                                          
                                            <select name="supplier[]" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                    multiple
                                                    data-live-search="true">
                                                <option value="">Select Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{$supplier->user_id}}">{{$supplier->business_name}}</option>
                                                @endforeach
                                               
                                            </select>
                                        </div>
                                    </div>
                                        
                                        <div class="col-sm-12">
                                            <label> </label>

                                            <input type="submit" class="btn btnWithLeftArrow" value="Send"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                   
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
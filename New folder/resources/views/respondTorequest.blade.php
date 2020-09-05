@extends('templates.dashboard_pages_forhomepage_project')
@section('page_title') Message @endsection
@section('page-content')

                    @include("partials.form_errors")
                    <form role="form" method="POST" action="{{ url('Respond_to_request') }}/{{$requestid}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="registrationFormCont">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="formHeadingWithStyle">
                                                <span>Respond to Request<span></span></span>
                                            </h1>
                                        </div>
                                        <div class="col-sm-12">
                                            <h3>Request Title: <span class="font-normal">{{$request->title}}</span></h3>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <label><b>Enter your Message</b></label>
                                            <div class="input-group mbox">
                                                <textarea cols="100" rows="5" class="form-control input-lg" name="message" 
                                                          aria-describedby="basic-addon1"></textarea>
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

                   
                    

@endsection
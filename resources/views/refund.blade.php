@extends('templates.dashboard_pages_template')
@section('page_title') Refund @endsection
@section('page-content')
            <div class="messagelist">
            
                <form role="form" method="POST" action="{{ url('refund') }}" id="requestServiceForm" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="formHeadingWithStyle">
                                <span>Refund Details<span></span></span>
                            </h1>
                        </div>
                        <div class="col-sm-12">@include("partials.form_errors")</div>
                        <div class="col-sm-12 loginFormSectionNwForm">
                            <div class="loginFormSectionNwFormInner">
                                <div class="row">
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Subject *</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{asset('img/front/form_icon_bus_name.png')}}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="subject"  required 
                                                   aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Reference Transaction *</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{asset('img/front/form_icon_bus_name.png')}}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="refrence_transaction"  required 
                                                   aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    
                                   
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Reason *</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{asset('img/front/form_icon_desc.png')}}" alt="" /></span>
                                            <textarea class="form-control input-lg" name="reason" required rows="5"
                                                      aria-describedby="basic-addon1"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>Transaction</label>
                                                <div class="input-group login-field">
                                                    <span><img src="{{asset('img/front/form_icon_estimate_budget.png')}}" alt="" /></span>
                                                    <input type="number" class="form-control input-lg" name="transaction"  
                                                           aria-describedby="basic-addon1" min="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
<!--                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Where Do You Need It?</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{asset('img/front/form_icon_where_you_need.png')}}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="postalcode" value="{{old('postalcode')}}" 
                                                   onblur="codeAddress(this.value)" id="postalcode" aria-describedby="basic-addon1" placeholder="Your Postal Code. e.g., A1A 1B1">
                                        </div>
                                    </div>-->
                                    
                                    
                                    
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label> </label>
                                        <input type="hidden" name="lati" value="{{old('lati')}}"/>
                                        <input type="hidden" name="longi" value="{{old('longi')}}"/>
                                        <input type="hidden" name="userType" value="1"/>
                                        <input type="hidden" name="iAmA" value="1"/>
                                        <div class="text-center submit-btn-auth">
                                            <input type="submit" class="" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
@endsection
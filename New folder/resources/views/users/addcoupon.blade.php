@extends('templates.dashboard_pages_template')
@section('page_title') Profile @endsection
@section('page-content')

                    @include("partials.form_errors")
                        <form role="form" method="POST" action="{{ url('promotion-coupon') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="registrationFormCont">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle">
                                            <span>Promotion/coupons Information<span></span></span>
                                        </h1>
                                    </div><div class="col-sm-12"><h5>* indicates required fields</h5></div>
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Title *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="coupon_title" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('coupon_title'), '')}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Describe your Promotion/coupon *</label>
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                                            </span>
                                            <textarea class="form-control input-lg" aria-describedby="basic-addon1" name="describe_coupon">{{profileGetFieldsValues(old('describe_coupon'),'')}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Stars</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                            <input type="number" min="0" step="1" max="5" class="form-control input-lg" name="coupon_star" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('coupon_star'), '')}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Discount</label>
                                       <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                            <input type="number" min="0" step="1" class="form-control input-lg" name="coupon_discount" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('coupon_discount'), '')}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Product image</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-btn input-group-lg">
                                                <span class="btn btn-primary btn-file">
                                                    <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                                                    <input type="file" name="coupon_image_file" value="{{old('')}}">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control input-lg" readonly>
                                        </div>
                                    </div>
                                                                        
                                    
                                     <div class="col-sm-12 registrationFormFieldCont">
                                        <label> </label>
                                        <input type="hidden" name="lati" value=""/>
                                        <input type="hidden" name="longi" value=""/>
                                        <input type="submit" class="btn btnWithRightArrow" value="Add"/>
                                    </div>
                        </form>
                       
@endsection
@extends('templates.dashboard_pages_template')
@section('page_title') Profile @endsection
@section('page-content')

                    @include("partials.form_errors")
                        <form role="form" method="POST" action="{{ url('service-product') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="registrationFormCont">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle">
                                            <span>Service/Product Information<span></span></span>
                                        </h1>
                                    </div><div class="col-sm-12"><h5>* indicates required fields</h5></div>
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Title *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="product_title" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('product_title'),$products->name )}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Describe your services/products *</label>
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                                            </span>
                                            <textarea class="form-control input-lg" aria-describedby="basic-addon1" name="describe_product">{{profileGetFieldsValues(old('describe_product'),$products->description)}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Product image</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-btn input-group-lg">
                                                <span class="btn btn-primary btn-file">
                                                    <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                                                    <input type="file" name="product_image_file" value="{{old($products->image)}}">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control input-lg" readonly>
                                        </div>
                                        
                                    </div>
                                                                        
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>
                                            @if (empty($products->image)) 
                                                No Logo 
                                            @else
                                                <img src="{{url("img/product/".getFolderStructureByDate($products->created_at)."/"
                                                            .$products->image)}}" 
                                                     alt="{{profileGetFieldsValues(old('business_name'), $products->image)}}" />
                                            @endif
                                        </label>
                                    </div>
                                     <div class="col-sm-12 registrationFormFieldCont">
                                        <label> </label>
                                        <input type="hidden" value="{{$products->id}}" name="product_id">
                                         <input type="hidden" value="{{$products->created_at}}" name="date">
                                        <input type="hidden" name="lati" value=""/>
                                        <input type="hidden" name="longi" value=""/>
                                        @if($flage!=1)
                                        <input type="submit" class="btn btnWithRightArrow" value="Add" name="product-add"/>
                                        @else
                                        <input type="submit" class="btn btnWithRightArrow" value="update" name="product-add"/>
                                        @endif
                                    </div>
                        </form>
                       
@endsection
@extends('templates.dashboard_pages_template')
@section('page_title') Add Contractor @endsection
@section('page-content')

                    @include("partials.form_errors")
                        <form role="form" method="POST" action="{{ url('save-Supplier') }}{{Auth::id()}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="registrationFormCont">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle">
                                            <span>Add Contractor<span></span></span>
                                        </h1>
                                    </div><div class="col-sm-12"><h5>* indicates required fields</h5></div>
                                    
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>First Name *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="fname" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('fname'),'' )}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Last Name *</label>
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                                            </span>
                                             <input type="text" class="form-control input-lg" name="lname" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('lname'),'' )}}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Email *</label>
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                                            </span>
                                             <input type="email" class="form-control input-lg" name="email" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('email'),'' )}}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Phone Number *</label>
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                                            </span>
                                             <input type="text" class="form-control input-lg" name="pnumber" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('pnumber'),'' )}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 registrationFormFieldCont">
                                         <label>Business Name *</label>
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                                            </span>
                                             <input type="text" class="form-control input-lg" name="businuss" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('businuss'),'' )}}" />
                                        </div>
                                    </div>
                                    
                                    
                                    <!--sohail changing-->
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Main Category *</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
                                            <select name="main_categories[]" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                onchange="getSubCategories(this);" multiple>
                                                {{--*/ $selectedCatId = profileGetFieldsValues(old('main_categories'), explode(",", $userDetails->main_categories)) /*--}}
                                                @foreach ($categories as $category)
                                                    <option 
                                                             value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Sub Category *</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/form_icon_sub_cat.png') }}" alt="" /></span>
                                            <select name="sub_categories[]" id="sub_categories" class="customDropdown form-control input-lg"  
                                                    aria-describedby="basic-addon1">
                                                <option value="">Select Sub Categories</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <!--sohail changing-->
                                    
                                    
                                    
                                    
                                    
<!--                                     <div class="col-sm-6 registrationFormFieldCont clear-left">
                                        <label>Main Categories *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                            <select name="main_categories[]" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                onchange="getSubCategories(this, '{{implode(",", profileGetFieldsValues(old("sub_categories"), 
                                                explode(",", $userDetails->sub_categories)))}}', true);" multiple>
                                                {{--*/ $selectedCatId = profileGetFieldsValues(old('main_categories'), explode(",", $userDetails->main_categories)) /*--}}
                                                @foreach ($categories as $category)
                                                    <option 
                                                             value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Sub Categories *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_sub_cat.png') }}" alt="" /></span>
                                            <select name="sub_categories[]" id="sub_categories" class="customDropdown form-control input-lg" 
                                                    aria-describedby="basic-addon1" multiple>
                                            </select>
                                        </div>
                                    </div>-->
                                    
                                     <div class="col-sm-12 registrationFormFieldCont">
                                        <label> </label>
                                        <input type="submit" class="btn btnWithRightArrow" value="Add" name="product-add"/>
                                        
                                        
                                    </div>
                        </form>
                       
@endsection

 <script type="text/javascript">
                            jQuery(window).ready(function() {
                                getSubCategories("[name='main_categories[]']", 
                                    '{{implode(",", profileGetFieldsValues(old("sub_categories"), explode(",", $userDetails->sub_categories)))}}', true);
                                getCities("[name='state']", 'city', '{{profileGetFieldsValues(old("city"), $userDetails->city)}}');
                                getCities("[name='service_states[]']", 'service_cities', 
                                    '{{implode(",", profileGetFieldsValues(old("service_cities"), explode(",", $userDetails->service_cities)))}}', true);
                                    getawards("[name='award[]']", 'award', 
                                    '{{implode(",", profileGetFieldsValues(old("award"), explode(",", $userDetails->award)))}}', true);
                            });
                        </script>
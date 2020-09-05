@extends('admin.app')

@section('htmlheader_title') Add Category @endsection
@section('contentheader_title')
    Users
    <a class="btn btn-default" href="{{ url('admin-panel/users/add') }}"><i class="fa fa-plus"></i></a>
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Add User</h3>
    </div><!-- /.box-header -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('admin-panel/users/save') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="userid" value="{{ $userDetails->id }}">
        <div class="box-body">
        
            <div class="registrationFormCont">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="formHeadingWithStyle">
                            <span>Account Information<span></span></span>
                        </h1>
                    </div>
                    <div class="col-sm-12 registrationFormFieldCont">
                        <label>My company is a *</label><br/>
                        <span class="radioBtnCont">
                            <input type="radio" name="user_type" value="1" id="iAmAVal1" onclick="showHideSupplierFields()"
                                   @if (profileGetFieldsValues(old('user_type'), $userDetails->user_type) == 1) checked  @endif />
                            <label for="iAmAVal1">Buyer</label>
                        </span>
                        <span class="radioBtnCont">
                            <input type="radio" name="user_type" value="2" id="iAmAVal2" onclick="showHideSupplierFields()" 
                                   @if (profileGetFieldsValues(old('user_type'), $userDetails->user_type) == 2) checked  @endif />
                            <label for="iAmAVal2">Supplier</label>
                        </span>
                        <span class="radioBtnCont">
                            <input type="radio" name="user_type" value="3" id="iAmAVal3" onclick="showHideSupplierFields()" 
                                   @if (profileGetFieldsValues(old('user_type'), $userDetails->user_type) == 3) checked  @endif />
                            <label for="iAmAVal3">Both</label>
                        </span>
                    </div>
                    
                     @if($userDetails->user_type == 2 || $userDetails->user_type == 3 )
                        
                        

                             <div class="form-group col-sm-12">
                                 <div class="col-sm-9">
                                            <label class="control-label">Show on home page</label>
                                            <input type="checkbox" class="control-label" name="top_supplier" aria-describedby="basic-addon1" 
                                           value="1" <?php echo ($userDetails->top_supplier==1 ? 'checked' : '');?> />
                                        </div>
                                    </div>
                        @endif
                    
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>First Name *</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="first_name" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('first_name'), $userDetails->first_name)}}" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Last Name *</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="last_name" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('last_name'), $userDetails->last_name)}}" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Job Position</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_job_icon.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="job_position" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('job_position'), $userDetails->job_position)}}" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Email *</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_email.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="email" aria-describedby="basic-addon1" 
                                   value="{{profileGetFieldsValues(old('email'), $userDetails->email)}}" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_password.png') }}" alt="" /></span>
                            <input type="password" class="form-control input-lg" name="password" aria-describedby="basic-addon1" 
                                   value="{{profileGetFieldsValues(old('password'), '')}}" placeholder="**********"/>
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_password.png') }}" alt="" /></span>
                            <input type="password" class="form-control input-lg" name="password_confirmation" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('password_confirmation'), '')}}" placeholder="**********" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_phone.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="phone_number" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('phone_number'), $userDetails->phone_number)}}" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Mobile Phone</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_phone.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="mobile_number" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('mobile_number'), $userDetails->mobile_number)}}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="formHeadingWithStyle formBussnissInfoHeading">
                            <span>Business Information<span></span></span>
                        </h1>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
                        <label>Business Name *</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_bus_name.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="business_name" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('business_name'), $userDetails->business_name)}}" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
                        <label>Business Number</label> &nbsp;
                        <a data-toggle="tooltip" title="Required for issuing invoices and estimating tax">
                            <i class="glyphicon glyphicon-info-sign"></i></a>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_tax_id.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="tax_id" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('tax_id'), $userDetails->tax_id)}}" />
                        </div>
                    </div>
                  
                    {{--*/$selected_building = profileGetFieldsValues(old('building_id'), $userDetails->building_id)/*--}}
                    <div class="col-sm-6 registrationFormFieldCont buyers-fields">
                        <label>Building Name *</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_bus_name.png') }}" alt="" /></span>
                            
                            <select  name="building_id" id="building_id" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" data-live-search="true">
                                        <option value="">Select Building</option>
                                        
                                        @forelse ($buildings as $building)
                                        <option @if($building->id == $selected_building) selected @endif value="{{$building->id}}">{{$building->building_name}}</option>
                                        @empty 
                                        
                                        @endforelse;
                                        
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 registrationFormFieldCont">
                        <label>Describe your services/products</label>
                        <div class="input-group">
                            <span id="basic-addon1" class="input-group-addon input-lg">
                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                            </span>
                            <textarea class="form-control input-lg" aria-describedby="basic-addon1" name="describe_product">{{profileGetFieldsValues(old('describe_product'), $userDetails->describe_product)}}</textarea>
                        </div>
                    </div>
<!--                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Industries You Buy From </label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_you_buy_from.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                            <select name="industries_you_buy[]" class="customDropdown form-control input-lg" 
                                    aria-describedby="basic-addon1" multiple data-live-search="true">
                                <option value="">Select Industries</option>
                                {{--*/ $catsSelectedids = profileGetFieldsValues(old('industries_you_buy'), explode(",", $userDetails->industries_you_buy)) /*--}}
                                @foreach ($linkedinIndustries as $category)
                                    <option @if (in_array($category->id, $catsSelectedids)) selected @endif 
                                             value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Industries You Sell To</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_you_sell_to.png') }}" alt="" /></span>
                            <select name="industries_you_sell[]" class="customDropdown form-control input-lg" 
                                    aria-describedby="basic-addon1" multiple data-live-search="true">
                                <option value="">Select Industries</option>
                                {{--*/ $catsSelectedids = profileGetFieldsValues(old('industries_you_sell'), explode(",", $userDetails->industries_you_sell)); /*--}}
                                @foreach ($linkedinIndustries as $category)
                                    <option @if (in_array($category->id, $catsSelectedids)) selected @endif 
                                             value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>-->
                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
                        <label>Street Address</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_position_icon.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="street_address" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('street_address'), $userDetails->street_address)}}"
                                    onblur="addPinToMapOnRegisterPage()" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
                        <label>Province/State</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1">
                                <img src="{{ asset('img/front/form_icon_state.png') }}" alt="" /></span>
                            {{--*/ $selectedStatesids = profileGetFieldsValues(old('state'), $userDetails->state); /*--}}
                            
                            
                            <select name="state" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                    onchange="getCities(this, 'city', '{{profileGetFieldsValues(old("city"), $userDetails->city)}}');" 
                                    data-live-search="true">
                                <option value="">Select Province/State</option>
                                @foreach ($states as $state)
                                    <option @if ($state->id == $selectedStatesids)) selected @endif value="{{$state->id}}" 
                                             data-stateiso="{{$state->iso}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
                        <label>City</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1">
                                <img src="{{ asset('img/front/form_icon_city.png') }}" alt="" /></span>
                            <select name="city" id="city" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                    data-live-search="true">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
                        <label>Postal Code</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_zip.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="postal_code" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('postal_code'), $userDetails->postal_code)}}" 
                                    onblur="addPinToMapOnRegisterPage()" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
                        <label>Country</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1">
                                <img src="{{ asset('img/front/form_icon_phone.png') }}" alt="" /></span>
                            <select name="country" class="customDropdown form-control input-lg" aria-describedby="basic-addon1">
                                <option value="Canada">Canada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Website</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_site.png') }}" alt="" /></span>
                            <input type="text" class="form-control input-lg" name="website" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('website'), $userDetails->website)}}" />
                        </div>
                    </div>
                </div>
                <div id="supplierFieldsCont">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <h1 class="formHeadingWithStyle formBussnissInfoHeading">
	                            <span>Service or Product Information<span></span></span>
	                        </h1>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-6 registrationFormFieldCont">
	                        <label>Company Logo</label>
	                        <div class="input-group input-group-lg">
	                            <span class="input-group-btn input-group-lg">
	                                <span class="btn btn-primary btn-file">
	                                    <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
	                                    <input type="file" name="company_logo_file" value="{{old('company_logo_file')}}">
	                                </span>
	                            </span>
	                            <input type="text" class="form-control input-lg" readonly>
	                        </div>
	                    </div>
	                    <div class="col-sm-6 registrationFormFieldCont">
	                        <label>
	                            @if (empty($userDetails->company_logo)) 
	                                No Logo 
	                            @else
	                                <img src="{{url("img/compay_logos/".getFolderStructureByDate($userDetails->created_at)."/"
	                                            .$userDetails->company_logo)}}" height="100"
	                                     alt="{{profileGetFieldsValues(old('business_name'), $userDetails->business_name)}}" />
	                            @endif
	                        </label>
	                    </div>
	                </div>
                    <div class="row">
                                            <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Profile Banner</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-btn input-group-lg">
                                                    <span class="btn btn-primary btn-file">
                                                        <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                                                        <input type="file" name="company_banner_file" value="{{old('company_banner_file')}}">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control input-lg" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>
                                                @if (empty($userDetails->company_banner)) 
                                                    No Logo 
                                                @else
                                                    <img src="{{url("img/profile_banner/".getFolderStructureByDate($userDetails->created_at)."/"
                                                                .$userDetails->company_banner)}}" 
                                                         alt="{{profileGetFieldsValues(old('business_name'), $userDetails->business_name)}}" />
                                                @endif
                                            </label>
                                        </div>
                                    </div>
	                <div class="row">
	                    <div class="col-sm-6 registrationFormFieldCont clear-left">
	                        <label>Main Categories *</label>
	                        <div class="input-group">
	                            <span class="input-group-addon input-lg" id="basic-addon1">
	                                <img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
	                            <!--<input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">-->
	                            <select name="main_categories[]" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
	                                onchange="getSubCategories(this, '{{implode(",", profileGetFieldsValues(old("sub_categories"), 
	                                explode(",", $userDetails->sub_categories)))}}', true);" multiple>
	                                {{--*/ $selectedCatId = profileGetFieldsValues(old('main_categories'), explode(",", $userDetails->main_categories)) /*--}}
	                                @foreach ($categories as $category)
	                                    <option @if (in_array($category->id, $selectedCatId)) selected @endif 
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
	                    </div>
	                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
	                        <label>Province/State * <?php // printr(explode(",", $userDetails->service_cities)) ?></label>
	                        <div class="input-group">
	                            <span class="input-group-addon input-lg" id="basic-addon1">
	                                <img src="{{ asset('img/front/form_icon_state.png') }}" alt="" /></span>
	                            {{--*/ $selectedStatesids = profileGetFieldsValues(old('service_states'), explode(",", $userDetails->service_states)); /*--}}
	                            <select name="service_states[]" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
	                                    onchange="getCities(this, 'service_cities', '{{implode(",", 
	                                        profileGetFieldsValues(old("service_cities"), explode(",", $userDetails->service_cities)))}}', true);" 
	                                    data-live-search="true" multiple>
	                                <option value="">Select Province/State</option>
	                                @foreach ($states as $state)
	                                    <option @if (in_array($state->id, $selectedStatesids)) selected @endif value="{{$state->id}}" 
	                                             data-stateiso="{{$state->iso}}">{{$state->name}}</option>
	                                @endforeach
	                            </select>
	                        </div>
	                    </div>
	                    <div class="col-sm-6 registrationFormFieldCont supplier-fields">
	                        <label>City *</label>
	                        <div class="input-group">
	                            <span class="input-group-addon input-lg" id="basic-addon1">
	                                <img src="{{ asset('img/front/form_icon_city.png') }}" alt="" /></span>
	                            <select name="service_cities[]" id="service_cities" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
	                                    data-live-search="true" onchange="" multiple>
	                            </select>
	                        </div>
	                    </div>
	
	                    <div class="col-sm-12 registrationFormFieldCont">
	                        <label>Certificates and Awards</label>
	                        <div class="input-group">
	                            <span id="basic-addon1" class="input-group-addon input-lg">
	                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
	                            </span>
	                            <textarea class="form-control input-lg" aria-describedby="basic-addon1" name="certificate_awards" readonly>@foreach($awards as $award){{$award->name}} ,@endforeach </textarea>
	                        </div>
	                    </div>
<!--                            <p>Date: <input type="text" id="datepicker"></p>-->
<!--                            <div class="col-sm-6 registrationFormFieldCont">
                                <div class="container">
                                    <div class="row">
                                        <div class='col-sm-6'>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker1').datetimepicker();
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>-->
	    <!--                                    <div class="col-sm-6 registrationFormFieldCont">
	                        <label>Service Kilometers</label>
	                        <div class="input-group">
	                            <span class="input-group-addon input-lg" id="basic-addon1">
	                                <img src="{{ asset('img/front/form_icon_service_kilometers.png') }}" alt="" /></span>
	                            <input type="text" class="form-control input-lg" id="service_kilometers" name="service_kilometers" 
	                                   aria-describedby="basic-addon1" onblur="addPinToMapOnRegisterPage()" 
	                                   value="{{profileGetFieldsValues(old('service_kilometers'), $userDetails->service_kilometers)}}"/>
	                        </div>
	                    </div>-->
	    <!--                                    <div class="col-sm-6 registrationFormFieldCont">
	                        <label> </label>
	                        <div style="margin-top: 20px;" id="map_canvas"></div>
	                    </div>-->
	                </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Dedicated Domain URL</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_site.png') }}" alt="" /></span>
                            <input type="url" class="form-control input-lg" name="dedicated_url" aria-describedby="basic-addon1" 
                                    value="{{profileGetFieldsValues(old('dedicated_url'), $userDetails->dedicated_url)}}" />
                        </div>
                    </div>
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Status</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1">
                                <img src="{{ asset('img/front/form_icon_city.png') }}" alt="" /></span>
                            <select name="status" class="customDropdown form-control input-lg" aria-describedby="basic-addon1">
                            	<option value=""> - Select Status - </option>
                            	<option value="6" @if (profileGetFieldsValues(old('status'), $userDetails->status) == 6) selected  @endif>Unregistered</option>
                            	<option value="1" @if (profileGetFieldsValues(old('status'), $userDetails->status) == 1) selected  @endif>Approved</option>
                            	<option value="2" @if (profileGetFieldsValues(old('status'), $userDetails->status) == 2) selected  @endif>Pending</option>
                            	<option value="0" @if (profileGetFieldsValues(old('status'), $userDetails->status) == 0) selected  @endif>Unapproved</option>
                            </select>
                            <input type="hidden" value="{{$userDetails->status}}" name="oldStatus"/>
                            <input type="hidden" value="{{$userDetails->added_by}}" name="added_by"/>
                        </div>
                    </div>
                </div>
                <!--sohail changing-->
                
                        
<!--                        <select id="membership" class="customDropdown form-control input-lg">
                            <option>pro</option>
                            <option>Enterprise</option>
                            <option>dedicated</option>
                        </select>-->
                 
                <div class="row" id="memberdiv">    
                    <div class="col-sm-6 registrationFormFieldCont">
                        <label>Membership Type</label>
                        <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_you_sell_to.png') }}" alt="" /></span>
                            <select name="membership" id="prom" class="customDropdown form-control input-lg" 
                                    aria-describedby="basic-addon1" >
                                <!--<option value="">Select Industries</option>-->
                                {{--*/ $pakSelectedids = $userDetails->package; /*--}}
                               <option>Selected</option>
                                <option <?php if($pakSelectedids == 'Enterprise'){ echo "selected"; } ?>>Enterprise</option>
                                <option <?php if($pakSelectedids == 'pro') {echo 'selected';}  ?>>pro</option>
                                <option <?php if($pakSelectedids == 'dedicated'){ echo 'selected';}  ?> >dedicated</option>

                            </select>
                        </div>
                    </div>
                    
                        <div id="numberOfBid" class="col-sm-6 registrationFormFieldCont">
                        <label>NO. of bids</label>
                       <div class="input-group">
                           <?php // $pakvalue=""; if(is_numeric($pakSelectedids)) $pakvalue= $pakSelectedids;   ?>
	                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_site.png') }}" alt="" /></span>
                                    <input type="number" name="numbid" class="form-control input-lg" name="bids" aria-describedby="basic-addon1" min="0" 
	                                    value="{{$userDetails->bids}}" />
	                        </div>
                        
                        </div>
                     <div id="numberOfBid" class="col-sm-6 registrationFormFieldCont">
                        <label>Expire date</label>
                       <div class="input-group">
	                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_site.png') }}" alt="" /></span>
                                    <input type="text" name="datexpire" id="datepicker" class="form-control input-lg" name="bids" aria-describedby="basic-addon1" min="0" 
	                                    value="{{$userDetails->expires_at}}" />
	                        </div>
                        
                        </div>
                    
                   
                     <div  class="col-sm-6 registrationFormFieldCont">
                        <label>Subscription Months</label>
                       <div class="input-group">
                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_you_sell_to.png') }}" alt="" /></span>
                            <select name="subscrption_mnth" id="prom" class="customDropdown form-control input-lg" 
                                    aria-describedby="basic-addon1" >
                                <!--<option value="">Select Industries</option>-->
                                
                                <option value=0 <?php if ($userDetails->subscrption_mnth == 0) echo ' selected="selected"'; ?> >Selected</option>
                                <option value=1 <?php if ($userDetails->subscrption_mnth == 1) echo ' selected="selected"'; ?> >1</option>
                                <option value=2 <?php if ($userDetails->subscrption_mnth == 2) echo ' selected="selected"'; ?> >2</option>
                                <option value=3 <?php if ($userDetails->subscrption_mnth == 3) echo ' selected="selected"'; ?> >3</option>
                                <option value=4 <?php if ($userDetails->subscrption_mnth == 4) echo ' selected="selected"'; ?> >4</option>
                                <option value=5 <?php if ($userDetails->subscrption_mnth == 5) echo ' selected="selected"'; ?> >5</option>
                                <option value=6 <?php if ($userDetails->subscrption_mnth == 6) echo ' selected="selected"'; ?> >6</option>
                                <option value=7 <?php if ($userDetails->subscrption_mnth == 7) echo ' selected="selected"'; ?> >7</option>
                                <option value=8 <?php if ($userDetails->subscrption_mnth == 8) echo ' selected="selected"'; ?> >8</option>
                                <option value=9 <?php if ($userDetails->subscrption_mnth == 9) echo ' selected="selected"'; ?> >9</option>
                                <option value=10 <?php if ($userDetails->subscrption_mnth == 10) echo ' selected="selected"'; ?> >10</option>
                                <option value=11 <?php if ($userDetails->subscrption_mnth == 11) echo ' selected="selected"'; ?> >11</option>
                                <option value=12 <?php if ($userDetails->subscrption_mnth == 12) echo ' selected="selected"'; ?> >12</option>
                                
                            </select>
                        </div>
                        
                        </div>
                        </div>
                
                
                

  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
                
                
               
<!--                        <div id="numberOfBid" class="col-sm-6 registrationFormFieldCont">
                        <label>expire date</label>
                       <div class="input-group">
	                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_site.png') }}" alt="" /></span>
                                     <input type="number" name="expireDate" id="datepicker" class="form-control input-lg" name="bids" aria-describedby="basic-addon1" min="0" 
	                                    value="" />
	                        </div>
                       
                        </div>-->
                        


                       
                   
                <!--sohail changing-->
                <div class="row">
                    <div class="col-sm-12 registrationFormFieldCont">
                        <label> </label>
                        <input type="hidden" name="lati" value=""/>
                        <input type="hidden" name="longi" value=""/>
                    </div>
                </div>
            </div>
        
        
        

        </div><!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="categoryStatus" value="1" />
            <input class="btn btn-primary pull-right" type="submit" value="Save"/>
        </div><!-- /.box-footer -->
    </form>
</div><!-- /.box -->

<style>
.registrationFormCont {

}
.registrationFormCont h1 {
    font-size: 24px;
}
.registrationFormCont label {
    font-size: 16px;
    font-weight: normal;
    margin-top: 8px;
}
.registrationFormCont .registrationFormFieldCont .radioBtnCont + .radioBtnCont {
	margin-left: 20px;
}
.registrationFormCont .registrationFormFieldCont .input-group .input-group-addon {
    background: #8aa4af;
}
.registrationFormCont .registrationFormFieldCont .input-group .customDropdown {
    z-index: auto;
}
.registrationFormCont .registrationFormFieldCont .input-group .customDropdown .dropdown-toggle {
    background: #fff;
    height: 46px;
}
.registrationFormCont .registrationFormFieldCont .input-group .customDropdown .dropdown-menu {
    z-index: 3;
}
</style>
            {{--*/$user_type = profileGetFieldsValues(old('user_type'), $userDetails->user_type)/*--}}
<script type="text/javascript">
        
	jQuery('document').ready(function() {
            $("[name='user_type']").click( function () {
                var selected_val = $(this).val(),
                    show_elements = '',
                    hide_elements = '';

                switch (selected_val) {
                   case "1": 
                       show_elements = '.buyers-fields';
                       hide_elements = '.supplier-fields';

                       break; 
                    case "2": 
                       hide_elements = '.buyers-fields';
                       show_elements = '.supplier-fields';

                       break; 
                    case '3': 
                       show_elements = '.buyers-fields, .supplier-fields';
                       hide_elements = ' ';
                       break; 
                    default:
                       show_elements = '.buyers-fields';
                       hide_elements = '.supplier-fields';
                       break;
               }
               $(show_elements).show();
               $(hide_elements).hide();
            });
            
            @if ($user_type == '' || $user_type == 2 ) 
                $('.supplier-fields').show();
                $('.buyers-fields').hide();
            @endif

            @if ($user_type == 1) 
                $('.buyers-fields').show();
                $('.supplier-fields').hide();
            @endif
            @if ($user_type == 3)
                $('.supplier-fields').show();
                $('.buyers-fields').show();
            @endif
            
             
             if($('#iAmAVal1').is(':checked')) {
                $('#memberdiv').hide();
             }else{
                 $('#memberdiv').show();
             }
             
             $('#iAmAVal1').click(function(){
                 if($('#iAmAVal1').is(':checked')) {
                        $('#memberdiv').hide();
                     }else{
                         $('#memberdiv').show();
                     }
             });
             $('#iAmAVal2').click(function(){
                 if($('#iAmAVal1').is(':checked')) {
                        $('#memberdiv').hide();
                     }else{
                         $('#memberdiv').show();
                     }
             });
             $('#iAmAVal3').click(function(){
                 if($('#iAmAVal1').is(':checked')) {
                        $('#memberdiv').hide();
                     }else{
                         $('#memberdiv').show();
                     }
             });
             
           if($('#prom').val()=='pro'){
                    $('#numberOfBid').show();

                }else{
                         $('#numberOfBid').hide();
                     }
            $('#prom').change(function () {
              
                if($('#prom').val()=='pro'){
                    $('#numberOfBid').show();

                } else {
                        $('#numberOfBid').hide();
                    }
                
            });
            
		showHideSupplierFields();
        getSubCategories("[name='main_categories[]']", 
            '{{implode(",", profileGetFieldsValues(old("sub_categories"), explode(",", $userDetails->sub_categories)))}}', true);
        getCities("[name='state']", 'city', '{{profileGetFieldsValues(old("city"), $userDetails->city)}}');
        getCities("[name='service_states[]']", 'service_cities', 
            '{{implode(",", profileGetFieldsValues(old("service_cities"), explode(",", $userDetails->service_cities)))}}', true);
    });

	function showHideSupplierFields () {
		var selectedType = $("[name='user_type']:checked").val();
		if (selectedType == 1) {
			$("#supplierFieldsCont").css('display', 'none');
		} else {
			$("#supplierFieldsCont").css('display', 'block');
		}
	}
</script>

@endsection

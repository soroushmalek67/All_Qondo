@extends('templates.dashboard_pages_template')
@section('page_title') Profile @endsection
@section('page-content')

                    @include("partials.form_errors")
                        <form role="form" method="POST" action="{{ url('profile') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="registrationFormCont">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle">
                                            <span>Account Information<span></span></span>
                                        </h1>
                                    </div><div class="col-sm-12"><h5>* indicates required fields</h5></div>
                                    @if ($userType == 2)
                                        <div class="col-sm-12">
                                            <h3>
                                               
                                                @if (empty($userDetails->membership))
                                                    You have {{$userDetails->bids}} remaining quotes
                                                @else 
                                                 
                                                @if($userDetails->package=='Enterprise')
                                                         @if($userDetails->expires_at > date("Y-m-d h:i:s"))
                                                             You have {{$userDetails->package}} membership activated
                                                         @endif
                                                         @endif
                                                 @if($userDetails->package=='dedicated')
                                                         @if($userDetails->expires_at > date("Y-m-d h:i:s"))
                                                            You have {{$userDetails->package}} membership activated
                                                         @endif
                                                         @endif
                                                 @if($userDetails->package > 0)
                                                         @if($userDetails->expires_at > date("Y-m-d h:i:s"))
                                                             You have Pro membership activated
                                                         @endif
                                                         @endif
                                                   
                                                @endif
                                            </h3>
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
                                    @if ($userType == 1)
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Role</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_job_icon.png') }}" alt="" /></span>
                                            
                                            {{--*/$selected  = profileGetFieldsValues(old('job_position'), $userDetails->job_position)/*--}}
                                           
                                            <select name="job_position" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" >
                                                <option @if ($selected == 'resident') selected @endif; value='resident'>Resident</option>
                                              
                                                <option @if ($selected == 'manager') selected @endif; value='manager'> Manager </option>
                                                <option @if ($selected == 'service-buyer') selected @endif; value='service-buyer'>Service Buyer</option>
                                                                                                
                                            </select>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Job Position</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_job_icon.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="job_position" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('job_position'), $userDetails->job_position)}}" />
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Email *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_email.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="email" aria-describedby="basic-addon1" 
                                                   value="{{profileGetFieldsValues(old('email'), $userDetails->email)}}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_password.png') }}" alt="" /></span>
                                            <input type="password" class="form-control input-lg" name="password" aria-describedby="basic-addon1" 
                                                   value="{{profileGetFieldsValues(old('password'), "")}}" placeholder="**********"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_password.png') }}" alt="" /></span>
                                            <input type="password" class="form-control input-lg" name="password_confirmation" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('password_confirmation'), "")}}" placeholder="**********" />
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
                                    @if ($userType == 1 || $userType == 3)
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle formBussnissInfoHeading">
                                            <span>Building Information<span></span></span>
                                        </h1>
                                    </div>
                                    {{--*/ $selected_building  = profileGetFieldsValues(old('building_id'), $userDetails->building_id); /*--}}
                                    
                                    <?php  
									  
                                    $building_name = profileGetFieldsValues(old('building_name'), $userDetails->Address.', '.$userDetails->building_name);
                                    
                                    if(trim($building_name) == ','){
                                    
                                    $building_name = '';
                                    
                                    }
                                   ?>
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Building Name *</label>
                                       
                                        <div class="input-group building-dropdown">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_bus_name.png') }}" alt="" /></span>
                                            <input type="text" id="get_building_name" required name="building_name" class="form-control input-lg" value="<?php echo $building_name; ?>" 
                                            placeholder="Building name">
                                            <input type="hidden"  name="building_id" id="building_id"  value="{{ profileGetFieldsValues(old('building_id'), $userDetails->building_id)}}" >
<!--                                            <select  name="building_id" id="building_id" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" data-live-search="true">
                                                    <option value="">Select Building</option>

                                                    @forelse ($buildings as $building)
                                                    <option @if ($building->id == $selected_building ) selected @endif value="{{$building->id}}">{{$building->building_name.', '.$building->city.', '.$building->province.', '.$building->country}}</option>
                                                    @empty 

                                                    @endforelse;

                                            </select>-->
                                        </div>
                                    </div>
                                    @endif
                                    @if ($userType == 2 || $userType == 3)
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle formBussnissInfoHeading">
                                            <span>Buisness Information<span></span></span>
                                        </h1>
                                    </div>
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Buisness Name *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_bus_name.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="business_name" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('business_name'), $userDetails->business_name)}}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Buisness Number</label> &nbsp;
                                        <a data-toggle="tooltip" title="Required for issuing invoices and estimating tax">
                                            <i class="glyphicon glyphicon-info-sign"></i></a>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_tax_id.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="tax_id" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('tax_id'), $userDetails->tax_id)}}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Describe your services/products *</label>
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                                            </span>
                                            <textarea class="form-control input-lg" aria-describedby="basic-addon1" name="describe_product">{{profileGetFieldsValues(old('describe_product'), $userDetails->describe_product)}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Industries You Buy From </label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_you_buy_from.png') }}" alt="" /></span>
                                            <!--<input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">-->
                                            <select name="industries_you_buy[]" class="customDropdown form-control input-lg" 
                                                    aria-describedby="basic-addon1" multiple data-live-search="true">
                                                <!--<option value="">Select Industries</option>-->
                                                {{--*/ $catsSelectedids = profileGetFieldsValues(old('industries_you_buy'), explode(",", $userDetails->industries_you_buy)) /*--}}
                                                @foreach ($linkedinIndustries as $category)
                                                    <option @if (in_array($category->id, $catsSelectedids)) selected @endif 
                                                             value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Industries You Sell To </label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_you_sell_to.png') }}" alt="" /></span>
                                            <select name="industries_you_sell[]" class="customDropdown form-control input-lg" 
                                                    aria-describedby="basic-addon1" multiple data-live-search="true">
                                                <!--<option value="">Select Industries</option>-->
                                                {{--*/ $catsSelectedids = profileGetFieldsValues(old('industries_you_sell'), explode(",", $userDetails->industries_you_sell)); /*--}}
                                                @foreach ($linkedinIndustries as $category)
                                                    <option @if (in_array($category->id, $catsSelectedids)) selected @endif 
                                                             value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                    @endif
                                    
                                    @if ($userType == 2)
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Street Address *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_position_icon.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="street_address" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('street_address'), $userDetails->street_address)}}"
                                                    onblur="addPinToMapOnRegisterPage()" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Province/State *</label>
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
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>City *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_city.png') }}" alt="" /></span>
                                            <select name="city" id="city" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                    data-live-search="true">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Postal Code *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_zip.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="postal_code" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('postal_code'), $userDetails->postal_code)}}" 
                                                    onblur="addPinToMapOnRegisterPage()" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Country *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_phone.png') }}" alt="" /></span>
                                            <select name="country" class="customDropdown form-control input-lg" aria-describedby="basic-addon1">
                                                <option value="Canada">Canada</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Website</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_site.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="website" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('website'), $userDetails->website)}}" />
                                        </div>
                                    </div>
                                     @if ($userType == 2)
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Facebook</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/facebook.png') }}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="facebook" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('facebook'), $userDetails->facebook)}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Twitter</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/twitter.png') }}" alt="" /></span>
                                            <input type="url" class="form-control input-lg" name="twitter" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('twitter'), $userDetails->twitter)}}" />
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Google+</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/google-plus.png') }}" alt="" /></span>
                                            <input type="url" class="form-control input-lg" name="gplus" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('gplus'), $userDetails->googleplus)}}" />
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Linkedin </label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/linkedin.png') }}" alt="" /></span>
                                            <input type="url" class="form-control input-lg" name="linkedin" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('linkedin'), $userDetails->linkedin)}}" />
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-12 registrationFormFieldCont">
                                        <label>YouTube</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/YouTube.png') }}" alt="" /></span>
                                            <input type="url" class="form-control input-lg" name="youtube" aria-describedby="basic-addon1" 
                                                    value="{{profileGetFieldsValues(old('youtube'), $userDetails->video)}}" />
                                        </div>
                                    </div>
                                     @endif
                                    <!--sohail changing-->
                                </div>
                                @if ($userType == 2)
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
                                                    <img src="{{url("img/compay_logos/".getFolderStructureByDate($userDetails->creat)."/"
                                                                .$userDetails->company_logo)}}" 
                                                         alt="{{profileGetFieldsValues(old('business_name'), $userDetails->business_name)}}" />
                                                @endif
                                            </label>
                                        </div>
                                       </div>
                                        <!--sohail changing-->
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
                                                @if (empty($userDetails->company_logo)) 
                                                    No Logo 
                                                @else
                                                    <img src="{{url("img/profile_banner/".getFolderStructureByDate($userDetails->creat)."/"
                                                                .$userDetails->company_banner)}}" 
                                                         alt="{{profileGetFieldsValues(old('business_name'), $userDetails->business_name)}}" />
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <!--sohail changing-->
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
                                    <div class="col-sm-6 registrationFormFieldCont">
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
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>City *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_city.png') }}" alt="" /></span>
                                            <select name="service_cities[]" id="service_cities" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                    data-live-search="true" onchange="" multiple data-actions-box="true">
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!--sohail changing-->
                                    
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Certificates and Awards *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_desc.png') }}" alt="" /></span>
                                            <!--<input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">-->
                                            {{--*/ $selectedawards = profileGetFieldsValues(old('award'), explode(",", $userDetails->award)); /*--}}
                                            <select name="award[]" class="customDropdown form-control input-lg" 
                                                    aria-describedby="basic-addon1" multiple data-live-search="true">
                                                <!--<option value="">Select Industries</option>-->
                                             
                                            
                                                @foreach ($awards as $award)
                                                    <option @if (in_array($award->id, $selectedawards)) selected @endif 
                                                             value="{{$award->id}}">{{$award->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                        
                                    
                                    <!--sohail changing-->
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
                                @endif
                                <div class="row">
                                    @if ($userType == 1)
                                        <div class="col-sm-12">
                                            <span class="checkboxCont">
                                                <input name="anonymous" id="anonymous" value="1" type="checkbox" 
                                                        {{(profileGetFieldsValues(old('anonymous'), $userDetails->anonymous) == 1)?'checked':''}} />
                                                <label for="anonymous">Show your details to Contractors.</label>
                                            </span>
                                        </div>
                                    @endif
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label> </label>
                                        <input type="hidden" name="lati" value=""/>
                                        <input type="hidden" name="longi" value=""/>
                                        <input type="submit" class="btn btnWithRightArrow" value="UPDATE"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <script type="text/javascript">
                           
                            jQuery(window).ready(function() {
                                $("#get_building_name").autocomplete({
                                    serviceUrl: URL + "/ajax/get-buildings",
                                    dataType: "json",
                                    type: "POST",
                                    onSelect: function(e) {

                                      $("#building_id").val(e.data);
                            //            $("#selectedCatID").val(e.data), $("#selectedCatName").val(e.value), $("#selectedOptionType").val(e.optionType), $("#homeSearchForm").submit()
                                    }
                                })
                                
                                getSubCategories("[name='main_categories[]']", 
                                    '{{implode(",", profileGetFieldsValues(old("sub_categories"), explode(",", $userDetails->sub_categories)))}}', true);
                                getCities("[name='state']", 'city', '{{profileGetFieldsValues(old("city"), $userDetails->city)}}');
                                getCities("[name='service_states[]']", 'service_cities', 
                                    '{{implode(",", profileGetFieldsValues(old("service_cities"), explode(",", $userDetails->service_cities)))}}', true);
                                    getawards("[name='award[]']", 'award', 
                                    '{{implode(",", profileGetFieldsValues(old("award"), explode(",", $userDetails->award)))}}', true);
                            });
                        </script>

@endsection
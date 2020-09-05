@extends('templates.sub_pages_template')
@section('page-content')
        <section class="registerPageTopStepsCont">
            <div class="container">
                <div class="InnerPageCategories">
                    <div class="row">
<!--                        <div class="col-md-3 col-sm-6">
                            <div class="homeCategoryCont active">
                                <div class="homeCategoryimg" data-aftervalue="01"><img src="{{ asset('img/front/icon_register.png') }}" alt=""></div>
                                <h3><a>Register</a></h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="homeCategoryCont">
                                <div class="homeCategoryimg" data-aftervalue="02"><img src="{{ asset('img/front/icon_research.png') }}" alt=""></div>
                                <h3><a>Research</a></h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="homeCategoryCont">
                                <div class="homeCategoryimg" data-aftervalue="03"><img src="{{ asset('img/front/icon_quotes.png') }}" alt=""></div>
                                <h3><a>Handle Quotes</a></h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="homeCategoryCont">
                                <div class="homeCategoryimg" data-aftervalue="04"><img src="{{ asset('img/front/icon_make_deal.png') }}" alt=""></div>
                                <h3><a>Make A Deal</a></h3>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </section>
        <section class="registrationFormSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        @include("partials.form_errors")
                        <form role="form" id="registerationForm" method="POST" action="{{ url('profile') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <input type="hidden" name="lati" value=""/>
                            <input type="hidden" name="longi" value=""/>
                            
                            <div class="registrationFormCont">
                                <div class="personalInner firstInner animated slideInRight" id="section-1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="formHeadingWithStyle">
                                                <span>Account Information /<span>Please fill in the following information</span></span>
                                            </h1>
                                        </div>
                                        <div class="col-sm-12">
                                            <h5>* indicates required fields</h5>
                                        </div>
                                        <div class="col-sm-12 registrationFormFieldCont">
                                            <label>My company is a *</label><br/>
                                            <span class="radioBtnCont">
                                                <input type="radio" name="iAmA" value="1" id="iAmAVal1" @if ($userDetails->user_type == 1) checked  @endif 
                                                       onclick="signupShowHideBuyerSupplierFields(this)" disabled />
                                                <label for="iAmAVal1">Buyer</label>
                                            </span>
                                            <span class="radioBtnCont">
                                                <input type="radio" name="iAmA" value="2" id="iAmAVal2" @if ($userDetails->user_type == 2) checked  @endif 
                                                       onclick="signupShowHideBuyerSupplierFields(this)" disabled />
                                                <label for="iAmAVal2">Contractor</label>
                                            </span>
<!--                                            <span class="radioBtnCont">
                                                <input type="radio" name="iAmA" value="3" id="iAmAVal3" @if ($userDetails->user_type == 3) checked  @endif 
                                                       onclick="signupShowHideBuyerSupplierFields(this)" disabled />
                                                <label for="iAmAVal3">Both</label>
                                            </span>-->
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>First Name *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" value="{{$userDetails->first_name}}" 
                                                       required name="first_name" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Last Name *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" value="{{$userDetails->last_name}}" name="last_name" 
                                                       required aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <?php /*?><div class="col-sm-6 registrationFormFieldCont">
                                            <label>Job Position</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_job_icon.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" value="{{old('job_position')}}" name="job_position" aria-describedby="basic-addon1">
                                            </div>
                                        </div><?php */?>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Email *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_email.png') }}" alt="" /></span>
                                                <input type="email" class="form-control input-lg" value="{{$userDetails->email}}" name="email" 
                                                       required aria-describedby="basic-addon1" disabled>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Password *</label> &nbsp;
                                            <a data-toggle="tooltip" title="Minimum password length should be 6">
                                                <i class="glyphicon glyphicon-info-sign"></i></a>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_password.png') }}" alt="" /></span>
                                                <input type="password" class="form-control input-lg" value="{{old('password')}}" name="password" 
                                                       required aria-describedby="basic-addon1" id="password">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Confirm Password *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_password.png') }}" alt="" /></span>
                                                <input type="password" class="form-control input-lg" value="{{old('password_confirmation')}}" 
                                                       required name="password_confirmation" aria-describedby="basic-addon1">
                                            </div>
                                        </div> -->
        <!--                                <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Work Phone</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_work_phone.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                            </div>
                                        </div>-->
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Mobile Number *</label> &nbsp;
                                            <a data-toggle="tooltip" title="Accepted format is 123 456 7899">
                                                <i class="glyphicon glyphicon-info-sign"></i></a>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_phone.png') }}" alt="" /></span>
                                                    <div style="position:absolute;color:#AAA;padding:8px;padding-top:10px;font-size:18px;font-family:MuseoSans100;z-index:999">+1</div>
                                                <input type="text" class="form-control input-lg" value="{{$userDetails->mobile_number}}" name="mobile_number" 
                                                       required aria-describedby="basic-addon1" style="padding-left:30px">
                                            </div>
                                        </div>
                                        <?php //Please remove the following div row while uncommenting the job div ?>
                                        </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="formHeadingWithStyle formBussnissInfoHeading">
                                                <span>Business Information /<span>Please fill in the following information about your business</span></span>
                                            </h1>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Business Name *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_bus_name.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" value="{{$userDetails->business_name}}" name="business_name" 
                                                       required aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <?php /*?><div class="col-sm-6 registrationFormFieldCont">
                                            <label>Business Number</label> &nbsp;
                                            <a data-toggle="tooltip" title="Required for issuing invoices and estimating tax">
                                                <i class="glyphicon glyphicon-info-sign"></i></a>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_tax_id.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" value="{{old('tax_id')}}" name="tax_id" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 registrationFormFieldCont">
                                            <label>Describe your services/products *</label>
                                            <div class="input-group">
                                                <span id="basic-addon1" class="input-group-addon input-lg">
                                                    <img alt="" src="{{asset('img/front/form_icon_desc.png')}}"/></span>
                                                <textarea class="form-control input-lg" aria-describedby="basic-addon1" required 
                                                          name="describe_product">{{old('describe_product')}}</textarea>
                                            </div>
                                        </div><?php */?>
                                        <input type="hidden" name="describe_product" value="Product Description" />
                                        <?php /*?><div class="col-sm-6 registrationFormFieldCont">
                                            <label>Industries From Which you Buy </label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_you_buy_from.png') }}" alt="" /></span>
                                                <!--<input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">-->
                                                <select name="industries_you_buy[]" class="customDropdown form-control input-lg" 
                                                        aria-describedby="basic-addon1" multiple data-live-search="true" required>
                                                    <!--<option value="">Select Industries</option>-->
                                                    {{--*/ /*$catsSelectedids = profileGetFieldsValues(old("industries_you_buy"), []);*/ /*--}}
                                                    @foreach ($linkedinIndustries as $category)
                                                        <option @if (in_array($category->id, $catsSelectedids)) selected @endif 
                                                                 value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Industries To Which You Sell <span id="industriesYouSellAstericBox"></span></label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_you_sell_to.png') }}" alt="" /></span>
                                                <select name="industries_you_sell[]" class="customDropdown form-control input-lg" 
                                                        aria-describedby="basic-addon1" multiple data-live-search="true">
                                                    {{--*/ /*$catsSelectedids = profileGetFieldsValues(old("industries_you_sell"), []);*/ /*--}}
                                                    @foreach ($linkedinIndustries as $category)
                                                        <option @if (in_array($category->id, $catsSelectedids)) selected @endif 
                                                                 value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><?php */?>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Street Address *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_position_icon.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" value="{{old('street_address')}}" name="street_address" 
                                                       required aria-describedby="basic-addon1" onblur="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Postal Code *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_zip.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" value="{{old('postal_code')}}" name="postal_code" 
                                                       required aria-describedby="basic-addon1" onblur="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Province/State *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_state.png') }}" alt="" /></span>
                                                {{--*/ $selectedStatesids = profileGetFieldsValues(old('state'), ""); /*--}}
                                                <select name="state" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                        onchange="getCities(this, 'city', '{{profileGetFieldsValues(old("city"), "")}}');" 
                                                        required data-live-search="true">
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
                                                        required data-live-search="true" onchange="">
                                                </select>
                                            </div>
                                        </div>
                                        <?php /*?><div class="col-sm-6 registrationFormFieldCont">
                                            <label>Country *</label>
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
                                                <input type="text" class="form-control input-lg" value="{{old('website')}}" name="website"  
                                                	aria-describedby="basic-addon1">
                                            </div>
                                        </div><?php */?>
                                        <input type="hidden" name="country" value="Canada" />
                                    </div>
                                    
                                    <div class="row" id="supplierServiceInformationSection">
                                        <div class="col-sm-12">
                                            <h1 class="formHeadingWithStyle formBussnissInfoHeading">
                                                <span>Service or Product Information /
                                                    <span>please fill in the following information about your business services or products</span></span>
                                            </h1>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Main Categories *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
                                                <!--<input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">-->
                                                <select name="main_categories[]" class="customDropdown form-control input-lg" 
                                                    required aria-describedby="basic-addon1" multiple
                                                    onchange="getSubCategories(this, 
                                                    '{{implode(",", profileGetFieldsValues(old("sub_categories"), []))}}', true);">
                                                    {{--*/ $selectedCatId = profileGetFieldsValues(old("main_categories"), []); /*--}}
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
                                                        required aria-describedby="basic-addon1" multiple>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Province/State *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_state.png') }}" alt="" /></span>
                                                {{--*/ $selectedStatesids = profileGetFieldsValues(old('service_states'), []); /*--}}
                                                <select name="service_states[]" class="customDropdown form-control input-lg" required multiple 
                                                        aria-describedby="basic-addon1" data-live-search="true" 
                                                        onchange="getCities(this, 'service_cities', 
                                                        '{{implode(",", profileGetFieldsValues(old("service_cities"), []))}}', true);">
                                                    <option value="" disabled>Select Province/State</option>
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
                                                <select name="service_cities[]" id="service_cities" class="customDropdown form-control input-lg" 
                                                        aria-describedby="basic-addon1" required data-live-search="true" onchange="" multiple data-actions-box="true">
                                                    endforeach-->
                                                </select>
                                            </div>
                                        </div>
    <!--                                    <div class="col-sm-6 registrationFormFieldCont">
                                            <label>Service Radius, km</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_service_kilometers.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" value="{{old('service_kilometers')}}" name="service_kilometers" aria-describedby="basic-addon1" 
                                                       id="service_kilometers" onblur="">
                                            </div>
                                        </div>-->
    <!--                                    <div class="col-sm-6 registrationFormFieldCont">
                                            <label> </label>
                                            <div style="margin-top: 20px;" id="map_canvas"></div>
                                        </div>-->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 registrationFormFieldCont"></div>
                                        <div class="col-sm-6 registrationFormFieldCont text-right">
                                            <div class="text-center submit-btn-auth pull-right"><label><p>&nbsp;</p><p>&nbsp;</p></label><input type="submit" class="btn" value="SUBMIT NOW"/></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        <script type="text/javascript">
            jQuery(window).ready(function() {
                getSubCategories("[name='main_categories[]']", '{{implode(",", profileGetFieldsValues(old("sub_categories"), []))}}', true);
                getCities("[name='state']", 'city', '{{profileGetFieldsValues(old("city"), "")}}');
                getCities("[name='service_states[]']", 'service_cities', '{{implode(",", profileGetFieldsValues(old("service_cities"), []))}}', true);
//                alert('{{implode(",", profileGetFieldsValues(old("service_cities"), []))}}')
//                addPinToMapOnRegisterPage();
            });
        </script>
        
        
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h3 id="myModalLabel">Terms &amp; Services</h3>
            </div>
            <div style="height:400px;overflow: auto" class="modal-body">
                <div id="new">
                    <p>The following describes the terms in which QONDO ANALYTICS INC, this website qondo.ca or its subdomains, 
                        herein referred to as "QONDO", "us", "we" "our", and this "website" provides you access to our services. 
                        "Contractor", "Service Provider", "Buyer", "User" or "You", refers to any individual, company or authorized 
                        representative who seeks to research, buy or sell specific service or products via this website. We reserve the 
                        right to supplement, revise, or update these terms at any time without notice to you. Be advised that you should 
                        read carefully these terms, the Privacy Policy and as well as our Refund Policy on a regular basis as you 
                        continue to use our website because they may change at any time. Continued use of this website will indicate 
                        your acceptance of our terms, policies, updates, revisions and conditions so please check back and refer to this 
                        page often.</p>
                    <p>Users agrees to review this Agreement prior to first sign up and agrees to the terms and conditions outlined in this online Agreement with respect to the goods, services and information provided by or through the website. This Agreement constitutes the entire and only contract between QONDO and the users, and supersedes any and all prior or contemporaneous agreements, representations, warranties, and understandings with respect to the goods, services and information provided by or through the website, and the subject matter of this Agreement.
                    </p>

                    <h2>Eligibility for Users</h2>
                    <p>This website is available only to individuals over 18 years of age and businesses that can form legally binding contracts under applicable law. Anyone using our services must have the authority to bind the buyers or sellers to a contract. If you do not meet all of these eligibility requirements, please do not use the website. We reserve the right to disapprove, curtail or terminate your use of the website at any time, for any reason and in our sole discretion without notice to you. YOUR USE OF THE WEBSITE SHALL CONSTITUTE YOUR ACCEPTANCE OF THIS AGREEMENT IN ITS ENTIRETY.
                    </p>

                    <h2>Contractor User Services</h2>
                    <p>
                    FIROGMRAM website services include providing a Business to Business (B2B) marketplace with the ability to: (1) create "service requests" or "Request for Quote" or "RFQ" which refers to the proposing of a sum of money in exchange for a business service or products; (2) the ability to issue a quote for the requested service; and (3) facilitate communications between service buyers and service providers. 

                    <h2>Issuing a Service Request or RFQ</h2>
                    <p>
                    Placing a service request or RFQ does not mean entering into a binding legal Agreement with the service contractors. The requests, however, have to be posted in accordance with the terms stated in the item listing and the rules of this website. Offers are an irrevocable proposal to buy the service at the price of the offer, provided it is accepted at the close of the time period suggested in the request form. After your offer details are posted to the website and thus sent to the suppliers, you will not be able to amend your description of the parameters until the offer has either been accepted, rejected or expires. Supplier have less than seven (7) days to issue quotes and buyer have 48-hour time limits accept (or reject)  a quote. If buyer opt to not take action on a quote, it will be deemed expired after the 48-hour period elapses. Upon acceptance of the quote, any failure by a service buyer or service supplier to honour the terms set forth in the creation of RFQ can result in the disapproval, curtailing or terminating of your use of the website at any time. If your offer is accepted by the service supplier, your purchase may not be retracted without permission.
                    </p>

                    <h2>Issuing Quotes or Offer of Services</h2>
                    <p>Service contractors can purchase the right to issue quotes in accordance with the terms stated in the item listing and the rules of this website. Do not issue quotes until you are sure that you understand the full terms and requirement stated in the buyer service request. Purchasing a right to quote on RFQs are in form of a "Pay-per-quote" or "Membership Subscriptions" as defined in suppliers' dashboard. Issuing a quote does not constitute your acceptance to entering into a binding legal agreement with the service buyer. Once a quote is issued and corresponding charges are deducted, it may not be cancelled or retracted without permission. The buyer is not obligated to grant permission to retract or cancel a quote, and it is not the duty of this website to request permission for a purchase retraction or cancellation. Any quotation and terms therein must be worked out between the service buyers and service suppliers with or without assistance from the QONDO. By purchasing a subscription or "Pay Per Quote" credits, service suppliers authorize us to release their contact information that only include  first name, business name, and address to the buyers  who requested the service.
                    </p>
                    <h2>Communication Between Users</h2>
                        <p>The buyer identity is not revealed to the contractor until they choose to do for the quote that has been offered by the contractor. After buyer issues a request or RFQ and upon approval from QONDO, an email is sent to the relevant suppliers by revealing your first name only. As soon as supplier issues a quote, the identity of supplier is revealed to the buyer in form of their first name, last name initial, and business name and business website if applicable. Moreover buyer is able to view suppliers profile from "Suppliers Directory" link. The extent of information for each supplier in our website is depending on their type of subscription and willingness to provide more details about their services and products they offer. We, however, obliged suppliers to provide basic information about the name, location, website and category of their services or products. Upon receiving a quote from supplier, buyers and suppliers are responsible for contacting each other via their dashboard and by utilizing our messaging system to discuss specifics about the requested service. It is not our responsibility to arrange delivery of the service. Failure by you to honour good practice of the communication in a business professional manner may result in temporary or indefinite suspension from QONDO.
                    </p>

                    <h2> Other User Responsibilities and Duties </h2>
                    <p>You shall not circumvent, avoid, obviate, or bypass us, directly or indirectly, with regard to any transaction to avoid payment of fees and/or commissions in any transactions with the buyer and/or any corporation, entity, partnership, sole proprietorship, limited liability company/corporation, or individual in connection with any request or RFQ relating to the QONDO website. We request that you alert us to any actions that interfere with the integrity of our service. If you suspect illegal activities, price or offer manipulation, fraud or multiple identities, it is important to provide us with this information immediately.
                    </p>
                    <h2>Buyer Right of Refusal</h2>
                        <p>
                        Service contractors understand and agree that a service buyer may refuse any quote at any time. This Right of Refusal exists as to all types of transactions on our website. Once supplier issues a quote, the buyer may exercises its Right of Refusal and you can not request QONDO for a refund. We have unique refund policies and in exceptional circumstances that refund is possible, you may not be issued a full refund. Although a buyer may refuse quotes after initial acceptance, QONDO recommends buyers exercise this right prudently. For more information on refunds, please contact us at info@qondo.com or +1 855 782 6882.
                        </p>
                    <h2>Our Responsibilities</h2>
                        <p>
                        We only provide the marketplace and facilitate the link between service buyers and service contractors. Our website provides information on participating contractors and collects membership from participating service suppliers for the right to issue quotes and/or using our advanced marketplace analytics tools. QONDO is not a party to the final contract that arises between buyers and suppliers of a specific service or product and cannot and does not guarantee the truthfulness or accuracy of any user. Our exclusive role in any agreement arising from a RFQ is to receive quotes from the supplier and to forward those to the buyers in consideration for the category or sub category of the requested service and parameters therein that are clearly specified in RFQ.
                        </p>

                        <h2>Fees for Services</h2>
                        <p>
                            Using our website is free to you. We only charge service contractors when  a quote is issued by them (service contractors) through use of our website in form of "Pay-Per-Quote" or monthly/annual membership subscription.
                        </p>
                        <p>
                            <b>Commission/Fees.</b> When issuing a quote through QONDO, we charge contractors for a fixed payment per quote or based on a monthly subscription with limited or unlimited amount of issued quotes. You, as a buyer, do not pay supplier and receive quotes free of charge. Depending on type of agreement between us and service buyers or suppliers, for the use of our analytics tools and/or marketplace, QONDO may deduct service contract fee or a commission from the total cost of the service which is paid by the buyers or suppliers. 
                            <br> <b> Reimbursement.</b> QONDO will reimburse you in certain circumstances. Please contact us at info@qondo.com to learn more about reimbursement and for our Refund Policy.
                            <br> <b> Sales Tax. All </b> prices quoted exclude taxes. All applicable taxes will be added on during service agreement between buyer and contractor outside this website. QONDO will not be involved , neither is influencing in any forms, the terms and condition of service taxes and any financial or contractual agreement between buyers and suppliers.
                                For pay-per-quote, analytics services, and/or membership subscriptions, we are required to collect Government Sales Tax (GST) and/or Harmonized Sales Tax (HST) based on the tax information provided by our users under Canadian law. We are required to collect taxes, even when a supplier does not provide their tax information, however a supplier may still have an obligation to pay other applicable taxes with respect to the sales or purchase of services from QONDO (whether through us or otherwise). Although our service may be subject to a different provincial tax rate than yours, we are required to charge your provincial tax rate with respect to the use of QONDO service. A full tax invoice will be issued to the users once payment has been made.
                        </p>
                        <h2>Disclaimer</h2>
                        <p>Our site acts as the venue for which registered contractors list their services or products and for which registered buyers make offers. Our website only facilitate the communication between buyer and supplier and does not provide mean to buyers to purchase services from service suppliers. The website provides information on participating suppliers and collects payments for using our analytics or marketplace services. We are not involved in the actual transaction between suppliers and buyers beyond the request of services by buyers and issuing of quotes by  suppliers and communications between buyers and suppliers. Therefore QONDO cannot be held liable for the actions of the Users on the Site and/ or quality, delivery of the agreed services.
                        </p><p>We do not control the information provided by other users that is made available through the site nor do we guarantee the quality, safety or legality of items listed by users or the truth or accuracy of listings and the ability of service buyers or suppliers to buy or sell services or products. We cannot ensure that a users will actually complete procurement of the services. You may find other user's information to be offensive, hurtful, derogatory, dishonest or inaccurate. You should make whatever investigation you believe is necessary and appropriate before proceeding with any online or offline transaction with any third party. To the extent we list or link to any third party products or services on our site, our site is only the venue, and we are not involved in the actual transaction, and have no control over, and make no representations regarding, the quality, safety, legality, or accuracy of any of the services or products. By using this website, you agree to accept such risks and QONDO is not responsible for the acts or omissions of users on the website.
                        </p><p>We reserve the right, but not the obligation, to modify or cancel reservations where it appears that a customer has engaged in fraudulent, illegal, or other inappropriate activity, and to prohibit or restrict your participation or utilization of the site if you fail to comply with all Terms and Conditions contained herein as determined in our sole discretion.
                        </p><p><b>Safe Transactions.</b> In addition, because user authentication on the Internet is difficult, QONDO cannot and does not confirm that each user is who they claim to be.
                        </p><p><b>Release.</b> If you have a dispute with one or more users, you release QONDO (and our officers, directors, agents, subsidiaries, joint ventures and employees) from claims, demands and damages (actual and consequential) of every kind and nature, known and unknown, arising out of or in any way connected with such disputes.
                        </p><p><b>Dispute Resolution.</b> QONDO does not act as a mediator between buyers and contractors over disagreements about requested services or products. If any aspect of the relationship with other users aggrieves you, it is your responsibility to contact us and evaluate the situation, and we reserve the right, but not obligation, to support you to resolve the dispute.
                        </p>

                        <h2>User Information</h2>
                        <p>"Your Information" is defined as any information you provide to us or other users in the registration, bidding or service listing process, in any public message area (including the feedback area) or through any email feature. You are solely responsible for Your Information, and we act as a passive conduit for your online distribution and publication of Your Information.
                        </p><p>With respect to Your Information (or any items listed therein):</p>
                        (1) shall not be false, inaccurate or misleading;<br>
                        (2) shall not be fraudulent;<br>
                        (3) shall not infringe any third party's copyright, patent, trademark, trade secret or other proprietary rights or rights of publicity or privacy;<br>
                        (4) shall not violate any law, statute, ordinance or regulation (including without limitation those governing export control, consumer protection, unfair competition, anti discrimination or false advertising);<br>
                        (5) shall not be defamatory, unlawfully threatening or unlawfully harassing;<br>
                        (6) shall not contain any viruses, Trojan horses, worms, time bombs, cancel bots or other computer programming routines that are intended to damage, detrimentally interfere with, surreptitiously intercept or expropriate any system, data or personal information;
                        (7) shall not create liability for us or cause us to lose (in whole or in part) the services of our ISPs (Internet Service Providers) or other contractors.<br>
                        In order to enable QONDO to use the personal information you supply us with, so that we are not violating any rights you might have in that information, you agree to grant us a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sub licensable (through multiple tiers) right to exercise the copyright and publicity rights (but no other rights) you have in Your Information, in any media now known or not currently known, with respect to personal information. QONDO will only use personal information in accordance with our Privacy Policy.<br>

                        <h2>Breach, Suspension or Termination</h2>
                        <p>
                            Without limiting other remedies, QONDO may limit your activity, immediately remove your item listings, issue a warning, temporarily suspend, indefinitely suspend or terminate your membership and refuse to provide our services to you if:
                        </p>
                        (a) your breach of this Agreement or the documents it incorporates by reference;
                        (b) our inability to verify or authenticate any information you provide to us;
                        (c) your provision of fraudulent information to us or our users;
                        (d) if you have interfered with the integrity of the functioning of our site, including but not limited to price manipulation;
                        or (e) our belief that your actions may cause legal liability for you, our users or us in its sole discretion, deems such remedy necessary for any reason.
                        <p>
                        If we choose to ignore any violation of this Agreement or other activities which could give rise to suspension or termination, such action or inaction on our part will not constitute a waiver of any of our rights including suspension, termination or otherwise.
                        </p>

                        <h2>Trademarks and Copyrights</h2>
                        <p>The trademarks, algorithms, service marks and logos used and displayed on the website are claimed, registered, or unregistered trademarks, copyright and service marks of QONDO. You are not granted, expressly or by implication, estoppel or otherwise, any license or right to use any trademark, service mark or logo used or displayed on the website, without the express written permission of us. QONDO disclaims any proprietary interest in trademarks, service marks, logos, domain names, and trade names other than its own.
                        </p>

                        <h2>No Warranty</h2>

                        <p>QONDO AND ITS CONTRACTORS PROVIDE OUR WEBSITE AND SERVICES "AS IS" AND WITHOUT ANY WARRANTY OR CONDITION, EXPRESS, IMPLIED OR STATUTORY. WE AND OUR CONTRACTORS SPECIFICALLY DISCLAIM ANY IMPLIED WARRANTIES OF TITLE, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT.
                        </p>
                        <h2>Liability Limit</h2>
                        <p>
                        IN NO EVENT SHALL QONDO OR ITS CONTRACTORS BE LIABLE FOR LOST PROFITS OR ANY SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF OR IN CONNECTION WITH OUR SITE, OUR SERVICES OR THIS AGREEMENT (HOWEVER ARISING, INCLUDING NEGLIGENCE).
                        </p>
                        <h2>Indemnity</h2>
                        <p>
                            You agree to indemnify and hold us harmless, our subsidiaries, affiliates, related parties, officers, directors, employees, agents, independent contractors, advertisers, partners, and co-branders from any claim or demand, including reasonable attorney's fees, that may be made by any third party, that is due to or arising out of your conduct or connection with this website or service, your provision of content, your breach of this Terms of Service or any other violation of the rights of another person or party.
                        </p>    
                        <h2>Legal Compliance</h2>
                        <p>You shall comply with all applicable domestic and international laws, statutes, ordinances and regulations regarding your use of our service and your offers on, listing, purchase, solicitation of offers to purchase, and sale of items.
                        </p>
                        <h2>No Agency</h2>
                        <p>You and QONDO are independent entities, and no agency, partnership, joint venture, employee-employer or franchiser-franchisee relationship is intended or created by this Agreement.
                        </p>
                        <h2>Notices</h2>
                        <p>Except as explicitly stated otherwise, any notices to us shall be given by postal mail to QONDO Analytics Inc, 210 3993 Henning Drive, Burnaby, British Columbia, Canada V5C 6P7 or by the email address you provide to QONDO during the registration process (in your case). Notice shall be deemed given 1 business day after email is sent, unless the sending party is notified that the email address is invalid. Alternatively, we may give you notice by certified mail, Notices via Canada Post shall be deemed given 3 days after the date of mailing.
                        </p>
                        <h2>Governing Law and Jurisdiction</h2>
                        <p> This Agreement shall be governed by and construed in accordance with the laws of the Province of British Columbia and the federal laws of Canada applicable therein. You hereby expressly consent to the sole and exclusive jurisdiction and venue of the courts of the Province of British Columbia, for any legal proceeding arising out of or relating to your use of this website or this Agreement. We do not guarantee continuous, uninterrupted or secure access to our services, and operation of our website may be interfered with by numerous factors outside of our control.
                        </p> <p>Use of the QONDO website is unauthorized in any jurisdiction that does not give effect to all provisions of these terms and conditions including, without limitation, this paragraph. Our performance of this Agreement is subject to existing laws and legal process, and nothing contained in this Agreement is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the QONDO web sites or information provided to or gathered by us with respect to such use. If any part of this Agreement is determined to be invalid or unenforceable pursuant to applicable law including, but not limited to, the warranty disclaimers and liability limitations set forth above, then the invalid or unenforceable provision will be deemed superseded by a valid, enforceable provision that most closely matches the intent of the original provision and the remainder of the Agreement shall continue in effect. Unless specifically provided herein, this Agreement constitutes the entire Agreement between you and QONDO with respect to your use of this website. This Agreement shall supersede all prior Agreements, understanding, negotiations and discussions, either oral or written between the parties. There are no representations, warranties, conditions or other agreements, express or implied, statutory or otherwise, between the parties in connection with the use of this website except as specifically set forth herein.
                        </p>

                        <h2>Your Acceptance of These Terms</h2>
                        <p>By using this Site, you signify your acceptance of this policy and terms of service. If you do not agree to this policy, please do not use our Site. Your continued use of the Site following the posting of changes to this policy will be deemed your acceptance of those changes.
                        </p>
                        <h2>Contacting Us</h2>
                        <p>
                        If you have any questions about this agreement, the practices of this site, or your dealings with this site, please contact us at info@qondo.com
                        Or via:<br>
                        QONDO Analytics Inc.<br>
                        www.qondo.com<br>
                        3993 Henning Drive<br>
                        Suite 210<br>
                        Burnaby, BC<br>
                        V5C 6P7<br>
                        +1 855 782 6882<br>
                        </p>
                        <br>
                        This document was last updated on October 31st, 2015                        
                </div>
            </div>
            <div class="modal-footer">
                <button aria-hidden="true" data-dismiss="modal" class="btn">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
        
@endsection
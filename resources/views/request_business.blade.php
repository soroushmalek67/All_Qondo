@extends('templates.sub_pages_template')
@section('page_title') Login @endsection
@section('page-content')


        <section class="registerPageTopStepsCont">
            <div class="container">
                <div class="row">
                    <div class="col-md-5"><div class="registerPageTopStepsHeading"><h2>REGISTER YOUR BUSINESS</h2></div></div>
                    <div class="col-md-7">
                        <div class="InnerPageCategories">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="homeCategoryCont">
                                        <div class="homeCategoryimg" data-aftervalue="01"><img src="{{ asset('img/front/icon_research.png') }}" alt=""></div>
                                        <h3><a href="">Research</a></h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="homeCategoryCont">
                                        <div class="homeCategoryimg" data-aftervalue="02"><img src="{{ asset('img/front/icon_quotes.png') }}" alt=""></div>
                                        <h3><a href="">Handle Quotes</a></h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="homeCategoryCont">
                                        <div class="homeCategoryimg" data-aftervalue="03"><img src="{{ asset('img/front/icon_make_deal.png') }}" alt=""></div>
                                        <h3><a href="">Make A Deal</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>List Your Business</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="registrationFormSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="registrationFormCont requestBusinessFormCont">
                            <div class="row requestBusinessHeadingsCont">
                                <div class="col-sm-4 active">1. &nbsp; &nbsp; Skills & Business</div>
                                <div class="col-sm-4">2. &nbsp; &nbsp; Working Area</div>
                                <div class="col-sm-4">3. &nbsp; &nbsp; Contact Details</div>
                            </div>
                            <div class="personalInner firstInner animated slideInRight" id="section-1">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle selectSkillsAndBusniessHeading">
                                            <span>Select Your Skills & Business /<span>Select Business & Go Forward</span></span>
                                        </h1>
                                    </div>
                                    <div class="col-sm-12 requestBussinessTabsCont">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a data-toggle="tab" href="#tab1"><span class="requestBussinessTabsHeading1">Consulting Services</span></a>
                                            </li>
                                            <li><a data-toggle="tab" href="#tab1"><span class="requestBussinessTabsHeading2">Automotive</span></a></li>
                                            <li><a data-toggle="tab" href="#tab1"><span class="requestBussinessTabsHeading3">Construction</span></a></li>
                                            <li><a data-toggle="tab" href="#tab1"><span class="requestBussinessTabsHeading4">Resturants</span></a></li>
                                            <li><a data-toggle="tab" href="#tab1"><span class="requestBussinessTabsHeading5">Other Services</span></a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="tab1" class="tab-pane fade in active">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4">
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills1" type="checkbox">
                                                                <label for="selectedSkills1">Accounting</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills2" type="checkbox">
                                                                <label for="selectedSkills2">Business Consulting</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills3" type="checkbox">
                                                                <label for="selectedSkills3">Immigration Services</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills4" type="checkbox">
                                                                <label for="selectedSkills4">Online Marketing</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills5" type="checkbox">
                                                                <label for="selectedSkills5">Real Estate</label>
                                                            </span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills6" type="checkbox">
                                                                <label for="selectedSkills6">Advertising</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills7" type="checkbox">
                                                                <label for="selectedSkills7">Computer Repairs</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills8" type="checkbox">
                                                                <label for="selectedSkills8">Insurance</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills9" type="checkbox">
                                                                <label for="selectedSkills9">Photographers</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills10" type="checkbox">
                                                                <label for="selectedSkills10">Real Estate Investments</label>
                                                            </span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills11" type="checkbox">
                                                                <label for="selectedSkills11">App Development</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills12" type="checkbox">
                                                                <label for="selectedSkills12">Graphic Design</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills13" type="checkbox">
                                                                <label for="selectedSkills13">Marketing</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills14" type="checkbox">
                                                                <label for="selectedSkills14">Printing</label>
                                                            </span>
                                                            <span class="checkboxCont">
                                                                <input name="selectedSkills[]" id="selectedSkills15" type="checkbox">
                                                                <label for="selectedSkills15">Website Design</label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <input id="section-1-right" class="btn blackBtn" type="submit" value="SUBMIT NOW">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="personalInner addInner animated" id="section-2">

                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="formHeadingWithStyle selectSkillsAndBusniessHeading">
                                        <span>Your Service Area! /<span>View Our Location</span></span>
                                    </h1>
                                </div>
                            </div>
                            <div class="requestBussinessAddressFormCont">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="col-sm-12 registrationFormFieldCont">
                                            <label>Service Area*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 registrationFormFieldCont">
                                            <label>Service Kilometers*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
                                                <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 registrationFormFieldCont">
                                            <label> </label>
                                            <input type="button" class="btn tranparentBtn largeFontBtn" value="Click To View MAp"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <img src="{{ asset('img/front/map.jpg') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 registrationFormFieldCont">
                                    <label> </label>
                                    <input type="button" class="btn tranparentBtn btnWithLeftArrow" value="BACK" id="section-2-left"/>
                                </div>
                                <div class="col-sm-6 registrationFormFieldCont text-right">
                                    <label> </label>
                                    <input type="submit" class="btn blackBtn" value="CONTINUE" id="section-2-right"/>
                                </div>
                            </div>
                        </div>
                    
                        <div class="personalInner addInner homeInner animated" id="section-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="formHeadingWithStyle selectSkillsAndBusniessHeading">
                                        <span>Contact Details /<span>Put Your Information</span></span>
                                    </h1>
                                </div>
                            </div>
                            <div class="requestBussinessContactDetailsCont">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="requestBussinessContactDetailsRowHeading">
                                                    <img src="{{ asset('img/front/icon_heading_contact_details.png') }}" alt="Contact Details" /> Contact Details</h3>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>Your Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_bus_name.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>Project Title</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>Position</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_position_icon.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>Phone Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_phone.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_email.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h3 class="requestBussinessContactDetailsRowHeading">
                                            <img src="{{ asset('img/front/icon_heading_business_details.png') }}" alt="Business Details" /> Business Details</h3>
                                        <div class="row">
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Business Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_bus_name.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Tax ID</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_tax_id.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Industries You Buy From</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_you_buy_from.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Industries You Sell From</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_you_sell_to.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Street Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_position_icon.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Zip</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_zip.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>City</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_city.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Country</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_country.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Business Phone</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_work_phone.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 registrationFormFieldCont">
                                                <label>Website URL</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_site.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="requestBussinessContactDetailsRowHeading">
                                                    <img src="{{ asset('img/front/icon_heading_login_account.png') }}" alt="Login Account" /> Login Account</h3>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>User Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_name_icon.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_password.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label>Confirm Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_password.png') }}" alt="" /></span>
                                                    <input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 registrationFormFieldCont">
                                                <label></label>
                                                <div class="input-group col-sm-12">
                                                    <select class="customDropdown form-control input-lg" name="">
                                                        <option value="">How Did You Hear About Us?</option>
                                                        <option value="option">Option</option>
                                                        <option value="option">Option</option>
                                                        <option value="option">Option</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row iAgreeCheckBoxCont">
                                <div class="col-sm-12 registrationFormFieldCont">
                                    <span class="checkboxCont">
                                        <input id="subscribeToNewsletter" type="checkbox" name="subscribeToNewsletter">
                                        <label for="subscribeToNewsletter">I’d Like To Receive Monthly Newsletter</label>
                                    </span>
                                </div>
                                <div class="col-sm-12 registrationFormFieldCont">
                                    <span class="checkboxCont">
                                        <input id="iAgreeCheckBox" type="checkbox" name="iAgreeCheckBox">
                                        <label for="iAgreeCheckBox">
                                            I Agree To The Terms & Conditions. <a href="">Terms & Conditions*</a>.</label>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 registrationFormFieldCont">
                                    <label> </label>
                                    <input id="section-3-left" type="button" class="btn tranparentBtn btnWithLeftArrow" value="BACK"/>
                                </div>
                                <div class="col-sm-6 registrationFormFieldCont text-right">
                                    <label> </label>
                                    <input type="submit" class="btn blackBtn" value="CONTINUE"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@include('partials.footer_form')
@endsection
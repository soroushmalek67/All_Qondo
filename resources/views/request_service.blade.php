@extends('templates.sub_pages_template')
@section('page-content')
<section class="loginFormSection loginFormSectionNw topSection">
    <div class="loginFormCont registrationFormCont signupShortForm requestQuoteShortForm">
			
        <div class="row visible-xs-block visible-sm-block">
            <div class="col-xs-12 loginFormSectionNwFormInner service-detail-req" id="service-detail-req-mobile"></div>
        </div>
        
        <form role="form" method="POST" action="{{ url('request-service') }}" id="requestServiceForm" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
                <div class="col-sm-12">
                    <div class="loginFormSectionNwFormInner">
                        <div class="row">
                            <div class="text-center sign-in-pen">
<!--                                <img src="{{asset('img/front/sign-in-pen.png')}}">-->
                            </div>
                            <h1 class="req-details-head text-left">Request Details</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-8">
                    <div class="col-sm-12">@include("partials.form_errors")</div>
                    <div class="col-sm-12 loginFormSectionNwForm">
                        <div class="loginFormSectionNwFormInner">
                            <div class="row thick-border-left">
                                <div class="col-sm-12 registrationFormFieldCont">
                                    <div class="input-group login-field">
                                        <input type="text" class="form-control input-lg" name="title" value="{{old('title')}}" required aria-describedby="basic-addon1" placeholder="Request Title">
                                    </div>
                                </div>
    
                                @if($supplier_id==null)
                                <div class="col-sm-6 registrationFormFieldCont">
                                    <div class="input-group login-field">
                                        
                                        <select required id="main_categories" name="main_categories" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                onchange="getSubCategories(this);">
                                            <option value="">Select Main Categories</option>
                                            {{--*/ $selectedCatId = profileGetFieldsValues(old('main_categories'), $selectedCategories); /*--}}
                                            @foreach ($categories as $category)
                                            <option @if ($category->id == $selectedCatId) selected @endif 
                                                     value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--*/ $subCatsSelectedids = profileGetFieldsValues(old('sub_categories'), $selectedSubCategories) /*--}}
                                <div class="col-sm-6 registrationFormFieldCont">
                                    <div class="input-group login-field">
                                        
                                        <select required name="sub_categories" id="sub_categories" class="customDropdown form-control input-lg"  
                                                aria-describedby="basic-addon1" @if (!Auth::guest()) onchange="selectedSuppliers(this,'');"@endif>
                                                <option value="">Select Sub Categories</option>
                                        </select>
                                    </div>
                                </div>
                                @else
                                {{--*/ $subCatsSelectedids = "" /*--}}
                                @endif
                                <div class="col-sm-12 registrationFormFieldCont">
                                    <div class="input-group login-field">
                                        
                                        <textarea class="form-control input-lg" name="description" required 
                                                  aria-describedby="basic-addon1" placeholder="Describe What you're looking for in more detail...">{{old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="registrationFormCont">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Upload Image</label>
                                                <a data-toggle="tooltip" title="Upload relevant image">
                                                    <i class="glyphicon glyphicon-info-sign"></i></a>
                                                <div class="inUpload Filesput-group input-group">
                                                    <span class="input-group-btn input-group-lg">
                                                        <span class="btn btn-primary btn-file" style="margin: 5px 0px 17px 0px;">
                                                            <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                                                            <input type="file" name="image">
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control input-lg" style='border: 1px solid;margin: 5px 0px 0px 0px;' readonly>
                                                </div>
                                            </div>
                                            <br/>
                                            <label>When Do You Need It? *</label><br/>
    <!--                                        <span class="radioBtnCont">
                                                <input type="radio" name="when_need_it" value="1" id="whenINeedItVal1" required 
                                                       onclick="showHideField(this, '3', '#whenNeedItDateCont', 'hide')" 
                                                       @if (old('when_need_it') == 1) checked  @endif/>
                                                       <label for="whenINeedItVal1">I’m Flexible</label>
                                            </span>-->
                                            <span class="radioBtnCont">
                                                <input type="radio" name="when_need_it" value="2" onclick="showHideField(this, '3', '#whenNeedItDateCont', 'hide')" 
                                                       id="whenINeedItVal2" @if (old('when_need_it') == 2) checked  @endif/>
                                                       <label for="whenINeedItVal2">Within 48 Hours</label>
                                            </span>
                                            <span class="radioBtnCont">
                                                <input type="radio" name="when_need_it" value="3" onclick="showHideField(this, '3', '#whenNeedItDateCont', 'hide')" 
                                                       id="whenINeedItVal3" @if (old('when_need_it') == 3) checked  @endif/>
                                                       <label for="whenINeedItVal3">Specific Date</label>
                                            </span>
                                            <div class="col-sm-12 registrationFormFieldCont" id="whenNeedItDateCont">
                                                <label></label>
                                                <div class="input-group login-field"">
                                                    <span><i class="glyphicon glyphicon-calendar" style="color: #fff;"></i></span>
                                                    <input type="text" class="form-control input-lg datepicker" name="when_need_it_date" value="{{old('when_need_it_date')}}" 
                                                           id="whenNeeditDate" aria-describedby="basic-addon1">
                                                </div>
                                                <label>Time of Day</label>
                                                <div class="input-group login-field"">
                                                    <span><i class="glyphicon glyphicon-calendar" style="color: #fff;"></i></span>
    
                                                    <select required id="time_of_day" name="time_of_day" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" >
                                                        <option @if (old('time_of_day') == 'Morning') selected @endif>Morning</option>
                                                        <option @if (old('time_of_day') == 'Afternoon') selected @endif >Afternoon</option>
                                                        <option @if (old('time_of_day') == 'Evening') selected @endif>Evening</option>
                                                    </select>
                                                </div>
                                            </div>
    
    
                                            <div class="col-sm-12 registrationFormFieldCont">
    
                                            </div>
    
    
                                        </div>
                                    </div>
                                    <div class="col-md-6 registrationFormFieldCont">
                                        <?php /*?><div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-8 registrationFormFieldCont"><?php */?>
                                                    <label>Estimated Available Budget</label>
                                                    <div class="input-group login-field">
                                                        
                                                        <?php /*  ?>
                                                        <input type="number" class="form-control input-lg" name="estimated_budget" value="{{old('estimated_budget')}}" aria-describedby="basic-addon1" min="0">
                                                        <?php */?>
                                                        <select name="estimated_budget" class="customDropdown form-control input-lg">
                                                            <option value="small">Small ($50 - $249)</option>
                                                            <option value="medium">Medium ($250 -$999)</option>
                                                            <option value="large">Large ($1000+)</option>
                                                        </select>
                                                        <?php
                                                            //Remove the following input if remove/active the next div for budget type
                                                        ?>
                                                        <input type="hidden" name="budget_type" value="0"/>
                                                    </div>
                                                <?php /*?></div>
                                                <div class="col-sm-4 registrationFormFieldCont">
                                                    <label>Budget Type</label>
                                                    <span class="radioBtnCont">
                                                        <input type="radio" name="budget_type" id="per_project" value="0" class="budget_radio" @if (old('budget_type') == '0') checked @elseif (old('budget_type') != '0' && old('budget_type') != '1') checked @endif/>
                                                               <label for="per_project" class='per-project'>Per Project</label>
                                                        <input type="radio" name="budget_type" id="per_hour" value="1" class="budget_radio" @if (old('budget_type') == '1') checked  @endif/>
                                                               <label for="per_hour">Per Hour</label>
                                                    </span>
                                                    <span class="radioBtnCont">
                                                    </span>
                                                </div>
                                            </div>
                                        </div><?php */?>
    
                                        <!--<div style="margin-top: 20px;" id="map_canvas"></div>-->
                                    </div>
    
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        @if(Auth::id()!=null)
                                        @if($openly==null)
                                        @if($supplier_id == null)
                                        <input type="hidden" name="how_to_proceed" value="1" />
                                        <?php /*?><div class="col-sm-12">
                                            <br>
                                            <label>How would you like to proceed? *</label><br/>
                                            <span class="radioBtnCont">
                                                <input type="radio" name="how_to_proceed" value="1" onclick="showHideField(this, '2', '#contractors_list', 'hide')" 
                                                       id="need_it_now" @if (old('how_to_proceed') == 1) checked  @endif/>
                                                       <label for="need_it_now">Hire contractor now</label>
                                            </span>
                                            <span class="radioBtnCont">
                                                <input type="radio" name="how_to_proceed" value="2" onclick="showHideField(this, '2', '#contractors_list', 'hide')" 
                                                       id="quotes_only" @if (old('how_to_proceed') == 2) checked  @endif/>
                                                       <label for="quotes_only">Quotes only</label>
                                            </span>
                                        </div>
    
                                        <div id="contractors_list" class="col-sm-6 registrationFormFieldCont active-suppliers-sec" style="display: none;">
                                            <label>Select Specific Contractors (Optional)</label>
                                            <a data-toggle="tooltip" title="Select suppliers of your choice">
                                                <i class="glyphicon glyphicon-info-sign "></i></a>
                                            <div class="input-group login-field">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/form_icon_sub_cat.png') }}" alt="" /></span>
                                                <select name="asuppliers[]" id="asuppliers" class="customDropdown form-control input-lg" 
                                                        aria-describedby="basic-addon1" multiple   data-live-search="true" data-actions-box="true">
                                                </select>
                                            </div>
                                        </div><?php */?>
                                        @endif    
                                        @endif 
                                        @else
                                        <input type="hidden" name="how_to_proceed" value="1">
                                        @endif    
                                    </div>
                                </div>
    						</div>
                            <div class="row">
    
    
                                <div class="col-md-6">
                                    <div class="row">
    
    
                                    </div>
                                </div>
    
                                @if (Auth::Guest())
                                <div class="col-sm-12"><hr/><h3 class="text-center">Account Information</h3></div>
                                <div class="col-sm-12 class">
                                    <div class="row">
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <span class="radioBtnCont">
                                                <input type="radio" name="existingUser" value="1" id="existingUser" required 
                                                       onchange='showHideLoginForm(this);' @if (old('existingUser') != 2) checked  @endif/>
                                                       <label for="existingUser">Already Member? Sign in</label>
                                            </span>
                                        </div>
                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <span class="radioBtnCont">
                                                <input type="radio" name="existingUser" value="2" id="newUser" 
                                                       onchange='showHideLoginForm(this);' @if (old('existingUser') == 2) checked  @endif/>
                                                       <label for="newUser">New Member? Sign up</label><br/><br/>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 active" id="requestFormLoginFieldsCont">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>E-Mail Address (Required)</label>
                                                    <div class="input-group login-field">
                                                        <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                                        <input type="text" name="loginEmail" class="form-control" value="{{old('loginEmail')}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label>Password (Required)</label>
                                                    <div class="input-group login-field">
                                                        <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span>
                                                        <input type="password" name="loginPassword" value="{{old('loginPassword')}}" 
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 text-right">
                                                    <div class="margin-top-15">
                                                        <a href="{{url('/password/email')}}" target="_blank">Forget Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="requestFormRegisterFieldsCont">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-12 registrationFormFieldCont">
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group login-field">
                                                        <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                                        <input required type="text" name="first_name" class="form-control" value="{{old('first_name')}}" 
                                                               placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group login-field">
                                                        <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                                        <input required type="text" name="last_name" class="form-control" value="{{old('last_name')}}" 
                                                               placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 active">
                                                    <div class="input-group login-field">
                                                        <span>
                                                            <img src="{{ asset('img/front/form_icon_bus_name.png') }}">
                                                            <a data-toggle="tooltip" data-html="true" 
                                                               title="The display name is the visible name used<br/>to communicate with other users">
                                                                <i class="glyphicon glyphicon-info-sign"></i></a>
                                                        </span>
                                                        <input type="text" id="get_building_name" required name="building_name" class="form-control" value="{{old('building_name')}}" 
                                                               placeholder="Building name">
                                                        <input type="hidden"  name="building_id" id="building_id"  value="{{old('building_id')}}" >
    
    
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group login-field">
                                                        <span><img src="{{ asset('img/front/form_icon_email.png') }}"></span>
                                                        <input required type="email" name="email" class="form-control" value="{{old('email')}}" 
                                                               placeholder="E-Mail Address">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                	<div class="input-group login-field">
                                                        <span><img src="{{ asset('img/front/form_icon_phone.png') }}"></span>
                                                        <div style="position:absolute;color:#6F6F6F;padding:a;padding-top:10px;font-size:18px;font-family:MuseoSans100;z-index:999;background-color: #f0f2f3;padding-bottom: 10px;border-right: 1px solid #d4d4d4;padding-right: 7px;padding-left: 3px;">+1</div>
                                                        <input required type="text" name="mobile_number" class="form-control" value="" pattern=".{9,11}" minlength="11" 
                                                               placeholder="Cell Phone Number" id="personnum" style="padding-left:40px;">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="input-group login-field">
                                                        <span>
                                                            <img src="{{ asset('img/front/form_icon_password.png') }}">
                                                            <a data-toggle="tooltip" title="Minimum password length should be 6">
                                                                <i class="glyphicon glyphicon-info-sign"></i></a>
                                                        </span>
                                                        <input type="password" required name="password" class="form-control" value="{{old('password')}}" id="password" 
                                                               placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="input-group login-field">
                                                        <span><img src="{{ asset('img/front/form_icon_password.png') }}"></span>
                                                        <input type="password" required name="password_confirmation" class="form-control" 
                                                               placeholder="Confirm Password" value="{{old('password_confirmation')}}">
                                                    </div>
                                                </div>
    <!--                                                            <div class="col-sm-12">
                                                <div class="input-group login-field">
                                                    <span><img src="{{ asset('img/front/form_icon_password.png') }}"></span>
                                                    <input type="password" required name="password_confirmation" class="form-control" 
                                                                placeholder="Confirm Password" value="{{old('password_confirmation')}}">
                                                </div>
                                            </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-12 registrationFormFieldCont">
                                    <label></label>
                                    <input type="hidden" name="lati" value="{{old('lati')}}"/>
                                    <input type="hidden" name="longi" value="{{old('longi')}}"/>
                                    <input type="hidden" name="singleSupplier" value="{{$supplier_id}}"/>
    
                                    <input type="hidden" name="userType" value="1"/>
                                    <input type="hidden" name="iAmA" value="1"/>
    
                                    <div class="text-center submit-btn-auth">
                                        <input type="submit" class="" value="CONTINUE" id="btn-continue">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-sm-12 loginFormSectionNwFormInner service-detail-req" id="service-detail-req-desktop">

                            {{--*/ $subCatsSelectedids = profileGetFieldsValues(old('sub_categories'), $selectedSubCategories) /*--}}

                            @foreach ($subCategories as $subCategories)
                            @if ($subCategories->category_id == $subCatsSelectedids) 


                            <div class="service-req-head">
                                <div class="service-img-req-page">

                                    <img src="@if (!empty($subCategories->category_icon)){{asset('/img/category/category_icons/'.$subCategories->category_icon)}} @else {{asset('img/front/newhome/placehoder_sub_categories.png')}} @endif">
                                </div>
                                <h1>{{$subCategories->catName}} </h1>
                            </div>
                            <p class="service-req-des">@if(empty($subCategories->description)) 
                                @if (!empty($parent_cat_des[0]->description)){{$parent_cat_des[0]->description}}
                                @endif 
                                @else 
                                {{$subCategories->description}} @endif

                            </p>
                            @endif 

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="verifycodemodal" class="modal fade" role="dialog" style="margin-top: 10%">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Please Enter Code You Received</h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="sentcode">
                </div>
                <div class="modal-footer">
                    <p style="font-size: 12px !important;margin-right: 39%;">Did not get verification code?</p>
                    <a href="javascript:;" id="resendcode" style="color: #FC7B16; margin-right: 47%; font-size: 12px">Re-send verification code.</a><p></p>
                    <button type="button" id="verifycodebtn" class="btn btn-success">Verify</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    jQuery('document').ready(function () {

        getSubCategories("[name='main_categories']", "{{$subCatsSelectedids}}");
        getCities("[name='state']", 'city', '{{profileGetFieldsValues(old("city"), $defaultLocation["id"])}}');
        validator = $("#requestServiceForm").validate({
            errorPlacement: $.noop,
            ignore: ':hidden',
            rules: {
                when_need_it_date: {
                    required: {
                        depends: function () {
                            return $("input[name='when_need_it']:checked").val() === '3';
                        }
                    }
                },
            }
        });
        showHideLoginForm('[name="existingUser"]:checked')
    });
    function showHideLoginForm(checkbox) {
        if ($(checkbox).val() == 1) {
            $("#requestFormLoginFieldsCont").slideDown();
            $("#requestFormRegisterFieldsCont").slideUp();
            $("#requestFormLoginFieldsCont input").attr('required', 'required');
            $("#requestFormRegisterFieldsCont input").removeAttr('required');
        } else {
            $("#requestFormRegisterFieldsCont").slideDown();
            $("#requestFormLoginFieldsCont").slideUp();
            $("#requestFormRegisterFieldsCont input").attr('required', 'required');
            $("#requestFormLoginFieldsCont input").removeAttr('required');
        }
    }
	$("#personnum").keydown(function(e) {
		var value = $(this).val();
		$(this).val(value.replace('+', ''));
	});
	
	$(window).on('load', function() {
		var dhtml = $("body #service-detail-req-desktop").html();//alert(dhtml);
		$("body #service-detail-req-mobile").html(dhtml);
	});
</script>

@endsection
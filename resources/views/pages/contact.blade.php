@extends('templates.sub_pages_template')
@section('page-content')
        <section class="loginFormSection loginFormSectionNw">
            <div class="loginFormCont registrationFormCont">
                <form id="contactUsForm" class="form-horizontal" role="form" method="POST" action="{{ url('contact-us') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center sign-in-pen"><img src="{{asset('img/front/sign-in-pen.png')}}"></div>
                            <h1>Contact Us</h1>
                        </div>
                        <div class="col-sm-12">@include("partials.form_errors")</div>
                        <div class="col-sm-12 loginFormSectionNwForm">
                            <div class="loginFormSectionNwFormInner">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                            <input required type="text" name="firstName" class="form-control" value="{{old('firstName')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Last Name (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                            <input required type="text" name="lastName" class="form-control" value="{{old('lastName')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>E-Mail Address (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/form_icon_email.png') }}"></span>
                                            <input required type="email" name="email" class="form-control" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Phone Number (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/form_icon_phone.png') }}"></span>
                                            <input type="text" required name="phoneNumber" class="form-control" value="{{old('phoneNumber')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Business or Building Name (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/form_icon_bus_name.png') }}"></span>
                                            <input type="text" required name="companyName" class="form-control" value="{{old('companyName')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Description (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/form_icon_desc.png') }}"></span>
                                            <textarea name="description" required class="form-control">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="text-center submit-btn-auth">
                                            <input type="submit" value="Send">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <script type="text/javascript">$("#contactUsForm").validate({errorPlacement: $.noop});</script>
@endsection
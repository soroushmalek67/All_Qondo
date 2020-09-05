@extends('templates.sub_pages_template')
@section('page-content')
        <section class="loginFormSection loginFormSectionNw">
            <div class="loginFormCont registrationFormCont">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('password/reset') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center sign-in-pen"><img src="{{asset('img/front/sign-in-pen.png')}}"></div>
                            <h1>Reset Password</h1>
                            <!-- <h1><img src="{{ asset('img/front/signin_lock.png') }}" alt=""/> SIGN I<span>n</span></h1> -->
                        </div>
                        <div class="col-sm-12">@include("partials.form_errors")</div>
                        <div class="col-sm-12 loginFormSectionNwForm">
                            <div class="loginFormSectionNwFormInner">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>E-Mail Address (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                            <input type="text" name="email" class="form-control" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Password (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Confirm Password (Required)</label>
                                        <div class="input-group login-field">
                                            <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="text-center submit-btn-auth">
                                        <input type="submit" value="Reset Password">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="not-red-link-auth margin-top-15 text-center">
                                            <a href="{{ url('/auth/register') }}">Not Registered? Click here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
@endsection
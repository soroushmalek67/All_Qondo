@extends('templates.sub_pages_template')
@section('page-content')
        <section class="loginFormSection loginFormSectionNw">
            <div class="loginFormCont registrationFormCont">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center sign-in-pen"><img src="{{asset('img/front/sign-in-pen.png')}}"></div>
                            <h1>Reset Password</h1>
                            <!-- <h1><img src="{{ asset('img/front/signin_lock.png') }}" alt=""/> SIGN I<span>n</span></h1> -->
                        </div>
                        <div class="col-sm-12">
                            
                            @if (session('status'))
                                    <div class="alert alert-success text-center">
                                            {{ session('status') }}
                                    </div>
                            @endif
                            
                            @include("partials.form_errors")
                        </div>
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
                                        <div class="text-center submit-btn-auth">
                                            <input type="submit" value="Send Password Reset Link">
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
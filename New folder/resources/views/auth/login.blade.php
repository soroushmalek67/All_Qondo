@extends('templates.sub_pages_template')
@section('page_title') Login @endsection
@section('page-content')
<section class="loginFormSection loginFormSectionNw clearfix">
    <div class="loginFormCont registrationFormCont signupShortForm" id="log-form-margin">
        <!--<form role="form" method="POST" action="{{ url('/auth/login') }}">-->
        <form role="form" method="POST" action="{{url('/auth/login')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center sign-in-pen"><img src="{{asset('img/front/sign-in-pen.png')}}"></div>
                    <h1>Login</h1>
                    <!-- <h1><img src="{{ asset('img/front/signin_lock.png') }}" alt=""/> SIGN I<span>n</span></h1> -->
                </div>
                <div class="col-sm-12">@include("partials.form_errors")</div>
                <div class="col-sm-12">
                    <div class="userTypeCont">
                        <span class="radioBtnCont">
                            <input type="radio" name="userType" value="1" id="userTypeVal1"/>
                            <label for="userTypeVal1"> Resident </label>
                        </span>
                        <span class="radioBtnCont">
                            <input type="radio" name="userType" value="2" id="userTypeVal2"/>
                            <label for="userTypeVal2">Contractor</label>
                        </span>
                        <span class="radioBtnCont">
                            <input type="radio" name="userType" value="1" id="userTypeVal3"/>
                            <label for="userTypeVal3" class="manager_rad">Manager</label>
                        </span>
                    </div>
                </div> 
                <div class="col-sm-12 loginFormSectionNwForm">
                    <div class="loginFormSectionNwFormInner">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>E-Mail Address (Required)</label>
                                <div class="input-group login-field">
                                    <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                    <input id="login-email" type="text" name="email" class="form-control" value="{{old('email')}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label>Password (Required)</label>
                                <div class="input-group login-field">
                                    <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span>
                                    <input id="login-password" type="password" name="password" value="{{old('password')}}" class="form-control">
                                </div>
                            </div>
                            <!--                                      social login-->


                            <div class="text-center submit-btn-auth">
                                <input name="loginSubmit"  type="submit" value="Sign in">
                            </div>
                            <div class="col-sm-12">
                                <div class="not-red-link-auth margin-top-15 text-center">
                                    <a href="{{ url('/auth/register') }}">Not Registered? Click here</a>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <span class="checkboxCont margin-top-15" id="remember-767">
                                    <input type="checkbox" id="remember" name="remember" value="1" @if(old('remember') == 1) checked @endif />
                                           <label for="remember">Remember Me</label>
                                </span>
                            </div>
                            <div class="col-sm-6 text-right">
                                <div class="margin-top-15">
                                    <a href="{{url('/password/email')}}" id="forget_pass">Forget Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--social login-->
        <div class="col-sm-12 otherLogins register text-center">
            <div class="col-sm-12 social_login_div">
                <h1>Social Login</h1>
                <span class="radioBtnCont">
                    <input type="radio" required name="iAmA2" value="1" id="iAmA2Val1" />
                    <label for="iAmA2Val1" class="bootom-res">Resident </label>
                </span>
                <span class="radioBtnCont">
                    <input type="radio" name="iAmA2" value="2" id="iAmA2Val2" />
                    <label for="iAmA2Val2">Contractor</label>
                </span>
                <span class="radioBtnCont">
                    <input type="radio" name="iAmA2" value="1" id="iAmA2Val3" />
                    <label for="iAmA2Val3" class="bootom-mang">Manager</label>
                </span>
                
            </div>
            <a class="fb-login" href="#" onclick="fblogin();return false;">Facebook</a>
            <a class="in-login" href="#" onclick="liAuth();return false;">LinkedIn </a>
        </div>
        <!--social login--> 
    </div>
</section>

<form role="form" id="social_form" method="POST" action="{{ url('/sociallogin') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="frstname" class="" value="" name="firstname">
    <input type="hidden" id="lstname" class="" value="" name="lstname">
    <input type="hidden" id="bizness" class="" value="" name="bizness">
    <input type="hidden" id="email_registr" class="" value="" name="email_register">
    <input type="hidden" id="social_pass" class="" value="" name="social_pass">
    <!--<input type="hidden" id="" class="" value="" name="social_pass">-->
    <input type="hidden" id="social_flag" value=1 name="social_flag">
    <input type="hidden" id="userType" value="" name="userType">
</form>






@endsection







<!--@ extends('app')

@ section('content')
<div class="container-fluid">
        <div class="row">
                <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                                <div class="panel-heading">Login</div>
                                <div class="panel-body">
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

                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                <div class="form-group">
                                                        <label class="col-md-4 control-label">E-Mail Address</label>
                                                        <div class="col-md-6">
                                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="col-md-4 control-label">Password</label>
                                                        <div class="col-md-6">
                                                                <input type="password" class="form-control" name="password">
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-4">
                                                                <div class="checkbox">
                                                                        <label>
                                                                                <input type="checkbox" name="remember"> Remember Me
                                                                        </label>
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-4">
                                                                <button type="submit" class="btn btn-primary">Login</button>

                                                                <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
                                                        </div>
                                                </div>
                                        </form>
                                </div>
                        </div>
                </div>
        </div>
</div>
@ endsection-->








<script>

//  function onLinkedInLoad() {
//        IN.UI.Authorize().place();      
//        IN.Event.on(IN, "auth", function () { onLogin(); });
//        IN.Event.on(IN, "logout", function () { onLogout(); });
//    }
//
//    function onLogin() {
//            IN.API.Profile("me").result(displayResult);
//    }  
//    function displayResult(profiles) {
//        member = profiles.values[0];
//        alert(member.id + " Hello " +  member.firstName + " " + member.lastName);
//    }




//function fblogin() {
//            FB.login(function(response) {
//              //...
//            }, {scope:'email'});
//          }
    function login() {
        FB.api('/me?fields=id,name,email', function (response) {

            var error = (response.error) ? 1 : 0;
            var email = response.email ? 1 : 0;
            console.log(response);
            
            

            document.getElementById("frstname").value = response.name;
            document.getElementById("lstname").value = "";
            document.getElementById("bizness").value = "";
            
            if (email) {
                document.getElementById("email_registr").value = response.email;
            } else if (!error || !email) {
                alert("Please Grant Access of your email to complete signup through FB Social Login")
                error = 1;
            }
            document.getElementById("social_pass").value = response.id;


            if ($('#iAmA2Val1').is(':checked') || $('#iAmA2Val3').is(':checked')) {
                document.getElementById("userType").value = "1";
            }
            else if ($('#iAmA2Val2').is(':checked')) {
                document.getElementById("userType").value = "2";
            }

            if (!error) {
                document.getElementById("social_form").submit();
            }

//                    jQuery.ajax({
//                        url: "http://www.pioneerliving.simple-helix.net/process.php",
//                        type: "POST",
//                        data: {
//                            fbemail :response.email,
//                            fbname  :response.name
//                        },
//                        success: function(result) {
//                            console.log(result);
//                            $('#loginMessage').html(result);
//                            if(result == 'Successufully login!'){
//                                location.reload();
//                            }
//                        }
//                    });



        });
    }


    function validation() {
        if ($('#iAmA2Val1').is(':checked'))
            return true;
        if ($('#iAmA2Val2').is(':checked'))
            return true;
        if ($('#iAmA2Val2').is(':checked'))
            return true;
        if ($('#iAmA2Val3').is(':checked'))
            return true;

        $(".social_login_div span label").css("color", "red");

        alert("Please select your type first.");
        return false;
    }



    function fblogin() {
        if (validation()) {
            FB.login(function (response) {
                login();
            }, {scope: 'email'});
        }
    }


//function checkLoginState() {
//    FB.getLoginStatus(function(response) {
//      statusChangeCallback(response);
//    });
//  }

    function liAuth() {
        if (validation()) {
            IN.User.authorize(function () {
                onLinkedInAuth();
            });
        }
    }

//function login(){
//                FB.api('/me', function(response) {
//                    alert(response.email);
//                    jQuery.ajax({
//                        url: "http://www.pioneerliving.simple-helix.net/process.php",
//                        type: "POST",
//                        data: {
//                            fbemail :response.email,
//                            fbname  :response.name
//                        },
//                        success: function(result) {
//                            $('#loginMessage').html(result);
//                            if(result == 'Successufully login!'){
//                                location.reload();
//                            }
//                        }
//                    });
//                });
//            }



    // Load the SDK asynchronously



//function checkLoginState() {
//    FB.getLoginStatus(function(response) {
//      statusChangeCallback(response);
//    });
//  }



//function statusChangeCallback(response) {
//
//    
//    
//   
////    console.log(response);
//    // The response object is returned with a status field that lets the
//    // app know the current login status of the person.
//    // Full docs on the response object can be found in the documentation
//    // for FB.getLoginStatus().
//    if (response.status === 'connected') {
//      // Logged into your app and Facebook.
//      facebookretriveInfo();
//    } else if (response.status === 'not_authorized') {
//      // The person is logged into Facebook, but not your app.
//      document.getElementById('status').innerHTML = 'Please log ' +
//        'into this app.';
//    } else {
//      // The person is not logged into Facebook, so we're not sure if
//      // they are logged into this app or not.
//      document.getElementById('status').innerHTML = 'Please log ' +
//        'into Facebook.';
//    }
//  }



//function facebookretriveInfo() {
//    console.log('Welcome!  Fetching your information.... ');
//     var url = '/me?fields=id,name,email';
//        FB.api(url, function(response) {
////            console.log(response);
//            
//            
////            console.log(data.values[0].positions.values[0].company);
//                document.getElementById("frstname").value = response.name;
//                document.getElementById("lstname").value = "";
//                document.getElementById("bizness").value = "";
//                document.getElementById("email_register").value = response.email;
//                document.getElementById("social_pass").value =response.id;
//               
//                
//                
//                
//               document.getElementById("social_form").submit(); 
//            
//            
//            
//            
//            
////             alert(response.name + " " + response.id + " " +response.email);
//        }, {scope: 'email'});
//  }





//        function onLinkedInLoad() {
//            IN.Event.on(IN, "auth", onLinkedInAuth);
//        }

    // 2. Runs when the viewer has authenticated
    function onLinkedInAuth() {
        IN.API.Profile("me").fields("first-name", "last-name", "email-address", "id", "positions:(is-current,company:(name))").result(function (data) {
            console.log(data);

            var firstname = data.values[0].firstName;
            var lastname = data.values[0].lastName;

            var positions = data.values[0].positions;
            var company_name = (positions._total) ? data.values[0].positions.values[0].company.name : '';
            var emailAddress = data.values[0].emailAddress;
            var headline = data.values[0].headline;

            document.getElementById("frstname").value = firstname;
            document.getElementById("lstname").value = lastname;
            document.getElementById("bizness").value = positions;
            document.getElementById("email_registr").value = emailAddress;
            document.getElementById("social_pass").value = headline;


            if ($('#iAmA2Val1').is(':checked')) {
                document.getElementById("userType").value = "1";
            }
            else if ($('#iAmA2Val2').is(':checked')) {
                document.getElementById("userType").value = "2";
            }


            if (emailAddress != '')
                document.getElementById("social_form").submit();
        }).error(function (data) {
            console.log(data);
        });
    }
</script>
<script type="text/javascript">
    $(window).load(function () {
        $('#myModal1').modal('show');
    });
</script>
@extends('templates.dashboard_pages_template')
@section('page_title') Dedicated URL @endsection
@section('page-content')

                    @include("partials.form_errors")
                    <div class="registrationFormCont">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="formHeadingWithStyle">
                                    <span>Dedicated URL Not Found</span>
                                </h1>
                                <p>You need a dedicated membership for this function</p>
                            </div>
                            <a href="contact-us" class="btn btnWithRightArrow">Contact us today</a>
                        </div>
                    </div>
@endsection
@extends('templates.sub_pages_template')
@section('page-content')
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            <li>Not Found</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="registrationFormSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 privacy">
                        <br/><br/><h1>404 Not Found</h1>
                        <p>
                            Oops! The page you request was not found!<br/>
                            <a href="{{url('/')}}">return to homepage</a>
                        </p><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                    </div>
                </div>
            </div>
        </section>
@endsection
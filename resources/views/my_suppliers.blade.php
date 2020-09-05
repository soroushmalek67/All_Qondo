@extends('templates.dashboard_pages_template')
@section('page_title')  Import Contractors @endsection
@section('page-content')

@include("partials.form_errors")
<div class="dashboardMyPostedProjectsCont">
    <h5>My {{$userPostType}}s</h5>
    <form role="form" method="POST" action="{{ url('csv') }}{{Auth::id()}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="registrationFormCont">
            <div class="row">
             
<!--                <div class="col-sm-6 registrationFormFieldCont">
                    <label>Main Categories *</label>
                    <div class="input-group login-field">
                        <span><img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
                        {{--*/ $selectedCatId = profileGetFieldsValues(old('main_categories'), explode(",", $userDetails->main_categories)) /*--}}
                        <select name="state" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" required multiple
                                onchange="getSubCategories(this, '{{implode(",", profileGetFieldsValues(old("sub_categories"), 
                                                        explode(",", $userDetails->sub_categories)))}}', true);" data-live-search="true">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>-->
<!--                <div class="col-sm-6 registrationFormFieldCont">
                    <label>Sub Categories *</label>
                    <div class="input-group login-field">
                        <span class="input-group-addon input-lg" id="basic-addon1">
                            <img src="{{ asset('img/front/form_icon_sub_cat.png') }}" alt="" /></span>
                        <select name="sub_categories[]" id="sub_categories" class="customDropdown form-control input-lg" 
                                aria-describedby="basic-addon1" multiple onchange="getSuppliers(this, '', true);"
                                data-live-search="true">
                        </select>
                    </div>
                </div>-->
<!--                <div class="col-sm-6 registrationFormFieldCont">
                    <label>Suppliers *</label>
                    <div class="input-group login-field">
                        <span class="input-group-addon input-lg" id="basic-addon1">
                            <img src="{{ asset('img/front/form_icon_sub_cat.png') }}" alt="" /></span>
                        <select name="suppliers[]" id="suppliers" class="customDropdown form-control input-lg" 
                                aria-describedby="basic-addon1" multiple>
                        </select>
                    </div>
                </div>-->
                 
                        <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Upload CSV file</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-btn input-group-lg">
                                                <span class="btn btn-primary btn-file">
                                                    <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                                                    <input type="file" name="csv" value="{{old('company_logo_file')}}">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control input-lg" readonly>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-sm-12 registrationFormFieldCont" >
                                           <label></label>
                                             <a  href="{{asset('dwon/sample_buyer.csv')}}">Download Sample File</a>
                                        </div>
                </div>
               
                <div class="col-sm-12 registrationFormFieldCont">
                    <input type="submit" class="btn btnWithRightArrow" value="Save"/>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
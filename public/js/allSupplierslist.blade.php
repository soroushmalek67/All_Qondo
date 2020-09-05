@extends('templates.dashboard_pages_template')
@section('page_title') {{$dashboardUser}} Import Suppliers from Database @endsection
@section('page-content')

@include("partials.form_errors")
<div class="dashboardMyPostedProjectsCont">
    <h5>My {{$userPostType}}s</h5>
    <form role="form" method="POST" action="{{ url('allsupplierListAdd') }}{{Auth::id()}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="registrationFormCont">
            <div class="row">
                
                
                                    <div class="col-sm-6 registrationFormFieldCont cityhide"  style="display: none">
                                        <label>City *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_city.png') }}" alt="" /></span>
                                            <select name="city" id="city" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                    data-live-search="true" onchange="getSuppliers('#sub_categories', this,'');">
                                            </select>
                                        </div>
                                    </div>
                
                
                <div class="col-sm-6 registrationFormFieldCont">
                    <label>Main Categories *</label>
                    <div class="input-group login-field">
                        <span><img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
                        {{--*/ $selectedCatId = profileGetFieldsValues(old('main_categories'), explode(",", $userDetails->main_categories)) /*--}}
                        <select name="state" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" multiple
                                onchange="getSubCategories(this, '', true);" data-live-search="true">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 registrationFormFieldCont">
                    <label>Sub Categories *</label>
                    <div class="input-group login-field">
                        <span class="input-group-addon input-lg" id="basic-addon1">
                            <img src="{{ asset('img/front/form_icon_sub_cat.png') }}" alt="" /></span>
                        <select name="sub_categories[]" id="sub_categories" class="customDropdown form-control input-lg" 
                                aria-describedby="basic-addon1" multiple onchange="getSuppliers(this, '#statesA','');"
                                data-live-search="true" data-actions-box="true">
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-6 registrationFormFieldCont cityhide" >
                                        <label>Province/State *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_state.png') }}" alt="" /></span>
                                            {{--*/ $selectedStatesids = profileGetFieldsValues(old('state'), $userDetails->state); /*--}}
                                            <select name="state[]" class="customDropdown form-control input-lg" id="statesA" aria-describedby="basic-addon1" 
                                                    onchange="getSuppliers('#sub_categories', this,'');" 
                                                    multiple
                                                    data-live-search="true">
                                                <option value="">Select Province/State</option>
                                                @foreach ($states as $state)
                                                    <option  value="{{$state->id}}" 
                                                             data-stateiso="{{$state->iso}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                
                
                
                <div class="col-sm-6 registrationFormFieldCont">
                    <label>Suppliers *</label>
                    <div class="input-group login-field">
                        <span class="input-group-addon input-lg" id="basic-addon1">
                            <img src="{{ asset('img/front/form_icon_sub_cat.png') }}" alt="" /></span>
                        <select name="suppliers[]" id="suppliers" class="customDropdown form-control input-lg" 
                                aria-describedby="basic-addon1" multiple  data-live-search="true" data-actions-box="true">
                        </select>
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



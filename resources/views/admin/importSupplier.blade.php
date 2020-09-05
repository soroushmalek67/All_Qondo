@extends('admin.app')


@section('contentheader_title')
Import Unregistered users

@endsection


@section('main-content')


<div class="dashboardMyPostedProjectsCont">

    <form role="form" method="POST" action="{{ url('admin-panel/supplier-buyer-list') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="registrationFormCont">
            <div class="row">
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
                <div class="col-sm-6 registrationFormFieldCont" style="top:20px">
                    <label>
                        <a  href="{{asset('dwon/sample.csv')}}">Download Sample File</a><br/>
                        <a  href="{{asset('dwon/all_ids_lists.xlsx')}}"> Download List File for (Main Categories, Sub Categories, Provinces/States, Cities)</a>
                    </label>
                </div>



                <div class="col-sm-12 registrationFormFieldCont" style="top:20px">
                    <input type="submit" class="btn btnWithRightArrow" value="Save"/>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection

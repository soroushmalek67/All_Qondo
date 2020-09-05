@extends('admin.app')

@section('htmlheader_title') Add State @endsection
@section('contentheader_title')
    State
    <a class="btn btn-default" href="{{ url('admin-panel/states/add') }}"><i class="fa fa-plus"></i></a>
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Add State</h3>
    </div><!-- /.box-header -->
    @include("partials.form_errors")
    <form action="{{ url('admin-panel/states') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$stateDetails->id}}">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">State Name</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="State Name" type="text" name="name" value="{{$stateDetails->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tax Percentage</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Tax Percentage" type="number" max="100" name="tax_percent" value="{{$stateDetails->tax_percent}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                    <select class="form-control" name="country_id">
                        @foreach($country as $contry)
                        {{--*/$country_id = $contry->id /*--}}
                        <option  <?php  if($stateDetails->country_id == $contry->id) echo'selected'; ?>   value="{{$contry->id}}">{{$contry->name}}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input class="btn btn-primary pull-right" type="submit" value="Save"/>
        </div><!-- /.box-footer -->
    </form>
</div><!-- /.box -->
@endsection

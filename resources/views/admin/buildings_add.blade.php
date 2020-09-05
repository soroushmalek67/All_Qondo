
@extends('admin.app')

@section('htmlheader_title') Add Building @endsection
@section('contentheader_title')
Building
<a class="btn btn-default" href="{{ url('admin-panel/buildings/add') }}"><i class="fa fa-plus"></i></a>
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Add Building</h3>
    </div><!-- /.box-header -->
    @include("partials.form_errors")
    <form action="{{ url('admin-panel/buildings') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$buildingDetails->id}}">
        <input type="hidden" name="previous_status" value="{{$buildingDetails->status}}">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Building Name</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Building Name" type="text" name="building_name" value="{{$buildingDetails->building_name}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Building Address</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Building Address" type="text" name="Address" value="{{$buildingDetails->Address}}">
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-2 control-label">Province Name</label>

                <div class="col-sm-10">
                    <select class="form-control" name="state_id" onchange="getCities(this, 'city_id');">
                        <option value="" @if ($buildingDetails->state_id == 0) selected @endif>No state Selected</option>
                        @if (count($states) > 0)
                        @foreach ($states as $state)
                        <option value="{{$state['id']}}" @if ($buildingDetails->state_id == $state['id']) selected @endif>
                                {{$state['name']}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">City Name</label>
                <div class="col-sm-10">
                    <select class="form-control" name="city_id" id="city_id">
                        <option value="" @if ($buildingDetails->city_id == 0) selected @endif>No City Selected</option>
                        @if (count($cities) > 0)
                        @foreach ($cities as $city)
                        <option value="{{$city['id']}}" @if ($buildingDetails->city_id == $city['id']) selected @endif>
                                {{$city['name']}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Lot number</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Lot Number" type="text" name="lot_number" value="{{$buildingDetails->lot_number}}">
                </div>
            </div><div class="form-group">
                <label class="col-sm-2 control-label">Postal code</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Postal code" type="text" name="postal_code" value="{{$buildingDetails->postal_code}}">
                </div>
            </div><div class="form-group">
                <label class="col-sm-2 control-label">URL</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="URL" type="text" name="url" value="{{$buildingDetails->url}}">
                </div>
            </div><div class="form-group">
                <label class="col-sm-2 control-label">Management company </label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Management company" type="text" name="management_company" value="{{$buildingDetails->management_company}}">
                </div>
            </div><div class="form-group">
                <label class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Phone" type="text" name="Phone" value="{{$buildingDetails->Phone}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Onsite Manager</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="onsite_manager" type="text" name="onsite_manager" value="{{$buildingDetails->onsite_manager}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-control" name="status" id="status">
                        <option value="1" @if ((profileGetFieldsValues(old('status'), $buildingDetails->status)) === "1")  selected @endif>Approved</option>
                        <option value="0"  @if ((profileGetFieldsValues(old('status'), $buildingDetails->status)) === "0")  selected @endif>Unapproved</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <input class="btn btn-primary pull-right" type="submit" value="Save"/>
        </div><!-- /.box-footer -->

</div><!-- /.box-body -->

</form>
</div><!-- /.box -->
@endsection

<script type="text/javascript">
    //this fucntion was made for getting the states of country on country change
//        function myFunction(a){
//            
//     $.ajax({
//        url: URL + "/ajax/get-States",
//        method: "POST",
//        data: {
//            countryid: a
//        },
//        success: function(e) {
//          
//            
//        }
//    }) 
//    
//    
//
//   
//}
</script>
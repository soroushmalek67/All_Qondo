@extends('admin.app')

@section('htmlheader_title') Cities @endsection
@section('contentheader_title')
    Cities
    <a class="btn btn-default" href="{{ url('admin-panel/cities/add') }}"><i class="fa fa-plus"></i></a>
@endsection

@section('contentheader_description')
    <!--<li class="active">Categories</li>-->
@endsection


@section('main-content')
<div class="row">
    <div class="col-xs-12">


        <div class="box">
<!--            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div> /.box-header -->
            @include("partials.form_errors")
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th width="100">City DB Id</th>
                        <th width="500">City Name</th>
                        <th width="300">Province</th>
                        <th width="300">Country</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($cities) > 0)
                        {{--*/ $loopCounter = 0 /*--}}
                        @foreach ($cities as $city)
                            {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <td>{{$loopCounter}}</td>
                                <td>{{$city['id']}}</td>
                                <td>{{$city['name']}}</td>
                                <td>{{$city['province']}}</td>
                                <td>{{$city['countryName']}}</td>
                                <td class="text-right">
                                    <a class="btn btn-default" href="{{ url("admin-panel/cities/".$city['id']) }}">
                                        <i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger deleteCity_modal" data-id="{{$city['id']}}" data-name="{{$city['name']}}"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>City Name</th>
                        <th>Province</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->


    </div>
</div>

<!-- page script -->
<script type="text/javascript">
    $(function () {
        $('#example2').dataTable().fnDestroy();
        $('#example2').DataTable({
            "paging": true,
            "pageLength": 25,
            "lengthChange": false,
            "info": true,
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <p>By deleting city "<b id="deleteItemName"></b>", the following data related to this city, will also be deleted and/or unlinked. Are you sure to proceed?</p>
        <ul>
        	<li>Buildings</li>
        	<li>Services Requests</li>
            <li>Quotes</li>
            <li>Quotes Invitations</li>
            <li>Invoices</li>
            <li>Messages</li>
            <li>Reviews & Testimonials</li>
        </ul>
      </div>
      <div class="modal-footer">
        <form action="{{url('admin-panel/cities')}}" method="POST" id="deleteForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="_method" value="DELETE"/>
            <input name="id" value="" type="hidden" id="deleteCityId">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete Now</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("body").on("click", ".deleteCity_modal", function(){
		var cityId = $(this).data('id');
		var cityName = $(this).data('name');
		$("#deleteCityId").val(cityId);
		$("b#deleteItemName").text(cityName);
		$('#deleteModal').modal('show');
	});
});
</script>
@endsection

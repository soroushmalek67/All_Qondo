@extends('admin.app')

@section('htmlheader_title') Categories @endsection
@section('contentheader_title')
    Categories
    <a class="btn btn-default" href="{{ url('admin-panel/categories/add') }}"><i class="fa fa-plus"></i></a>
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
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th width="800">Category Name</th>
                        <th width="100">Status</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($categories) > 0)
                        {{--*/ $loopCounter = 0 /*--}}
                        @foreach ($categories as $category)
                        {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <td>{{$loopCounter}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->catStatus}}</td>
                                <td class="text-right">
                                        <a class="btn btn-default" href="{{ url("admin-panel/categories/edit/".$category->category_id) }}">
                                            <i class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger deleteCategory_modal" data-id="{{$category->category_id}}" data-name="{{$category->name}}"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Status</th>
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
            "pageLength": 15,
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
        <p>By deleting category "<b id="deleteItemName"></b>", the following data related to this category, will also be deleted and/or unlinked. Are you sure to proceed?</p>
        <ul>
        	<li>Sub-Categories</li>
        	<li>Services Requests</li>
            <li>Quotes</li>
            <li>Quotes Invitations</li>
            <li>Invoices</li>
            <li>Messages</li>
            <li>Reviews & Testimonials</li>
        </ul>
      </div>
      <div class="modal-footer">
        <form action="{{url('admin-panel/categories/delete/')}}" method="POST" id="deleteForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete Now</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("body").on('click', '.deleteCategory_modal', function(){
		var catId = $(this).data('id');
		var catName = $(this).data('name');
		var action = $("#deleteForm").attr("action");
		$("#deleteForm").attr("action", action+'/'+catId);//alert($("#deleteForm").attr("action"));
		$("b#deleteItemName").text(catName);
		$('#deleteModal').modal('show');
	});
});
</script>
@endsection

@extends('admin.app')

@section('htmlheader_title') {{$pageTitle}} @endsection
@section('contentheader_title')
{{$pageTitle}}
<a class="btn btn-default" href="{{ url('admin-panel/users/add') }}" title="Add User"><i class="fa fa-plus"></i></a>
@endsection


@section('main-content')
<div class="row">
    <div class="col-md-12">
    <div class="col-md-12">
        @include("admin.partials.form_errors")
        <div class="box">
            <div class="box-body">
                <form action="{{url('admin-panel/users/'.$search_action)}}" method="get">
                    <div class="row admin_top_filter">
                        <div class="col-md-12">
                            <div class="pull-right "><!-- box-tools -->
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search_string" class="form-control pull-right" placeholder="Search" value="{{$search_string}}" style="width: 200px;">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="10">No</th>
                            <th width="100">Name</th>
                            <th width="200">Email</th>
                            <th width="100">Business Name</th>
                            <th width="60">Phone Number</th>
                            <th width="60">City</th>
                            <th width="60">State</th>
                            <th width="50">User Type</th>
                            <th width="70">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                        {{--*/ $loopCounter = ($users->currentPage() * $users->perPage()) - $users->perPage() /*--}}
                        @foreach ($users as $user)
                        {{--*/ $loopCounter++ /*--}}
                        <tr>
                            <td>{{$loopCounter}}</td>
                            <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['business_name']}}</td>
                            <td>{{$user['phone_number']}}</td>
                            <td>{{$user['city']}}</td>
                            <td>{{$user['state']}}</td>
                            <td>{{($user['user_type'] == 3) ? "Both" : (($user['user_type'] == 1) ? "Buyer" : "Supplier")}}</td>
                            <td class="text-right">
                                    <a class="btn btn-default" href="{{ url("admin-panel/users/edit/".$user['id']) }}"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger deleteUser_modal" data-username="{{$user['first_name']}} {{$user['last_name']}}" data-userid="{{$user['id']}}">
                                        <i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Business Name</th>
                            <th>Phone Number</th>
                            <th>City</th>
                            <th>State</th>
                            <th>User Type</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">{!! $users->appends($pagination_params)->render() !!}</div>
                    </div>
                </div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <p>By deleting user "<b id="deleteUsername"></b>", the following data related to this user, will also be deleted and/or unlinked. Are you sure to proceed?</p>
        <ul>
        	<li>Services Requests</li>
            <li>Quotes</li>
            <li>Quotes Invitations</li>
            <li>Invoices</li>
            <li>Messages</li>
            <li>Reviews & Testimonials</li>
            <li>Referrals</li>
            <li>Promotion Coupons</li>
            <li>Refunds</li>
            <li>Transactions</li>
        </ul>
      </div>
      <div class="modal-footer">
        <form action="{{url("admin-panel/users")}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="_method" value="DELETE"/>
            <input name="id" value="" type="hidden" id="deleteUserId">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete Now</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".deleteUser_modal").click(function(){
		var userId = $(this).data('userid');
		var userName = $(this).data('username');
		$("b#deleteUsername").text(userName);
		$("#deleteUserId").val(userId);
		$('#deleteModal').modal('show');
	});
});
</script>
@endsection

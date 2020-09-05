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
                                <form action="{{url("admin-panel/users")}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <input type="hidden" name="id" value="{{$user['id']}}"/>
                                    <a class="btn btn-default" href="{{ url("admin-panel/users/edit/".$user['id']) }}">
                                        <i class="fa fa-edit"></i></a>
                                    <button onclick="javascript: return confirm('Do you really want to delete this item');" 
                                            type="submit" class="btn btn-danger">
                                        <i class="fa fa-times"></i></button>
                                </form>
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
@endsection

@extends('admin.app')

@section('htmlheader_title') {{$pageTitle}} @endsection
@section('contentheader_title')
    {{$pageTitle}}
@endsection


@section('main-content')
<div class="row">
    <div class="col-md-12">
    	@include("admin.partials.form_errors")
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date range:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="reservation" name="dateRange" class="form-control pull-right" 
                                       value="{{(Input::has('startDate')) ? date('m/d/Y', strtotime(Input::get('startDate'))).' - '
                                                   .date('m/d/Y', strtotime(Input::get('endDate'))) : ''}}" />
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form>
                            <input type="hidden" name="startDate"/>
                            <input type="hidden" name="endDate" />
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="input-group">
                                    <input type="submit" value="Submit" class="btn btn-primary" />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </form>
                    </div>
                </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="10">No</th>
                        <th width="200">Email</th>
                        <th width="100">IP Address</th>
                        <th width="100">Time</th>
                        <th width="50">Status</th>
                        <th width="50">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                        {{--*/ $loopCounter = ($users->currentPage() * $users->perPage()) - $users->perPage() /*--}}
                        @foreach ($users as $user)
                            {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <td>{{$loopCounter}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['ip']}}</td>
                                <td>{{$user['created_at']}}</td>
                                <td>{{($user['status'] == 0) ? 'Failed' : 'Success'}}</td>
                                <td>Login</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>IP Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
              </table>
                <div class="row">
                    <div class="col-md-12">
                        <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">{!! $users->render() !!}</div>
                    </div>
                </div>
                     
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

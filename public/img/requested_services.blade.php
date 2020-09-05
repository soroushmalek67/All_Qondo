@extends('admin.app')

@section('htmlheader_title') Requested Services @endsection
@section('contentheader_title') Requested Services @endsection


@section('main-content')
@include("partials.form_errors")
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th width="150">Title</th>
                        <th width="50">Estimated Budget</th>
                        <th width="50">State</th>
                        <th width="50">City</th>
                        <th width="80">Buyer Name</th>
                        <th width="60">Status</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($requestedServices) > 0)
                        {{--*/ $loopCounter = 0 /*--}}
                        @foreach ($requestedServices as $requestedService)
                        {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <td>{{$loopCounter}}</td>
                                <td>{{$requestedService['title']}}</td>
                                <td>{{$requestedService['estimated_budget']}}</td>
                                <td>{{$requestedService['state']}}</td>
                                <td>{{$requestedService['city']}}</td>
                                <td>{{$requestedService['first_name']}} {{$requestedService['last_name']}}</td>
                                <td style="color: {{($requestedService['status'] == 0) ? "#00c0ef" : (($requestedService['status'] == 1) ? "green" : "red")}}">
                                    {{getRequestStatus($requestedService['status'])}}
                                </td>
                                <td class="text-right">
                                    <form action="{{url('admin-panel/requested-services')}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input type="hidden" name="id" value="{{ $requestedService['id'] }}"/>
                                        <input type="hidden" name="buyer_id" value="{{ $requestedService['buyer_id'] }}"/>
                                        <input type="hidden" name="list_type" value="{{ $requestedService['list_type'] }}"/>
                                        <a class="btn btn-default" href="{{ url('admin-panel/requested-services/'.$requestedService['id']) }}" title="View">
                                            <i class="fa fa-eye"></i></a>
                                        <!--@ if ($requestedService['status'] == 0 || $requestedService['status'] == 2)-->
                                            <button type="submit" name="approveIt" @if ($requestedService['status'] == 1 
                                                     || $requestedService['status'] == 3) disabled  @endif
                                                    class="btn btn-{{($requestedService['status'] == 0) ? "info" : (($requestedService['status'] == 1) ? "success" : "danger")}}" 
                                                    title="Approve"><i class="fa fa-check-square"></i></button>
                                        <!--@ else-->
                                            <input type="hidden" name="currentStatus" value="{{$requestedService['status']}}" />
                                            <button type="submit" name="rejectIt" class="btn btn-danger" title="Unapprove" 
                                                     @if ($requestedService['status'] == 1 || $requestedService['status'] == 2 
                                                     || $requestedService['status'] == 3)) disabled  @endif>
                                                <i class="fa fa-minus-square"></i></button>
                                        <!--@ endif-->
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Estimated Budget</th>
                        <th>Postal Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
              </table>
                <div class="row">
                    <div class="col-md-12">
                        <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">{!! $requestedServices->render() !!}</div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

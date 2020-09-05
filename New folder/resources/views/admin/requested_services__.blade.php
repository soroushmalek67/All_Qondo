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
                        <!--<th width="40">No</th>-->
                        <th width="10">Req-ID</th>
                        <th width="100">Title</th>
                        <th width="10">
                        	Estimated Budget
                        	<?php $budgettypes = array('small' => 'Small ($50 - $250)', 'medium' => 'Medium ($251 -$1000)', 'large' => 'Large ($1000 +)'); ?>
                        </th>
                        <th width="50">State</th>
                        <th width="50">City</th>
                        <th width="80">Buyer Name</th>
                        <th width="60">Status</th>
                        <th width="60">Request Type</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($requestedServices) > 0)
                        {{--*/ $loopCounter = 0 /*--}}
                        @foreach ($requestedServices as $requestedService)
                        {{--*/ $loopCounter++ /*--}}
                            <tr @if ($requestedService['when_need_it'] == 2) class="bg-success" @endif>
                                <!--<td>{{$loopCounter}}</td>-->
                                <td>{{$requestedService['id']}}</td>
                                <td>{{$requestedService['title']}}</td>
                                <td>
                                	<?php $estimated_budget = $budgettypes[$requestedService['estimated_budget']]; ?>
                                    {{$estimated_budget}}
                                </td>
                                <td>{{$requestedService['state']}}</td>
                                <td>{{$requestedService['city']}}</td>
                                <td>{{$requestedService['first_name']}} {{$requestedService['last_name']}}</td>
                                <td style="color: {{($requestedService['status'] == 0) ? "#00c0ef" : (($requestedService['status'] == 1) ? "green" : "red")}}">
                                    {{getRequestStatus($requestedService['status'])}}
                                </td>
                                 <td> @if ($requestedService['how_to_proceed'] == 1) 
                                     Need It Now
                                        @else @if ($requestedService['how_to_proceed'] == 2) 
                                     Quotes Only
                                    @endif
                                    @endif
                                 
                                 </td>
                                <td class="text-right">
                                    <form action="{{url('admin-panel/requested-services')}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input type="hidden" name="id" value="{{ $requestedService['id'] }}"/>
                                        <input type="hidden" name="buyer_id" value="{{ $requestedService['buyer_id'] }}"/>
                                        <input type="hidden" name="list_type" value="{{ $requestedService['list_type'] }}"/>
                                        <input type="hidden" name="supplier_id" value="{{ $requestedService['supplier_id'] }}"/>
                                        <input type="hidden" name="openly" value="{{ $requestedService['openly'] }}"/>
                                        <input type="hidden" name="currentStatus" value="{{$requestedService['status']}}" />
                                        <input type="hidden" name="currentShowOnHome" value="{{$requestedService['show_on_home']}}" />
                                        <a class="btn btn-default" href="{{ url('admin-panel/requested-services/'.$requestedService['id']) }}" title="View">
                                            <i class="fa fa-eye"></i></a>
                                        @if ($requestedService['status'] == 0 || $requestedService['status'] == 2)
                                            <button type="submit" name="approveIt" @if ($requestedService['status'] == 1 
                                                     || $requestedService['status'] == 3) disabled  @endif
                                                    class="btn btn-{{($requestedService['status'] == 0) ? "info" : (($requestedService['status'] == 1) ? "success" : "danger")}}" 
                                                    title="Approve"><i class="fa fa-check-square"></i>
                                            </button>
                                            <button type="submit" name="rejectIt" class="btn btn-danger" title="Unapprove" 
                                                     @if ($requestedService['status'] == 1 || $requestedService['status'] == 2 
                                                     || $requestedService['status'] == 3)) disabled  @endif>
                                                <i class="fa fa-minus-square"></i>
                                            </button>
                                        @endif
                                        @if (($requestedService['status'] == 0 || $requestedService['status'] == 1) && $requestedService['show_on_home'] == 0)
                                            <button type="submit" name="not_show_on_home" class="btn btn-warning" title="Don't Show On Home">
                                                    <i class="fa fa-times"></i></button>
                                        @endif
                                        @if (($requestedService['status'] == 0 || $requestedService['status'] == 1) && $requestedService['show_on_home'] == 1)
                                            <button type="submit" name="not_show_on_home" class="btn btn-success" title="Show On Home">
                                                    <i class="fa fa-check"></i></button>
                                        @endif
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
                        <th>Request Type</th>
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

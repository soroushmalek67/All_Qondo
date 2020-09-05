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
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="10">No</th>
                        <th width="100">IP Address</th>
                        <th width="50">Count</th>
                        <th width="100">Page</th>
                        <th width="100">City</th>
                        <th width="100">Country</th>
                        <th width="100">Last Time</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($visits) > 0)
                        {{--*/ $loopCounter = ($visits->currentPage() * $visits->perPage()) - $visits->perPage() /*--}}
                        @foreach ($visits as $visit)
                            {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <td>{{$loopCounter}}</td>
                                <td>{{$visit['ip']}}</td>
                                <td>{{$visit['count']}}</td>
                                <td>{{$visit['page']}}</td>
                                <td>{{$visit['city']}}</td>
                                <td>{{$visit['country']}}</td>
                                <td>{{$visit['updated_at']}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>IP Address</th>
                        <th>Count</th>
                        <th>Page</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Last Time</th>
                    </tr>
                </tfoot>
              </table>
                <div class="row">
                    <div class="col-md-12">
                        <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">{!! $visits->render() !!}</div>
                    </div>
                </div>
                     
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

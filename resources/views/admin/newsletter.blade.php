@extends('admin.app')

@section('htmlheader_title') Newsletter Subscribers @endsection
@section('contentheader_title') Newsletter Subscribers @endsection


@section('main-content')
@include("partials.form_errors")
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="10">No</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($subscribers) > 0)
                        {{--*/ $loopCounter = 0 /*--}}
                        @foreach ($subscribers as $subscriber)
                        {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <td>{{$loopCounter}}</td>
                                <td>{{$subscriber->email}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                    </tr>
                </tfoot>
              </table>
                <div class="row">
                    <div class="col-md-12">
                        <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">{!! $subscribers->render() !!}</div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

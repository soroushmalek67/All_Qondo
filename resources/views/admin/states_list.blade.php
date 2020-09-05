@extends('admin.app')

@section('htmlheader_title') States @endsection
@section('contentheader_title')
    States
    <a class="btn btn-default" href="{{ url('admin-panel/states/add') }}"><i class="fa fa-plus"></i></a>
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
                        <th width="100">State DB id</th>
                        <th width="500">Name</th>
                        <th width="400">Country Name</th>
                        <th width="300">Tax Percent</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($states) > 0)
                        {{--*/ $loopCounter = 0 /*--}}
                        @foreach ($states as $state)
                            {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <td>{{$loopCounter}}</td>
                                <td width="100">{{$state['id']}}</td>
                                <td>{{$state['name']}}</td>
                                <td>{{$state['countryName']}}</td>
                                <td>{{$state['tax_percent']}}</td>
                                <td class="text-right">
                                    <form action="{{url("admin-panel/states")}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="hidden" name="id" value="{{$state['id']}}"/>
                                        <a class="btn btn-default" href="{{ url("admin-panel/states/".$state['id']) }}">
                                            <i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th width="40">No</th>
                        <th width="400">Name</th>
                        <th width="150">Tax Percent</th>
                        <th width="100">Action</th>
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

@endsection

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
                                    <form action="{{url("admin-panel/categories/delete/".$category->category_id)}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <a class="btn btn-default" href="{{ url("admin-panel/categories/edit/".$category->category_id) }}">
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
            "pageLength": 25,
            "lengthChange": false,
            "info": true,
        });
    });
</script>

@endsection

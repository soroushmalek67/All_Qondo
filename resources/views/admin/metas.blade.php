@extends('admin.app')

@section('htmlheader_title') Metas @endsection
@section('contentheader_title')
    Meta Add
    <a class="btn btn-default" href="{{ url('admin-panel/seo/metas/add') }}" title="Add User"><i class="fa fa-plus"></i></a>
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
                        <th width="200">Name</th>
                        <th width="200">Slug</th>
                        <th width="200">Meta Title</th>
                        <th width="70">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($metas) > 0)
                        {{--*/ $loopCounter = ($metas->currentPage() * $metas->perPage()) - $metas->perPage() /*--}}
                        @foreach ($metas as $meta)
                            {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <td>{{$loopCounter}}</td>
                                <td>{{$meta['name']}}</td>
                                <td>{{$meta['slug']}}</td>
                                <td>{{$meta['meta_title']}}</td>
                                <td class="text-right">
                                    <form action="{{url("admin-panel/seo/metas")}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="hidden" name="id" value="{{$meta['id']}}"/>
                                        <a class="btn btn-default" href="{{ url("admin-panel/seo/metas/".$meta['id']) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button onclick="return confirm('Do you really want to delete this item')" 
                                        		type="submit" class="btn btn-danger">
                                        	<i class="fa fa-times"></i>
                                        </button>
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
                        <th>Slug</th>
                        <th>Meta Title</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
              </table>
                <div class="row">
                    <div class="col-md-12">
                        <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">{!! $metas->render() !!}</div>
                    </div>
                </div>
                     
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

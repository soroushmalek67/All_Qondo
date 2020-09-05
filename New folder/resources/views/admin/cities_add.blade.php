@extends('admin.app')

@section('htmlheader_title') Add City @endsection
@section('contentheader_title')
    City
    <a class="btn btn-default" href="{{ url('admin-panel/cities/add') }}"><i class="fa fa-plus"></i></a>
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Add City</h3>
    </div><!-- /.box-header -->
    @include("partials.form_errors")
    <form action="{{ url('admin-panel/cities') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$cityDetails->id}}">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">City Name</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="City Name" type="text" name="name" value="{{$cityDetails->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    <select class="form-control" name="state">
                        <option value="" @if ($cityDetails->state == "0") selected @endif>No State Selected</option>
                        @if (count($states) > 0)
                            @foreach ($states as $state)
                                <option value="{{$state['id']}}" @if ($cityDetails->state == $state['id']) selected @endif>
                                    {{$state['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Featured</label>
                <div class="col-sm-10">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="flat-red" name="featured" value="1"  @if ($cityDetails->featured == 1) checked @endif />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr/>
            <h3 class="text-center">SEO Fields</h3>
            <hr/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Title</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Meta Title" type="text" name="meta_title" value="{{$cityDetails->meta_title}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Keywords</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Meta Keywords" 
                    name="meta_keywords">{{$cityDetails->meta_keywords}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Meta Description"
                    name="meta_description">{{$cityDetails->meta_description}}</textarea>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input class="btn btn-primary pull-right" type="submit" value="Save"/>
        </div><!-- /.box-footer -->
    </form>
</div><!-- /.box -->
@endsection

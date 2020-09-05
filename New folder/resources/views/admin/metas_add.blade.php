@extends('admin.app')

@section('htmlheader_title') Metas @endsection
@section('contentheader_title')
    Add Meta
    <a class="btn btn-default" href="{{ url('admin-panel/seo/metas/add') }}"><i class="fa fa-plus"></i></a>
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Add Meta</h3>
    </div><!-- /.box-header -->
    @include("partials.form_errors")
    <form action="{{ url('admin-panel/seo/metas') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$post->id}}">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Page Name</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Page Name" type="text" name="name" 
                           value="{{profileGetFieldsValues(old('name'), $post->name)}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Page Slug</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Page Slug" type="text" name="slug" 
                           value="{{profileGetFieldsValues(old('slug'), $post->slug)}}">
                </div>
            </div>
            <hr/>
            <h3 class="text-center">SEO Fields</h3>
            <hr/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Title</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Meta Title" type="text" name="meta_title" 
                           value="{{profileGetFieldsValues(old('meta_title'), $post->meta_title)}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Keywords</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Meta Keywords" 
                    name="meta_keywords">{{profileGetFieldsValues(old('meta_keywords'), $post->meta_keywords)}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Meta Description"
                    name="meta_description">{{profileGetFieldsValues(old('meta_description'), $post->meta_description)}}</textarea>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input class="btn btn-primary pull-right" type="submit" value="Save"/>
        </div><!-- /.box-footer -->
    </form>
</div><!-- /.box -->
@endsection

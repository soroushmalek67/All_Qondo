@extends('admin.app')

@section('htmlheader_title') Add Category @endsection
@section('contentheader_title')
    Categories
    <a class="btn btn-default" href="{{ url('admin-panel/categories/add') }}"><i class="fa fa-plus"></i></a>
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Add Category</h3>
    </div><!-- /.box-header -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('admin-panel/categories/save') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="catid" value="{{$categoryDetail->id}}">
        <input type="hidden" name="catOldImg" value="{{$categoryDetail->image}}">
        <input type="hidden" name="oldCategoryIcon" value="{{$categoryDetail->category_icon}}">
        <div class="box-body">

            <div class="form-group">
                <label class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Category Name" type="text" name="categoryName" value="{{$categoryDetail->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Description" name="categoryDescription">{{$categoryDetail->description}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Parent Category</label>
                <div class="col-sm-10">
                    <select class="form-control" name="categoryParent">
                        <option value="0" @if ($categoryDetail->parent_id == "0") selected @endif>No Parent</option>
                        @if (count($categoriesList) > 0)
                            @foreach ($categoriesList as $category)
                                <option value="{{$category->id}}" @if ($categoryDetail->parent_id == $category->id) selected @endif>
                                    {{$category->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Category Image</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Attachment
                                <input type="file" name="categoryImage">
                            </div>
                        </div>
                        @if ($categoryDetail->image != "")
                         <div class="col-md-8" id="categoryImageCont">
                             <img src="{{ asset("img/category/".$categoryDetail->image) }}" height="150" style="vertical-align: top;"/>
                             <span onclick="removeCategoryImages('#categoryImageCont', '{{$categoryDetail->image}}');">
                                 <img src="{{asset("img/front/corss.png")}}" width="50" /></span>
                         </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Category Icon</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Attachment
                                <input type="file" name="category_icon">
                            </div>
                        </div>
                        @if ($categoryDetail->category_icon != "")
                        <div class="col-md-8" id="categoryIconCont">
                             <img src="{{ asset("img/category/category_icons/".$categoryDetail->category_icon) }}" height="150" 
                                  style="vertical-align: top;"/>
                             <span onclick="removeCategoryImages('#categoryIconCont', '{{$categoryDetail->category_icon}}');">
                                 <img src="{{asset("img/front/corss.png")}}" width="50"/></span>
                         </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Featured</label>
                <div class="col-sm-10">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="flat-red" name="featured" value="1"  @if ($categoryDetail->featured == 1) checked @endif />
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
                    <input class="form-control" placeholder="Meta Title" type="text" name="meta_title" value="{{$categoryDetail->meta_title}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Keywords</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Meta Keywords" 
                    name="meta_keywords">{{$categoryDetail->meta_keywords}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Meta Description"
                    name="meta_description">{{$categoryDetail->meta_description}}</textarea>
                </div>
            </div>
            
            
<!--            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-control" name="categoryStatus">
                        <option value="1" @if ($categoryDetail->status == "1") selected @endif>Enabled</option>
                        <option value="0" @if ($categoryDetail->status == "0") selected @endif>Disabled</option>
                    </select>
                </div>
            </div>-->

            <!-- input states -->
<!--            <div class="form-group has-success">
                <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ..." />
            </div>
            <div class="form-group has-warning">
                <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with warning</label>
                <input type="text" class="form-control" id="inputWarning" placeholder="Enter ..." />
            </div>
            <div class="form-group has-error">
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with error</label>
                <input type="text" class="form-control" id="inputError" placeholder="Enter ..." />
            </div>-->

        </div><!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="categoryStatus" value="1" />
            <input class="btn btn-primary pull-right" type="submit" value="Save"/>
        </div><!-- /.box-footer -->
    </form>
</div><!-- /.box -->

<script type="text/javascript">
    function removeCategoryImages (contID, imageName) {
        var deleteImgName = "removeCatIcon";
        if (contID === '#categoryImageCont') {
            deleteImgName = "removeCatImage";
        }
        $(contID).html("<input type='hidden' name='"+deleteImgName+"' value='"+imageName+"' />");
    }
</script>
@endsection

@extends('admin.app')




@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Review and Comments</h3>
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
    <form action="{{ url('admin-panel/awards/save') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$review->id}}">
        <input type="hidden" name="created" value="{{ $review->created_at }}">
        
        <div class="box-body">

            <div class="form-group">
                <label class="col-sm-2 control-label">Company Name</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Awards Name" type="text" name="awards" value="{{$review->business_name}}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Comment</label>
                <div class="col-sm-10">
                    <textarea class="form-control input-lg" aria-describedby="basic-addon1" name="certificate_awards" readonly>{{$review->review}}</textarea>
                </div>
            </div>
            <hr/>
           
<!--          

        </div><!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="categoryStatus" value="1" />
            <div class="col-sm-10">
            <a href="{{url("admin-panel/comment/delete/".$review->id) }}" class="btn btn-primary pull-right">Delete </a>
            </div>
            @if($review->aprove==0)
                    <div class="col-sm-2">
                        <a href="{{url("admin-panel/comment/aprove/".$review->id) }}" class="btn btn-primary pull-right">Aprove </a>
                    </div>
            
            
            @endif
            
<!--            <input class="btn btn-primary pull-right" type="submit" value="delete" name="save"/>-->
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

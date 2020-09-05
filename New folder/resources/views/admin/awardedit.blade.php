@extends('admin.app')




@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Add Certificates & Awards</h3>
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
        <input type="hidden" name="id" value="{{$awards->id}}">
        <input type="hidden" name="created" value="{{ $awards->created_at }}">
        
        <div class="box-body">

            <div class="form-group">
                <label class="col-sm-2 control-label">Awards Name</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="Awards Name" type="text" name="awards" value="{{$awards->name}}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Award Icon</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Attachment
                                <input type="file" name="awardImage">
                            </div>
                        </div>
<!--                      -->
                    </div>
                </div>
            </div>
           
            <div class="col-sm-6 registrationFormFieldCont">
                                        <label>
                                            @if (empty($awards->image)) 
                                                No Logo 
                                            @else
                                                <img src="{{asset("img/awards/".getFolderStructureByDate($awards->created_at)."/"
                                                            .$awards->image)}}" 
                                                     alt="{{profileGetFieldsValues(old('business_name'), $awards->image)}}" />
                                            @endif
                                        </label>
                                    </div>
                                    
            <hr/>
           
           
            
           
            
            
<!--          

        </div><!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="categoryStatus" value="1" />
            <input class="btn btn-primary pull-right" type="submit" value="update" name="save"/>
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

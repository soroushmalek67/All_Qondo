@extends('admin.app')


@section('contentheader_title')
  Comments And Reviews
   
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
                        <th width="100">Comments</th>
                        <th width="100">Company Name</th>
                        <th width="100">Status</th>
                        <th width="70">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" name="id" value="{{$i=0}}"/>
                        @foreach ($reviews as $review )
                            
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$review->review}}</td>
                                <td>{{$review->business_name}}</td>
                                <td>@if($review->aprove==1) aprove @else unaprove @endif </td>
                                <td class="text-right">
                                    <form action="{{url("admin-panel/users")}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="hidden" name="id" value="{{$review->id}}"/>
                                        <a class="btn btn-default" href="{{ url("admin-panel/comment/edit/".$review->id) }}">
                                            <i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger" href="{{ url("admin-panel/comment/delete/".$review->id) }}">
                                            <i class="fa fa-times"></i></a>
<!--  <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>-->
                                            <!--                                       
<button onclick="javascript: return confirm('Do you really want to delete this item');" 
                                        		type="submit" class="btn btn-danger">
                                        	<i class="fa fa-times"></i></button>-->
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                  
                </tbody>
                
              </table>
                
                <?php echo $reviews->render(); ?>
                <div class="row">
                    <div class="col-md-12">
                     
                    </div>
                </div>
                     
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

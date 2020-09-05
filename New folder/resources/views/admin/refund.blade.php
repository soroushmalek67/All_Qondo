@extends('admin.app')


@section('contentheader_title')
   Refunds  
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
                        <th width="100">Supplier Name</th>
                        <th width="100">Reason</th>
                        <th width="100">status</th>
                        <th width="70">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" name="id" value="{{$i=0}}"/>
                        @foreach ($refunds as $refund )
                            
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$refund->supplierName}}</td>
                                <td>{{$refund->reason}}</td>
                                <td>@if($refund->status==1)
                                    <p style="color: green">Approve</p>
                                    @else
                                    <p style="color: red">Pending</p>
                                    @endif</td>
                                <td class="text-right">
                                    <form action="{{url("admin-panel/users")}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="hidden" name="id" value="{{$refund->id}}"/>
                                        <a class="btn btn-default" href="{{ url("admin-panel/refund/edit/".$refund->id) }}">
                                            <i class="fa fa-edit"></i></a>
                                        
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

 <?php echo $refunds->render(); ?>
                <div class="row">
                    <div class="col-md-12">
                     
                    </div>
                </div>
                     
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection

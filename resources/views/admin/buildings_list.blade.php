@extends('admin.app')

@section('htmlheader_title') Buildings @endsection
@section('contentheader_title')
    Buildings
    <a class="btn btn-default" href="{{ url('admin-panel/buildings/add') }}"><i class="fa fa-plus"></i></a>
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
                    	<?php if(Request::is('*/unapproved')){ ?>
                        <th>
                        	<input type="checkbox" name="buildings_all" />
                        	<form name="approve_buildings" id="approve_buildings" method="post" action="{{ url('admin-panel/buildings/approve-selected') }}">
                            	<input type="hidden" name="approved_buildings" value="" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            </form>
                        </th>
                        <?php } ?>
                        <th width="40">No</th>
                        <th width="600">Building Name</th>
                        <th width="600">Status</th>
                        <th width="300">City</th>
                        <th width="300">Province</th>
                        <th width="300">Country</th>
                         <th width="300">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @if (count($buildings) > 0)
                    
                        {{--*/ $loopCounter = 0 /*--}}
                        @foreach ($buildings as $building)
                            {{--*/ $loopCounter++ /*--}}
                            <tr>
                                <?php if(Request::is('*/unapproved')){ ?>
                                <td><input type="checkbox" class="selected_buildings" name="selected_buildings[]" value="{{$building['id']}}" /></td>
                                <?php }?>
                                <td>{{$loopCounter}}</td>
                                <td>{{$building['building_name']}}</td>
                                <td>@if ($building['status'] === "1") Approved @else Unapproved @endif</td>
                                <td>{{$building['CityName']}}</td>
                                <td>{{$building['province']}}</td>
                                <td>{{$building['countryName']}}</td>
                                <td class="text-right">
                                    <form action="{{url("admin-panel/buildings")}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="hidden" name="id" value="{{$building['id']}}"/>
                                        <a class="btn btn-default" href="{{ url("admin-panel/buildings/".$building['id']) }}">
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
                        <th>Building Name</th>
                         <th >Status</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Country</th>
                        <!--<th>Action</th>-->
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
            "pageLength": 100,
            "lengthChange": false,
            "info": true,
        });
    });
	
	<?php if(Request::is('*/unapproved')){ ?>
	$(document).ready(function(){
		var buildings = $("input[type=checkbox][name=buildings_all]");
		buildings.click(function(){
			if($(this).is(':checked')){
				$("input.selected_buildings").prop('checked', true);
				$("#btn-approve-buildings").removeAttr('disabled');
			}
			else
			{
				$("input.selected_buildings").prop('checked', false);
				$("#btn-approve-buildings").attr('disabled', 'disabled');
			}
		});
		
		$("input.selected_buildings").click(function(){
			var active_buildings = new Array();
			$.each($("input[name='selected_buildings[]']:checked"), function(e) {
				active_buildings.push($(this).val());
			});
			
			$("input[type=checkbox][name=buildings_all]").prop('checked', false);
			
			if(active_buildings.length === 0)
			{
				$("#btn-approve-buildings").attr('disabled', 'disabled');
			}
			else
			{
				$("#btn-approve-buildings").removeAttr('disabled');
			}
		});

		$("#example2_wrapper div.row:nth-child(1) div.col-sm-6:nth-child(1)").append('<button id="btn-approve-buildings" class="btn btn-primary btn-sm" disabled>Approve Selected Buildings</button>');
		
		$("#btn-approve-buildings").click(function(){
			var selected_buildings = new Array();
			$.each($("input[name='selected_buildings[]']:checked"), function() {
				selected_buildings.push($(this).val());
			});
			//var selected_buildings = $("input[name=selected_buildings]").val();
			//alert(JSON.stringify(selected_buildings));
			$("input[name=approved_buildings]").val(selected_buildings);
			$("form#approve_buildings").submit();
		});
	});
	<?php } ?>
</script>

@endsection

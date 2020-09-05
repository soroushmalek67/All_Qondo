@extends('admin.app')

@section('htmlheader_title') {{$requestedService['title']}} ({{getRequestStatus($requestedService['status'])}}) @endsection
@section('contentheader_title') {{$requestedService['title']}}  (Req-ID-{{$requestedService['id']}}) @endsection
@section('contentheader_description') ({{getRequestStatus($requestedService['status'])}}) @endsection


@section('main-content')

<?php
	$budgettypes = array('small' => 'Small ($50 - $249)', 'medium' => 'Medium ($250 - $999)', 'large' => 'Large ($1000+)');
	$estimated_budget = $budgettypes[$requestedService['estimated_budget']];//$requestedService['estimated_budget']
?>    
@if($requestedService['status'] == 0) 

    <div class="box box-warning">
                
            
                <form role="form" class="form-horizontal" method="POST" action="{{ url('admin-panel/requested-services') }}/{{$request_id}}" id="requestServiceForm" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="row box-body">
                        <div class="col-sm-12">
                            <div class="text-center sign-in-pen"><img src="{{asset('img/front/sign-in-pen.png')}}"></div>
                            <h1>Request Details</h1>
                        </div>
                        <div class="col-sm-12">@include("partials.form_errors")</div>
                        <div class="col-sm-12 loginFormSectionNwForm">
                            <div class="loginFormSectionNwFormInner">
                                <div class="row">
                                    
                                    <div class="form-group col-sm-12">
                                        <label class="col-sm-2 control-label">Request Title *</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" placeholder="request title" type="text" name="title" value="{{$requestedService['title']}}" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group col-sm-12">
                                        <label class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" placeholder="Description" name="description">{!!$requestedService['description']!!}</textarea>
                                        </div>
                                    </div>
                                    
                                    
                                     
                                    @if($requestedService['supplier_id']==null)
                                    
                                    
                                    <div class="form-group col-sm-12">
                                        <label class="col-sm-2 control-label">Main Category *</label>
                                        <div class="col-sm-9">
                                           <select name="main_categories" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                     onchange="getSubCategories(this);">
                                                <option value="">Select Main Categories</option>
                                                {{--*/ $selectedCatId = profileGetFieldsValues(old('main_categories'), $mainCategories); /*--}}
                                                @foreach ($categories as $category)
                                                    <option @if ($category->id == $selectedCatId) selected @endif 
                                                             value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    {{--*/ $subCatsSelectedids = profileGetFieldsValues(old('sub_categories'), $subCategories) /*--}}
                                    
                                    
                                    <div class="form-group col-sm-12">
                                        <label class="col-sm-2 control-label">Sub Category *</label>
                                        <div class="col-sm-9">
                                            <select name="sub_categories" id="sub_categories" class="customDropdown form-control input-lg"  
                                                    aria-describedby="basic-addon1" onchange="activegetSuppliers(this,'');">
                                                <option value="">Select Sub Categories</option>

                                                @foreach ($subCategoriesOr as $subCategorieOr)
                                                    <option @if ($subCategorieOr->category_id == $subCatsSelectedids) selected @endif 
                                                             value="{{$subCategorieOr->category_id}}">{{$subCategorieOr->catName}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    @else
                                          {{--*/ $subCatsSelectedids = "" /*--}}
                                          @endif
                                   
                                          
                                          
                                          
                                          <div class="form-group col-sm-12">
                                              <label class="col-sm-2 control-label">Province/State *</label>
                                              <div class="col-sm-9">
                                                  {{--*/ $selectedStatesids = profileGetFieldsValues(old('state'), $defaultLocation['state']); /*--}}
                                                  <select name="state" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" required 
                                                          onchange="getCities(this, 'city', '{{profileGetFieldsValues(old("city"), $defaultLocation["id"])}}');" 
                                                          data-live-search="true">
                                                      <option value="">Select Province/State</option>
                                                      @foreach ($states as $state)
                                                      <option @if ($state->id == $selectedStatesids)) selected @endif value="{{$state->id}}" 
                                                               data-stateiso="{{$state->iso}}">{{$state->name}}</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                          </div>
                                          
                                          
                                          
                                          <div class="form-group col-sm-12">
                                              <label class="col-sm-2 control-label">City *</label>
                                              <div class="col-sm-9">
                                                  <select name="city" id="city" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                                          required onchange="addPinToMapOnRegisterPage();" data-live-search="true">
                                                  </select>
                                              </div>
                                          </div>
                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label">Estimated Available Budget</label>
                                            <div class="col-sm-9">
												<?php /*?><input type="number" class="form-control input-lg" name="estimated_budget" value="{{$requestedService['estimated_budget']}}" 
                                                aria-describedby="basic-addon1" min="0"><?php */?>
                                                <select name="estimated_budget" class="form-control input-lg">
                                                    <option value="small">Small ($50 - $250)</option>
                                                    <option value="medium">Medium ($251 -$1000)</option>
                                                    <option value="large">Large ($1000+)</option>
                                                </select>
                                                <script type="text/javascript">
                                                	$('select[name=estimated_budget]').val('{{$estimated_budget}}');
                                                </script>
                                            </div>
                                        </div>
                                    	
                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label">When you want it *</label>
                                            <div class="col-sm-9">
                                                <input class="form-control datepicker" placeholder="request title" type="text" name="when_need_it_date" value="{{$requestedService['when_need_it_date']}}" required>
                                            </div>
                                        </div>
                                    
<!--                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Where Do You Need It?</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{asset('img/front/form_icon_where_you_need.png')}}" alt="" /></span>
                                            <input type="text" class="form-control input-lg" name="postalcode" value="{{old('postalcode')}}" 
                                                   onblur="codeAddress(this.value)" id="postalcode" aria-describedby="basic-addon1" placeholder="Your Postal Code. e.g., A1A 1B1">
                                        </div>
                                    </div>-->
                                    
                                    <div class="col-md-6 registrationFormFieldCont">
                                        <div style="margin-top: 20px;" id="map_canvas"></div>
                                    </div>
                                    
                                    <div class="col-sm-12  box-footer">
                                        <label> </label>
                                        <input type="hidden" name="userType" value="1"/>
                                        <input type="hidden" name="iAmA" value="1"/>
                                        <input type="hidden" name="buyer_id" value="{{$requestedService['buyer_id']}}">
                                        
                                            <input type="submit" class="btn btn-primary pull-right" value="Update">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
        
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Request Title : </b></p></div>
                            <div class="col-md-8"><p>{{$requestedService['title']}}</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Posted Date : </b></p></div>
                            <div class="col-md-8"><p>{{$requestedService['created_at']}}</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Main Categories : </b></p></div>
                            
                            @foreach ($categories as $category)
                                                    @if($category->id==$mainCategories)
                                                    <div class="col-md-8"><p>{{$category->name}}</p></div>
                                                    @endif
                                                @endforeach
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Sub Categories : </b></p></div>

                            @foreach ($subCategoriesOr as $subCategorieOr)
                            @if($subCategorieOr->category_id==$subCategories)
                            <div class="col-md-8"><p>{{$subCategorieOr->catName}}</p></div>
                            @endif



                            @endforeach


                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12"><p><b>Description : </b></p></div>
                            <div class="col-md-12"><p>{!!$requestedService['description']!!}</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Province/State : </b></p></div>
                            <div class="col-md-8"><p>{{$requestedService['state']}}</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>City : </b></p></div>
                            <div class="col-md-8"><p>{{$requestedService['city']}}</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Estimated Budget : </b></p></div>
                            <div class="col-md-8"><p>{{$estimated_budget}}</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>When Do You Need It? : </b></p></div>
                            <div class="col-md-8">
                                <p>{{whenDoYouNeedIt($requestedService['when_need_it'], date('m-d-Y', strtotime($requestedService['when_need_it_date'])))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>What This Purchase For?: </b></p></div>
                            <div class="col-md-8"><p>{{whatIsThisPurchaseFor($requestedService['purchase_type'])}}</p></div>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

@endif
        
                    
        <script type="text/javascript">
            jQuery('document').ready(function() {
               
                    
                
               
                getCities("[name='state']", 'city', '{{profileGetFieldsValues(old("city"), $defaultLocation["id"])}}');
                
                validator = $("#requestServiceForm").validate({
                    errorPlacement: $.noop,
                    ignore: [],
                    rules: {
                    	when_need_it_date: {
                            required: {
                                depends: function() {
                                    return $("input[name='when_need_it']:checked").val() === '3';
                                }
                            }
                        },
                    }
                });
                
                showHideLoginForm ('[name="existingUser"]:checked')
            });
            
            function showHideLoginForm (checkbox) {
                if ($(checkbox).val() == 1) {
                    $("#requestFormLoginFieldsCont").slideDown();
                    $("#requestFormRegisterFieldsCont").slideUp();
                    
                    $("#requestFormLoginFieldsCont input").attr('required', 'required');
                    $("#requestFormRegisterFieldsCont input").removeAttr('required');
                } else {
                    $("#requestFormRegisterFieldsCont").slideDown();
                    $("#requestFormLoginFieldsCont").slideUp();
                    
                    $("#requestFormRegisterFieldsCont input").attr('required', 'required');
                    $("#requestFormLoginFieldsCont input").removeAttr('required');
                }
            }
        </script>





@endsection

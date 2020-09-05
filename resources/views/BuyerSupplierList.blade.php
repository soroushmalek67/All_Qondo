@extends('templates.dashboard_pages_template')
@section('page_title') Contractors List @endsection
@section('page-content')

@include("partials.form_errors")
<div class="registrationFormCont">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="formHeadingWithStyle">
                <span>Contractor List<span></span></span>
            </h1>
            <form role="form" method="POST" action="{{ url('supplier-buyer-list') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-sm-4 registrationFormFieldCont">
                        <label>Main Category *</label>
                        <div class="input-group login-field">
                            <span><img src="{{ asset('img/front/form_icon_main_cat.png') }}" alt="" /></span>
                            <select name="main_categories" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" 
                                    required onchange="getSubCategories(this);">
                                <option value="">Select Main Categories</option>
                                {{--*/ $selectedCatId = profileGetFieldsValues(old('main_categories'), $searchmain); /*--}}
                                @foreach ($categories as $category)
                                <option @if ($category->id == $selectedCatId) selected @endif 
                                         value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--*/ $subCatsSelectedids = profileGetFieldsValues(old('sub_categories'), $searchchild) /*--}}
                    <div class="col-sm-4 registrationFormFieldCont">
                        <label>Sub Category *</label>
                        <div class="input-group login-field">
                            <span><img src="{{ asset('img/front/form_icon_sub_cat.png') }}" alt="" /></span>
                            <select name="sub_categories" id="sub_categories" class="customDropdown form-control input-lg"  
                                    aria-describedby="basic-addon1" onchange="activegetSuppliers(this, '');">
                                <option value=" ">Select Sub-Category</option>
                                @foreach ($Subcategories as $category)
                                <option @if ($category->id == $subCatsSelectedids) selected @endif 
                                         value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 registrationFormFieldCont" style="margin-top: -4px;text-align: center;">
                        <input type="hidden" name="lati" value=""/>
                        <input type="hidden" name="longi" value=""/>
                        <input type="submit" class="btn btnWithRightArrow" value="search"/>
                    </div>

                </div>
            </form>


            <div class="box">
                <div class="table-responsive">
                    <table id="buyer_supplier_list_table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th width="180">Business Name</th>
                                <th width="180">Business Profile Page</th>
                                <th width="100">Main Category</th>
                                <th width="100">Sub Category</th>
                                <th width="100">City</th>
                                <th width="100">Province</th>
                                <th width="100">Status</th>
                                <th width="70">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($supplierlists))
                                {{--*/ $loopCounter = ($supplierlists->currentPage() * $supplierlists->perPage()) - $supplierlists->perPage() /*--}}
                                @foreach ($supplierlists as $supplierlist )

                                <tr>
                                    <td>{{++$loopCounter}}</td>
                                    <td>{{$supplierlist->business_name}}</td>
                                    <td><a href="{{url('supplier-profile')}}/{{$supplierlist->business_name}}/{{$supplierlist->id}}" target="_blank">View Profile</a></td>
                                    <?php /*?><td>
                                        @if ($supplierlist->show_email == 1)
                                        {{$supplierlist->email}}
                                        @else 
                                        <a href="{{url('contact-us')}}" class=""> Contact </a>
                                        @endif
                                    </td><?php */?>
                                    {{--*/ $catsSelectedids = explode(",", $supplierlist->main_categories); /*--}}

                                    <td>
                                        @foreach($categories as $category)
                                            @for($i = 0; $i < count($catsSelectedids); $i++)
                                                @if ($catsSelectedids[$i]==$category->id)
                                                    @if(count($catsSelectedids) == 1)
                                                        {{$category->name}}
                                                    @else
                                                        {{$category->name}}, 
                                                    @endif
                                                @endif
                                            @endfor
                                        @endforeach
                                    </td>
                                    {{--*/ $subcatsSelectedids = explode(",", $supplierlist->sub_categories); /*--}}
                                    
                                    <td>

                                        @foreach($AllSubCategories as $Subcategory)

                                        @for($i= 0; $i<count($subcatsSelectedids); $i++)

                                    @if($subcatsSelectedids[$i]==$Subcategory->category_id)
                                    {{$Subcategory->catName}},
                                    @endif
    
                                    @endfor
    
    
                                    @endforeach
                                    </td>
                                <td>
                                    {{$supplierlist->cityName}}
                                </td>
                                <td>
                                    {{$supplierlist->provinceName}}
                                </td>

                                @if($supplierlist->activation)
                                <td style="color:green">Active</td>
                                     <!--<td><a href="activation/0/{{$supplierlist->id}}">Inactivate</a></td>-->
                                @else 
                                <td style="color:red">Inactive</td>
                                <!--<td><a href="activation/1/{{$supplierlist->id}}">Activate</a></td>-->
                                @endif

                                <td class="text-center info">
                                    <a href="{{ url('supplier-delete')}}{{$supplierlist->id}}"onclick="javascript: return confirm('Do you really want to delete this item');" data-toggle="tooltip" data-placement="left" title="delete"><img src="{{ asset('img/front/DeleteRed.png') }}" style="width: 15px; margin: 10px"></a>
                                    @if($supplierlist->activation)
                                     <!--<td>Active</td>-->
                                    <a href="activation/0/{{$supplierlist->id}}" data-toggle="tooltip" data-placement="left" title="incativate" onclick="javascript: return confirm('Do you really want to inactivate this User');"><img src="{{ asset('img/front/non_active.png') }}" style="width: 15px;"></a>
                                    @else 
                                         <!--<td>Inactive</td>-->
                                    <a href="activation/1/{{$supplierlist->id}}" data-toggle="tooltip" data-placement="left" title="activate" onclick="javascript: return confirm('Do you really want to activate this User');"><img src="{{ asset('img/front/active.png') }}" style="width: 15px;"></a>
                                    @endif
                                    
                                    <a href="{{url('request-service/supplier')}}/{{$supplierlist->id}}" class=""> Request&nbsp;a&nbsp;quote </a>

                                </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">No Contractor Found</td>
                                </tr>
                            @endif

                            </tbody>

                    </table>

                    <?php echo $supplierlists->render(); ?>
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>







@endsection

@extends('templates.dashboard_pages_template')
@section('page_title') Profile @endsection
@section('page-content')

                    @include("partials.form_errors")
                        <form role="form" method="POST" action="{{ url('promotion-coupon') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="registrationFormCont">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle">
                                            <span>Service/Product<span></span></span>
                                        </h1>
                                    
                                  
                                    <a href="{{url('service-product')}}" class="btn btnWithRightArrow">Add new Product</a>
                                  
                                    
                                    <div class="col-sm-12">
                                        <table class="table table-striped" style="width: 100%; margin: 10px;">
                                               <tr style=""> <th>No.</th>
                                                <th>Name</th>
                                               
                                                <th>Image</th>
                                                <th>Action</th> </tr>
                                                <input type="hidden" value="{{$i=0}}">
                                            @foreach($products as $product)
                                            <tr style="">
                                                <td>{{++$i}}</td>
                                                <td>{{$product->name}}</td>
                                               
                                            
                                                <td>
                                                   
                                                        @if (empty($product->image)) 
                                                        No Logo 
                                                        @else
                                                        <img src="{{url("img/product/".getFolderStructureByDate($product->created_at)."/"
                                                            .$product->image)}}" 
                                                              
                                                             style="width: 40%;" />
                                                        @endif
                                                    
                                                </td>
                                                <td><a href="{{ url('product-edit')}}{{$product->id}}"><img src="{{ asset('img/front/edit-icon.png') }}" alt="" style="width: 20%;"/></a> <a href="{{ url('product-delete')}}{{$product->id}}" onclick="javascript: return confirm('Do you really want to delete this item');"><img src="{{ asset('img/front/DeleteRed.png') }}" alt="" style="width: 20%;"/></a></td>
                                            </tr>
                                                
                                             @endforeach
                                        </table>
                                         <?php echo $products->render(); ?>
                                    </div
                                   
                                </div>
                            </div>
                                    
                        </form>

                    
                     
@endsection
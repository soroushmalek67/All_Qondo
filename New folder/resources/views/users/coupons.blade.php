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
                                            <span>Promotion/coupons<span></span></span>
                                        </h1>
                                    
                                  
                                    <a href="{{url('promotion-coupon')}}" class="btn btnWithRightArrow">Add new Coupon</a>
                                 
                                    
                                    <div class="col-sm-12">
                                        <table class="table table-striped" style="width: 100%; margin: 10px;">
                                               <tr style=""> <th>No.</th>
                                                <th>Name</th>
                                              
                                                <th>stars</th>
                                                <th>discount</th>
                                                <th>Image</th>
                                                <th>Action</th> </tr>
                                                <input type="hidden" value="{{$i=0}}">
                                            @foreach($coupons as $coupon)
                                            <tr style="">
                                                <td>{{++$i}}</td>
                                                <td>{{$coupon->title}}</td>
                                                
                                              
                                                <td>{{$coupon->stars}}</td>
                                                <td>{{$coupon->discount}}%</td>
                                                <td style="width: 40%;">
                                                    
                                                        @if (empty($coupon->image)) 
                                                        No Logo 
                                                        @else
                                                        <img src="{{url("img/coupon/".getFolderStructureByDate($coupon->created_at)."/"
                                                            .$coupon->image)}}" 
                                                              
                                                             style="width: 40%;" />
                                                        @endif
                                                   
                                                </td>
                                                <td><a href="{{ url('coupon-edit')}}{{$coupon->id}}"><img src="{{ asset('img/front/edit-icon.png') }}" style="width: 20%;" ></a> <a href="{{ url('coupon-delete')}}{{$coupon->id}}"onclick="javascript: return confirm('Do you really want to delete this item');"><img src="{{ asset('img/front/DeleteRed.png') }}" style="width: 20%;"></a></td>
                                            </tr>
                                                
                                             @endforeach
                                        </table>
                                         <?php echo $coupons->render(); ?>
                                    </div
                                   
                                </div>
                            </div>
                                    
                        </form>
                       
@endsection
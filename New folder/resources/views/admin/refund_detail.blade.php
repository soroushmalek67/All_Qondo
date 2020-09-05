@extends('admin.app')


@section('contentheader_title') Refund Detail @endsection

@section('main-content')

    


    
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Subject : </b></p></div>
                            <div class="col-md-8"><p>{{$refund->subject}}</p></div>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Supplier Name : </b></p></div>
                            <div class="col-md-8"><p>{{$refund->supplierName}}</p></div>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Reason : </b></p></div>
                            
                             <div class="col-md-8"><p>{{$refund->reason}}</p></div>
                                                
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><p><b>Transaction Reference : </b></p></div>
                            
                            <div class="col-md-8"><p>{{$refund->transaction_reference}}</p></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12"><p><b>Transaction : </b></p></div>
                            <div class="col-md-12"><p>{!!$refund->transaction!!}</p></div>
                        </div>
                    </div>
                    
                </div>

                
                @if($refund->status==0)
                
                <form role="form" class="form-horizontal" method="POST" action="{{ url('admin-panel/refundaprove') }}/{{$refund->id}}" id="requestServiceForm" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row box-body">

                        <div class="col-sm-12">@include("partials.form_errors")</div>
                        <div class="col-sm-12 loginFormSectionNwForm">
                            <div class="loginFormSectionNwFormInner">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label class="col-sm-2 control-label">Comment</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" placeholder="comment" name="comment"></textarea>
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

                                    <div class="col-sm-12  box-footer">
                                        <label> </label>
                                        <input type="hidden" name="email" value="{{$refund->email}}"/>
                                        <input type="hidden" name="approval_email" value="{{$refund->approval_email}}"/>
                                        <input type="hidden" name="buyer_id" value="">

                                        <input type="submit" class="btn btn-primary pull-right" value="Approve">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                
                @endif
                
                
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>



        

@endsection

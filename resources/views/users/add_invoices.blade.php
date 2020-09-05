@extends('templates.dashboard_pages_template')
@section('page_title') My Invoices @endsection
@section('page-content')

                    @include("partials.form_errors")
                    <form role="form" method="POST" action="{{ url('send-invoice') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="messagelist">          
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="formHeadingWithStyle">
                                                <span>Add Invoice<span></span></span>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="registrationFormCont">
                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Accepted Requests</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1">
                                                <img src="{{ asset('img/front/form_icon_bus_name.png') }}" alt="" />
                                            </span>
                                            <select name="request_id" class="customDropdown form-control input-lg" aria-describedby="basic-addon1" onchange="change_buyer(this);">
                                                <option value="" disabled="" selected="">Select Request</option>
                                                @foreach ($requests as $request)
                                                    <option value="{{$request->id}}" data-buyerid="{{$request->buyer_id}}" data-buyername="{{$request->first_name}} {{$request->last_name}}">{{$request->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Buyer Name</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/login-profile-img.png') }}" alt="" /></span>
                                            <input id="buyer_name" readonly="" type="text" class="form-control input-lg" name="buyer" aria-describedby="basic-addon1"/>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_estimate_budget.png') }}" alt="" /></span>
                                            <input type="number" class="form-control input-lg" name="amount" aria-describedby="basic-addon1"/>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 registrationFormFieldCont">
                                        <label>To be paid by</label>
                                        <div class="input-group">
                                            <span class="input-group-addon input-lg" id="basic-addon1"><img src="{{ asset('img/front/form_icon_tax_id.png') }}" alt="" /></span>
                                            <input id="datepicker1" type="text" class="form-control input-lg" name="to_be_paid_by" aria-describedby="basic-addon1" placeholder=""/>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        jQuery(function () {
                                            jQuery('#datepicker1').datepicker({
                                                dateFormat: 'yy/mm/dd'
                                            });
                                        });
                                    </script>
                                    
                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <label>Description</label>
                                        <div class="input-group">
                                            <span id="basic-addon1" class="input-group-addon input-lg">
                                                <img alt="" src="{{ asset('img/front/form_icon_desc.png') }}">
                                            </span>
                                            <textarea class="form-control input-lg" aria-describedby="basic-addon1" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 registrationFormFieldCont">
                                        <input id="buyer_id" type="hidden" name="buyer_id" value=""/>
                                        <input type="submit" class="btn btnWithRightArrow" value="Send"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
<script>
    function change_buyer(obj){
        var buyer_name = $(obj).children('option:selected').data('buyername');
        var buyer_id = $(obj).children('option:selected').data('buyerid');
        $('#buyer_name').val(buyer_name);
        $('#buyer_id').val(buyer_id);
    }
</script>

@endsection

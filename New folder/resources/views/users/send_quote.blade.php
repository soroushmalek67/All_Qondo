@extends('templates.dashboard_pages_template')
@section('page_title') Send Quote @endsection
@section('page-content')



                    @include("partials.form_errors")

                            <form role="form" method="POST" action="{{ url('send-quote') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="registrationFormCont">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <h1 class="formHeadingWithStyle">
                                                <span>Send Quote<span></span></span>
                                            </h1>
                                        </div>                             

                                        <div class="col-sm-12 registrationFormFieldCont">
                                            <label>Description</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/description.png') }}" alt="" /></span>
                                                <textarea class="form-control input-lg" name="description" aria-describedby="basic-addon1">{{old('description')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 registrationFormFieldCont">
                                            <label>price</label>
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg" id="basic-addon1">
                                                    <img src="{{ asset('img/front/price.png') }}" alt="" /></span>
                                                <input type="number" min="0" step="any" class="form-control input-lg" name="price" 
                                                       value="{{old('price')}}" aria-describedby="basic-addon1" />
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Upload Files</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-btn input-group-lg">
                                                    <span class="btn btn-primary btn-file">
                                                        <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                                                        <input type="file" name="quoteFile">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control input-lg" readonly>
                                            </div>
                                        </div>



                                        <div class="col-sm-12 registrationFormFieldCont">
                                            <label> </label>
                                            <input type="hidden" name="request_id" value="{{$requestid}}" />
                                            <input type="submit" class="btn blackBtn btnWithRightArrow" value="Send"/>
                                        </div>

                                    </div>
                                </div>

                            </form>

@endsection
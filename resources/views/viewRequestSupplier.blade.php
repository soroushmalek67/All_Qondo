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
                                            <span>Contractor List<span></span></span>
                                        </h1>
                                    
                                  
                                  
                                 
                                    
                                    <div class="col-sm-12">
                                        @if(count($viewReuest)==0)
                                                 <div class="alert alert-warning">
                                                  <strong>No Contractor found!</strong> 
                                                </div>
                                        @else
                                        <div class="box">
                                                <div class="box-body">
                                                  <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="10">No</th>
                                                            <th width="100">Business Name</th>
                                                            <th width="100">Business Profile</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <input type="hidden" name="id" value="{{$i=0}}"/>
                                                            @foreach ($viewReuest as $supplierlist )

                                                                <tr>
                                                                    <td>{{++$i}}</td>
                                                                    <td>{{$supplierlist->business_name}}<?php /*?>{{substr($supplierlist->last_name, 0, 1)}}<?php */?></td>
                                                                    <td><a href="{{url('supplier-profile')}}/{{$supplierlist->business_name}}/{{$supplierlist->id}}" target="_blank">View Profile</a></td>
                                                                </tr>
                                                            @endforeach

                                                    </tbody>

                                                  </table>
                                                    <div class="row">
                                                        <div class="col-md-12">

                                                        </div>
                                                    </div>

                                                </div><!-- /.box-body -->
                                            </div>
                                         @endif
                                    </div
                                   
                                ></div>
                            </div>
                                    
                        </form>
                       
@endsection
@extends('admin.app')

@section('htmlheader_title') Notification Content @endsection
@section('contentheader_title')
   Notification
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        
    </div><!-- /.box-header -->
    @include("partials.form_errors")
    <form action="{{ url('admin-panel/updateNotifications') }}" enctype="multipart/form-data" class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
            
            
            
            
            <h2>Notification Content</h2><br/>
            
            
             <div class="col-sm-6 registrationFormFieldCont">

                <label>Template Background Image</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-btn input-group-lg">
                        <span class="btn btn-primary btn-file">
                            <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                            <input type="file" name="template_file" value="{{old('template_file')}}">
                        </span>
                    </span>
                    <input type="text" class="form-control input-lg" readonly>
                </div>
            </div>
            
            <div class="form-group">
                
                <div class="col-sm-10 template_background ">
                <label>
                    @if (empty($template_image->template_image)) 
                    No Logo 
                    @else
                    <img src="{{url("img/notification_image/".getFolderStructureByDate($template_image->created_at)."/"
                                                                .$template_image->template_image)}}" 
                         alt="No image" />
                    @endif
                </label>
            </div>
                
            </div>
            
            <h4> Register Notification(for User)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.(@username,@siteurl, @useremail, @urlconfirmemail.)
                
            </p>
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor1" class="form-control" placeholder="" type="text" name="register">{{$register->content}}</textarea>
                </div>
            </div><br/>
            <h4> Account Approve Notification(for User)</h4>
            <p>
                You can use following variables/short codes to get user information dynamically.(@username, @siteurl, @useremail,  @passwrd)
                
            </p>
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor2" class="form-control" placeholder="" type="text" name="aprove">{{$aprove->content}}</textarea>
                </div>
            </div><br/>
            <h4> Add Supplier Notification(for Admin)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.(@buyername, @buyeremail)
                
            </p>
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor3" class="form-control" placeholder="" type="text" name="addsupplier">{{$add_supplier->content}}</textarea>
                </div>
            </div><br/>
            <h4> Claim Profile Notification(for User) </h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.(@firstName, @lastName, @loginurl, @email, @password)
                
            </p>
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor4" class="form-control" placeholder="" type="text" name="claim_profile">{{$claim_profile->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Claim Profile Admin Notification(for Admin)</h4>
            <p>
                You can use following variables/short codes to get user information dynamically.(@userEmail)
                
            </p>
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor5" class="form-control" placeholder="" type="text" name="claim_profile_admin">{{$claim_profile_admin->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Contact Us Notification(for Admin)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.(@firstname, @lastname, @email, @phnNunber, @companyNmae, @@descrp)
                
            </p>
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor6" class="form-control" placeholder="" type="text" name="contactus">{{$contactus->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Dedicated Membership Request Notification(for Admin)</h4>
            
             <p>
                You can use following variables/short codes to get user information dynamically.(@userEmail)
                
            </p>
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor7" class="form-control" placeholder="" type="text" name="d_membership_request">{{$d_membership_request->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Duplicate Company Notification(for Admin)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.(@business,@UserEmail )
                
            </p>
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor8" class="form-control" placeholder="" type="text" name="duplicate_company">{{$duplicate_company->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Send Message Notification(for User)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.(@firstname , @lastname , @sernderFirstName , @sernderLastName , @messageurl)
                
            </p>
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor9" class="form-control" placeholder="" type="text" name="send_message">{{$send_message->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Reset Password Notification(for User)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @reset )
                
            </p>
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor10" class="form-control" placeholder="" type="text" name="rest_password">{{$rest_password->content}}</textarea>
                </div>
            </div><br/>
            
            
            <h4> Quote Accepted Buyer Notification(for Supplier)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @buyerFirstname , @buyerLastname , @supplierFirstName , @supplierLastName )
                
            </p>
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor11" class="form-control" placeholder="" type="text" name="qoute_accepted_buyer">{{$qoute_accepted_buyer->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Quote Accepted Supplier Notification(for Buyer)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @supplierFirstName , @supplierLastName , @buyerFirstname , @buyerLastname )
                
            </p>
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor12" class="form-control" placeholder="" type="text" name="qoute_accepted_supplier">{{$qoute_accepted_supplier->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Quote Invitation Notification(for user)</h4>
            
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @first_name , @last_name , @requesturl )
                
            </p>
            
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor13" class="form-control" placeholder="" type="text" name="qoute_invitation">{{$qoute_invitation->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Quote Receive Notification(for User)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @buyerName , @supplierName , @requesturl )
                
            </p>
            
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor14" class="form-control" placeholder="" type="text" name="qoute_receive">{{$qoute_receive->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> User Create Notification(for Admin)</h4>
            
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @firstname , @lastname , @email , @buinessname )
                
            </p>
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor15" class="form-control" placeholder="" type="text" name="user_create">{{$user_create->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Request Approve Notification(for User)</h4>
            
            
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @firstName , @lastName , @requesturl)
                
            </p>
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor16" class="form-control" placeholder="" type="text" name="request_approve">{{$request_approve->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Request Rejected Notification(for User)</h4>
            
            
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @firstname , @lasstname , @requesturl)
                
            </p>
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor17" class="form-control" placeholder="" type="text" name="request_rejected">{{$request_rejected->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Review / Comments Notification(for Admin)</h4>
            
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @biznusName , view review )
                
            </p>
            
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor18" class="form-control" placeholder="" type="text" name="review">{{$review->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Service Request Created Notification(for User) </h4>
            
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @name)
                
            </p>
            
            
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor19" class="form-control" placeholder="" type="text" name="service_request_created">{{$service_request_created->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Service Request Created Email to admin Notification(for Admin)</h4>
            
            
            
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor20" class="form-control" placeholder="" type="text" name="service_request_created_emil">{{$service_request_created_emil->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Two Quotes Left Notification(for Supplier)</h4>
            
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @firstname , @lastname ,  @membershipUrl )
                
            </p>
            
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor21" class="form-control" placeholder="" type="text" name="quotes_left">{{$quotes_left->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Registered Email Notification(for User)</h4>
            
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @firstname , @lastname ,  @loginurl , @email , @password )
                
            </p>
            
            
            <div class="form-group">
                
                <div class="col-sm-9">
                    <textarea id="textEditor22" class="form-control" placeholder="" type="text" name="registered_email">{{$registered_email->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Request Edit Notification(for Buyer)</h4>
            
            <p>
                You can use following variables/short codes to get user information dynamically.( @buyername , @requestdetail )
            </p>
            
            <div class="form-group">
                <div class="col-sm-9">
                    <textarea id="textEditor23" class="form-control" placeholder="" type="text" name="request_edit">{{$request_edit->content}}</textarea>
                </div>
            </div><br/>
            <input type="hidden" name="created_at" value="{{$template_image->created_at}}">
            
            <h4> Supplier Invoice </h4>
            <div class="form-group">
                <div class="col-sm-9">
                    <textarea id="textEditor24" class="form-control" placeholder="" type="text" name="supplier_invoice">{{$supplier_invoice->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Refund Notification(for user) </h4>
            <div class="form-group">
                <div class="col-sm-9">
                    <textarea id="textEditor25" class="form-control" placeholder="" type="text" name="refund_user">{{$refund_user->content}}</textarea>
                </div>
            </div><br/>
            
            <h4> Refund Notification(for admin) </h4>
            <div class="form-group">
                <div class="col-sm-9">
                    <textarea id="textEditor26" class="form-control" placeholder="" type="text" name="refund_user_admin">{{$refund_user_admin->content}}</textarea>
                </div>
            </div><br/>
            
            
            <h4> Respond to request Notification(for admin) </h4>
            <div class="form-group">
                <div class="col-sm-9">
                    <textarea id="textEditor27" class="form-control" placeholder="" type="text" name="respond_to_request">{{$respond_to_request->content}}</textarea>
                </div>
            </div><br/>
            
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input class="btn btn-primary pull-right" type="submit" value="Update"/>
        </div><!-- /.box-footer -->
    </form>
</div><!-- /.box -->
@endsection

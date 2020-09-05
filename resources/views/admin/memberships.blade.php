@extends('admin.app')

@section('htmlheader_title') Settings @endsection
@section('contentheader_title')
    Settings
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Memberships</h3>
    </div><!-- /.box-header -->
    @include("partials.form_errors")
    <form action="{{ url('admin-panel/settings/memberships') }}" class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
            <h2>Monthly Subscriptions and Quotes</h2><br/>
            <h3>Pay Per Quote</h3><br/>
            <h4> Quotes Package 1</h4>
            <div class="form-group">
                <label class="col-sm-2 control-label">Quotes</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Number of Quotes" type="number" name="packageOneQuotes" 
                           value="{{$allSettings['packageOneQuotes']}}">
                </div>
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Price" type="number" name="packageOnePrice" value="{{$allSettings['packageOnePrice']}}">
                </div>
            </div>
            <br/><h4> Quotes Package 2</h4>
            <div class="form-group">
                <label class="col-sm-2 control-label">Quotes</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Number of Quotes" type="number" name="packageTwoQuotes" 
                           value="{{$allSettings['packageTwoQuotes']}}">
                </div>
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Price" type="number" name="packageTwoPrice" value="{{$allSettings['packageTwoPrice']}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Discount Text</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Discount Text" type="text" name="packageTwoDiscountText" 
                           value="{{$allSettings['packageTwoDiscountText']}}">
                </div>
            </div>
            <h4> Pro Package</h4>
            <div class="form-group">
                <label class="col-sm-2 control-label">Offerings</label>
                <div class="col-sm-9">
                    <textarea id="textEditor1" class="form-control" placeholder="Pro Offerings" type="text" name="proPackageOfferings">{{$allSettings['proPackageOfferings']}}</textarea>
                </div>
            </div><br/>
            <h3>Monthly Subscription Packages</h3><br/>
            <h4> Enterprise Package</h4>
            <div class="form-group">
                <label class="col-sm-2 control-label">Offerings</label>
                <div class="col-sm-9">
                    <textarea id="textEditor2" class="form-control" placeholder="Enterprise Offerings" type="text" name="enterprisePackageOfferings">{{$allSettings['enterprisePackageOfferings']}}</textarea>
                </div>
            </div><br/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Subscriptions Price</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Monthly Subscriptions Price" type="number" name="enterprisePackagePrice" 
                           value="{{$allSettings['enterprisePackagePrice']}}">
                </div>
            </div>
            <h4> Dedicated Package</h4>
            <div class="form-group">
                <label class="col-sm-2 control-label">Offerings</label>
                <div class="col-sm-9">
                    <textarea id="textEditor3" class="form-control" placeholder="Dedicated Offerings" type="text" name="dedicatedPackageOfferings">{{$allSettings['dedicatedPackageOfferings']}}</textarea>
                </div>
            </div><br/>
            
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input class="btn btn-primary pull-right" type="submit" value="Update"/>
        </div><!-- /.box-footer -->
    </form>
</div><!-- /.box -->
@endsection

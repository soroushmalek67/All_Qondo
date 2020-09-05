@extends('admin.app')

@section('htmlheader_title') Settings @endsection
@section('contentheader_title')
    Settings
@endsection

@section('main-content')
<!-- general form elements disabled -->
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Settings</h3>
    </div><!-- /.box-header -->
    @include("partials.form_errors")
    <form action="{{ url('admin-panel/settings/general') }}" class="form-horizontal" method="post">
        <!--changes by salman   'admin-panel/settings/general'-->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
            <h2>General</h2><br/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Notifications Email</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Notifications Email" type="email" name="notification_email" 
                           value="{{$allSettings['notification_email']}}">
                </div>
            </div>
            <hr/>
            <h2>Admin User</h2><br/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Admin First Name</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="First Name" type="text" name="first_name" value="{{$adminDetails->first_name}}">
                </div>
                <label class="col-sm-2 control-label">Admin Last Name</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Last Name" type="text" name="last_name" value="{{$adminDetails->last_name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Admin Email</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Email" type="email" name="email" value="{{$adminDetails->email}}">
                </div>
                <label class="col-sm-2 control-label">Admin Password</label>
                <div class="col-sm-3">
                    <input class="form-control" placeholder="Password" type="password" name="password" value="">
                </div>
            </div>
            <hr/>
            
           <h2>Home Page Setting</h2><br/>
           
           <div class="form-group">
                <label class="col-sm-2 control-label">Show Data Related to Categories</label>
                <div class="col-sm-3">
                    <input  type="checkbox" name="cat_rel_data" value="yes"  style="margin-top:5px"  <?php echo ($allSettings['cat_rel_data']==1 ? 'checked' : '');?>>
                </div>
                
            </div>
           <div class="form-group">
                <label class="col-sm-2 control-label">Show Try it Free on banner</label>
                <div class="col-sm-3">
                    <input  type="checkbox" name="try_it_free_icon" value="yes"  style="margin-top:5px"  <?php echo ($allSettings['try_it_free_icon']==1 ? 'checked' : '');?>>
                </div>
                
            </div>
            <hr/>
           
            
            
           <h2>Request Settings</h2><br/>
           
           <div class="form-group">
                <label class="col-sm-2 control-label">Auto Pilot</label>
                <div class="col-sm-3">
                    <input  type="checkbox" name="auto_pilot" value="yes"  style="margin-top:5px"  <?php echo ($allSettings['auto_pilot']==1 ? 'checked' : '');?>>
                    
                </div>
                
            </div>
            <hr/>
           
            
           <h2>Membership Price</h2><br/>
           
           <div class="form-group">
                <label class="col-sm-2 control-label">Number of Month</label>
                <div class="col-sm-3">
                    <div class="input-group">
                            
                            <!--<input type="text" class="form-control input-lg" name="" aria-describedby="basic-addon1">-->
                            <select name="mnth" class="customDropdown form-control input-lg" 
                                    aria-describedby="basic-addon1">
                                <!--<option value="">Select Industries</option>-->
                                <option <?php if ($allSettings['mnth'] == 1) echo ' selected="selected"'; ?> >1</option>
                                <option <?php if ($allSettings['mnth'] == 2) echo ' selected="selected"'; ?>>2</option>
                                <option <?php if ($allSettings['mnth'] == 3) echo ' selected="selected"'; ?>>3</option>
                                <option <?php if ($allSettings['mnth'] == 4) echo ' selected="selected"'; ?>>4</option>
                                <option <?php if ($allSettings['mnth'] == 5) echo ' selected="selected"'; ?>>5</option>
                                <option <?php if ($allSettings['mnth'] == 6) echo ' selected="selected"'; ?>>6</option>
                                <option <?php if ($allSettings['mnth'] == 7) echo ' selected="selected"'; ?>>7</option>
                                <option <?php if ($allSettings['mnth'] == 8) echo ' selected="selected"'; ?>>8</option>
                                <option <?php if ($allSettings['mnth'] == 9) echo ' selected="selected"'; ?>>9</option>
                                <option <?php if ($allSettings['mnth'] == 10) echo ' selected="selected"'; ?>>10</option>
                                <option <?php if ($allSettings['mnth'] == 11) echo ' selected="selected"'; ?>>11</option>
                                <option <?php if ($allSettings['mnth'] == 12) echo ' selected="selected"'; ?>>12</option>
                                
                                
                            </select>
                        </div>
                </div>
                
            </div>
            <hr/>
           
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input class="btn btn-primary pull-right" type="submit" value="Update"/>
        </div><!-- /.box-footer -->
    </form>
</div><!-- /.box -->
@endsection

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        <!--<li><a href="{{url('admin-panel')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>-->
        @yield('contentheader_breadcrumbs')
    </ol>
</section>
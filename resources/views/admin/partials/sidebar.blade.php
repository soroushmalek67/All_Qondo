<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{Session::get('admin_user')->first_name}}</p>
                <!-- Status -->
                <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>

        <!-- search form (Optional) -->
        <!--        <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                      <span class="input-group-btn">
                        <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ activeMenu('admin-panel') }}"><a href="{{ url('admin-panel') }}"><i class='fa fa-dashboard'></i> <span>Dashboard</span></a></li>

            <li class="treeview {{ activeMenu('users') }}">
                <a href="#"><i class='fa fa-users'></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('admin-panel/users') }}">
                        <a href="{{ url('admin-panel/users') }}"><i class="fa fa-circle-o"></i> All</a></li>
                    <li class="{{ activeMenu('admin-panel/users/buyers') }}">
                        <a href="{{ url('admin-panel/users/buyers') }}"><i class="fa fa-circle-o"></i> Buyers</a></li>
                    <li class="{{ activeMenu('admin-panel/users/suppliers') }}">
                        <a href="{{ url('admin-panel/users/suppliers') }}"><i class="fa fa-circle-o"></i> Suppliers</a></li>
                    <li class="{{ activeMenu('admin-panel/users/add') }}">
                        <a href="{{ url('admin-panel/users/add') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                    <li class="{{activeMenu('admin-panel/mySupplier')}}"><a href="{{url('admin-panel/supplier-buyer-list')}}" > <i class="fa fa-circle-o"></i> Import unregistered users</a></li>

                    <li class="{{ activeMenu('admin-panel/users/activity') }}">
                        <a href="{{ url('admin-panel/users/activity') }}"><i class="fa fa-circle-o"></i> Users Activities</a></li>
                    <li class="{{ activeMenu('admin-panel/users/visits') }}">
                        <a href="{{ url('admin-panel/users/visits') }}"><i class="fa fa-circle-o"></i> Users Visits</a></li>
                </ul>
            </li>

            <li class="treeview {{ activeMenu('notification') }}">
                <a href="#"><i class='fa fa-users'></i> <span>Notifications</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('admin-panel/notificationcontent') }}">
                        <a href="{{ url('admin-panel/notificationContent') }}"><i class="fa fa-circle-o"></i> Notification Content</a></li>
                </ul>
            </li>


            <li class="treeview {{ activeMenu('Refund') }}">
                <a href="#"><i class='fa fa-users'></i> <span>Refund</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('admin-panel/refund') }}">
                        <a href="{{ url('admin-panel/refund') }}"><i class="fa fa-circle-o"></i> Refund </a></li>
                </ul>
            </li>



            <li class="treeview {{ activeMenu('categories') }}">
                <a href="#"><i class='fa fa-server'></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('admin-panel/categories') }}">
                        <a href="{{ url('admin-panel/categories') }}"><i class="fa fa-circle-o"></i> All Categories</a></li>
                    <li class="{{ activeMenu('admin-panel/categories/add') }}">
                        <a href="{{ url('admin-panel/categories/add') }}"><i class="fa fa-circle-o"></i> Add Category</a></li>
                </ul>
            </li>

            <li class="treeview {{ activeMenu('cities') }}">
                <a href="#"><i class='fa fa-building-o'></i> <span>Cities</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('admin-panel/cities') }}">
                        <a href="{{ url('admin-panel/cities') }}"><i class="fa fa-circle-o"></i> All Cities</a></li>
                    <li class="{{ activeMenu('admin-panel/cities/add') }}">
                        <a href="{{ url('admin-panel/cities/add') }}"><i class="fa fa-circle-o"></i> Add City</a></li>
                </ul>
            </li>

            <li class="treeview {{ activeMenu('states') }}">
                <a href="#"><i class='fa fa-building-o'></i> <span>States</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('admin-panel/states') }}">
                        <a href="{{ url('admin-panel/states') }}"><i class="fa fa-circle-o"></i> All States</a></li>
                    <li class="{{ activeMenu('admin-panel/states/add') }}">
                        <a href="{{ url('admin-panel/states/add') }}"><i class="fa fa-circle-o"></i> Add State</a></li>
                </ul>
            </li>
            <li class="treeview {{ activeMenu('buildings') }}">
                <a href="#"><i class='fa fa-building-o'></i> <span> Buildings </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('admin-panel/buildings') }}">
                        <a href="{{ url('admin-panel/buildings') }}"><i class="fa fa-circle-o"></i> All Buildings</a></li>
                    <li class="{{ activeMenu('admin-panel/buildings') }}">
                        <a href="{{ url('admin-panel/buildings/unapproved') }}"><i class="fa fa-circle-o"></i> Unapproved Buildings</a></li>
                    <li class="{{ activeMenu('admin-panel/buildings/add') }}">
                        <a href="{{ url('admin-panel/buildings/add') }}"><i class="fa fa-circle-o"></i> Add Building</a></li>
                </ul>
            </li>

            <li class="{{ activeMenu('Certificates & awards') }}">
                <a href="{{ url('admin-panel/awards') }}"><i class='fa fa-newspaper-o'></i> <span>Certificates & Awards</span></a></li>

            <li class="{{ activeMenu('requested-services') }}">
                <a href="{{ url('admin-panel/requested-services') }}"><i class='fa fa-cubes'></i> <span>Requested Services</span></a></li>

            <li class="{{ activeMenu('Comments-And-Review') }}">
                <a href="{{ url('admin-panel/comments') }}"><i class='fa fa-cubes'></i> <span>Comments And Reviews</span></a></li>

            <li class="treeview {{ activeMenu('seo') }}">
                <a href="#"><i class='fa fa-server'></i> <span>SEO</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('seo/metas') }}">
                        <a href="#"><i class="fa fa-circle-o"></i> Metas <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu menu-open">
                            <li class="{{ activeMenu('admin-panel/seo/metas') }}">
                                <a href="{{url('admin-panel/seo/metas')}}"><i class="fa fa-circle-o"></i> All Metas</a></li>
                            <li class="{{ activeMenu('admin-panel/seo/metas/add') }}">
                                <a href="{{url('admin-panel/seo/metas/add')}}"><i class="fa fa-circle-o"></i> Add Meta</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="{{ activeMenu('newsletter-subscribers') }}">
                <a href="{{ url('admin-panel/newsletter-subscribers') }}"><i class='fa fa-newspaper-o'></i> <span>Newsletter Subscribers</span></a></li>
            <li class="treeview {{ activeMenu('settings') }}">
                <a href="{{url('admin-panel/settings')}}"><i class='fa fa-server'></i> <span>Settings</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu('settings/general') }}">
                        <a href="{{url('admin-panel/settings/general')}}"><i class="fa fa-circle-o"></i> General </a>
                    </li>
                    <li class="{{ activeMenu('settings/memberships') }}">
                        <a href="{{url('admin-panel/settings/memberships')}}"><i class="fa fa-circle-o"></i> Memberships </a>
                    </li>
                </ul>
            </li>
            <!--<li><a href="#"><i class='fa fa-link'></i> <span>Another Link</span></a></li>-->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

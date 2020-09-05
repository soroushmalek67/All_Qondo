
                            <div class="dashboardSidebarMenuCont">
                                <ul class="dashboardSidebarMenu">
                                    @if ($userType == 1)
                                        <!-- Buyer Sidebar -->
                                        <li class="{{activeMenu('dashboard')}}"><a href="{{url('dashboard')}}">My Requests</a></li>
                                        <li class="{{activeMenu('request-service')}}"><a href="{{url('request-service')}}" class="dashboardLinksAddNewProject">Add New Request</a></li>
                                        <li class="{{activeMenu('profile')}}"><a href="{{url('profile')}}" class="dashboardLinkMyProfile">My Profile</a></li>
                                        
                                        <li class="{{activeMenu('mySupplier')}}"><a href="{{url('supplier-buyer-list')}}" class="dashboardLinkMyProfile">My Contractor list</a></li>
                                        
                                        <li class="{{activeMenu('Import-Supplier-List')}} profile-submenue"><a href="{{url('importSupplier')}}" class="subm">Import Contractor List</a></li>
                                             <li class="{{activeMenu('Add-Supplier')}} profile-submenue"><a href="{{url('mysupplier-add')}}" class="subm">Add Contractor</a></li>
                                             <li class="{{activeMenu('Add-Supplier-from-database')}} profile-submenue"><a href="{{url('allsupplier')}}" class="subm">Add Contractor from database</a></li>
                                        
                                        <li class="{{activeMenu('messages')}}">
                                            <a href="{{url('messages')}}" class="dashboardLinkMyProfile">Messages <b>({{GetMessageNotifications()}})</b></a>
                                        </li>
                                        
                                        <li class="{{activeMenu('admin-panel/users')}}">
                                            <a href="{{(empty(Auth::user()->dedicated_url)) ?
                                                        url('no-dedicated') :
                                                        Auth::user()->dedicated_url}}" 
                                               class="dashboardLinkMyanalytics">BI and  analytics</a>
                                        </li>
                                        
                                        
                                    @else
                                        <!-- Supplier Sidebar -->
                                        <li class="{{activeMenu('dashboard')}}">
                                            <a href="{{url('dashboard')}}" class="dashboardLinksquote">My Quotes <b>({{GetQuotesNotifications()}})</b></a>
                                        </li>
                                        <li class="{{activeMenu('profile')}} profile"><a href="{{url('profile')}}" class="dashboardLinkMyProfile">My Profile</a></li>
                                       
                                        <li class="{{activeMenu('products')}} profile-submenue"><a href="{{url('products')}}" class="subm">Services/Products</a></li>
                                        
                                            <li class="{{activeMenu('coupons')}} profile-submenue"><a href="{{url('coupons')}}" class="subm">Promotion/coupons</a></li>
                                               
                                            <li class="{{activeMenu('messages')}}">
                                            <a href="{{url('messages')}}" class="dashboardLinkMyProfile">Messages <b>({{GetMessageNotifications()}})</b></a>
                                        </li>
                                        <li class="{{activeMenu('invoices')}}">
                                            <a href="{{url('invoices')}}" class="dashboardLinksquote">My Invoices</a>
                                        </li>
                                        <li class="{{activeMenu('membership')}}"><a href="{{url('membership')}}" class="dashboardLinkmembership">Membership</a></li>
                                        <li class="{{activeMenu('transactions')}}"><a href="{{url('transactions')}}" class="dashboardLinksAddcredit">Transactions</a></li>
                                        <li class="{{activeMenu('refund')}}"><a href="{{url('refund')}}" class="dashboardLinksAddcredit">Refund</a></li>
                                        <li class="{{activeMenu('admin-panel/users')}}">
                                            <a href="{{(empty(Auth::user()->dedicated_url)) ?
                                                        url('no-dedicated') :
                                                        Auth::user()->dedicated_url}}" 
                                               class="dashboardLinkMyanalytics">BI and  analytics</a>
                                        </li>
                                    @endif
                                    <!--<li class=""><a href="">Settings</a></li>-->
                                    <li><a href="http://support.firmogram.ca/knowledgebase.php" target="_blank" class="dashboardLinkhelp">Help</a></li>
                                    <li><a href="{{url('auth/logout')}}" class="dashboardLinkSignOut">Sign out</a></li>
                                </ul>
                            </div>
                        <script type="text/javascript">
                            jQuery(window).ready(function() {
//                                $('.profile-submenue').hide();
//                                $('.profile').hover(function(){
//                                     $('.profile-submenue').show();
//                                });
                                 
                            });
                        </script>
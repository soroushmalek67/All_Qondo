                                
                                <span class="logoAndMenuSeprator"> &nbsp; &nbsp; |</span>
                                <div class="topMenuCont">
                                    <ul>
                                        <!--<li>
                                            <a>SOLUTIONS</a>
                                            <ul>
                                                <li><a href="{{url('categories')}}">Marketplace</a></li>
                                                <li><a href="{{url('analytics')}}" target="_blank">B2B Analytics</a></li>
                                                <li><a href="{{url('suppliers')}}">Marketing & Sales</a></li>
                                            </ul>
                                        </li>-->
<!--                                        <li>
                                            <a href="{{url('categories/')}}">SERVICES</a>
                                            <ul>
                                                {{--*/ $categories = header_main_categories() /*--}}
                                                @foreach ($categories as $category) 
                                                <li><a href="{{url('categories/'.$category->slug)}}">{{$category->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>-->
                                        
                                        <!--<li>
                                            <a href="{{url('about/')}}">ABOUT</a>
                                            <ul>
                                                <li><a href="{{url('faq')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAQ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                            </ul>
                                        </li>-->
                                    </ul>
                                </div>
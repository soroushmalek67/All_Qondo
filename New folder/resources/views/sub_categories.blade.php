<!DOCTYPE html>
<html>
    <head>
        @include('partials.head')
    </head>
    <body>
        @include('partials.outdated_browser')
        <header class="fixed_header">
            <section class="top-banner innerPagesHeader @if(!Auth::guest()) dashboardHeader @endif">
                <div class="container">
                    <div class="row menuAndLogoCont">
                        @include('partials.header_menu')
                    </div>
                </div>
            </section>
        </header>
        <section class="top-banner categoryTopBanner subCategoryTopBanner @if(!Auth::guest()) dashboardHeader @endif" 
                 style="@if ($categoryDetails && !empty($categoryDetails->image)) background: url('{{url("img/category/".$categoryDetails->image)}}')top center no-repeat; @endif">
            <div class="container">
                <div class="row menuAndLogoCont">
                    <div class="col-md-12">
                        <div class="banner-text">
                            <h2 class="text-uppercase">@if ($categoryDetails) {{$categoryDetails->name}} @endif</h2>
                            <span>
                                <form action="{{url('search-form-submission')}}" id="homeSearchForm" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="selectedOptionType" id="selectedOptionType" value="">
                                    <input type="hidden" name="selectedCatID" id="selectedCatID" value="">
                                    <input type="hidden" name="selectedCatName" id="selectedCatName" value="">
                                    <!-- <input type="text" class="postal" id="code" placeholder="Your Postal Code"/> -->
                                    <input type="text" class="firms" id="autocomplete-ajax" name="searchKeyword" 
                                           placeholder="Search and request a service"/>
                                    <input type="submit" class="submit" value="GET STARTED"/>
                                    <a href="{{url('how-it-works')}}" class="linkToHowItWorks btn tranparentWhiteBtn">Learn More</a>
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="firmogram">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-uppercase">@if ($categoryDetails) {{$categoryDetails->name}} @endif SERVICES</h1>
                        <p class="text-center">@if ($categoryDetails) {{$categoryDetails->description}} @endif
<!--                            There are thousands of businesses offering ((nsmr))
                            services in nearly all areas of industry and commerce. Some businesses specialize in particular sectors while others take a 
                            more general approach. The sectors below are those in which the highest numbers of active businesses are providing consulting 
                            services.-->
                        </p>
                        <div class="InnerPageCategories">
                            <div class="row">
                                @if(count($featuredCategories) > 0)
                                    @foreach($featuredCategories as $featuredCategory)
                                        <div class="col-md-5ths col-sm-6">
                                            <div class="homeCategoryCont HomeCategoriesAnimation">
                                                <div class="homeCategoryimg">
                                                    <div class="homeCategoryDetails">
                                                        <h2>5725</h2>
                                                        <p>Business</p>
                                                        <hr/>
                                                        <h2>58,725</h2>
                                                        <p>Request</p>
                                                    </div>
                                                    <?php
                                                    if (!empty($featuredCategory->category_icon)) {
                                                        $catImgURL = asset('img/category/category_icons/'.$featuredCategory->category_icon);
                                                    } else {
                                                        $catImgURL = asset('img/front/placehoder_sub_categories.png');
                                                    }
                                                    ?>
                                                    <img src="{{$catImgURL}}" alt="{{$featuredCategory->name}}">
                                                </div>
                                                <h3><a href="{{url('/request-service/'.$featuredCategory->slug)}}">{{$featuredCategory->name}}</a></h3>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="col-md-12 text-center">No Featured Categories Found<br/></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="categoriesPageSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-uppercase">ADDITIONAL @if ($categoryDetails) {{$categoryDetails->name}} @endif SERVICES</h1>
                        <p class="text-center">These additional @if ($categoryDetails) {{$categoryDetails->name}} @endif  service categories are not
                            as heavily represented by contractors as the categories shown above,
                            but they do include numerous firms that want to use QONDO to help you finish your project.</p>
                        <div class="categoryPageAllCatsCont">
                            @if (count($childCategories) > 0)
                                <ul class="row">
                                    @foreach ($childCategories as $childCategory)
                                        <li class="col-sm-4">
                                            <div><a href="{{url('/request-service/'.$childCategory->slug)}}">{{$childCategory->name}}</a></div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center">We're currently searching for the perfect contractors. Check back later!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="categoriesWithImgSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-center"><a href="{{url('suppliers-list')}}" class="text-center btn">Contractor Directory</a></div>
                        <h1 class="text-uppercase">@if ($categoryDetails) {{$categoryDetails->name}} @endif Firms</h1>
                        <p class="text-center">The leading providers of @if ($categoryDetails) {{$categoryDetails->name}} @endif services are shown below. 
                            Use QONDO to connect with these businesses and receive free quotes, instantly!</p>
                        <div class="categoriesWithImgCont categorySuppliersCont">
                            <div class="row">
                                @if (count($featuredSuppliers) > 0)
                                    @foreach ($featuredSuppliers as $featuredSupplier)
                                        <div class="col-sm-4">
                                            {{--*/$companySlug = (empty($featuredSupplier->company_slug))?"no-slug":$featuredSupplier->company_slug/*--}}
                                            <a class="categoryWithImg" href="{{url("supplier-profile/$companySlug/$featuredSupplier->id")}}">
                                                <div class="categoryWithImgCaption">
                                                    {{$featuredSupplier->business_name}}
                                                    <p><small>{{$featuredSupplier->city}}, {{$featuredSupplier->state}}</small></p>
                                                    <!--<p><small>Accepted Quotes ({{(int) $featuredSupplier->quotesAccepted}})</small></p>-->
                                                </div>
                                                <?php
                                                if (!empty($featuredSupplier->company_logo)) {
                                                    $catImgURL = url("img/compay_logos/".getFolderStructureByDate($featuredSupplier->created_at)."/"
                                                                .$featuredSupplier->company_logo);
                                                } else {
                                                    $catImgURL = asset('img/front/placeholder_main_cat.jpg');
                                                }
                                                ?>
                                                <img src="{{$catImgURL}}" alt="{{$featuredSupplier->business_name}}">
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center">No Contractor Found</div>
                                @endif
<!--                                <div class="col-sm-4">
                                    <a class="categoryWithImg" href="">
                                        <div class="categoryWithImgCaption">SkyRidgeConsulting</div>
                                        <img src="{{ asset('img/front/suppliers/1.jpg') }}" alt="" />
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a class="categoryWithImg" href="">
                                        <div class="categoryWithImgCaption">Helpocity</div>
                                        <img src="{{ asset('img/front/suppliers/2.jpg') }}" alt="" />
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a class="categoryWithImg" href="">
                                        <div class="categoryWithImgCaption">Feasiblean</div>
                                        <img src="{{ asset('img/front/suppliers/3.jpg') }}" alt="" />
                                    </a>
                                </div>-->
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        @include('partials.footer_form')
        @include('partials.footer')
    </body>
</html>
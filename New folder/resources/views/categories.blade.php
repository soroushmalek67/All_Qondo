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
        <section class="top-banner categoryTopBanner @if(!Auth::guest()) dashboardHeader @endif">
            <div class="container">
                <div class="row menuAndLogoCont">
                    <div class="col-md-12">
                        <div class="banner-text">
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
        <section class="categoriesWithImgSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1>CATEGORIES</h1>
                        <p>Finding contractors by yourself is a tedious task that might not always yield the best results. Qondo saves you the hassle by finding quality, 
certified contractors that are ready to help you with all your needs. The Qondo Marketplace offers carefully vetted contractors with services ranging from plumbing and 
electrical to Condo LED Retrofitting. Whether you want contractors immediately or only quotes, Qondo has you covered.</p>
                        <div class="categoriesWithImgCont">
                            <div class="row">
                                @if(count($categories) > 0)
                                    @foreach($categories as $category)
                                        <?php
                                        $tooltip = "<h4>$category->name</h4><p>"
                                                        .str_limit(strip_tags($category->description), $limit =150, $end = '...')."</p>";
                                        ?>
                                        <div class="col-sm-4">
                                            <a class="categoryWithImg" href="{{ url('/categories/'.$category->slug) }}" data-toggle="tooltip"
                                               title="{{$tooltip}}" data-html="true">
                                                <div class="categoryWithImgCaption">{{$category->name}}</div>
                                                <img src="{{asset('img')}}/{{(empty($category->image))?"front/placeholder_main_cat_default.jpg":"category/".$category->image}}" 
                                                     alt="{{$category->name}}" />
                                            </a>
                                        </div>
                                    @endforeach
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
                        <h1>Explore local and national business services</h1>
<!--                        <p class="text-center">Businesses in nearly all industrial sectors need better and faster ways to procure products and 
                            professional services. QODNO can be used to connect in numerous industries because the plaMorm is flexible and the 
                            database of registered service providers is large and expanding. The industries listed below are particularly well suited for 
                            QODNO's matchmaking and transactional capabilities because they involve high numbers of active businesses services.</p>-->
                        <div class="categoryPageAllCatsCont">
                            @if (count($cities) > 0)
                                <ul class="row">
                                    @foreach ($cities as $city)
                                        <li class="col-sm-4">
                                            <div><a href="{{url("/city/$city->slug")}}">{{$city->name}}, {{$city->iso}}</a></div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center">No Categories Found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('partials.footer_form')
        @include('partials.footer')
    </body>
</html>
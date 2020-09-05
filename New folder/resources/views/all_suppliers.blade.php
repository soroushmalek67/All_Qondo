@extends('templates.sub_pages_template')
@section('page-content')

        <section class="registerPageTopStepsCont">
            <div class="container">
                <div class="InnerPageCategories">
<!--                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="homeCategoryCont">
                                <div class="homeCategoryimg" data-aftervalue="01"><img src="{{asset('img/front/icon_register.png')}}" alt=""></div>
                                <h3><a href="">Register</a></h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="homeCategoryCont">
                                <div class="homeCategoryimg" data-aftervalue="02"><img src="{{asset('img/front/icon_research.png')}}" alt=""></div>
                                <h3><a href="">Research</a></h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="homeCategoryCont">
                                <div class="homeCategoryimg" data-aftervalue="03"><img src="{{asset('img/front/icon_quotes.png')}}" alt=""></div>
                                <h3><a href="">Handle Quotes</a></h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="homeCategoryCont">
                                <div class="homeCategoryimg" data-aftervalue="04"><img src="{{asset('img/front/icon_make_deal.png')}}" alt=""></div>
                                <h3><a href="">Make A Deal</a></h3>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </section>
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            <li>Contractors</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        @include('partials.supplier_search')
        <section class="categoriesWithImgSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="categoriesWithImgCont categorySuppliersCont" id="supplierListCont">
                            <div class="row">
                                @if (count($allSupplers) > 0)
                                    @foreach ($allSupplers as $allSuppler)
                                        <div class="col-sm-4 supplier-list-sec">
                                            {{--*/$companySlug = (empty($allSuppler["company_slug"]))?"no-slug":$allSuppler["company_slug"]/*--}}
                                            <a class="categoryWithImg" href="{{url("supplier-profile/".$companySlug."/".$allSuppler['id'])}}">
                                                <div class="categoryWithImgCaption">
                                                    {{$allSuppler['business_name']}}
                                                    <p><small>{{$allSuppler['city']}}, {{$allSuppler['state']}}</small></p>
                                                    <!--<p><small>Accepted Quotes ({{(int) $allSuppler['quotesAccepted']}})</small></p>-->
                                                </div>
                                                <?php
                                                if (!empty($allSuppler['company_logo'])) {
                                                    $catImgURL = url("img/compay_logos".$allSuppler['created_at_formated'].$allSuppler['company_logo']);
                                                } else {
                                                   // $catImgURL = asset('img/front/placeholder_main_cat.jpg');
                     $catImgURL = asset('img/front/supplier_default.jpg');
                                                }
                                                ?>
                                                <img src="{{$catImgURL}}" alt="{{$allSuppler['business_name']}}">
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center">No Supplier Found</div>
                                @endif
                            </div>
                        </div>
                        @if ($filterValues['offset'] % 30 === 0) 
                            <div class="text-center">
                                <input type="hidden" id="suppliersOffset" value="{{$filterValues['offset']}}"/>
                                <a class="btn" onclick="loadMoreSuppliers(this)">View More</a>
                                <!--<img src="{{asset('img/ajax-loader.gif')}}" alt="" />-->
                            </div>
                            <script type="text/javascript">
                                $('document').ready(function () {
                                    $("#suppliersOffset").val("{{$filterValues['offset']}}");
                                });
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </section>
@endsection
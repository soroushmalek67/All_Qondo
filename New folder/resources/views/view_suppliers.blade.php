@extends('templates.sub_pages_template')
@section('page_title') View Suppliers @endsection
@section('page-content')


        <section class="registerPageTopStepsCont dashboardPateTopSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-5"><h5>Buyer Dashboard</h5></div>
                </div>
            </div>
        </section>
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            <li>Buyer Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="dashboardPageSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 ">
                        @include('partials.user_sidebar')
                    </div>
                    <div class="col-md-8 dashboardMyPostedProjectsCont dashboardViewSuppliersCon">
                        <div class="dashboardViewSuppliers">
                            <h5>The Following Pro Received Your Request</h5>
                            <div class="ViewSuppliersTable">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Service Provider</th>
                                            <th>Business Address</th>
                                            <th>Phone</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Distribution Of Letters</td>
                                            <td>Distribution Of Letters</td>
                                            <td>044-256-2356</td>
                                            <td>20%</td>
                                            <td>Received</td>
                                        </tr>
                                        <tr>
                                            <td>Making It Look Like</td>
                                            <td>Making It Look Like</td>
                                            <td>044-256-2356</td>
                                            <td>40%</td>
                                            <td>Reviewed</td>
                                        </tr>
                                        <tr>
                                            <td>Distribution Of Letters</td>
                                            <td>Distribution Of Letters</td>
                                            <td>044-256-2356</td>
                                            <td>40%</td>
                                            <td>Quote issued</td>
                                        </tr>
                                        <tr>
                                            <td>Making It Look Like</td>
                                            <td>Making It Look Like</td>
                                            <td>044-256-2356</td>
                                            <td>40%</td>
                                            <td>Reviewed</td>
                                        </tr>
                                        <tr>
                                            <td>Distribution Of Letters</td>
                                            <td>Distribution Of Letters</td>
                                            <td>044-256-2356</td>
                                            <td>40%</td>
                                            <td>Quote issued</td>
                                        </tr>
                                        <tr>
                                            <td>Making It Look Like</td>
                                            <td>Making It Look Like</td>
                                            <td>044-256-2356</td>
                                            <td>40%</td>
                                            <td>Reviewed</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@include('partials.footer_form')
@endsection
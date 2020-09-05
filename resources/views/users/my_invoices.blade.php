@extends('templates.dashboard_pages_template')
@section('page_title') My Invoices @endsection
@section('page-content')

                    @include("partials.form_errors")
                    <div class="messagelist">          
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle">
                                            <span>My Invoices<span class="btn btn_add_invoice"><a href="invoices/add">Add New</a></span></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <table class="stylishTable">
                                    <thead>
                                        <tr>
                                            <td width="20">#</td>
                                            <td width="350">Request Title</td>
                                            <td width="250">Condo Owner Name</td>
                                            <td width="50">Amount</td>
                                            <td width="50">Tax Percentage</td>
                                            <td width="50">Total Amount</td>
                                            <td width="300">Sent on</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($invoices) > 0) 
                                            {{--*/ $loopCounter = 0; /*--}}
                                            @foreach ($invoices as $invoice)
                                                {{--*/ $loopCounter++; /*--}}
                                                <tr>
                                                    <td>{{$loopCounter}}</td>
                                                    <td>{{$invoice->title}}</td>
                                                    <td>{{$invoice->b_first_name}} {{$invoice->b_last_name}}</td>
                                                    <td>${{$invoice->amount}}</td>
                                                    <td>{{$invoice->tax_percent}}%</td>
                                                    <td>${{$invoice->total_amount}}</td>
                                                    <td>{{date("Y-m-d", strtotime($invoice->created_at))}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                                <tr>
                                                    <td colspan="7">No Invoices Found</td>
                                                </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
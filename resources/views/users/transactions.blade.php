@extends('templates.dashboard_pages_template')
@section('page_title') Transactions @endsection
@section('page-content')

                    @include("partials.form_errors")
                    <div class="messagelist">          
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="formHeadingWithStyle">
                                            <span>Transactions<span></span></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <table class="stylishTable">
                                    <thead>
                                        <tr>
                                            <td width="20">#</td>
                                            <td width="310">Package</td>
                                            <td width="120">Amount</td>
                                            <td width="150">Expiry Date</td>
                                            <!--<td width="300">Remaining Credit</td>-->
                                            <td width="160">Purchase Date</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($transactions) > 0) 
                                            {{--*/ $loopCounter = 0; /*--}}
                                            @foreach ($transactions as $transaction)
                                                {{--*/ $loopCounter++; /*--}}
                                                <tr>Credit
                                                    <td>{{$loopCounter}}</td>
                                                    <td>{{$transaction->package}}{{($transaction->package == "Enterprise")?"":" Credit"}}</td>
                                                    <td>{{$transaction->amount}}</td>
                                                    <td>
                                                        {{($transaction->package == "Enterprise")?date("Y-m-d", strtotime($transaction->expires_at)):"N/A"}}
                                                    </td>
<!--                                                    <td>
                                                        {{($transaction->package == "Enterprise")?"N/A":$transaction->bids." Credit"}}
                                                    </td>-->
                                                    <td>{{date("Y-m-d", strtotime($transaction->created_at))}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <p>No Transactions Found</p>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
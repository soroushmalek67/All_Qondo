@extends('templates.sub_pages_template')
@section('page-content')

        <section class="registrationFormSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="registrationFormCont">
                            <br/>
                            @if ($updated)
                            <h2>Updated successfully</h2>
                            @else
                            <form role="form" method="POST" action="{{ url('unsubscribe') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <h3>Uncheck check boxes if you don't wish to receive regarding email</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="checkboxCont">
                                            <input name="request_notification" id="request_notification" value="1" type="checkbox" 
                                                    {{($subscriptions->request_notification)?"checked":''}} />
                                            <label for="request_notification">Unsubscribe Request Notification</label>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="checkboxCont">
                                            <input name="quote_notification" id="quote_notification" value="1" type="checkbox" 
                                                    {{($subscriptions->quote_notification)?"checked":''}} />
                                            <label for="quote_notification">Unsubscribe Quote Notification</label>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="checkboxCont">
                                            <input name="message_notification" id="message_notification" value="1" type="checkbox" 
                                                    {{($subscriptions->message_notification)?"checked":''}} />
                                            <label for="message_notification">Unsubscribe Message Notification</label>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="checkboxCont">
                                            <input name="quotes_left_notification" id="quotes_left_notification" value="1" type="checkbox" 
                                                    {{($subscriptions->quotes_left_notification)?"checked":''}} />
                                            <label for="quotes_left_notification">Unsubscribe Quotes Left Notification</label>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <br/><br/>
                                        <input type="submit" value="update" class="btn blackBtn" />
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
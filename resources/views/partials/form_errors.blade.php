                        @if (count($errors) > 0 || session('message'))
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    @if (session('message'))
                                            @if(session('message') == 1)
                                                    <div class="alert alert-info">
                                                        Your company/community is already a member on qondo.  Our support team will  contact you shortly.
                                                </div>
                                            @else
                                                <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
    
                                                
                                            @endif
									@endif
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                        <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
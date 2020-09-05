        

<!--        <script type="text/javascript">
            function loadStyleSheet(src){
                if (document.createStyleSheet) document.createStyleSheet(src);
                else {
                    var stylesheet = document.createElement('link');
                    stylesheet.href = src;
                    stylesheet.rel = 'stylesheet';
                    stylesheet.type = 'text/css';
                    document.getElementsByTagName('head')[0].appendChild(stylesheet);
                }
            }
            loadStyleSheet ("{{ asset('/css/bootstrap.min.css') }}");
            loadStyleSheet ("{{ asset('/css/front/style.css') }}");
        </script>-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/front/bootstrap-select.css') }}" />
        <!--        ----------------------------Date Picker---------------------------->
        <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datepicker/datepicker3.css') }}" />
        <!--        ----------------------------Auto Complete-------------------------- -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/autocomplete/autocomplete.css') }}" />
        
        <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <!--        ----------------------------Date Picker-------------------------- -->
        <script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        <!--        ----------------------------Auto Complete-------------------------- -->
        <script type="text/javascript" src="{{ asset('plugins/autocomplete/jquery.mockjax.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/autocomplete/jquery.autocomplete.js') }}"></script>
        
        <script type="text/javascript" src="{{asset('plugins/jQueryValidate/jquery.validate.min.js')}}"></script>
        
        <!--        ----------------------------Custom-------------------------- -->
        <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

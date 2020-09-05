
        <title>FIRMOGRAM | Connecting Local Businesses {!!(empty($metas->meta_title))?((empty($metas->name))?'':"| $metas->name"):"| $metas->meta_title"!!}</title>
        <meta name="Keywords" content="{!!$metas->meta_keywords!!}" />
        <meta name="description" content="{!!$metas->meta_description!!}" />
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!--        ----------------------------Style Sheets-------------------------- -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/front/style.css') }}" />
        <!--<link rel="stylesheet" type="text/css" href="css/font-awesome.css" /> FONT-AWESOME-->

        <!--        -------------------------------Jquery----------------------------- -->
        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
        
        <script type="text/javascript">
            var URL = {!! json_encode(url('/')) !!};
            jQuery('document').ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
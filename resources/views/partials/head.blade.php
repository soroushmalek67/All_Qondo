        <title>QONDO | Connecting Condos to Contractors {!!(empty($metas->meta_title))?((empty($metas->name))?'':"| $metas->name"):"| $metas->meta_title"!!}</title>
		<!-- Muaawiya's -->
		<meta name="Keywords" content="{!!(empty($metas->meta_keywords))?((empty($metas->name))?'':'| $metas->name'):'| $metas->meta_keywords'!!}" />
        <meta name="description" content="{!!(empty($metas->meta_description))?((empty($metas->name))?'':'| $metas->name'):'| $metas->meta_description'!!}" />
        <!-- End Muaawiya's-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:image" content="http://www.firmogram.com/img/front/inner_logo.png" />
        
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/front/style.css') }}" />
        <!--<link rel="stylesheet" type="text/css" href="css/font-awesome.css" /> FONT-AWESOME-->



        <!--favicons--> 
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/favicons/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicons/favicon-16x16.png') }}">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!--favicons--> 


        <!--        -------------------------------Jquery----------------------------- -->
        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('/plugins/jQueryUI/jquery-ui-1.10.3.js') }}"></script>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDTl8KrApuNe1dzm1L7PH4eBbwObNeC4Cs"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/verifytwilio.js') }}"></script>
        
<!-- Start of Woopra Code -->
<script>
(function(){
        var t,i,e,n=window,o=document,a=arguments,s="script",r=["config","track","identify","visit","push","call","trackForm","trackClick"],c=function(){var t,i=this;for(i._e=[],t=0;r.length>t;t++)(function(t){i[t]=function(){return i._e.push([t].concat(Array.prototype.slice.call(arguments,0))),i}})(r[t])};for(n._w=n._w||{},t=0;a.length>t;t++)n._w[a[t]]=n[a[t]]=n[a[t]]||new c;i=o.createElement(s),i.async=1,i.src="//static.woopra.com/js/w.js",e=o.getElementsByTagName(s)[0],e.parentNode.insertBefore(i,e)
})("woopra");

woopra.config({
    domain: 'qondo.ca'
});
woopra.track();
</script>
<!-- End of Woopra Code -->
        
        
        @if(Auth::id()!=null)
        
        <script type="text/javascript">
        
       FB.logout(function(response) {
                document.location.reload();
            });
        </script>
        
        @endif
        
        
        
        
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

        
        <script type="text/javascript" src="//platform.linkedin.com/in.js">
                api_key: 815f4si7smhhb4
                onLoad: onLinkedInLoad
                authorize: true,

        </script>
        
        
        <!--facebook login-->
        
        
        <script>
            console.log(URL);
      window.fbAsyncInit = function() {
  FB.init({
    appId      : 1002527386557481,
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  

  };
    
    
    
    function test(){
        FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
//        console.log('Welcome!  Fetching your information.... ');
        var url = '/me?fields=id,name,email';
        FB.api(url, function(response) {
            console.log(response);
//             alert(response.name + " " + response.id + " " +response.email);
        }, {scope: 'email'});
    });
    }
    
   (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
   
   $(document).ready(function(){
       var top = $("#header_menu").height();
       var menu = $('#header_menu'),
           window_width = $(window).width();
         
        if (window_width <= 767) {
            menu.addClass('fixed_header');
            menu.removeClass('header_menu');
            $('.logo img').attr('src', URL+'/img/front/inner_logo-gray.png');
        }
      $(".fixed_header").find('.logo img').attr('src', URL+'/img/front/inner_logo-gray.png');
       $(window).scroll(function(){
            var scroll = $(window).scrollTop();
            if ( window_width > 767) {
                if (scroll >= top ) { 
                   menu.addClass('fixed_header');
                   menu.removeClass('header_menu')
                   $('.logo img').attr('src', URL+'/img/front/inner_logo-gray.png');
                   $('.location-icon-home').attr('src', URL + '/img/front/location-gray.png');
                   $('.arrow-home-icon').attr('src', URL + '/img/front/arrow-icon-orange.png');

                } else {
                   menu.addClass('header_menu');
                   menu.removeClass('fixed_header');
                   $('.logo img').attr('src', URL+'/img/front/inner_logo-white.png');
                    $('.location-icon-home').attr('src', URL + '/img/front/location-icon-white.png');
                     $('.arrow-home-icon').attr('src', URL + '/img/front/arrow-icon-white.png');
               } 
           }
      });
   })

</script>

        
    
        
        
        
        
      
        
        
       
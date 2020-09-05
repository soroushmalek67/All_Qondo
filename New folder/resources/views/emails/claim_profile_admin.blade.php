  <!DOCTYPE html>
<html lang="en-US">
    <head>
      <meta charset="utf-8">
    	<title>Claim Profile Request</title>
    </head>
    <body>

        {{--*/ $imgname = DB::table('notification')->where('notificationName','template_image')->first(); /*--}}
        
        

        <div style="max-width: 800px; padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
            <div style="margin-right: 50px;">
                <a href="/"><img src="{{asset('img/front/inner_logo.gif')}}" alt="qondo" style="width:27%; padding: 10px"></a>
              
            </div>
            <div>
                <img src="{{asset('img/notification_image/2016/9/06/'.$imgname->template_image)}}" alt="qondo" style="width: 100%">
            </div>
            
            <div style="margin-right:  50px;margin-left: 50px;">
                <p style="font-size: 19px;color: #555353;">
                     {!!$emailbody!!}
                </p>
            </div>
            <div style="background: #f19432;max-height: 75px;height: 75px;">
                 <a href="{{url('contact-us')}}" style="margin-right: 10px;margin-left: 150px;">  <p style="font-size: 20px;color: white;float:left;margin-left: 50px"><span style="font-weight: bold">Contact</span> with us</p></a>
                <div style='margin: 20px 50px 20px 0;float:right;'>
                    <a href="http://www.firmogram.com/blog/" style="margin-right: 10px;margin-left: 150px;"><img src="{{asset('img/invoice/blog-icon.png')}}"></a>
                    <a href="https://www.facebook.com/qondo/" style="margin-right: 10px;"><img src="{{asset('img/invoice/icon_fb.png')}}"></a>
                    <a href="https://twitter.com/qondopro" style="margin-right: 10px;"><img src="{{asset('img/invoice/icon_twitter.png')}}"></a>
                    
                </div>
            </div>
        </div>
    </body>
</html>





<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        
        {{--*/ $rest_passwordNotification = DB::table('notification')->where('notificationName','rest_password')->first(); /*--}}
        
        {{--*/ $buyer  = strtr($rest_passwordNotification->content, ["@reset" => url('password/reset/'.$token) ,]); /*--}}
        
        {!!$buyer!!}
    </body>
</html>

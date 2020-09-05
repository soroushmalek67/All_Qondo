<?php 

function GetAdminNotifications () {
    $newUsers = DB::table('users')->select(DB::raw('count(id) as newUsers'))->where('notification_status', 1)->first()->newUsers;
    $newRequests = DB::table('request_service')->select(DB::raw('count(id) as newRequests'))->where('notification_status', 1)->first()->newRequests;
    $totalNotifications = ($newUsers + $newRequests);
    return compact("newUsers", "newRequests", "totalNotifications");
}
function GetQuotesNotifications () {
    $newQuotes = DB::table('quotes_invitation')->select(DB::raw('count(id) as newQuotes'))->where('notification_status', 1)
                    ->where('supplier_id', Auth::id())->first()->newQuotes;
    return $newQuotes;
}
function GetMessageNotifications () {
    if (Auth::userType() == 1) {
        $newMessages = DB::table('messages as m')->leftJoin('quotes as q', 'q.id', '=', 'm.quote_id')
                            ->leftJoin('request_service as rs', 'rs.id', '=', 'q.request_id')->select(DB::raw('count(m.id) as newQuotes'))
                            ->where('rs.buyer_id', Auth::id())->where('m.sender_id', '!=', Auth::id())->where('m.notification_status', 1)
                            ->first()->newQuotes;
    } else {
        $newMessages = DB::table('messages as m')->leftJoin('quotes as q', 'q.id', '=', 'm.quote_id')
                            ->leftJoin('request_service as rs', 'rs.id', '=', 'q.request_id')->select(DB::raw('count(m.id) as newQuotes'))
                            ->where('q.supplier_id', Auth::id())->where('m.sender_id', '!=', Auth::id())->where('m.notification_status', 1)
                            ->first()->newQuotes;
    }
    return $newMessages;
}
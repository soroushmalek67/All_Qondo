<?php 
use DB;
$data = DB::table('notification')
              ->where('notificationName','rest_password')
                      ->first(); 
print_r($data);exit();
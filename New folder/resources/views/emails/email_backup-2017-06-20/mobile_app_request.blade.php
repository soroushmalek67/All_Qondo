@extends('templates.email_template')
    @section('title')
    Mobile App Request
    @stop
    @section('content')
        
    <p>Dear Admin,</p>
    <p>A user has requested for mobile app on the given email address</p>
    <lable>Email:&nbsp;{{$email}}</lable>
    <p>Regards,<br/> Qondo Team</p>
    
    @stop
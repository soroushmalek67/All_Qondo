<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Aloha\Twilio\Twilio;
use Services_Twilio_Twiml;
use Services_Twilio;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TwilioVerifyController extends Controller
{

	var $token;
	var $accountId;
	var $fromNumber;
	var $trail = false;
	var $trailPhoneNumber;
	
	public function __construct()
	{
		$this->token = config('twilio.token');//'cc2e6d5a1a2920e65cd8ac639df68e57';
		$this->accountId = config('twilio.sid');//'AC65439599b301dc24b0c43cd14b84cb99';
		$this->fromNumber = config('twilio.number');//'+15622030841';
		$this->trailPhoneNumber = config('twilio.trail_number');//'+15622030841';
	}

	public function index()
	{
		return view('twilioform');
	}

	public function sendSMS(Request $request)
	{	
		$PhoneNumber = ($this->trail) ? $this->trailPhoneNumber : $request->personnum;
		
		$PhoneNumber = preg_replace('/[^0-9]/', '', $PhoneNumber);
		
		$PhoneNumber = '+1'.$PhoneNumber;

		$validatedData = Validator::make($request->all(), [
			'personnum' => 'required|min:8',
			'email' => 'required|email',
		]);

		if($validatedData->fails())
		{
			return Response::json(['error' => 'Please enter phone number and email.']);
		}
		else
		{
			$email = DB::table('users')->select('id')->where('email', $request->email)->get();
			
			if($email){
				return Response::json(['error' => 'Email you entered already in use.']);
			}
			else
			{
				$twilio = new Twilio($this->accountId, $this->token, $this->fromNumber);
				$digits = 4;
				$code =  rand(pow(10, $digits-1), pow(10, $digits)-1);
				
				$message = 'Your Qondo code: '.$code;
	
				$twilio->message($PhoneNumber, $message);
				return Response::json(['success' => $code]);
			}
		}
	}
	
	public function resendcode(Request $request)
	{
		$PhoneNumber = ($this->trail) ? $this->trailPhoneNumber : $request->personnum;
		
		$twilio = new Twilio($this->accountId, $this->token, $this->fromNumber);
		$digits = 4;
		$code =  rand(pow(10, $digits-1), pow(10, $digits)-1);
		$twilio->message($PhoneNumber, $code);
		return Response::json(['success' => $code]);
	}
	
	public function sendTwilioSMS($number, $message){
	
		$twilio = new Twilio($this->accountId, $this->token, $this->fromNumber);
		//$digits = 4;
		//$code =  rand(pow(10, $digits-1), pow(10, $digits)-1);
		
		//$message = 'Your Qondo code: '.$code;
	
		$twilio->message($number, $message); //change the number from hard coded to $number when doing dynamically - +923238092059
		return Response::json(['success' => $message]);
	}
}

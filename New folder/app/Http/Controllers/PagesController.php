<?php
namespace App\Http\Controllers;
use DB;
use Mail;
use Input;
use App\Http\Controllers\Controller;


class PagesController extends Controller {
    
    public function about() {
        $data['metas'] = get_page_meta_array('About');
        return view('pages.about', $data);
    }
        
    public function faq() {
        $data['metas'] = get_page_meta_array('FAQ');
        return view('pages.faq', $data);
    }
        
    public function ContactUs() {
        $data['metas'] = get_page_meta_array('Contact Us');
        return view('pages.contact', $data);
    }
    
    public function howItWorks () {
        $data['metas'] = get_page_meta_array('About');
        return view('pages.how_it_works', $data);
    }


    public function ContactUsPost() {
        $contactusNotification = DB::table('notification')
                                        ->where('notificationName','contactus')
                                        ->first();
        
        $contactusN  = strtr($contactusNotification->content, ["@firstname"=>Input::get('firstName'),
                                                                '@lastname'=>Input::get('lastName'),
                                                                '@email'=>Input::get('email'),
                                                                '@phnNunber'=>Input::get('phoneNumber'),
                                                                '@companyNmae'=>Input::get('companyName'),
                                                                '@descrp'=>Input::get('description')]);
            
        $data = ['emailbody' => $contactusN];
        
        Mail::send('emails.contact_us', $data, function($message) {
            $message->to(getSettings('notification_email'))
                ->subject('Contact Us Form Request');
            $message->from(SENDER_EMAIL, SENDER_NAME);
        });
        
        return redirect("contact-us")->with('message', 'Request Sent!');
    }
    
    public function PrivacyPolicy() {
        $data['metas'] = get_page_meta_array('Privacy Policy');
        return view('pages.privacy_policy', $data);
    }
    
    public function Terms() {
        $data['metas'] = get_page_meta_array('Terms and Conditions');
        return view('pages.terms', $data);
    }
    
    public function OutdatedBrowser() {
        return view('pages.outdated_browser');
    }
    
}
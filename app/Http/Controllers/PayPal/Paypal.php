<?php namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Input;
use App\ModelStates;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Exception\PPConnectionException;
use PayPal\Api\PaymentExecution;

class Paypal extends Controller {

    protected $_apiContext, $userid, $userTax;
    
    public function __construct() {
        $userState = Auth::user()->state;
        $this->userTax = ModelStates::select('tax_percent', 'tax_name')->where('id', $userState)->first();
        
        $this->userid = Auth::id();
        $this->_apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'Adr2ATSRTuKOo1UhL7KKST7PTzwlTi-VyBPz8NgaIpTp2axu1j4L_jWlJ8Rb64hbnWQlxRPK291X3gqr',     // ClientID
                'ED8VdGBW7VxCjPWYtjAZ75NNiSGmK7vitIFQaycYgN0j8cyYiNjM0FU55d33-7tXMP2TXUJ5Ci-84WHZ'      // ClientSecret
//                'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS',     // ClientID
//                'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL'      // ClientSecret
            )
        );
        $this->_apiContext->setConfig(['mode' => 'live']);
    }
    
    public function PayAmount() {
        $items = [];
        $totalAmount = 0;
        $packages = [];
        $requestedItems = Input::get('items');
        
//        print_r($requestedItems);        exit();
        
        
        if (Input::has('quotesPkg')) {
            if (Input::get('quotesPkg') == "basic") {
                unset($requestedItems[1]);
            } else if (Input::get('quotesPkg') == "advance") {
                unset($requestedItems[0]);
            }
        }
        $loopCounter = 0;
        foreach ($requestedItems as $requestedItem) {
            $items[$loopCounter] = new Item();
            $items[$loopCounter]->setName($requestedItem['title'])
                ->setCurrency('CAD')
                ->setQuantity($requestedItem['quantity'])
                ->setPrice($requestedItem['price']);
            $totalAmount += ($requestedItem['price'] * $requestedItem['quantity']);
            $packages[] = $requestedItem['package'];
            $loopCounter++;
        }
        $taxAmount = ($totalAmount/100)*$this->userTax->tax_percent;
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        // add item to list
        $item_list = new ItemList();
        $item_list->setItems($items);
		
        $details  = new Details();
        $details->setTax($taxAmount)
        	->setSubtotal($totalAmount);

        $amount = new Amount();
        $amount->setCurrency('CAD')
            ->setDetails($details)
            ->setTotal($taxAmount + $totalAmount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL('payment/status')) // Specify return URL
            ->setCancelUrl(URL('payment/status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_apiContext);
        } catch (PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('paypalBoughtPackages', implode("####", $packages));

        if(isset($redirect_url)) {
            // redirect to paypal
            return redirect($redirect_url);
        }

        return redirect('dashboard')
            ->withErrors('Unknown error occurred');
    }
    
    function PaymentResponse () {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');
        $paypalBoughtPackages = explode("####", Session::get('paypalBoughtPackages'));
        
//        printr($paypalBoughtPackages);exit;
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        Session::forget('paypalBoughtPackages');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return redirect(url('membership'))->withErrors("Payment Failed");
        }

        $payment = Payment::get($payment_id, $this->_apiContext);

        // PaymentExecution object includes information necessary 
        // to execute a PayPal account payment. 
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_apiContext);

//        printr($result);exit; // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made
            foreach ($paypalBoughtPackages as $paypalBoughtPackage) {
                $package = "";
                $price = 0;
                switch ($paypalBoughtPackage) {
                    case "bidsPackageOne":
                        $price = getSettings('packageOnePrice');
                        $package = getSettings('packageOneQuotes');
                        DB::table('users')->where('id', $this->userid)->update(['bids' => DB::raw("bids + $package")]);
                        $expiryDate = "0000-00-00 00:00:00";
                        break;
                    case "bidsPackageTwo":
                        $price = getSettings('packageTwoPrice');
                        $package = getSettings('packageTwoQuotes');
                        DB::table('users')->where('id', $this->userid)->update(['bids' => DB::raw("bids + $package")]);
                        $expiryDate = "0000-00-00 00:00:00";
                        break;
                    case "monthlySubscriptionPro":
                        $price = getSettings('proPackagePrice');
                        $package = "Pro";
                        DB::table('users')->where('id', $this->userid)->update(['membership' => 'pro']);
                        $expiryDate = "0000-00-00 00:00:00";
                        break;
                    case "monthlySubscriptionEnterprise":
                        $price = getSettings('enterprisePackagePrice');
                        $package = "Enterprise";
                        $currentDate = date("Y-m-d H:i:s");
                        $expiryDate = date("Y-m-d H:i:s", strtotime('+1 year', time()));
                        
                        $lastExpiryDateObj = DB::table('transactions')->select('expires_at')->where('userid', $this->userid)
                                                ->where('package', 'Enterprise')->orderBy('id', 'DESC')->first();
                        if ($lastExpiryDateObj != null) {
                            $lastMembershipExpiryDate = $lastExpiryDateObj->expires_at;
                            if (strtotime($lastMembershipExpiryDate) > time()) {
                                $expiryDate = date("Y-m-d H:i:s", strtotime("+".dateDiff($lastMembershipExpiryDate, $currentDate), strtotime($expiryDate)));
                            }
                        }
                        DB::table('users')->where('id', $this->userid)->update(['membership' => 'enterprise']);
                        break;
                }
                DB::table('transactions')->insert(
                        ['payid' => $payment_id, 'package' => $package, 'amount' => $price, 'userid' => $this->userid, 'expires_at' => $expiryDate]
                );
            }
            return redirect('transactions')->with('message', 'Payment success');
        }
        return redirect('membership')->withErrors('Payment failed');
    }

}
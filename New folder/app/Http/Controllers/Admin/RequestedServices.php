<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelRequestService;
use Input;
use DB;
use Mail;
use App\User;
use App\Categories;
use App\ModelCities;
use App\ModelStates;
use Illuminate\Http\Request;

class RequestedServices extends Controller {

    public function Index() {
        
        DB::table('request_service')->where('notification_status', 1)->update(['notification_status' => 0]);
        $data['requestedServices'] = ModelRequestService::leftjoin('provinces as p', 'p.id', '=', 'request_service.state')
                        ->leftjoin('cities as c', 'c.id', '=', 'request_service.city')
                        ->leftjoin('users as u', 'u.id', '=', 'request_service.buyer_id')
                        ->select('request_service.*', 'p.name as state', 'c.name as city', 'u.first_name', 'u.last_name')
                        ->orderBy('id', 'desc')->paginate(25);
        return view("admin.requested_services", $data);
    }

    public function UpdateStatus() {
        $request = Input::all();
        $suppliers = "";
        if ($request['currentShowOnHome'] == 0) {
            if (Input::get("not_show_on_home") !== null) {
                $requestService = ModelRequestService::find($request['id']);
                $requestService->show_on_home = 1;
                $requestService->save();
                return redirect("admin-panel/requested-services")->with('message', 'Updated Successfully');
            }
        } else if ($request['currentShowOnHome'] == 1) {
            if (Input::get("not_show_on_home") !== null) {
                $requestService = ModelRequestService::find($request['id']);
                $requestService->show_on_home = 0;
                $requestService->save();
                return redirect("admin-panel/requested-services")->with('message', 'Updated Successfully');
            }
        }

        if ($request['currentStatus'] != 1) {
            $requestService = ModelRequestService::find($request['id']);
            $requestDetails = $requestService->toArray();
            if (Input::get("approveIt") !== null) {
                if (Input::get("supplier_id") != null) {
                    $supplierArray = explode(",", Input::get("supplier_id"));
                    $suppliers = request_to_specificSupplier($supplierArray);
                } elseif (Input::get("list_type") == 1) {
                    $query = "SELECT users.id, users.first_name, users.last_name,  users.email users.approval_email from  users , suplier_buyerrel "
                            . "where suplier_buyerrel.supplier_id = users.id and suplier_buyerrel.buyer_id=" . $request['buyer_id'] . " AND FIND_IN_SET(" . $requestDetails['main_categories']
                            . ", users.main_categories) AND " . $requestDetails['city'] . " = users.city  AND FIND_IN_SET(" . $requestDetails['sub_categories'] . ", users.sub_categories) and suplier_buyerrel.status=1";
                    $suppliers = DB::select($query);
                } else {
                    $query = "SELECT id, first_name, last_name, service_kilometers, email ,approval_email 
                            FROM users WHERE user_type != 1 AND id != " . $requestDetails['buyer_id'] . " AND FIND_IN_SET(" . $requestDetails['main_categories']
                            . ", main_categories) AND FIND_IN_SET(" . $requestDetails['sub_categories'] . ", sub_categories) AND FIND_IN_SET("
                            . $requestDetails['state'] . ", service_states) AND FIND_IN_SET(" . $requestDetails['city'] . ", service_cities)";
                    $suppliers = DB::select($query);
                }
                $insertionData = array();
                foreach ($suppliers as $supplier) {
                    $insertionData[] = array("request_id" => $requestDetails['id'], "supplier_id" => $supplier->id);
                    $subscriptions = DB::table('emails_subscription')->where('userid', $supplier->id)->first();

                    if ($subscriptions && $subscriptions->quote_notification) {
                        $email = $supplier->email;
                        $ccemail = $supplier->approval_email;

                        $qoute_invitationN = DB::table('notification')
                                ->where('notificationName', 'qoute_invitation')
                                ->first();
                        $buyer = strtr($qoute_invitationN->content, ["@first_name" => $supplier->first_name, "@last_name" => $supplier->last_name,
                            "@requesturl" => url('project-details/' . $requestDetails['id']),
                        ]);

                        $result_qoute = ['emailbody' => $buyer];

                        Mail::send('emails.quote_invitaion', $result_qoute, function($message) use ($email, $ccemail) {
                            $message->to($email)
                                    ->subject('Invitaion to Quote');
                            if ($ccemail != null)
                                $message->cc($ccemail);
                            $message->from(SENDER_EMAIL, SENDER_NAME);
                        });
                    }
                }

                DB::table('quotes_invitation')->insert($insertionData);
                $requestService->status = 1;
                $requestService->approved_at = \Carbon\Carbon::now()->toDateTimeString();
            } else {
                $requestService->status = 2;
            }
            $requestService->save();

            $subscriptions = DB::table('emails_subscription')->where('userid', $requestDetails['buyer_id'])->first();

            if ($subscriptions && $subscriptions->request_notification) {
                $buyerDetails = User::select('first_name', 'last_name', 'email', 'approval_email')->where('id', $requestDetails['buyer_id'])->first()->toArray();
                $buyerDetails['request_id'] = $request['id'];
                $buyerEmail = $buyerDetails['email'];
                $buyerAEmail = $buyerDetails['approval_email'];
                if (Input::get("approveIt") !== null) {
                    $registerNotification = DB::table('notification')
                            ->where('notificationName', 'request_approve')
                            ->first();
                    $buyer = strtr($registerNotification->content, ["@firstName" => $buyerDetails['first_name'], '@lastName' => $buyerDetails['last_name'],
                        "@requesturl" => url('project-details/' . $request['id'])
                    ]);
                    $result = ['emailbody' => $buyer];

                    Mail::send('emails.request_approved', $result, function($message) use ($buyerEmail, $buyerAEmail) {
                        $message->to($buyerEmail)
                                ->subject('Request Accepted');
                        if ($buyerAEmail != null)
                            $message->cc($buyerAEmail);
                        $message->from(SENDER_EMAIL, SENDER_NAME);
                    });
                } else {
                    $registerNotification = DB::table('notification')
                            ->where('notificationName', 'request_rejected')
                            ->first();
                    $buyer = strtr($registerNotification->content, ["@firstname" => $buyerDetails['first_name'], '@lasstname' => $buyerDetails['last_name'],
                        "@requesturl" => url('project-details/' . $request['id'])
                    ]);

                    $result = ['emailbody' => $buyer];
                    Mail::send('emails.request_rejected', $result, function($message) use ($buyerEmail, $buyerAEmail) {
                        $message->to($buyerEmail)
                                ->subject('Request Rejected');
                        if ($buyerAEmail != null)
                            $message->cc($buyerAEmail);
                        $message->from(SENDER_EMAIL, SENDER_NAME);
                    });
                }
            }
            return redirect("admin-panel/requested-services")->with('message', 'Updated Successfully');
        } else {
            return redirect("admin-panel/requested-services")->withErrors(['Sorry you cannot update approved request']);
        }
    }

    public function Details($id) {
        $data['requestedService'] = ModelRequestService::find($id)->leftjoin('provinces as p', 'p.id', '=', 'request_service.state')
                        ->leftjoin('cities as c', 'c.id', '=', 'request_service.city')
                        ->select('request_service.*', 'p.name as state', 'c.name as city')->where('request_service.id', $id)->first();

        $data['categories'] = Categories::getMainCategories();
        $data['subCategoriesOr'] = Categories::getSubCategories();

         if (!empty($data['requestedService']['city'])) {
             $data['defaultLocation'] = ModelCities::where('name', $data['requestedService']['city'])->first()->toArray(); 
        } else {
            $data['defaultLocation'] = ['state' => '', 'name' => '', 'id' => ''];
        }
        $data['request_id'] = $id;
        $mainCategories = Categories::getMainCategoriesByids(explode(",", $data['requestedService']['main_categories']));
        
        if ($data['requestedService']['sub_categories'] != null) {
            $subCategories = Categories::getSubCategoriesByids(explode(",", $data['requestedService']['sub_categories']));
        } else {
            $subCategories = "";
        }

        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        $data['mainCategories'] = "";
        $data['subCategories'] = "";
        foreach ($mainCategories as $mainCategory) {
            $data['mainCategories'] = $mainCategory->id;
        }
        if ($subCategories == "") {
            $data['subCategories'] = "";
        } else {
            foreach ($subCategories as $subCategory) {
                $data['subCategories'] = $subCategory->id;
            }
        }
        return view("admin.requested_services_details", $data);
    }

    public function updateRequest($id, Request $request) {
        $buyer_data = DB::table('users')
                ->where('id', $request->get('buyer_id'))
                ->first();
        $title = $request->get('title');
        $main_categories = $request->get('main_categories');
        $sub_categories = $request->get('sub_categories');
        $description = $request->get('description');
        $state = $request->get('state');
        $city = $request->get('city');
        $estimated_budget = $request->get('estimated_budget');

        DB::table('request_service')
                ->where('id', $id)
                ->update(['title' => $title, 'main_categories' => $main_categories, 'sub_categories' => $sub_categories,
                    'description' => $description, 'estimated_budget' => $estimated_budget, 'city' => $city, 'state' => $state]);

        $request_editNotification = DB::table('notification')
                ->where('notificationName', 'request_edit')
                ->first();
        $buyer = strtr($request_editNotification->content, ["@buyername" => $buyer_data->first_name . " " . $buyer_data->last_name, "@requestdetail" => url('project-details/' . $id),
        ]);
        
        $data = ['emailbody' => $buyer];
        $email = $buyer_data->email;
        $approval_email = $buyer_data->approval_email;

        Mail::send('emails.requestEdit', $data, function($message) use ($email, $approval_email) {
            $message->to($email)
                    ->subject('Request Edit');
            if ($approval_email != null)
                $message->cc($approval_email);
            $message->from(SENDER_EMAIL, SENDER_NAME);
        });
        return redirect("admin-panel/requested-services")->with('message', 'Updated Successfully');
    }
}

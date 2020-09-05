<?php namespace App\Http\Controllers;

use Input;
use App\User;
use App\Categories;
use App\ModelCities;

class Process extends Controller {

    public function SearchFormSubmision () {
        $request = Input::all();
        if ($request['selectedCatName'] == $request['searchKeyword'] && !empty($request['searchKeyword'])) {
            $retunURL = "";
            switch ($request['selectedOptionType']) {
                case "category":
                    $categoryDetails = Categories::getCategoryByID($request['selectedCatID']);
                    if ($categoryDetails[0]->parent_id == 0) {
                        $retunURL = "categories/".$categoryDetails[0]->slug;
                    } else {
                        $retunURL = "request-service/".$categoryDetails[0]->slug;
                    }
                    break;
                case "company":
                    $compayDetails = User::select('id', 'company_slug')->where('id', $request['selectedCatID'])
                        ->where(function ($query) {
                            $query->where('user_type', 3)->orWhere('user_type', 2);
                        })->first();
                    $retunURL = "supplier-profile/$compayDetails->company_slug/$compayDetails->id";
                    break;
                case "city":
                    $cityDetails = ModelCities::select('slug')->where('id', $request['selectedCatID'])->first();
                    $retunURL = "city/".$cityDetails->slug;
                    break;
            }
            return redirect($retunURL);
        } else {
            return redirect('categories');
        }
    }

}

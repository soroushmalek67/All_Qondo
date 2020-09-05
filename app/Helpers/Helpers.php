<?php
use \App\Http\Controllers\HomeController;
function activeMenu($uri = '') {
    $active = '';
    if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
        $active = 'active';
    }
    return $active;
}


function solcialSignUp($credential, $id, $usertype) {
    
//    $user = User::where('email', '=', $credential)->first();
//Now log in the user if exists
    if ($id != null) {
        Auth::sloginUsingId($id, false, $usertype);
        return redirect('/');
    }
}


function saveOrReplaceFile ($destinationPath, $file, $oldFileName, $filePrefix, $pathDate = null) {
    $makePathForDates = true;
    
    if ($destinationPath == "img/category") {
        $makePathForDates = false;
    }
    if ($destinationPath == "img/category/category_icons") {
        $makePathForDates = false;
    }
    
    if ($makePathForDates) {
        if (is_null($pathDate)) {
            $pathDate = date('Y-m-d');
        }
        $folderStructure = "/".date('Y', strtotime($pathDate))."/".date('n', strtotime($pathDate))."/".date('d', strtotime($pathDate));
        $destinationPath .= $folderStructure;
    }
    
    $extension = $file->getClientOriginalExtension();
    $fileName = $filePrefix."_".rand(11111,99999).'.'.$extension;
    $file->move($destinationPath, $fileName);

    if (!empty($oldFileName) && File::exists(public_path($destinationPath."/".$fileName))) {
        File::delete($destinationPath."/".$oldFileName);
    }
    
    return $fileName;
}

function makeSlug($text) { 
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    // trim
    $text = trim($text, '-');
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // lowercase
    $text = strtolower($text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

function getUniqueSlug ($slug, $slugsArray) {
    if (count($slugsArray) > 0) {
        $loopCounter = 0;
        while (true) {
            if ($loopCounter == 0) {
                if (!in_array("$slug", $slugsArray)) {
                    $slug = "$slug";break;
                }
            } else {
                if (!in_array("$slug-$loopCounter", $slugsArray)) {
                    $slug = "$slug-$loopCounter";break;
                }
            }
            $loopCounter++;
        }
    }
    return $slug;
}

function printr ($array) {
    echo "<pre>";print_r($array);echo "</pre>";
}

function getRequestStatus ($type) {
    $status = "Pending";
    switch ($type) {
        case 1:
            $status = "Approved";
            break;
        case 2:
            $status = "Rejected";
            break;
        case 3:
            $status = "Closed";
            break;
    }
    return $status;
}

function whenDoYouNeedIt ($type, $specificDate = "Specific Date") {
    return ($type == 1) ? "I’m Flexible" : (($type == 2) ? "Within 48 Hours" : "$specificDate");
}

function whatIsThisPurchaseFor ($type) {
    return ($type) ? "One Time" : (($type == 2) ? "Recurring" : "Starting A Business");
}

function profileGetFieldsValues ($old, $actual) {
    return ($old) ? $old : $actual;
}

function getQuoteStatus ($type) {
    return ($type == 0) ? "Pending" : (($type == 1) ? "Accepted" : "Rejected");
}

function getSettings ($key = null) {
    if (!is_null($key)) {
        $settingObj = DB::table('settings')->select('value')->where('key', $key)->first();
        return $settingObj->value;
    }
}

function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
    
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
 
    // Return string with times
    return implode(" ", $times);
}

function getFolderStructureByDate ($date) {
    return date('Y', strtotime($date))."/".date('n', strtotime($date))."/".date('d', strtotime($date));
}

function get_user_ip () {
    $ipaddress = '';
    if (filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP') !== null) {
        $ipaddress = filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP');
    } else if(filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR') !== null) {
        $ipaddress = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR');
    } else if(filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED') !== null) {
        $ipaddress = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED');
    } else if(filter_input(INPUT_SERVER, 'HTTP_FORWARDED_FOR') !== null) {
        $ipaddress = filter_input(INPUT_SERVER, 'HTTP_FORWARDED_FOR');
    } else if(filter_input(INPUT_SERVER, 'HTTP_FORWARDED') !== null) {
        $ipaddress = filter_input(INPUT_SERVER, 'HTTP_FORWARDED');
    } else if(filter_input(INPUT_SERVER, 'REMOTE_ADDR') !== null) {
        $ipaddress = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

function get_page_meta_array($title = null, $keywords = null, $description = null) {
    if (is_null($title)) {
        $title = "";
    }
    if (is_null($keywords)) {
        $keywords = "";
    }
    if (is_null($description)) {
        $description = "FIRMOGRAM is the smartest and fastest growing B2B marketplace matching professional service providers to motivated local and "
                        ."national customers. Try it Free!";
    }
    
    $currentPath = Request::getPathInfo();
    $metas = DB::table('pages_metas')->where('slug', $currentPath)->first();
    if ($currentPath == '/' && $metas) {
        $metas->meta_title = '';
        $metas->name = '';
    }
    
    if (!$metas) {
        $metas = (object) ['meta_title' => $title, 'meta_keywords' => $keywords, 'meta_description' => $description];
    }
    
    return $metas;
}


function request_to_specificSupplier($supplier=null){
    
    
    $supplierArray=explode(",", Input::get("supplier_id"));
                    
//                     print_r($supplierArray);exit();
                  return  $suppliers=DB::table('users')
                          
                            ->whereIn('users.id',$supplier)
                          
                            ->get();
    
    
}


function header_main_categories() {
    $categories = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                    ->select("c.id", "c.slug", "cd.name")->where('c.parent_id', 0)
                    ->orderByRaw("CASE WHEN c.slug = 'construction-maintenance' THEN 1 END DESC,
                                CASE WHEN c.slug = 'property-management' THEN 2 END DESC,
                                CASE WHEN c.slug = 'engineering-services' THEN 3 END DESC,
                                CASE WHEN c.slug = 'business-accounting' THEN 4 END DESC,
                                CASE WHEN c.slug = 'financial-investment' THEN 5 END DESC,
                                CASE WHEN c.slug = 'business-legal' THEN 6 END DESC,
                                CASE WHEN c.slug = 'office-products' THEN 7 END DESC,
                                CASE WHEN c.slug = 'marketing-sales' THEN 8 END DESC,
                                CASE WHEN c.slug = 'it-2' THEN 9 END DESC")
                    ->get();
    return $categories;
}



function compress_file_from_TinyPNG ($file_path) {
    include_once app_path('Helpers'.DIRECTORY_SEPARATOR.'TinyPNG.php');
    
    $api = new TinyPNG('yq26ZsanmcoL20d1i-T_tDtmKsQ5Zejc');

    $api->shrink($file_path);
    $resultJson = $api->getResultJson();

    $ch = curl_init($resultJson->output->url);
    $fp = fopen(public_path($file_path), 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}

function getServices()
{
	return HomeController::getservices();
}
<?php
/*
  Template Name: User Bussiness Form1
 */
get_header();
?>


<?php
if (is_user_logged_in()) {
    
//    print_r($_POST);exit;
//Add featured image to post
//echo addFeaturedImage(256, 'F:/wamp/www/htmls/century21/images/images/Lighthouse.jpg');
    function addFeaturedImage($post_id, $file) {

        if (!function_exists('wp_handle_upload'))
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        $uploadedfile = $_FILES['myfile'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

        if ($movefile) {
            $wp_filetype = $movefile['type'];
            $filename = $movefile['file'];
            $wp_upload_dir = wp_upload_dir();
            $attachment = array(
                'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                'post_mime_type' => $wp_filetype,
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment($attachment, $filename);
            set_post_thumbnail($post_id, $attach_id);
        }
    }

    if (isset($_POST['submit-cont'])) {
        global $current_user, $wpdb;
        get_currentuserinfo();

        $userid = $current_user->ID;
        $userEmail = $current_user->user_email;
        $bussName = filter_input(INPUT_POST, "buss-name");
        $bussDesc = filter_input(INPUT_POST, "buss-desc");
        $bussSiteURL = filter_input(INPUT_POST, "bussSiteURL");
        $countries = filter_input(INPUT_POST, "countries");
        $contAddress = filter_input(INPUT_POST, "cont-address");
        $bussCity = filter_input(INPUT_POST, "bussCity");
        $contPhone = filter_input(INPUT_POST, "cont-phone");
        $contLatitude = filter_input(INPUT_POST, "cont-latitude");
        $contLongitude = filter_input(INPUT_POST, "cont-longitude");
        $contZip = filter_input(INPUT_POST, "cont-zip");
        $contFax = filter_input(INPUT_POST, "cont-fax");
        $contState = filter_input(INPUT_POST, "cont-state");
        $place_id = filter_input(INPUT_POST, "post_id");
        $category = filter_input(INPUT_POST, "business_cat");
        $buss_about = filter_input(INPUT_POST, "buss_about");
        
        $business_images_array = filter_input(INPUT_POST, "business_images", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        
        
        $country_id_db = explode(',', $countries);
        $countries_id = $country_id_db[0];
        $countries = $country_id_db[1];

        $images = array();
        $extension = array("jpeg", "jpg", "png", "gif");
        foreach ($_FILES['images']['tmp_name'] AS $key => $images_name) {
            $target_dir = "wp-content/themes/wp-bizindex/user_data/";
            $ext = pathinfo(basename($_FILES['images']['name'][$key]), PATHINFO_EXTENSION);
            $filename = pathinfo($_FILES['images']['name'][$key], PATHINFO_FILENAME);
            $image_name = $filename . time() . "." . $ext;
            $target_file = $target_dir . $image_name;
            $uploadOk = 1;
            if (in_array($ext, $extension)) {
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["images"]["tmp_name"][$key]);
                $up = move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_file);
                if (!$up) {
                    echo error_get_last();
                }
                array_push($images, $image_name);
            }
        }

        if ($_FILES['file_logo']['name'] != '') {
            $target_dir = "wp-content/themes/wp-bizindex/user_data/";
            $target_file = $target_dir . basename($_FILES["file_logo"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["file_logo"]["tmp_name"]);
            move_uploaded_file($_FILES["file_logo"]["tmp_name"], $target_file);
            $filenamelogo = basename($_FILES["file_logo"]["name"]);
        } else {
            if ($_POST['file_logo-v']) {
                $filenamelogo = $_POST['file_logo-v'];
            } else {
                $filenamelogo = '';
            }
        }
        if ($_FILES['file_special_deal']['name'] != '') {
            $target_dir = "wp-content/themes/wp-bizindex/user_data/";
            $target_file = $target_dir . basename($_FILES["file_special_deal"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["file_special_deal"]["tmp_name"]);
            move_uploaded_file($_FILES["file_special_deal"]["tmp_name"], $target_file);
            $file_special_deal = basename($_FILES["file_special_deal"]["name"]);
        } else {
            if ($_POST['file_special_deal-v']) {
                $file_special_deal = $_POST['file_special_deal-v'];
            } else {
                $file_special_deal = '';
            }
        }

        $na = array('CA', 'US', 'MX', 'CU');
        $sa = array('AR', 'BR', 'CO');
        $me = array('EG', 'IR', 'TR', 'IQ', 'SA', 'YE', 'SY', 'AE', 'IL', 'JO', 'PS', 'LB', 'OM', 'KW', 'QA', 'BH', 'CY');
        $fe = array('CN', 'MY', 'TH', 'TW', 'BD', 'VN', 'SG', 'PH', 'MM', 'ID');
        $eu = array('RU', 'DE', 'TR', 'GB', 'EA', 'UA', 'PL', 'RO', 'KZ', 'NL');
        $ca = array('RU', 'LV', 'TJ', 'TM', 'KZ');
        $an = array('AU', 'NZ');
        $asia = array('IN', 'PK', 'IR', 'LK');
        $af = array('ZA', 'GH', 'SN');

        if (in_array($countries, $na)) {
            $db = 'north_america';
        }
        if (in_array($countries, $sa)) {
            $db = 'south_america';
        }
        if (in_array($countries, $me)) {
            $db = 'middle_east';
        }
        if (in_array($countries, $fe)) {
            $db = 'far_east';
        }
        if (in_array($countries, $eu)) {
            $db = 'europe';
        }
        if (in_array($countries, $ca)) {
            $db = 'central_asia';
        }
        if (in_array($countries, $an)) {
            $db = 'aus_new';
        }
        if (in_array($countries, $asia)) {
            $db = 'asia';
        }
        if (in_array($countries, $af)) {
            $db = 'africa';
        }
        $user_db = $current_user->db;
        $db_array = explode(",", $user_db);

        if (in_array($db, $db_array)) {
            echo 'Already exist<br>';
        } else {
            if (!empty($user_db)) {
                array_push($db_array, $db);
                $db_array2 = implode(",", $db_array);
            } else {
                $db_array2 = $db;
            }
            $user = "UPDATE `wp_users` SET `db`='$db_array2' where `id`='$userid'";
            $wpdb->query($user);
        }

        if (isset($_POST['post_id']) && !empty($_POST['post_id'])) {
            $query = "UPDATE `business_contacts_$db` SET `name`='$bussName', `category`='$category', `description`='$bussDesc', `address`='$contAddress', "
                    . "`city`='$bussCity', `province`='$contState', `postalcode`='$contZip', `country`='$countries_id', `phone`='$contPhone', `fax`='$contFax', "
                    . "`email`='$userEmail', `website`='$bussSiteURL', `lati`='$contLatitude', `longi`='$contLongitude', `logo`='$filenamelogo', "
                    . "`about_us`='$buss_about', `special_deal`='$file_special_deal' WHERE id = $place_id";
            
            if (count($business_images_array) > 0) {
                $numItems = count($business_images_array);
                $i = 0;
                $deleted_images_query = "DELETE FROM `business_images` WHERE `id` NOT IN ('".join("','", $business_images_array)."') ";
//                foreach($business_images_array as $business_image_array) {
//                  if(++$i === $numItems) {
//                    $deleted_images_query .= "`id` != $business_image_array";
//                  } else {
//                    $deleted_images_query .= "`id` != $business_image_array OR";
//                  }
//                } 
                $wpdb->query($deleted_images_query);
                
                $business_id = $place_id;
//                $check_images_exist_query = "SELECT * FROM `business_images` WHERE business_id = $place_id";
//                $check_images_exist = $wpdb->get_results($check_images_exist_query);
//                
//                $list = array();
//                foreach($check_images_exist as $check_images_exis) {
//                    array_push($list, $check_images_exis->image);
//                }
////                $list = implode(',', $list);
//                
//                
//                $numItems = count($images);
//                $i = 0;
//                foreach ($images as $image) {
//                    $query2 = "INSERT INTO `business_images`(`image`, `business_id`) VALUES ";
//                    if (++$i === $numItems) {
//                        if (!in_array($image, $list)){
//                            $query2 .= "('$image',$place_id)";
//                        }
//                    } else {
//                        if (!in_array($image, $list)){
//                            $query2 .= "('$image',$place_id),";
//                        }
//                    }
//                }
//                echo $query2;exit;
//                $wpdb->query($query2);
            }
            
        } else {
            $query = "INSERT INTO `business_contacts_$db`(`name`, `category`, `description`, `address`, `city`, `province`, `postalcode`, `country`, `phone`, "
                    . "`fax`, `email`, `lati`, `longi`, `website`, `user_id`, `logo`, `special_deal`, `about_us`) "
                    . "VALUES ('$bussName', '$category', '$bussDesc', '$contAddress','$bussCity', '$contState', '$contZip', '$countries_id', '$contPhone', "
                    . "'$contFax', '$userEmail', '$contLatitude', '$contLongitude' ,'$bussSiteURL', '$userid', '$filenamelogo', '$file_special_deal', "
                    . "'$buss_about')";
            $wpdb->query($query);
            $business_id = $wpdb->insert_id;

        }
        if (count($images)>0) {
            $query2 = "INSERT INTO `business_images`(`image`, `business_id`) VALUES ";
            $numItems = count($images);
            $i = 0;
            foreach ($images as $image) {
                if (++$i === $numItems) {
                    $query2 .= "('$image',$business_id)";
                } else {
                    $query2 .= "('$image',$business_id), ";
                }
            }
            $wpdb->query($query2);
        }
        wp_redirect(site_url() . '/bussiness-detail/');
    }
//============== FROM SUBMISTION END ===========================//
    if (isset($_POST['delete_image'])) {
        global $wpdb;
        $image_id = $_POST['image'];

        $delete_image_query = "DELETE FROM `business_images` WHERE `id` = $image_id";
        $wpdb->get_results($delete_image_query);
    }
    $userPlaceDetails = null;
//get complete data of edited post to populate into fields
    if (isset($_POST['submitPostEdit'])) {
        $postChecked = $_POST['postChecked'];
        $placeidEdit = explode(',', $postChecked);
        $place_edit_id = $placeidEdit[0];
        $place_edit_db = $placeidEdit[1];
//    get post data to fill in fields
        global $wpdb;
        $the_query = "SELECT * FROM business_contacts_$place_edit_db "
                . "WHERE id = $place_edit_id";
        $userPlaceDetails = $wpdb->get_results($the_query);

        $business_images_query = "SELECT * FROM `business_images` WHERE business_id = $place_edit_id";
        $business_images = $wpdb->get_results($business_images_query);
    }
    ?>
    <div class="body-content-innerpage">
        <div class="wrapper">
            <!--<div class="innerPage-title"> SUBMIT YOUR BUSINESS </div>-->
            <div class="innerPage-content">
                <?php //the_content(); 
                ?>
            </div>
            <!-- bussiness Paging DIv Start-->
            <div id="bussiness-paging">
                <div class="buss-form-top-bg">
                    <h3 class="form-title">SUBMIT YOUR BUSINESS</h3>
                </div>
                <div class="buss-mid-content">
                    <div class="buss-form-nav">
                        <ul>
                            <li class="active-business">Business Detail</li>
                            <li>Contact Detail</li>
                            <?php
                            get_currentuserinfo();
                            $userid = $current_user->ID;

                            $res = $wpdb->get_results('select * from wp_user_membership where user_id="' . $userid . '"', OBJECT);
                            $status = $res[0]->status;
                            if ($status == 1) {
                                ?>
                                <li>Profile</li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="buss-form-fields">
                        <form id="buss-form1" action="#" class="top20" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6">
                                <ul>
                                    <li>
                                        <label class="buss-label">Business Name</label>
                                    </li>
                                    <li>
                                        <input type="text" name="buss-name" id="buss-name" class="buss-input"  value="<?php echo $userPlaceDetails[0]->name; ?>" />
                                    </li>
                                    <li> 
                                        <label class="buss-label">Business Category</label>
                                        <select class="myselect" id="business_cat" name="business_cat"> 
                                            <option selected disabled value>Select Category</option>
                                            <?php
                                            $categories = get_field('category', 36);
                                            $categories_array = preg_split('/$\R?^/m', $categories);
                                            foreach ($categories_array as $category) {
                                                if ($userPlaceDetails[0]->category == $category) {
                                                    echo '<option selected value="' . $category . '">' . $category . '</option>';
                                                } else {
                                                    echo '<option value="' . $category . '">' . $category . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </li>
                                    <li>
                                        <label class="buss-label">Upload Images</label>
                                    </li>
                                    <li>
                                        <script>
                                                $( document ).ready(function() {
                                                    $(".cross_remove").click(function(){
                                                        $(this).parent().parent().remove();
                                                    });
                                                });
                                        </script>
                                        <input type="file" name="images[]" class="buss-input" multiple />
                                        <?php if (count($business_images) > 0) { ?>
                                            <?php foreach ($business_images AS $business_image) { ?>
                                                <div class="col-md-3 outer-div">
                                                    <div class="business_img"  style="background: url(<?php echo get_template_directory_uri() . '/user_data/' . $business_image->image; ?>) center/cover no-repeat; ">
                                                        <input type="button" class="cross_remove" style="background: url( <?php echo get_template_directory_uri() . '/images/red_cross.png'; ?>) no-repeat; "/>
                                                        <input type="hidden" name="business_images[]" value="<?php echo $business_image->id; ?>" />
                                                        <!--<input type="hidden" name="submitPostEdit" value="Edit" />-->
                                                        <!--<input type="hidden" name="postChecked" value="<?php echo $postChecked; ?>" />-->
                                                        <!--<input type="hidden" name="delete_image" value="yes" />-->
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                    </div>
                    </ul>
                    <div id="buss-next" class="next-step-btn"><a href="javascript:;">NEXT STEP</a></div>
                </div>
            </div>
            <!--                <div class="buss-form-btm-bg"></div>
                        </div>-->

            <!-- Contact Paging Div Start-->

            <div id="contact-paging">
                <div class="buss-form-top-bg">
                    <h3 class="form-title">Consectetuer Adipiscing Elit, Sed Diam Nonummy Nibh Euismod</h3>
                </div>
                <div class="buss-mid-content" style="min-height: 765px;">
                    <div class="buss-form-nav">
                        <ul>
                            <li class="processed-business">Business Detail</li>
                            <li class="active-contact">Contact Detail</li>
                            <?php
                            if ($status == 1) {
                                ?>
                                <li>Profile</li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="buss-form-fields">
                        <div class="bus-left-fields">
                            <ul>
                                <li>
                                    <select class="myselect" id="countries" name="countries">
                                        <option disabled selected value>Country</option>
                                        <?php
                                        $countries_query = "SELECT * FROM `countries`";
                                        $countries = $wpdb->get_results($countries_query);
                                        foreach ($countries as $country) {
                                            ?>
                                            <option <?php echo ($userPlaceDetails[0]->country == $country->id) ? "selected" : ""; ?> value="<?php echo $country->id; ?>,<?php echo $country->isocode; ?>">
                                                <?php echo $country->name; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </li>
                                <li>
                                    <label class="buss-label" style="width: 26%; display: inline-block;">State</label>
                                </li>
                                <li>
                                    <select id="state" class="myselect" name="cont-state">
                                        <?php
                                        if (isset($_POST['submitPostEdit'])) {
                                            $states_query = "SELECT * FROM `states` WHERE country_id = " . $userPlaceDetails[0]->country;
                                            $states = $wpdb->get_results($states_query);
                                            foreach ($states as $state) {
                                                ?>
                                                <option <?php echo ($userPlaceDetails[0]->province == $state->id) ? "selected" : ""; ?> value="<?php echo $state->id; ?>">
                                                    <?php echo $state->name; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option disabled selected value>
                                                Select Country First
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <label class="buss-label" style="width: 26%;">City</label>
                                </li>
                                <li>
                                    <select id="city" class="myselect" name="bussCity">
                                        <?php
                                        if (isset($_POST['submitPostEdit'])) {
                                            $cities_query = "SELECT * FROM `cities` WHERE state_id = " . $userPlaceDetails[0]->province;
                                            $cities = $wpdb->get_results($cities_query);
                                            foreach ($cities as $city) {
                                                ?>
                                                <option <?php echo ($userPlaceDetails[0]->city == $city->id) ? "selected" : ""; ?> value="<?php echo $city->id; ?>">
                                                    <?php echo $city->name; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option disabled selected value>
                                                Select State First
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <label class="buss-label"> Address </label>
                                </li>
                                <li>
                                    <textarea name="cont-address" id="cont-address" class="cont-textarea" onblur="getLongLatiByAddress()"><?php echo $userPlaceDetails[0]->address; ?></textarea>
                                </li>
                                <li>
                                    <label class="buss-label">Zip</label>
                                </li>
                                <li>
                                    <input type="text" name="cont-zip" id="cont-zip" class="cont-input" onblur="getLongLatiByAddress()" value="<?php echo $userPlaceDetails[0]->postalcode; ?>" />
                                </li>
                                <li>
                                    <label class="buss-label">Phone</label>
                                </li>
                                <li>
                                    <input type="text" name="cont-phone" id="cont-phone" class="cont-input" value="<?php echo $userPlaceDetails[0]->phone; ?>" />
                                </li>
                                <li>
                                    <label class="buss-label"> Fax (optional) </label>
                                </li>
                                <li>
                                    <input type="text" name="cont-fax" id="cont-input" value="<?php echo $userPlaceDetails[0]->fax; ?>" />
                                </li>
                                <li>
                                    <label class="buss-label"> Latitude </label>
                                </li>
                                <li>
                                    <input type="text" name="cont-latitude" id="cont-input" class="cont-latitude" value="<?php echo $userPlaceDetails[0]->lati; ?>" />
                                </li>
                                <li>
                                    <label class="buss-label "> Longitude </label>
                                </li>
                                <li>
                                    <input type="text" name="cont-longitude" id="cont-input" class="cont-longitude" value="<?php echo $userPlaceDetails[0]->longi; ?>" />
                                </li>
                                <li>
                                  <!--<input type="submit" class="next-step-btn" id="contact-next" name="submit-cont" value="SUBMIT NOW" />-->
                                    <input type="hidden" name="post_id" value="<?php echo $userPlaceDetails[0]->id; ?>" />
                                </li>
                            </ul>
                        </div>
                        <?php
                        if ($status == 1) {
                            ?>
                            <div id="contact-prev" class="prev-step-btn"><a href="javascript:;">PREVIOUS STEP</a></div>
                            <div id="contact-next" class="next-step-btn"><a href="javascript:;">NEXT STEP</a></div>
                            <?php
                        } else {
                            ?>
                            <input id="contact-submit" type="submit" class="next-step-btn" name="submit-cont" value="SUBMIT NOW" />
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="buss-form-btm-bg"></div>
            </div>

            <?php
            if ($status == 1) {
                ?>
                <!-- social Paging DIv Start-->
                <div id="profile-paging" >
                    <div class="buss-form-top-bg">
                        <h3 class="form-title">Business Profile Details</h3>
                    </div>
                    <div class="buss-mid-content" style="min-height: 650px;">
                        <div class="buss-form-nav">
                            <ul>
                                <li class="processed-business">Business Detail</li>
                                <li class="processed-contact">Contact Detail</li>
                                <?php
                                if ($status == 1) {
                                    ?>
                                    <li class="active-social">Profile</li>
                                    <?php
                                }
                                ?>

                            </ul>
                        </div>
                        <div class="buss-form-fields">
                            <ul>
                                <li>
                                    <label class="buss-label">Business Logo</label>
                                </li>
                                <li>
                                    <input type="file" name="file_logo" class="buss-input" />
                                    <?php if ($userPlaceDetails[0]->logo) { ?><img src="<?php echo get_template_directory_uri() . '/user_data/' . $userPlaceDetails[0]->logo; ?>" width="40"> <?php } ?>
                                    <input type="hidden" name="file_logo-v" value="<?php echo $userPlaceDetails[0]->logo; ?>" class="buss-input" />
                                </li>
                                <li>
                                    <label class="buss-label">Special Deal (Image)</label>
                                </li>
                                <li>
                                    <input type="file" name="file_special_deal" class="buss-input" />
                                    <?php if ($userPlaceDetails[0]->special_deal) { ?><img src="<?php echo get_template_directory_uri() . '/user_data/' . $userPlaceDetails[0]->special_deal; ?>" width="40"> <?php } ?>
                                    <input type="hidden" name="file_special_deal-v" value="<?php echo $userPlaceDetails[0]->special_deal; ?>" class="buss-input" />
                                </li>
                                <li>
                                    <label class="buss-label">About Us</label>
                                </li>
                                <li>
                                    <textarea name="buss_about" id="buss_about" style="width: 50%;height: 150px;"><?php echo $userPlaceDetails[0]->about_us; ?></textarea>
                                </li>
                                <li>
                                    <label class="buss-label"> Description </label>
                                </li>
                                <li>
                                    <textarea name="buss-desc" id="buss-desc" class="buss-textarea"><?php echo $userPlaceDetails[0]->description; ?></textarea>
                                </li>
                                <li>
                                    <label class="buss-label">Website URL</label>
                                </li>
                                <li>
                                    <input type="text" name="bussSiteURL" id="bussSiteURL" class=" buss-input"  rquired="required" value="<?php echo $userPlaceDetails[0]->website; ?>" />
                                </li>

                            </ul>
                            <input type="submit" class="next-step-btn" name="submit-cont" value="SUBMIT NOW" />
                            <div id="profile-prev" class="prev-step-btn"><a href="javascript:;">PREVIOUS STEP</a></div>
                            <input type="hidden" name="post_id" value="<?php echo $place_edit_id; ?>" />
                        </div>
                    </div>
                    <div class="buss-form-btm-bg"></div>
                </div>
                <?php
            }
            ?>

            <!-- logo-image Paging DIv Start-->
            <!--      <div id="logo-image-paging">
                  <div class="buss-form-top-bg">
                    <h3 class="form-title">Consectetuer Adipiscing Elit, Sed Diam Nonummy Nibh Euismod</h3>
                  </div>
                  <div class="buss-mid-content">
                  <div class="buss-form-nav">
                    <ul>
                      <li class="processed-business">Business Detail</li>
                      <li class="processed-contact">Contact Detail</li>
                      <li class="processed-social">Social Detail</li>
                      <li class="active-logo-image">Logo & Image</li>
                    </ul>
                  </div>
                  <div class="buss-form-fields">
                  <ul>
                    <li>
                      <label class="buss-label">Upload Picture</label>
                    </li>
                    <li>
                      <input type="file" name="myfile" id="myfile" />
                      <input type="hidden" name="post_id" value="<?php echo @$post_id; ?>" />
                    </li>
                  </ul>
                  <input type="submit" class="next-step-btn" name="submit-cont" value="SUBMIT NOW" />
                </form>
              </div>
            </div>
            <div class="buss-form-btm-bg"></div>
            </div>-->

        </div>
        <!-- wrapper -->

    </div>
    <!-- body content -->

    <?php
} else {
    wp_redirect(site_url() . '/signin/');
}
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<script>
    jQuery(document).ready(function () {
        jQuery("#countries").change(function () {
            var string = jQuery("#countries").val();
            var array = string.split(',');
            var id = array[0];
            jQuery.post("<?php echo home_url() . '/ajax/' ?>",
                    {
                        country_id: id,
                        get_states: "get_states"
                    }, function (data) {
                console.log(data);
                jQuery("#state").html(data);
            });
        });
        jQuery("#state").change(function () {
            var id = jQuery("#state").val();
            jQuery.post("<?php echo home_url() . '/ajax/' ?>",
                    {
                        state_id: id,
                        get_cities: "get_cities"
                    }, function (data) {
                console.log(data);
                jQuery("#city").html(data);
            });
        });
    });


</script>
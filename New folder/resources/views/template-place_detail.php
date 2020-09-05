<?php
/**
 * Template Name: Place Details
*/


get_header(); ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/map.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/mapstyle.css" type="text/css"/>
<!--auto complete search field start -->
<script src="<?php bloginfo('template_url'); ?>/autocomplete/js/script.js"></script>
<!--auto complete search field end -->
<script type="text/javascript">
var map;
//var markers = [
//['Bondi Beach', -33.890542, 151.274856]
//];
function initializeMaps(pagename) {
    
	if (pagename == "home") {
		var myOptions = {
                mapTypeId: google.maps.MapTypeId.SATELLITE,
                    draggable: false,
                    scrollwheel: false,
                    disableDoubleClickZoom: true,
                    zoomControl: false,
        //mapTypeId: google.maps.MapTypeId.TERRAIN
        mapTypeControl: true,

        };
	} else if (pagename === "innerPage") {
		var myOptions = {
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    zoom:6,
                    //mapTypeId: google.maps.MapTypeId.TERRAIN
                    mapTypeControl: true,
                };
	}

    map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    var bounds = new google.maps.LatLngBounds();
    position: google.maps.ControlPosition.BOTTOM_CENTER
    for (i = 0; i < markers.length; i++) {
    var pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
    bounds.extend(pos);
    marker = new google.maps.Marker({
    position: pos,
    map: map,
    });
    google.maps.event.addListener(marker, "click", (function(marker, i) {
    return function() {
    infowindow.setContent(markers[i][0]);
    infowindow.open(map, marker);
    }
    })(marker, i));
    }
    if (markers.length > 1) {
        map.fitBounds(bounds);
    } else {
        map.setCenter(pos);
        map.setZoom(12);
    }
}

</script>
<!--API MAP Marker Script End -->

    
    <?php
global $wpdb;

$variables_array = explode('/', $_SERVER['REQUEST_URI']);
$key = preg_grep('/^place-id-(\w+)/i', $variables_array);
$key = array_values($key);
$place_id = explode('-', $key[0]);
$_GET['id'] = end($place_id);

$key1 = preg_grep('/^db-(\w+)/i', $variables_array);
$key1 = array_values($key1);
$db = explode('-', $key1[0]);
$_GET['db'] = end($db);
?>

<?php

$query = "";
if ($_GET['id'] !== null) {
    $id = $_GET['id'];
    $db = $_GET['db'];
    $query = "SELECT * FROM business_contacts_$db WHERE id = $id";
    $businessContactDetails = $wpdb->get_results($query);
} else {
    wp_redirect(site_url());
}
?>
<?php
if($_GET['save-searches'] == "checked"){
    $user_id = get_current_user_id();
    $user_search_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $user_search_url = 'http://'.$user_search_url;
    $results = get_usermeta( $user_id, 'user_save_search' );
    foreach ((array)$results as $result) {
        if ($result == $user_search_url) {
            //echo $result."<br/>";
            $record = 'duplicate';
            break;
         }
    }
    if ( $record != 'duplicate' ) {
        $data = array ('umeta_id' => NULL, 'user_id' => $user_id, 'meta_key' => 'user_save_search', 'meta_value' => $user_search_url );		
        $wpdb->insert( "wp_usermeta", $data, $format );
    }
}
$placeid = $businessContactDetails[0]->id;
$placeURL = home_url()."/places/?id=".$placeid;
//$fbShareUrl = "http://www.facebook.com/dialog/feed?app_id=1574373602790920&name=BizzIndex | ".$businessContactDetails[0]->name."&description="
//                .$businessContactDetails[0]->address.' '.$businessContactDetails[0]->city.' '.$businessContactDetails[0]->postalcode.' '
//                .$businessContactDetails[0]->province.' '.$businessContactDetails[0]->country.', '.$businessContactDetails[0]->category."&share_url="
//                .$placeURL."&caption=Bizindex&redirect_uri=$placeURL";
?>
<script type="text/javascript">
    window.fbAsyncInit = function () {
        // init the FB JS SDK
        FB.init({
            appId: '1574373602790920',
            status: true,
            xfbml: true
        });

    };

    // Load the SDK asynchronously
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    function FBShareOp(product_name, description, share_url) {
        var share_capt = 'Bizindex';
        FB.ui({
            method: 'feed',
            name: product_name,
            link: share_url,
//            picture: share_image,
            caption: share_capt,
            description: description

        }, function (response) {
            if (response && response.post_id) {
                window.close();
            }
            else {
            }
        });

    }


</script>
<div id="fb-root"></div>
<div class="search-content">
  <div class="wrapper clearfix">
    <div class="left-bar" style="min-height: inherit;">
      <script type="text/javascript">var result = [];</script>   
      <div class="search-result-list" style="min-height: inherit;">
        <div class="search-result-list-heading"><?php echo $businessContactDetails[0]->name; ?></div>
        <!-- search-result-list-heading -->
        <div class="placeDetailPage">
            <?php
            $facebookTitle = 'BizzIndex | '.$businessContactDetails[0]->name;
            $facebookDesc = $businessContactDetails[0]->address.' '.$businessContactDetails[0]->city.' '
                            .$businessContactDetails[0]->postalcode.' '.$businessContactDetails[0]->province.' '
                            .$businessContactDetails[0]->country.', '.$businessContactDetails[0]->category;
            ?>
            <div class="placesSocialButtonCont">
                <span class="stButton">
                    <span style="background-image: url(&quot;http://w.sharethis.com/images/facebook_32.png&quot;);" 
                          onclick="FBShareOp('<?php echo $facebookTitle; ?>', '<?php echo $facebookDesc; ?>', '<?php echo $placeURL; ?>');return false;"
                          class="stLarge">
                    </span>
                </span>
                <!--<span st_title='<?php // echo $businessContactDetails[0]->name; ?>' st_url='<?php // echo $placeURL; ?>' class='st_facebook_large'></span>-->
                <span class='st_twitter_large' st_title='<?php echo $businessContactDetails[0]->name; ?>' st_url='<?php echo $placeURL; ?>'></span>
                <span class='st_googleplus_large' st_title='<?php echo $businessContactDetails[0]->name; ?>' st_url='<?php echo $placeURL; ?>'></span>
                
                <?php  if ( is_user_logged_in() && $businessContactDetails[0]->user_id != 0 ) { ?>
                    <a class="save_this_search" href="<?php echo get_option('home')?>/messages/?send-message=user&user=<?php echo $businessContactDetails[0]->user_id; ?>">Send Message</a>
                    
                    <form method="GET" action="">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                        <input type="hidden" name="cs" value="search" />
                        <input type="hidden" name="keyword" value="<?php echo $businessContactDetails[0]->name; ?>" />
                        <input type="hidden" name="x" value="" />
                        <input type="hidden" name="y" value="" />
                        <input type="hidden" name="countries" value="<?php echo $businessContactDetails[0]->country; ?>" />
                        <input type="hidden" name="states" value="<?php echo $businessContactDetails[0]->province; ?>" />
                        <input type="hidden" name="zipcode" value="<?php echo $businessContactDetails[0]->postalcode; ?>" />
                        <input type="hidden" name="save-searches" value="checked" />
                        <input class="save_this_search" type="submit" value="Save this Place" name="submit">
                    </form>
                <?php } ?>
                <input class="save_this_search" type="button" value="How to get there" onClick="showdirection();">
            </div>
            <table width="100%">
                <tr>
                    <td width="50%">
                        <?php $fullAddress = $businessContactDetails[0]->address.", ".$businessContactDetails[0]->city.", "
                                .$businessContactDetails[0]->postalcode.", ".$businessContactDetails[0]->province.", "
                                .$businessContactDetails[0]->country;?>
                        <p><?php echo $businessContactDetails[0]->address ?></p>
                        <p><?php echo $businessContactDetails[0]->city ?>, <?php echo $businessContactDetails[0]->postalcode ?>,
                            <?php echo $businessContactDetails[0]->province ?>, <?php echo $businessContactDetails[0]->country ?></p>
                        <p><b>Category:</b> <?php echo $businessContactDetails[0]->category ?></p>
                    </td>
                    <td width="50%">
                        <p><b>Phone Number:</b> <?php echo $businessContactDetails[0]->phone ?></p>
                        <p><b>Email:</b> <?php echo $businessContactDetails[0]->email ?></p>
                        <p>
                            <b>Website:</b> 
                            <a href="<?php echo $businessContactDetails[0]->website ?>" target="_blank">
                                <?php echo $businessContactDetails[0]->website ?>
                            </a>
                        </p>
                    </td>
                </tr>
            </table>
            <p><?php echo $businessContactDetails[0]->description ?></p>
        </div>
        <?php
        $lat = (float) $businessContactDetails[0]->lati;
        $long = (float) $businessContactDetails[0]->longi;
        $mark_cont 	= $businessContactDetails[0]->address.", ".$businessContactDetails[0]->city;
        $mark_cont = wp_strip_all_tags($mark_cont);
        $mark_cont = str_replace(",", '', $mark_cont);
        ?>
        <script type="text/javascript">result.push(["<?php echo $mark_cont;?>", <?php echo $lat ;?>, <?php echo $long ;?>]);</script>
        <script>

function calculateAndDisplayRoute(start) {
  var directionsService = new google.maps.DirectionsService;
  directionsService.route({
    origin: start,
    destination: {lat: <?echo $lat ?>,lng:<?echo $long ?>},
    travelMode: google.maps.DirectionsTravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
        new google.maps.DirectionsRenderer({
                map: map,
                directions: response
              });
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}
            function showdirection () {
		// Check for geolocation support  
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
          calculateAndDisplayRoute({lat: position.coords.latitude, lng: position.coords.longitude});
//calculateAndDisplayRoute({lat: 40.634582, lng: 14.446774});
          //console.log(position.coords);
          });
      }
              /*  (function () {
                    var directionsService = new google.maps.DirectionsService(),
                    directionsDisplay = new google.maps.DirectionsRenderer(),
                    createMap = function (start) {
                        var travel = {
                                origin : (start.coords)? new google.maps.LatLng(start.lat, start.lng) : start.address,
                                destination : "<?php echo $fullAddress; ?>",
                                travelMode : google.maps.DirectionsTravelMode.DRIVING
                                // Exchanging DRIVING to WALKING above can prove quite amusing :-)
                            },
                            mapOptions = {
                                zoom: 10,
                                // Default view: downtown Stockholm
                                center : new google.maps.LatLng(<?php echo $lat ;?>, <?php echo $long ;?>),
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };

                        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
                        directionsDisplay.setMap(map);
//				directionsDisplay.setPanel(document.getElementById("map-directions"));
                        directionsService.route(travel, function(result, status) {
                            if (status === google.maps.DirectionsStatus.OK) {
                                directionsDisplay.setDirections(result);
                            }
                        });
                        var marker, i;
                        for (i = 0; i < result.length; i++) {
                            var pos = new google.maps.LatLng(result[i][1], result[i][2]);
//                            alert(result[i][1])
                            bounds.extend(pos);
                            marker = new google.maps.Marker({
                            position: pos,
                            map: map,
                            });
                            google.maps.event.addListener(marker, "click", (function(marker, i) {
                            return function() {
                            infowindow.setContent(markers[i][0]);
                            infowindow.open(map, marker);
                            }
                            })(marker, i));
                        }
                        map.setCenter(pos);
                        map.setZoom(12);
                    };

                    // Check for geolocation support	
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            // Success!
                            createMap({
                                    coords : true,
                                    lat : position.coords.latitude,
                                    lng : position.coords.longitude
                            });
                        }, 
                        function () {
                            // Gelocation fallback: Defaults to Stockholm, Sweden
                            createMap({
                                coords : false,
                                address : "<?php echo $fullAddress; ?>"
                            });
                        });
                    }
                    else {
                        // No geolocation fallback: Defaults to Lisbon, Portugal
                        createMap({
                            coords : false,
                            address : "<?php echo $fullAddress; ?>"
                        });
                    }
                })();*/
            }
        </script>
      </div>
    </div> 
    <!-- left bar -->
    <div class="right-bar"></div>
    
    <div class="right-bar-map-title">
   
        <div class="clear"></div>
             <div class="detail-slider">
    <ul class="thumbnails"> 
        <?php if(!empty($businessContactDetails[0]->image1)){ ?>
        <li class="span5">
            <a href="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image1; ?>" class="lightbox_trigger">
                <img src="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image1; ?>" width="60" height="60" alt="This is the title" />
            </a>
        </li>
        <?php } ?>
        <?php if(!empty($businessContactDetails[0]->image2)){ ?>
        <li class="span5">
            <a href="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image2; ?>" class="lightbox_trigger">
                <img src="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image2; ?>" width="60" height="60" alt="This is the title" />
            </a>    
        </li>
        <?php } ?>
        <?php if(!empty($businessContactDetails[0]->image3)){ ?>
        <li class="span5">
            <a href="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image3; ?>" class="lightbox_trigger">
                <img src="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image3; ?>" width="60" height="60" alt="This is the title" />
            </a>
        </li>
        <?php } ?>
        <?php if(!empty($businessContactDetails[0]->image4)){ ?>
        <li class="span5">
            <a href="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image4; ?>" class="lightbox_trigger">
                <img src="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image4; ?>" width="60" height="60" alt="This is the title" />
            </a>
        </li>
        <?php } ?>
        <?php if(!empty($businessContactDetails[0]->image5)){ ?>
        <li class="span5">
            <a href="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image5; ?>" class="lightbox_trigger">
                <img src="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image5; ?>" width="60" height="60" alt="This is the title" />
            </a>
        </li>
        <?php } ?>
        <?php if(!empty($businessContactDetails[0]->image6)){ ?>
        <li class="span5">
            <a href="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image6; ?>" class="lightbox_trigger">
                <img src="<?php echo get_template_directory_uri().'/user_data/'.$businessContactDetails[0]->image6; ?>" width="60" height="60" alt="This is the title" />
            </a>
        </li>
        <?php } ?>
        
     </ul>
    </div>
        <div class="right-bar-map-heading">Location Map</div>

        <script type="text/javascript">var markers = result;</script>
        <body onLoad="initializeMaps('innerPage')">
            <div id="map_canvas" style="width: 100%; height: 400px;"></div>
        </body>
    </div>

    <div class="clear"></div><!-- -->
    <div class="wrapper" style="max-width: 970px;">
        <div style="width: 100%;text-align: center;"><?php if ( ! dynamic_sidebar( 'ads3' ) ) : dynamic_sidebar('ads3'); endif; ?></div>
    </div>
    <div class="clear"></div><!-- -->

    <div class="right-bar-map-title">
        <div class="clear"></div>
        <hr/>
        <div class="right-bar-map-heading" style="margin: 20px 0 0;">Related Places</div>
        <div>
            <?php
            $titleWordsArray = explode(" ", $businessContactDetails[0]->name);
            foreach ($titleWordsArray as $key => $titleWordsArrayValue) {
                if (strlen($titleWordsArrayValue) <= 2) {
                    unset($titleWordsArray[$key]);
                }
            }
            $queryWhare = "";
            $loopCounter = 0;
            foreach ($titleWordsArray as $word) {
                if ($loopCounter == 0) {
                    $queryWhare .= "name LIKE '% $word %' OR name LIKE '% $word%' OR name LIKE '%$word %'";
                } else {
                    $queryWhare .= " OR name LIKE '% $word %' OR name LIKE '% $word%' OR name LIKE '%$word %'";
                }
                $loopCounter++;
            }
            if ($loopCounter == 0) {
                $queryWhare .= " id != $placeid";
            } else {
                $queryWhare .= ") AND (id != $placeid";
            }
            $query = "SELECT * FROM business_contacts_$db WHERE ($queryWhare) ORDER BY id DESC LIMIT 21";
//            echo $query;exit;
            ?>
            <ul class="gallery relatedPlacesContacts clearfix">
            <?php
            $businessContacts = $wpdb->get_results($query);
            if (count($businessContacts) > 0) {
                foreach ($businessContacts as $businessContact) {

                    ?>
                    <li>
                        <div class="search-result-list-content">
                            <!-- search-result-list-item -->
                            <div class="srl-caption">
                                <ul>
                                    <li class="srl-caption1">
                                        <?php // $placeURL = home_url()."/place/?".vefiry_string($businessContact->country).'/'.vefiry_string($businessContact->city).'/'.vefiry_string($businessContact->category).'/'.vefiry_string($businessContact->name).'/place-id-'.$businessContact->id; ?>
                                        <?php $placeURL = home_url()."/place/?".vefiry_string($businessContact->country).'/'.vefiry_string($businessContact->city).'/'.vefiry_string($businessContact->category).'/'.vefiry_string($businessContact->name).'/db-'.$db.'/place-id-'.$businessContact->id ?>
                                            
                                            <?php // $placeURL = home_url()."/places/?id=".$businessContact->id; ?>
                                        <a href="<?php echo $placeURL; ?>">
                                            <?php echo $businessContact->name; ?></a>
                                    </li>
<!--                                        <li class="srl-caption2"><img src="<?php // echo get_template_directory_uri(); ?>/images/stars.png" /></li>
                                    <li class="srl-caption3"><?php // echo get_field("custom_excerpt"); ?></li>-->
                                </ul>
                                <div class="srl-detail"><?php echo $businessContact->city; ?>
                                    <div class="srl-phone"><?php echo $businessContact->address; ?></div>
                                </div>
                                <div class="placesSocialButtonCont">
                                    <?php
                                    $facebookTitle = 'BizzIndex | '.$businessContact->name;
                                    $facebookDesc = $businessContact->address.' '.$businessContact->city.' '
                                                    .$businessContact->postalcode.' '.$businessContact->province.' '
                                                    .$businessContact->country.', '.$businessContact->category;
                                    ?>
                                    <span class="stButton">
                                        <span style="background-image: url(&quot;http://w.sharethis.com/images/facebook_32.png&quot;);" 
                                              onclick="FBShareOp('<?php echo $facebookTitle; ?>', '<?php echo $facebookDesc; ?>', 
                                              '<?php echo $placeURL; ?>');return false;" class="stLarge"></span>
                                    </span>
                                    <span class='st_twitter_large' st_title='<?php echo $businessContact->name; ?>' st_url='<?php echo $placeURL; ?>'></span>
                                    <span class='st_googleplus_large' st_title='<?php echo $businessContact->name; ?>' st_url='<?php echo $placeURL; ?>'></span>
                                </div>
                            </div>
                            <!-- search-result-list-item -->
                            <!-- search-result-list-item --> 
                        </div>
                        <!-- search-result-list-content --> 
                    </li>
                    <?php 
                }
            } else {
                echo "No Releated Places Found !!";
            }
            ?>
            <?php wp_reset_postdata();?>
 
          <!-- search result list --> 
       </ul>
        </div>
    </div>
  </div>
</div>
  <!-- right bar --> 

<?php //get_sidebar(); ?>
  <script>
jQuery(document).ready(function($) {
	
	$('.lightbox_trigger').click(function(e) {
		
		//prevent default action (hyperlink)
		e.preventDefault();
		
		//Get clicked link href
		var image_href = $(this).attr("href");
		
		/* 	
		If the lightbox window HTML already exists in document, 
		change the img src to to match the href of whatever link was clicked
		
		If the lightbox window HTML doesn't exists, create it and insert it.
		(This will only happen the first time around)
		*/
		
		if ($('#lightbox').length > 0) { // #lightbox exists
			
			//place href as img src value
			$('#content').html('<img src="' + image_href + '" />');
		   	
			//show lightbox window - you could use .show('fast') for a transition
			$('#lightbox').show();
		}
		
		else { //#lightbox does not exist - create and insert (runs 1st time only)
			
			//create HTML markup for lightbox window
			var lightbox = 
			'<div id="lightbox">' +
				'<p>Click to close</p>' +
				'<div id="content">' + //insert clicked link's href into img src
					'<img src="' + image_href +'" />' +
				'</div>' +	
			'</div>';
				
			//insert lightbox HTML into page
			$('body').append(lightbox);
		}
		
	});
	
	//Click anywhere on the page to get rid of lightbox window
	$('#lightbox').live('click', function() { //must use live, as the lightbox element is inserted into the DOM
		$('#lightbox').hide();
	});

});
</script>
<?php get_footer(); ?>
<div id="lightbox">
    <p>Click to close</p>
    <div id="content">
        <img src="#" />
    </div>
</div>
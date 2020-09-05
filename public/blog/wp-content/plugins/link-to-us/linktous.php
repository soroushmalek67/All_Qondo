<?php
/*
Plugin Name: Link to us
Plugin URI: http://seo.uk.net/link-to-us-widget/
Description: SEO - Do you need Backlinks? Let your visitors link back to your site with this simple but effective seo widget.
Author: Seo UK Team
Version: 1.1.3
Author URI: http://seo.uk.net
*/

function link_to_us_control() {

  $options = get_ltu_options();

  if ($_POST['wp_ltu_Submit']){

    $options['wp_ltu_WidgetTitle'] = htmlspecialchars($_POST['wp_ltu_WidgetTitle']);
    $options['wp_ltu_ltjtext_wlink'] = htmlspecialchars($_POST['wp_ltu_ltjtext_wlink']);
    update_option("widget_link_to_us", $options); 

}
?>
  <p>Increase search engine rankings in Google, Bing & Yahoo using our seo services. Visit <a href="http://seo.uk.net" title="Link will open in a new window" target="_blank">www.seo.uk.net</a> for more information.</p>
  <p><strong>Choose a title for the widget:</strong></p>
  <p>
    <label for="wp_ltu_WidgetTitle">Text Title: </label>
    <input type="text" id="wp_ltu_WidgetTitle" name="wp_ltu_WidgetTitle" value="<?php echo ($options['wp_ltu_WidgetTitle'] =="" ? "Link to this page" : $options['wp_ltu_WidgetTitle']); ?>" />
  </p>
 
 <p>
    <label for="wp_ltu_ltjtext_wlink">Please support our plugin by showing a small link under widget.</label><p align="right">Activate it: 
    <input type="checkbox" id="wp_ltu_ltjtext_wlink" name="wp_ltu_ltjtext_wlink" <?php echo ($options['wp_ltu_ltjtext_wlink'] == "on" ? "checked" : "" ); ?> /></p>
  </p>
  
  <p>
    <input type="hidden" id="wp_ltu_Submit" name="wp_ltu_Submit" value="1" />
  </p>

<?php
}
function ltuinst_activate() { 
add_option('inredirect_do_activation_redirect', true); wp_redirect('../wp-admin/widgets.php');
 };

function get_ltu_options() {

  $options = get_option("widget_link_to_us");
  if (!is_array( $options )) {
    $options = array(
                     'wp_ltu_WidgetTitle' => 'Link to this page',
                     'wp_ltu_ltjtext_wlink' => ''
                    );
  }
  return $options;
}

function get_infosltu ($sex, $unique, $hit=false) {

  global $wpdb;
  $table_name = $wpdb->prefix . "sc_log";
  $options = get_ltu_options();
  $sql = '';
  $stime = time()-$sex;
  $sql = "SELECT COUNT(".($unique ? "DISTINCT IP" : "*").") FROM $table_name where Time > ".$stime;

  if ($hit)
   $sql .= ' AND is_hitwit = 1 ';

  if ($options['wp_ltu_ltjtext_bots_filter'] > 1)
      $sql .= ' AND IS_BOT <> 1';

  return number_format_i18n($wpdb->get_var($sql));
  }

function viewwid() {

  global $wpdb;
  $options = get_ltu_options();
  $table_name = $wpdb->prefix . "sc_log";

?>

<div align="center">
<?php
$currenturl = get_permalink( $id, $leavename );
echo '<textarea cols="25" rows="6" >&lt;a href=&quot;' . $currenturl . '&quot;&gt;' . $currenturl . '&lt;/a&gt;</textarea>
';
?> </div>

<?php if ($options['wp_ltu_ltjtext_wlink'] == "on") { 
?>
<br /><p align="right"><small>Widget by <a href="http://seo.uk.net/" target="_blank">http://seo.uk.net/</a></small></p>
<?php } ?>

<?php
}

function widget_link_to_us($args) {
  extract($args);

  $options = get_ltu_options();

  echo $before_widget;
  echo $before_title.$options["wp_ltu_WidgetTitle"];
  echo $after_title;
  viewwid();
  echo $after_widget;
}


function is_hitwit ($ip) {

   global $wpdb;
   $table_name = $wpdb->prefix . "sc_log";

   $user_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name where ".time()." - Time <= 1000 and IP = '".$ip."'");

   return $user_count == 0;
}

function wp_ltu_install_db () {
   global $wpdb;

   $table_name = $wpdb->prefix . "sc_log";
   $gTable = $wpdb->get_var("show tables like '$table_name'");
   $gColumn = $wpdb->get_results("SHOW COLUMNS FROM ".$table_name." LIKE 'IS_BOT'");
   $hColumn = $wpdb->get_results("SHOW COLUMNS FROM ".$table_name." LIKE 'is_hitwit'");

   if($gTable != $table_name) {

      $sql = "CREATE TABLE " . $table_name . " (
           IP VARCHAR( 17 ) NOT NULL ,
           Time INT( 11 ) NOT NULL ,
           IS_BOT BOOLEAN NOT NULL,
           is_hitwit BOOLEAN NOT NULL,
           PRIMARY KEY ( IP , Time )
           );";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

   } else {
     if (empty($gColumn)) {  //old table version update

       $sql = "ALTER TABLE ".$table_name." ADD IS_BOT BOOLEAN NOT NULL";
       $wpdb->query($sql);
     }

     if (empty($hColumn)) {  //old table version update

       $sql = "ALTER TABLE ".$table_name." ADD is_hitwit BOOLEAN NOT NULL";
       $wpdb->query($sql);
     }
   }
}

function link_to_us_init() {

  wp_ltu_install_db ();
  register_sidebar_widget(__('Link to us'), 'widget_link_to_us');
  register_widget_control(__('Link to us'), 'link_to_us_control', 300, 200 );
}

function uninstall_ltj(){

  global $wpdb;
  $table_name = $wpdb->prefix . "sc_log";
  delete_option("widget_link_to_us");
  delete_option("wp_ltu_WidgetTitle");
  delete_option("wp_ltu_ltjtext_wlink");

  $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

function add_ltu_stylesheet() {
            wp_register_style('scStyleSheets', plugins_url('gt-styles.css',__FILE__));
            wp_enqueue_style( 'scStyleSheets');
}

add_action("plugins_loaded", "link_to_us_init");
add_action('wp_print_styles', 'add_ltu_stylesheet');

register_deactivation_hook( __FILE__, 'uninstall_ltj' );
register_activation_hook( __FILE__,'ltuinst_activate');
add_action('admin_init', 'inredirect_redirect');

function inredirect_redirect() {
if (get_option('inredirect_do_activation_redirect', false)) { delete_option('inredirect_do_activation_redirect'); wp_redirect('../wp-admin/widgets.php');
}
}

?>
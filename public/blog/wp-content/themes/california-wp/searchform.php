<?php
	GLOBAL $webnus_options;
	$live_search = ($webnus_options->webnus_enable_livesearch() == 1)?'live-search':'';
?>

<form role="search" action="<?php echo esc_url(home_url( '/' )); ?>" method="get" >
 <div>
   <input name="s" type="text" placeholder="<?php _e('Enter Keywords...','WEBNUS_TEXT_DOMAIN'); ?>" class="search-side <?php echo esc_attr($live_search) ?>" >
</div>
</form>
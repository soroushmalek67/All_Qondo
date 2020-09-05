<?php 
GLOBAL $webnus_options;
function webnus_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
<div class="comment-info">	
<?php echo get_avatar( $comment, 90 ); ?>
<cite>
<?php comment_author_link() ?> <?php _e('Says','WEBNUS_TEXT_DOMAIN'); ?>: 
<span class="comment-data"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F j, Y'); ?> at <?php comment_time('g:i a'); ?></a><?php edit_comment_link('Edit',' | ',''); ?></span>
</cite>
</div>
<div class="comment-text">
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation.','WEBNUS_TEXT_DOMAIN'); ?></em></p>
<?php endif; ?>
<?php comment_text() ?>
<div class="reply">
<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
</div>	
</div>
<?php
}
?><div class="comments-wrap">
<div class="commentbox">
<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','WEBNUS_TEXT_DOMAIN'); ?></p>
<?php
return;
}
?>
<div class="post-bottom-section">
<div class="right">
<?php if ( have_comments() ) : ?>
<h4 class="comments-title">
<strong><?php _e('Comments','WEBNUS_TEXT_DOMAIN'); ?></strong>
</h4>
<div class="navigation">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>
<ol class="commentlist">
<?php wp_list_comments('callback=webnus_comments'); ?>
</ol>
<div class="navigation">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>
<?php endif; // have_comments() ?>
<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :	?>
<p class="no-comments"><?php _e( 'Comments are closed.', 'WEBNUS_TEXT_DOMAIN' ); ?></p>
<?php endif; ?>
</div>
</div>
<?php comment_form(); ?>
</div>
</div>
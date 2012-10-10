<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header();
if($post->ID==41){
 include_once(get_template_directory()."/sidebar-electronics_gadgets.php"); 
 }else if($post->ID==58){
 include_once(get_template_directory()."/sidebar-login.php"); 
}else if($post->ID==5){
 include_once(get_template_directory()."/sidebar-signup.php"); 
 }else if($post->ID==44){
  include_once(get_template_directory()."/sidebar-signup2.php"); 
}else if($post->ID==22){
 include_once(get_template_directory()."/sidebar-forget_password.php"); 
}else if($post->ID==38){
 include_once(get_template_directory()."/sidebar-viewprofile.php");
}else if($post->ID==61){
 //get_sidebar('editprofile'); 
 include_once(get_template_directory()."/sidebar-editprofile.php");
}else if($post->ID==97){
 include_once(get_template_directory()."/sidebar-contact.php");
}else if($post->ID==99){
 include_once(get_template_directory()."/sidebar-unsub.php");
}else if($post->ID==371){
 include_once(get_template_directory()."/sidebar-local-do-gooders.php");
}else if($post->ID==373){
 include_once(get_template_directory()."/sidebar-list-of-things.php");
}else if($post->ID==383){
 include_once(get_template_directory()."/sidebar-email-to-frd.php");
}else if($post->ID==431){
 include_once(get_template_directory()."/sidebar-unsubscribe-member.php");
}else{
 ?>

<div class="content-cont-inner">

  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_front_page() ) { ?>
    <h2 class="entry-title">
      <?php the_title(); ?>
    </h2>
    <?php } else { ?>
    <h1 class="entry-title">
      <?php the_title(); ?>
    </h1>
    <?php } ?>
    <div class="entry-content">
      <?php the_content(); ?>
      <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
      <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
    <!-- .entry-content -->
  </div>
  <!-- #post-## -->
  <?php //comments_template( '', true ); ?>
  <?php endwhile; ?>
</div>
<!-- #content -->
<?php } ?>
<?php get_footer(); ?>

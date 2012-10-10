<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 
/*echo "<script>location.replace('http://localhost/projects/aditingo/".DEFAULT_CITY."')</script>";*/?>
<div class="content-cont">
<div class="yourcity-bg"><a href="<?php echo get_page_link(5); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/signupnow.png" width="364" height="83" /></a></div>
<div class="category-col"><h1 class="titgray">TODAY'S HOT TOPIC</h1>
  
     <? include(get_template_directory()."/includes/hot_post.php");?>
  </div>
   <div class="category-col"><h1 class="titgray">POPULAR POSTS</h1>
     <? include(get_template_directory()."/includes/popular_post.php");?>
   </div>
  <div class="category-col m-rignone">
    <h1 class="titblue">SEARCH ADTINGO</h1>
    <? include(get_template_directory()."/includes/right_search.php");?>

  </div>
			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 //get_template_part( 'loop', 'index' );
			?>
</div><!-- #container -->
<?php get_footer(); ?>

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
echo "<script>location.replace('http://ec2-75-101-211-185.compute-1.amazonaws.com/category/atlanta')</script>";
get_header(); ?>
<div class="content-cont">
<div class="yourcity-bg"><a href="#"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/signupnow.png" width="364" height="83" /></a></div>
<div class="category-col"><h1 class="titgray">TODAY'S HOT TOPIC</h1>
  
    <div class="category-cont"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/today-hot-img.jpg" width="280" height="140" /><h3>This is a Title</h3><p>This is an entry to the title and a button on bottom. Brighten your inbox with all the new, unknown and under appreciated locations in your area. Or else you are going to regret it.</p><p><a href="#" class="read-more">Read More</a></p>
    </div>
  </div>
   <div class="category-col"><h1 class="titgray">POPULAR POSTS</h1>
     <div class="category-cont">
       <dl class="popular-post">
         <dt><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/thube.jpg" /></dt>
         <dd><h2 class="tit">This is a Title</h2>This is an entry to the title and a button on right... <a href="#" class="read-more">Read More</a></dd>
         <dt><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/thube.jpg" /></dt>
         <dd><h2 class="tit">This is a Title</h2>This is an entry to the title and a button on right... <a href="#" class="read-more">Read More</a></dd>
         <dt><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/thube.jpg" /></dt>
         <dd><h2 class="tit">This is a Title</h2>This is an entry to the title and a button on right... <a href="#" class="read-more">Read More</a></dd>
         <dt><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/thube.jpg" /></dt>
         <dd><h2 class="tit">This is a Title</h2>This is an entry to the title and a button on right... <a href="#" class="read-more">Read More</a></dd>
                </dl></div>
   </div>
  <div class="category-col m-rignone">
    <h1 class="titblue">SEARCH ADTINGO</h1>
    <div class="search-bg"><input type="text" name="textfield2" id="textfield2" />
    <select name="select" id="select">
      <option>Los Angeles</option>
    </select><select name="select" id="select" class="m-left10">
      <option>All Topics</option>
    </select>
    <span class="left"><input type="submit" name="button" id="button" value="Submit" class="search-button" /></span><span class="right"><a href="#"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/view-article.jpg" /></a></span></div>
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

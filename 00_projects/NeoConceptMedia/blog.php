<?

/**
*
*  project  NCM_Ads
*  @file wp_blog.php
*  @user  pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   Blog of NCM_Ads
*
*         Blog based in Wordpress. The Blog should be installed into DB , an the tables should start with "ncm_blog_wp_"
*
*
*
*

*/


require_once("functions.php");
require_once ("header.php");
require('./blog/wordpress/wp-blog-header.php');

?>



<?  //CONTENT




echo '<div class="content">';
require_once ("blog_sidebar.php");
echo '<div class="content_text">';


if (isset($_REQUEST['previous_blog_entry'])) {
$previous_blog_entry = mysql_real_escape_string($_POST["previous_blog_entry"]);
} else {
$previous_blog_entry = 0;
}

if (isset($_REQUEST['next_blog_entry'])) {
$next_blog_entry= mysql_real_escape_string($_POST["next_blog_entry"]);
} else {
$next_blog_entry = 0;
}




write_log("Visit to Blog!");



// Get the last 3 posts.
global $post;

$count_posts = wp_count_posts();  // get number of total posts
$args = array( 'posts_per_page' => 5 );
$myposts = get_posts( $args );

foreach( $myposts as $post ) :	setup_postdata($post); ?>



<h1>  <? the_title(); ?> </h1>
<a> <?php the_content() ?> </a>

<?php endforeach; ?>

<?


echo '<div class="blog_nav_footer">';
echo "\n";
echo '<div id="nav_button_previous">';
echo '<form class="nav_button_previous" method="POST" action="blog">';
echo "\n";
echo '<input class="nav_button_previous" type=hidden name=case value="'.$previous_blog_entry.'">';
echo "\n";
echo '<input class="nav_button_previous" type=submit  value="previous post"></form>'; 
echo "\n";
echo '</div>';
echo '<div id="nav_button_next">';
echo '<form class="nav_button_next" method="POST" action="blog">';
echo "\n";
echo '<input class="nav_button_next" type=hidden name=case value="'.$next_blog_entry.'">';
echo "\n";
echo '<input class="nav_button_next" type=submit  value="next post"></form>'; 
echo '</div>';
echo '</div>';






if (user_logged_in() == 1){

//   echo '<div class="content_text" ><h1>  Your user is logged in and you have access to registered content </h1></div>';
  
  }
   else{}






?>

<?
require_once ("footer.php")

?>
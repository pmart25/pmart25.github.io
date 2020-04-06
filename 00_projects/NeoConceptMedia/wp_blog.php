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
*         Blog based in Wordpress. The Blog should be installed into DB a7010140_db, an the tables should start with "ncm_blog_wp_"
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



write_log("Visit to pub_index/index.php");



// Get the last 3 posts.
global $post;
$args = array( 'posts_per_page' => 5 );
$myposts = get_posts( $args );

foreach( $myposts as $post ) :	setup_postdata($post); ?>
<!--<a href="
<?php // the_permalink() ?>
" rel="bookmark" title="Permanent Link to 
<?php  //the_title_attribute(); ?>
">
<?php // the_title(); ?>
</a><br /> --!>


<h1>  <? the_title(); ?> </h1>
<a> <?php the_content() ?> </a>

<?php endforeach; ?>

<?


echo '<div class="blog_nav_footer">';
echo "\n";
echo '<div class="nav_button_previous"> previous post ';
echo "\n";
echo '</div>';
echo '<div class="nav_button_next"> next post ';
echo "\n";
echo '</div>';
echo "\n";
echo '</div>';






if (user_logged_in() == 1){

//   echo '<div class="content_text" ><h1>  Your user is logged in and you have access to registered content </h1></div>';
  
  }
   else{}






?>

<?
require_once ("footer.php")

?>
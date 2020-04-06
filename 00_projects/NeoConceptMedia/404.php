<?

/**
*
*  project  NCM_Ads
*  @file 404.php
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   Page not Found of NCM_Ads
*/


require_once("functions.php");
require_once ("header.php");

?>



<?  //CONTENT




echo '<div class="content">';
require_once ("sidebar.php");
echo '<div class="content_text">';



write_log("Page not Found!");

/*
echo '<p>Los colores para Neo Concept Media son turquesa: #00b19b  y  magenta: #ff0067</p>';
*/

echo '<h1>Opps!</h1>

<h2> We can not seem fo find the page you are looking for </h2>

<p> Error Code: 404 </p>

</br>
</br>
</br></br></br>
</br>

';

if (user_logged_in() == 1){

//   echo '<div class="content_text" ><h1>  Your user is logged in and you have access to registered content </h1></div>';
  
  }
   else{}






?>

<?
require_once ("footer.php")

?>
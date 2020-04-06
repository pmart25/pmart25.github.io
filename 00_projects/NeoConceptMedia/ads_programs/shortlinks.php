<?


/**
*
*  project  NCM_Ads
*  @file publisher
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   functions for advertisers
*/


ini_set ("include_path", "C:\xampp\htdocs\NCM.Website\000_dev\00_pub_test_post\pub_test_post_friendly_links");

set_include_path (get_include_path(). ";". "C:\\xampp\\htdocs\\NCM.Website\\000_dev\\00_pub_test_post\\pub_test_post_friendly_links");

echo get_include_path();
?>


<?
require_once ("header.php");
require_once("functions.php");


?>



<?  //CONTENT




echo '<div class="content">';
require_once ("sidebar.php");
echo '<div class="content_text">';


echo '<h1> Publisher </h1>';



if (user_logged_in() == 1)


{   //start if login

echo '<p> Add new Revenue Streams to monetize your Web. </p>';
    
	
	
if (isset($_REQUEST['case'])) {
$case = mysql_real_escape_string($_POST["case"]);
} else {
$case = "99";
}
 
	  




$GLOBALS ["debug_mode"] = 0;



  //echo '</div>';
   echo "\n<br>"; 
   echo "\n<br>"; 
   echo "\n<br>";    



 if  ( $case == 1 ) {

			
		if (isset($_REQUEST['shortUrl_code'])) {
		$shortUrl_code = mysql_real_escape_string($_POST["shortUrl_code"]);
		} else {
		$shortUrl_code = "-1";
		}
		
		if ($shortUrl_code != -1) {
		
		
		   $url = $shortUrl->shortCodeToUrl($shortUrl_code);
		   header("HTTP/1.1 301 Moved Permanently");
		   header("Location: " . $url); 
		   //header("Refresh:0; url=".$url);
		
		} else {
		
		 echo "<p> Error in shortcode </p>";
		
		}
		  


		
		
		

}

require_once("header.php");





  //CONTENT




echo '<div class="content">';
require_once ("sidebar.php");
echo '<div class="content_text">';



write_log("Visit to pub_index/index.php");

/*
CONTENT WITHOUT LOGGIN
*/


	
	if   ( $case == 0) { 
	
	 /**
	  *  @fucntion generate_shortlinks
	  *  
	  *  @brief generate shortlinks
	  *  
	  *  
	  *  
	  *  
	  */
	 
	echo "<p> type your objective url: </p>";
	
	echo '<div id="ad_form2"><form class="ad_form2" method=POST name="gen_shortlinks" action="gen_shortlinks.php">';
		echo "\n";
		echo '<input class="ad_form2" type=hidden name="case" value="5">';
		echo "\n";
		echo '<input class="ad_form2"  type="text" size="50" name="url" value="">';
		echo "\n";
		echo '<br>';
		echo '<br><br>';
		echo '<input class="ad_form2" type="submit" class="submit_style" value="Create campaign" >';
		echo "\n";
		echo '</from></div>';
		
		
		if ( $GLOBALS ["debug_mode"] == TRUE) {
		
		echo "<p> type your shortcode url: </p>";
	
	echo '<div id="ad_form2"><form class="ad_form2" method=POST name="go_to_short_code_page" action="gen_shortlinks.php">';
		echo "\n";
		echo '<input class="ad_form2" type=hidden name="case" value="1">';
		echo "\n";
		echo '<input class="ad_form2"  type="text" size="50" name="shortUrl_code">';
		echo "\n";
		echo '<br>';
		echo '<br><br>';
		echo '<input class="ad_form2" type="submit" class="submit_style" value="Go to shortcode redirection" >';
		echo "\n";
		echo '</from></div>';	
		
	 }
		
		$sql = 'SELECT * FROM ads_short_urls';
					$asql = mysql_query($sql);
					if (!$asql)
					{
						die('mysql consult no valid: ' . mysql_error());
					}
	   	$asql_list = mysql_fetch_array($asql);
		//$shortcode = $asql_list[0];
		
		while ($asql_list = mysql_fetch_row($asql)){
		
		 echo "shortlink: <p>".$asql_list[2]."</p>";
		
		
		}
		
		echo '<a href="gen_shortlinks.php"> Shortlinks main page </a>';
	
	
	
	} elseif ( $case == 1) {
	
	

	  /**
	   *  
	   *  
	   *   case == 1 should be declared at the beginning this file.
	   *  
	   */
	   
	   /*
	   
	   if ($GLOBALS ["debug_mode"] == TRUE ) {
	   
	   	
		if (isset($_REQUEST['shortUrl_code'])) {
		$shortUrl_code = mysql_real_escape_string($_POST["shortUrl_code"]);
		} else {
		$shortUrl_code = "-1";
		}
		
		if ($shortUrl_code != -1) {
		
		
		   $url = $shortUrl->shortCodeToUrl($shortUrl_code);
		   
		   echo ("url is: " .$url); 
		   //header("Refresh:0; url=".$url);
		
		} else {
		
		 echo "<p> Error in shortcode </p>";
		
		}
	   
	   
	   
	   
	   
	   } 
		*/
		
	} elseif ( $case == 5) {
	
	/**
	 *  
	 *  @function gen_shortlinks case5 
	 *  @brief commands of generate shortlinks (come from case 1) and add this entry to ads_shortlinks
	 *        
	 *  
	 *  
	 */
	
	if ( $GLOBALS["debug_mode"] == TRUE) {
	
	 echo "<p> case 5 </p>";
	}
	
	$url = mysql_real_escape_string($_POST["url"]);
	$url = urldecode($url);
	var_dump($url);
	echo "<p> url is ".$url. "</p>";
	
	$generated_shortcode = $shortUrl->urlToShortcode($url);
	
	
	
	echo "</br>";						
	echo "<p> Added short code without problems </p>";
	echo "<p>  short code is:  ".$generated_shortcode." </p>";
	echo "</br>";
	echo '<a href="gen_shortlinks.php"> Shortlinks main page </a>';
	
	} else {}

if (user_logged_in() == 1){

/*
CONTENT  IF USER IS LOGGED IN
*/


  }
   else{}






?>

<?
require_once ("footer.php");

?>

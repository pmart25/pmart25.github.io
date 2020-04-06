<?

/**
*
*  project  NCM_Ads
*  @file shortlinks
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   shortlinks to NCM_Ads
*
*
*  
*
*
*
*
*
*
*
*/

 
require_once ("functions.php");
 
 
 
$GLOBALS ["debug_mode"] = 0;
 


$actual_link = "http://localhost/NCM.Website/000_dev/000_release_candidate/rep.php";
 
try {

    $pdo = new PDO("mysql" . ":host=" . DB_SERVER . ";dbname=" . connection,
        DB_USER, DB_PASS);
		
	
}
catch (\PDOException $e) {
    header("<p> Error in establish DB connection </p>");
    exit;
}

    $shortUrl = new ShortUrl($pdo);
	//$shortUrl = new ShortUrl();
    if (isset($_REQUEST['case'])) {
    $case = mysql_real_escape_string($_POST["case"]);
    } else {
    $case = "0";
    }

/*


Here Will be define case =1


*/

//if ( ( $GLOBALS ["debug_mode"] == FALSE  )&& ( $case == 1 )) {


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
	
	echo '<div id="ad_form2"><form class="ad_form2" method=POST name="gen_shortlinks" action="shortlinks">';
		echo "\n";
		echo '<input class="ad_form2" type=hidden name="case" value="5">';
		echo "\n";
		echo '<input class="ad_form2"  type="text" size="50" name="url" value="">';
		echo "\n";
		echo '<br>';
		echo '<br><br>';
		echo '<input class="ad_form2" type="submit" class="submit_style" value="Create shortcode" >';
		echo "\n";
		echo '</form></div>';
		
		
		if ( $GLOBALS ["debug_mode"] == TRUE) {
		
		echo "<p> type your shortcode url: </p>";
	
	echo '<div id="ad_form2"><form class="ad_form2" method=POST name="go_to_short_code_page" action="shortlinks">';
		echo "\n";
		echo '<input class="ad_form2" type=hidden name="case" value="1">';
		echo "\n";
		echo '<input class="ad_form2"  type="text" size="50" name="shortUrl_code">';
		echo "\n";
		echo '<br>';
		echo '<br><br>';
		echo '<input class="ad_form2" type="submit" class="submit_style" value="Go to shortcode redirection" >';
		echo "\n";
		echo '</form></div>';	
		
	 }
		
		$sql = 'SELECT short_code FROM ads_pub_shortlinks WHERE created_by = "'.get_ads_user_id().'" ';
					$asql = mysql_query($sql);
					if (!$asql)
					{
						die('mysql consult no valid: ' . mysql_error());
					}
	   	$asql_list = mysql_fetch_array($asql);
		//$shortcode = $asql_list[0];
		
		while ($asql_list = mysql_fetch_row($asql)){
		
		 echo "shortlink: <p>".$actual_link."?n=".$asql_list[0]."</p>";
		 
		echo '<form class="button_link" method="POST" action="shortlink">';
		echo "\n";
		echo '<input class="button_link" type=hidden name=case value=6>';
		echo "\n";
		echo '<input class="button_link" type=hidden name=short_code value='.$asql_list[0].'>';
		echo "\n";				
		echo '<input class="button_link" type=submit  value="Delete this Short Code"></form>';
		
		
		}
		
		
	
	
	
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
	
	if ( $GLOBALS["debug_mode"] == TRUE) {
	var_dump($url);
	echo "<p> url is ".$url. "</p>";
	$result_filter = filter_var($url, FILTER_VALIDATE_URL);
	echo "value of filter: ";
	var_dump($result_filter );
	
	}
	
	
	if (!filter_var($url, FILTER_VALIDATE_URL)) 
	{
	
	 $url= "http://" . $url;
	
	}
	
	
	
	$sql = 'SELECT * FROM ads_pub_shortlinks WHERE created_by = "'.get_ads_user_id().'" ';
	$asql = mysql_query($sql);
	if (!$asql)
	{
		die('mysql consult no valid: ' . mysql_error());
	}
	$asql_list = mysql_fetch_array($asql);
	//$shortcode = $asql_list[0];
	
	if ( mysql_num_rows($asql) <  $GLOBALS ["max_shortlinks_by_publisher"]) {
	
	
	$generated_shortcode = $shortUrl->urlToShortcode($url);
	
	
	
	
	echo "</br>";						
	echo "<p> Short code added correctly. </p>";
	echo "<p> Short code is:  ".$generated_shortcode." </p>";
	echo "</br>";
	
	
	} else {
	
	echo "</br>";
	echo "<p> Maximal of shortcodes by user reached. If you need generate more shortcodes, please contact with Helpdesk. </p>";
	echo "</br>";
	
	}
	
	
	
	
	} elseif ( $case == 6 ) {
	

	$short_code = mysql_real_escape_string($_POST["short_code"]);
	$short = urldecode($short_code);
	$sql = 'DELETE  FROM ads_pub_shortlinks WHERE short_code = "'.$short_code.'" ';
	$asql = mysql_query($sql);
	if (!$asql)
	{
		die('mysql consult no valid: ' . mysql_error());
	} else {
	
	echo "</br>";						
	echo "<p> Short code deleted correctly. </p>";
	echo "</br>";
	}
	
	
	

	
	} else {}

if (user_logged_in() == 1){

/*
CONTENT  IF USER IS LOGGED IN
*/

echo '<a href="shortlinks"> Shortlinks main page </a>';

  }
   else{}







require_once ("footer.php")


// address to functions.php

?>
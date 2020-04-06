<?




/**
*
*  project  NCM_Ads
*  @file functions.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief  funtions of NCS_Ads
*/




require_once ("config.php");
/**
*
*
*   Define jQuery library
*
*
*/


  
/**
*
*  @function define_jquery()
*  @brief define jquery for avoid errors in html pages
*               
*
*
*
*  @return nothing
*/  
  
  
  
function define_jquery() {

echo '<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';

}
//init session in every file

//global $GLOBALS ["local"] = 1;
//global $GLOBALS ["debug_mode"] = 0;

session_start();

function user_logged_in() {

if (isset($_SESSION['userid']) == 1){

   return 1;
   }
   else{
   return 0;   
   }

  
  } 

  
  

  
/**
*
*  @function get_ads_user_id()
*  @brief get ads_user_id, whicht can be found into the table ads_user inside mysql database
*               ads_db. It will be used for verify the get_data
*
*
*
*  @return int ads_user_id
*/  
  
  
  
function get_ads_user_id() {
	
	$user_id =  $_SESSION['userid'];
	return $user_id;
	
	
	
	
}  


  
/**
*
*  @function get_ads_user_email_from_id()
*  @brief get ads_user_id, whicht can be found into the table ads_user inside mysql database
*               ads_db. It will be used for verify the get_data
*
*
*
*  @return int ads_user_id
*/  
  
  
  
function get_ads_user_email_from_id($user_id) {
	
	
	$sql = "SELECT email FROM ads_users WHERE id_user = ".$user_id;
	$asql = mysql_query($sql);
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}
	$asql_list = mysql_fetch_array($asql);
    $user_email = $asql_list[0];
	return $user_email;
	
	
	
	
}  


  


/**
*
*  @function get_client_ip()
*  @brief get client ip address from rep.php
*               
*
*
*
*  @return string client_ip
*/  

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

/**
*
*  @function get_client_browser()
*  @brief get client browser from rep.php
*               
*
*
*
*  @return string client_browser
*/


function get_client_browser()
 {

$browser = $_SERVER['HTTP_USER_AGENT'];

return $browser;	
	
}

/**
*
*  @function get_client_country()
*  @brief get client country from rep.php
*               
*
*
*
*  @return string client_contry
*/

function get_client_country() 
{

$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/".$ip."/json"));
return $details->country; // -> "Mountain View"
	
}

/**
*
*  @function get_client_referral()
*  @brief get client referral from rep.php
*               
*
*
*
*  @return string client referral
*/

function get_client_referral () 
{
if ($GLOBALS ["local"] == 0) {
$ref = $_SERVER['HTTP_REFERER'];
return $ref;

}

}


/**
*
*  @function update_visit_values($n)
*  @brief introduce the values in the ads_clients_visits database
*                 Introduce the values of "visit_id", "ip", "browser", "referral", "cuontry", "validity" from ads_clients_visits
*                  get_client_ip(), get_client_browser(), get_client_country(); get_client_referral() form functions.php
*
*
*  @return no return
*/


 // start function update_visit_values()
function update_visit_values($n){

 
 
 /*
  *
  * Introduce the values of "visit_id", "ip", "browser", "referral", "contry", "validity" from ads_clients_visits
  *    get_client_ip(), get_client_browser(), get_client_country(); get_client_referral() form functions.php
  *
  */
 
    $validity = 1;  //should be substituted for a function visitor_validity_check()
/*	$content = array('visited_ads_ad' => $n,
					 'time' => date("Y-m-d H:i:s")
					 );
	$json_query = json_encode($content);	
	$json_query = str_replace('"','\"',$json_query);
	$sql ='INSERT INTO ads_clients_visits (  ip, browser, referral, country, visited_ads_ad, validity ) 
			VALUES ("'.get_client_ip().'","'.get_client_browser().'","'.get_client_referral().'" ,"'.get_client_country().'","'.$json_query.'","'.$validity.'")';
 
    $asql = mysql_query($sql); 
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}
 #  $sql = " SELECT * FROM ads_ad ORDER BY hits_counter DESC LIMIT "  . (string)$n . ", " .(string)$n  .";";
 #  $asql = mysql_query($sql) or die (mysql_error())  ; 
    
*/	
	
	if ( $validity == 1) {
	
	
	$sql = 'SELECT hits_counter FROM ads_webs WHERE ads_web_id = "'.$n.'"' ;
	$asql = mysql_query($sql);
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}
	$asql_list = mysql_fetch_array($asql);
    $hits_counter = $asql_list[0];

    $hits_counter = (int)$hits_counter;
    $hits_counter = $hits_counter + 1;

    $sql = " UPDATE ads_webs SET hits_counter = ". (string)$hits_counter . "  WHERE ads_web_id = "  . (string)$n . ";";
;
    $asql = mysql_query($sql) or die (mysql_error())  ; 
   
	}
   
 }  // end function update_visit_values()  




/**
*
*  @function get_ad_state_in_text( INT )
*  @brief get a readable status from id
*
*
*
*  @return  string status. for example:  "VALID"
*/  
  
  
  
function get_ad_state_in_text($int) {
	
	
		
	switch ($int)
	{
		case 0: { $state = 'Approval pending'; break; }
		case 1: { $state = 'Approved'; break; } 
		case 2: { $state = 'Banned'; break; }
		case 3: { $state = 'Not Approved'; break; }
		
	}
	
	return $state;
	
	
	
}  

/**
*
*  @function get_campaign_state_in_text( INT )
*  @brief get a readable status from id
*
*
*
*  @return  string status. for example:  "VALID"
*/  
  
  
  
function get_campaign_state_in_text($int) {
	
	
		
	switch ($int)
	{
		case 0: { $state = 'In Progress'; break; }
		case 1: { $state = 'Approval Pending'; break; } 
		case 2: { $state = 'Running'; break; }
		case 3: { $state = 'Cancelled'; break; }
		case 4: { $state = 'Finished'; break; }
		
	}
	
	return $state;
	
	
	
}  
 
 
/**
*
*  @function get_user_account_state_in_text( INT )
*  @brief get a readable status from id
*
*
*
*  @return  string status. for example:  "VALID"
*/  
  
  
  
function get_user_account_state_in_text($int) {
	
	
	// get_user_account_state_in_text(get_account_state())
	
		
	switch ($int)
	{
		case 0: { $state = 'Activation pending'; break; }
		case 1: { $state = 'Active'; break; } 
		case 2: { $state = 'Cancelled'; break; }
		case 3: { $state = 'Banned'; break; }
		
	}
	
	return $state;
	
	
	
} 
 
 
 
/**
*
*  @function get_ticket_state_in_text( INT )
*  @brief get a readable status from id
*
*
*
*  @return  string status. for example:  "VALID"
*/  
  
  
  
function get_ticket_state_in_text($int) {
	
	
	// get_user_account_state_in_text(get_account_state())
	
		
	switch ($int)
	{
		case 0: { $state = 'New'; break; }
		case 1: { $state = 'Review'; break; } 
		case 2: { $state = 'In Work'; break; }
		case 3: { $state = 'Response Review'; break; }
		case 4: { $state = 'Rejected'; break; }
		case 5: { $state = 'Finalized'; break; }
		
	}
	
	return $state;
	
	
	
} 

 
  
/**
*
*  @function get_acampaign_id_from_name(string)
*  @brief get ads_user_id, from ads_campaign_name
*             
*
*
*
*  @return int ads_user_id
*/  
  
  

function get_campaign_id_from_name($campaign_name) {


 
	   
 
   $sql = 'SELECT ads_campaign_id FROM ads_campaign WHERE ads_campaign_name = "'.$campaign_name.'"';
   $asql = mysql_query($sql);
   $asql_list = mysql_fetch_array($asql);
   $campaign_id = $asql_list[0]; 
  
   if ( $campaign_id != NULL) 
   {

   return $campaign_id;   
   
   }else {
   return -1;
   }
  
  
} 
  

  
/**
*
*  @function get_content($ads_id)
*  @brief get content from ads_ad
*
*             “title”, “display_url”, “final_url”,”ad_text_l1”,”ad_text_l2”,”section”,”device_preference”.
*
*
*
*  @return return content from $ads_ad_id
*/  
    
  function get_content($ads_id, $ads_web_id) {
	  
	$sql = 'SELECT content FROM ads_ad WHERE ads_ad_id = "'.$ads_id.'"';
	$asql = mysql_query($sql);
    if (!$asql)
    {
      die('mysql consult no valid: ' . mysql_error());
	  //echo "Error Occurs!";
    }  
	$asql_list = mysql_fetch_row($asql);
	  print_r ($asql_list);
	  json_decode($asql_list[0], true);
	$json_query = json_decode($asql_list[0]);
	
	
	  //echo json_decode($asql_list);
	  
	$title= $json_query->{"title"};
	$display_url= $json_query->{"display_url"};
	$final_url= $json_query->{"final_url"};
	$ad_text_l1= $json_query->{"ad_text_l1"};
	$ad_text_l2=$json_query->{"ad_text_l2"};
	$section= $json_query->{"section"};
	$device= $json_query->{"device"};
	$style = $json_query->{"style"};
	$ads_repository_type = $_GET['ads_repository_type'];  
	  
 	

    //$date = date("Y-m-d H:i:s");
	//$date = new DateTime();
	$datestamp = date("U");
	$to_encrypt =    "ads_id=".$ads_id."&ads_web_id=".$ads_web_id."&datestamp=".$datestamp."&checksum=1";
	$encrypted_string = encrypt_it($to_encrypt);
	//$encrypted_string = $to_encrypt;
	$final_url = 'rep.php?r='.rawurlencode($encrypted_string);
	
	$javascript_code = '<script  type="text/javascript"> function OpenInNewTab(url) { 
                      	var win = window.open(url, "_blank");
                        win.focus();
                        } </script>';
	
/*	$content = "\n".'<h1>'.$title.'</h1>'.
	            "\n<br>".'<a href="'.$final_url.'" >'.$display_url.'</a>'.
	            "\n<br>".'<p>'.$ad_text_l1.'</p>'.'<p>'.$ad_text_l2.'</p>'.
				"\n<br>";
	
	*/
	//$final_url = "rep.php?r=".$encrypted_string;
	$final_url = "http://ncp.freeiz.com/pub_test/".$final_url;
	
	$content =  $javascript_code."\n".'<h1>'.$title.'</h1>'.
	            "\n<br>".'<a href="#" onclick=OpenInNewTab("'.$final_url.'") >'.$display_url.'</a>'.
	            "\n<br>".'<p>'.$ad_text_l1.'</p>'.'<p>'.$ad_text_l2.'</p>'.
				"\n<br>";
	
/*	
	$content = '<script  type="text/javascript"> function OpenInNewTab(url) { 
                      	var win = window.open(url, "_blank");
                        win.focus();
                        } 
						</script>
						
						
				<a href="#" onclick=OpenInNewTab("www.google.com") >display_url</a>';
*/	
	
	return $content;

	  
  }
  

   
/**
*
*  @function get_content($ads_id)
*  @brief get content from ads_ad
*
*             “title”, “display_url”, “final_url”,”ad_text_l1”,”ad_text_l2”,”section”,”device_preference”.
*
*
*
*  @return return content from $ads_ad_id
*/  
    
  function get_content_in_json($ads_id, $ads_web_id) {
	  
	$sql = 'SELECT content FROM ads_ad WHERE ads_ad_id = "'.$ads_id.'"';
	$asql = mysql_query($sql);
    if (!$asql)
    {
      die('mysql consult no valid: ' . mysql_error());
	  //echo "Error Occurs!";
    }  
	$asql_list = mysql_fetch_row($asql);
	//  print_r ($asql_list);
	  json_decode($asql_list[0], true);
	$json_query = json_decode($asql_list[0]);
	
	
	  //echo json_decode($asql_list);
	  
	$title= $json_query->{"title"};
	$display_url= $json_query->{"display_url"};
	$final_url= $json_query->{"final_url"};
	$ad_text_l1= $json_query->{"ad_text_l1"};
	$ad_text_l2=$json_query->{"ad_text_l2"};
	$section= $json_query->{"section"};
	$device= $json_query->{"device"};
	$style = $json_query->{"style"};
	$ads_repository_type = $_GET['ads_repository_type'];  
	  
 	

    //$date = date("Y-m-d H:i:s");
	//$date = new DateTime();
	$datestamp = date("U");
	$to_encrypt =    "ads_id=".$ads_id."&ads_web_id=".$ads_web_id."&datestamp=".$datestamp."&checksum=1";
	$encrypted_string = encrypt_it($to_encrypt);
	//$encrypted_string = $to_encrypt;
	$final_url = 'rep.php?r='.rawurlencode($encrypted_string);
	
	$javascript_code = '<script  type="text/javascript"> function OpenInNewTab(url) { 
                      	var win = window.open(url, "_blank");
                        win.focus();
                        } </script>';
	
/*	$content = "\n".'<h1>'.$title.'</h1>'.
	            "\n<br>".'<a href="'.$final_url.'" >'.$display_url.'</a>'.
	            "\n<br>".'<p>'.$ad_text_l1.'</p>'.'<p>'.$ad_text_l2.'</p>'.
				"\n<br>";
	
	*/
	//$final_url = "rep.php?r=".$encrypted_string;
	$final_url = "http://ncp.freeiz.com/pub_test/".$final_url;
	
	$content =  $javascript_code."\n".'<h1>'.$title.'</h1>'.
	            "\n<br>".'<a href="#" onclick=OpenInNewTab("'.$final_url.'") >'.$display_url.'</a>'.
	            "\n<br>".'<p>'.$ad_text_l1.'</p>'.'<p>'.$ad_text_l2.'</p>'.
				"\n<br>";
	
/*	
	$content = '<script  type="text/javascript"> function OpenInNewTab(url) { 
                      	var win = window.open(url, "_blank");
                        win.focus();
                        } 
						</script>
						
						
				<a href="#" onclick=OpenInNewTab("www.google.com") >display_url</a>';
*/	

    //$final_url = ' <a href="#" onclick=OpenInNewTab("'.$final_url.'") >';
    $device = "1";
  	$content = array('title' => $title,
						 'display_url' => $display_url,
						 'final_url' => $final_url,
						 'ad_text_l1' => $ad_text_l1,
						 'ad_text_l2' => $ad_text_l2,
						 'section' => $section,
						 'device' => $device );
	$json_content = json_encode($content);		
	//echo "json_content: ".$json_content;
	
	return $json_content;

	  
  }
  
  
/**
*
*  @function get_final_url($ads_id)
*  @brief get content from ads_ad
*
*             “title”, “display_url”, “final_url”,”ad_text_l1”,”ad_text_l2”,”section”,”device_preference”.
* 
*
*
*  @return return $final_url from ads_ad.content where $ads_ad_id ? $ads_id
*/  


  function get_final_url($ads_id) {
	  
	$sql = 'SELECT content FROM ads_ad WHERE ads_ad_id = "'.$ads_id.'"';
	$asql = mysql_query($sql);
    if (!$asql)
    {
      //die('mysql consult no valid: ' . mysql_error());
	  echo "Error Occurs!";
    }  
	$asql_list = mysql_fetch_row($asql);
	  //print_r ($asql_list);
	  //json_decode($asql_list[0], true);
	$json_query = json_decode($asql_list[0]);
	
	
	  //echo json_decode($asql_list);
	  
	$title= $json_query->{"title"};
	$display_url= $json_query->{"display_url"};
	$final_url= $json_query->{"final_url"};
	$ad_text_l1= $json_query->{"ad_text_l1"};
	$ad_text_l2=$json_query->{"ad_text_l2"};
	$section= $json_query->{"section"};
	$device= $json_query->{"device"};
	$style = $json_query->{"style"};

	  
 	

	
	return $final_url;

	  
  }
  
   
 /**
*
*  @function get_total_hits_of_user()
*  @brief generate a random string
*
*             
*
*
*
*  @return total_clicks
*/   
  
function  get_total_hits_of_user() {


		 $sql = 'SELECT SUM(hit_counter) FROM ads_ad WHERE created_by="'.get_ads_user_id().'"';
		 $asql = mysql_query($sql); 
		 $ads_list = mysql_fetch_row($asql);
		 $total_hits = $ads_list[0];
		 return $total_hits;
		 



} 
  
 /**
*
*  @function get_total_clicks_of_user()
*  @brief generate a random string
*
*             
*
*
*
*  @return total_clicks
*/   
  
function  get_total_clicks_of_user() {


		 $sql = 'SELECT SUM(click_counter) FROM ads_ad WHERE created_by="'.get_ads_user_id().'"';
		 $asql = mysql_query($sql); 
		 $ads_list = mysql_fetch_row($asql);
		 $total_clicks = $ads_list[0];
		 return $total_clicks;
		 



}

  
 /**
*
*  @function get_total_clicks_of_user()
*  @brief generate a random string
*
*             
*
*
*
*  @return 0
*/   
  
function  get_account_state() {


		 $sql = 'SELECT state FROM ads_users WHERE id_user="'.get_ads_user_id().'"';
		 $asql = mysql_query($sql); 
		 $ads_list = mysql_fetch_row($asql);
		 $account_state = $ads_list[0];
		 return $account_state;
		 



}
  
  
  
  
  
  
  
  
  
  
  
  
  
/**
*
*  @function generate_random_string($length = 10)
*  @brief generate a random string
*
*             
*
*
*
*  @return 0
*/  
//generar un string random

function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}




;

//echo $encrypted . '<br />' . $decrypted;

  
/**
*
*  @function encrypt_it
*  @brief encrypt a string
*
*             
*
*
*
*  @return 0
*/  




function encrypt_it( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}


  
/**
*
*  @function decript a string
*  @brief print a Ads Unit format with the content of this ads_id
*
*             
*
*
*
*  @return 0
*/  





function decrypt_it( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}



  
  
/**
*
*  @function get_preview_ads($ads_id)
*  @brief print a Ads Unit format with the content of this ads_id
*
*             
*
*
*
*  @return 0
*/  
  
  
  function get_preview_ads($ads_id) {
  
  
       	$sql = 'SELECT * FROM ads_ad WHERE ads_ad_id = "'.$ads_id.'"';
		
		$asql = mysql_query($sql);
		if (!$asql)  
		  {
			die('mysql consult no valid: ' . mysql_error());
		  }
		$asql_list = mysql_fetch_array($asql);  

        $json_query = $asql_list[2];
		$json_query = json_decode($json_query);
  		echo "\n";
		echo "<br><br>";
		echo "\n";
		echo "<br><br>";
		echo '<table border=1 width=120 height=120 class="ad_space"><tr><td>';
		echo "\n";
		echo '<h1>'.$json_query->{"title"}.'</h1>';
		echo "\n<br>";
		echo '<a href="'.$json_query->{"final_url"}.'" >'.$json_query->{"display_url"}.'</a>';
		echo "\n<br>";
		echo '<p>'.$json_query->{"ad_text_l1"}.'</p>';
		echo '<p>'.$json_query->{"ad_text_l2"}.'</p>';
		echo "\n<br>";
		echo '</tr></td></table>';
	
		
    }
  
/**
*
*  @function check_string_validation($mode, $string)
*  @brief do a check of a valid string for a name of campaign or advertising unit.
*
*             
*
*
*
*  @return list (result, string_msg)
*/  
  
  
function check_string_validation (  $mode, $string )
    {
	  

	  
    if ( $mode == 0 )  // mode campaign

	{
		// START of CHECK: it uses NOT permitted characters	
        $campaign_name = $string;
        $create_ads_campaign_check = 0;
	    $regex_pattern = '([a-zA-Z0-9 ]+)';
		$invalid_characters_test_result = !preg_match($regex_pattern, $campaign_name, $campaign_name_invalid_test);

		if ($invalid_characters_test_result == TRUE )
		 {
		    $create_ads_campaign_check = -3;
			
		 } else 
			 
			 {
				 
				$campaign_name = $campaign_name_invalid_test[0]; 
				 
		    }
		// END of CHECK: it uses NOT permitted characters	
		
		
		
		// START of CHECK:  exist the introduced ads space name?
		
		$db_table = 'ads_ad';
		$table_field = 'ads_campaign_name';
		$ads_space = json_decode($ads_space);
		$ads_space_name = $ads_space["title"];
		
;
		$sql = 'SELECT * FROM  ads_campaign WHERE ads_campaign_name = "'.$campaign_name.'" AND created_by = '.get_ads_user_id();
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
				
		$asql_list = mysql_fetch_array($asql);
		$requested_campaign_name = $asql_list[0];
		
		if ( $requested_campaign_name == TRUE)
		 {
		    $create_campaign_check = -1;
			
		 }

		// END of CHECK: exist the introduced ads space name?
		
		
        // START of CHECK:check if the name of the campaign is correct.
		
		if (   (strlen($campaign_name) < 8) || (strlen($campaign_name) > 50) )
		{
			
			$create_campaign_check = -2;	
		}		
		// END of CHECK:check if the name of the campaign is correct.		
		


		 
		

		
		
		
		// START of CHECK: user has more than 10 ads_space
		
		$sql = 'SELECT ads_campaign_id FROM ads_campaign WHERE  created_by = "'.get_ads_user_id().'"';
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
				
		$asql_list = mysql_fetch_row($asql);
		$campaigns_created_by_user = mysql_num_rows($asql);
		//var_dump($asql_list);
		//echo '<p>number of campaigns: '.$campaigns_created_by_user.'</p>';
		
		if ( $campaigns_created_by_user > 9)
		 {
		    $create_campaign_check = -4;
			
		 }
		 
		// END of CHECK: user has more than 10 campaigns	
		
		//echo '<p>Is no possible create a campaign with this name: '.$string.'</p>';

			switch ($create_campaign_check)
			{
			   
			   
			   case 0:
			       {
					   $msg = 'Your campaign name is correct.'; 
					   break;
				   }				   
			   
			   
			   case -1:
			       {
					   $msg = 'No valid campaign name. Exist another campaign with same name. '; 
					   break;
				   }		   
			   case -2:
				   {
					   $msg =  'No valid campaign name. Campaign name must to be longer as 8 characters and up to 50.'; 
					   break;
				   }
			   case -3:
				   {
					   $msg =  'No valid campaign name. A campaign name has not allowed characters.'; 
					   break;
				   } 	 
			   case -4:
				   {
					   $msg = 'No possible create a campaign. A limit campaign number is reached.'; 
					   break;
				   }
  			  
			  
     	     }  //end switch	
		

		return array( $create_campaign_check, $msg);
	}
	elseif ($mode == 1)  //modo ads space

    {
	    // START of CHECK: it uses NOT permitted characters	
        $ads_unit_name = $string;
        $create_ads_unit_check = 0;
	    $regex_pattern = '([a-zA-Z0-9 ]+)';
		$invalid_characters_test_result = !preg_match($regex_pattern, $ads_unit_name, $ads_unit_name_invalid_test);
    
	    echo '<p>Into mode 1 function check_string_validation</p>' ;
		echo '<br>';
	   
		if ($invalid_characters_test_result == TRUE )
		 {
		    $create_ads_unit_check = -3;
			
		 } else 
			 
			 {
				 
				$ads_unit_name = $ads_unit_name_invalid_test[0]; 
				 
		    }
		// END of CHECK: it uses NOT permitted characters	
		
		
		
		// START of CHECK:  exist the introduced ads space name?
		
		$db_table = 'ads_ad';
		$table_field = 'ads_campaign_name';
		$ads_space = json_decode($ads_space);
		$ads_space_name = $ads_space["title"];
	
		$sql = 'SELECT * FROM  ads_ WHERE belongs_to_campaign = '.$campaign_id;
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
		
		while ($asql_list = mysql_fetch_row($asql)){
		  	 $ads_space = json_decode($ads_space);
		     $ads_space_name = $ads_space["title"];	
			
		}

		
		$asql_list = mysql_fetch_array($asql);
		$requested_ads_unit_name = $asql_list[0];
		
		if ( $requested_campaign_name == TRUE)
		 {
		    $create_ads_unit_check = -1;
			
		 }

		// END of CHECK: exist the introduced ads space name?
		
		
        // START of CHECK:check if the name of the campaign is correct.
		
		if (   (strlen($ads_unit_name) < 8) || (strlen($ads_unit_name) > 50) )
		{
			
			$create_ads_unit_check = -2;	
		}		
		// END of CHECK:check if the name of the campaign is correct.		
		


		 
		

		
		
		
		// START of CHECK: user has more than 10 ads_space
		
		$sql = 'SELECT ads_ad_id FROM ads_ad WHERE  belongs_to_campaign = "'.get_ads_user_id().'"';
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
				
		$asql_list = mysql_fetch_row($asql);
		$ads_unit_created_by_user = mysql_num_rows($asql);

		
		if ( $ads_unit_created_by_user > 9)
		 {
		    $create_ads_unit_check = -4;
			
		 }
		 
		// END of CHECK: user has more than 10 campaigns	
		
		//echo '<p>Is no possible create a campaign with this name: '.$string.'</p>';

			switch ($create_ads_unit_check)
			{
			   
			   
			   case 0:
			       {
					   $msg = 'Your advertising unit name is correct.'; 
					   break;
				   }				   
			   
			   
			   case -1:
			       {
					   $msg = 'No valid advertising unit  name. Exist another advertising unit  with same name in this campaign. '; 
					   break;
				   }		   
			   case -2:
				   {
					   $msg =  'No valid advertising unit  name. Advertising unit name must to be longer as 8 characters and lower of 50.'; 
					   break;
				   }
			   case -3:
				   {
					   $msg =  'No valid advertising unit name. A advertising unit name has not allowed characters.'; 
					   break;
				   } 	 
			   case -4:
				   {
					   $msg = 'No possible create a advertising unit. A limit of advertising units number is reached.'; 
					   break;
				   }
  			  
			  
     	     }  //end switch	
		

		return array( $create_ads_unit_check, $msg);
	   
	 } // end elseif 
		
		

		
	  
  } //end of function
  
  
  
/**
*
*  @function check_ads_space_validation($campaign_id , $string)
*  @brief do a check of a valid string for a name of campaign or advertising unit.
*
*             
*
*
*
*  @return list (result, string_msg)
*/  
  
  
function check_ads_space_validation (  $campaign_id, $string )
    {  
    
	
	$ads_space = $string;
	

	echo '<br>';
	$create_campaign_check = 0;
	

	$ads_space = str_replace( '\\"', '"',$ads_space);
	

    //  Title must not be longer as 500 characters
	
	//  Any field  cannot be void
	// No possible 7 ads units per campaign
    // campaign must belong to user 
	// Same title is avaiable,
	
	   
	    $ads_space_array = json_decode($ads_space);
		
	        // START of CHECK:
			$j = 0;
			$regex_pattern = '([a-zA-Z0-9 \/]+)';
	         foreach ($ads_space_array  as $i => $j )
			 {

			 
			 
			 
			 
			   // START of CHECK
			 			
				  
					$j = $j_to_check;
		            $invalid_characters_test_result = !preg_match($regex_pattern, $j_to_check, $ads_unit_name_invalid_test);
    
	   
	   
		            if ($invalid_characters_test_result == TRUE )
		            {
					 $msg = "Error in field ".$i;
		             $create_ads_unit_check = -3;
			
		             } else 
			 
		          	 {
				    	$ads_unit_name = $ads_unit_name_invalid_test[0]; 
				     }
		
			 
			 // END of CHECK:
			 
			 
			 
			 
			
			// START of CHECK: Any field  cannot be void and longer of 100 characters
			 if (   (strlen($j) < 0) || (strlen($j) > 100) )
		     {
			 $msg = "Error in field ".$i;
			 $create_campaign_check = -2;	
		     }		
			// END of CHECK: Any field  cannot be void and longer of 100 characters


			
			
			
			
			
			
			 }
	    
	
     	    // END of CHECK:
	
	    // START of CHECK:check if the name of the campaign is correct.
		
		
		   
		
				
					
		
		
		// END of CHECK:check if the json of packet is correct
	
	    // START of CHECK:check if the name of the campaign is correct
	    
		
		$ads_check = json_decode ($ads_space); 
        if($ads_check == null) {
          $create_campaign_check = -5;
        }
	
	    // END of CHECK:check if the json of packet is correct
	
	
		// START of CHECK: user has more than 4 ads_space
		
		$sql = 'SELECT ads_ad_id FROM ads_ad WHERE  belongs_to_campaign = "'.$campaign_id.'" AND created_by = '.get_ads_user_id();
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());

		}
				
		$asql_list = mysql_fetch_row($asql);
		$ads_spaces_created_by_user = mysql_num_rows($asql);
		//var_dump($asql_list);
		//echo '<p>number of campaigns: '.$campaigns_created_by_user.'</p>';
		
		if ( $ads_spaces_created_by_user > 6)
		 {
		    $create_campaign_check = -4;
			
		 }
		 
		// END of CHECK: user has more than 4 ads_space
		
		//echo '<p>Is no possible create a campaign with this name: '.$string.'</p>';

			switch ($create_campaign_check)
			{
			   
			   
			   case 0:
			       {
					   $msg = 'Your advertising space can be saved'; 
					   break;
				   }				   
			   
			   
			   case -1:
			       {
					   $msg = 'No valid campaign name. Exist another campaign with same name. '; 
					   break;
				   }		   
			   case -2:
				   {
					   $msg =  $msg.'. A field must be  longer as 0 characters and up to 100.'; 
					   break;
				   }
			   case -3:
				   {
					   $msg =  $msg.'. A field has not allowed characters.'; 
					   break;
				   } 	 
			   case -4:
				   {
					   $msg = 'No possible create a advertising unit for this campaign. A limitation of advertising unit for campaign is reached.'; 
					   break;
				   }
			   case -5:
				   {
					   $msg = 'No possible create a advertising unit for this campaign. A system has a problem to codify the advertising space correctly.'; 
					   break;
				   }  			  
			  
     	     }  //end switch	
		
//      echo 'campaign_id : '.$campaign_id;
//		echo '<br>';
//		 echo '$create_campaign_check : '.$create_campaign_check;
		return array( $create_campaign_check, $msg);


  }
//end of function	



/**
*
*  @function check_register_validation(  $user_data_array)
*  @brief do a check of a valid string for a name of campaign or advertising unit.
*
*             
*
*
*
*  @return list (result, string_msg)
*/  



function check_register_validation ( $user_data_array  )
{


	

	

	echo '<br>';
	$create_user_check = 0;
	$debug = 0;	

	

    //  Title must not be longer as 500 characters
	
	//  Any field  cannot be void
	// No possible 7 ads units per campaign
    // campaign must belong to user 
	// Same title is avaiable,
	
	   

		
	        // START of CHECK:
	$j = 0;
	$regex_pattern = array ( "email" => "([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(?:[a-zA-Z]{2}|com|co|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)$)",
									 "password" => "([a-zA-Z0-9 ]+)",
									 "birthday" => "([0-9/-]+)",
									 "gender" =>  "([a-z]+)",
									 "city" => "([a-zA-Z ]+)",
									 "country" => "([a-zA-Z ]+)",
									 "zip_code" => "([a-zA-Z0-9 ]+)",
									 "first_name" => "([a-zA-Z ]+)",
									 "last_name" => "([a-zA-Z ]+)",
									 "telephone" => "([0-9+ ]+)",
									/* "email" => "([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(?:[a-zA-Z]{2}|com|co|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)$)" */ );
			
			
			$error_code = array ( "email" => "0",
									 "password" => "0",
									 "birthday" => "0",
									 "gender" =>  "0",
									 "city" => "0",
									 "country" => "0",
									 "zip_code" => "0",
									 "first_name" => "0",
									 "last_name" => "0",
									 "telephone" => "0",
									/* "email" => "0" */);							 
									 
									 
									 
									 
			$error_msg = array ( "email" => "",
									 "password" => "",
									 "birthday" => "",
									 "gender" =>  "",
									 "city" => "",
									 "country" => "",
									 "zip_code" => "",
									 "first_name" => "",
									 "last_name" => "",
									 "telephone" => "",
									/* "email" => "" */);						 
			
									 
									 
					 
									 
			if ($debug == 1) 
			{	
			var_dump ($user_data_array);			
			echo '<p>start test 1 and 2</p><br>';
			}
	         foreach ($user_data_array  as $i => $j )
			 {

			 
			 
			 
			 
			   // START of CHECK: validation of characters 
			 	
				  
					$j_to_check = $user_data_array[$i];
					
					if ($debug == 1) 
					{
					    echo "<hr>";
						echo '<p>input array : '.$user_data_array[$i].'</p>';
						echo "\n<br>";
						echo '<p>input preg match : '.$user_data_array[$i].'</p>';
						echo "\n<br>";
						echo '<p>input j : '.$j.'</p>';		
						echo "\n<br>";
						echo "\n<br>";
						echo '<p>lenght j_to_check : '.strlen($j_to_check).'</p>';		
						echo "\n<br>";
						echo '<p>input j_to_check : '.$j_to_check.'</p>';	
						echo '<p>input regex_pattern['.$i.'] -> var_dump: </p>';
						var_dump($regex_pattern[$i]);
					}	
		            
					
					$invalid_characters_test_result = !preg_match($regex_pattern[$i], $j_to_check, $user_name_invalid_test);

	   
		            if ($invalid_characters_test_result == TRUE )
		            {
					 $msg = "Error in field ".$i." -> ".$j;

					 $error_code[$i] = -3;
		             $create_user_check = -3; 

		             }
			 
			        // END of CHECK:
			 				
					// START of CHECK: Any field  cannot be void and longer of 100 characters
					// if (   (strlen($j_to_check) < 0) || (strlen($j_to_check) > 100) )
					if (   (strlen($j_to_check) < 4) || (strlen($j_to_check) > 100)  )
					 {
					 
					 $msg = "Error in field ".$i;
					 $error_code[$i] = -2;
					 $create_user_check = -2;	
					 }		
					// END of CHECK: Any field  cannot be void and longer of 100 characters

					if ($debug == 1) 
					{
					 echo "\n<br>";
					 echo 'output value user_name_invalid_test: '.$user_name_invalid_test[0];
					 echo "\n<br>";
					 echo 'output value invalid_characters_test_result: '.$invalid_characters_test_result[0];
					 echo "\n<br>";
					 echo 'output value create_user_check: '.$create_user_check;	
			        }
			
			
			
			
			 } // end foreach
			 
			 if ($debug == 1) 
			{
					echo '<p>end test 1 and 2</p><br>';
					echo '<p>start test 3</p><br>';
			}
	
     	    // END of CHECK:
	

	
	    // START of CHECK:check if the user name is correct
	    
		$sql = 'SELECT user FROM ads_users WHERE  user = "'.$user_data["user"].'"';
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());

		}
				
		$asql_list = mysql_fetch_row($asql);
		$users_with_this_username = mysql_num_rows($asql);
		//var_dump($asql_list);
		//echo '<p>number of campaigns: '.$campaigns_created_by_user.'</p>';
		
		if ($debug == 1) 
		{
		echo '<p>end test 3</p><br>';
		}
		
		if ( $users_with_this_username > 0)
		 {
		    $error_code[$i] = -4;
			$create_user_check = -4;
			
		 }
	
	   // END of CHECK:check if the user name is correct

		//echo '<p>Is no possible create a campaign with this name: '.$string.'</p>';

	
		
//      echo 'campaign_id : '.$campaign_id;
//		echo '<br>';
//		 echo '$create_campaign_check : '.$create_campaign_check;


		$msg = "";
		foreach ($error_code  as $k => $l) {
		
		    
		    switch ($l)
			{
			   
			   
			   case 0:
			       {
					   
					   if ($debug == 1) 
		               {
					   $msg = $msg.'Error '.$l.'.No Error in field '.$k.'.This field is correct.';
					   $msg = $msg."\n<br>";
                       }
					   
					  
					   break;
				   }				   
			   
			   
			   case -1:
			       {   
				       if ($debug == 1) 
		               {
					   $msg = $msg.'Error '.$l.'. ';
					   }
					   
					   $msg = $msg.'Error in field '.$k.'.No possible create a user account. It happens undefined internal errors. Please retry later. '; 
					   $msg = $msg."\n<br>";
					   
					   
					   break;
				   }		   
			   case -2:
				   {
				   
				        if ($debug == 1) 
		               {
					   $msg = $msg.'Error '.$l.'. ';
					   }
					   $msg = $msg.'Error in field '.$k.'. A field must be  longer as 0 characters and up to 100.'; 
					   $msg = $msg."\n<br>";
					   
					
					   break;
				   }
			   case -3:
				   {
						if ($debug == 1) 
		               {
					   $msg = $msg.'Error '.$l.'. ';
					   }		   
		
					   $msg = $msg.'Error in field '.$k.'. A field has not allowed characters.'; 
					   $msg = $msg."\n<br>";
					   
					 
					   break;
				   } 	 
			   case -4:
				   {
				   
						if ($debug == 1) 
		               {
					   $msg = $msg.'Error '.$l.'. ';
					   }
					   $msg = $msg.'Error in field '.$k.'.No possible create a user account. Exist another user with same name.'; 
					   $msg = $msg."\n<br>";
					   
					   break;
				   }
			   case -5:
				   {
				   
					   if ($debug == 1) 
		               {
					   $msg = $msg.'Error '.$l.'. ';
					   }
				   
					   $msg = $msg.'Error in field '.$k.'.No possible create a user account. A system has a problem to codify the advertising space correctly.'; 
					   $msg = $msg."\n<br>";
					   
					  
					   break;
				   }  			  
			  
     	      
		   
		   }
		
		
		
		}
        
		
		
		if ($debug == 1){
		
		
		var_dump($error_code);
		echo "\n<br>";
		var_dump($error_msg);
		echo "\n<br>";echo "\n<br>";
		}
		
/*		
		
		 switch ($create_user_check)
			{
			   
			   
			   case 0:
			       {
					   $msg = 'Your user account is created';
					   
					   break;
				   }				   
			   
			   
			   case -1:
			       {
					   $msg = 'No possible create a user account. It occurs undefined internal errors. Please retry later. '; 
					   break;
				   }		   
			   case -2:
				   {
					   $msg =  "Error ".$create_user_check." - ".$msg.'. A field must be  longer as 0 characters and up to 100.'; 
					   break;
				   }
			   case -3:
				   {
					   $msg =  "Error ".$create_user_check." - ".$msg.'. A field has not allowed characters.'; 
					   break;
				   } 	 
			   case -4:
				   {
					   $msg = 'No possible create a user account. Exist another user with same name.'; 
					   break;
				   }
			   case -5:
				   {
					   $msg = 'No possible create a user account. A system has a problem to codify the advertising space correctly.'; 
					   break;
				   }  			  
			  
     	     }  //end switch
		
*/		
		
		
		//echo ($msg);
		return array( $create_user_check, $msg);
		



} // end function end 

	

/**
*
*  @function get_section_text_from_id($int)
*  @brief get a readable section name from id
*
*
*
*  @return  string status. for example:  "Health"
*/  
  
  
  
function get_section_text_from_id($int) {
	
	
		
	$sql = 'SELECT section_name FROM ads_sections WHERE ads_section_id = "'.$int.'"';
		
	$asql = mysql_query($sql);
		if (!$asql)  
		  {
			die('mysql consult no valid: ' . mysql_error());
		  }
	$asql_list = mysql_fetch_array($asql);
	$section_name = $asql_list[0];
	return $section_name;
	
	
}    


/**
*
*  @function get_device_text_from_id($int)
*  @brief get a readable device name from id
*
*
*
*  @return  string status. for example:  "COmputer"
*/  
  
  
  
function get_device_text_from_id($int) {
	
	
		
	$sql = 'SELECT device_name FROM ads_devices WHERE ads_device_id = "'.$int.'"';
		
	$asql = mysql_query($sql);
		if (!$asql)  
		  {
			die('mysql consult no valid: ' . mysql_error());
		  }
	$asql_list = mysql_fetch_array($asql);
	$device_name = $asql_list[0];
	echo $device_name;
	
	
}    
  
  
  
  
  
  
  
/**
*
*  @function set_content($ad_list)
*  @brief get ads_user_id, from ads_campaign_name
*             “title”, “display_url”, “final_url”,”ad_text_l1”,”ad_text_l2”,”section”,”device_preference”.
*
*
*
*  @return list ads_user_id
*/  
    
  function set_content($ad_list) {
	  
	   
	  
	  $sql = 'SELECT content FROM ads_ad WHERE ads_ad_id = "'.$ads_id.'"';
	  $asql = mysql_query($sql);
      if (!$asql)
      {
      die('mysql consult no valid: ' . mysql_error());
      }  
	  
  }
    
  
  
/**
*
*  @function get_ads_user_name()
*  @brief get ads_user_name, whicht can be found into the table ads_user inside mysql database
*               ads_db. It will be used for verify the get_data
*
*
*
*  @return string ads_user_id
*/  
  
function get_ads_user_name() {
	
	$user_name =  $_SESSION['username'];
	return $user_name;
	
	
}  


/**
*
*  @function test_input($data)
*  @brief make sure the data input
*               
*
*
*
*  @return string ads_user_id
*
*/#



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


/**
*
*  @function set_content($ad_list)
*  @brief 
*             
*   		     case 0: { $state = 'In Progress'; break; }
*		         case 1: { $state = 'Approval Pending'; break; } #
*		         case 2: { $state = 'Running'; break; }
*		         case 3: { $state = 'Cancelled'; break; }
*		         case 4: { $state = 'Finished'; break; }
*
*
*  @return list ads_user_id
*/ 

// start function change_state_campaign_to_running

function change_state_campaign_to_running ( $campaign_id)
{


$transfer_payments = 0;  

$sql = 'SELECT state FROM ads_campaign WHERE ads_campaign_id = "'.$campaign_id.'"';
$asql = mysql_query($sql);
if (!$asql)
 {
  die('mysql consult no valid: ' . mysql_error());
 }
$asql_list = mysql_fetch_row($asql);
$state = $asql_list[0];
//echo 'el state es: '. $state;
//echo "<br>\n";

// obtenemos el estado del pago; ads_payments y $transfer _payments

$itemid = 'Advertising Campaign ID: '.$campaign_id;

//  SELECT txnid FROM ads_payments WHERE itemid = "Advertising Campaign ID: 18"

$sql = 'SELECT txnid FROM ads_payments WHERE itemid = "'.$itemid.'"';
$asql = mysql_query($sql);
if (!$asql)
 {
  die('mysql consult no valid: ' . mysql_error());
 }
$asql_list = mysql_fetch_row($asql);

$txnid = $asql_list[0];



//echo "el txnid es: ".$txnid;
//echo "<br>\n";

//get log

$sql = 'SELECT transfer FROM ads_transfer_history WHERE txn_id = "'.$txnid.'"';  // SELECT transfer FROM transfer_history WHERE txn_id = "7W565537CP771391Y"

$asql = mysql_query($sql);

$asql_list = mysql_fetch_row($asql);

$log = $asql_list[0];
//echo 'log string: '.$log;
//echo "<br>\n";

$pos = strpos ( $log, $txnid);
//echo "el strpos da como valor: ". $pos;
//echo "<br>\n";
//echo "hola!";


if ( $pos > 0 )
{
	
	$transfer_payments = 1;
} else {
	$transfer_payments = 0;
	
}

//echo 'transfer payment: '.$transfer_payments;
//echo "<br>\n";


$new_state = 2;
if ( ($state == 0) && ($transfer_payments == 1))
	{

	$sql = 'UPDATE ads_campaign SET state = "'.$new_state.'" WHERE ads_campaign_id="'.$campaign_id.'"';
	//UPDATE state SET state = "2" WHERE ads_capaign_id=18
	$asql = mysql_query($sql);
	echo "<br>\n";
    echo 'The state of this Campaign is Payed and Running!';
	} else {
	echo "This Campaign is still not payed.";
		
	}

}  // end function change_state_campaign_to_running

/**
*
*  @function v
*  @brief send a email for verification into register process
*
*
*
*  @return no return
*/

   
  
/**
*
*  @function send_verification_email
*  @brief send a email for verification into register process
*
*
*
*  @return no return
*/
  
  
function send_verification_email($email, $hash) {

$to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: $name
Password: $password
------------------------
 
Please click this link to activate your account:
http://http://localhost/NCM.Website/00_Web/dev_ads/verify.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers

echo $message;

mail($to, $subject, $message, $headers); // Send our email



}


/**
*
*  function: check_email
*  @brief send a email for verification into register process
*
*
*
*  @return no return
*/

function check_email ($email){


if($email)
{
    echo "\n</br>";
    
    //$email      = mysqli_real_escape_string($connection,$_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
	    echo "\n</br>";
        
        $message =  "Invalid email address please type a valid email!!";
        echo $message;
	}
    else
    {
        $sql = "SELECT id_user FROM ads_users where email='".$email."'";
        $asql = mysql_query($sql);
        $results = mysql_fetch_array($asql);
 
        if(count($results)>=1)
        {  
		    echo "results is : " .$results['id_user'];
			echo "\n"; 
            $encrypt = md5(1290*3+$results['id_user']);
            $message = "Your password reset link send to your e-mail address.";
            $to=$email;
            $subject="Forget Password";
            $from = 'info@phpgang.com';
            $body='Hi, <br/> <br/>Your Membership ID is '.$results['id_user'].' <br><br>Click here to reset your password http://demo.phpgang.com/login-signup-in-php/reset.php?encrypt='.$encrypt./*&action=reset*/'   <br/> <br/>--<br>PHPGang.com<br>Solve your problems.';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
            mail($to,$subject,$body,$headers);
		     echo "I email sent to recover your password!!";
			 
			 echo $to.$subject.$body.$headers;
        }
        else
        {
            $message = "Account not found please signup now!!";
        }
    }
}


}


/**
*
*  function: verify_login
*  @brief send a email for verification into register process
*
*
*
*  @return no return
*/

function verify_login($user,$password,&$result)
    {
        $sql = 'SELECT * FROM ads_users WHERE user = "'.$user.'" and password = "'.$password.'"';
        $asql = mysql_query($sql);
        $count = 0;
        while($row = @mysql_fetch_object($asql))
        {
            $count++;
            $result = $row;
			$state = $result->state;  // state of account :  >= 1 -> OK
        }
        if(($count == 1) && ($state <= 1)) //
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

function restore_password ($password, $restore_password, $encrypt){


/*
//if(isset($_GET['action']))
if($password)
{          
    //if($_GET['action']=="reset")
	if($password)
    {
        $encrypt = mysql_real_escape_string($_GET['encrypt']);
        $sql = "SELECT id_user FROM ads_users WHERE md5(90*13+id)='".$encrypt."'";
        $asql = mysql_query($sql);
        $results = mysql_fetch_array($asql);
        if(count($results)>=1)
        {
 
        }
        else
        {
            $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
        }
    }
}
*/

if($password)
{
 
    //$encrypt      = $_POST['encrypt'];
	
    //$password     = $_POST['password'];
   

    $sql = "SELECT id_user FROM ads_users WHERE md5(1290*3+id_user)='".$encrypt."'";

	echo "\n";
	
    $asql = mysql_query($sql);
    $results = mysql_fetch_array($asql);
	echo "\n";
	
	echo "\n";
    if(count($results)>=1)
    {
	
	    echo "\n";
	    //	echo "Password Restored: ".$password;
		echo "\n";
		//echo "user ID: ".$results['id_user'];
        $sql = "UPDATE ads_users SET password='".$password."' WHERE	id_user='".$results['id_user']."'";
        mysql_query($sql);
 
        $message = 'Your password changed sucessfully <a href="./index.php"/\">Click here to login</a>.';
		echo $message;
		echo "\n";
		
    }
    else
    {
        $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
        echo $message;
		echo "\n";
	}
}
else
{

}

}


/**
*
*  @function Demo_PayPal_EWP ()
*  @brief this function handeld a Paylpal payment with the menthod .
*                      
*                  
*               
*
*
*
*  @return null
*/ 




function Demo_PayPal_EWP($budget, $item) {	
	

    $cert_id = 'S2B9S5U4JS6CS';
    $paypal = new PayPal_EWP();
    $paypal->setTempFileDirectory("/tmp");
    $paypal->setCertificate("my-pubcert.pem", "my-prvkey.cem");
   //$paypal->setCertificate( "my-prvkey.cem" ,"my-pubcert.pem");
    $paypal->setCertificateID($cert_id);
    $paypal->setPayPalCertificate("paypal_cert_pem.txt");

    $paypalParam = array(
    "cmd" => "_xclick",
	"cert_id" => $cert_id,
    "business" => "ncmdev@ncm.com",
    "item_name" => "Premium Subscription",
    "item_number" => $item,
    "amount" => $budget,
	"return" => "http://ncp.freeiz.com/pub_test/settings?case=10",
	"cancel_return" => "http://ncp.freeiz.com/pub_test/settings?case=11",
    "no_shipping" => "1",
    "currency_code" => "USD",
    "lc" => "ES", );
	
	$encryption = $paypal -> encryptButton($paypalParam);
    
    $form5='<form name="_xclick"  action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
           <input type="hidden" name="cmd" value="_s-xclick">
           <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----'.$encryption.'-----END PKCS7-----"/>
           <input type="image" src="http://www.paypal.com/es_XC/i/btn/x-click-but01.gif" border="0" name="submit" alt="Realice pagos con PayPal: es rápido, gratis y seguro." style="border:0;">
	
       </form>'; 
	echo $form5;
}  // end function Demo_PayPal_EWP



/**
*
*  @function Demo_PayPal_IPN ()
*  @brief this function handeld a Paylpal payment with the menthod IPN.
*                      
*                  
*               
*
*
*
*  @return null
*/  






// start function Demo_PayPal_IPN

function Demo_PayPal_IPN () {
	
   // instand notification link -->	http://ncp.freeiz.com/pub_test/settings?case=12


    
	if ($GLOBALS ["local"] == 0 ) {
	
	   eval ("$paypal = new PayPal_IPN('sandbox');");
	
	}
	else {
	  eval ("$paypal = &new PayPal_IPN('sandbox');");
	
	}
	
	
	
	
	
	
    $paypal -> run();
	
	
}

/**
*
*  @function write_log()
*  @brief this function write a log. input "String"
*                      
*                  
*               
*
*
*
*  @return null
*/  


function write_log($comment) {



  $log = " ".get_client_ip()." ".get_client_browser()." ".get_client_referral()." ".$comment;
  $log = 'LOG : '.date("Y-m-d H:i:s")." - ".$log;
		//$sql = 'INSERT INTO transfer_history (transfer) VALUES ("'.$log.'")'; 
		//INSERT INTO transfer_history (transfer) VALUES ("$log")
   $sql = 'INSERT INTO ads_log (log) VALUES ("'.$log.'")'; 
   $sql_to_logs = $sql;
   $asql = mysql_query ($sql);

   if (!$asql)
	       {
		    die('mysql consult no valid: ' . mysql_error());
	       }
  




}  




  
?>
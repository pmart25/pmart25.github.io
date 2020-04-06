<?

/**
*
*  project  NCM_Ads
*  @file rep.php
*  @user  pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   print the advertising announce ()rep.php)
*           user story of rep.php
*
*            with paramerter n= ; 1st. check if it is a shortlink; if yes: goes to display_with_bar.php
*            with parameiter r= ; decrypt the strings and check if it has "ads_program"; 
*                                    if TRUE -> get ads_shortlink id; timestamp and checksum
*												then redirecto to final_url.
*
*
*
*  
*  @params  $n and $rand
*
*
*
*
*/

require_once("functions.php");


//$n = decryptIt($n);

	
if (isset($_REQUEST['r'])) {
$r = mysql_real_escape_string($_GET["r"]);
} else {
$r = -1;
}

if (isset($_REQUEST['n'])) {
$n = mysql_real_escape_string($_GET["n"]);
} else {
$n = -1;
}

$GLOBALS ["debug_mode"] = 0;



echo " r ".$r. " and n".$n;

if ( $r == -1 && $n == TRUE ) {
	
	
     /*
	 
	 1 comprueba que n esta en shortlinks
	 2 shortlink existe
	 3 muestra banner_upper_bar
	 
	 
	 */
	 
	 
	  $short_code = $n;
	 // $actual_link = $_SERVER['REQUEST_URI']."./display_with_bar.php?r=";
      $actual_link = "./display_with_bar.php?n=";


        /**
         *  
         *  
         *  get final url
         */

		//$to_encrypt =    "ads_id=".$ads_id."&ads_web_id=".$ads_web_id."&datestamp=".$datestamp."&checksum=1";
		 
		// for example: rep.php?n=aOSs04 
		$sql = 'SELECT * FROM ads_pub_shortlinks WHERE short_code = "'.$short_code.'"';
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
	   	$asql_list = mysql_fetch_array($asql);

		if ( mysql_num_rows($asql) > 0) {
		
		
		   echo " Hello is a valid Shortcode! 0";
		   	$header_string = 'Location: '.$actual_link.$short_code;
			var_dump($header_string);
			header ($header_string);
		
		
		} else {
		
		
		
		
	 
	 
	 
	 
	 
	 
	 /**
	  *  
	  *  
	  *  Si no es un shortlink es un Banner y se interpreta la $n como $ads_web_id
	  *  
	  *  
	  */
	 

     $ads_web_id = $n;

	 $sql = 'SELECT ads_unit_propierties FROM ads_webs WHERE ads_web_id ="'.$ads_web_id.'"';
	 $asql = mysql_query($sql);
	 if (!$asql)
	   {
		 die('mysql consult no valid: ' . mysql_error());
	   }
	$asql_list = mysql_fetch_array($asql);

	$json_query = $asql_list[0];
	////echo $json_query;
	$json_query = json_decode($json_query);
	$height = $json_query->{"height"};
	$width  = $json_query->{"width"};
	$bg_color  = $json_query->{"bg_color"};
	$font_family  = $json_query->{"font_family"};
	$font_size  = $json_query->{"font_size"};
	$ads_type = $json_query->{"ads_type"};
	$section = $json_query->{"section"};
	$device = $json_query->{"device"};
	 

	 
    /*
		$height = "height=".$height;
	$width = "width=".$width;
	$bg_color = "bg_color=".$bg_color;
	$font_family = "font-family=".$font_family; 
	 
	 
	 
	 $replace = array ($height, 
					   $width,
					   $bg_color,
					   $font_family, 
					   $font_size );*/
	 
	 
	 //it must get a ads_id from this section
	 
	 //start debug_mode
	 if ( $GLOBALS ["debug_mode"] == 1) {
	 
	 //seleccionar campanyas activas y que traten de esa seccion
	 $time_start_total = microtime(true);
	 echo 'section : '.$section;
	 $time_start = microtime(true);
	 }
	 //end debug_mode
	 
	 $sql = 'SELECT ads_campaign_id FROM ads_campaign WHERE section = "'.$section.'" AND state = "2" LIMIT 10'; //state = 2 ; running
	 // SELECT ads_campaign_id FROM ads_campaign WHERE section = 6  AND state = 2 ORDER BY 0, 10
	 
	 //start debug_mode
	 if ( $GLOBALS ["debug_mode"] == 1) {
	 echo "\n";
	 echo '<br>';
	 echo $sql;
	 }
	 //end debug mode
	 
	 $asql = mysql_query ($sql);
	 if (!$asql)
		{
		   echo "rand_campaign  -->";
		   die('mysql consult no valid: ' . mysql_error());
		}
	 $asql_list = mysql_fetch_array($asql);
	 
	//////// 
	 
	 
	  // Si no hay valores disponibles de asql mostrar valor por defecto 0.
	 
	 if (empty($asql_list)) {
	          $rand_ads_id = 0;
	 } else
	 
	 {
	 
			 
			/////// 
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
			 
			 echo "\n";
			 echo '<br>';
			 $time_end = microtime(true);
			 $time_total = $time_end -  $time_start;
			 echo '<p> la consulta '.$sql.' ha tardado '.$time_total;

			 echo "\n";
			 echo '<br>';
			 echo '$asql_list: '.$asql_list[0];
			 echo "\n";
			 }  
			 //end debug_mode
			 
			 $total_asql_list = count($asql_list);
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
			 echo '<br>total results in asql_list : '. $total_asql_list;
			 echo '<br>';	 
			 }
			 //end debug_mode
			 
			 $asql_list_index = rand(0,count($asql_list)-1);
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
			 echo '<br>index in asql_list : '.  $asql_list_index;
			 }
			 //end debug_mode

			 $rand_campaign = $asql_list[$asql_list_index];
	 

	         //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
			 echo '<br>rand_campaign : '.$rand_campaign;
			 $time_start = microtime(true);
			 
			 }
			 //end debug_mode
			 $sql = 'SELECT ads_ad_id FROM ads_ad WHERE belongs_to_campaign = "'.$rand_campaign.'"';
			 

			 
			 $asql = mysql_query ($sql);
			 if (!$asql)
				{
				 echo "ads_ad_id  -->";
				 die('mysql consult no valid: ' . mysql_error());
				}
			 $asql_list = mysql_fetch_array($asql);
			 
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {#
					 echo $sql;
					 echo "\n";
					 echo '<br>';	
					 $time_end = microtime(true);
					 $time_total = $time_end -  $time_start;
					 echo '<p> la consulta '.$sql.' ha tardado '.$time_total;
					 var_dump($asql_list);	 
			 
			 }
			 //end debug_mode
	 
			 $total_asql_list = count($asql_list);
			 
			 
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
					echo '<br>total results in asql_list for ads : '. $total_asql_list;	
			 }
			 //end debug_mode
			 
			 
			 $rand_ads_id = $asql_list[rand(0,count($asql_list))];
			 
			 
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
					echo '$asql_list: '.$asql_list[0];
					echo "\n";
			 }
			 //end debug_mode
			 
			 $total_asql_list = count($asql_list);
			 
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
					echo '<br>total results in asql_list : '. $total_asql_list;
					echo '<br>';	 
			 }
			 //end debug_mode
			 
			 $asql_list_index = rand(0,count($asql_list)-1);
			 
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
					echo '<br>index in asql_list : '.  $asql_list_index;
			 }
			 //end debug_mode
			 
			 $asql_list = array_values($asql_list);
			 
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
			 echo '<br>';
			 var_dump($asql_list);	
			 }
			 //end debug_mode
			 
			 
			 $rand_ads_id = $asql_list[$asql_list_index];	
			 
			 //start debug_mode
			 if ( $GLOBALS ["debug_mode"] == 1) {
					echo '<br>rand_ads : '.$rand_ads_id;	 
			 }
			 //end debug_mode
	 } //end else	 
	 
	 $json_content = get_content_in_json($rand_ads_id, $ads_web_id); //here will be changing according with the theme of the webpage
	 
	// echo "<p>json_content: ".$json_content.'<p/>';
	 
	 $json_query = json_decode($json_content);
	
	
	  //echo json_decode($asql_list);
	  
	$title= $json_query->{"title"};
	$display_url= $json_query->{"display_url"};
	$final_url= $json_query->{"final_url"};
	$ad_text_l1= $json_query->{"ad_text_l1"};
	$ad_text_l2=$json_query->{"ad_text_l2"};
	$section= $json_query->{"section"};
	$device= $json_query->{"device"};
	 
	 //start debug_mode
	 if ( $GLOBALS ["debug_mode"] == 1) {	
	 
	   echo '<p> content before replace: '.$content.' </p>';
	 
	 
	 }
	 //end debug_mode
	 
	 
	 $replace_0 = array ("height=".$height, 
						"width=".$width,
						"bg_color=".$bg_color,
						"font-family=".$font_family, 
						"font-size=".$font_size );
	
	
	
	
	 $search = array ("[height]","[width]","[bg_color]","[font_family]","[font_size]","[title]","[ads_text_l1]","[ads_text_l2]","[link]");					
	 
	 $replace = array ($height, 
						$width,
						$bg_color,
						$font_family, 
						$font_size,
						$title,
						$ad_text_l1,
						$ad_text_l2,
						$final_url);
						
						
	
	//start debug_mode
	if ( $GLOBALS ["debug_mode"] == 1) {	
	
	echo "<p>ads_text_l1: ".$ad_text_l1."</p>";
	echo "<p>ads_text_l1: ".$ad_text_l2."</p>";
	
	
	$time_start = microtime(true);
	}
	//end debug_mode
	
	 $sql = 'SELECT ads_code FROM ads_repository WHERE ads_rep_id = "'.$ads_type.'"';
	 $asql = mysql_query($sql);
	 if (!$asql)
	   {
		 die('mysql consult no valid: ' . mysql_error());
	   } 
	  $asql_list = mysql_fetch_array($asql);
	  
	//start debug_mode  
    if ( $GLOBALS ["debug_mode"] == 1) {	
	$time_end = microtime(true);
	 $time_total = $time_end -  $time_start;
     echo '<p> la consulta '.$sql.' ha tardado '.$time_total;
	}  
	//end debug_mode
	  $code =  $asql_list[0];
	  $code_1 = $code;
	  $code = str_replace($search, $replace, $code);
	  
      // print code
 
	  echo $code;
	  //echo "";
	  //echo '';
	 //start debug_mode 
	 if ( $GLOBALS ["debug_mode"] == 1) { 
	  $time_end_total = microtime(true);
	  $time_total = $time_end_total -  $time_start_total;
      echo '<p> la consulta total  ha tardado '.$time_total.'</p>';	  
	  //el fallo esta en update_visit_values
	  //update_visit_values($n);
      echo "el code1 es:";
	  echo '<pre class="ad_code_style">';
	  echo "\n";
	  echo '<br>'; 	
	  echo htmlentities($code_1);
	  echo "\n";
	  echo '<br>'; 
	  echo '</pre>'; 
	  
	  
	  echo "el code es:";
	  
	  
	  
	  echo "el code1 es:";
	  echo '<pre class="ad_code_style">';
	  echo "\n";
	  echo '<br>'; 	
	  echo htmlentities($code);
	  echo "\n";
	  echo '<br>'; 
	  echo '</pre>';
	  
		  
		$sql = 'SELECT hits_counter FROM ads_webs WHERE ads_web_id = "'.$ads_web_id.'"' ;
		$asql = mysql_query($sql);
		if (!$asql)
		{
		die('mysql consult no valid: ' . mysql_error());
		}
		$asql_list = mysql_fetch_array($asql);
		$hits_counter = $asql_list[0];
	     var_dump($hits_counter);
		 echo '<p>hit counter: '.$hits_counter.'</p>'; 
	    
		// clicks_counter 
		
		$sql = 'SELECT clicks_counter FROM ads_webs WHERE ads_web_id = "'.$ads_web_id.'"' ;
		$asql = mysql_query($sql);
		if (!$asql)
		{
		die('mysql consult no valid: ' . mysql_error());
		}
		$asql_list = mysql_fetch_array($asql);
		$clicks_counter = $asql_list[0];
	     var_dump($clicks_counter);
		 echo '<p>clikcs counter: '.$clicks_counter.'</p>'; 
	  
	  } //end if debug
	  
	  //end debug_mode
	  
	  
	  
	  update_visit_values($ads_web_id);


	  
	  } // end else
	  
	  

}  // end $n if


// start $r if

if ($r == TRUE && $n == -1)
{

	//echo "\n";
	
	
	
	
	
	$encrypted_r = $r;
	$decrypted_r = decrypt_it(rawurldecode($encrypted_r));
    
	echo $decrypted_r;
    //echo "\n<br>";	
	
	if ( $GLOBALS ["debug_mode"] == 1 ) 
	
		{
		
		echo $encrypted_r ;
		echo "\n";
		echo $decrypted_r;
		echo "\n";
		
		}
			
	$regex_pattern = '(ads_program)';
		
	$r_list_results = preg_match_all($regex_pattern, $decrypted_r, $r_list);
	//echo "\n<br>";
	//var_dump($r_list);
	//echo "\n<br>";
	//$ads_program = $r_list[0][0];   // -->  "ads_id=12
	var_dump($r_list);
	$ads_program = $r_list[0][0];  


	
	if ( strcmp ( $ads_program , "ads_program") == 0 ) {  //contains ads_program??
	
	    $regex_pattern = '([0-9]+)';
	    $r_list_results = preg_match_all($regex_pattern, $decrypted_r, $r_list);
		//echo "\n<br>";
		//var_dump($r_list);
		//echo "\n<br>";
		//$ads_program = $r_list[0][0];   // -->  "ads_id=12
		$ads_program = $r_list[0][0];  
		$ads_pub_shortlinks_id = $r_list[0][1]; 
		$timestamp = $r_list[0][2];
		$checksum = $r_list[0][3];
		
		if ( $GLOBALS ["debug_mode"] == 1 ) 
	
		{
			echo "\n<br>";	
			echo "ads_program: ".$ads_program;
			echo "\n<br>";    
			echo "\n<br>";	
			echo "ads_pub_shortlinks_id: ".$ads_pub_shortlinks_id;
			echo "\n<br>";		
			echo "timestamp: ".$timestamp;
			echo "\n<br>";	
			echo "checksum: ".$checksum;
			echo "\n<br>";
			
			
		}

	
       	$sql = 'SELECT long_url FROM ads_pub_shortlinks WHERE ads_pub_shortlinks_id = "'.$ads_pub_shortlinks_id.'"';
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
	   	$asql_list = mysql_fetch_array($asql);
		
		$final_url = $asql_list[0];	
			
		$header_string = 'Location: '.$final_url;
		
		if ( $GLOBALS ["debug_mode"] == 1 ) {
		echo "\n<br>";
		echo $header_string;
		echo "\n<br>";
		echo $final_url;
		echo "\n<br>";
		}	
		
		if ( $GLOBALS ["debug_mode"] == 0 ) {
		header ($header_string);
		
	
	    } 
	
	}
	
	else

	{
	
	
	
	
	
	$regex_pattern = '([0-9]+)';
		
	$r_list_results = preg_match_all($regex_pattern, $decrypted_r, $r_list);
	//echo "\n<br>";
	//var_dump($r_list);
	//echo "\n<br>";
	//$ads_program = $r_list[0][0];   // -->  "ads_id=12
	$ads_id = $r_list[0][0];   // -->  "ads_id=12"
	$ads_web_id = $r_list[0][1];
	$timestamp = $r_list[0][2];
	$checksum = $r_list[0][3];
		
	
	
	
	if ( $GLOBALS ["debug_mode"] == 1 ) 
	
	{
    echo "\n<br>";	
	echo "ads_id: ".$ads_id;
	echo "\n<br>";    
	echo "\n<br>";	
	echo "ads_web_id: ".$ads_web_id;
	echo "\n<br>";		
	echo "timestamp: ".$timestamp;
	echo "\n<br>";	
	echo "checksum: ".$checksum;
	echo "\n<br>";
	
	
	}
	


	
	//echo $ads_id;	
	$final_url = get_final_url($ads_id);#
	
	// check if final_url has a http://
	
	$regex_pattern = '(http://)';
		

		
	$r_list_results = preg_match($regex_pattern, $final_url, $http_test);
	
	if ($http_test == TRUE)
	{
		//echo "\n<br>";	
	    //echo "final_url SI tiene http : ".$final_url;
	    //echo "\n<br>";
		
	}
	else
	{
		//echo "\n<br>";	
	    //echo "final_url NO tiene http : ".$final_url;
	    //echo "\n<br>";
		$final_url = "http://".$final_url;
		
		
	}
	
	
    // increase a click counter
	
	$sql = 'SELECT clicks_counter FROM ads_webs WHERE ads_web_id = '.$ads_web_id;
	$asql = mysql_query($sql);
	$asql_list = mysql_fetch_array($asql);
	//echo "\n<br>";
	//echo $header_string;
	$clicks_counter = $asql_list[0];
	//echo "\n<br>";
	if ( $GLOBALS ["debug_mode"] == 1 ) 
	{
	echo "<p>clicks_counter before: ".$clicks_counter."</p>";
	}
	$clicks_counter = $clicks_counter + 1;
	$sql = 'UPDATE ads_webs SET clicks_counter = "'.$clicks_counter.'" WHERE ads_web_id = "'.$ads_web_id.'"';
	$asql = mysql_query($sql);
	//echo "\n<br>";
	//echo "click_counter after: ".$click_counter;
	
	
	
	
	$header_string = 'Location: '.$final_url;
	
	if ( $GLOBALS ["debug_mode"] == 1 ) 
	{
	echo "\n<br>";
	echo $header_string;
	echo "\n<br>";
	echo $final_url;
	echo "\n<br>";
	}	
	
	if ( $GLOBALS ["debug_mode"] == 0 ) 
	{
	header ($header_string);
    }
	
	
	
	
	}  // end else
	
	



} //end $r if



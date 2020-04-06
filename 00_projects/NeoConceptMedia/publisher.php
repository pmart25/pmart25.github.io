<?


/**
*
*  project  NCM_Ads
*  @file publisher
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   functions for advertisers
*/

require_once ("header.php")

?>


<?

require_once("functions.php");
require_once ("header.php");

?>



<?  //CONTENT




echo '<div class="content">';
require_once ("sidebar.php");
echo '<div class="content_text">';


echo '<h1> Publisher </h1>';

if (isset($_REQUEST['case'])) {
$case = mysql_real_escape_string($_POST["case"]);
} else {
$case = 0;
}

if (user_logged_in() == 1)


{   //start if login

echo '<p> Add new Revenue Streams to monetize your Web. </p>';
    
	
	
if (isset($_REQUEST['case'])) {
$case = mysql_real_escape_string($_POST["case"]);
} else {
$case = 99;

echo '<p> Programs available: </p>';	
echo '<div class=button_link>';
echo '<form class="button_link" method="POST" action="publisher.php">';
echo "\n";
echo '<input class="button_link" type=hidden name=case value=14>';
echo '<input class="button_link" type=submit  value="Shortlinks"></form>';

echo "\n";
echo '</div>';





echo '<div class=button_link>';
echo '<form class="button_link" method="POST" action="publisher.php">';
echo "\n";
echo '<input class="button_link" type=hidden name=case value=0>';
echo '<input class="button_link" type=submit  value="Banners"></form>';

echo '</div>';
}
 
	  




$GLOBALS ["debug_mode"] = 0;



  //echo '</div>';
   echo "\n<br>"; 
   echo "\n<br>"; 
   echo "\n<br>";    

	   
	if ($case == 0) {


			
			
			// control panel ads spaces
			

			/* start debug_mode  */
			
			
			if ( $GLOBALS ["debug_mode"] == 1 ) 
			{
				echo '<p>case 0</p>';
			}
			
			
			/* end debug_mode  */	

			
			$sql = 'SELECT * FROM ads_webs WHERE created_by = '.get_ads_user_id();
			$asql = mysql_query($sql);

			if (!$asql)
			{
			   die('mysql consult no valid: ' . mysql_error());
			}
			
			
			
			$ads_spaces_string = $asql[2];  
			
			echo '<table class="ad_table" >';
			echo "\n";
			echo '<tr>';
			echo '<td>';
			echo 'Id';
			echo '</td>';
			echo '<td>';
			echo 'Ads Unit Name';
			echo '</td>';
			echo '<td>';
			echo 'Clicks';
			echo '</td>';			
			echo '<td>';
			echo 'Actions';
			echo '</td>';
			while ($asql_list = mysql_fetch_row($asql))
			{
				
			   echo '<tr>';
			   echo '<td>';
			   echo "\n";
			   echo $asql_list[0]; // ads_webs_id
			   echo "\n";
			   echo '</td>';
			   echo '<td>';
			   echo "\n";
			   $json_query = $asql_list[2]; 

			   $json_query = json_decode($json_query);

			   print $json_query->{"ads_unit_name"};

			   echo "\n";
			   echo '</td>';
			   echo '<td>';
			   echo "\n";
			   echo $asql_list[6]; // hits_counter
			   echo "\n";
			   echo '</td>';
			   echo "\n";
			   echo '<td width="20%">';
			   echo "\n";
			   echo '<div id="action">';
			
			   
			   // Code for POST
			  
				echo '<form class="button_link" method="POST" action="publisher">';
				echo "\n";
			    echo '<input class="button_link" type=hidden name=case value=10>';
			    echo "\n";
			    echo '<input class="button_link" type=hidden name=ads_web_id value='.$asql_list[0].'>';
			    echo "\n";				
			    echo '<input class="button_link" type=submit  value="Delete this Ads Unit"></form>';
			    echo "\n";
			
			    echo '<form class="button_link" method="POST" action="publisher">';
				echo "\n";
			    echo '<input class="button_link" type=hidden name=case value=5>';
			    echo "\n";
			    echo '<input class="button_link" type=hidden name=ads_web_id value='.$asql_list[0].'>';
			    echo "\n";				
			    echo '<input class="button_link" type=submit  value="Edit this Ads Unit"></form>';
			    echo "\n";
			   
			  
			    echo '<div class="button_link">';
				echo '<form class="button_link" method="POST" action="publisher">';
				echo "\n";
			    echo '<input class="button_link" type=hidden name=case value=3>';
			    echo "\n";
			    echo '<input class="button_link" type=hidden name=ads_web_id value='.$asql_list[0].'>';
			    echo "\n";				
			    echo '<input class="button_link" type=submit  value="Get code of this Ads Unit"></form>';
			    echo "\n";
			    echo '</div>';
			   
			   echo '<br>';
			   echo "\n";
			   echo "</div>";
			   echo '</td>';
			   echo '</tr>';
			   echo "\n";	   
				
			}
			
			echo '</table>';
			echo "\n";
			
			
			echo "\n";
			echo '<br><br>';




			echo "\n";
			echo '<form  class="ad_form2" method=POST action="publisher">';
			echo "\n";
			echo '<input class="ad_form2" type=hidden name=case value=4>';
			echo "\n";
			echo '<p>Ads Name:</p><input class="ad_form2" type="text" name="ads_unit_name" value="Ads Name">';
			echo "\n";
			echo '<br>';
			echo '<p>Ads Type:</p><select class="ad_form2" type="text"  name="ads_type" width="100" onChange="redirect(this.options.selectedIndex)">';
			echo '<option value="0">Custom</option>';
			$sql = 'SELECT * FROM ads_repository WHERE 1';
			$asql = mysql_query($sql);
			if (!$asql)
			 {
				die('mysql consult no valid: ' . mysql_error());
			 }
			while ($asql_list = mysql_fetch_row($asql)) 
				{
				 echo "\n";
				 echo '<option value="'.$asql_list[0].'">'.$asql_list[1].'</option>';	
				 echo "\n";					
				}
			echo '</select>';
			echo "\n";
			echo '<br>';
			
			echo '<p>Height:</p><input class="ad_form2" type="text" name="height" value="100">';
			echo "\n";   
				echo '<br>';
			echo '<p>Width:</p><input class="ad_form2" type="text" name="width" value="100">';
			echo "\n";
			echo '<br>';
			echo '<p>Background Color:</p><input class="ad_form2" type="text" name=bg_color value="#FF00BB">';
			echo "\n";
			echo '<br>';
			echo '<p>Font Family:</p><input class="ad_form2" type="text" name=font_family value="Sans-Serif">';
			echo "\n";
			echo '<br>';
			echo '<p>Font Size:</p><input  class="ad_form2" type="text" class="ad_form2" name=font_size value="15">';
			echo "\n";
			echo '<br>';
			echo '<p>Section:</p><select  class="ad_form2" type="text" class="ad_form2" name="section">';
			echo '<option value="0">Other</option>';
			$sql = 'SELECT * FROM ads_sections WHERE 1';
			$asql = mysql_query($sql);
			if (!$asql)
			 {
				die('mysql consult no valid: ' . mysql_error());
			 }
			while ($asql_list = mysql_fetch_row($asql)) 
				{
				 echo "\n";
				 echo '<option value="'.$asql_list[0].'">'.$asql_list[1].'</option>';	
				 echo "\n";					
				}
			echo '</select>';
			echo "\n";
			echo '<br>';
			echo '<p>Device Preference:</p><select class="ad_form2" class="ad_form2" type="text" name=device value="Device">';
			$sql = 'SELECT * FROM ads_devices WHERE 1';
			$asql = mysql_query($sql);
			if (!$asql)
			 {
				die('mysql consult no valid: ' . mysql_error());
			 }
			while ($asql_list = mysql_fetch_row($asql)) 
				{
				 echo "\n";
				 echo '<option value="'.$asql_list[0].'">'.$asql_list[1].'</option>';	
				 echo "\n";					
				}
			
			echo "\n";
			echo '</select>';
			echo "\n";
			echo '<br>';
			echo '<p>Web where your want copy this Ads Unit:</p><input class="ad_form2"  type="text" name=web value="www.yoursite.com">';
			echo "\n";
			echo '<br>';
			echo "\n";
			echo '<br><br>';
			echo '<input class="ad_form2" type="submit" value="Save Ads Unit">';
			echo '</form>';		
			
				 
		 
		 echo "\n";
		 echo '</br>'; 	 
		 echo "\n";
		 

		
		echo "\n";
		echo "</form>";



	} elseif ($case == 1) {	 
		 	
			
		if ( $GLOBALS ["debug_mode"] == 1 ) 
			{
				echo '<p>case 1</p>';
			}
				
		echo '<p>You can create a new campaign here</p>';
		echo "\n";
		echo '<form  class="ad_form2" method=POST name="create_campaign" action="publisher">';
		echo "\n";
		echo '<input  type=hidden name="case" value="2">';
		echo "\n";
		echo '<input class="ad_form2"  type="text" size="50" name="campaign_name">';
		echo "\n";
		echo '<br>';
		echo '<p>Select a Budget for your Campaign:</p>';
		echo '<br>';
		echo '<select  class="ad_form2" name="budget">';
		echo "\n";
		echo '<option value="15"> 15 USD</option>';
		echo "\n";
		echo '<option value="30"> 30 USD</option>';
		echo "\n";
		echo '<option value="50"> 50 USD</option>';
		echo "\n";
		echo '</select>';
		echo "\n";
		echo '<br>';
		echo "\n";
		echo '<p>Select a section which describes your Campaign:</p>';
		echo '<br>';
		echo '<select  class="ad_form2" name="section">';
		echo "\n";
		$sql = "SELECT * FROM ads_sections";
		$asql = mysql_query($sql);
	    echo '<option value="">Still I dont know</option>';
		echo "\n";	
		while ($asql_list = mysql_fetch_array($asql))
		{
			echo '<option value="'.$asql_list[0].'">'.$asql_list[1].'</option>';
		    echo "\n";	
		
		}
		echo '</select>';
		echo '<br><br>';
		echo '<input  class="ad_form2" type="submit"  value="Create campaign" >';
		echo "\n";
		echo '</form>';
		

	    echo "\n";
		echo '<br>'; 	 
		
	    echo '<a href="publisher"> Go to Publisher main page </a>';

		
	} elseif ($case == 2) {
		
		 // Add the Ad Unit in the database
		



		 echo "\n";


	} elseif ($case == 3) {	

		// Get the code of the Ads Unit
		
	
		
		 $ads_web_id = mysql_real_escape_string($_POST["ads_web_id"]);
		 
		 	if ( $GLOBALS ["debug_mode"] == 1 ) 
			{
		     echo 'Get ads_unit_propierties: ';
			 echo '<p>case 3</p>';
			 echo '<p>$ads_web_id = '.$ads_web_id.'</p>';
		    }
		 $sql = 'SELECT ads_unit_propierties FROM ads_webs WHERE ads_web_id ="'.$ads_web_id.'"';
		 $asql = mysql_query($sql);
		 if (!$asql)
		   {
			 die('mysql consult no valid: ' . mysql_error());
		   }
		$asql_list = mysql_fetch_array($asql);

		$json_query = $asql_list[0];
		
		if ( $GLOBALS ["debug_mode"] == TRUE) {
		echo "\n";
		echo "<p> See Json Query: </p>";
		echo $json_query;
		echo "\n";
		echo '<br>';
		
		}
		
		$json_query = json_decode($json_query);
	
		$height = $json_query->{"height"};
		$width  = $json_query->{"width"};
		$bg_color  = $json_query->{"bg_color"};
		$font_family  = $json_query->{"font_family"};
		$font_size  = $json_query->{"font_size"};
		$ads_type = $json_query->{"ads_type"};
		 
		if ( $GLOBALS ["debug_mode"] == TRUE) {
		 
		echo '<p>height='.$height.'</p>';
		echo '<p>width='.$width.'</p>';
		echo '<p>bg_color='.$bg_color.'</p>';
		echo '<p>font_family='.$font_family.'</p>';
		echo '<p>font-size='.$font_size.'</p>';
		
		 }
		 
		 $search = array ("[height]","[width]","[bg_color]","[font_family]","[font_size]","[content]");
		 
		
		 
		 
		 $content = get_content(129);
		 
		 $replace_0 = array ("height=".$height, 
							"width=".$width,
							"bg_color=".$bg_color,
							"font-family=".$font_family, 
							"font-size=".$font_size );
							
		 $replace = array ($height, 
							$width,
							$bg_color,
							$font_family, 
							$font_size,
							$content);
		 
		 	if ( $GLOBALS ["debug_mode"] == 1 ) 
			{
				echo 'Print Ads_Type: '.$ads_type;
		        echo "\n";
		        echo '<br>';	 
		    }
		 echo '<h1>Get your code</h1>';
		 echo '<p>Get your code for your advertising unit. </p>';
		 $sql = 'SELECT ads_code FROM ads_repository WHERE ads_rep_id = "'.$ads_type.'"';
		 $asql = mysql_query($sql);
		 if (!$asql)
		   {
			 die('mysql consult no valid: ' . mysql_error());
		   } 
		  $asql_list = mysql_fetch_array($asql);
		  $code =  $asql_list[0];
		  $code_1 = $code;
		  $code = str_replace($search, $replace, $code);
		 


         if ( $GLOBALS ["debug_mode"] == TRUE) {

		 // print code
		  echo "\n";
		  echo '<br>';   
		  echo '<div class="div_preview_ads" >'	;
		  echo '<p>'.$code_1.'</p>';
		  echo '</div>';
		  echo "\n";
		  
		  echo '<br>';
		  
		  }
		  
		  
		  echo "\n";
		  echo '<br>';   
		  echo '<div class="div_preview_ads" >'	;
		  echo '<p>'.$code.'</p>';
		  echo '</div>';
		  echo "\n";
		  echo '<br>';
		  
		  $height = intval($height);
		  $width = intval($width);
		  
		  $height = $height + 10;
		  $width = $width + 10;
		  
		  if ($GLOBALS ["local"]  == 1) {
		  
		  $iframe_code = '<iframe height='. $height .' width='. $width .' src="./rep.php?n='.$ads_web_id.'"  frameBorder="0" scrolling="no"></iframe>';
		  
		
		  
		  } else {
		  
		  $iframe_code = '<iframe height='. $height .' width='. $width .' src="http://ncp.freeiz.com/pub_test/rep.php?n='.$ads_web_id.'"  frameBorder="0" scrolling="no"></iframe>';
		  
		  }
		  
		  //echo $iframe_code;
		  echo '<br>';
		  echo "\n";
	      echo '<br>';
		  echo "\n";  
		  echo '<br>';
		  echo "\n";  
		  echo '<br>';
		  echo "\n";  
		  echo '<p> Paste this code in your website: </p>';
		  $search = array ("<",">");
		  $replace = array ("&lt" ,"&gt");
		  $iframe_code = str_replace($search, $replace, $iframe_code);
		  echo '<pre class="ad_code_style">';
		  echo "\n";
		  	
		  echo $iframe_code;
		  echo "\n";
		
		  echo '</pre>'; 

	   
	   
		 
		 echo "\n";
		 echo '<br>';
         echo  '<a href="publisher"> Go to Publisher main page </a>';

		 
	} elseif ($case == 4) {

		// Save the Ad Unit	
		
			 // Add the Ad Unit in the database
		
		 $web = mysql_real_escape_string($_POST["web"]);
		 $description = mysql_real_escape_string($_POST["description"]);
		 $ads_unit_name = mysql_real_escape_string($_POST["ads_unit_name"]);
		 $height  = mysql_real_escape_string($_POST["height"]);
		 $width  = mysql_real_escape_string($_POST["width"]);
		 $bg_color  = mysql_real_escape_string($_POST["bg_color"]);
		 $font_family  = mysql_real_escape_string($_POST["font_family"]);
		 $font_size  = mysql_real_escape_string($_POST["font_size"]);
		 $ads_type = mysql_real_escape_string($_POST["ads_type"]);
		 $section  = mysql_real_escape_string($_POST["section"]);
		 $device  = mysql_real_escape_string($_POST["device"]);
		 $ads_web_id = mysql_real_escape_string($_POST["ads_web_id"]);
		 
		 
		 
		 
		 
		$ads_unit_propierties = array(	
								'ads_unit_name' => $ads_unit_name,
								'height' => $height,
								'width' => $width,
								'bg_color' => $bg_color,
								'font_family' => $font_family,
								'font_size' => $font_size,
								'ads_type' => $ads_type,
								'section' => $section,
								'device' => $device	);
		
		$ads_unit_propierties = json_encode($ads_unit_propierties);	
		$ads_unit_propierties = str_replace('"','\"',$ads_unit_propierties);
		//echo $ads_unit_propierties;
		 
		 
		 
		 if ( $ads_web_id > 0)
		 {
			

		   $sql = 'UPDATE ads_webs SET created_by =   "'.get_ads_user_id().'", 
		                               ads_unit_propierties = "'.$ads_unit_propierties.'",
									   url_advertiser = "'.$web.'", 
									   state = "0", 
									   hits_counter = "0",
									   clicks_counter = "0"
				                       WHERE ads_web_id = "'.$ads_web_id.'"';
				 
			
		   //echo $sql;
		   echo "\n";
		   echo '<br><br>';
		   $asql = mysql_query($sql);
		   if (!$asql)
		   {
		    die('mysql consult no valid: ' . mysql_error());
		   }  			
			 
			 
		 } else {
		 
		 

		echo "\n";
		echo '<br><br>';
		$sql = 'INSERT INTO ads_webs ( created_by, ads_unit_propierties , url_advertiser, state, hits_counter, clicks_counter )
				 VALUES ( "'.get_ads_user_id().'","'.$ads_unit_propierties.'","'.$web.'","0","0", "0" )';	
		
		//echo $sql;
		echo "\n";
		echo '<br><br>';
		$asql = mysql_query($sql);
		 if (!$asql)
		 {
		  die('mysql consult no valid: ' . mysql_error());
		 }  

		 } // end else
		
	    if ( $GLOBALS ["debug_mode"] == 1 ) 
			{
				echo '<p>case 4</p>';
			}
		
		echo '<p>Your web site is successfully saved into the system.</p>';
		echo '<p>Please be patient for get a approval.</p>';
		echo "\n";
		echo '<br>'; 	 
		
		echo '<a href="publisher"> Go to Publisher main page </a>';

      

	} elseif ($case == 5) {	
		 
		$ads_web_id = mysql_real_escape_string($_POST["ads_web_id"]);
		 
		echo "\n";
		echo '<br>'; 
		
	    if ( $GLOBALS ["debug_mode"] == 1 ) 
			{
				echo '<p>case 5</p>';
			}
		 
		$sql = 'SELECT * FROM ads_webs WHERE ads_web_id ="'.$ads_web_id.'"';
		$asql = mysql_query($sql);
		if (!$asql)
		   {
			 die('mysql consult no valid: ' . mysql_error());
		   }
		echo "\n";
		echo '<br>'; 
		while ($asql_list = mysql_fetch_row($asql))
			{

				
			$json_query = $asql_list[2];
			$web = $asql_list[3];
			
			echo "\n";
			echo '<br>'; 
			$json_query = json_decode($json_query);
			
			
			echo '<form method=POST class="ad_form2" action="publisher">';
			echo "\n";
			echo '<input type=hidden name=case value=6>';
			echo '<input type=hidden name=ads_web_id value='.$ads_web_id.'>';
			echo '<p>Ads Name:</p><input class="ad_form2"  type="text" name=ads_unit_name value="'.$json_query->{'ads_unit_name'}.'">';
			echo "\n";
			echo '<p>Height:</p><input class="ad_form2"  type="text"  name=height value="'.$json_query->{'height'}.'">';
			echo "\n";
			echo '<p>Width:</p><input class="ad_form2" type="text" name=width value="'.$json_query->{"width"}.'">';
			echo "\n";
			echo '<br>';
			echo '<p>Background Color:</p><input class="ad_form2"  type="text" name=bg_color value="'.$json_query->{"bg_color"}.'">';
			echo "\n";
			echo '<br>';
			echo '<p>Font Family:</p><input class="ad_form2" type="text" name=font_family value="'.$json_query->{"font_family"}.'">';
			echo "\n";
			echo '<br>';
			echo '<p>Font Size:</p><input class="ad_form2" type="text"  name=font_size value="'.$json_query->{"font_size"}.'">';
			echo "\n";
			echo '<br>';

			echo '<br>';
	//////////////		
			
			echo '<p>Ads Type:</p><select class="ad_form2" type="text" name="ads_type" value="ads_type">';
			echo '<option value="0">Custom</option>';
			$sql = 'SELECT * FROM ads_repository WHERE 1';
			$asql = mysql_query($sql);
			if (!$asql)
			 {
				die('mysql consult no valid: ' . mysql_error());
			 }
			   while ($asql_list = mysql_fetch_row($asql)) 
				{
				 
				 if ( $asql_list[0] != $json_query->{"ads_type"} ) 
					 // if not the selected value , then: print			 
				  {
					echo "\n";
					echo '<option value="'.$asql_list[0].'">'.$asql_list[1].'</option>';	
					echo "\n";					
				  }	
					else {
					 
					echo "\n";
					echo '<option value="'.$asql_list[0].'" selected>'.$asql_list[1].'</option>';	
					echo "\n";					 
	 
				 } 			
					
				}
			echo '</select>';
			echo "\n";
			echo '<br>';	
		
	////////////////
				
			echo '<p>Section:</p><select class="ad_form2"  type="text"name=section value="Section">';
			echo '<option value="0">Other</option>';
			$sql = 'SELECT * FROM ads_sections WHERE 1';
			$asql = mysql_query($sql);
			if (!$asql)
			 {
				die('mysql consult no valid: ' . mysql_error());
			 }
			while ($asql_list = mysql_fetch_row($asql)) 
				{
				 if ( $asql_list[0] != $json_query->{"section"} ) 
					 // if not the selected value , then: print			 
				  {
					
					echo "\n";
					echo '<option value="'.$asql_list[0].'">'.$asql_list[1].'</option>';	
					echo "\n";	 
					 
				  } // if is the selected value, print selected!
				  else {
					 
					echo "\n";
					echo '<option value="'.$asql_list[0].'" selected>'.$asql_list[1].'</option>';	
					echo "\n";					 
					  
					 
					 
				 } 			
				}
			echo '</select>';
			echo "\n";
			echo '<br>';
			echo '<p>Device Preference:</p><select class="ad_form2" type="text" name=device value="Device">';
			$sql = 'SELECT * FROM ads_devices WHERE 1';
			$asql = mysql_query($sql);
			if (!$asql)
			 {
				die('mysql consult no valid: ' . mysql_error());
			 }
			while ($asql_list = mysql_fetch_row($asql)) 
				{
			
				 if ( $asql_list[0] != $json_query->{"device"} ) 
					 // if not the selected value , then: print			 
				  {
					
					echo "\n";
					echo '<option value="'.$asql_list[0].'">'.$asql_list[1].'</option>';	
					echo "\n";	 
					 
				  } // if is the selected value, print selected!
				  else {
					 
					echo "\n";
					echo '<option value="'.$asql_list[0].'" selected>'.$asql_list[1].'</option>';	
					echo "\n";					 
				  } 
							 
				}
			echo "\n";
			echo '</select>';
			echo '<p>Web where your want copy this Ads Unit:</p><input  class="ad_form2"  type="text" name=web value="'.$web.'">';
;
			echo "\n";
			echo '<br><br>';
			echo '<input class="ad_form2"  type="submit" value="Preview">';
			echo '</form>';		

			} 

		echo "\n";
		echo '<br>'; 	 

		
		
		
		echo '<a href="publisher"> Go to Publisher main page </a>';
		
		
		
		
		
	////////////////
	//	
	//	END CASE 5
	//	
	////////////////
		
		
	} elseif ( $case == 6) {
	
		
	////////////////
	//	
	//	START CASE 6 : Edit the Advertising Unit
	//	
	////////////////
		
		
		// Get the code of the Ads Unit
		 $ads_web_id = mysql_real_escape_string($_POST["ads_web_id"]);
		 
		 
		 $web = mysql_real_escape_string($_POST["web"]);
		 $description = mysql_real_escape_string($_POST["description"]);
		 $ads_unit_name = mysql_real_escape_string($_POST["ads_unit_name"]);
		 $height  = mysql_real_escape_string($_POST["height"]);
		 $width  = mysql_real_escape_string($_POST["width"]);
		 $bg_color  = mysql_real_escape_string($_POST["bg_color"]);
		 $font_family  = mysql_real_escape_string($_POST["font_family"]);
		 $font_size  = mysql_real_escape_string($_POST["font_size"]);
		 $ads_type = mysql_real_escape_string($_POST["ads_type"]);
		 $section  = mysql_real_escape_string($_POST["section"]);
		 $device  = mysql_real_escape_string($_POST["device"]);
		 
		 
		 if ( $GLOBALS ["debug_mode"] == 1 ) 
			{
				echo '<p>case 6</p>';
			}
			
		 echo 'Get ads_unit_propierties: ';

		 
		 
		echo '<p>ads_name= '.$ads_unit_name.'</p>'; 
		echo '<p>height='.$height.'</p>';
		echo '<p>width='.$width.'</p>';
		echo '<p>bg_color='.$bg_color.'</p>';
		echo '<p>font_family='.$font_family.'</p>';
		echo '<p>font_size='.$font_size.'</p>';
		echo '<p>section='.$section.'</p>'; 
		echo '<p>device preference='.$device.'</p>'; 
		echo '<p>web: '.$web.'</p>';
		 
		 $search = array ("[height]","[width]","[bg_color]","[font_family]","[font_size]","[content]");
		 
	
		 
		 $content = get_content(129);
		 
		 $replace_0 = array ("height=".$height, 
							"width=".$width,
							"bg_color=".$bg_color,
							"font_family=".$font_family, 
							"font_size=".$font_size );
							
		 $replace = array ($height, 
							$width,
							$bg_color,
							$font_family, 
							$font_size,
							$content);
		 
		 
		 echo 'Print Ads_Type: '.$ads_type;
		  echo "\n";
		  echo '<br>';	 
		 

		 $sql = 'SELECT ads_code FROM ads_repository WHERE ads_rep_id = "'.$ads_type.'"';
		 $asql = mysql_query($sql);
		 if (!$asql)
		   {
			 die('mysql consult no valid: ' . mysql_error());
		   } 
		  $asql_list = mysql_fetch_array($asql);
		  $code =  $asql_list[0];
		  $code_1 = $code;
		  $code = str_replace($search, $replace, $code);
		  // print code
		


		  
		  echo "\n";
		  echo '<br>'; 
          echo '<div class="div_preview_ads" >'	;	  
		  echo '<p>'.$code.'</p>'; 
		  
		  echo '</div >';
		  echo "\n";
		  echo '<br>';
		  
		  
		echo '<form class="ad_form2" method=POST  action="publisher">' ; 
		echo "\n";
		echo '<input   type=hidden name=case value=4>';
		echo "\n";
		echo '<input   class="ad_form2" type=hidden name=ads_web_id value="'.$ads_web_id.'">';
		echo "\n";
		echo '<input class="ad_form2"  type=hidden name=ads_unit_name value="'.$ads_unit_name.'">';
		echo "\n";
		echo '<input class="ad_form2"  type=hidden name=height value="'.$height.'">';
		echo "\n";   //width="796" height="100">
		echo '<input class="ad_form2"  type=hidden name=width value="'.$width.'">';
		echo "\n";
		echo '<input class="ad_form2"  type=hidden name=bg_color value="'.$bg_color.'">';
		echo "\n";
		echo '<input class="ad_form2"  type=hidden name=font_family value="'.$font_family.'">';
		echo "\n";
		echo '<input class="ad_form2"  type=hidden  name=font_size value="'.$font_size.'">';
		echo "\n";
		echo '<input class="ad_form2"  type=hidden  name=ads_type  value="'.$ads_type.'">';
				echo "\n";
		echo '<input class="ad_form2"  type=hidden  name=section value="'.$section.'">';
				echo "\n";
		echo '<input class="ad_form2"  type=hidden  name=device value="'.$device.'">';
		echo '<input class="ad_form2"  type=hidden  name=web value="'.$web.'">';
		echo '<input class="ad_form2" type="submit" value="Save the changes of this Ads Unit">';
		echo '</form>';		
	   
	  
		 


        echo '<a href="publisher"> Go to Publisher main page </a>';
		
		
		
		
		
		
		 
	} elseif ($case == 10) {	

		// Delete this Ads Unit

		
		$ads_web_id = mysql_real_escape_string($_POST["ads_web_id"]);
		$sql = 'DELETE FROM ads_webs WHERE ads_web_id = "'.$ads_web_id.'"';
		$asql = mysql_query($sql);
		if (!$asql)  
		  {
			die('mysql consult no valid: ' . mysql_error());
		  }
		  else
		  {
			echo '<p>Your Ad Unit is correctly deleted.</p>';  
		  }
		echo "\n";
		echo '<br>';
		echo "\n";
		echo '<br>'; 	 
	    echo '<a href="publisher"> Go to Publisher main page </a>';

		
	  } // end if case
	  echo '<br><br\>'; 	 
	


	} elseif ($case == "99") {


	  
 } else {
	
	
	echo '<p>Please, log in.</p>';
	echo "\n";
	echo '<br><br><br><br><br><br><br><br><br><br>';
	
	
}//end if login



?>

<?
require_once ("footer.php");

?>

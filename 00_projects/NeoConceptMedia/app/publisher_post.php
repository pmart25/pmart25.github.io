
<?

/**
*
*  project  NCM_Ads
*  @file publisher_post.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   functions for publishers
*/
require_once ('header.php')

?>


<?

require_once('functions.php');
require_once('header.php');

?>



<?  //CONTENT


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input(mysql_real_escape_string($_POST["name"]));
  $email = test_input(mysql_real_escape_string($_POST["email"]));
  $website = test_input(mysql_real_escape_string($_POST["website"]));
  $comment = test_input(mysql_real_escape_string($_POST["comment"]));
  $gender = test_input(mysql_real_escape_string($_POST["gender"]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $campaign_name = test_input(mysql_real_escape_string($_POST["campaign_name"]));
  $content= test_input(mysql_real_escape_string($_POST["content"]));
  $new_name = test_input(mysql_real_escape_string($_POST["new_name"]));
  $comment = test_input(mysql_real_escape_string($_POST["comment"]));
  $gender = test_input(mysql_real_escape_string($_POST["gender"]));
}

echo '<div id="content">';

require_once ('sidebar.php');

echo "\n";

echo '<h1> Publisher </h1>';

if (user_logged_in() == 1)

{

   echo '<h1>  Your user is logged in and you have access to registered content </h1>';
   echo "\n";
   echo '<h2> Here is the content that you can use to promote and win money: </h2>';
   echo "\n";
   echo '<p>  Here will be displayed the diferent announces by created by publishers </p>';
   echo "\n";
   include_once 'config.php';
  

	$case = mysql_real_escape_string(mysql_real_escape_string($_POST["case"]);



	if   ( $case == 0) { 
		 
		 
		 
		 // mostrar campanyas
		 echo '<p> Show campaigns: </p>';
		// $get_ads_user_id();
		 echo 'id of user: ';
		 echo $_SESSION["userid"]);
		 echo '</br>';
		 
		 /////////////campanyas en ads_campaings////////////////////
		 
		 $sql = 'SELECT * FROM ads_campaign WHERE created_by = '. get_ads_user_id();
		 //echo $sql;

		 
		 $asql = mysql_query($sql);
		 if (!$asql)
		 {
			die('mysql consult no valid: ' . mysql_error());
		 }
		 
		 $num_rows = mysql_num_rows($asql);
		 
		 
		 if ($num_rows == 0 )
		 {
			 
			 echo '<p>No campaigns found!! </p> ';
			 echo '<p>At the moment, you do not have any campany</p>';
			 echo '';
			 echo '<a href="./publisher_post.php?case=1">Create a campaign here!!</a>';
			 
		 } else
			 
			 {
		  echo '<table border=1  >';
		  echo "\n";
		  echo '<tr><td> campaign id </td><td>Campaign Name</td><td>State</td><td> Actions</td></tr>';
		  echo "\n";	 
		 while ($asql_list = mysql_fetch_row($asql)){
		   
		   // print_r ($asql_list);
		  
		   echo '<tr>';
		   echo '<td>';
		   echo "\n";
		   echo $asql_list[0]; //$ads_campaign_id
		   $campaign_id = $asql_list[0];
		   echo "\n";
		   echo '</td>';
		   echo '<td width="796" height="100">';
		   echo "\n";
		   echo $asql_list[1];
		   echo "\n";
		   echo '</td>';
		   echo '<td>';
		   echo "\n";
           //echo 'Still not Implemented';

/*
		   $sql_1 = 'SELECT state FROM ads_campaign WHERE ads_campaign_id = "'.$$asql_list[0].'"';
		   $asql_1 = mysql_query ($sql);
	       if (!$asql_1)
	       {
		    die('mysql consult no valid: ' . mysql_error());
	       }
	   
		   $asql_list_1 = mysql_fetch_row($asql);
		   $state =  get_campaign_state_in_text ($asql_list_1[0]);
    
*/		   
           echo get_campaign_state_in_text($asql_list[6]);	;
   
		   echo '</td>';
		   echo "\n";
		   echo '<td width="180">';
		   echo "\n";
		   echo '<div id="action">';
		   echo '<br><a href="./publisher_post.php?case=3&campaign_id='.$asql_list[0].'">Manage Ads for this Campaing<br></a>';
		   echo '<br>';
		   echo "\n";
		   echo '<a href="./publisher_post.php?case=8&campaign_id='.$asql_list[0].'" >Delete Campaign<br></a>';
		   echo '<br>';
		   echo "\n";
		   echo '<a href="./publisher_post.php?case=6&campaign_id='.$asql_list[0].'" >Change Campaign Name<br></a>';
		   echo '</div>';
		   echo '</td>';
		   echo '</tr>';
		   echo "\n";
		  
		   } 
		   echo '</table>';
		   echo "\n";
		   echo '<br>';
		   echo '<a href="./publisher_post.php?case=1">You can create another a campaign here!!</a>';
		 
		 }
		 
		 
	 
		
		 
		  // si no hay campanyas
	   
		   // comprobar que el usuario no tiene ninguna campanya creada;
		 








		
		
	} elseif ( $case == 1) {
		
		echo '<p>You can create a new campaign here</p>';
		echo "\n";
		echo '<form method=POST name="create_campaign" action="publisher_post.php">';
		echo "\n";
		echo '<input type=hidden name="case" value="2">';
		echo "\n";
		echo '<input type="text" size="50" name="campaign_name">';
		echo "\n";
		echo '<br>';
		echo '<p>Select a Budget for your Campaign:</p>';
		echo '<br>';
		echo '<select name="Budget">';
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
		echo '<select name="section">';
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
		echo '<input type="submit" class="submit_style" value="Create campaign" >';
		echo "\n";
		echo '</from>';
		
	} elseif ( $case == 2) {
		
		// CREAR UNA CAMPANYA NUEVA
		
	  
		$campaign_name = mysql_real_escape_string($_POST["campaign_name"]);
		$budget = mysql_real_escape_string($_POST["Budget"]);
		$section = mysql_real_escape_string($_POST["section"]);
		$new_name = mysql_real_escape_string($_POST["new_name"]);
		$ads_campaign_id = mysql_real_escape_string($_POST["ads_campaign_id"]);
		$create_campaign_check = 0;
		
		if ($new_name == TRUE && $ads_campaign_id == TRUE ) 
		{
			
			 $campaign_name = $new_name;						
		}
		
		// CHECKING FOR A VALID NAME

		$new_concept = TRUE;
		
		//////////////////////////
		//
		//    start old concept of this check_string_validation
		//
		//////////////////////////
		
		if ( $new_concept == FALSE)
			
			{
		
					// START of CHECK: it uses NOT permitted characters	

					echo '<p>OLD CONCEPT</p>';
					$regex_pattern = '([a-zA-Z0-9 ]+)';
					$invalid_characters_test_result = !preg_match($regex_pattern, $campaign_name, $campaign_name_invalid_test);

					if ($invalid_characters_test_result == TRUE )
					 {
						$create_campaign_check = -3;
						
					 } else 
						 
						 {
							 
							$campaign_name = $campaign_name_invalid_test[0]; 
							 
						}
					// END of CHECK: it uses NOT permitted characters	
					
					
					
					
					
					
					// START of CHECK:  exist the introduced campaign name?
					
					
					$sql = 'SELECT * FROM ads_campaign WHERE ads_campaign_name = "'.$campaign_name.'" AND created_by = '.get_ads_user_id();
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

					// END of CHECK: exist the introduced campaign name?
					
					// START of CHECK:check if the name of the campaign is correct.
					
					if (   (strlen($campaign_name) < 8) || (strlen($campaign_name) > 50) )
					{
						
						$create_campaign_check = -2;	
					}		
					// END of CHECK:check if the name of the campaign is correct.		
					


					 
					

					
					
					
					// START of CHECK: user has more than 10 campaigns
					
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

					
					 
					// END of Process Campaign Check! if $create_campaign_check = 0  system allows to user create a campaign.
					
					
					
					
					
					
					
					if ($create_campaign_check == 0) 
					{
						
				
				
						if ($new_name == TRUE && $ads_campaign_id == TRUE) {
						
						
						echo '<p>New campaign name: '.$campaign_name.'</p>';
						echo "\n";
						echo '<br>';
						$sql = 'UPDATE ads_campaign SET ads_campaign_name = "'.$campaign_name.'" WHERE ads_campaign_id = "'.$ads_campaign_id.'"';
						$asql = mysql_query ($sql);
						if (!$asql)
						 {
							 die('mysql consult no valid: ' . mysql_error());
						 }
						 echo '<p>Your campaign has a new name.</p>';	
						
						}
					
				
				
				
						echo '<p>Campaign name: '.$campaign_name.'</p>';
						echo "\n";
						echo '<br>';
						$sql ='INSERT INTO ads_campaign (  ads_campaign_name, created_by,Budget,state ) 
						VALUES ("'.$campaign_name.'","'.get_ads_user_id().'","'.$budget.'" ,"0")';
						$asql = mysql_query ($sql);
						if (!$asql)
						{
							die('mysql consult no valid: ' . mysql_error());
						}
						echo '<p>Your campaign is created</p>';
					
					} 
					else
					{
						
						//echo '<p>Is no possible create a campaign with this name: '.$campaign_name.'</p>';

						switch ($create_campaign_check)
						{
						   case -1:
							   {
								   echo '<p>No valid campaign name. Exist another campaign with same name. </p>'; 
								   break;
							   }		   
						   case -2:
							   {
								   echo '<p>No valid campaign name. Campaign name must to be longer as 8 characters and up to 50. </p>'; 
								   break;
							   }
						   case -3:
							   {
								   echo '<p>No valid campaign name. A campaign name has not allowed characters. </p>'; 
								   break;
							   } 	 
						   case -4:
							   {
								   echo '<p>No possible create a campaign. A limit campaign number is reached. </p>'; 
								   break;
							   } 	 				   
						}
					}
			} //end if new_concept
		///////////////////////////
		//
		//   end old concept of this check_string_validation
		//
		//////////////////////////
		
		
		
		
		
		///////////////////////////
		//
		//   start new concept of this check_string_validation
		//
		//////////////////////////
		
	

		$result_list = check_string_validation ( 0, $campaign_name);
		
		if ($result_list[0] == 0 && $new_concept == TRUE  ) 
		{
			
		
	        if ($new_name == TRUE && $ads_campaign_id == TRUE) {
			
			
			echo '<p>New campaign name: '.$campaign_name.'</p>';
			echo "\n";
			echo '<br>';
			$sql = 'UPDATE ads_campaign SET ads_campaign_name = "'.$campaign_name.'" WHERE ads_campaign_id = "'.$ads_campaign_id.'"';
			$asql = mysql_query ($sql);
			if (!$asql)
			 {
				 die('mysql consult no valid: ' . mysql_error());
			 }
			 echo '<p>Your campaign has a new name.</p>';	
		    
			}
		
	
	
	
			echo '<p>Campaign name: '.$campaign_name.'</p>';
			echo "\n";
			echo '<br>';
			$sql ='INSERT INTO ads_campaign (  ads_campaign_name, created_by,Budget, section,state ) 
			VALUES ("'.$campaign_name.'","'.get_ads_user_id().'","'.$budget.'","'.$section.'"  ,"0")';
			$asql = mysql_query ($sql);
			if (!$asql)
			{
				die('mysql consult no valid: ' . mysql_error());
			}
			echo '<p>Your campaign is created</p>';
		  
		  
		} 
		elseif ($result_list[0] != 0 && $new_concept == TRUE )
		{
			
			echo '<p>Is no possible create a campaign with this name: '.$campaign_name.'</p>';
            echo '<br>';
		    echo '<p> Error : '.$result_list[0].' - '.$result_list[1].'</p>';
		}
		
		
		///////////////////////////
		//
		//   end new concept of this check_string_validation
		//
		//////////////////////////
		
		
		
		
		//echo '<p>check campaign name: '.$create_campaign_check.'</p>';
		echo '<a href="./publisher_post.php?case=0">Come back to campaigns index</a>';		
		
		
		
	} elseif ($case == 3) {
		
		
		// Panel de control de la campanya
		
		
		$campaign_name = mysql_real_escape_string($_POST["campaign_name"]);
		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		echo '<p>Add your Advertising spaces in this site</p>';
		
		$sql = 'SELECT * FROM ads_campaign WHERE ads_campaign_id = "'.$campaign_id.'" AND created_by = "'.get_ads_user_id().'"';
		$asql = mysql_query($sql);
		if (!$asql)
		{
		   die('mysql consult no valid: ' . mysql_error());
		}
		
		$asql_list = mysql_fetch_row($asql);
		$campaign_name = $asql_list[1];
		$budget = $asql_list[4];
		$section =  $asql_list[5];
		$state = $asql_list[6];


		



		
		// IF Campaign check!
	 /*   $asql_list = mysql_fetch_array($asql);
		if ( strcmp ($campaign_name, $asql[1]) != 0 ) {
			
			echo 'campaign name = '.$campaign_name;
			echo "<br>";
			echo 'asql = '.$asql[1]);
			echo '<p>Capaign name is invalid! </p>';
			
			
			
		} else { }
		*/
		
		// POST section of campaign id
		
	    $sql = "SELECT section FROM ads_campaign WHERE ads_campaign_id = ".$campaign_id;
		$asql = mysql_query($sql);
		$section = mysql_fetch_array($asql);
		
		
		
		
		
		
		echo '<p>Campaign name: '.$campaign_name.'</p>';
		echo "\n";	



		echo 'value of id campaign :'.$campaign_id; 
		
		echo '<p>Budget :'.$budget.'</p>';
		
		
		echo '<p>Section : '.get_section_text_from_id($section['section']).'</p>';
		
		echo '<p>'.change_state_campaign_to_running($campaign_id).'</p>';
		
		
		$sql = 'SELECT * FROM ads_ad WHERE belongs_to_campaign = "'.$campaign_id.'"';
		$asql = mysql_query($sql);

		if (!$asql)
		{
		   die('mysql consult no valid: ' . mysql_error());
		}
		
		
		
		$ads_spaces_string = $asql[2];  //&ads_spaces_string se parece a algo asi: "02021 & 021854 & 0215341 & 545487 & 4878 "
		
		echo '<table border=1 width="600">';
		echo "\n";
		echo '<tr>';
		echo '<td>';
		echo 'Id';
		echo '</td>';
		echo '<td>';
		echo 'Content';
		echo '</td>';	
		echo '<td>';
		echo 'Actions';
		echo '</td>';
		while ($asql_list = mysql_fetch_row($asql))
		{
			
		   echo '<tr>';
		   echo '<td>';
		   echo "\n";
		   echo $asql_list[0];
		   echo "\n";
		   echo '</td>';
		   echo '<td width="796" height="100">';
		   echo "\n";
		   $json_query = $asql_list[2];
		   $json_query = json_decode($json_query);
		   print $json_query->{"title"};
		   
		   echo "\n";
		   echo '</td>';
		   echo "\n";
		   echo '<td width="180">';
		   echo "\n";
		   echo '<div id="action">';
		   echo '<br><a href="./publisher_post.php?case=10&ads_id='.$asql_list[0].'&campaign_id='.$campaign_id.'">Delete this Ads Unit<br></a>';
		   echo '<br><a href="./publisher_post.php?case=11&ads_id='.$asql_list[0].'&campaign_id='.$campaign_id.'">Edit this Ads Unit<br></a>';
		   echo '<br><a href="./publisher_post.php?case=12&ads_id='.$asql_list[0].'&campaign_id='.$campaign_id.'">View this Ads Unit<br></a>';
		   echo '<br>';
		   echo "\n";
		   echo '</div>';
		   echo '</td>';
		   echo '</tr>';
		   echo "\n";	   
			
		}
		
		echo '</table>';
		echo "\n";
		
		
		if ( get_campaign_id_from_name($campaign_name) == -1)
		{ 

	//   campanya SIN advertising spaces, ofrecer a opcion de crear campanya
			echo '<p>this campaign has no ads spaces</p>';
			$sql = 'SELECT * FROM ads_repository WHERE 1';
			$asql = mysql_query($sql);
		
			if (!$asql)
			{
			   die('mysql consult no valid: ' . mysql_error());
			}
		   
		 if ( get_campaign_id_from_name($campaign_name) != -1 )
		 {  
			echo '<form method=POST action="./publisher_post.php">';
			echo "\n";	
			echo '<input type="hidden" name="case" value="4">';
			echo "\n";
			echo '<input type="hidden" name="campaign_name" value='.urlencode($campaign_name).'>';	
			echo "\n";
			echo '<select name="ads_repository_type">';
			echo "\n";
			echo '<option value="3"> Select your Ads Space Type</option>';	 // ads_rep_id
			echo "\n";
			while ($asql_list = mysql_fetch_row($asql))
			{ 
				echo '<option value="'.$asql_list[0].'">'.$asql_list[1].'</option>';	 // ads_rep_id and ads_name
				echo "\n";
			}// end while
			echo '</select>';
			echo "\n";
		 }else {}
		
		}else {
			
			
		//campanya CON advertising spaces, ofrecer a opcion de crear campanya
		
		echo '<p>This campaign has this ads spaces:</p>';	
		
		//meter los ids de los anuncios en una lista




		echo "\n";
		echo '<form method=POST class="ad_form2" action="publisher_post.php">';
		echo "\n";
		echo '<input type=hidden name=case value=4>';
		echo '<img src="./img/example_ads.png" class="ad_form2" >';
		echo '<p class="ad_form2.text">This image shows a example about Advetising Unit.<br>A format depends of the Advertising configuration.</p>';
		echo '<input type="hidden" name="campaign_id" value="'.$campaign_id.'">';
		echo "\n";
		echo '<p>Title:</p><input type="text" name=title value="Title">';
		echo "\n";
		echo '<br>';
		echo '<p>Display Url:</p><input type="text" name=display_url value="www.example.com">';
		echo "\n";
	
		echo '<br>';
		echo '<p>Final Url:</p><input type="text" name=final_url value="www.example.com/1.html">';
		echo "\n";
		echo '<br>';
		echo '<p>Ad Text Line 1:</p><input type="text" name=ad_text_l1 value="Ad Text Line 1">';
		echo "\n";
		echo '<br>';
		echo '<p>Ad Text Line 2:</p><input type="text" name=ad_text_l2 value="Ad Text Line 2">';
		echo "\n";
		echo '<br>';
		echo '<p>Section:</p><select type="text" class="ad_form2" name=section value="Section">';
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
		echo '<p>Device Preference:</p><select class="ad_form2" type="text" name=device value="Device">';
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
		echo '<br><br>';
		echo '<input type="submit" value="Preview">';
		echo '</form>';		
		} //end else
			
	   echo "\n";
	   echo '<br>';
	   echo '<a href="./publisher_post.php?case=0">Come back to Campaigns index </a>';
	   echo "\n";
	   echo "\n";
	   echo '<br>';
	   echo '<a href="./settings?campaign_id='.get_campaign_id_from_name($campaign_name).'">I am ready with this campaign, I want start now!</a>';
	   echo "\n";
		
	} elseif ($case == 4) {
		// preview
		echo "<p>Preview Ads SPACE</p>";
		//substuir el contenido del string "<-content->" por el contenido que el usuario quiere ver.
		$ads_id = mysql_real_escape_string($_POST["ads_id"]);
	
        $campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		$title= mysql_real_escape_string($_POST["title"]);
		$display_url= mysql_real_escape_string($_POST["display_url"]);
		$final_url= mysql_real_escape_string($_POST["final_url"]);
		$ad_text_l1= mysql_real_escape_string($_POST["ad_text_l1"]);
		$ad_text_l2= mysql_real_escape_string($_POST["ad_text_l2"]);
		$section= mysql_real_escape_string($_POST["section"]);
		$device= mysql_real_escape_string($_POST["device"]);
		$content = mysql_real_escape_string($_POST["content"]);
		$ads_repository_type = mysql_real_escape_string($_POST['ads_repository_type']);
		
		
		
		
		$content = array('title' => $title,
						 'display_url' => $display_url,
						 'final_url' => $final_url,
						 'ad_text_l1' => $ad_text_l1,
						 'ad_text_l2' => $ad_text_l2,
						 'section' => $section,
						 'device' => $device );
		$preview_ads_space = json_encode($content);				 
	  
		
		
		echo "<br>";	
		echo "\n";
		echo '<p>ads_id: '.$ads_id.'</p>';
		echo 'preview ads space: ';
		echo "<br><br>";		
        echo '<table border= 0 class="preview_ads" >';
		echo "\n";
		echo '<tr>';
		echo "\n";
		echo '<td>Fields';
		echo '</td>';		
		echo "\n";
		echo '<td>Values';
		echo '</td>';		
		echo "\n";
		echo '</tr>';
	    echo '<td>Title:';
		echo '</td>';	
		echo "\n";
	    echo '<td>'.$title;
		echo '</td>';	
		echo '</tr>';
	    echo '<td>Display Url:';
		echo '</td>';	
		echo "\n";
	    echo '<td>'.$display_url;
		echo '</td>';	
		echo '</tr>';
	    echo '<td>Final Url:';
		echo '</td>';	
		echo "\n";
	    echo '<td>'.$final_url;
		echo '</td>';	
		echo '</tr>';
	    echo '<td>Ads Line 1:';
		echo '</td>';	
		echo "\n";
	    echo '<td>'.$ad_text_l1;
		echo '</td>';	
		echo '</tr>';
	    echo '<td>Ads Line 2:';
		echo '</td>';	
		echo "\n";
	    echo '<td>'.$ad_text_l2;
		echo '</td>';	
		echo '</td>';	
		echo '</tr>';
	    echo '<td>Section:';
		echo '</td>';	
		echo "\n";
	    echo '<td>';
		get_section_text_from_id($section);
		echo '</td>';
		echo '</tr>';
	    echo '<td>Device:';
		echo '</td>';	
		echo "\n";
	    echo '<td>';
		get_device_text_from_id($device);
		echo '</td>';
		echo '</table>';


		 
		
		echo "\n";
		echo "<br><br>";
		echo "ads_space : ";
		echo "\n";
		echo "<br><br>";
		echo '<table border=1 width=120 height=120 class="ad_space"><tr><td>';
		echo "\n";
		echo '<h1>'.$title.'</h1>';
		echo "\n<br>";
		echo '<a href="'.$final_url.'" >'.$display_url.'</a>';
		echo "\n<br>";
		echo '<p>'.$ad_text_l1.'</p>';
		echo '<p>'.$ad_text_l2.'</p>';
		echo "\n<br>";
		echo '</tr></td></table>';
		echo '<form method=POST action="./publisher_post.php" >';
		echo "\n";
		echo '<input type="hidden" name="case" value="5">';
		if ( strcmp($ads_id,"") > 0 )
		{
		echo '<input type="hidden" name="ads_id" value="'.$ads_id.'">';	
		echo "\n";	
		}
		echo '<input type="hidden" name="campaign_id" value="'.$campaign_id.'">';
		echo '<input type=hidden name="preview_ads_space"  value="'.htmlentities($preview_ads_space).'">';
		echo "\n";
		echo "<br><br>";
		echo "\n";
		echo '<input type="submit"   value="Save your Ad Space">';
		echo "\n";
		echo '</form>';	
		echo '<a href="./publisher_post.php?case=3&campaign_id='.$campaign_id.'"> or Come back to Campaign </a>';
		echo "\n";
		

		
	} elseif ($case == 5) {	
	   //guardar valor en la base de datos de ads_ad
	   //1.guardamos el anuncio en ads_ad
	   //2.anyadimos la id del anuncio a 
       $campaign_id = mysql_real_escape_string($_POST["campaign_id"]);

	   $ads_space = mysql_real_escape_string($_POST["preview_ads_space"]);
	   $ads_id = mysql_real_escape_string($_POST["ads_id"]);
	   
	   $ads_space = html_entity_decode($ads_space);

	   $create_ads_space_check = 0;
	   
	   // START of CHECK: it uses NOT permitted characters	

		$new_concept = TRUE;
		
//////////////////////////		//////////////////////////		//////////////////////////		//////////////////////////		//////////////////////////		//////////////////////////		//////////////////////////		//////////////////////////		
		
		///////////////////////////
		//
		//   start old concept of this check_string_validation
		//
		//////////////////////////
/*		
        if ( $new_concept == FALSE   )
			
			{
		        echo '<p>OLD CONCEPT</p>' ;
		        echo '<br>';
				// START of CHECK: it uses NOT permitted characters
				$regex_pattern = '([a-zA-Z0-9 ]+)';
				$invalid_characters_test_result = !preg_match($regex_pattern, $ads_space, $ads_space_invalid_test);

				if ( $invalid_characters_test_result == TRUE )
				 {
					$create_ads_space_check = -3;
					
				 } 
				 
				 else  {
						 
						$ads_unit_name = $ads_unit_name_invalid_test[0]); 
						 
					}
					
				// END of CHECK: it uses NOT permitted characters	
				
				
				
				// START of CHECK:  exist the introduced ads space name?
				
				$ads_space = json_decode($ads_space);
				$ads_space_name = $ads_space["title"]);
				
				echo ("check still not implemented");
				
				$sql = 'SELECT * FROM ads_ad WHERE ads_campaign_id = "'.$campaign_id.'" AND created_by = '.get_ads_user_id();
				$asql = mysql_query($sql);
				if (!$asql)
				{
					die('mysql consult no valid: ' . mysql_error());
				}
						
				$asql_list = mysql_fetch_array($asql);
				$requested_campaign_name = $asql_list[0]);
				
				if ( $requested_campaign_name == TRUE)
				 {
					$create_campaign_check = -1;
					
				 }

				// END of CHECK: exist the introduced ads space name?
				
				
				// START of CHECK:check if the name of the campaign is correct.
				
				if (   (strlen($ads_space_name) < 8) || (strlen($ads_space_name) > 50) )
				{
					
					$create_campaign_check = -2;	
				}		
				// END of CHECK:check if the name of the campaign is correct.		
				


				 
				

				
				
				
				// START of CHECK: user has more than 10 ads_space
				
				$sql = 'SELECT ads_ad_id FROM ads_ad WHERE  belongs_to_campaign = "'.$ads_campaign_id.'"';
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
				
				
				
			   if ($create_ads_space_check == 0) 
				{
					$sql = 'SELECT ads_campaign_id FROM ads_campaign WHERE ads_campaign_name = "'.urldecode($campaign_name).'"';
					$asql = mysql_query($sql);

					if (!$asql)
					{
						die('mysql consult no valid: ' . mysql_error());
					}
			   
					if ( strcmp ($ads_id, "") > 0)
					{
				   //si exite un ads_id, entonces:  editar
					  $asql_list = mysql_fetch_array($asql);
					  $campaign_id = $asql_list[0]);   
					  //echo '<p>url address: '. $url_publisher .'</p>';
					  $sql = 'UPDATE ads_ad SET created_by="'.get_ads_user_id().'",
												content="'.$ads_space.'",
												belongs_to_campaign="'.$campaign_id.'" 
												WHERE ads_ad_id  = "'.$ads_id.'"';
					  $asql = mysql_query($sql);
					  if (!$asql)
					  {
					  die('mysql consult no valid: ' . mysql_error());
					  }
					  echo "\n";   
					  echo "\n";
					  echo 'Your advertising space is correctly edited.';
					  echo "\n";
					  echo '<br>';
				   
				   
					} else {
				   
				   //si NO exite un ads_id, entonces: crear nuevo   
				  
					$asql_list = mysql_fetch_array($asql);
					$campaign_id = $asql_list[0]);   
				   //echo '<p>url address: '. $url_publisher .'</p>';
				   $sql = 'INSERT INTO ads_ad (created_by,content,url_publisher,belongs_to_campaign) 
				   VALUES ("'.get_ads_user_id().'","'.$ads_space.'","'.$url_publisher.'","'.$campaign_id.'")';
				   echo $sql;
				   $asql = mysql_query($sql);
				   if (!$asql)
				   {
					die('mysql consult no valid: ' . mysql_error());
				   }
				   echo "\n";   
				   echo "\n";
				   echo 'Your advertising space is saved in your campaign';
				   echo "\n";
				   echo '<br>';
				  

				   }
					if (!$asql)
					{
					die('mysql consult no valid: ' . mysql_error());
					} 

				} // end if $create_campaign_check == 0	
				
				else
				{
					
					echo '<p>Is no possible create a campaign with this name: '.$campaign_name.'</p>';

					switch ($create_campaign_check)
					{
					   case -1:
						   {
							   echo '<p>No valid ads space name. Exist another campaign with same name. </p>'; 
							   break;
						   }		   
					   case -2:
						   {
							   echo '<p>No valid ads space name. Ads name must to be longer as 8 characters and up to 50. </p>'; 
							   break;
						   }
					   case -3:
						   {
							   echo '<p>No valid ads spacename. A campaign name has not allowed characters. </p>'; 
							   break;
						   } 	 
					   case -4:
						   {
							   echo '<p>No possible create a ads space. A limit of ads spaces number per campaign is reached. </p>'; 
							   break;
						   } 	 				   
					} // end swicht
				}//end else 
			} //end if new concept
*/		
	    ///////////////////////////
		//
		//   end old concept of this check_string_validation
		//
		//////////////////////////	
			
		///////////////////////////
		//
		//   start new concept of this check_string_validation
		//
		//////////////////////////
		
/*	

		$result_list = check_string_validation ( 1, $$ads_space);
		
		if ($result_list[0] == 0 && $new_concept == TRUE  ) 
		{
			
		    echo '<p>NEW CONCEPT</p>';
	        if ($new_name_ads_unit == TRUE && $ads_campaign_id == TRUE) {
			
			
			echo '<p>New ads unit name: '.$ads_space.'</p>';
			echo "\n";
			echo '<br>';
			$sql = 'UPDATE ads_campaign SET ads_campaign_name = "'.$$ads_space.'" WHERE ads_campaign_id = "'.$ads_campaign_id.'"';
			$asql = mysql_query ($sql);
			if (!$asql)
			 {
				 die('mysql consult no valid: ' . mysql_error());
			 }
			 echo '<p>Your campaign has a new name.</p>';	
		    
			}
		
	
	
	
			echo '<p>Ads unit name: '.$$ads_space.'</p>';
			echo "\n";
			echo '<br>';
			$sql ='INSERT INTO ads_ad (  ads_ad_name, created_by,Budget,state ) 
			VALUES ("'.$ads_space.'","'.get_ads_user_id().'","'.$budget.'" ,"0")';
			$asql = mysql_query ($sql);
			if (!$asql)
			{
				die('mysql consult no valid: ' . mysql_error());
			}
			echo '<p>Your Ads Unit is created</p>';
		  
		  
		} 
		elseif ($result_list[0] != 0 && $new_concept == TRUE )
		{
			
			echo '<p>Is no possible create a advertising unit with this name: '.$campaign_name.'</p>';
            echo '<br>';
		    echo '<p> Error : '.$result_list[0].' - '.$result_list[1].'</p>';
		}
		
*/		
		///////////////////////////
		//
		//   end new concept of this check_string_validation
		//
		//////////////////////////
//////////////////////////		//////////////////////////		//////////////////////////		//////////////////////////		

      	  
	   $result_list = check_ads_space_validation (  $campaign_id, $ads_space );

	   
	   if ( strcmp ($ads_id, "") > 0)
	   {
		   //si exite un ads_id, entonces:  editar
			  $asql_list = mysql_fetch_array($asql);
			  $campaign_id = $asql_list[0];   
			  //echo '<p>url address: '. $url_publisher .'</p>';
			  $sql = 'UPDATE ads_ad SET created_by="'.get_ads_user_id().'",
			                            content="'.$ads_space.'",
										belongs_to_campaign="'.$campaign_id.'" 
									    WHERE ads_ad_id  = "'.$ads_id.'"';
			  $asql = mysql_query($sql);
			  if (!$asql)
	          {
		      die('mysql consult no valid: ' . mysql_error());
	          }
			  echo "\n";   
			  echo "\n";
			  echo 'Your advertising space is correctly edited.';
			  echo "\n";
			  echo '<br>';
		   
		   
	   } 
	   
	   if ($result_list[0] == 0) {
		   
		   //si NO exite un ads_id, entonces: crear nuevo   
			  
		   
		   //echo '<p>url address: '. $url_publisher .'</p>';
		   $sql = 'INSERT INTO ads_ad (created_by,content,url_publisher,belongs_to_campaign) 
		   VALUES ("'.get_ads_user_id().'","'.$ads_space.'","'.$url_publisher.'","'.$campaign_id.'")';
		   //echo $sql;
		   $asql = mysql_query($sql);
		   if (!$asql)
		   {
			die('mysql consult no valid: ' . mysql_error());
		   }
		   echo "\n";   
		   echo "\n";
		   echo 'Your advertising space is saved in your campaign';
		   echo "\n";
		   echo '<br>';
	  

	   }elseif ($result_list[0] != 0) {
		   
		   echo '<p>Error :'.$result_list[0].'   '.$result_list[1].'</p>';
	   } 
	   


	   echo "\n";
	   echo '<br>';
		
		
			
	   echo "\n";
	   echo '<br>';
	   echo '<a href="./publisher_post.php?case=3&campaign_id='.$campaign_id.'">Come back to Campaign </a>';
	   echo "\n";
	   echo '<br>';
	   echo '<a href="./publisher_post.php?case=0">Come back to Campaigns index </a>';
	   echo "\n";
	   
	   
	} elseif ($case == 6) {	


		//CAMBIAR NOMBRE
		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		echo '<p>Do you want change the name of your campaign?</p>';
		echo '<form method=POST action="./publisher_post.php">';
		echo '<input type=hidden name="case"" value="2">';
		echo '<input type=hidden name="ads_campaign_id"" value="'.get_campaign_id_from_name($campaign_name).'">';
		echo '<input type=text name="new_name">';
		echo '<input type=submit class="submit_style" value="Change the name">';
		echo '</form>';
		//echo '<p>check campaign name: '.$create_campaign_check.'</p>';
		echo '<a href="./publisher_post.php?case=0">Come back to campaigns index</a>';	

		
	} elseif ($case == 7) {	

		$campaign_name = mysql_real_escape_string($_POST["campaign_id"]);
		$new_name = mysql_real_escape_string($_POST["new_name"]);
		
		$sql = 'UPDATE ads_campaign SET ads_campaign_name = "'.$new_name.'" WHERE ads_campaign_name = "'.$campaign_name.'"';
		$asql = mysql_query($sql);
		if (!$asql) 
		{
		die('mysql consult no valid: ' . mysql_error());
		}

		echo '<br>';
		echo '<a href="./publisher_post.php?case=0">Come back to Campaigns index </a>';
		echo "\n";
		//echo '<p>check campaign name: '.$create_campaign_check.'</p>';
		echo '<a href="./publisher_post.php?case=0">Come back to campaigns index</a>';	


	} elseif ($case == 8) {	
		 //BORRAR CAMPAIGN

		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		echo '<p>Are you sure you want delete your campaign?</p>';
		echo '<a href="./publisher_post.php?case=9&campaign_id='.$campaign_id.'">Yes. I want delete this Campaign.</a>';
		echo '<br>';
		echo '<a href="./publisher_post.php?case=0">No. I want come back to Campaigns index </a>';
		echo "\n";
		
	   
	} elseif ($case == 9) {	

		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		echo '<p>Your campaign is deleted</p>';

			
		   $sql = 'DELETE  FROM ads_campaign WHERE ads_campaign_id ='.$campaign_id ;
		   $asql = mysql_query($sql);
			   if (!$asql) 
				{
				die('mysql consult no valid: ' . mysql_error());
				}
			
	
			

		echo '<br>';
		echo '<a href="./publisher_post.php?case=0">Come back to Campaigns index </a>';
		echo "\n";

	   
	   
	} elseif ($case == 10) {	


		// comando borrar ads de base de datos
		$ads_id = mysql_real_escape_string($_POST["ads_id"]);
		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		$sql = 'DELETE FROM ads_ad WHERE ads_ad_id = "'.$ads_id.'"';
		$asql = mysql_query($sql);
		if (!$asql)  
		  {
			die('mysql consult no valid: ' . mysql_error());
		  }
		  
		echo '<p>Your Ad is correctly deleted.</p>';
		echo "\n";
		echo '<br>';
		echo '<a href="./publisher_post.php?case=3&campaign_id='.$campaign_id.'">Come back to Campaign </a>';
		echo "\n";
		echo '<br>';
		echo '<a href="./publisher_post.php?case=0">Come back to Campaigns index </a>';
		echo "\n";
		  
	} elseif ($case == 11) {	


		// comando editar ads de base de datos

		$ads_id = mysql_real_escape_string($_POST["ads_id"]);
		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		$sql = 'SELECT * FROM ads_ad WHERE ads_ad_id = "'.$ads_id.'"';
		$asql = mysql_query($sql);
		if (!$asql)  
		  {
			die('mysql consult no valid: ' . mysql_error());
		  }
		


		

		  
		  
		  
		while ($asql_list = mysql_fetch_row($asql))
		{

		$json_query = $asql_list[2];
		$json_query = json_decode($json_query);
		
		echo '<form method=POST class="ad_form2" action="publisher_post.php">';
		echo '<img src="./img/example_ads.png" class="ad_form2" >';
		echo '<p class="ad_form2.text">This image shows a example about Advetising Unit.<br>A format depends of the Advertising configuration.</p>';
		echo "\n";
		echo '<input type=hidden name=case value=4>';
		echo '<input type="hidden" name="campaign_id" value="'.$campaign_id.'">';
		echo "\n";
		echo '<input type="hidden" name=ads_id value="'.$ads_id.'">';
		echo "\n";
		echo '<p>Title:</p><input type="text" name=title value="'.$json_query->{"title"}.'">';
		echo "\n";
		echo '<br>';
		echo '<p>Display Url:</p><input type="text" name=display_url value="'.$json_query->{"display_url"}.'">';
		echo "\n";
		echo '<br>';
		echo '<p>Final Url:</p><input type="text" name=final_url value="'.$json_query->{"final_url"}.'">';
		echo "\n";
		echo '<br>';
		echo '<p>Ad Text Line 1:</p><input type="text" name=ad_text_l1 value="'.$json_query->{"ad_text_l1"}.'">';
		echo "\n";
		echo '<br>';
		echo '<p>Ad Text Line 2:</p><input type="text" name=ad_text_l2 value="'.$json_query->{"ad_text_l2"}.'">';
		echo "\n";
		echo '<br>';
//////////////		
		
	    echo '<p>Section:</p><select type="text" class="ad_form2" name=section value="Section">';
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
		echo "\n";
		echo '<br><br>';
		echo '<input type="submit" value="Preview">';
		echo '</form>';		
	
	
		} 
		 
		echo "\n";
		echo '<br>';
		echo "\n";
		echo '<br>';
		echo '<a href="./publisher_post.php?case=3&campaign_id='.$campaign_id.'">Come back to Campaign </a>';
		echo "\n";
		echo '<br>';
		echo '<a href="./publisher_post.php?case=0">Come back to Campaigns index </a>';
		echo "\n";
		
		
		
		
	} elseif ($case == 12) {	

	    $ads_id = mysql_real_escape_string($_POST["ads_id"]);
		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);

        get_preview_ads($ads_id);

				   
		echo "\n";
		echo '<br>';		   
		echo '<a href="./publisher_post.php?case=11&ads_id='.$ads_id.'">Edit this Ads Unit </a>';
		echo "\n";
		echo '<br>';
		echo '<a href="./publisher_post.php?case=3&campaign_id='.$campaign_id.'">Come back to Campaign </a>';
		echo "\n";
		echo '<br>';
		echo '<a href="./publisher_post.php?case=0">Come back to Campaigns index </a>';
		echo "\n";

	} elseif ($case == 13) {


        
		
		echo '<p>The state of this campaign is : </p>';
		
		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		$sql = 'SELECT state FROM ads_campaign WHERE ads_campaign_id = "'.$campaign_id.'"';
		$asql = mysql_query ($sql);
	    if (!$asql)
	       {
		    die('mysql consult no valid: ' . mysql_error());
	       }
	   		   
		$asql_list = mysql_fetch_row($asql);
		$state =  get_campaign_state_in_text ($asql_list[0]);
        echo '<p>';
		echo $state;	
		echo '</p>';
		
		echo '<h1> Are you ready?? </h1>';
		echo '<p>Click here for apply a approval for this campaign</p>';
		echo '<p>Go to settings an POST Budget for your campaign!!</p>';
		echo "\n";
		echo '<br>';
		echo '<a href= "" >Click here!!</a>';
		echo "\n";
		echo '<br><br>';
		echo '<a href="./publisher_post.php?case=0">Come back to Campaigns index </a>';
		echo "\n";
	
	

	} else {} // end of if_case



}


echo '</div>';
echo "\n";


?>

<?
require_once ("footer.php")

?>
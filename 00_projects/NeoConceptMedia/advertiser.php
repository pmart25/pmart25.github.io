
<?

/**
*
*  project  NCM_Ads
*  @file advertiser
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   Functions for advertisers
*
*/
require_once ('header.php')

?>


<?

require_once('functions.php');
require_once('header.php');
require_once ("Class.PayPal.php");

?>



<?  //CONTENT
$GLOBALS ["local"] = 1;
$GLOBALS ["debug_mode"] = 0;


if ( $GLOBALS ["local"] == 0 ) {

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  $gender = test_input($_POST["gender"]);
  $campaign_name = test_input($__POST["campaign_name"]);
  $content= test_input($__POST["content"]);
  $new_name = test_input($__POST["new_name"]);
  $comment = test_input($__POST["comment"]);

}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $campaign_name = test_input($__GET["campaign_name"]);
  $content= test_input($__GET["content"]);
  $new_name = test_input($__GET["new_name"]);
  $comment = test_input($__GET["comment"]);
  $gender = test_input($__GET["gender"]);
}


}

echo '<div class="content">';

require_once ('sidebar.php');

echo '<div class="content_text">';

echo "\n";

echo '<h1>Advertiser </h1>';

if (user_logged_in() == 1)

{

echo '<p> Lets create a campaign for promote your products!! </p>';

    //start debug_mode
   if ($GLOBALS ["debug_mode"] == 1) {
   
   echo '<h1>  Your user is logged in and you have access to registered content </h1>';
   echo "\n";
   echo '<h2> Here is the content that you can use to promote and win money: </h2>';
   echo "\n";
   echo '<p>  Here will be displayed the diferent announces by created by publishers </p>';
   echo "\n";
   }
   //end debug_mode
   
   
   /*
   *
   *
   *  text of case 0
   *
   */
   
   
   include_once 'config.php';
  
if (isset($_REQUEST['case'])) {
$case = mysql_real_escape_string($_POST["case"]);
} else {
$case = 99;


if ( $GLOBALS["debug_mode"] == TRUE)
{
echo "user id with user_uniqid: ".get_ads_user_id();
}

echo '<p> Programs available: </p>';	
echo '<div class=button_link>';
echo '<form class="button_link" method="POST" action="advertiser.php">';
echo "\n";
echo '<input class="button_link" type=hidden name=case value=14>';
echo '<input class="button_link" type=submit  value="Shortlinks"></form>';

echo "\n";
echo '</div>';





echo '<div class=button_link>';
echo '<form class="button_link" method="POST" action="advertiser.php">';
echo "\n";
echo '<input class="button_link" type=hidden name=case value=0>';
echo '<input class="button_link" type=submit  value="Banners"></form>';

echo "\n";
echo '</div>';

echo "\n";

echo "</br></br></br>";
}










	if   ( $case == 0) { 
		 
		 		 
		 
		 // mostrar campanyas
		 
		 
		 echo '<p> Show campaigns: </p>';
		// $get_ads_user_id();
		 if ($GLOBALS ["debug_mode"] == 1) {
		 echo 'id of user: ';
		 echo $_SESSION["userid"];
		 echo '</br>';
		 }
		 /////////////campaigns in ads_campaings////////////////////
		 
		 $sql = 'SELECT * FROM ads_campaign WHERE created_by = "'. get_ads_user_id().'"';
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
			 echo '<div class="button_link">';
			 echo '<form class="button_link" method="POST" action="advertiser.php">';
			 echo "\n";
			 echo '<input class="button_link" type=hidden name=case value=1>';
			 echo "\n";
		     echo "\n";				
			 echo '<input class="button_link" type=submit  value="Create a campaign here!!">';
			 echo "\n";
			 echo '</div>';
			 
		 } else
			 
			 {
		  echo '<table class="ad_table" border=1  >';
		  echo "\n";
		  echo '<tr><td> campaign id </td><td>Campaign Name</td><td>State</td><td> Actions</td></tr>';
		  echo "\n";	 
		 while ($asql_list = mysql_fetch_row($asql)){
		   
		  
		  
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
   
		   $state =  get_campaign_state_in_text ($asql_list_1[0]);
    
*/		   
           echo get_campaign_state_in_text($asql_list[6]);	;
   
		   echo '</td>';
		   echo "\n";
		   echo '<td width="180">';
		
		   
		   // Code for POST
			    //echo '<br><a href="./publisher?case=10&ads_web_id='.$asql_list[0].'">Delete this Ads Unit<br></a>';
				echo '<form class="button_link" method="POST" action="advertiser.php">';
				echo "\n";
			    echo '<input class="button_link" type=hidden name=case value=3>';
			    echo "\n";
			    echo '<input class="button_link" type=hidden name=campaign_id value='.$asql_list[0].'>';
			    echo "\n";				
			    echo '<input class="button_link" type=submit  value="Manage Ads for this Campaing"></form>';
			    echo "\n";
		
			    echo '<form class="button_link" method="POST" action="advertiser.php">';
				echo "\n";
			    echo '<input class="button_link" type=hidden name=case value=8>';
			    echo "\n";
			    echo '<input class="button_link" type=hidden name=campaign_id value='.$asql_list[0].'>';
			    echo "\n";				
			    echo '<input class="button_link" type=submit  value="Delete Campaign"></form>';
			    echo "\n";
			   
			 
			    echo '<div class="button_link">';
				echo '<form class="button_link" method="POST" action="advertiser.php">';
				echo "\n";
			    echo '<input class="button_link" type=hidden name=case value=6>';
			    echo "\n";
			    echo '<input class="button_link" type=hidden name=campaign_id value='.$asql_list[0].'>';
			    echo "\n";				
			    echo '<input class="button_link" type=submit  value="Change Campaign Name"></form>';
			    echo "\n";
			    echo '</div>';
		  
		   } 
		   echo '</table>';
		   echo "\n";
		   echo '<br>';
		
		   
		   echo '<div class="button_link">';
		   echo '<form class="button_link" method="POST" action="advertiser.php">';
		   echo "\n";
		   echo '<input class="button_link" type=hidden name=case value=1>';
		   echo "\n";
		   echo "\n";				
		   echo '<input class="button_link" type=submit  value="You can create another a campaign here!!"">';
		   echo "\n";
		   echo '</div>';
           
		 }
		 
		 
	     // if it has no campaigns
	     // check that user has no campaigns created
		 








		
		
	} elseif ( $case == 1) {
		
		echo '<p>You can create a new campaign here</p>';
		echo "\n";
		echo '<div id="ad_form2"><form class="ad_form2" method=POST name="create_campaign" action="advertiser.php">';
		echo "\n";
		echo '<input class="ad_form2" type=hidden name="case" value="2">';
		echo "\n";
		echo '<input class="ad_form2"  type="text" size="50" name="campaign_name">';
		echo "\n";
		echo '<br>';
		echo '<p>Select a Budget for your Campaign:</p>';
		echo '<br>';
		echo '<select class="ad_form2" name="budget">';
		echo "\n";
		echo '<option  value="15"> 15 USD</option>';
		echo "\n";
		echo '<option  value="30"> 30 USD</option>';
		echo "\n";
		echo '<option value="50"> 50 USD</option>';
		echo "\n";
		echo '</select>';
		echo "\n";
		echo '<br>';
		echo "\n";
		echo '<p>Select a section which describes your Campaign:</p>';
		echo '<br>';
		echo '<select class="ad_form2" name="section">';
		
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
		echo '<input class="ad_form2" type="submit" class="submit_style" value="Create campaign" >';
		echo "\n";
		echo '</from></div>';
		
		echo '<a href="advertiser.php"> Go to Advertiser main page </a>';
		
	} elseif ( $case == 2) {
		
		// create a new campaign
		
	
		$campaign_name = mysql_real_escape_string($_POST["campaign_name"]);
		$budget = mysql_real_escape_string($_POST["budget"]);
		$section = mysql_real_escape_string($_POST["section"]);
		
		
		if (isset($_REQUEST['new_name'])) {
        $new_name = mysql_real_escape_string($_POST["new_name"]);
        } else {
        $new_name = FALSE;
		}
		
		if (isset($_REQUEST['ads_campaign_id'])) {
		$ads_campaign_id  = mysql_real_escape_string($_POST["ads_campaign_id"]);
        } else {
        $ads_campaign_id  = FALSE;
		}
		
		
		$create_campaign_check = 0;
		
		if ($new_name == TRUE && $ads_campaign_id == TRUE ) 
		{
			
			 $campaign_name = $new_name;						
		}
		
		// CHECKING FOR A VALID NAME

		$new_concept = TRUE;
	
	
		
		
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
			$sql ='INSERT INTO ads_campaign (  ads_campaign_name, created_by,budget, section,state ) 
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
		

		echo "\n";
		
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=0>';	
	    echo "\n";
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Campaigns index">';
	    echo "\n";
	    echo '</div>';
		
		
		
		
	} elseif ($case == 3) {
		
		
		// control panel for campaigns
		

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


		



		
		// if Campaign check!
		// get section of campaign id
		
	    $sql = "SELECT section FROM ads_campaign WHERE ads_campaign_id = ".$campaign_id;
		$asql = mysql_query($sql);
		$section = mysql_fetch_array($asql);
		
		
		
		
		//start debug_mode
		
		if ( $GLOBALS ["debug_mode"] == 1) {
		echo '<p>Campaign name: '.$campaign_name.'</p>';
		echo "\n";	



		echo 'value of id campaign :'.$campaign_id; 
		
		echo '<p>Budget :'.$budget.'</p>';
		
		
		echo '<p>Section : '.get_section_text_from_id($section['section']).'</p>';
		
		echo '<p>'.change_state_campaign_to_running($campaign_id).'</p>';
		
		
		}
		// end debug_mode
		
		$sql = 'SELECT * FROM ads_ad WHERE belongs_to_campaign = "'.$campaign_id.'"';
		$asql = mysql_query($sql);

		if (!$asql)
		{
		   die('mysql consult no valid: ' . mysql_error());
		}
		
		
		
		$ads_spaces_string = $asql[2];  
		
		echo '<table class="ad_table" border=1 width="600">';
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

		   echo '<form class="button_link" method="POST" action="advertiser.php">';
		   echo "\n";
		   echo '<input class="button_link" type=hidden name=case value=10>';
		   echo "\n";
	       echo '<input class="button_link" type=hidden name=ads_id value='.$asql_list[0].'>';
		   echo "\n";
	       echo '<input class="button_link" type=hidden name=campaign_id value='.$campaign_id.'>';     
    	   echo "\n";				
	       echo '<input class="button_link" type=submit  value="Delete this Ads Unit"></form>';
		   
		   


		   echo '<form class="button_link" method="POST" action="advertiser.php">';
		   echo "\n";
		   echo '<input class="button_link" type=hidden name=case value=11>';
		   echo "\n";
	       echo '<input class="button_link" type=hidden name=ads_id value='.$asql_list[0].'>';
		   echo "\n";
	       echo '<input class="button_link" type=hidden name=campaign_id value='.$campaign_id.'>';     
    	   echo "\n";				
	       echo '<input class="button_link" type=submit  value="Edit this Ads Unit"></form>';  


		   echo '<form class="button_link" method="POST" action="advertiser.php">';
		   echo "\n";
		   echo '<input class="button_link" type=hidden name=case value=12>';
		   echo "\n";
	       echo '<input class="button_link" type=hidden name=ads_id value='.$asql_list[0].'>';
		   echo "\n";
	       echo '<input class="button_link" type=hidden name=campaign_id value='.$campaign_id.'>';     
    	   echo "\n";				
	       echo '<input class="button_link" type=submit  value="View this Ads Unit"></form>';



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

	//   cmapaign without advertising spaces, offer a option to create a campaign 
	
			echo '<p>this campaign has no ads spaces</p>';
			$sql = 'SELECT * FROM ads_repository WHERE 1';
			$asql = mysql_query($sql);
		
			if (!$asql)
			{
			   die('mysql consult no valid: ' . mysql_error());
			}
		   
		 if ( get_campaign_id_from_name($campaign_name) != -1 )
		 {  
			echo '<form method=POST action="./advertiser">';
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
			
			
		// campaign with advertising spaces offer a optoin to create a campaign 
		echo '<p>This campaign has this ads spaces:</p>';	
		
	
		echo '<img src="./img/example_ads.png"  >';
		echo '<p ">This image shows a example about Advetising Unit.<br>A format depends of the Advertising configuration.</p>';


		echo "\n";
		echo '<form method=POST class="ad_form2" action="advertiser.php">';
		echo "\n";
		echo '<input type=hidden name=case value=4>';

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
	   echo "\n";
	   

		echo "\n";
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=0>';	
	    echo "\n";
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Campaigns index">';
	    echo "\n";
	    echo '</div>';
	   echo "\n";
	   echo '<br>';
	   echo '<a href="./settings?campaign_id='.get_campaign_id_from_name($campaign_name).'">I am ready with this campaign, I want start now!</a>';
	   echo "\n";
	    echo '</div>';
		
	} elseif ($case == 4) {
		// preview
		echo "<p>Preview Ads SPACE</p>";

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
		$ads_repository_type = $_GET['ads_repository_type'];
		
		
		
		
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
        echo '<table class="ad_table" border= 0 class="preview_ads" >';
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
		echo '<table class="ad_table" border=1 width=120 height=120 class="ad_space"><tr><td>';
		echo "\n";
		echo '<h1>'.$title.'</h1>';
		echo "\n<br>";
		echo '<a href="'.$final_url.'" >'.$display_url.'</a>';
		echo "\n<br>";
		echo '<p>'.$ad_text_l1.'</p>';
		echo '<p>'.$ad_text_l2.'</p>';
		echo "\n<br>";
		echo '</tr></td></table>';
		echo '<form method=POST action="./advertiser" >';
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
		echo '<a href="./advertiser?case=3&campaign_id='.$campaign_id.'"> or Come back to Campaign </a>';
		echo "\n";
		

		
	} elseif ($case == 5) {	
	   //save the value in db from ads_ad 
	   //1.save adv space in ads_ad 
	   //2.add id in ads_id
       $campaign_id = mysql_real_escape_string($_POST["campaign_id"]);

	   $ads_space = mysql_real_escape_string($_POST["preview_ads_space"]);
	   $ads_id = mysql_real_escape_string($_POST["ads_id"]);
	   
	   $ads_space = html_entity_decode($ads_space);
	   $create_ads_space_check = 0;


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
						 
						$ads_unit_name = $ads_unit_name_invalid_test[0]; 
						 
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
				$requested_campaign_name = $asql_list[0];
				
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
				   
				   
					} else {
				   
				   //si NO exite un ads_id, entonces: crear nuevo   
				  
					$asql_list = mysql_fetch_array($asql);
					$campaign_id = $asql_list[0];   
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
			$sql ='INSERT INTO ads_ad (  ads_ad_name, created_by,budget,state ) 
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
	   echo '<a href="./advertiser?case=3&campaign_id='.$campaign_id.'">Come back to Campaign </a>';
	   echo "\n";
	   echo '<br>';
	   //echo '<a href="./advertiser">Come back to Campaigns index </a>';
	   echo "\n";
	   //echo '<a href="./advertiser">Come back to Campaigns index </a>';
		echo "\n";
		
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=0>';	
	    echo "\n";
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Campaigns index">';
	    echo "\n";
	    echo '</div>';
	   
	   
	} elseif ($case == 6) {	


		//CAMBIAR NOMBRE
		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		echo '<div id="ad_form2">';
		
		echo '<form class="ad_form2" method=POST action="./advertiser">';
		echo '<p>Do you want change the name of your campaign? Please, write the new campaign name.</p>';
		echo '<input type=hidden name="case"" value="2">';
		echo '<input type=hidden name="campaign_id"" value="'.$campaign_id.'">';
		echo '<input class="ad_form2" type=text name="new_name">';
		echo '<input class="ad_form2" type=submit class="submit_style" value="Change the name">';
		echo '</form>';
		//echo '<p>check campaign name: '.$create_campaign_check.'</p>';
		//echo '<a href="./advertiser">Come back to campaigns index</a>';	
		
		echo "\n";
		

		
		echo '<a href="advertiser.php"> Go to Advertiser main page </a>';
		

		 echo '</div>';
	} elseif ($case == 7) {	

	     // COMMANDS Of change name
	
	
	
		$campaign_name = mysql_real_escape_string($_POST["campaign_id"]);
		$new_name = mysql_real_escape_string($_POST["new_name"]);
		
		$sql = 'UPDATE ads_campaign SET ads_campaign_name = "'.$new_name.'" WHERE ads_campaign_name = "'.$campaign_name.'"';
		$asql = mysql_query($sql);
		if (!$asql) 
		{
		die('mysql consult no valid: ' . mysql_error());
		}

		echo '<br>';
		//echo '<a href="./advertiser">Come back to Campaigns index </a>';
		echo "\n";
		//echo '<p>check campaign name: '.$create_campaign_check.'</p>';
		//echo '<a href="./advertiser">Come back to campaigns index</a>';
		//echo '<a href="./advertiser">Come back to Campaigns index </a>';
		echo "\n";
		
        echo '<a href="advertiser.php"> Go to Advertiser main page </a>';
		

	} elseif ($case == 8) {	
		 //BORRAR CAMPAIGN

		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		echo '<p>Are you sure you want delete your campaign?</p>';
		echo '<br>';
		//echo '<a href="./advertiser">No. I want come back to Campaigns index </a>';
		echo "\n";
		
		//echo '<a href="./advertiser">Come back to Campaigns index </a>';
		echo "\n";
		
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=9>';	
	    echo "\n";
		echo '<input class="button_link" type=hidden name=campaign_id value='.$campaign_id.'">';
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Yes. I want delete this Campaign. ">';
	    echo "\n";
	    echo '</div>';
		
		echo '<a href="advertiser.php"> No. I want to come back to Advertiser main page </a>';
		 echo '</div>';
		
	   
	} elseif ($case == 9) {	

		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);
		echo '<p>Your campaign is deleted</p>';

			
		   $sql = 'DELETE  FROM ads_campaign WHERE ads_campaign_id = "'.$campaign_id.'" AND created_by = "'.get_ads_user_id().'"' ;
		   $asql = mysql_query($sql);
			   if (!$asql) 
				{
				die('mysql consult no valid: ' . mysql_error());
				}
			
	
			

		echo '<br>';
		//echo '<a href="./advertiser">Come back to Campaigns index </a>';
		echo "\n";
				
		/*echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=0>';	
	    echo "\n";
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Campaigns index">';
	    echo "\n";
	    echo '</div>';*/

		
		echo '<a href="advertiser.php"> Go to Advertiser main page </a>';

	    echo '</div>';
	   
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
		//echo '<a href="./advertiser?case=3&campaign_id='.$campaign_id.'">Come back to Campaign </a>';
		
				
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=3>';	
	    echo "\n";
		echo '<input class="button_link" type=hidden name=campaign_id value='.$campaign_id.'>';
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Campaign index">';
	    echo "\n";
	    echo '</div>';
		
		
		echo "\n";
		echo '<br>';
		//echo '<a href="./advertiser">Come back to Campaigns index </a>';
		echo "\n";
		
		/*
				
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=0>';	
	    echo "\n";
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Campaigns index">';
	    echo "\n";
	    echo '</div>';
		  
		*/
        echo '<a href="advertiser.php"> Go to Advertiser main page </a>';
		 echo '</div>';
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
		echo '<p>This image shows a example about Advetising Unit.<br>A format depends of the Advertising configuration.</p>';
		echo "\n";
		echo '<img src="./img/example_ads.png" >';
		echo '<div id="ad_form2">';
		echo '<form class="ad_form2" method=POST  action="advertiser.php">';

		
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
				//echo '<a href="./advertiser?case=3&campaign_id='.$campaign_id.'">Come back to Campaign </a>';
		
				
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=3>';	
	    echo "\n";

		echo '<input class="button_link" type=hidden name=campaign_id value='.$campaign_id.'>';
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Manage this Campaign">';
	    echo "\n";
	    echo '</div>';
		
		
		echo "\n";
		echo '<br>';
		//echo '<a href="./advertiser">Come back to Campaigns index </a>';
		echo "\n";
		
				
		echo "\n";
		echo '<br>';
		echo '<a href="./advertiser">Come back to Campaigns index </a>';
		
		echo '</div>';
		
		
	} elseif ($case == 12) {	

	
	    // VIEW ADS UNIT
	
	    $ads_id = mysql_real_escape_string($_POST["ads_id"]);
		$campaign_id = mysql_real_escape_string($_POST["campaign_id"]);

        get_preview_ads($ads_id);

				   
		echo "\n";
		echo '<br>';		   
		//echo '<a href="./advertiser?case=11&ads_id='.$ads_id.'">Edit this Ads Unit </a>';
		
						
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=11>';	
	    echo "\n";
		echo '<input class="button_link" type=hidden name=ads_id value='.$ads_id.'>';
	    echo "\n";				
		echo '<input class="button_link" type=hidden name=campaign_id value='.$campaign_id.'>';			  
	    echo "\n";				
		echo '<input class="button_link" type=submit  value="Edit this Ads Unit ">';
	    echo "\n";
	    echo '</div>';
		
		
		echo "\n";
		echo '<br>';
				//echo '<a href="./advertiser?case=3&campaign_id='.$campaign_id.'">Come back to Campaign </a>';
		
				
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=3>';	
	    echo "\n";
		echo '<input class="button_link" type=hidden name=campaign_id value='.$campaign_id.'>';
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Manage this Campaign">';
	    echo "\n";
	    echo '</div>';
		
		
		echo "\n";
		echo '<br>';
		echo '<a href="./advertiser">Come back to Campaigns index </a>';
        echo '</div>';

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
		echo '<p>Go to settings an get Budget for your campaign!!</p>';
		echo "\n";
		echo '<br>';
		echo '<a href= "" >Click here!!</a>';
		echo "\n";
		echo '<br><br>';
		//echo '<a href="./advertiser">Come back to Campaigns index </a>';
		echo "\n";

		
		echo '<div class="button_link">';
		echo '<form class="button_link" method="POST" action="advertiser.php">';
        echo "\n";
	    echo '<input class="button_link" type=hidden name=case value=0>';	
	    echo "\n";
	    echo "\n";				
	    echo '<input class="button_link" type=submit  value="Come back to Campaigns index">';
	    echo "\n";
	    echo '</div>';
	
	
	
	
	
	
	} elseif ($case == 14) {
	
	
	  /**
	   *  
	   *  Shortlinks Programs for Advertising
	   *  
	   */
	   
	   	echo "<p> type the url you want promote: </p>";
	
	    echo '<div id="ad_form2"><form class="ad_form2" method=POST name="campaign_shortlinks" action="advertiser.php">';
		echo "\n";
		echo '<input class="ad_form2" type=hidden name="case" value="15">';
		echo "\n";
		echo '<input class="ad_form2"  type="text" size="50" name="url" value="">';
		echo "\n";
		echo '<br>';
		echo '<br><br>';
		echo '<input class="ad_form2" type="submit" class="submit_style" value="Create Campaign for Shortcodes" >';
		echo "\n";
		echo '</form></div>';
		
		$sql = 'SELECT  ads_adv_shortlinks_id, url_to_promote FROM ads_adv_shortlinks WHERE created_by = "'.get_ads_user_id().'" AND state = "0"';
		
	
		$asql = mysql_query ($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
		$asql_list = mysql_fetch_array($asql);
			
		if ( mysql_num_rows($asql) > 0) {
		
		 echo '<p> You have a campaign for this url '.$asql_list[1].' with a pendent payment</p>';
		 echo '<p> What do you want to do? </p>';
		 echo '<a href="settings"> Go To Settings for paying <a>';
		 
		echo '<div class=button_link>';
		echo '<form class="button_link" method="POST" action="advertiser">';
		echo "\n";
		echo '<input class="button_link" type=hidden name=case value="17">';
		echo '<input class="button_link" type=hidden name=url value="'.$asql_list[1].'">';
		echo '<input class="button_link" type=submit  value="No, let\'s delete this campaign, please."></form>' ;
		 
		
	
		
		
		} else {
		
		}
		
		
		echo '<a href="advertiser.php"> Go to Advertiser main page </a>';
	
    } elseif ($case == 15) {	
	   
	   
	    $url = mysql_real_escape_string($_POST["url"]);
	    echo '<p>Campaign Shortlinks</p>';
		echo "\n";
		echo '<div id="ad_form2"><form class="ad_form2" method=POST name="create_campaign" action="advertiser.php">';
		echo "\n";
		echo '<input class="ad_form2" type=hidden name="case" value="16">';
		echo "\n";
		echo "<p> Campaign for:  ".$url."</p>";
		echo '<input class="ad_form2"  type="hidden" size="50" name="url" value='.$url.'>';
		echo "\n";
		echo '<br>';
		echo '<p>Select a Budget for your Campaign:</p>';
		echo '<br>';
		echo '<select class="ad_form2" name="budget">';
		echo "\n";
		echo '<option  value="15"> 15 USD</option>';
		echo "\n";
		echo '<option  value="30"> 30 USD</option>';
		echo "\n";
		echo '<option value="50"> 50 USD</option>';
		echo "\n";
		echo '</select>';
		echo "\n";
		echo '<br>';
		echo "\n";
		echo '<p>Select a section which describes your Campaign:</p>';
		echo '<br>';
		echo '<select class="ad_form2" name="section">';
		
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
		echo '<input class="ad_form2" type="submit" class="submit_style" value="Create campaign" >';
		echo "\n";
		echo '</from></div>';
		
		echo '<a href="advertiser.php"> Go to Advertiser main page </a>';
	
		
	} elseif ($case == 16) {
		
		

		
		
		$url = mysql_real_escape_string($_POST["url"]);
		$budget = mysql_real_escape_string($_POST["budget"]);
		$campaign_uniqid = uniqid();
	    $item = 'Payment for Shortlink Campaign: '.$url.' ('.$campaign_uniqid.')  of user: '. get_ads_user_email_from_id(get_ads_user_id());
		
		$campaign_buyed_visits = $budget*1000;
		

		$sql = 'SELECT  ads_adv_shortlinks_id FROM ads_adv_shortlinks WHERE created_by = "'.get_ads_user_id().' " AND state = "0"';
		$asql = mysql_query ($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}

		
		if ( mysql_num_rows($asql) > 0 ) {
		
		
		echo '<p>You created another campaign before and is still not payed. You can not create another campaign with a one pendent payment. </p>';
		
		
		} else {






		
		$sql = 'INSERT INTO ads_adv_shortlinks (   created_by, url_to_promote, state, actual_visits, campaign_buyed_visits,   last_visit_date, campaign_uniqid ) 
						VALUES ("'.get_ads_user_id().'","'.$url.'","0", "'.$campaign_buyed_visits.'", "0","0","'.$campaign_uniqid.'")';
		$asql = mysql_query ($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
		echo '<p>Just pay your campaign!</p>';
		
		echo "<p> the item is ".$item."</p>";
		
		//Demo_PayPal_EWP($budget, $item);
		
		echo '<div class=button_link>';
		echo '<form class="button_link" method="POST" action="settings.php">';
		echo "\n";
		echo '<input class="button_link" type=hidden name=url value="'.$url.'">';
		echo '<input class="button_link" type=hidden name=budget value="'.$budget.'">';
		echo '<input class="button_link" type=hidden name=item value="'.$item.'">';
		echo '<input class="button_link" type=submit  value="Go To Settings for paying"></form>';

		echo "\n";
		echo '</div>';
	    }
		
		echo '<a href="advertiser"> Go to Advertiser main page </a>';
		
		
	} elseif ($case == 17) {
		
		

		
		
		$url = mysql_real_escape_string($_POST["url"]);
		
		
		
		

		$sql = 'DELETE  FROM ads_adv_shortlinks WHERE created_by = "'.get_ads_user_id().' " AND state = "0" AND url_to_promote = "'.$url.'"';
		$asql = mysql_query ($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}

		
		
	  echo "<p> The campaign are deleted correctly.</p>";
		
	
	// if payment is correct -> add the url to ads_adv_shortlinks
	
	
	
	  echo '<a href="advertiser"> Go to Advertiser main page </a>';

	} else {} // end of if_case



}



echo "\n";


?>

<?
require_once ("footer.php")

?>
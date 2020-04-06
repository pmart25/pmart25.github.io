<?

/**
*
*  project  NCM_Ads
*  @file helpdesk
*  @user  pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   helpdesk of NCM_Ads
*/


require_once("functions.php");
require_once ("header.php");

?>



<?  //CONTENT

$GLOBALS ["debug_mode"] = 0;


echo '<div class="content">';

require_once ("sidebar.php");

echo '<div class="content_text">';

if (isset($_REQUEST['case'])) {
$case = mysql_real_escape_string($_POST["case"]);
} else {
$case = "0";
}
if (isset($_REQUEST['user'])) {
$user = mysql_real_escape_string($_POST["user"]);
} else {
$user = "0";
}
if (isset($_REQUEST['password'])) {
$password = mysql_real_escape_string($_POST["password"]);
} else {
$password = "0";
}

if (isset($_REQUEST['start_ticket'])) {
$start_ticket = mysql_real_escape_string($_POST["start_ticket"]);
} else {
$start_ticket = "";
}


$start_ticket = 0;

echo '<h1>Helpdesk </h1>


<br />
<br/>
<br/>

';

echo '<p> Do you want report a abuse of our system? Please write the content and where do you saw a forbidden use.</p>';





//***************************************************




if (user_logged_in() == 1){

if (isset($_REQUEST['start_ticket'])) {
$start_ticket = mysql_real_escape_string($_POST["start_ticket"]);
} else {
$start_ticket = "";
}

if (isset($_REQUEST['newticket'])) {
$newticket = mysql_real_escape_string($_POST["newticket"]);
} else {
$newticket = "";
}

if ($case == 0) {
   $GLOBALS['start_ticket'] = $start_ticket;

   //$start_ticket = $start_ticket  - 5;
   
   //start debug_mode
   if ($GLOBALS ["debug_mode"] == 1) {
   

   
   }
   //end debug_mode
   
   echo '<br/>';
   echo '<br/>';echo '<br/>';
   
   if ($newticket == NULL) {

	echo '<form class="ad_form2" action="helpdesk?case=1" method="POST">';

	echo '<br/>';
	echo "\n";
	echo  '<p>title:</p> <input class="ad_form2" type="text" name="title" value="">';
	echo "\n";
	echo '<br/><br/>';
	echo "\n";
	echo '<p>problem @brief </p>';
	echo ' <textarea class="ad_form2" name="description" rows="20" cols= "50">Write the content of the ticket there... </textarea>';
	echo "\n";
	echo '<br/><br/>';
	echo "\n";
	
	if (user_logged_in() == 1)
	{ 
	echo  '<p>email:  '.get_ads_user_email_from_id(get_ads_user_id()).'</p> <input class="ad_form2" type=hidden name="email" value="'.get_ads_user_email_from_id(get_ads_user_id()).'">';
	}
	else{
	echo  '<p>email:</p> <input class="ad_form2" type="text" name="email" value="">'; }
	echo "\n";
	echo '<br/><br/>';
	echo "\n";   
    echo '<p> Select image to upload:</p>';
    echo "\n"; 
	
    echo '<input  type="file" name="fileToUpload"  id="fileToUpload" >';
    echo '</br></br>';
  	echo '<input class="ad_form2" type="submit" value="Create a new Ticket">';
	echo '</form>';
	
	
	/*   --> Upload Images!
	

<form action="upload.php" method="post" enctype="multipart/form-data">
    echo '<p> Select image to upload:</p>';
    echo '<input type="file" name="fileToUpload" id="fileToUpload">';
    echo '<input type="submit" value="Upload Image" name="submit">';
</form>

 

//  start uploadImage
	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	

    }  //end if null ticket
// end uploadImage

*/

   
   echo "<p>Tickets created by user: </p>";
   
   //start debug_mode
   if ($GLOBALS ["debug_mode"] == 1) {
   echo "<p>Case Actual: ".$case." </p>";
   }
   //edn debug_mode
 
    //start debug_mode
   if ($GLOBALS ["debug_mode"] == 1) {
 
   echo '<p> function get_email: '.get_ads_user_email_from_id(get_ads_user_id()).'</p>';
  
   }
   // end debug_mode
   
   echo '<table class="ad_table" border=1 width="800" >';
			echo "\n";
			echo '<tr width="10%">';
			echo '<td>';
			echo 'Ticket Id';
			echo '</td>';
			echo '<td width="20%">';
			echo 'Ticket Title';
			echo '</td>';
			echo '<td width="20%">';
			echo 'Problem Description';
			echo '</td>';
			echo '<td>';
			echo 'Date';
			echo '</td>';	
			echo '</td>';
			echo '<td>';
			echo 'State';
			echo '</td>';				
			echo '<td>';
			echo 'Action';
			echo '</td>';	



	 if ( $start_ticket < 0 || $start_ticket == NULL ) {
	 
	  $start_ticket = 0;
	 }	
			
 	//$sql = 'SELECT * FROM ads_helpdesk WHERE ads_created_by ="'.get_ads_user_email_from_id(get_ads_user_id()).'" LIMIT 5 OFFSET '.$start_ticket;
    		
 	$sql = 'SELECT * FROM ads_helpdesk WHERE (ads_created_by ="'.get_ads_user_email_from_id(get_ads_user_id()).'" AND ads_state >= "0")  AND (ads_created_by ="'.get_ads_user_email_from_id(get_ads_user_id()).'" AND ads_state <= "5")  LIMIT  '.$start_ticket.',5';
    
	
	//start debug_mode
    if ($GLOBALS ["debug_mode"] == 1) {
	
	echo '<p> sql= '.$sql.' </p>';
	
	}
	//end debug_mode
	
	$asql = mysql_query($sql);
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}
	//$asql_list = mysql_fetch_array($asql);
	

	
	while ($asql_list = mysql_fetch_row($asql))
			{
			   echo '<tr>';
			   echo '<td>';
			   echo "\n";
			   echo $asql_list[0]; // ticket_id
			   echo "\n";
			   echo '</td>';
			   echo '<td>';
			   echo "\n";
			   echo $asql_list[1]; // ticket_title
			   echo "\n";
			   echo '</td>';
			   echo '<td >';
			   echo "\n";
			   echo substr($asql_list[2], 0, 150).'...'; // problem_descrption
			   echo "\n";
			   echo '</td>';
			   echo '<td>';
			   echo "\n";
			   echo $asql_list[3]; // ticket_date
   	           echo '</td>';
			   echo '<td>';
			   echo "\n";
			   if ( $asql_list[4] == 5 ) {
			   
			   echo  '<a href="./helpdesk?case=4&ticket_nr='.$asql_list[0].'">Finalized</a>';
			   
			   } else {
			   
			   echo get_ticket_state_in_text($asql_list[4]); // ticket_state
			   
			   }
   	           echo '</td>';

			   echo '<td>';
			   echo "\n";
			   echo '<a href="helpdesk?case=2&ticket_nr='.$asql_list[0].'"> Edit Ticket </a>'; // ticket_state
			   echo "\n";
   	           echo '</td>';
			   echo '</tr>';
			}
   
   echo '</table>';
     //end if_logged_in
   
	   
	   
	





   
   
  /*  prueba!! --> carrusel de tickets
   $next_count=start_ticket + 5;
   echo '<a href=".\helpdesk?start_ticket='.$next_count.'&end_ticket='.$next_count+5.'">Next >></a>';
   if ( start_ticket > 0 ){
   
   $prev_count=start_ticket + 5;
   echo '<a href=".\helpdesk?start_ticket='.$next_count.'&end_ticket='.$next_count+5.'">                   <<Previous</a>';
   }
   
   */ 
   
    $sql = 'SELECT COUNT(*) FROM ads_helpdesk WHERE ads_created_by ="'.get_ads_user_email_from_id(get_ads_user_id()).'"';
    
	$asql = mysql_query($sql);
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}
   
   
    $asql_list = mysql_fetch_row($asql);
	$count_tickets = $asql_list[0];
	 

	 
	 
	
	 
	 //while ( count_tickets ){  }
	 

	
	echo '<div class="helpdesk_nav_footer">';
	echo "\n";
	echo '<div class="nav_button_previous"> ';
	echo '<a href="./helpdesk?start_ticket='.($start_ticket-5).'"> Previous Page  </a>';	
	echo "\n";
	echo '</div>';
	echo '<div class="nav_button_next"> ';
	echo "\n";
	echo '<a href="./helpdesk?start_ticket='.($start_ticket+5).'"> Next Page </a>';
	echo '</div>';
	echo "\n";
	echo '</div>';
	
	echo '<form class="button_link" action="helpdesk" >';
	echo '<input class="button_link" type=hidden name=case value=6>';
	echo '<input class="button_link" type=submit  value="See all tickets"></form>';
	echo '<form class="button_link" action="helpdesk" >';
	echo '<input class="button_link" type=hidden name=case value=7>';
	echo '<input class="button_link" type=submit  value="Search ticket"></form>';

	 }
     
//***************************************************   
} elseif ($case == 1) {

	$description = mysql_real_escape_string($_POST["description"]);
	$title = mysql_real_escape_string($_POST["title"]);
	$email = mysql_real_escape_string($_POST["email"]);
	$date = mysql_real_escape_string(date("d-M-Y"));
     
 
  
       //start debug_mode
   if ($GLOBALS ["debug_mode"] == 1) {
	   
	echo '<h1>Edit Ticket case 1</h1>';
	 
	echo '<p> @brief '.$description.'</p>';
	echo '<p> title: '.$title.'</p>';
	echo '<p> email: '.$email.'</p>';
	echo '<p> date: '.$date.'</p>';
     }
	 // end debug_mode

	
	 $sql = 'INSERT INTO ads_helpdesk (ads_title, ads_problem_description, ads_date, ads_state, ads_created_by  )  
			 VALUES ( "'.$title.'", "'.$description.'","'.$date.'", "0", "'.$email.'")';


		 $asql = mysql_query($sql);
		if (!$asql)
		{
		die('mysql consult no valid: ' . mysql_error());
		}

		
	echo '<p> Your helpdesk ticket is successfully created! </p>';
	echo '<a href = "helpdesk"> Go to Helpdesk </a>';

} elseif ($case == 2) {

  //Edit Tickets
 
 
 //comprobar que el ticket pertenece al usuario
	$ticket_nr = mysql_real_escape_string($_GET['ticket_nr']);
	

	
	$sql = 'SELECT * FROM ads_helpdesk WHERE ads_ticket_id = "'.$ticket_nr.'" AND ads_created_by = "'.get_ads_user_email_from_id(get_ads_user_id()).'"';
	$asql = mysql_query($sql);
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}
	$asql_list = mysql_fetch_row($asql);
	echo '<form  class="ad_form2" action="helpdesk?case=3" method="POST">';
	echo '<br/>';
	echo "\n";
	echo  '<p>ticket ID: '.$asql_list[0].'</p> ';
	echo  '<input class="ad_form2"  type="hidden" name="ticket_nr" value="'.$asql_list[0].'">';
	echo "\n";
	echo '<br/>';
	echo "\n";
	echo  '<p>title:</p> <input class="ad_form2"  type="text" name="title" value="'.$asql_list[1].'">';
	echo "\n";
	echo '<br/><br/>';
	echo "\n";
	echo '<p>problem @brief </p>';
	echo ' <textarea  class="ad_form2"  name="description" rows="20" cols= "50">'.$asql_list[2].'</textarea>';  
	echo "\n";
	echo '<br/><br/>';
	echo "\n";
	echo  '<p>state:</p> <select class="ad_form2"  name=state value="'.$asql_list[4].'"> 
	
	<option value="0">New </option>
    <option value="1">Review </option>
    <option value="2">In Work </option>
    <option value="3">Response Review</option>
	<option value="4">Rejected</option>
	<option value="5">Finalized</option>
	
	</select>';
	echo "\n";
	echo '<br/><br/>';
	echo "\n";
	echo '<input class="ad_form2"  type="submit" value="Edit Ticket">';;
	echo '</form>';
	echo '<a href = "helpdesk"> Go to Helpdesk </a>';
	
} elseif ($case == 3) {	
	
  
   $ticket_nr = mysql_real_escape_string($_POST['ticket_nr']);
   $description = mysql_real_escape_string($_POST["description"]);
   
   $title = mysql_real_escape_string($_POST["title"]);
   $state = mysql_real_escape_string($_POST["state"]);
   $date = date("d-M-Y");
   
   

  $sql = 'UPDATE ads_helpdesk SET ads_title = "'.$title.'",
                                  ads_problem_description =  "'.$description.'", 
   								  ads_date = "'.$date.'",
								  ads_state = "'.$state.'" 
								  WHERE ads_ticket_id = "'.$ticket_nr.'"';
         
    //echo '<p>sql: '.$sql.'</p>';
	
	
	
    $asql = mysql_query($sql);
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}

	
    echo '<p> Your helpdesk ticket is successfully updated! </p>';

	
	echo '<a href = "helpdesk"> Go to Helpdesk </a>';
   
   echo '<br/><br/><br/><br/>';
   echo '<br/>';// end of case 3

   
} elseif ($case == 4) {	  
  // start of case 4
  
   // delete of ticket
   $ticket_nr = mysql_real_escape_string($_GET['ticket_nr']);
   echo '<p>  Do you want delete this ticket?</p>';
   echo '<form class="button_link" method =POST name="delete_ticket" action="helpdesk?case=5">
   	<input class="button_link" type=hidden name=case value=6>
   <input class="button_link" type = "hidden" name="ticket_nr" value="'.$ticket_nr.'">
   <input class="button_link" type = "submit" value= "Yes. I want to delete this ticket."></form>';
   


   echo '<a href = "helpdesk"> No. Go to Helpdesk </a>';
 // end of case 4
 
} elseif ($case == 5) {	 //start case 5
  
  $ticket_nr = mysql_real_escape_string($_POST['ticket_nr']);
  $sql = 'UPDATE ads_helpdesk SET ads_state = "99" 
								  WHERE ads_ticket_id = "'.$ticket_nr.'"';
         
    //echo '<p>sql: '.$sql.'</p>';
	
	
	
    $asql = mysql_query($sql);
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}

	
    echo '<p> Your helpdesk ticket is successfully deleted! </p>';
     echo '<a href = "helpdesk"> Go to Helpdesk </a>';
 }  // end of case 5 

 


   
 elseif ($case == 6) {	//start case 6

   $GLOBALS['start_ticket'] = mysql_real_escape_string($_POST["start_ticket"]);

   //$start_ticket = $start_ticket  - 5;
   
   //start debug_mode
   if ($GLOBALS ["debug_mode"] == 1) {
   
   echo '<h1>  Your user is logged in and you have access to registered content </h1></div>';
   
   }
   //end debug_mode
   
   
   
   if ($newticket == NULL) {

	echo '<form class="ad_form2" action="helpdesk?case=1" method="POST">';

	echo '<br/>';
	echo "\n";
	echo  '<p>title:</p> <input type="text" name="title" value="">';
	echo "\n";
	echo '<br/><br/>';
	echo "\n";
	echo '<p>problem @brief </p>';
	echo ' <textarea name="description" rows="20" cols= "50">Write the content of the ticket there... </textarea>';
	echo "\n";
	echo '<br/><br/>';
	echo "\n";
	if (user_logged_in() == 1)
	{ 
	echo  '<p>email:  '.get_ads_user_email_from_id(get_ads_user_id()).'</p> <input type=hidden name="email" value="'.get_ads_user_email_from_id(get_ads_user_id()).'">';
	}
	else{
	echo  '<p>email:</p> <input type="text" name="email" value="">'; }
	echo "\n";
	echo '<br/><br/>';
	echo "\n";
	echo '<button class="ad_form2"> Create a new Ticket</button>';
	echo '</form>';

    }  //end if null ticket


   
   echo "<p>Tickets created by user: </p>";
   
   //start debug_mode
   if ($GLOBALS ["debug_mode"] == 1) {
   echo "<p>Case Actual: ".$case." </p>";
   }
   //edn debug_mode
 
    //start debug_mode
   if ($GLOBALS ["debug_mode"] == 1) {
 
   echo '<p> function get_email: '.get_ads_user_email_from_id(get_ads_user_id()).'</p>';
  
   }
   // end debug_mode
   
   echo '<table class = "ad_table" border=1 width=800>';
			echo "\n";
			echo '<tr>';
			echo '<td>';
			echo 'Ticket Id';
			echo '</td>';
			echo '<td>';
			echo 'Ticket Title';
			echo '</td>';
			echo '<td>';
			echo 'Problem Description';
			echo '</td>';
			echo '<td>';
			echo 'Date';
			echo '</td>';	
			echo '</td>';
			echo '<td>';
			echo 'State';
			echo '</td>';				
			echo '<td>';
			echo 'Action';
			echo '</td>';	



	 if ( $start_ticket < 0 || $start_ticket == NULL ) {
	 
	  $start_ticket = 0;
	 }	
			
 	//$sql = 'SELECT * FROM ads_helpdesk WHERE ads_created_by ="'.get_ads_user_email_from_id(get_ads_user_id()).'" LIMIT 5 OFFSET '.$start_ticket;
    		
 	$sql = 'SELECT * FROM ads_helpdesk WHERE ads_created_by ="'.get_ads_user_email_from_id(get_ads_user_id()).'"' ;
    
	
	//start debug_mode
    if ($GLOBALS ["debug_mode"] == 1) {
	
	echo '<p> sql= '.$sql.' </p>';
	
	}
	//end debug_mode
	
	$asql = mysql_query($sql);
	if (!$asql)
	{
	die('mysql consult no valid: ' . mysql_error());
	}
	//$asql_list = mysql_fetch_array($asql);
	

	
	while ($asql_list = mysql_fetch_row($asql))
			{
			   echo '<tr>';
			   echo '<td>';
			   echo "\n";
			   echo $asql_list[0]; // ticket_id
			   echo "\n";
			   echo '</td>';
			   echo '<td>';
			   echo "\n";
			   echo $asql_list[1]; // ticket_title
			   echo "\n";
			   echo '</td>';
			   echo '<td width="796" height="100">';
			   echo "\n";
			   echo substr($asql_list[2], 0, 200).'...'; // problem_descrption
			   echo "\n";
			   echo '</td>';
			   echo '<td>';
			   echo "\n";
			   echo $asql_list[3]; // ticket_date
   	           echo '</td>';
			   echo '<td>';
			   echo "\n";
			   if ( $asql_list[4] == 5 ) {
			   
			   echo  '<a href="./helpdesk?case=4&ticket_nr='.$asql_list[0].'">Finalized</a>';
			   
			   } else {
			   
			   echo get_ticket_state_in_text($asql_list[4]); // ticket_state
			   
			   }
   	           echo '</td>';

			   echo '<td>';
			   echo "\n";
			   echo '<a href="helpdesk?case=2&ticket_nr='.$asql_list[0].'"> Edit Ticket </a>'; // ticket_state
			   echo "\n";
   	           echo '</td>';
			   echo '</tr>';
			}
   
   echo '</table>';
     //end if_logged_in
   
   
  /*  prueba!! --> carrusel de tickets
   $next_count=start_ticket + 5;
   echo '<a href=".\helpdesk?start_ticket='.$next_count.'&end_ticket='.$next_count+5.'">Next >></a>';
   if ( start_ticket > 0 ){
   
   $prev_count=start_ticket + 5;
   echo '<a href=".\helpdesk?start_ticket='.$next_count.'&end_ticket='.$next_count+5.'">                   <<Previous</a>';
   }
   
   */ 
   
   
	 

	 

	
	echo '<a href="./helpdesk?case=0"> Go To Helpdesk </a>';
     
//***************************************************  
 
   // end of case 6

}  elseif ($case == 7) {	//start case 7


     // search ticket
 
 
 	
	echo '<form class="ad_form2" method=POST action="./helpdesk?"> ticket nr: <input type="text" name="ticket_nr"><input type="hidden" name="case" value="2"> <input class="button_link" type = "submit" value= "Search Ticket"> </form>';
	
	

	
	echo '<a href="./helpdesk"> Go To Helpdesk </a>';
	


	
	
	//end of case 7
 
 } else{}  






} //end if login
?>

<?
require_once ("footer.php")

?>
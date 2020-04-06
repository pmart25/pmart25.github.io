<?





/**

*

*  project  NCM_Ads

*  @file settings

*  @user pablo martinez

*  @email p_mart25@outlook.com

*  url  www.neoconceptmedia.com

*  @brief   account settings 

*/







require_once("functions.php");

require_once ("header.php");

require_once ("config.php");

require_once ("Class.PayPal.php");







 /*

   $asql = mysql_query($sql);



   $sql = "SELECT * FROM ads_ad ORDER BY ads_ad_id DESC LIMIT 1, 20";

   $asql = mysql_query($sql);

   

   $x=mysql_real_escape_string($_POST[casilla];

*/



echo '<div class="content">';

require_once ('sidebar.php');

echo '<div class="content_text">';



$budget = "0";

echo "\n";

if (isset($_GET["case"])) {
$case = mysql_real_escape_string($_GET["case"]);
} else {
$case = 0;
}

/*

if (isset($_REQUEST['case'])) {

		$case = mysql_real_escape_string($_POST["case"]);
		

		} else {

		$case = "0";

		}
	*/	



if (isset($_REQUEST['item'])) {

		$item = mysql_real_escape_string($_POST["item"]);

		} else {

		$item= "0";

		}		



if (isset($_REQUEST['budget'])) {

		$budget = mysql_real_escape_string($_POST["budget"]);

		} else {

		$budget = "0";

		}		

		





if ($case == 12) {
         
		if ( $GLOBALS ["debug_mode"] == 1) {
	
        echo "<p> case 12</p >";
		
		}
		Demo_PayPal_IPN(); 

		change_state_payed_campaign();

		echo '<br>';

	  	echo "\n";

		//echo "<p>case without login</p>";

		echo '<br>';

		echo '<a href="./settings.php"> Come back to Settings </a>';

		echo "\n";

	

}





if (user_logged_in() == 1)



{



     if (isset($_REQUEST['case'])) {

		$case = mysql_real_escape_string($_POST["case"]);

		} else {

		$case = "0";

		}



		

	if (isset($_REQUEST['campaign_id'])) {

			 $campaign_id = mysql_real_escape_string($_POST["campaign_id"]);

		} else {

		$campaign_id = "";

		}







	 echo '<h1>Settings</h1>';



	  change_state_campaign_to_running($campaign_id);

	  

  if ($case == 0 ) {

  

  

		if (isset($_REQUEST['campaign_id'])) {

			 $campaign_id = mysql_real_escape_string($_POST["campaign_id"]);

		} else {

		$campaign_id = "";

		}



		 echo '<p> In settings you can edit your personal data and request a payroll of your visits. </p>';

		 



		 



		 

		echo '<p> Number of clicks: '.get_total_clicks_of_user().'</p>';

		

		echo '<p> Earned Money by your Shorlinks: Still not Implemented</p>';

		

		echo '<p> Your Campaigs are obtained actually this Clicks: Still not Implemented </p>';

		

        if ( get_total_clicks_of_user() >= 10000) {		

		 

			echo '<p>You reach the minimal number of clicks for get the payroll. Request the payout of your visits.</p>';

		

			echo '<div class="button_link">';

			echo '<form class="button_link" method="POST" action="settings.php">';

			echo "\n";

			echo '<input class="button_link" type=hidden name=case value=15>';

			echo "\n";

			echo "\n";				

			echo '<input class="button_link" type=submit  value="Request the payout">';

			echo "\n";

			echo '</div>';

		 

		 

		}

		 

		 

		$sql = 'SELECT url_to_promote, campaign_buyed_visits, campaign_uniqid FROM ads_adv_shortlinks WHERE created_by = "'.get_ads_user_id().'" and state = "0"';

		$asql = mysql_query ($sql);

		if (!$asql)

		{

			die('mysql consult no valid: ' . mysql_error());

		}

	   if ( mysql_num_rows($asql) > 0) 

	   {

		   echo '<table class="ad_table" border=1  >';

		   echo "\n";

		   echo '<tr><td> Url to Promote </td><td>State</td><td> Paynow</td></tr>';

		   echo "\n";	 

		   while ($asql_list = mysql_fetch_row($asql)){

			   

			   // print_r ($asql_list);

			  

			   echo '<tr>';

			   echo '<td>';

			   echo "\n";

			   echo $asql_list[0]; //$ads_campaign_id

			   $url = $asql_list[0];

			   echo "\n";

			   echo '</td>';

			   echo '<td width="796" height="100">';

			   echo "\n";

			   echo "Not Payed";

			   echo "\n";

			   echo '</td>';

			   echo "\n";

			   echo '<td>';

			   $campaign_buyed_visits = $asql_list[1]; //$ads_campaign_id

			   $budget =  $campaign_buyed_visits / 1000;

			   $campaign_uniqid = $asql_list[2];

			   $item = 'Payment for Shortlink Campaign: '.$url.' ('.$campaign_uniqid.')  of user: '. get_ads_user_email_from_id(get_ads_user_id());

			   Demo_PayPal_EWP($budget, $item);

			   echo "\n";

			   echo '</td>';		   

			   echo '</tr>';

			   } 

			   echo '</table>';

			   echo "\n";

			   echo '<br>';

			

			echo '<br>';

		}	



        if ( $item == TRUE && $budget == TRUE ) {

		 echo "Pay your campaign here: ".$item; 

		Demo_PayPal_EWP($budget, $item);

		

		}

		

		

		 echo '</br>';

		 

		 echo '<p> Account Status: '.get_user_account_state_in_text(get_account_state()).'</p>';

		 echo '</br>';





		 //echo '<a href="./settings?case=5" >Edit your account data </a>';

	     echo "\n";

		 echo '<br>';

		 

		 echo '<div class="button_link">';

		 echo '<form class="button_link" method="POST" action="settings.php">';

         echo "\n";

	     echo '<input class="button_link" type=hidden name=case value=5>';	

	     echo "\n";				

	     echo '<input class="button_link" type=submit  value="Edit your account data">';

	     echo "\n";

	     echo '</div>';

		 //echo '<a href="./settings?case=7" >Edit your password </a>';

	     echo "\n";

		 echo '<div class="button_link">';

		 echo '<form class="button_link" method="POST" action="settings.php">';

         echo "\n";

	     echo '<input class="button_link" type=hidden name=case value=7>';	

	     echo "\n";				

	     echo '<input class="button_link" type=submit  value="Edit your password">';

	     echo "\n";

	     echo '</div>';

		 echo '<br>';

		 //echo '<a href="./settings?case=13" >Cancell your account </a>';

		 echo '<div class="button_link">';

		 echo '<form class="button_link" method="POST" action="settings.php">';

         echo "\n";

	     echo '<input class="button_link" type=hidden name=case value=13>';	

	     echo "\n";				

	     echo '<input class="button_link" type=submit  value="Cancell your account">';

	     echo "\n";

	     echo '</div>';

    

		 

  } elseif($case == 5 )  {

		 

		echo '<p> Edit your account data</p>';
	    echo "\n";





            // get the register data of user

 

            $sql = 'SELECT * FROM ads_users WHERE id_user = "'.get_ads_user_id().'"';

            $asql = mysql_query($sql);

			if (!$asql)

			{

			   die('mysql consult no valid: ' . mysql_error());

			}

		    $asql_list = mysql_fetch_row($asql);



			//var_dump($asq)



	    echo '

		 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

		  <script src="//code.jquery.com/jquery-1.10.2.js"></script>

		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

		  <link rel="stylesheet" href="/resources/demos/style.css">

		<script>

		  $(function() {

			$( "#datepicker" ).datepicker({ 

			 dateFormat : "dd/mm/yy",

			 changeMonth : true,

			 changeYear : true,

			 yearRange: "-100y:-18y"

				   

			});

		  });

		</script>

		  



		



		<form class="ad_form2" action="./settings?case=6" method="post" class="register">



		<p>Birthday:</p>

		<input type="text" name="birthday" id="datepicker" value="'.$asql_list[5].'">

		



		<p>Gender:</p>

		<input class="ad_form2" type="radio" name="gender" value="m">Male</br>

		<input class="ad_form2" type="radio" name="gender" value="f">Female</br>



		

		<input class="ad_form2" type="text" name="address" value="'.$asql_list[7].'">





		<p>City:</p>

		<input class="ad_form2" type="text" name="city" value="'.$asql_list[8].'">



		<p>Country:</p>



		<select class="ad_form2" name="country">

		<option value="'.$asql_list[9].'"></option>

		<option value="Afganistan">Afghanistan</option>

		<option value="Albania">Albania</option>

		<option value="Algeria">Algeria</option>

		<option value="American Samoa">American Samoa</option>

		<option value="Andorra">Andorra</option>

		<option value="Angola">Angola</option>

		<option value="Anguilla">Anguilla</option>

		<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>

		<option value="Argentina">Argentina</option>

		<option value="Armenia">Armenia</option>

		<option value="Aruba">Aruba</option>

		<option value="Australia">Australia</option>

		<option value="Austria">Austria</option>

		<option value="Azerbaijan">Azerbaijan</option>

		<option value="Bahamas">Bahamas</option>

		<option value="Bahrain">Bahrain</option>

		<option value="Bangladesh">Bangladesh</option>

		<option value="Barbados">Barbados</option>

		<option value="Belarus">Belarus</option>

		<option value="Belgium">Belgium</option>

		<option value="Belize">Belize</option>

		<option value="Benin">Benin</option>

		<option value="Bermuda">Bermuda</option>

		<option value="Bhutan">Bhutan</option>

		<option value="Bolivia">Bolivia</option>

		<option value="Bonaire">Bonaire</option>

		<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>

		<option value="Botswana">Botswana</option>

		<option value="Brazil">Brazil</option>

		<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>

		<option value="Brunei">Brunei</option>

		<option value="Bulgaria">Bulgaria</option>

		<option value="Burkina Faso">Burkina Faso</option>

		<option value="Burundi">Burundi</option>

		<option value="Cambodia">Cambodia</option>

		<option value="Cameroon">Cameroon</option>

		<option value="Canada">Canada</option>

		<option value="Canary Islands">Canary Islands</option>

		<option value="Cape Verde">Cape Verde</option>

		<option value="Cayman Islands">Cayman Islands</option>

		<option value="Central African Republic">Central African Republic</option>

		<option value="Chad">Chad</option>

		<option value="Channel Islands">Channel Islands</option>

		<option value="Chile">Chile</option>

		<option value="China">China</option>

		<option value="Christmas Island">Christmas Island</option>

		<option value="Cocos Island">Cocos Island</option>

		<option value="Colombia">Colombia</option>

		<option value="Comoros">Comoros</option>

		<option value="Congo">Congo</option>

		<option value="Cook Islands">Cook Islands</option>

		<option value="Costa Rica">Costa Rica</option>

		<option value="Cote DIvoire">Cote DIvoire</option>

		<option value="Croatia">Croatia</option>

		<option value="Cuba">Cuba</option>

		<option value="Curaco">Curacao</option>

		<option value="Cyprus">Cyprus</option>

		<option value="Czech Republic">Czech Republic</option>

		<option value="Denmark">Denmark</option>

		<option value="Djibouti">Djibouti</option>

		<option value="Dominica">Dominica</option>

		<option value="Dominican Republic">Dominican Republic</option>

		<option value="East Timor">East Timor</option>

		<option value="Ecuador">Ecuador</option>

		<option value="Egypt">Egypt</option>

		<option value="El Salvador">El Salvador</option>

		<option value="Equatorial Guinea">Equatorial Guinea</option>

		<option value="Eritrea">Eritrea</option>

		<option value="Estonia">Estonia</option>

		<option value="Ethiopia">Ethiopia</option>

		<option value="Falkland Islands">Falkland Islands</option>

		<option value="Faroe Islands">Faroe Islands</option>

		<option value="Fiji">Fiji</option>

		<option value="Finland">Finland</option>

		<option value="France">France</option>

		<option value="French Guiana">French Guiana</option>

		<option value="French Polynesia">French Polynesia</option>

		<option value="French Southern Ter">French Southern Ter</option>

		<option value="Gabon">Gabon</option>

		<option value="Gambia">Gambia</option>

		<option value="Georgia">Georgia</option>

		<option value="Germany">Germany</option>

		<option value="Ghana">Ghana</option>

		<option value="Gibraltar">Gibraltar</option>

		<option value="Great Britain">Great Britain</option>

		<option value="Greece">Greece</option>

		<option value="Greenland">Greenland</option>

		<option value="Grenada">Grenada</option>

		<option value="Guadeloupe">Guadeloupe</option>

		<option value="Guam">Guam</option>

		<option value="Guatemala">Guatemala</option>

		<option value="Guinea">Guinea</option>

		<option value="Guyana">Guyana</option>

		<option value="Haiti">Haiti</option>

		<option value="Hawaii">Hawaii</option>

		<option value="Honduras">Honduras</option>

		<option value="Hong Kong">Hong Kong</option>

		<option value="Hungary">Hungary</option>

		<option value="Iceland">Iceland</option>

		<option value="India">India</option>

		<option value="Indonesia">Indonesia</option>

		<option value="Iran">Iran</option>

		<option value="Iraq">Iraq</option>

		<option value="Ireland">Ireland</option>

		<option value="Isle of Man">Isle of Man</option>

		<option value="Israel">Israel</option>

		<option value="Italy">Italy</option>

		<option value="Jamaica">Jamaica</option>

		<option value="Japan">Japan</option>

		<option value="Jordan">Jordan</option>

		<option value="Kazakhstan">Kazakhstan</option>

		<option value="Kenya">Kenya</option>

		<option value="Kiribati">Kiribati</option>

		<option value="Korea North">Korea North</option>

		<option value="Korea Sout">Korea South</option>

		<option value="Kuwait">Kuwait</option>

		<option value="Kyrgyzstan">Kyrgyzstan</option>

		<option value="Laos">Laos</option>

		<option value="Latvia">Latvia</option>

		<option value="Lebanon">Lebanon</option>

		<option value="Lesotho">Lesotho</option>

		<option value="Liberia">Liberia</option>

		<option value="Libya">Libya</option>

		<option value="Liechtenstein">Liechtenstein</option>

		<option value="Lithuania">Lithuania</option>

		<option value="Luxembourg">Luxembourg</option>

		<option value="Macau">Macau</option>

		<option value="Macedonia">Macedonia</option>

		<option value="Madagascar">Madagascar</option>

		<option value="Malaysia">Malaysia</option>

		<option value="Malawi">Malawi</option>

		<option value="Maldives">Maldives</option>

		<option value="Mali">Mali</option>

		<option value="Malta">Malta</option>

		<option value="Marshall Islands">Marshall Islands</option>

		<option value="Martinique">Martinique</option>

		<option value="Mauritania">Mauritania</option>

		<option value="Mauritius">Mauritius</option>

		<option value="Mayotte">Mayotte</option>

		<option value="Mexico">Mexico</option>

		<option value="Midway Islands">Midway Islands</option>

		<option value="Moldova">Moldova</option>

		<option value="Monaco">Monaco</option>

		<option value="Mongolia">Mongolia</option>

		<option value="Montserrat">Montserrat</option>

		<option value="Morocco">Morocco</option>

		<option value="Mozambique">Mozambique</option>

		<option value="Myanmar">Myanmar</option>

		<option value="Nambia">Nambia</option>

		<option value="Nauru">Nauru</option>

		<option value="Nepal">Nepal</option>

		<option value="Netherland Antilles">Netherland Antilles</option>

		<option value="Netherlands">Netherlands</option>

		<option value="Nevis">Nevis</option>

		<option value="New Caledonia">New Caledonia</option>

		<option value="New Zealand">New Zealand</option>

		<option value="Nicaragua">Nicaragua</option>

		<option value="Niger">Niger</option>

		<option value="Nigeria">Nigeria</option>

		<option value="Niue">Niue</option>

		<option value="Norfolk Island">Norfolk Island</option>

		<option value="Norway">Norway</option>

		<option value="Oman">Oman</option>

		<option value="Pakistan">Pakistan</option>

		<option value="Palau Island">Palau Island</option>

		<option value="Palestine">Palestine</option>

		<option value="Panama">Panama</option>

		<option value="Papua New Guinea">Papua New Guinea</option>

		<option value="Paraguay">Paraguay</option>

		<option value="Peru">Peru</option>

		<option value="Phillipines">Philippines</option>

		<option value="Pitcairn Island">Pitcairn Island</option>

		<option value="Poland">Poland</option>

		<option value="Portugal">Portugal</option>

		<option value="Puerto Rico">Puerto Rico</option>

		<option value="Qatar">Qatar</option>

		<option value="Republic of Montenegro">Republic of Montenegro</option>

		<option value="Republic of Serbia">Republic of Serbia</option>

		<option value="Reunion">Reunion</option>

		<option value="Romania">Romania</option>

		<option value="Russia">Russia</option>

		<option value="Rwanda">Rwanda</option>

		<option value="St Barthelemy">St Barthelemy</option>

		<option value="St Eustatius">St Eustatius</option>

		<option value="St Helena">St Helena</option>

		<option value="St Kitts-Nevis">St Kitts-Nevis</option>

		<option value="St Lucia">St Lucia</option>

		<option value="St Maarten">St Maarten</option>

		<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>

		<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>

		<option value="Saipan">Saipan</option>

		<option value="Samoa">Samoa</option>

		<option value="Samoa American">Samoa American</option>

		<option value="San Marino">San Marino</option>

		<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>

		<option value="Saudi Arabia">Saudi Arabia</option>

		<option value="Senegal">Senegal</option>

		<option value="Serbia">Serbia</option>

		<option value="Seychelles">Seychelles</option>

		<option value="Sierra Leone">Sierra Leone</option>

		<option value="Singapore">Singapore</option>

		<option value="Slovakia">Slovakia</option>

		<option value="Slovenia">Slovenia</option>

		<option value="Solomon Islands">Solomon Islands</option>

		<option value="Somalia">Somalia</option>

		<option value="South Africa">South Africa</option>

		<option value="Spain">Spain</option>

		<option value="Sri Lanka">Sri Lanka</option>

		<option value="Sudan">Sudan</option>

		<option value="Suriname">Suriname</option>

		<option value="Swaziland">Swaziland</option>

		<option value="Sweden">Sweden</option>

		<option value="Switzerland">Switzerland</option>

		<option value="Syria">Syria</option>

		<option value="Tahiti">Tahiti</option>

		<option value="Taiwan">Taiwan</option>

		<option value="Tajikistan">Tajikistan</option>

		<option value="Tanzania">Tanzania</option>

		<option value="Thailand">Thailand</option>

		<option value="Togo">Togo</option>

		<option value="Tokelau">Tokelau</option>

		<option value="Tonga">Tonga</option>

		<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>

		<option value="Tunisia">Tunisia</option>

		<option value="Turkey">Turkey</option>

		<option value="Turkmenistan">Turkmenistan</option>

		<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>

		<option value="Tuvalu">Tuvalu</option>

		<option value="Uganda">Uganda</option>

		<option value="Ukraine">Ukraine</option>

		<option value="United Arab Erimates">United Arab Emirates</option>

		<option value="United Kingdom">United Kingdom</option>

		<option value="United States of America">United States of America</option>

		<option value="Uraguay">Uruguay</option>

		<option value="Uzbekistan">Uzbekistan</option>

		<option value="Vanuatu">Vanuatu</option>

		<option value="Vatican City State">Vatican City State</option>

		<option value="Venezuela">Venezuela</option>

		<option value="Vietnam">Vietnam</option>

		<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>

		<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>

		<option value="Wake Island">Wake Island</option>

		<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>

		<option value="Yemen">Yemen</option>

		<option value="Zaire">Zaire</option>

		<option value="Zambia">Zambia</option>

		<option value="Zimbabwe">Zimbabwe</option>

		</select>

		

		</br>

		<p>ZIP Code:</p>

		<input class="ad_form2" type="text" name="zip_code" value="'.$asql_list[10].'">





		<p>First Name:</p>

		<input class="ad_form2" type="text" name="first_name" value="'.$asql_list[3].'">





		<p>Last Name:</p>

		<input class="ad_form2" type="text" name="last_name" value="'.$asql_list[4].'">



		<p>Telephone:</p>

		<input class="ad_form2" type="text" name="telephone" value="'.$asql_list[11].'">



		<p>E-mail:</p>

		<input class="ad_form2" type="text" name="email" value="'.$asql_list[12].'">

















       

		<input class="ad_form2"  type="submit" name="send" value="Update">



		</form>';

		/* echo </div>	';   // end of echo register */		









		

				$user_data = array (

				

				"user" => $user,

				"password" => $password,

				"birthday" => $birthday,

				"gender" =>  $gender,

				"city" => $city,

				"country" => $country,

				"zip_code" => $zip_code,

				"first_name" => $first_name,

				"last_name" => $last_name,

				"telephone" => $telephone,

				"email" => $email,



								

				);

				

				

				

			    $result_list = check_register_validation ( $user_data  );

                echo $result_list[1]."\n<br>";



		echo '<br>';

		echo '<a href="./settings?case=0"> Come back to Settings </a>';

		 



 } elseif($case == 6 )  {	

 

		$birthday = mysql_real_escape_string($_POST["birthday"]);

		$gender = mysql_real_escape_string($_POST["gender"]);

		$city = mysql_real_escape_string($_POST["city"]);

		$country = mysql_real_escape_string($_POST["country"]);

		$zip_code = mysql_real_escape_string($_POST["zip_code"]);

		$first_name  = mysql_real_escape_string($_POST["first_name"]);       

		$last_name  = mysql_real_escape_string($_POST["last_name"]);

		$email = mysql_real_escape_string($_POST["email"]);









		$sql = 'UPDATE ads_users SET first_name = "'.$first_name.'",

									last_name = "'.$last_name.'",

									birthday = "'.$birthday.'",

									gender = "'.$gender.'",

									city = "'.$city.'",

									country = "'.$country.'",

									zip_code = "'.$zip_code.'",

									email = "'.$email.'"

                                    WHERE id_user = "'.get_ads_user_id().'"';

         $asql = mysql_query($sql);

		if (!$asql)

			{

			   die('mysql consult no valid: ' . mysql_error());

			}

		 echo "<p> Update of User data correctly completed! </p>";

		echo '<br>';

		echo '<a href="./settings?case=0"> Come back to Settings </a>';

		 

		

 } elseif($case == 7 )  {

		 

		echo '<p> Edit your password </p>';

	    echo "\n";





   



			//var_dump($asq)



	    echo '

		

	



		<form class="ad_form2" action="./settings?case=8" method="post" class="register">



	    <p>Actual Password:</p>

		<input class="ad_form2" type="password" name="oldpassword">

		

		<p>New Password:</p>

		<input class="ad_form2" type="password" name="password">

		

		<p>Repeat New Password:</p>

		<input class="ad_form2" type="password" name="repassword">

		</br>

		<input class="ad_form2" type="submit" name="send" value="Update Password">



		</form>

			';   // end of echo register		









		

				$user_data = array (

				

				

				"password" => $password,

											

											

				);

				

				

				

			    $result_list = check_register_validation ( $user_data  );

                echo $result_list[1]."\n<br>";



		echo '<br>';

		//echo '<a href="./settings?case=0"> Come back to Settings </a>';

		echo "\n";	 

		

		echo '<div class="button_link">';

		echo '<form class="button_link" method="POST" action="settings.php">';

        echo "\n";

	    echo '<input class="button_link" type=hidden name=case value=0>';	

	    echo "\n";				

	    echo '<input class="button_link" type=submit  value="Come back to Settings">';

	    echo "\n";

	    echo '</div>';

		 

 } elseif($case == 8 )  {

	    $oldpassword = mysql_real_escape_string($_POST["oldpassword"]);

	    $password = mysql_real_escape_string($_POST["password"]);

		$repassword = mysql_real_escape_string($_POST["repassword"]);

		

		if ( $GLOBALS ["debug_mode"] == 1) {

		

		

	     echo "<p>oldpassword : ".$oldpassword."</p>";

	     echo "<p>password : ".$password ."</p>";

		echo "<p>repassword : ".$repassword."</p>";

		

		}

		

		if (verify_login(get_ads_user_email_from_id(get_ads_user_id()),$oldpassword,$result) == 1)  #check if user know old password is OK

		{ 
			if($password == $repassword)

				{

			

					$sql = 'UPDATE ads_users SET password = "'.$password.'",

												 WHERE id_user = "'.get_ads_user_id().'"';

					$asql = mysql_query($sql);

					if (!$asql)

						{

						   die('mysql consult no valid: ' . mysql_error());

						}

						echo "<p> Update of User password correctly completed! </p>";

						echo '<br>';

				

				} else {

					

					echo '<p>The passwords are not the same. Please retry.</p>';

				

				

				}

		} else {

			

			echo '<p>The actual passwords is not correct. Please retry.</p>';

			

		}	# end check old_password

			

	   echo "\n";

	   echo '<br>';

	   //echo '<a href="./settings?case=7" >Edit your password </a>';

	   

	   		echo '<div class="button_link">';

		echo '<form class="button_link" method="POST" action="settings.php">';

        echo "\n";

	    echo '<input class="button_link" type=hidden name=case value=7>';	

	    echo "\n";				

	    echo '<input class="button_link" type=submit  value="Edit your Password">';

	    echo "\n";

	    echo '</div>';

	   echo "\n";

	   echo '<br>';

	   //echo '<a href="./settings?case=0"> Come back to Settings </a>';

		echo '<div class="button_link">';

		echo '<form class="button_link" method="POST" action="settings.php">';

        echo "\n";

	    echo '<input class="button_link" type=hidden name=case value=0>';	

	    echo "\n";				

	    echo '<input class="button_link" type=submit  value="Come back to Settings">';

	    echo "\n";

	    echo '</div>';

		

		

	

  } elseif($case == 10 )  {

	  // return

	  // http://ncp.freeiz.com/pub_test/settings?case=10

	  

	    echo '<p> Congratulations!! your advertising campaign will be complete active in the next 24 Hours</p>';

	    echo "\n";

		echo '<p>Function PayPal_IPN:</p>';

		echo '<br>';

		//echo '<a href="./settings?case=0"> Come back to Settings </a>';

		echo "\n";

		echo '<div class="button_link">';

		echo '<form class="button_link" method="POST" action="settings.php">';

        echo "\n";

	    echo '<input class="button_link" type=hidden name=case value=0>';	

	    echo "\n";				

	    echo '<input class="button_link" type=submit  value="Come back to Settings">';

	    echo "\n";

	    echo '</div>';

	  

  } elseif ($case == 11){

	  // cancell

	  	echo '<p> You cancell the payment of your campaign.</p>';

	    echo "\n";

		echo '<br>';

	  	echo "\n";

		echo '<br>';

		//echo '<a href="./publisher?case=0"> Come back to Settings </a>';

		echo "\n";

		echo '<div class="button_link">';

		echo '<form class="button_link" method="POST" action="settings.php">';

        echo "\n";

	    echo '<input class="button_link" type=hidden name=case value=0>';	

	    echo "\n";				

	    echo '<input class="button_link" type=submit  value="Come back to Settings">';

	    echo "\n";

	    echo '</div>';

		

		

  } elseif ($case == 12){

	  	Demo_PayPal_IPN(); 

		echo '<br>';

	  	echo "\n";

		echo '<br>';

		//echo '<a href="./publisher?case=0"> Come back to Settings </a>';

		echo "\n";

		echo '<div class="button_link">';

		echo '<form class="button_link" method="POST" action="settings.php">';

        echo "\n";

	    echo '<input class="button_link" type=hidden name=case value=0>';	

	    echo "\n";				

	    echo '<input class="button_link" type=submit  value="Come back to Settings">';

	    echo "\n";

	    echo '</div>';



  } elseif ($case == 13){

	  	echo '<p>Are you sure you want to cancell your account? All your data will be permanently deleted from our databases.</p>';

		echo '<br>';

	  	echo "\n";

                echo '<a href="./settings?case=14">Yes</a>';

		echo '<br>';

	  	echo "\n";

		echo '<br>';

		//echo '<a href="./settings?case=0">No. Come back to Settings </a>';

		echo "\n";

		echo '<div class="button_link">';

		echo '<form class="button_link" method="POST" action="settings.php">';

        echo "\n";

	    echo '<input class="button_link" type=hidden name=case value=0>';	

	    echo "\n";				

	    echo '<input class="button_link" type=submit  value="No. Come back to Settings">';

	    echo "\n";

	    echo '</div>';



  } elseif ($case == 14){	



                //  change the state; state 2 is cancelled account.

                   



		$sql = 'UPDATE  ads_users SET state = "2" WHERE id_user="'.get_ads_user_id().'"';

		$asql = mysql_query($sql);

		if (!$asql)

		{

		   die('mysql consult no valid: ' . mysql_error());

		}

	    session_start();

	    session_destroy();

	

	    header('location: index.php');



	  	echo '<p>Your account is correctly cancelled.</p>';

		echo '<br>';

		echo '<br>';

		echo '<a href="./index.php">Go to Index</a>';

		echo "\n";



		

} elseif ($case == 15){			

		

		echo "<p> Ask a Payroll of your visits.</p>";

		echo "<p> Information about the paypal transfers. The money transfers take place at the 28th day of the month. Please be patient.";

		echo "\n";

		echo '<br>';

		//echo '<a href="./settings?case=0">Come back to Settings </a>';

		echo "\n";	

	    echo '<div class="button_link">';

		echo '<form class="button_link" method="POST" action="settings.php">';

        echo "\n";

	    echo '<input class="button_link" type=hidden name=case value=0>';	

	    echo "\n";				

	    echo '<input class="button_link" type=submit  value="Come back to Settings">';

	    echo "\n";

	    echo '</div>';

		

  }

  

  else

  {}

	

	







	   







 //fin de autentificacion!	

	   

	  

	   

	   

	   

?>



    </body>

  </html>











 <? 

   

   

   echo '<br>';

   

   echo '<a href="./index.php">Come Back To Index</a>   ';



   





   

} // end if login  

   

?>







<?

require_once ("footer.php");





?>
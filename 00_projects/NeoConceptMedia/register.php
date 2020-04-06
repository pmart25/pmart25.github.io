<?



/**
*
*  project  NCM_Ads
*  @file register.php
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   registration system for user
*      Consist in a Registration Form (css_class=ad_form2; action=register.php) per POST. Command Registration
*      11.1.2017: New Form format implemented (ad_form2.) Form is now centered.
*
*      TO DO:  Test Register process
*              Disclaimer
*
*/





require_once ("header.php");
include_once "config.php";
?>



<?  //CONTENT





echo '<div class="content">';
echo '<div class="content_text">';







			
?>


<script>
  $(function() {
    $( "#datepicker" ).datepicker({ 
	 dateFormat : 'dd/mm/yy',
	 changeMonth : true,
	 changeYear : true,
	 yearRange: '-100y:-18y'
           
	});
  });
</script>
  


<?php

echo '<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
		  

		
        <div class="content_register">
		<form class="ad_form2" action="" method="post" >

       <p>User name:</p>
       <input type="text" name="user" >
	   
       <p>Password:</p>
       <input type="password" name="password">
       <p>Repeat Password:</p>
       <input type="password" name="repassword">
  


        <p>Birthday:</p>
		<input type="text" name="birthday" id="datepicker" >
		
		


		<p>Gender:</p>
		<div class="register_gender" position="relative" >
		<input  type="radio" name="gender" value="m">Male</br></br>
		<input  type="radio" name="gender" value="f">Female</br>
		</div>

		<p>Address:</p>
		<input class="ad_form2" type="text" name="address" value="">


		<p>City:</p>
		<input class="ad_form2" type="text" name="city" value="">

		<p>Country:</p>

		<select class="ad_form2" name="country">
		<option value=""></option>
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
		<input class="ad_form2" type="text" name="zip_code" value="">


		<p>First Name:</p>
		<input class="ad_form2" type="text" name="first_name" value="">


		<p>Last Name:</p>
		<input class="ad_form2" type="text" name="last_name" value="">

		<p>Telephone:</p>
		<input class="ad_form2" type="text" name="telephone" value="">

		<p>E-mail:</p>
		<input class="ad_form2" type="text" name="email" value="">








       
		<input class="ad_form2"  type="submit" name="send" value="Register">

		</form>
		</div>';   


echo '<div class="content_text_register">

<a href="./forget.php" > Password forgotten? </a>';

echo '</div>';



	


/*

				$test = 0;
				
				if ($test == 1) {
				
				$user = "as";
				$password = "12";
				$birthday = "<?php >";
				$gender = "m";
				$city = "L.A.";
				$country = "Algeria";
				$zip_code = "8888";
				$first_name = "Alfred";
				$last_name = "Alf";
				$telephone = "1232453422";
				$email = "afa@afa.co";
				
				}
				
				/// end test
				
	/*		--> just in post("send");	
				
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

  */


if(isset($_POST['send']))
{
	/////////////////////////////////////
	

	$user_data = array (
	
	"email" => $user,
	"password" => $password,
	"birthday" => $birthday,
	"gender" =>  $gender,
	"city" => $city,
	"country" => $country,
	"zip_code" => $zip_code,
	"first_name" => $first_name,
	"last_name" => $last_name,
	"telephone" => $telephone,
	//"email" => $email,

					
	);
	
	
	
	$result_list = check_register_validation ( $user_data  );
	echo $result_list[1]."\n<br>";
	
	
	
	
	
	
	////////////////////////////////////
	
	
	
	
	
	
	
	
    if($_POST['user'] == '' or $_POST['password'] == '' or $_POST['repassword'] == '')
    {
        echo 'Please fill all the fields.';
    }
    else
    {
        $sql = 'SELECT * FROM ads_users';
        $rec = mysql_query($sql);
        $verify_user = 0;
 
        while($result = mysql_fetch_object($rec))
        {
            if($result->user == $_POST['user'])
            {
                $verify_user = 1;
            }
        }
 
        if($verify_user == 0)
        {
            if($_POST['password'] == $_POST['repassword'])
            {
                $user = $_POST['email'];
                $password = $_POST['password'];
				$birthday = $_POST['birthday'];
				$gender =  $_POST['gender'];
				$address = $_POST['adress'];
				$city = $_POST['city'];
				$country = $_POST['country'];
				$zip_code = $_POST['zip_code'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$telephone = $_POST['telephone'];
				$email = $_POST['email'];
				$hash = md5(rand (0,1000));
				$active = 0;
				
				//check of the fields validity
				$paying_method = "0";
				
				// start test
				
				$test = 1;
				
				if ($test == 1) {
				
				$user = "as";
				$password = "12";
				$birthday = "12-12-12";
				$gender = "m";
				$city = "L.A.";
				$country = "Algeria";
				$zip_code = "8888";
				$first_name = "Alfred";
				$last_name = "Alf";
				$telephone = "1232453422";
				$email = "afa@afa.co";
				
				}
				
				/// end test
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
				
				
			    if(isset($_POST['send'])) {	
			    $result_list = check_register_validation ( $user_data  );	
			    }	
				if (   $result_list[0] == 0   ) 
				{
				
					  $sql = 'INSERT INTO ads_users (user,password, first_name, last_name, birthday,gender,city,country,zip_code,telephone,email,paying_method, hash, active,last_login,user_uniqid) 
							  VALUES ('.$user.',
									  '.$password.',
									  '.$first_name.',
									  '.$last_name.',
									  '.$birthday.',
									  '.$gender.',
									  '.$city.',
									  '.$country.',
									  '.$zip_code.',
									  '.$telephone.',
									  '.$email.',
									  '.$paying_method.', 
									  '.$hash.', 
									  '.$active.',
									  '."00-00-00 00:00:00".',
									  '.uniqid().')';

					 $asql =  mysql_query($sql);
					 if (!$asql)
						{
							die('mysql consult no valid: ' . mysql_error());

						}
					  send_verification_email($email,$hash);
					  echo '<p>New user registration is  finished correctly.</p>';
				} // end result list = 0 
					elseif ($result_list[0] != 0 )
					{
					
					echo '<p>Is no possible create a user account with this user name: '.$user.'</p>';
					echo '<br>';
					echo '<p> Error : '.$result_list[0].' - '.$result_list[1].'</p>';
					
					} // end elseif
			
			    } // end if create new user
			
			
			
			
			
			
            else
            {
                echo '<p>The passwords are not the same. Please retry.</p>';
            }  // end else check passwords are not the same
        }
        else
        {
            echo '<p>This user was previously registered. Try to use other user name.</p>';
        } // end else check user previously registered.
    }
	
	
}





/*!  @note SHOW DISCLAIMER 
*
*
*Website usage terms and conditions of Neo Concept Media Ltd. services and products.
*Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern Neo Concept Media’s relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website.*
*The term ‘Neo Concept Media’ or ‘us’ or ‘we’ refers to the owner of the website whose registered office is [address]. Our company registration number is [company registration number and place of registration]. The term ‘you’ refers to the user or viewer of our website.
*The use of this website is subject to the following terms of use:
*•	The content of the pages of this website is for your general information and use only. It is subject to change without notice.
*•	This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, the following personal information may be stored by us for use by third parties.
*•	Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.
*•	Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.
*•	This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.
*•	All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.
*•	Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.
*•	From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).
******•	Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.
*
*
*
*
*Business privacy policy – sample template
*This privacy policy sets out how Neo Concept Media uses and protects any information that you give Neo Concept Media when you use this website.
*Neo Concept Media is committed to ensuring that your privacy is protected. Should we ask you to provide certain information by which you can be identified when using this website, then you can be assured that it will only be used in accordance with this privacy statement.
*Neo Concept Media may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you are happy with any changes. This policy is effective from 20-11-2016.
*What we collect
*We may collect the following information:
*•	name and job title
*•	contact information including email address
*•	demographic information such as postcode, preferences and interests
*•	other information relevant to customer surveys and/or offers
*What we do with the information we gather
*We require this information to understand your needs and provide you with a better service, and in particular for the following reasons:
*•	Internal record keeping. 
*•	We may use the information to improve our products and services. 
*•	We may periodically send promotional emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.  
*•	From time to time, we may also use your information to contact you for market research purposes. We may contact you by email, phone, fax or mail. We may use the information to customise the website according to your interests.
*Security
*We are committed to ensuring that your information is secure. In order to prevent unauthorised access or disclosure, we have put in place suitable physical, electronic and managerial procedures to safeguard and secure the information we collect online. 
*How we use cookies
*A cookie is a small file which asks permission to be placed on your computer's hard drive. Once you agree, the file is added and the cookie helps analyse web traffic or lets you know when you visit a particular site. Cookies allow web applications to respond to you as an individual. The web application can tailor its operations to your needs, likes and dislikes by gathering and remembering information about your preferences. 
*We use traffic log cookies to identify which pages are being used. This helps us analyse data about web page traffic and improve our website in order to tailor it to customer needs. We only use this information for statistical analysis purposes and then the data is removed from the system. 
*Overall, cookies help us provide you with a better website, by enabling us to monitor which pages you find useful and which you do not. A cookie in no way gives us access to your computer or any information about you, other than the data you choose to share with us. 
*You can choose to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. This may prevent you from taking full advantage of the website.
*Links to other websites
*Our website may contain links to other websites of interest. However, once you have used these links to leave our site, you should note that we do not have any control over that other website. Therefore, we cannot be responsible for the protection and privacy of any information which you provide whilst visiting such sites and such sites are not governed by this privacy statement. You should exercise caution and look at the privacy statement applicable to the website in question.
*Controlling your personal information
*You may choose to restrict the collection or use of your personal information in the following ways:
*•	whenever you are asked to fill in a form on the website, look for the box that you can click to indicate that you do not want the information to be used by anybody for direct marketing purposes
*•	if you have previously agreed to us using your personal information for direct marketing purposes, you may change your mind at any time by writing to or emailing us at web administrator email address
*We will not sell, distribute or lease your personal information to third parties unless we have your permission or are required by law to do so. We may use your personal information to send you promotional information about third parties which we think you may find interesting if you tell us that you wish this to happen.
*You may request details of personal information which we hold about you under the Data Protection Act 1998. A small fee will be payable. If you would like a copy of the information held on you please write to [address].
***If you believe that any information we are holding on you is incorrect or incomplete, please write to or email us as soon as possible, at the above address. We will promptly correct any information found to be incorrect.
*
*Website disclaimer 
*The information contained in this website is for general information purposes only. The information is provided by Neo Concept Media and while we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.
*In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.
*Through this website you are able to link to other websites which are not under the control of Neo Concept Media. We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.
*Every effort is made to keep the website up and running smoothly. However, Neo Concept Media takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.
*
*
*/



require_once ("footer.php")

?>
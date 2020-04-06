<?php
 
// datos para la coneccion a mysql

/**
*
*  project  NCM_Ads
*  @file config.php
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   Connection settings of NCM_Ads
*
*/


/**
 *  
 *  Modes Activation   
 */


$GLOBALS ["local"] = 1; // 0-> will be used hosting server ;   1-> will be used localhost settings
$GLOBALS ["debug_mode"] = 0; // 0 -> non_verbose;  1 -> verbose_mode;
$GLOBALS ["maintenance_mode"] = 0; // 0 -> Normal Use. 1 -> Maintenance Mode activated. Not Login allowed and Message should be displaed;
$GLOBALS ["paypal_real_mode"] = 0;  // 1 -> real_mode(real);  0 -> demo_mode(sandbox);



/**
 *  
 *  Maximal Values Defined
 *  
 */

$GLOBALS ["max_shortlinks_by_publisher"] = 100;  // -> Maximal Shortlinks which each publisher user can usleep
$GLOBALS ["max_campaigns_created_by_advertiser"] = 9; // -> Maximal Camapign which each advertiser user can create; Maximal are 10; Thatswhy 9;
$GLOBALS ["max_ads_spaces_per_campaign_by_advertiser"] = 6; // ->  Maximal Camapign which each advertiser user can create, per Campaign;
$GLOBALS ["min_payment_to_publisher_in_dollars"] = 10;
$GLOBALS ["max_payment_to_publisher_in_dollars"] = 30;
$GLOBALS ["min_payment_from_advertiser_in_dollars"] = 15;
$GLOBALS ["max_payment_from_advertiser_in_dollars"] = 50;



/**
 *  
 *  Activation of Website Zones 
 *  
 */

$GLOBALS ["campaign_advertiser_activation_required"] = 0; // -> 0 -> Campaigns will be automaticly approved; 1 -> should has a additional activation
$GLOBALS ["registration_new_users_allowed"] = 1; // 0 -> No new registratrion allowed; 1 -> New registratrions allowed.
$GLOBALS ["advertisers_allows_create_new_campaigns"] = 1; // 0 -> Creation new campaigns not allowed; 1 -> Creation new campaigns  allowed
$GLOBALS ["publishers_allows_create_new_ads_units"] = 1; // 0 -> Creation new Ad Units not allowed 1 -> Creation new Ads allowed;
$GLOBALS ["publishers_redirect_to_NCM_default"] = 0; // 0 -> Redirects to Advertiser Content and add Visito Counter; 1 -> Redirects to NCM_Default content and no Visit counter are incremented.

/**
 *  
 *  Activation of Ads Programs 
 *  
 */
 
$GLOBALS ["activation_of_banners_program"] = 1; // 0 -> will be not shown in advertisers and publishers the banners links, and the access will be fobidden. 1-> program access will be allowed.
$GLOBALS ["activation_of_shortlinks_program"] = 1;  // 0 -> will be not shown in advertisers and publishers the banners links, and the access will be fobidden. 1-> program access will be allowed.










if ( $GLOBALS ["local"] == 0) {


define('DB_SERVER','mysql15.000webhost.com');
define('connection','a7010140_db');
define('DB_USER','a7010140_user');
define('DB_PASS','Jupi12345_67890');
 
 } else {
 
define('DB_SERVER','localhost');
define('connection','a7010140_db');
define('DB_USER','root');
define('DB_PASS','root');
 
 
 }
    $con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
    mysql_select_db(connection,$con);
	
	
	
	
function paypal_connnection () {
	
	   if ( $GLOBALS ["local"] == 0) {		 
		 $servername = "mysql15.000webhost.com";
		 $username = "a7010140_user";
		 $password = "Jupi12345_67890";
         $dbname = "a7010140_db";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		} else {
		
		 $conn = "demo_local";
		
		}
		
		
		
		return $conn;
	
	
	
}	
	
 
?>
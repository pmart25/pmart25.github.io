<?php
 
// datos para la coneccion a mysql

/**
*
*  project  NCM_Ads
*  @file blog.php
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   Connection settings of NCM_Ads
*
*/


$GLOBALS ["local"]
$GLOBALS ["debug_mode"] = 1;

if ( $GLOBALS ["local"] == 0) {


define('DB_SERVER','mysql_host.com');
define('connection','XXXX');
define('DB_USER','XXXX');
define('DB_PASS','XXXX');
 
 } else {
 
define('DB_SERVER','localhost');
define('connection','XXXX');
define('DB_USER','root');
define('DB_PASS','root');
 
 
 }
    $con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
    mysql_select_db(connection,$con);
	
	
	
	
function paypal_connnection () {
	
	   if ( $GLOBALS ["local"] == 0) {		 
		 $servername = "mysql_webhost.com";
		 $username = "XXXX";
		 $password = "XXXX";
         $dbname = "XXXX";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		} else {
		
		 $conn = "demo_local";
		
		}
		
		
		
		return $conn;
	
	
	
}	
	
 
?>
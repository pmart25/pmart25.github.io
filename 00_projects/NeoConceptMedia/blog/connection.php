<?php
 
// datos para la coneccion a mysql

/**
*
*  project  NCM_Ads
*  @file blog.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   Connection settings of NCM_Ads
*
*/


$GLOBALS ["local"]


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
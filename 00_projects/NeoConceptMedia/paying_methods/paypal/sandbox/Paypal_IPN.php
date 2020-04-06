

<?php 

/**
*
*  project  NCM_Ads
*  @file Paypal_IPN.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   Class PayPal_IPN of NCM_Ads
*
*/

class Paypal_IPN
{
     //https://www.youtube.com/watch?v=t_7GA1BZXPs
     /**
	 *@param string $mode 'live' or 'sandboxÄ 
	 */
	 public function __construct($mode = 'live')
	 {
		 if($mode == 'live')
			 $this -> _url='https://www.paypal.com/cgi-bin/webscr';
		 else
		 $this -> _url='https://www.sandbox.paypal.com/cgi-bin/webscr';			 
	
		 
	 }  
   
     public function run()
	 {
		 //calls paypal
		 
		 $postFields = 'cmd=_notify-validate';
		 
		 
		 
		foreach ($_POST as $key => $value) 
		{
			$postFields .= "&$key=".urlencode($value);
			
		}
		 
		// assing post variables to local variables

    $data['item_name']        = $_POST['item_name'];
    $data['item_number']      = $_POST['item_number'];
    $data['payment_status']   = $_POST['payment_status'];
    $data['payment_amount']   = $_POST['mc_gross'];
    $data['payment_currency'] = $_POST['mc_currency'];
    $data['txn_id']           = $_POST['txn_id'];
    $data['receiver_email']   = $_POST['receiver_email'];
    $data['payer_email']      = $_POST['payer_email'];
    $data['custom']           = $_POST['custom'];

    $data['customer_title']     = $_POST['title'];
    $data['customer_name']      = $_POST['name'];
$data['customer_surname']       = $_POST['surname'];                
    $data['customer_address_1']     = $_POST['address_1'];
    $data['customer_address_2']     = $_POST['address_2'];
    $data['customer_address_3']     = $_POST['address_3'];
    $data['customer_county']        = $_POST['county'];
$data['customer_postcode']      = $_POST['postcode'];
    $data['customer_job_title']     = $_POST['job_title'];
    $data['customer_organisation']  = $_POST['organisation'];
    $data['customer_email']     = $_POST['email'];
    $data['customer_phone']         = $_POST['phone'];		
		 
		 
		$ch = curl_init();
        curl_setopt_array($ch, array(
		     CURLOPT_URL => $this -> _url,
			 CURLOPT_RETURNTRANSFER => true,
			 CURLOPT_SSL_VERIFYPEER => false,
			 CURLOPT_POST => true,
			 CURLOPT_POSTFIELDS => $postFields
			 
			 
			 
			 ));		
		 $result = curl_exec($ch);
		 echo curl_error($ch);
		 curl_close($ch);
		 echo $result;
		 echo " ";
		 echo $postFields;
		 $fh = fopen('result.txt', 'w');
		 fwrite($fh, $result . ' -- ' . $postFields);
		 //introducir los valores en la base de datos de php
		 
		 
		 /*
		 $servername = "mysql15.000webhost.com";
		 $username = "a7010140xxx";
		 $password = "XXXXx";
         $dbname = "axxx";
        */
		// Create connection
		   // $conn = mysql_connect($servername, $username, $password, $dbname);
		   // the connection is created in functions.php
		// Check connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
			//$sql = "INSERT INTO transfer_history (transfer) VALUES ( '".$result. ' -- ' . $postFields . "')";
			
			 $sql = "INSERT INTO ads_payments (txnid, payment_amount, payment_status, itemid, createdtime, customer_title, customer_name, customer_surname, customer_address_1, customer_address_2, customer_address_3, customer_county, customer_postcode, customer_job_title, customer_organisation, customer_email, customer_phone) 
			    VALUES (
                '" . $data['txn_id'] . "' ,
                '" . $data['payment_amount'] . "' ,
                '" . $data['payment_status'] . "' ,
                '" . $data['item_number'] . "' ,
                '" . date("Y-m-d H:i:s") . "' ,
                '" . $data['customer_title'] . "' ,         
                '" . $data['customer_name'] . "' ,          
                '" . $data['customer_surname'] . "' ,                   
                '" . $data['customer_address_1'] . "' ,    
                '" . $data['customer_address_2'] . "' ,     
                '" . $data['customer_address_3'] . "' ,    
                '" . $data['customer_county'] . "' ,       
                '" . $data['customer_postcode'] . "' ,      
                '" . $data['customer_job_title'] . "' ,     
                '" . $data['customer_organisation'] . "' ,  
                '" . $data['customer_email'] . "' ,         
                '" . $data['customer_phone']  . "'     
                )";
			
			if (mysqli_query($con, $sql)) {
			$log = "New record created successfully";
			$fl = fopen('log.txt', 'w');
		    fwrite($fl, $log);
			fclose ($fl);
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		 fclose ($fh);
	 }
   
   }
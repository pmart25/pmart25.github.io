<?php


/**
*
*  project  NCM_Ads
*  @file Calls.Paypal.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   Class Paypal settings of NCM_Ads
*    
*  paypalewp.php
*  
*  The PayPal class implements the dynamic encryption of PayPal "buy now"
*  buttons using the PHP openssl functions. (This evades the ISP restriction
*  on executing the external "openssl" utility.)
*
*  Original Author: Ivor Durham (ivor.durham@ivor.cc)  Edited by PayPal_Ahmad  (Nov. 04, 2006)
*  Posted originally on PDNCommunity:  http://www.pdncommunity.com/pdn/board/message?board.id=ewp&message.id=87#M87
*
*  Using the orginal code on PHP 4.4.4 on WinXP Pro I was getting the following error:
*  
*  "The email address for the business is not present in the encrypted blob. Please contact your merchant"
*  
*  I modified and cleaned up a few things to resolve the error - this was tested on PHP 4.4.4 + OpenSSL on WinXP Pro
*  Example usage:
*/




  
class PayPal_EWP {
  var $certificate;	// Certificate resource
  var $certificateFile;	// Path to the certificate file

  var $privateKey;	// Private key resource (matching certificate)
  var $privateKeyFile;	// Path to the private key file

  var $paypalCertificate;	// PayPal public certificate resource
  var $paypalCertificateFile;	// Path to PayPal public certificate file

  var $certificateID; // ID assigned by PayPal to the $certificate.

  var $tempFileDirectory;

  function PayPal() {
  }

  /*
    setCertificate: set the client certificate and private key pair.

    $certificateFilename - The path to the client certificate

    $keyFilename - The path to the private key corresponding to the certificate

    Returns: TRUE iff the private key matches the certificate.
   */

  function setCertificate($certificateFilename, $privateKeyFilename) {
    $result = FALSE;

    if (is_readable($certificateFilename) && is_readable($privateKeyFilename)) {
      $certificate =
	openssl_x509_read(file_get_contents($certificateFilename));

      $privateKey =
	openssl_get_privatekey(file_get_contents($privateKeyFilename));

      if (($certificate !== FALSE) &&
	  ($privateKey !== FALSE) &&
	  openssl_x509_check_private_key($certificate, $privateKey)) {
	$this->certificate = $certificate;
	$this->certificateFile = $certificateFilename;

	$this->privateKey = $privateKey;
	$this->privateKeyFile = $privateKeyFilename;
	
	$result = TRUE;
      }
    }

    return $result;
  }

  /*
    setPayPalCertificate: Sets the PayPal certificate

    $fileName - The path to the PayPal certificate.

    Returns: TRUE iff the certificate is read successfully, FALSE otherwise.
   */

  function setPayPalCertificate($fileName) {
    if (is_readable($fileName)) {
      $certificate = openssl_x509_read(file_get_contents($fileName));

      if ($certificate !== FALSE) {
	$this->paypalCertificate = $certificate;
	$this->paypalCertificateFile = $fileName;

	return TRUE;
      }
    }

    return FALSE;
  }

  /*
    setCertificateID: Sets the ID assigned by PayPal to the client certificate

    $id - The certificate ID assigned when the certificate was uploaded to PayPal
   */

  function setCertificateID($id) {
    $this->certificateID = $id;
  }

  /*
    setTempFileDirectory: Sets the directory into which temporary files are written.

    $directory - Directory in which to write temporary files.

    Returns: TRUE iff directory is usable.
   */

  function setTempFileDirectory($directory) {
    if (is_dir($directory) && is_writable($directory)) {
      $this->tempFileDirectory = $directory;
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /*
    encryptButton: Using the previously set certificates and tempFileDirectory
    encrypt the button information.

    $parameters - Array with parameter names as keys.

    Returns: The encrypted string for the _s_xclick button form field.
   */

  function encryptButton($parameters) {
    // Check encryption data is available.

    if (($this->certificateID == '') ||
	!IsSet($this->certificate) ||
	!IsSet($this->paypalCertificate)) {
      return FALSE;
    }

    $clearText = '';
    $encryptedText = '';

    // Compose clear text data.

    $clearText = 'cert_id=' . $this->certificateID;

    foreach (array_keys($parameters) as $key) {
      $clearText .= "\n{$key}={$parameters[$key]}";
    }

    $clearFile = tempnam($this->tempFileDirectory, 'clear_');
    $signedFile = preg_replace('/clear/', 'signed', $clearFile);
    $encryptedFile = preg_replace('/clear/', 'encrypted', $clearFile);

    $out = fopen($clearFile, 'wb');
    fwrite($out, $clearText);
    fclose($out);

    if (!openssl_pkcs7_sign($clearFile, $signedFile, $this->certificate, $this->privateKey, array(), PKCS7_BINARY)) {
      return FALSE;
    }

    $signedData = explode("\n\n", file_get_contents($signedFile));

    $out = fopen($signedFile, 'wb');
    fwrite($out, base64_decode($signedData[1]));
    fclose($out);

    if (!openssl_pkcs7_encrypt($signedFile, $encryptedFile, $this->paypalCertificate, array(), PKCS7_BINARY)) {
      return FALSE;
    }

    $encryptedData = explode("\n\n", file_get_contents($encryptedFile));

    $encryptedText = $encryptedData[1];

    @unlink($clearFile);
    @unlink($signedFile);
    @unlink($encryptedFile);

    return $encryptedText;
  }
}



class PayPal_IPN
{
     //https://www.youtube.com/watch?v=t_7GA1BZXPs
     /**
	 *@param string $mode 'live' or 'sandbox 
	 */
	 
	    // instand notification link -->	http://ncp.freeiz.com/pub_test/settings?case=12
	 
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
		 
		require_once('functions.php'); 
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


		$fh = fopen('result.txt', 'w');
		fwrite($fh, $result . ' -- ' . $postFields ."\n");
		
		
		
		// Mejorar esta expresion regular :  txn_id=([0-9A-Z]+)& para obtener el txn_id
		
		$regex_pattern = '/txn_id=([0-9A-Z]+)&/';
		
		$regex_list_results = preg_match($regex_pattern, $postFields, $regex_list);
		
		$txn_id = $regex_list[0];   // -->  "txn_id=AWEDS23423234SDF&"
		
		$to_get_out = array ("txn_id=", "&");
		$to_get_in  = array ("", "");
		$txn_id = str_replace ( $to_get_out  , $to_get_in  , $txn_id);
		echo $txn_id;		
		
		// get the txn_id 
	
		
		$log = 'LOG : '.date("Y-m-d H:i:s")." - ".$result.$postFields;
		//$sql = 'INSERT INTO transfer_history (transfer) VALUES ("'.$log.'")'; 
		//INSERT INTO transfer_history (transfer) VALUES ("$log")
		$sql = 'INSERT INTO transfer_history (transfer, txn_id) VALUES ("'.$log.'", "'.$txn_id.'")'; 
		$sql_to_logs = $sql;
		$asql = mysql_query ($sql);
	       if (!$asql)
	       {
		    die('mysql consult no valid: ' . mysql_error());
	       }
		//introducir los valores en la base de datos de php
		 

		// Check connection
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
		 $sql_to_ads_payments = $sql;	
		 $asql = mysql_query($sql);
	     if (!$asql)
	       {
		    die('mysql consult no valid: ' . mysql_error());
	       }	     
		 fwrite($fh, $sql_to_ads_payments . " \n " . $sql_to_logs ."\n". $txn_id);
		 fclose ($fh);
		 return $fh;
	 }
   
   }



?>
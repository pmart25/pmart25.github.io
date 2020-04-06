

<?
  
    echo "test_file";
	$log =  "LOG : 2015-07-16 10:47:29 - VERIFIEDcmd=_notify-validate&payment_type=instant&payment_date=Thu+Jul+16+2015+15%3A57%3A13+GMT%2B0200+%28Mitteleurop%C3%A4ische+Sommerzeit%29&payment_status=Pending&address_status=confirmed&payer_status=verified&first_name=John&last_name=Smith&payer_email=buyer%40paypalsandbox.com&payer_id=TESTBUYERID01&address_name=John+Smith&address_country=United+States&address_country_code=US&address_zip=95131&address_state=CA&address_city=San+Jose&address_street=123+any+street&business=seller%40paypalsandbox.com&receiver_email=seller%40paypalsandbox.com&receiver_id=seller%40paypalsandbox.com&residence_country=US&item_name=something&item_number=AK-1234&quantity=1&shipping=3.04&tax=2.02&mc_currency=USD&mc_fee=0.44&mc_gross=12.34&mc_gross1=12.34&txn_type=web_accept&txn_id=568020660&notify_version=2.1&custom=xyz123&invoice=abc1234&test_ipn=1&verify_sign=AFcWxV21C7fd0v3bYYYRCpSSRl31A86ftg4TRyCbBwwx.dwzljusMbaf";
			
	$regex_pattern = "/txn_id=([0-9A-Z]+)&/";
		
	$res = preg_match($regex_pattern, $log, $regex_list );
		
	$txn_id = $regex_list[0];   // -->  "txn_id=AWEDS23423234SDF&"
		
	$to_get_out = array ("txn_id=", "&");
	$to_get_in  = array ("", "");
	$txn_id = str_replace ( $to_get_out  , $to_get_in  , $txn_id);
	echo "<br>\n";
	var_dump ($txn_id);
	
	echo "ahora el test del arhcivo";
	echo "<br>\n";
	
	$fh = fopen('result_test.txt', 'w');
	$result = "result de la llamada";
	$sql_to_ads_payments = "INSERT BLABLA 1";
	$sql_to_logs = "INSERT BLABLA 2";
	fwrite($fh, $result ."\n");
	fwrite($fh, $sql_to_ads_payments . " \n " . $sql_to_logs ."\n". $txn_id);
    fclose ($fh);
	
	
	

?>





<?


/**
*
*  project  NCM_Ads
*  @file crypt.php
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief  fucntions of crypt for NCP_Ads  
*                         
*/




//generar un string random

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*
$my_string = generateRandomString(10);
echo $my_string;
echo "</br>\n ";
echo "md5: ". md5($my_string); 
echo "   _______ ";
echo "</br>\n ";
$my_string = generateRandomString(15);
echo $my_string;
echo " </br>";
echo "md5: ". md5($my_string); 
echo " </br>";
echo base64_encode(md5($my_string));


echo "</br>\n ";

echo "use case 2";

echo "-----";
$input = "SmackFactory";


*/


$encrypted = encryptIt( $input );
$decrypted = decryptIt( $encrypted );

//echo $encrypted . '<br />' . $decrypted;

function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

/*

echo '<br />';
echo "use case 3 timestamp unix __________ \n";
echo '<br />';
$date = time();
echo $date;
echo '<br />';
echo $date + 300;

*/

?>
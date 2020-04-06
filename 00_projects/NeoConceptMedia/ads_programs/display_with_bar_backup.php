<?

/**
*
*  project  NCM_Ads
*  @file display_with_bar.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   Template NCM_Ads
*/


require_once("functions.php");


?>

<?

header("X-Frame-Options: SAMEORIGIN");


$GLOBALS ["debug_mode"] = 1;
if (isset($_REQUEST['n'])) {
$n = mysql_real_escape_string($_GET["n"]);
} else {
$n = -1;

 }



 
 
 /**
  *  
  *  ANTI FRAMEKILLER
  *  
  */
  
  
?>


<?


if ($n == TRUE) {



        $short_code = $n;
	

        $datestamp = date("U");

        /**
         *  
         *  
         *  get final url
         */
		 
		 

		//$to_encrypt =    "ads_id=".$ads_id."&ads_web_id=".$ads_web_id."&datestamp=".$datestamp."&checksum=1";
		 
		$sql = 'SELECT ads_pub_shortlinks_id FROM ads_pub_shortlinks WHERE short_code = "'.$short_code.'"';
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
	   	$asql_list = mysql_fetch_array($asql);
		
		$ads_pub_shortlinks_id = $asql_list[0];
		
		//'rep.php?r='.rawurlencode($encrypted_string);
		$final_url =  "ads_program=1&ads_pub_shortlinks_id=".$ads_pub_shortlinks_id."&datestamp=".$datestamp."&checksum=1";
		
		$final_url = encrypt_it($final_url);
		$final_url = "./rep.php?r=".rawurlencode($final_url);
		/**
		 *  
		 *  come from functions.php line 589
		 *  
		 *  
		 */
		


		/**
		 *  
		 *  //
		 * url to promote
	     * 
		 *  
		 *  
		 */
		
		
		
        $num_rand = rand(0,9);
		
		$sql = 'SELECT url_to_promote FROM ads_adv_shortlinks WHERE state = "1" LIMIT 1,10 ';
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
	   	$asql_list = mysql_fetch_array($asql);
		//$shortcode = $asql_list[0];

		 $url_to_promote = $asql_list[0];
		 
		 
		 
		 //add the visit
		 
		 update_shortlinks_visit_values($ads_pub_shortlinks_id);
		 
		 
		 
		 if ( $debug_mode == TRUE) {
		
		echo '</br></br></br></br></br>';
		 echo $num_rand;
		 echo "final_url : ".$final_url;
		 echo "\n";
		 echo "url_to_promote: ". $url_to_promote;
		 echo "\n";
		 
		 
		 }
		 
		
} else {


echo '<div class="div_embedded_page">';

echo "<p>Error in shortcode</p>";

echo '</div>';




}









		

	   


?>

<html>
<head>
<title>  Neo Concept Media </title>
<meta http-equiv="Content-Type" content="text/html; charset-iso-8859-1">
<link rel="stylesheet" type="text/css" href="css/bar_style.css" />

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<script type="text/javascript">



</script>


<div class="upper_bar">

<div class="wrapper">
 <div id="myTimer"> </div> 
 
</div>


  <!--<button type="button" id="myBtn" class="btnDisable" disabled onclick="alert('Finally!')">Please wait...</button>
 

 <div  id="skip_ad_button" class="skip_ad_button_disable"  onclick="alert('Finally!')">Please wait...</div>

 
  
  </div>

-->


<div id="skip_ad_button" class="skip_ad_button_disable"  > <p> Skip Ad </p> </div>

<script>
var sec = 5;
var myTimer = document.getElementById("myTimer");
var myBtn = document.getElementById("#skip_ad_button");
window.onload = countDown;

function countDown() {
	if (sec < 6) {
		myTimer.innerHTML = " You can skip this add in 0" + sec;
	} else {
		myTimer.innerHTML = sec;
	}
	if (sec <= 0) {
		$("#skip_ad_button").removeClass("skip_ad_button_disable");
		$("#skip_ad_button").addClass("skip_ad_button_enable");
		<!--$("#skip_ad_button").removeClass().addClass("skip_ad_button_enable");
		<!--$("#skip_ad_button").addClass("skip_ad_button_enable");
		$("#skip_ad_button").on("click", function() { window.location.href = "<? echo $final_url; ?>"});
		$("#myTimer").fadeTo(2500, 0);
		$("#myTimer").innerHTML = "<p>Click Me!<p>";
		return;
	}
	sec -= 1;
	window.setTimeout(countDown, 1000);
}


<? 


/*
  var prevent_bust = 0;

// Event handler to catch execution of the busting script.
window.onbeforeunload = function() { prevent_bust++ };

// Continuously monitor whether busting script has fired.
setInterval(function() {
  if (prevent_bust > 0) {  // Yes: it has fired. 
    prevent_bust -= 2;     // Avoid further action.
    // Get a 'No Content' status which keeps us on the same page.
    window.top.location = '<? echo $final_url; ?>';
  }
}, 1);




<!-- http://stackoverflow.com/questions/19921676/does-not-permit-cross-origin-framing-iframe 
var url = "<? echo $url_to_promote; ?>";
$.getJSON('http://whateverorigin.org/get?url=' + encodeURIComponent(url) + '&callback=?', function(data){
            var html = ""+data.contents;

            /* Replace relative links to absolute ones 
            html = html.replace(new RegExp('(href|src)="/', 'g'),  '$1="'+url+'/');

            $("#siteLoader").html(html);
        });
 -->
 */ ?>
window.document.domain = "<? echo $url_to_promote; ?>";
window.document.getElementById("myIFrame").contentWindow.document.body.style.backgroundColor = "red";

</script>

</div>

<div class="div_embedded_page">

<? /*
 <object id="myIFrame" type="text/html" data=<? echo $url_to_promote; ?>  >
    </object> */
	?>

	
<!--  http://qnimate.com/same-origin-policy-in-nutshell/  -->	
	
<?	echo file_get_contents($url_to_promote); ?>

?>

</div>

<iframe src="" id="myIFrame" height= "100" width="100"></iframe>
</head>
	   
<body> 



</body>
	  
</html>



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

if (isset($_REQUEST['r'])) {
$r = mysql_real_escape_string($_GET["r"]);
} else {
$r = -1;






if ($r == TRUE) {



        $short_code = $r;
		
		
		
		$sql = 'SELECT url_to_promote FROM ads_adv_shortlinks WHERE state = "1" ';
		$asql = mysql_query($sql);
		if (!$asql)
		{
			die('mysql consult no valid: ' . mysql_error());
		}
	   	$asql_list = mysql_fetch_array($asql);
		//$shortcode = $asql_list[0];

		 $url_to_promote = $asql_list[0]
} else {}








		
if ($r == 1) {
		
		
		   $final_url = $shortUrl->shortCodeToUrl($r);
		   header("HTTP/1.1 301 Moved Permanently");
		   header("Location: " . $final_url); 
		   //header("Refresh:0; url=".$url);
		
		} else {
		
		 echo "<p> Error in shortcode </p>";
		}
	   


?>

<html>
<head>
<title>  Neo Concept Media </title>
<meta http-equiv="Content-Type" content="text/html; charset-iso-8859-1">
<link rel="stylesheet" type="text/css" href="bar_style.css" />

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
		$("#skip_ad_button").on("click", function() { alert('Finally!')});
		$("#myTimer").fadeTo(2500, 0);
		$("#myTimer").innerHTML = "<p>Click Me!<p>";
		return;
	}
	sec -= 1;
	window.setTimeout(countDown, 1000);
}

</script>

</div>

<div class="div_embedded_page">


 <object type="text/html" data=<? echo $url_to_promote; ?>  >
    </object>



</div>

</head>
	   
<body> 



</body>
	  
</html>



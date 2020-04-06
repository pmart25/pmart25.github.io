<?
/**
*
*  project  NCM_Ads
*  @file  footer.php
*  @user  pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief    footer of NCM_Ads
*
*/

echo '      </div>'; //end content_text 
echo '      <div class="footer">';
echo '      <div class="line_t"></div>';
echo '      <div class="line_m"></div>';
 

echo '      <div class="menu_footer">';
echo "\n";
echo '<p> Neo Concept Media Ltd. ';
echo "©";
echo date("Y").' </p>';


echo '<div class="div_social_networks"> 

  <a href="facebook_ncm"> <img alt="" src="./img/facebook_icon.png" height="22" width="22" /></a>
  <a href="twitter_ncm"><img  alt="" src="./img/twitter_icon.png" height="22" width="22"/></a>
  <a href="google_plus_ncm"><img   alt="" src="./img/google_icon.png" height="22" width="22"/></a>

   </div>';



if (user_logged_in() == 1){



echo '<table class="menu_footer" border="0" width="790">';



echo '<td width="25%">
<a href="faq.php">FAQ</a>';
echo '</br><a href="about.php">About</a> </td>';




echo '<td width="25%">
<a href="publisher">Publisher</a>';
echo '</br><a href="advertiser">Advertiser</a> </td>';
//echo '</br><a href="settings">Settings </a>';
//echo '</br><a href="helpdesk">Helpdesk</a> </td>';



echo '<td width="25%">';
//echo '</br><a href="settings">Settings </a>';
echo '</br><a href="blog">Blog</a>';
echo '</br><a href="helpdesk">Helpdesk</a> </td>';



echo '<td width="25%">';
echo '</br><a href="disclaimer">Disclaimer</a>';
echo '</br><a href="contact">Contact</a></td>';



echo '</table>';


  }
   else{}

echo '      </div>'; //end menu_footer
echo '      </div>'; //end footer

echo '      </div>'; //end content


echo '   </body>';
echo ' </html>';

?>
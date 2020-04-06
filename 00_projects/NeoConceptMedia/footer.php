<?
/**
*
*  project  NCM_Ads
*  @file  footer.php
*  @user  pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief    footer of NCM_Ads
*
*/

echo '      </div>'; //end content_text 
echo '      <div class="footer">';
echo '      <div class="line_t"></div>';
echo '      <div class="line_m"></div>';
 

echo '      <div class="menu_footer">';
echo '</br>';
echo '<b1> Neo Concept Media Ltd. ';
echo "©";
echo date("Y").' </b1>';


echo '<div class="div_social_networks"> 

   <a href="https://www.facebook.com/social.ncm"><img src="./img/facebook_icon.png" heigth="22" width="22"></img></a>
   <a href="https://twitter.com/social_ncm"><img src="./img/twitter_icon.png" heigth="22" width="22"></img></a>
   <a href="https://plus.google.com/u/0/110593445867947789342"><img src="./img/google_icon.png" heigth="22" width="22"></img></a>



   ';
   echo '      </div>'; //end social networks


if (user_logged_in() == 1){



echo '<table class="menu_footer" border="0" >';



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

echo '      </div>'; //end menu_footer
  }
   else{}



echo '      </div>'; //end footer

echo '      </div>'; //end content


echo '   </body>';
echo ' </html>';

?>
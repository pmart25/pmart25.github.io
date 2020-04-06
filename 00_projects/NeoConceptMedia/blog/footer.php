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
echo '<b1> Neo Concept Media Ltd. </b1>';

if (user_logged_in() == 1){



echo '<table class="menu_footer" border="0" width="790">';



echo '<td width="25%"><a href="faq.php">FAQ</a>';
echo '</br><a href="about.php">About</a>';
echo '</br><a href="disclaimer.php">Disclaimer</a>';
echo '</br><a href="contact.php">Contact</a></td>';



echo '<td width="25%"><a href="publisher">Publisher</a>';
echo '</br><a href="advertiser">Advertiser</a>';
echo '</br><a href="settings">Settings </a>';
echo '</br><a href="helpdesk">Helpdesk</a> </td>';



echo '<td width="25%"><a href="blog.php">Blog</a>';
echo '</br><a href="helpdesk">Helpdesk</a></br></br></br> </td>';



echo '<td width="25%"></td>';


echo '</table>';


  }
   else{}

echo '      </div>'; //end menu_footer
echo '      </div>'; //end footer

echo '      </div>'; //end content


echo '   </body>';
echo ' </html>';

?>
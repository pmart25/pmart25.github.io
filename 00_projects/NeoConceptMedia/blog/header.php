

<?


/**
*
*  project  NCM_Ads
*  @file header.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   header of NCM_Ads
*/




require_once ("functions.php");

echo '<html>';

echo '<head>';
echo '   <title>  Neo Concept Media </title>';
echo '   <meta http-equiv="Content-Type" content="text/html; charset-iso-8859-1">';
echo '   <link rel="stylesheet" type="text/css" href="style.css" />';
echo '   </head>';
   
echo '   <body>';
echo '      <div class="header">';
// insertar una imagen
echo '  <a href="index.php"><img src="logo.png" heigth="196" width="400"></img></a>';



echo ' <div id="cssmenu">';
echo ' <ul>';
echo '    <li class="active"><a href="index.php"><span>Home</span></a></li>';
echo '    <li><a href="register.php"><span>Register</span></a></li>';
echo '    <li><a href="about.php"><span>About</span></a></li>';
echo '    <li class="last"><a href="blog.php"><span>Blog</span></a></li>';
echo ' </ul>';
echo ' </div>';





echo '      </div>';
echo '      <div class="line_t"></div>';
echo '      <div class="line_m"></div>';





?>
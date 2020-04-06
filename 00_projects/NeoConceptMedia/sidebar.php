

<?  

/**
*
*  project  NCM_Ads
*  @file sidebar.php
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief  sidebar of NCM_Ads
*/


include_once "config.php";
echo '<div class="rigth_sidebar">';
if (user_logged_in() == 1){




}
   else{}




   

    if ( $GLOBALS ["local"] == 1) {
	    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	}
    else { 

    session_start();

    }

 
    import_request_variables("GP", "rvar_");
 /*   function verify_login($user,$password,&$result)
    {
        $sql = 'SELECT * FROM ads_users WHERE user = "'.$user.'" and password = "'.$password.'"';
        $asql = mysql_query($sql);
        $count = 0;
        while($row = @mysql_fetch_object($asql))
        {
            $count++;
            $result = $row;
			$state = $result->state;  // state of account :  >= 1 -> OK
        }
        if(($count == 1) && ($state <= 1)) //
        {
            return 1;
        }
        else
        {
            return 0;
        }
    } */   // it is declared in functions.php
    if(!isset($_SESSION['userid']))
    {
        if(isset($_POST['login']))
        {
            if(verify_login($_POST['user'],$_POST['password'],$result) == 1)
            {
                $_SESSION['userid'] = $result->user_uniqid;
                $_SESSION['username'] = $result->user;
                $_SESSION['name'] = $result->name;
                $_SESSION['type'] = $result->type;
                header("location:index.php");
				$sql = 'UPDATE ads_users SET last_login="'.date("Y-m-d H:i:s").'" WHERE	id_user ="'.$result->id_user.'"';
				$asql = mysql_query($sql);
			    if (!$asql)
					{
					die('mysql consult no valid: ' . mysql_error());
					}
				
				
            }
            else
            {
                echo '<div id="error">User data is incorrect. Try again.</div>';
            }
        }
 
     
	
	
echo '	
            <div class="right_sidebar">
           <form action=""  method="post" >
		    <div><label>Username: </label>
		    <br><input name="user" type="text" value=""></div>
		    <div><label>Password: </label>
		    <br><input name="password" type="password" value=""></div>
		    <div>
		    <input name="login" type="submit" value="login"></div>
			
<a href="./forget.php" > Do you forgot your password? </a>
				    	</form> </div> ';
			
        
    }
    else
    {
	

	
        echo '<div class="menu_sidebar">';
        echo 'Your user is correctly logged in. ';
        echo '<a href="logout.php">Logout</a>';
		

	
	echo '  <ul>';
	echo '            <li><a href="advertiser">Advertisers</a></li>';
	echo '            <li><a href="publisher">Publishers</a></li>';        
	echo '            <li><a href="settings">Settings</a></li>';
    echo '            <li><a href="helpdesk">Helpdesk</a></li>';

	
	echo '        </ul>';
		echo '</div>';
    }
echo '</div>';


   ?> 

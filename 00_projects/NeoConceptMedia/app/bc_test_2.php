<?






/**
*
*  project  NCM_Backup
*  @file ncp_backup.php
*  @user pablo torrico
*  email  p_torrico@hotmail.com
*  url  www.neoconceptmedia.com
*  @brief   functions for backup and send to e-mail address.
*/

							





/***************************************************
	Database settings
****************************************************/
	$db_server			= 'mysql15.000webhost.com';				// Database server, usually "localhost", 
	                                                // on (mt) servers something like internal-db.s12345.gridserver.com
 	$db_name 			= 'a7010140_db';				// Database name, leave empty for 'all databases'
	$db_user 		    = 'a7010140_user';				// Database username
	$db_pass 		    = 'Jupi12345_67890';				// Database password

	
/***************************************************
	E-mail settings
****************************************************/
 	$website            = 'ncp.freeiz.com';		    // Your site's domain (without www. part)
	$send_to 		    = 'nge.webdesign@gmail.com';		        // backup file will be sent to?
	$from 		        = 'admin_backup@' . $website;	

/***************************************************
    Misc options
****************************************************/

    $full_path      = '/home/a7010140/public_html/pub_test/app'; 
    // Full path to folder where you are running the script, usually "/home/username/public_html"
    // (mt) servers have something like "/nfs/c01/h01/mnt/12345/domains/yourdomain.mobi/html/tools/backup2mail"

	
/***************************************************
    Misc options
****************************************************/
	
	
$file_name = backup_database_tables($db_server,$db_user,$db_pass,$db_name, '*');
send_attachment($file_name, $file_is_db = true);



/***************************************************
     Functions
	 
****************************************************/


// backup the db function
function backup_database_tables($host,$user,$pass,$name,$tables)
{

$link = mysql_connect($host,$user,$pass);
mysql_select_db($name,$link);

//get all of the tables
if($tables == '*')
{
	$tables = array();
	$result = mysql_query('SHOW TABLES');
	while($row = mysql_fetch_row($result))
	{
		$tables[] = $row[0];
	}
}
else
{
	$tables = is_array($tables) ? $tables : explode(',',$tables);
}

//cycle through each table and format the data
foreach($tables as $table)
{
	$result = mysql_query('SELECT * FROM '.$table);
	$num_fields = mysql_num_fields($result);

	$return.= 'DROP TABLE '.$table.';';
	$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
	$return.= "nn".$row2[1].";nn";

		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("(\n)","",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");n";
			}
		}
	$return.="nnn";
}

//save the file
$file_name = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
$handle = fopen($file_name,'w+');
fwrite($handle,$return);
fclose($handle);
return $file_name;
}


function send_attachment($file, $file_is_db = true) {
	global $send_to, $from, $website, $delete_backup, $html_output;

	$sent       = 'No';

	$subject    = 'MySQL backup - ' . ($file_is_db ? 'db dump' : 'report') . ' [' . $website . ']';
    $boundary   = md5(uniqid(time()));
    $mailer     = 'Sent by NCP.Backup (c) Pablo Torrico 2015 ' ;

	$body = 'Database backup file:' . "\n" . ' - ' . $file . "\n\n";
	$body .= '---' . "\n" . $mailer;

	$headers  = 'From: ' . $from . "\n";
	$headers .= 'MIME-Version: 1.0' . "\n";
	$headers .= 'Content-type: multipart/mixed; boundary="' . $boundary . '";' . "\n";
	$headers .= 'This is a multi-part message in MIME format. ';
	$headers .= 'If you are reading this, then your e-mail client probably doesn\'t support MIME.' . "\n";
	$headers .= $mailer . "\n";
	$headers .= '--' . $boundary . "\n";

	$headers .= 'Content-Type: text/plain; charset="iso-8859-1"' . "\n";
	$headers .= 'Content-Transfer-Encoding: 7bit' . "\n";
	$headers .= $body . "\n";
	$headers .= '--' . $boundary . "\n";

	$headers .= 'Content-Disposition: attachment;' . "\n";
	$headers .= 'Content-Type: Application/Octet-Stream; name="' . $file . "\"\n";
	$headers .= 'Content-Transfer-Encoding: base64' . "\n\n";
	$headers .= chunk_split(base64_encode(implode('', file($file)))) . "\n";
	$headers .= '--' . $boundary . '--' . "\n";

	if (mail($send_to, $subject, $body, $headers)) {
		$sent = 'Yes';		
		echo ($file_is_db ? 'Backup file' : 'Report') . ' sent to ' . $send_to . '.<br />';
		if ($file_is_db) {
			if ($delete_backup) {
	            unlink($file);
				echo 'Backup file REMOVED from disk.<br />';
			} else {
				echo 'Backup file LEFT on disk.<br />';
			}
		}
	} else {
		echo '<span style="color: #f00;">' . ($file_is_db ? 'Database' : 'Report') . ' not sent! Please check your mail settings.</span><br />';
	}
	
	echo 'Sent? ' . $sent;
	
	return $sent;
}

function backup_write_log() {
    global $backup_filename, $date_stamp, $send_log, $label, $full_path;

    $log_file = $full_path . '/backup_log.txt';
    if (!$handle = fopen($log_file, 'a+')) exit;
	if (chmod($log_file, 0644) && is_writable($log_file)) {

    	echo '<h2>Mysqldump...</h2>';
		$dumped         = db_dump();

		echo '<h2>Sending db...</h2>';
	    $log_content    = "\n" . $date_stamp . "\t\t\t" . $dumped . "\t\t\t" . send_attachment($backup_filename);

        echo '<h2>Writing log...</h2>';
        
        $log_header = '';
        if (filesize($log_file) == '0') {
			$log_header .= $label . "\n\n";
			$log_header .= 'Backup log' . "\n";
			$log_header .= '----------------------------------------------' . "\n";
			$log_header .= 'DATESTAMP:					DUMPED		MAILED' . "\n";
			$log_header .= '----------------------------------------------';
			
			if (fwrite($handle, $log_header) === false) exit;
		}
        
        echo 'Log header written: ';
		if (fwrite($handle, $log_header) === false) {
		    echo 'no<br />' . "\n";
		    exit;
		} else {
		    echo 'yes<br />' . "\n";
		}
		                            
		echo 'Log status written: ';    
	    if (fwrite($handle, $log_content) === false) {
		    echo 'no<br />' . "\n";
		    exit;
		} else {
		    echo 'yes<br />' . "\n";
		}

	}

	fclose($handle);
	
	if ($send_log) {
	    echo '<h2>Sending log...</h2>';
		send_attachment($log_file, false);
	}
}



?>
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





include ("send_email.php");
//unlink("backup.zip");   //delete last backup if required



$full_path      = '/home/a7010140/public_html/pub_test/app/'; 
array_map('unlink', glob($full_path."*.zzz"));
$sql_file_attach = backup_database_tables('mysql15.000webhost.com','a7010140_user','Jupi12345_67890','a7010140_db', '*');

//$sql_file_attach = $full_path . $file_attach;
// compress a file_attach





$data = implode("", file($sql_file_attach));
$gzdata = gzencode($data, 9);
$fp = fopen($sql_file_attach.".gz", "w");
fwrite($fp, $gzdata);
fclose($fp);

// send file_attach (gz) per E-mail.

include ("backup_zip.php");




$source = '/home/a7010140/public_html/pub_test/';


$backup_file_attach = "backup-".time().".zzz";

//$backup_file_attach = "backup.zip";


$destination = '/home/a7010140/public_html/pub_test/app/'.$backup_file_attach;
$resp =Zip ($source, $destination);
send_email ( 'nge.webdesign@gmail.com',  $backup_file_attach );
unlink($sql_file_attach);
unlink($sql_file_attach.".gz");




// backup the db function. Export of db.
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
	$return.= "\n\n".$row2[1].";\n\n";

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
				$return.= ");\n";
			}
		}
	$return.="\n\n\n";
}

$file = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
//save the file
$handle = fopen($file,'w+');
fwrite($handle,$return);
fclose($handle);

return $file;
}




?>
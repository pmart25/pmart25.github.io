
<?

/**
*
*  project  NCM_Ads
*  @file ncp_backup.php
*  @user pablo martinez
*  @email p_mart25@outlook.com
*  url  www.neoconceptmedia.com
*  @brief   Backup fucntions of NCM_Ads
*
*/

include ("send_email.php");

$file_attach = backup_database_tables('mysql15.000webhost.com','a7010140_user','Jupi12345_67890','a7010140_db', '*');

send_email ( 'nge.webdesign@gmail.com', $file_attach );

unlink($file_attach);



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

$file = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
//save the file
$handle = fopen($file,'w+');
fwrite($handle,$return);
fclose($handle);

return $file;
}




?>
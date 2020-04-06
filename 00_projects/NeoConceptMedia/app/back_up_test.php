<?php





require_once (\"config.php\");





// get total number of tables


$sql = \"SELECT count(*) from information_schema.tables WHERE table_schema = \'dbName\'\";

$asql  = mysql_query($sql);
		 if (!$asql)
		 {
			die(\'mysql consult no valid: \' . mysql_error());
		 }
$asql_list = mysql_fetch_row($asql);
$total_tables = $asql_list[0];

var_dump($asql);

// get all tables

$sql = \"show tables;\"; //get all tables
$asql  = mysql_query($sql);
		 if (!$asql)
		 {
			die(\'mysql consult no valid: \' . mysql_error());
		 }
$asql_list = mysql_fetch_row($asql);


for (i = 0 ; i >= total_tables ; i++ )
 {
 
 $tableName  = $asql_list[i];
 $backupFile = \'\\home\\a7010140\\public_html\\pub_test\\app\\backup_test.sql\';
 $sql      = \\\"SELECT * INTO OUTFILE \\\'$backupFile\\\' FROM $tableName\\\";
 $asql = mysql_query($sql);

 }

 mysql_close($connection);

?>
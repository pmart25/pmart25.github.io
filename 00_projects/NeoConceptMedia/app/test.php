<?php
/*
for($i=0;$i<128;$i++) {
    echo "$i>" . bin2hex(chr($i)) . "<" . PHP_EOL;
}
*/


// https://github.com/ifsnop/mysqldump-php/blob/master/tests/test.php

error_reporting(E_ALL);
require_once ("Mysqldump.php");
use Mysqldump as IMysqldump;
$dumpSettings = array(
    'exclude-tables' => array('/^travis*/'),
    'compress' => IMysqldump\Mysqldump::NONE,
    'no-data' => false,
    'add-drop-table' => true,
    'single-transaction' => true,
    'lock-tables' => true,
    'add-locks' => true,
    'extended-insert' => false,
    'disable-keys' => true,
    'skip-triggers' => false,
    'add-drop-trigger' => true,
    'routines' => true,
    'databases' => false,
    'add-drop-database' => false,
    'hex-blob' => true,
    'no-create-info' => false,
    'where' => ''
    );
$dump = new IMysqldump\Mysqldump(
    "mysql:host=mysql15.000webhost.com;dbname=a7010140_db",
    "travis",
    "",
    $dumpSettings);
$dump->start("mysqldump-php_a7010140_db.sql");
$dumpSettings['default-character-set'] = IMysqldump\Mysqldump::UTF8MB4;
$dumpSettings['complete-insert'] = true;
$dump = new IMysqldump\Mysqldump(
    "mysql:host=mysql15.000webhost.com;dbname=a7010140_db",
    "travis",
    "",
    $dumpSettings);
$dump->start("mysqldump-php_a7010140_db.sql");
$dumpSettings['complete-insert'] = false;
$dump = new IMysqldump\Mysqldump(
    "mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=a7010140_db",
    "travis",
    "",
    $dumpSettings);
$dump->start("mysqldump-php_a7010140_db.sql");
$dump = new IMysqldump\Mysqldump(
    "mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=a7010140_db",
    "travis",
    "",
    array("no-data" => true, "add-drop-table" => true));
$dump->start("mysqldump-php_a7010140_db.sql");
exit;
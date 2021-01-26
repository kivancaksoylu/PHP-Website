<?php
$db_host='sql200.epizy.com';
$db_user='epiz_26109195';
$db_password='sUf1gEWUlrsgCH';
$db_name='epiz_26109195_proje';
$db_port='3306';

//Db conn
$db_conn=new MySQLi($db_host,$db_user,$db_password,$db_name,$db_port);
if($db_conn->connect_error) {
	$error=$db_conn->connect_error;
	}
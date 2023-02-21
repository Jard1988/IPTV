<?php


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'airsoftplanner');

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_USERNAME', 'geral.airsoftplanner@gmail.com');
define('MAIL_PASSWORD', 'fvprsygwdqhanxpr');
define('MAIL_PORT', '587');
define('MAIL_NAME', 'Airsoft Planner');

//define('DB_SERVER', '81.88.53.63');
//define('DB_USERNAME', 'bv56glrq_1060735');
//define('DB_PASSWORD', '90#P1pr)kB&C');
//define('DB_DATABASE', 'bv56glrq_airsoftplanner');

// Create connection
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// Check connection
if (!$db){
	die("Connection failed: " . mysqli_connect_error());
}

?>

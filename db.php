<?php


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'iptvplanner');

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_USERNAME', 'geraliptvplanner@gmail.com');
define('MAIL_PASSWORD', 'vwscapohsysmhsia');
define('MAIL_PORT', '587');
define('MAIL_NAME', 'IPTV Planner');

define('TWILIO_ACCOUNT_SID', 'ACef846a8f5f3a07ae3246486fef91e8bf');
define('TWILIO_AUTH_TOKEN', '03eff5324631e0d38e91ed2f9c56651e');
define('TWILIO_AUTH_PHONE', '+14345973989');

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
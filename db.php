<?php
//ATENÇÃO AOS NUMEROS DAS LINHAS PODE ALTERAR CODIGO NO MENU/GERAL/EDIT_WEBSITE.PHP

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'iptvplanner');

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'id20666029_iptvplanner');
// define('DB_PASSWORD', '#waO58eP*p&qaSQ%%aeR');
// define('DB_DATABASE', 'id20666029_iptvplanner_db');

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_USERNAME', 'geraliptvplanner@gmail.com');
define('MAIL_PASSWORD', 'aclphfvgkarllwih');
define('MAIL_PORT', '587');
define('MAIL_NAME', 'IPTV Planner');

// define('TWILIO_ACCOUNT_SID', 'ACef846a8f5f3a07ae3246486fef91e8bf');
// define('TWILIO_AUTH_TOKEN', '03eff5324631e0d38e91ed2f9c56651e');
// define('TWILIO_AUTH_PHONE', '+14345973989');

define('M3U', 'http://smart.niceed.xyz:80/get.php?username=hu0114472&password=N7bjC$qjWh9&type=m3u_plus&output=mpegts');

define('CAMINHO_URL', 'https://localhost/iptv/Listas/');
// define('CAMINHO_URL', 'https://iptvplanner.pt/iptv/Listas/');

// Create connection
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// Check connection
if (!$db){
	//die("Connection failed: " . mysqli_connect_error());
	die("Connection failed. Verifique as suas ligações se estão corretas");
}

?>

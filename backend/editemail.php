<?php
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include('../session.php');
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
set_time_limit(300);

$host = mysqli_real_escape_string($db,$_POST['email_host']);
$name = mysqli_real_escape_string($db,$_POST['email_name']);
$pass = mysqli_real_escape_string($db,$_POST['email_pass']);
$port = mysqli_real_escape_string($db,$_POST['email_port']);
$user = mysqli_real_escape_string($db,$_POST['email_user']);
 
$linhas = explode("\n", file_get_contents("../db.php"));

//Ler somente o conteudo da linha [0]do array ou seja linha 1 do texto
$linha_n = $linhas[13]; // host
$linha_n1 = $linhas[14]; //user
$linha_n2 = $linhas[15]; //pass
$linha_n3 = $linhas[16]; //port
$linha_n4 = $linhas[17]; //name
// abre o arquivo colocando o ponteiro de escrita no final
$arquivo = fopen('../db.php','r+');
if ($arquivo) {

  //Output lines until EOF is reached
  while(!feof($arquivo)) {
    $linha = fgets($arquivo);
 if(strcmp(trim($linha_n), trim($linha)) == 0) {
   $string .= str_replace("$linha_n", "define('MAIL_HOST', '". trim($host)."');", $linha);
 }elseif(strcmp(trim($linha_n1), trim($linha)) == 0) {
   $string .= str_replace("$linha_n1", "define('MAIL_USERNAME', '". trim($name)."');", $linha);
 }elseif(strcmp(trim($linha_n2), trim($linha)) == 0) {
   $string .= str_replace("$linha_n2", "define('MAIL_PASSWORD', '". trim($pass)."');", $linha);
 }elseif(strcmp(trim($linha_n3), trim($linha)) == 0) {
   $string .= str_replace("$linha_n3", "define('MAIL_PORT', '". trim($port)."');", $linha);
 } elseif(strcmp(trim($linha_n4), trim($linha)) == 0) {
   $string .= str_replace("$linha_n4", "define('MAIL_NAME', '". trim($user)."');", $linha);
 } else  {
       $string.= $linha;
     }
   }
 }

    // move o ponteiro para o inicio do arquivo
    rewind($arquivo);

    // Apaga o conteudo
    ftruncate($arquivo, 0);

    // reescreve o conteudo dentro do arquivo
    if (!fwrite($arquivo, $string)) die('Não foi possível atualizar o arquivo.');
    echo 'Arquivo atualizado com sucesso';
    fclose($arquivo);

?>

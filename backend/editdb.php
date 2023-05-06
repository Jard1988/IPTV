<?php
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include('../session.php');
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
set_time_limit(300);

$dbname = mysqli_real_escape_string($db,$_POST['dbname']);
$dbuser = mysqli_real_escape_string($db,$_POST['dbuser']);
$dbpass = mysqli_real_escape_string($db,$_POST['dbpass']);

$linhas = explode("\n", file_get_contents("../db.php"));

//Ler somente o conteudo da linha [0]do array ou seja linha 1 do texto
$linha_n = $linhas[6]; // name
$linha_n1 = $linhas[5]; //pass
$linha_n3 = $linhas[4]; //user
// abre o arquivo colocando o ponteiro de escrita no final
$arquivo = fopen('../db.php','r+');
if ($arquivo) {

  //Output lines until EOF is reached
  while(!feof($arquivo)) {
    $linha = fgets($arquivo);
 if(strcmp(trim($linha_n), trim($linha)) == 0) {
   $string .= str_replace("$linha_n", "define('DB_DATABASE', '". trim($dbname)."');", $linha);
 }elseif(strcmp(trim($linha_n1), trim($linha)) == 0) {
   $string .= str_replace("$linha_n1", "define('DB_PASSWORD', '". trim($dbpass)."');", $linha);
 }elseif(strcmp(trim($linha_n3), trim($linha)) == 0) {
   $string .= str_replace("$linha_n3", "define('DB_USERNAME', '". trim($dbuser)."');", $linha);
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

<?php
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include('../session.php');
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
set_time_limit(300);
$caminho = mysqli_real_escape_string($db,$_POST['caminho']);
$list_url = mysqli_real_escape_string($db,$_POST['list_url']);
$site_url = mysqli_real_escape_string($db,$_POST['site_url']);

$linhas = explode("\n", file_get_contents("../db.php"));

//Ler somente o conteudo da linha [0]do array ou seja linha 1 do texto
$linha_n = $linhas[23];
$linha_n1 = $linhas[27];
$linha_n2 = $linhas[25];

// abre o arquivo colocando o ponteiro de escrita no final
$arquivo = fopen('../db.php','r+');

if ($arquivo) {

  //Output lines until EOF is reached
  while(!feof($arquivo)) {
    $linha = fgets($arquivo);

 if(strcmp(trim($linha_n2), trim($linha)) == 1) {
   if(strcmp(trim($linha_n1), trim($linha)) == 1) {
     if(strcmp(trim($linha_n), trim($linha)) == 1) {
       $string.= $linha;
     }else {
       $string .= str_replace("$linha_n", "define('M3U', '" .ltrim($caminho)."');", $linha);
     }
   }else {
     $string .= str_replace("$linha_n1", "define('RAIZ_CAMINHO', '" .ltrim($list_url)."');", $linha);
   }
 }else {
    $string .= str_replace("$linha_n2", "define('CAMINHO_URL', '". trim($site_url)."');", $linha);
 }
}

if(strcmp(trim($linha_n1), trim($linha)) == 1) {
  $string.= $linha;
}else {
  $string .= str_replace("$linha_n1", "define('CAMINHO_URL', '" .ltrim($list_url)."');", $linha);
}

    // move o ponteiro para o inicio do arquivo
    rewind($arquivo);

    // Apaga o conteudo
    ftruncate($arquivo, 0);

    // reescreve o conteudo dentro do arquivo
    if (!fwrite($arquivo, $string)) die('Não foi possível atualizar o arquivo.');
    echo 'Arquivo atualizado com sucesso';
    fclose($arquivo);

}
?>

<?php
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include('../session.php');
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
set_time_limit(300);
$opt = mysqli_real_escape_string($db,$_POST['opt']);
$caminho = mysqli_real_escape_string($db,$_POST['caminho']);

$file = fopen("../db.php", "r+");

if (!$file) {
  echo "Falha ao abrir o arquivo";
}

if ($opt == '1'){
  $i = 1
  echo $opt;

  while (($line = fgets($file)) !== false) {

      if ($i == 24) {

              echo "i: " . $i;
      }
      $i++;
      echo $line;

  }

  if (!feof($file)) {
      exit("Falha inesperada do fgets()");
  }

}elseif($opt == "2"){

}elseif ($opt == "3"){

}

fclose($file);

?>

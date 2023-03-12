<?php
	include('../session.php');

  if($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = mysqli_real_escape_string($db,$_GET['id']);
    $sql1 = "SELECT * FROM organizador WHERE organizador_id = '$id'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($row1 >=1) {
        echo $row1['descricao_evento'];
    }else {
        echo "Não conseguiu a introdução automática dos dados predefinidos.";
    }

  }
?>

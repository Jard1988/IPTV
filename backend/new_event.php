<?php
	include('../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = mysqli_real_escape_string($db,$_POST['data']);
    $hora = mysqli_real_escape_string($db,$_POST['hora']);
    $local = mysqli_real_escape_string($db,$_POST['local']);
    $descricao = mysqli_real_escape_string($db,$_POST['descricao']);

    $sql1 = "SELECT * FROM users_organizador WHERE users_id = '$users_id'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($row1 >=1) {
      $sql2 = "INSERT INTO evento (organizador_id, data_evento, hora_evento) VALUES ('" . $local . "','" . $data . "','" . $hora . "')";
      $result2 = mysqli_query($db, $sql2);
      $sql3 = "UPDATE organizador SET descricao_evento = '". $descricao . "' WHERE organizador_id='". $local."'";
      $result3 = mysqli_query($db, $sql3);
      echo "Evento Criado";
    }else {
        echo "Não foi possivel criar o evento. Tente Novamente.";
    }

  }
?>

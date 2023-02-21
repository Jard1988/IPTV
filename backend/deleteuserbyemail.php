<?php
	include('../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($db,$_POST['id']);

    $sql1 = "SELECT * FROM users WHERE email = '$id'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($row1 >=1) {
      $sql3 = "DELETE FROM users WHERE email='". $id."'";
      $result3 = mysqli_query($db, $sql3);
      echo "User's Seleccionados Apagado";
    }else {
        echo "Não foi possivel Apagar os User's Seleccionados. Tente Novamente.";
    }

  }
?>

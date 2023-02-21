<?php
	include('../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($db,$_POST['id']);

    $sql1 = "SELECT * FROM users WHERE users_id = '$id'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($row1 >=1) {
      $sql3 = "DELETE FROM users WHERE users_id='". $id."'";
      $result3 = mysqli_query($db, $sql3);
      echo "User Apagado";
    }else {
        echo "Não foi possivel Apagar o User. Tente Novamente.";
    }

  }
?>

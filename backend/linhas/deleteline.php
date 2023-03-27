<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($db,$_POST['id']);

    $sql1 = "SELECT * FROM linhas WHERE linhas_id = '$id'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($row1 >=1) {
      $sql3 = "DELETE FROM linhas WHERE linhas_id='". $id."';";
			$sql4 = "DELETE FROM users_linhas WHERE linhas_id='". $id."';";
      $result3 = mysqli_query($db, $sql3);
			$result4 = mysqli_query($db, $sql4);
      echo "Linha Apagada";
    }else {
        echo "Não foi possivel Apagar a Linha. Tente Novamente.";
    }

  }
?>

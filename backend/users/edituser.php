<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($db,$_POST['id']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $nome = mysqli_real_escape_string($db,$_POST['nome']);
		$apelido = mysqli_real_escape_string($db,$_POST['apelido']);
		$telefone = mysqli_real_escape_string($db,$_POST['telefone']);
    $nascimento = mysqli_real_escape_string($db,$_POST['nascimento']);
		$raw = mysqli_real_escape_string($db,$_POST['raw']);
    $permission = mysqli_real_escape_string($db,$_POST['permission']);

    $sql1 = "SELECT * FROM users WHERE users_id = '$id'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($row1 >=1) {
      $sql3 = "UPDATE users SET email = '". $email . "', nome = '". $nome . "', apelido = '". $apelido . "', raw = '". $raw . "', telefone = '". $telefone . "', data_nascimento = '". $nascimento . "',
       permission_id = '". $permission . "'
       WHERE users_id='". $id."'";
      $result3 = mysqli_query($db, $sql3);
      echo "User Alterado";
    }else {
        echo "Não foi possivel Alterar o User. Tente Novamente.";
    }

  }
?>

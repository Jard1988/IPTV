<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
		$id = mysqli_real_escape_string($db,$_POST['id']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $linha = mysqli_real_escape_string($db,$_POST['linha']);
		$inicio = mysqli_real_escape_string($db,$_POST['inicio']);
		$fim = mysqli_real_escape_string($db,$_POST['fim']);
    $pago = mysqli_real_escape_string($db,$_POST['pago']);
    $caminho = mysqli_real_escape_string($db,$_POST['caminho']);

    $sql1 = "SELECT *, linhas.linhas_id as l
          FROM users
          INNER JOIN users_linhas
          ON users.users_id = users_linhas.users_id && users.users_id = '".$id."'
          INNER JOIN linhas
          ON users_linhas.linhas_id = linhas.linhas_id WHERE linhas.linhas_id = users.users_id";

    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    if($row1 >=1) {
			 $sql3 = "UPDATE users SET email = '".$email."' WHERE users_id='".$id."';
			 UPDATE users_linhas SET data_ini = '".inicio."', data_fim = '".$fim."' WHERE users_id = '".$id."';
			 ";
       $result3 = mysqli_query($db, $sql3);

      echo "Linha Alterado";
    }else {
        echo "Não foi possivel Alterar a Linha. Tente Novamente.";
    }

  }
?>

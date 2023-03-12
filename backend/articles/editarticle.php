<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($db,$_POST['id']);
		$nome = mysqli_real_escape_string($db,$_POST['nome']);
		$area = mysqli_real_escape_string($db,$_POST['area']);
		$ativo = mysqli_real_escape_string($db,$_POST['ativo']);

    $sql1 = "SELECT * FROM artigos WHERE id = '$id'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($row1 >=1) {
      $sql3 = "UPDATE artigos SET nome = '". $nome . "', area = '". $area . "', ativo = '". $ativo . "'
       WHERE id='". $id."'";
      $result3 = mysqli_query($db, $sql3);
      echo "Artigo Alterado";
    }else {
        echo "Não foi possivel Alterar o Artigo. Tente Novamente.";
    }

  }
?>

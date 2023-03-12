<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = mysqli_real_escape_string($db,$_POST['nome']);
		$area = mysqli_real_escape_string($db,$_POST['area']);
		$ativo = mysqli_real_escape_string($db,$_POST['ativo']);
		
    // If result matched $myusername and $mypassword, table row must be 1 row
      $sql3 = "INSERT INTO `geolocatorlidl`.`artigos` (`nome`,`area`, `ativo`) VALUES ('". $nome ."','". $area ."', '". $ativo . "')";
			$result3 = mysqli_query($db, $sql3);
			if ($result3){
				echo "Artigo Criado. ";
			} else {
				echo "Artigo não Criado. Tente Novamente.... ";
			}
		}
?>

<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($db,$_POST['id']);
    $sql1 = "SELECT * FROM linhas WHERE linhas_id = '$id'";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);


				$sql2 = "SELECT * FROM linhas WHERE linhas_id = '$id'";
		    $result2 = mysqli_query($db,$sql2);

		    // If result matched $myusername and $mypassword, table row must be 1 row
				$destination_folder = $_SERVER['DOCUMENT_ROOT'].'/IPTV/Listas/';

    if($row1 >=1) {
      $sql3 = "DELETE FROM linhas WHERE linhas_id='". $id."'";
			while ($table_lines = mysqli_fetch_assoc($result2)){
				$fname = $destination_folder . $table_lines['nome_linha']. ".m3u"; //set your file ext
				echo $fname;
				if (unlink($fname)) {
					echo ("Ficheiro <b> ". $table_lines['nome_linha'] . " </b> apagado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ".$users_email."<br><br>");
				}
			}
			$sql4 = "DELETE FROM users_linhas WHERE linhas_id='". $id."';";
      $result3 = mysqli_query($db, $sql3);
			$result4 = mysqli_query($db, $sql4);
      echo "Linha(as) Seleccionadas Apagada(as)";
    }else {
        echo "Não foi possivel Apagar as Linha (as) Seleccionadas. Tente Novamente.";
    }

  }
?>

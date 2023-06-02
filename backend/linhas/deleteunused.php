<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql1 = "SELECT * FROM users_linhas";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

		$sql2 = "SELECT * FROM linhas";
    $result2 = mysqli_query($db,$sql2);
		$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);

		// If result matched $myusername and $mypassword, table row must be 1 row
		$destination_folder = "../../" . RAIZ_CAMINHO;

    if($row1 >=1 && $row2 >=1) {
			while ($table_lines = mysqli_fetch_assoc($result1)){
				while ($table_lines2 = mysqli_fetch_assoc($result2)){
					if ($table_lines['linhas_id'] == $table_lines2['linhas_id']){
							echo "Linha Não Apagada";
					}else {

						$fname = $destination_folder . $table_lines2['nome_linha']. ".m3u";
						echo "fname:" . $fname;//set your file ext
						if (unlink($fname)) {
							echo ("Ficheiro <b> ". $table_lines2['nome_linha'] . " </b> apagado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ".$users_email."<br><br>");
							$sql3 = "DELETE FROM linhas WHERE linhas_id='". $table_lines2['linhas_id'] ."';";
							$result3 = mysqli_query($db,$sql3);
							$sql4 = "DELETE FROM users_linhas WHERE linhas_id='". $table_lines2['linhas_id'] ."';";
							$result4 = mysqli_query($db,$sql4);
							if($result3 > 0 && $result4 > 0) {
								echo "Linhas Apagadas";
							}else{
								echo "Linhas Não Apagadas";
							}


					}
				}
			}

		}
    }else {
        echo "Não foi possivel Apagar a Linha. Tente Novamente.";
    }

  }
?>

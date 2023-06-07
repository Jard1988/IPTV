<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql1 = "SELECT * FROM users_linhas RIGHT JOIN linhas ON users_linhas.linhas_id = linhas.linhas_id WHERE users_linhas.linhas_id IS NULL";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

		// If result matched $myusername and $mypassword, table row must be 1 row
		$destination_folder = "../../" . RAIZ_CAMINHO;

    if($row1 >=1) {
			while ($table_lines = mysqli_fetch_assoc($result1)){
						$fname = $destination_folder . $table_lines['nome_linha']. ".m3u";
						echo "fname:" . $fname;//set your file ext
						if (unlink($fname)) {
							echo ("Ficheiro <b> ". $table_lines['nome_linha'] . " </b> apagado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ".$users_email."<br><br>");
							$sql3 = "DELETE FROM linhas WHERE linhas_id='". $table_lines['linhas_id'] ."';";
							$result3 = mysqli_query($db,$sql3);
							$sql4 = "DELETE FROM users_linhas WHERE linhas_id='". $table_lines['linhas_id'] ."';";
							$result4 = mysqli_query($db,$sql4);
							if($result3 > 0 && $result4 > 0) {
								echo "Linhas Apagadas";
							}else{
								echo "Linhas Não Apagadas";
							}
					}
			}
    }else {
        echo "Não existem linhas por Apagar.";
    }

  }
?>

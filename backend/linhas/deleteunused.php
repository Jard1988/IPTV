<?php
	include('../../session.php');

	$linhas_iguais="";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql1 = "SELECT * FROM users_linhas, linhas WHERE users_linhas.linhas_id = linhas.linhas_id GROUP BY linhas.linhas_id";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

		// If result matched $myusername and $mypassword, table row must be 1 row
		$destination_folder = "../../" . RAIZ_CAMINHO;

<<<<<<< HEAD
    if($row1 >=0) {

			while ($table_lines = mysqli_fetch_assoc($result1)){
						$fname = $destination_folder . $table_lines['nome_linha']. ".m3u";
=======
	    if(($row1 >=1)) {
					while ($table_lines = mysqli_fetch_assoc($result1)){
						if ($table_lines['linhas_id']){
								$linhas_iguais.=$table_lines['linhas_id'].";";
						}
			}

    }else {
        echo "Não existem linhas por Apagar.";
    }

		$pieces = explode(";", $linhas_iguais);

		for ($i = 0; $i < count($pieces); $i++) {
				$sql2 = "SELECT * FROM linhas WHERE linhas.linhas_id = ". $pieces[$i] . "<br>";
				echo $sql2;
				$result2 = mysqli_query($db,$sql2);
				$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
				if(($row2 >=1)) {
					while ($table_lines2 = mysqli_fetch_assoc($result2)){
						$fname = $destination_folder . $table_lines2['nome_linha']. ".m3u";
>>>>>>> 2f055640b9f7f9e35f4dbc7f2ef12654b1d85e90
						echo "fname:" . $fname;//set your file ext
						if (unlink($fname)) {
							$sql3 = "DELETE FROM linhas WHERE linhas.linhas_id='". $table_lines2['linhas_id'] ."';";
							echo "Ficheiro <b> ". $table_lines['nome_linha'] . " </b> apagado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ".$users_email."<br><br>";
							echo $sql3;
							$result3 = mysqli_query($db,$sql3);
							$sql4 = "DELETE FROM users_linhas WHERE linhas.linhas_id='". $table_lines2['linhas_id'] ."';";
							$result4 = mysqli_query($db,$sql4);
							echo $sql4;
						echo "Ficheiro Apagado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ".$users_email."<br><br>";
					}
				}
			}
		}
	}
?>

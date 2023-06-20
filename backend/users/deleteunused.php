<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql1 = "SELECT * FROM users_linhas RIGHT JOIN users ON users_linhas.users_id = users.users_id WHERE users_linhas.linhas_id IS NULL";
    $result1 = mysqli_query($db,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

    if($row1 >=1) {
			while ($table_lines = mysqli_fetch_assoc($result1)){

							echo ("Utilizador <b> ". $table_lines['nome'] . " </b> apagado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ".$users_email."<br><br>");
							$sql3 = "DELETE FROM users WHERE users.users_id='". $table_lines['users_id'] ."';";
							echo $sql3;
							$result3 = mysqli_query($db,$sql3);
							$sql4 = "DELETE FROM users_linhas WHERE users.users_id='". $table_lines['users_id'] ."';";
							$result4 = mysqli_query($db,$sql4);
							if($result3 > 0 && $result4 > 0) {
								echo "User's Apagados";
							}else{
								echo "User's Não Apagadas";
							}
					}
			}else {
				echo "AQUI"
			}
    }
?>

<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $linha = mysqli_real_escape_string($db,$_POST['linha']);

		if ($linha == ""){
				echo "<p style='color:red;'>Digite o nome da Linha... </p>";
						} else {

							$sql="SELECT *
				          FROM users
				          INNER JOIN users_linhas
				          ON users.users_id = users_linhas.users_id
				          INNER JOIN linhas
				          ON users_linhas.linhas_id = linhas.linhas_id where linhas.nome_linha='".$linha."'";

							$result_users = mysqli_query($db,$sql);
							$table_geral = mysqli_fetch_assoc($result_users);

						echo '  <table id="myTable" class="table" id="myTable" style="width: 100%;">
						      <thead>
						          <tr>
											<th scope="col"><input type="checkbox" id="select_all">#</th>
                      <th scope="col" onclick="sortTable(1)">Email</th>
                      <th scope="col" onclick="sortTable(2)">Linha</th>
                      <th scope="col" onclick="sortTable(3)">Inicio</th>
                      <th scope="col" onclick="sortTable(4)">Fim</th>
                      <th scope="col" onclick="sortTable(5)">Pago</th>
                      <th scope="col" onclick="sortTable(6)">Caminho</th>
						          </tr>
						      </thead>
						      <tbody>
						  <tr>
							<td scope="row"> <input type="checkbox" class="emp_checkbox" data-emp-id="'. $table_geral['linhas_id'].'"></td>
							<td scope="row" class="email'. $table_geral['linhas_id'].'" value="'. $table_geral['email'].'"> '. $table_geral['email'].' </td>
							<td scope="row" class="linha'. $table_geral['linhas_id'].'" > '. $table_geral['nome_linha'].' </td>
							<td scope="row" class="data_ini'. $table_geral['linhas_id'].'" > '. $table_geral['data_ini'].' </td>
							<td scope="row" class="data_fim'. $table_geral['linhas_id'].'" > '. $table_geral['data_fim'].' </td>';
							if ($table_geral['pago'] == 1) {
								echo '<td scope="row" class="pago'. $table_geral['linhas_id'].'" value="1">Sim</td>';
							}else {
									echo '<td scope="row" class="pago'. $table_geral['linhas_id'].' "value="0">Não</td>';
							}
							echo '<td scope="row" class="caminho'. $table_geral['linhas_id'].'"> '. $table_geral['caminho'].' </td>';
							echo '<td scope="row"></td>';
              echo '<td scope="row"> <button class="editModal btn btn-success" data-id="'. $table_geral['linhas_id'].'" data-toggle="modal" data-target="#editModal">
                 <i class="fa fa-pencil" aria-hidden="true"></i>
               </button></td>
               <td scope="row"> <button class="deleteModal btn btn-danger" data-id="'. $table_geral['linhas_id'].'" data-toggle="modal" data-target="#deleteModal">
                 <i class="fa fa-trash-o" aria-hidden="true"></i>
               </button></td>
               </tr>';

               echo '</tbody>
						</table>';
		}

	}
?>

<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($db,$_POST['id']);

		if ($id == ""){
				echo "<p style='color:red;'>Digite o nome de um Artigo... </p>";
						} else {
			$sql="SELECT *, artigos.id as ind, artigos.nome AS n, area.nome as n1 FROM artigos,area where artigos.area = area.id";
		  $result_users = mysqli_query($db,$sql);
			$res = mysqli_fetch_assoc($result_users );

						echo '  <table id="myTable" class="table" id="myTable" style="width: 80%;">
						      <thead>
						          <tr>
												<th scope="col" onclick="sortTable(0)" >#</th>
						            <th scope="col" onclick="sortTable(2)">Nome</th>
						            <th scope="col" onclick="sortTable(3)">Area</th>
												<th scope="col" onclick="sortTable(4)">Ativo</th>
						          </tr>
						      </thead>
						      <tbody>
									<tr>
		               <td scope="row"> '. $res['ind'].' </td>
		               <td scope="row" class="nome'. $res['ind'].'" > '. $res['n'].' </td>
		               <td scope="row" class="are"> '. $res['n1'].' </td>
		               <td scope="row" class="ativo'. $res['ind'].'" > '. $res['ativo'].' </td>
		               <td scope="row" style="visibility:hidden;" class="area'. $res['ind'].'" > '. $res['area'].' </td>
		               <td scope="row"></td>
		               <td scope="row"> <button class="editModal btn btn-success" data-id="'. $res['ind'].'" data-toggle="modal" data-target="#editModal">
		                 <i class="fa fa-pencil" aria-hidden="true"></i>
		               </button></td>
		               <td scope="row"> <button class="deleteModal btn btn-danger" data-id="'. $res['ind'].'" data-toggle="modal" data-target="#deleteModal">
		                 <i class="fa fa-trash-o" aria-hidden="true"></i>
		               </button></td>
		               </tr>';
		               }
		               echo '</tbody>
		             </table>';
			}
		?>

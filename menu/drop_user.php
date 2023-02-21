<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../session.php');
?>

<!-- EVENTOS -->
<br><br>
<div class="col-md-12 contact-grid wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".3s">
    <h3 class="tittle wow bounceIn"  data-wow-duration=".8s" data-wow-delay=".2s">Utilizadores</h3>
    <?php
		  $sql="SELECT * FROM users";
		  $result_users = mysqli_query($db,$sql);
		?>
    <div class="tabela" id="tabela">
        <table class="table" style="width: 90%;"
        <tbody>
        <?php while ($table_geral = mysqli_fetch_assoc($result_users)){  ?>
        <tr>
            <td scope="row"> <?php echo $table_geral['users_id']; ?> </td>
            <td scope="row"> <?php echo $table_geral['email']; ?> </td>
            <td scope="row"> <?php echo $table_geral['nome']; ?> </td>
            <td scope="row"> <?php echo $table_geral['apelido']; ?> </td>
            <td scope="row"> <?php echo $table_geral['data_nascimento']; ?> </td>
            <td scope="row"> <?php echo $table_geral['apd']; ?> </td>
            <td scope="row"> <?php echo $table_geral['facebook']; ?> </td>
            <td scope="row"> <?php echo $table_geral['instagram']; ?> </td>
            <td scope="row"> <?php echo $table_geral['permission_id']; ?> </td>
            <td scope="row"> Editar </td>
            <td scope="row"> Apagar </td>


        </tr>
        <?php
        }
        ?>

        </tbody>
        </table>
    </div>
</div>
<!-- END EVENTOS -->

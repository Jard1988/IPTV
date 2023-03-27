<?php
	include('../../session.php');
	require_once('../../mailer/PHPMailer.php');
	require_once('../../mailer/SMTP.php');
	require_once('../../mailer/Exception.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);

	function gerar_linha($tamanho, $maiusculas, $minusculas, $numeros){
	    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
	    $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
	    $nu = "0123456789"; // $nu contem os números

	    $senha="";
	    if ($maiusculas){
	        // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
	        $senha .= str_shuffle($ma);
	    }

	    if ($minusculas){
	        // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
	        $senha .= str_shuffle($mi);
	    }

	    if ($numeros){
	        // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
	        $senha .= str_shuffle($nu);
	    }

	    // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
	    return substr(str_shuffle($senha),0,$tamanho);
	}

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $pago = mysqli_real_escape_string($db,$_POST['pago']);
		$data_ini = mysqli_real_escape_string($db,$_POST['data_ini']);
		$data_fim = mysqli_real_escape_string($db,$_POST['data_fim']);
		$novalinha = gerar_linha(10, true, true, true);
    // If result matched $myusername and $mypassword, table row must be 1 row
		$caminho = $caminho_git . $novalinha . ".m3u";
		echo "<b><font color='#FF0000'>  $caminho </font></b><br><br>";
      $sql3 = "INSERT INTO `linhas` (`nome_linha`,`pago`, `caminho`) VALUES ('". $novalinha ."','". $pago ."','". $caminho . "')";
			$result3 = mysqli_query($db, $sql3);

			$sql = "SELECT users_id from users where email='". $email ."'";
			$result_users = mysqli_query($db,$sql);
			$table_users = mysqli_fetch_assoc($result_users);

			$sql6 = "SELECT linhas_id from linhas where nome_linha='". $novalinha ."'";
			$result_lines = mysqli_query($db,$sql6);
			$table_lines = mysqli_fetch_assoc($result_lines);

			$sql4 = "INSERT INTO `iptvplanner`.`users_linhas` (`users_id`, `linhas_id`, `data_ini`, `data_fim`) VALUES ('".$table_users['users_id']."', '".$table_lines['linhas_id']."', '".date("Y/m/d")."', '');";
			$result4 = mysqli_query($db, $sql4);

			if ($result3 && $result4 && $result_users && $result_lines){
				try {
						//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // apresenta o DEBUG
						$mail->isSMTP();

						$mail->Host = 'smtp.gmail.com';
						$mail->SMTPAuth = true;

						$mail->Username = MAIL_USERNAME;
						$mail->Password = MAIL_PASSWORD;
						$mail->Port = MAIL_PORT;

						$mail->setFrom(MAIL_USERNAME,MAIL_NAME); //nosso email from
						$mail->addAddress($email); // emails to

						$mail->isHTML(true);
						$mail->Subject = 'Linha';
						$mail->Body = 'Registo com Sucesso <strong>IPTV Planner</strong><br>
												<br><br>

												Obrigado pelo sua Compra na IPTV Planner!<br><br>

												Segue a ligação m3u da sua linha:
												'.$caminho.' <br><br>

												Se tiver urgência ou existir algum problema não exite em entrar em contacto por email ou por favor ligar para 22X XXX XXX ou 9XX XXX XXX.<br><br>
												NOTA: Não responda a este email, trata-se de uma mensagem automática de confirmação de receção do seu pedido.<br>
												Cordiais cumprimentos,<br><br>

												Geo Locator | Lidl<br><br>

												Está a receber esta mensagem porque entrou em contacto connosco através do formulário de contacto do nosso site http://www.bolanarede.website.
<br>
												Declaração de consentimento sobre campanhas:
<br>
												PROTEÇÃO DE DADOS PESSOAIS: A segurança e a privacidade de seus dados pessoais são importantes para nós. A Bola na Rede está em conformidade com o Regulamento Geral de Proteção de Dados em vigor na UE. Quando nos cede os seus dados pessoais, nós só os utilizaremos para o propósito para o qual foram fornecidos. Pode retirar o seu consentimento a qualquer momento. Por favor, veja nossa Política de Privacidade.';

						//$mail->setFrom('system@cksoftwares.com', 'CKSoftwares System'); // From email and name
						//$mail->addAddress('to@address.com', 'Mr. Brown'); // to email and name
						//$mail->Subject = 'PHPMailer GMail SMTP test';
						//$mail->msgHTML("test body"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
						//$mail->AltBody = ''; // If html emails is not supported by the receiver, show this body
						// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
							echo "User Criado. ";
							if ($mail->send()) {
								echo "Email Enviado ao Utilizador. ";
							} else {
									echo "Email não enviado ao Utilizador. ";
							}
					} catch (Exception $e) {
							echo "Ocorreu um erro ao enviar o Email. Enviar Manualmente.";
					}

			} else{
				 echo "Utilizador não Criado. Tente Novamente.";
			 }
		}
?>

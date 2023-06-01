<?php
	include('../../session.php');
	require_once('../../mailer/PHPMailer.php');
	require_once('../../mailer/SMTP.php');
	require_once('../../mailer/Exception.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);

	function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
	    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
	    $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
	    $nu = "0123456789"; // $nu contem os números
	    $si = "!@#$%¨&*()_+="; // $si contem os símbolos

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

	    if ($simbolos){
	        // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
	        $senha .= str_shuffle($si);
	    }

	    // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
	    return substr(str_shuffle($senha),0,$tamanho);
	}

	function createAvatarImage($string)
{
    $imageFilePath = "../../images/".$string . ".png";

    //base avatar image that we use to center our text string on top of it.
    $avatar = imagecreatetruecolor(60,60);
    $bg_color = imagecolorallocate($avatar, 211, 211, 211);
    imagefill($avatar,0,0,$bg_color);
    $avatar_text_color = imagecolorallocate($avatar, 0, 0, 0);
	// Load the gd font and write
    $font = imageloadfont('../../gd-files/gd-font.gdf');
    imagestring($avatar, $font, 10, 10, $string, $avatar_text_color);
    imagepng($avatar, $imageFilePath);
    imagedestroy($avatar);
    return "images/".$string.".png";
}

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $nome = mysqli_real_escape_string($db,$_POST['nome']);
		$apelido = mysqli_real_escape_string($db,$_POST['apelido']);
		$telefone = mysqli_real_escape_string($db,$_POST['telefone']);
    $nascimento = mysqli_real_escape_string($db,$_POST['nascimento']);
    $permission = mysqli_real_escape_string($db,$_POST['permission']);
		$novasenha = gerar_senha(10, true, true, true, true);
		$target_path = createAvatarImage($email);
    // If result matched $myusername and $mypassword, table row must be 1 row

		$sql = "select * from users where email='". $email."'";

					$result = mysqli_query($db, $sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
					if ($row >=1) {
						echo "Já Existe esse Utilizador";
					} else {

				try {
						//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // apresenta o DEBUG
						$mail->isSMTP();

						$mail->Host = MAIL_HOST;
						$mail->SMTPAuth = true;

						$mail->Username = MAIL_USERNAME;
						$mail->Password = MAIL_PASSWORD;
						$mail->Port = MAIL_PORT;

						$mail->setFrom(MAIL_USERNAME,MAIL_NAME); //nosso email from
						$mail->addAddress($email); // emails to

						$mail->isHTML(true);
						$mail->Subject = utf8_decode('Registo na IPTV Planner');
						$mail->Body = utf8_decode('Registo com Sucesso <strong>IPTV Planner</strong><br>
												<br><br>

												Obrigado pelo seu contributo na IPTV Planner!<br><br>

	 											Os dados gerados para acesso são:  <br><br>
												Utilizador: ' .  $email . '<br>
												Password: ' . $novasenha . '<br>
												Estado: <b>Falta confirmação</b><br><br>

												Confirme o seu registo através do link:<br>
												' . CAMINHO_URL .'confirm.php?email='.$email.' <br><br>

												Após a confirmação irá receber um email já pode inicia e já pode inciar sessão no site e usufruir dos nossos serviços!<br>
												Pode e deve alterar os seus dados no menu <b>Editar Perfil</b>.<br><br>

												Se tiver urgência ou existir algum problema não exite em entrar em contacto por email ou por favor ligar para 22X XXX XXX ou 9XX XXX XXX.<br><br>
												NOTA: Não responda a este email, trata-se de uma mensagem automática de confirmação de receção do seu pedido.<br>
												Cordiais cumprimentos,<br><br>

												IPTV Planner @ 2023<br><br>

												Está a receber esta mensagem porque entrou em contacto connosco através do formulário de contacto do nosso site http://www.iptvplanner.pt.
<br>
												Declaração de consentimento sobre campanhas:
<br>
												PROTEÇÃO DE DADOS PESSOAIS: A segurança e a privacidade de seus dados pessoais são importantes para nós. A IPTV Planner está em conformidade com o Regulamento Geral de Proteção de Dados em vigor na UE. Quando nos cede os seus dados pessoais, nós só os utilizaremos para o propósito para o qual foram fornecidos. Pode retirar o seu consentimento a qualquer momento. Por favor, veja nossa Política de Privacidade.'
											);

							if ($mail->send()) {
								$sql3 = "INSERT INTO `users` (`email`,`password`, `nome`, `apelido`,`telefone`, `data_nascimento`, `permission_id`,`avatar_path`) VALUES ('". $email ."','". sha1($novasenha) ."', '". $nome . "', '". $apelido . "', '". $telefone . "','". $nascimento . "','". $permission . "','". $target_path . "')";
											$result3 = mysqli_query($db, $sql3);
											if ($result3){
												echo "Email Enviado ao Utilizador.";
										} else {
				 								echo "Utilizador não Criado. Tente Novamente.";
										}

							} else {
									echo "Email não enviado ao Utilizador. ";
							}
					} catch (Exception $e) {
							echo "Ocorreu um erro ao enviar o Email. Enviar Manualmente.";
					}
			 }
		 }

?>

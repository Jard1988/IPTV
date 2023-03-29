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
    return $imageFilePath;
}

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $nome = mysqli_real_escape_string($db,$_POST['nome']);
		$apelido = mysqli_real_escape_string($db,$_POST['apelido']);
		$telefone = mysqli_real_escape_string($db,$_POST['telefone']);
    $nascimento = mysqli_real_escape_string($db,$_POST['nascimento']);
    $permission = mysqli_real_escape_string($db,$_POST['permission']);
		$novasenha = gerar_senha(10, true, true, true, true);
		$target_path = createAvatarImage($nome);
    // If result matched $myusername and $mypassword, table row must be 1 row

      $sql3 = "INSERT INTO `users` (`email`,`password`, `nome`, `apelido`,`telefone`, `data_nascimento`, `permission_id`,`avatar_path`) VALUES ('". $email ."','". $novasenha ."', '". $nome . "', '". $apelido . "', '". $telefone . "','". $nascimento . "','". $permission . "','". $target_path . "')";

			$result3 = mysqli_query($db, $sql3);
			if ($result3){
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
						$mail->Subject = 'Registo na Geo Locator';
						$mail->Body = 'Registo com Sucesso <strong>Geo Locator</strong><br>
												<br><br>

												Obrigado pelo seu Registo na Geo Locator!<br><br>

												Confirme o seu registo através do link:<br>
												http://localhost/geolocator/confirm.php?email='.$email.' <br><br>

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

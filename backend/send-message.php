<?php
include('../session.php');

require(__DIR__.'/../Twilio/autoload.php');

use Twilio\Rest\Client;

$sid = TWILIO_ACCOUNT_SID;
$token = TWILIO_AUTH_TOKEN;

$client = new Client($sid, $token);

// This must be a Twilio phone number that you own, formatted with a '+' and country code
$twilioPurchasedNumber = TWILIO_AUTH_PHONE;

    //====================================================
    $email = $_REQUEST['email'];
    $mensagem = $_REQUEST['texto'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    $phoneNumber = $row['telefone'];

    if ($count == 1) {
        try {
          // Send a text message
          $message = $client->messages->create(
              $phoneNumber,
              [
                  'from' => $twilioPurchasedNumber,
                  'body' => $mensagem
              ]
          );
          echo "SMS Enviada com Sucesso<br><b>Email:</b> " . $email ."<br><b>Telefone:</b> .".$phoneNumber."\n\n";

          // Print the last 10 messages
          //$messageList = $client->messages->read([],10);
          //foreach ($messageList as $msg) {
          //    print("ID:: ". $msg->sid . " | " . "From:: " . $msg->from . " | " . "TO:: " . $msg->to . " | "  .  " Status:: " . $msg->status . " | " . " Body:: ". $msg->body ."\n");
          //}
          $sms_send = true;
        } catch (Exception $e) {
            echo "SMS não Enviada. Tente Novamente.";
        }
    }else {
        echo "Ocorreu um erro. Tente Novamente.";
    }


exit;
?>

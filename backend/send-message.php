<?php
include('../session.php');

require(__DIR__.'/../Twilio/autoload.php');

use Twilio\Rest\Client;

$sid = "ACef846a8f5f3a07ae3246486fef91e8bf";
$token = "fdcc8bf559de8bf302377c795a9222f9";
$client = new Client($sid, $token);

// Specify the phone numbers in [E.164 format](https://www.twilio.com/docs/glossary/what-e164) (e.g., +16175551212)
// This parameter determines the destination phone number for your SMS message. Format this number with a '+' and a country code
$phoneNumber = "+351917737010";

// This must be a Twilio phone number that you own, formatted with a '+' and country code
$twilioPurchasedNumber = "+14345973989";

    //====================================================
    $email = $_REQUEST['email'];
    $mensagem = $_REQUEST['texto'];

    $sql = "SELECT users_id FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        try {
          // Send a text message
          $message = $client->messages->create(
              $phoneNumber,
              [
                  'from' => $twilioPurchasedNumber,
                  'body' => "Hey Jenny! Good luck on the bar exam!"
              ]
          );
          print("Message sent successfully with sid = " . $message->sid ."\n\n");

          // Print the last 10 messages
          $messageList = $client->messages->read([],10);
          foreach ($messageList as $msg) {
              print("ID:: ". $msg->sid . " | " . "From:: " . $msg->from . " | " . "TO:: " . $msg->to . " | "  .  " Status:: " . $msg->status . " | " . " Body:: ". $msg->body ."\n");
          }
          $sms_send = true;
            if ($sms_send == true) {
                echo "SMS Enviado.";
            } else {
                echo "SMS não enviado.";
            }
        } catch (Exception $e) {
            echo "Ocorreu um erro. Tente Novamente.";
        }
    }else {
        echo "Ocorreu um erro. Tente Novamente.";
    }


exit;
?>

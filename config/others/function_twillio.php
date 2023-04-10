<?php
require './config/plugins/twillio/vendor/autoload.php';
use Twilio\Rest\Client;
function sendTwillio($Tel,$Body,$Whatsapp=false){
  $Whatsapp=($Whatsapp)?"Whatsapp:":"";
  $From = WHATSAPP_PHONE;
  $Twilio = new Client(WHATSAPP_API, WHATSAPP_KEY, WHATSAPP_SID);

  $message = $Twilio->messages->create("$Whatsapp$Tel",
           [
               "from" => "$Whatsapp$From",
               "body" => $Body
           ]
  );

}
 ?>

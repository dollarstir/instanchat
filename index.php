<?php
require 'vendor/autoload.php';

use Twilio\Rest\Client;
function sendmessage(){
    
    require 'config.php';

    
    // Find your Account SID and Auth Token at twilio.com/console
    // and set the environment variables. See http://twil.io/secure
    $sid = "AC283146a35a1eb01abbc41967c54864bd";
    $token = "8836f8c16aafbd4c3ac2d18f7190ad6c";
    $twilio = new  Client($sid, $token);
    
    $message = $twilio->messages
    ->create("+16032640191", // to

    
    [
        "body" => "Working With mms",
        "from" => "+18447261728",
        "mediaUrl" => ["https://bydayjobafrica.com/storage/auth/login/IGiCLROPbiZVXK1xtVHPpzcIxRcVYlJm7Sxtm9P7.jpg"]
        ]
    );
    
    print($message->sid);

    $sql = "INSERT INTO `messages`(`msg_body`, `msg_from`, `msg_to`, `date_created`) VALUES ('Working With mms','+18447261728','+233556676471','".date('Y-m-d H:i:s')."')";
    $query = mysqli_query($conn, $sql);
    if($query){
        echo "Message Sent";
    }else{
        echo "Message Not Sent";
    }
    
    
}

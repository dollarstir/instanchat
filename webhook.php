<?php
require 'config.php';
require 'vendor/autoload.php';

use Twilio\TwiML\MessagingResponse;

function receivsms(){
    require 'config.php';
    $response = new MessagingResponse();
    // $message = $response->message('The Robots are coming! Head for the hills!');
    // $message->body('Hello World!');
    // $message->media('https://demo.twilio.com/owl.png');
    $body = $_REQUEST['Body'];
    $from = $_REQUEST['From'];
    $to = $_REQUEST['To'];
    $date_created = date('Y-m-d H:i:s');

    $sql = "INSERT INTO `messages`(`msg_body`, `msg_from`, `msg_to`, `date_created`) VALUES ('$body','$from','$to','$date_created')";
    $query = mysqli_query($conn, $sql);
    if($query){
        $response->message('Message Received');
    }else{
        $response->message('Message Not Received');
    }


    
    // echo $message;



}

<?php

    
    require 'config.php';
    require 'vendor/autoload.php';


    use Twilio\Rest\Client;


if(isset($_GET['action'])){

    if($_GET['action'] == 'load'){
        $msg_from = "+18447261728";
        $msg_to = "+12349782415";

        $sql = "SELECT * FROM `messages` WHERE ( msg_from = $msg_from  AND msg_to = $msg_to)  OR (( msg_from =$msg_to   AND msg_to =$msg_from)) ORDER BY `date_created` ASC";
        $query = mysqli_query($conn, $sql);
        $data = '';
        while($row = mysqli_fetch_assoc($query)){
            
            if($row['msg_from'] == $msg_from){
                $data .= '<li class="clearfix">
                <div class="message-data text-right">
                    <span class="message-data-time">'.date('h:i A',strtotime($row['date_created'])).'</span>
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                </div>
                <div class="message other-message float-right">'.$row['msg_body'].'</div>
            </li>';
            }else{
                $data .= '<li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time">' . date('h:i A', strtotime($row['date_created'])) . '</span>
                            </div>
                            <div class="message my-message">' . $row['msg_body'] . '</div>
                        </li>';
            }

        }
        echo ($data);
    }



        if($_GET['action'] == 'sendmsg') {

            


            $data = extract($_POST);

                    $sid = "AC283146a35a1eb01abbc41967c54864bd";
            $token = "43c3ef0fd1fea7687e704b0718323ecf";
            $twilio = new Client($sid, $token);
            
            $message = $twilio->messages
            ->create($msg_from, // to


            [
                "body" => $msg_body,
                "from" => $msg_to,
                // "mediaUrl" => ["https://bydayjobafrica.com/storage/auth/login/IGiCLROPbiZVXK1xtVHPpzcIxRcVYlJm7Sxtm9P7.jpg"]
                ]
            );
            
            // print($message->sid);

            $sql = "INSERT INTO `messages`(`msg_body`, `msg_from`, `msg_to`, `date_created`, `msg_params`) VALUES ('$msg_body','$msg_to','$msg_from','" . date('Y-m-d H:i:s') . "','".json_encode($message)."')";
            $query = mysqli_query($conn, $sql);
            if($query) {
                echo json_encode(array('status' => 'success','msg' => 'Message Sent'));
            } else {
                echo json_encode(array('status' => 'error','msg' => 'Message Not Sent'));


            }
        }
}









    
//     // Find your Account SID and Auth Token at twilio.com/console
//     // and set the environment variables. See http://twil.io/secure
//     $sid = "AC283146a35a1eb01abbc41967c54864bd";
//     $token = "43c3ef0fd1fea7687e704b0718323ecf";
//     $twilio = new Client($sid, $token);
    
//     $message = $twilio->messages
//     ->create("+12349782415", // to


//     [
//         "body" => "Working With mms",
//         "from" => "+18447261728",
//         "mediaUrl" => ["https://bydayjobafrica.com/storage/auth/login/IGiCLROPbiZVXK1xtVHPpzcIxRcVYlJm7Sxtm9P7.jpg"]
//         ]
//     );
    
//     print($message->sid);

//     $sql = "INSERT INTO `messages`(`msg_body`, `msg_from`, `msg_to`, `date_created`) VALUES ('Working With mms','+18447261728','+233556676471','".date('Y-m-d H:i:s')."')";
//     $query = mysqli_query($conn, $sql);
//     if($query){
//         echo json_encode(array('status'=>'success','msg'=>'Message Sent','data'=>'<li class="clearfix">
//         <div class="message-data text-right">
//             <span class="message-data-time">10:10 AM, Today</span>
//             <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
//         </div>
//         <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
//     </li>
//     <li class="clearfix">
//         <div class="message-data">
//             <span class="message-data-time">10:12 AM, Today</span>
//         </div>
//         <div class="message my-message">Are we meeting today?</div>                                    
//     </li>                               
//     <li class="clearfix">
//         <div class="message-data">
//             <span class="message-data-time">10:15 AM, Today</span>
//         </div>
//         <div class="message my-message">Project has been already finished and I have results to show you.</div>
//     </li>'));
//     }else{
//         echo "Message Not Sent";
//     }
    
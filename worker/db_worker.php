<?php
    while(true) {
    require_once "./db_config.php";
    //     $conn = $connection;
    //     $number_1 = rand(1,50);
    //     $number_2 = rand(60,500);
        
    //     $insertQuery = "INSERT INTO random_numbers (num_1, num_2) VALUES ('".$number_1."', '".$number_2."')";
    //     $result = mysqli_query($GLOBALS['conn'], $insertQuery);
    //     if($result) {
    //         echo 'Details saved';
            
    //     } else {
    //         echo 'Failed to save details';
    //     }
$comic_url = "";
$json_data = "";
$message = "";
function getUrls()
{
$response = file_get_contents("https://c.xkcd.com/random/comic/");
$regex = '/https?\:\/\/[^\" ]+/i';
preg_match_all($regex, $response, $matches);
return ($matches[0]);
} 
$urls = getUrls();
foreach($urls as $data) {
    $string_search = "https://xkcd.com/";
    if(strpos($data, $string_search)>=0) {
        $comic_url = $data."/info.0.json";
        $json = file_get_contents($comic_url);
        $json_data = json_decode($json, true);
        send_inline_image($json_data);
        return false;
    }
} 
/**
 * @param $image_url {url contains the image name in the path}
 * To ge the image name from the URL
 */
// function getImageName($image_url) {
//     return explode("/",parse_url($image_url)['path'])[2];
// }


/**
 * @param $details {URL or file path which need to be converted as string response}
 * To convert given URL or file as string 
 */

// function getContents($details) {
//     //$image_data = file_get_contents($json_data['img']);
//         //$image_name =explode("/",parse_url($json_data['img'])['path'])[2];
//         // sendImage($image_data,$image_name, $json_data['img']);
//     return file_get_contents($details);
// }

/**
 * @param $body_details {JSON  array contains the mail body details}
 * To send an email using PHP mail function
 */

    sleep(60);
}



function send_inline_image($body_details) {
    $bound_text = "----*%$!$%*";
    $bound = "--".$bound_text."\r\n";
    $bound_last = "--".$bound_text."--\r\n";
    $headers = "From: rtcamp.comics@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n" .
    "Content-Type: multipart/mixed; boundary=\"$bound_text\""."\r\n" ;
    $message = " Comic of the day: ".$body_details['title']."\r\n".
    $bound;
    
    $message .=
    'Content-Type: text/html; charset=UTF-8'."\r\n".
    'Content-Transfer-Encoding: 7bit'."\r\n\r\n".
    '<html>
        <head>
            <style> p {color:green};
            img {
    
            }
                .heading {
                    text-align: left;
                    color: #ff9800;
                }
                .day_count {
                    text-align: left;
                }
            </style>
        </head>
        <body>
            
            <h3 class="heading">'.$body_details['title'].'</h3>
            <p class="day_count"><b><i> Day '.$body_details['day'].':'.$body_details['alt'].'</i></b></p>
            <br>
                <img src="'.$body_details['img'].'">
            <br>
            <p>To unsubscribe to the comics <a href="localhost/projects/rtcamp/unsub.php?key=durgabhavani9360@gmail.com">Click here</a></p>
            <br>
                
        </body>
    </html>'."\n\n".
    $bound;
    $to =  "durgabhavani9360@email.com";
    $subject = 'Comic of the day';
    $mail_resp = mail($to, $subject, $message, $headers);
     if($mail_resp) {
         echo 'Mail sent successfully';
     } else {
          echo 'Error occured while sending email '.$mail_resp;
     }
 }
?>
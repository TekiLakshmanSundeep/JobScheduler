<?php
 
 while(true) {
require_once "./send_email.php";
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

         $message =
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
                 
                 <h3 class="heading">'.$json_data['title'].'</h3>
                 <p class="day_count"><b><i> Day '.$json_data['day'].':'.$json_data['alt'].'</i></b></p>
                 <br>
                     <img src="'.$json_data['img'].'">
                 <br>
                 <p>To unsubscribe to the comics <a href="localhost/projects/rtcamp/unsub.php?key=durgabhavani9360@gmail.com">Click here</a></p>
                 <br>
                     
             </body>
         </html>'."\n\n";
         $attachment_details = array($json_data['img'], $json_data['title']);
         SendEmail::SendMail("funnysunny.teki@gmail.com","rtCamp Comics", $attachment_details);
         return false;
     }
 }
 sleep(60);
} 

function send_inline_image($body_details, $attachment_url) {
$message =
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
</html>'."\n\n";
$attachment_details = array($body_details['img'], $body_details['title']);

SendEmail::SendMail("funnysunny.teki@gmail.com","rtCamp Comics", $attachment_details);
}

?>
<?php
     require "./worker/db_worker.php";
//     require_once ('/app/vendor/autoload.php');
    require 'vendor/autoload.php';
     
     class SendEmail{
     public static function SendMail($to,$subject,$content, $attachment_content){
        $key = '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';
        //  $email =  new \SendGrid\Mail\Mail();
        //  $email->setFrom("sundeepteki12@gmail.com","rtcamp");
        //  $email->setSubject($subject);
        //  $email->addTo($to);
        //  $email->addContent("text/html",$content);
        //  $sendgrid = new \SendGrid(getenv($key));
         
        // // Attachment code
        //  $content = file_get_contents($attachment_content[0]);
        //  $attachment = new \SendGrid\Mail\Attachment();
        //  $attachment->setType("multipart/mixed");
        //  $attachment->setFilename($attachment_content[1].".png");
        //  $attachment->setContentId($attachment_content[1]);
        //  $attachment->setDisposition("attachment");
        //  $attachment->setContent($content);
        // $email->addAttachment($attachment);
        //  try{
        //      $response = $sendgrid->send($email);
        //     echo "Mail sent successfully"; 
        //  }catch(Exception $e){
        //      echo 'Email exception Caught : '. $e->getMessage() ."\n";
        //      return false;
        //   }
    
$sendgrid = new SendGrid($key);
$email    = new \SendGrid\Mail\Mail();

$email->addTo($to)
      ->setFrom("sundeepteki12@gmail.com")
      ->setSubject("Sending with SendGrid is Fun")
      ->setHtml("and easy to do anywhere, even with PHP");

$sendgrid->send($email);
      }
 }

?>
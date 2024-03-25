<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

class MailSender{
    public static function sendMail($emails, $subject, $body, $attachments = []) {
        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            // Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Host       = 'smtp.gmail.com';                        // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
            $mail->Username   = 'insitefulcontact@gmail.com';            // SMTP username
            $mail->Password   = 'lpgxakcemjcnrqjf';                      // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Enable implicit TLS encryption
            $mail->Port       = 465;                                     // TCP port to connect to
    
            // Set sender
            $mail->setFrom('insitefulcontact@gmail.com', 'INSITEFUL');
            
            // Add recipients
            foreach ($emails as $email) {
                $mail->addAddress($email);
            }
    
            // Add attachments
            foreach ($attachments as $attachment) {
                if (is_array($attachment)) {
                    $mail->addAttachment($attachment['path'], $attachment['name']);  
                } else {
                    $mail->addAttachment($attachment);
                }
            }
    
            // Content
            $mail->isHTML(true);                                         // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
    
            // Send email
            $mail->send();
        } catch (Exception $e) {}   
    }
}
?>
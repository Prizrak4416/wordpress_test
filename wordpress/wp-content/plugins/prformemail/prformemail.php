<?php
/*
Plugin Name: prforemail
Plugin URI: http://127.0.0.1
Description: for send e-mail
Version: 1.0
Author: Prizrak
Author URI: github.com/prizrak4416
Licence: GPLv2 or leter
Text Domain: prforemail
*/

require_once ABSPATH . 'wp-admin/includes/file.php';
$path_mailer = get_home_path() . 'PHPMailer';
define("PATH_LOG", get_home_path() . 'wp-content/themes/send_email/log/log.txt');
$path_log = get_home_path() . 'wp-content/themes/send_email/log/log.txt';
require_once $path_mailer .'/Exception.php';
require_once $path_mailer .'/PHPMailer.php';
require_once $path_mailer .'/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


function log_email_sent($to, $subject, $message) {
    $log = "Time: " . date("Y-m-d H:i:s") . "\n";
    $log .= "To: $to\n";
    $log .= "Subject: $subject\n";
    $log .= "Message: $message\n";
    $log .= "-------------------------\n";
    echo '<h1>' . PATH_LOG . '</h1>';
    file_put_contents(PATH_LOG, $log, FILE_APPEND);
}

function send_custom_email($to, $subject, $message) {

    $mail = new PHPMailer(true);
    echo '<h1> перед отправкой</h1>';
    try {
        $mail->isSMTP();
        
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; ;
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'prizrak4416@gmail.com'; 
        // $mail->Password   = 'kfUPzeyKyMBLWNetkhD4'; 
        $mail->Password   = 'pvzq ntqf vaxu qmke'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;    
        echo '<h1> настройки</h1>';

        $mail->setFrom('prizrak4416@gmail.com', 'Mailer');
        $mail->addAddress($to, 'John Doe'); 
    

        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = $message;
        // var_dump($mail);
    
        // $mail->send();
        echo 'Сообщение если письмо было отправлено';
        log_email_sent($to, $subject, $message);

    } catch (Exception $e) {
        echo "Сообщение не было отправлено. Ошибка PHPMailer: {$mail->ErrorInfo}";
    }
}

function process_my_form() {
    $path_mailer = get_home_path() . 'PHPMailer';

    echo '<h1>' . $path_mailer . '</h1>';
    if ( isset($_POST['cf-submitted']) ) {
        $first_name = sanitize_text_field($_POST["cf-first-name"]);
        $last_name = sanitize_text_field($_POST["cf-last-name"]);
        $email = sanitize_email($_POST["cf-email"]);
        $subject = sanitize_text_field($_POST["cf-subject"]);
        $message = esc_textarea($_POST["cf-message"]);
    
        //  wp_mail() для отправки этих данных.
    
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Электронная почта '$email' валидна.";
        } else {
            echo "Электронная почта '$email' невалидна.";
        }
        echo '<h1>' . $email . '</h1>';
        echo '<h1>' . $subject . '</h1>';
        echo '<h1>' . $message . '</h1>';
        send_custom_email($email, $subject, $message);
    
    }
}

add_action('init', 'process_my_form');
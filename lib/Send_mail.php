<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// require_once __DIR__ . '/../vendor/autoload.php';

class Send_mail {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        // configuration de base
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'ralphloicnobel@gmail.com';
        $this->mail->Password = 'jdgu wgkb zcvc nyyk';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 465;
        $this->mail->setFrom('ralphloicnobel@gmail.com', 'Link-Shield');
    }

    public function Sendmail($to, $subject, $body) {
        try {
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
}

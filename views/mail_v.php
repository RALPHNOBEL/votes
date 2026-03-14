 <?php 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Mail
{ 
    private $mailclass;
    public function __construct($email){
      $mail = new PHPMailer(true);
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      //Enable verbose debug output
      $mail->isSMTP();
      //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';
      //Set the SMTP server to send through
      $mail->SMTPAuth   = true;
      //Enable SMTP authentication
      $mail->Username   = 'angemoche0@gmail.com';
      //SMTP username
      $mail->Password   = 'vxhz dcdk ksbs dvkm';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      //Enable implicit TLS encryption
      $mail->Port       = 465;
      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('angemoche0@gmail.com', 'DevAnge');
      $mail->addAddress($email, '');     //Add a recipient

      $mail->addReplyTo('angemoche0@gmail.com', 'DevAnge');

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = "sujet";
      $mail->msgHTML("message",__DIR__);
      $this->mailclass = $mail;
    }

    public function send(){
      return $this->mailclass->send();
    }
}
      
 
if(isset($_POST['send'])){
  if(!empty($_POST['email'])) {
    // $pieces = NULL;
    // if(isset($_FILES['piece'])){
    //   $piece = __DIR__.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$_FILES['piece']['name'];
    // }
    $email = new Mail($_POST['email']);
    $resp = $email->send();
    $class = $resp ? 'succes' : 'danger';
    $info = $resp ? 'mail envoyé' : 'mail non envoyé, verifier votre configuration';
  }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div class="container">
    <form action="" class="form" method="POST" enctype= "multipart/form-data">
          <div class="about">
            <h2>envoyer un email avec php</h2>
            <p>remplisser les champs ci_dessous pour envoyer un email</p>
          </div>
          <div>
            <label for="email">adresse email</label>
            <input type="email" name="email" id="">
          </div><br><br>
        <?php if(isset($info)): ?>
        <p class="alert <?= $class; ?>">
            <?= $info; ?>
        </p>
        <?php endif; ?>

          <button type="submit" name="send">envoyer</button>
    </form>
</body>
</html>
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mail
{
    private $mailclass;
    public function __construct($email, $sujet, $message)
    {
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ralphloicnobel@gmail.com';
        $mail->Password = 'jdgu wgkb zcvc nyyk'; // mot de passe d’application Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
        $mail->Port = 587; // Port recommandé pour TLS
        $mail->setFrom('ralphloicnobel@gmail.com', 'GesVotes');
        $mail->addAddress($email);
        $mail->addReplyTo('ralphloicnobel@gmail.com'); // adresse de réponse correcte
        $mail->isHTML(true);
        $mail->Subject = $sujet;
        $mail->Body = $message; // utilisation directe du corps HTML
        $this->mailclass = $mail;
    }

    public function send()
    {
        try {
            return $this->mailclass->send();
        } catch (Exception $e) {
            echo "Erreur : {$this->mailclass->ErrorInfo}";
        }
    }
}

if (isset($_POST['submitBtn'])) {
    $email = $_POST['email'];
    $code = random_int(100000, 999999);
    // requete pour enregistrer le code dans la base de données
    $verificationMail = Etudiante::verifyEmail($email);
    if ($verificationMail) {
        $mail = new Mail($email, "Votre code", "<h1>$code</h1>");
        $succes = $mail->send();
        if ($succes) {
            $ajouteCode = Etudiante::savecode($verificationMail['id_e'], $code);
            $_SESSION['email'] = $email; //
            header("Location: " . PATH . "verifiercode");
        }
    } else {
        $_SESSION['type'] = "error";
        $_SESSION['message'] = "Vous n'êtes pas étudiante. Désolé";
        header("Location: " . PATH . "email");
    }
}

// $data = json_decode(file_get_contents('php://input'), true);
// if(isset($data['email'])){

// include_once '../_classes/Etudiante.php';
// $db = include '../_config/db.php';
// include '../lib/send_mail.php';

// session_start();

// $etudiantModel = new Etudiante($db);

// // Récupération des données JSON envoyées


// if (!isset($data['email']) || empty($data['email'])) {
//     echo json_encode(['success' => false, 'message' => 'Email requis']);
//     exit;
// }

// $email = $data['email'];

// // Récupérer l'utilisateur par email
// $user = $etudiantModel->etudian($email); 
// if ($user) {
//     $userId = $user['id_e'] ?? $user['id_e']; 
//     // Générer un code
//     $code = random_int(100000, 999999);

//     $_SESSION['code'] = $code;
//     $_SESSION['email'] = $email;

//     $envoyer = $etudiantModel->savecode($userId, $code);

//      if ($envoyer) {
//         // Envoi du mail
//         $mail = new Mail($email, "Vote", "<h1>$code</h1>");
//         echo json_encode([
//             'success' => true,
//             'message' => 'Code envoyé avec succès',
//             'utilisateur' => $userId
//         ]);
//          exit;
//      } else {
       
//         exit;
//      }
// } else {
//     echo json_encode(['success' => false, 'message' => 'Vous n\'êtes pas étudiante. Désolé']);
//     exit;
// }
// }
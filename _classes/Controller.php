<?php
session_start();
require_once __DIR__ . '/../models/Etudiantmodel.php';
require_once __DIR__.'/../lib/Send_mail.php';

class Controller
{
    private $Etudiantmodel;
    private $mailer;
    public $viewData = [];

    public function __construct()
    {
        $this->Etudiantmodel = new Etudiantmodel();
        $this->mailer = new Send_mail();
    }

    // Charger une vue
    protected function view($viewName, $data = [])
    {
        $this->viewData = $data;
        return $viewName;
    }


    // Formulaire de connexion
    public function login()
    {
        return 'login';
    }

   
    // Ajouter un étudiant
public function signup()
{
    $message = ""; // Variable pour la vue

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom       = htmlspecialchars($_POST['nom'] ?? '');
        $prenom    = htmlspecialchars($_POST['prenom'] ?? '');
        $email     = htmlspecialchars($_POST['email'] ?? '');
        $password  = $_POST['password'] ?? '';
        $filiere   = htmlspecialchars($_POST['filiere'] ?? '');
        $matricule = htmlspecialchars($_POST['matricule'] ?? '');
        $niveau    = htmlspecialchars($_POST['niveau'] ?? '');
        $tel       = htmlspecialchars($_POST['tel'] ?? '');

        // enregistrement dans la BD
        $result = $this->Etudiantmodel->register(
            $nom, $prenom, $filiere, $matricule, $niveau, $tel, $email
        );

        if ($result) {
            // Inscription réussie
            header("Location: /login"); 
            exit;
        } else {
            
            $message = "Erreur : l'email ou le matricule est déjà utilisé.";
        }
    }

    // On retourne la vue avec le message
    return $this->view('signup', compact('message'));
}


    // Formulaire de code de vérification

 public function send_Code() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
// Vérifier si l'email existe
            $etudiant = $this->Etudiantmodel->getByEmail($email);
            if (!$etudiant) {
                $_SESSION['error'] = "Email introuvable.";
                
            $message = "Email introuvable.";
            return $this->view('login', compact('message'));


            }
             $code = random_int(100000, 999999);
            $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

            // Enregistrer dans la table verification_code
            $this->Etudiantmodel->saveVerificationCode($etudiant['id_e'], $code, $expiry);

            // Envoyer le mail
            $subject = "Votre code de connexion";
            $body = "Bonjour {$etudiant['nom_e']},<br>Votre code de connexion : <b>$code</b><br>Valable 10 minutes.";
            $this->mailer->Sendmail($email, $subject, $body);

            $_SESSION['email_verification'] = $email;
            return 'verification'; // page pour saisir le code
        }
    }

    public function verifyCode() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_SESSION['email_verification'] ?? 'nexky08@gmail.com';
        $code  = $_POST['code'] ?? '';

        // Récupérer le dernier code enregistré en BD pour debug
        $dernierCode = $this->Etudiantmodel->getLastVerificationCode($email);

        if ($this->Etudiantmodel->verifier($email, $code)) {
            $_SESSION['user_id'] = $this->Etudiantmodel->getIdByEmail($email);
            unset($_SESSION['email_verification']);
            return 'dashboard';
        } else {
            $_SESSION['error'] = "Code invalide ou expiré";

            // debug
            return $this->view('verification', [
                'message'      => "Code invalide ou expiré",
                'code'         => $code,
                'email'        => $email
            ]);
        }
    }
}

public function index() {
    // Vérifier que l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login");
        exit;
    }

    // Récupérer l'ID de l'étudiant depuis la session
    $userId = $_SESSION['user_id'];

    // Récupérer toutes les informations depuis le modèle
    $etudiant = $this->Etudiantmodel->getEtudiantById($userId);

    if (!$etudiant) {
        // Si l'étudiant n'existe pas, rediriger vers login
        header("Location: /login");
        exit;
    }

    // Retourner la vue 'dashboard' avec les données de l'étudiant
    return $this->view('dashboard', ['etudiant' => $etudiant]);
}


}

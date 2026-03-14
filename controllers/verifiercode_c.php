<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['code'])) {
    


$code = $data['code'];

include_once '../_classes/Etudiante.php';
$db = include '../_config/db.php';

$etudiantModel = new Etudiante($db);

// On récupère l'email de l'utilisateur stocké dans la session
$email = $_SESSION['email'] ?? null;

if (!$email) {
    echo json_encode(['success' => false, 'message' => 'Email non trouvé en session']);
    exit;
}

// Récupérer l'utilisateur par email
$user = $etudiantModel->etudian($email);

if (!$user) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable']);
    exit;
}

// Vérifier si le code correspond et n’a pas été utilisé
$storedCode = $etudiantModel->getCode($user['id_e']); // méthode à créer dans le model

if ($storedCode && $storedCode['code_c'] == $code && $storedCode['used'] == 0) {
    // Marquer le code comme utilisé
    $etudiantModel->markCodeUsed($storedCode['id_c']); // méthode à créer dans le model
    $_SESSION['user_id'] = $user['id_e'];
    echo json_encode(['success' => true, 'message' => 'Code vérifié avec succès']);
} else {
    echo json_encode(['success' => false, 'message' => 'Code incorrect ou déjà utilisé']);
}
    exit;
}
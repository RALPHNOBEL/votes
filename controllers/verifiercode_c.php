<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['code'])) {
    
    $code = $data['code'];
    include_once '../_classes/Etudiante.php';
    $db = include '../_config/db.php';
    $GLOBALS['db'] = $db;

    $etudiantModel = new Etudiante($db);

    $email = $_SESSION['email'] ?? null;
    
    // DEBUG
    error_log("Email en session: " . ($email ?? 'NULL'));
    
    if (!$email) {
        echo json_encode(['success' => false, 'message' => 'Email non trouvé en session']);
        exit;
    }

    $user = Etudiante::etudian($email);
    
    // DEBUG
    error_log("User trouvé: " . print_r($user, true));

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable']);
        exit;
    }

    $storedCode = $etudiantModel->getCode($user['id_e']);
    
    // DEBUG
    error_log("storedCode: " . print_r($storedCode, true));
    error_log("code saisi: " . $code);

    if ($storedCode && $storedCode['code_c'] == $code && $storedCode['used'] == 0) {
        $etudiantModel->markCodeUsed($storedCode['id_c']);
        $_SESSION['user_id'] = $user['id_e'];
        error_log("user_id sauvegardé: " . $user['id_e']);
        echo json_encode(['success' => true, 'message' => 'Code vérifié avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Code incorrect ou déjà utilisé']);
    }
    exit;
}
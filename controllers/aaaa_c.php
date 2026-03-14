<?php
    // connection a la base de donnees 
 require_once '../_config/db.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom   = htmlspecialchars(trim($_POST['nom']));
    $age   = htmlspecialchars(trim($_POST['age']));
    $parti = htmlspecialchars(trim(strtoupper($_POST['parti'])));
    $photo = $_FILES['photo'];

    // gestion de la photo
    $uploadDir = __DIR__ . "/../uploads/"; // chemin absolu du dossier
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // crée le dossier si n'existe pas
}

$photo = $uploadDir . basename($_FILES["photo"]["name"]);
if (move_uploaded_file($_FILES["photo"]["tmp_name"], $photo)) {
    // ok upload
    $photo = "uploads/" . basename($_FILES["photo"]["name"]); // chemin relatif pour DB
} else {
    $photo = null;
}


    $sql = "INSERT INTO candidats (nom, age, parti, photo)
            VALUES (:nom, :age, :parti, :photo)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':age' => $age,
        ':parti' => $parti,
        ':photo' => $photo
    ]);
    header("Location: ../views/voter_v.php");

    if ($stmt) {
        $message = "<div class='alert alert-success'>✅ Électeur enregistré avec succès !</div>";
    } else {
        $message = "<div class='alert alert-danger'>❌ Erreur: " . $db->error . "</div>";
    }
}
?>
<?php
    include_once  '../controllers/vote_c.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Enregistrement Électeur</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.min.js"></script>
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <div class="card bg-secondary text-light shadow-lg p-4">
            <h2 class="text-center mb-4">🗳️ Enregistrer un candidat</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Âge</label>
                    <input type="number" name="age" class="form-control" required min="18">
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Parti politique</label>
                    <input type="text" name="parti" class="form-control">
                </div>
                <button type="submit" class="btn btn-light w-100">Enregistrer</button>
            </form>
        </div>
    </div>
</body>
</html>

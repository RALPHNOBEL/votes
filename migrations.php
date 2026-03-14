<?php
$dbConfig = require __DIR__ . '/app/config/database/db.php';
$pdo = new PDO(
    "{$dbConfig['driver']}:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset",
    $dbConfig['username'],
    $dbConfig["password"]
);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );

$migrations = [
    __DIR__ . '/app/config/migrations/Etudiantes.php',
    __DIR__ . '/app/config/migrations/Candidates.php',
    __DIR__ . '/app/config/migrations/Verification_code.php',
];

foreach($migrations as $file){
    echo "Migration trouve: $file .\n ";
    require_once $file;
    $className = pathinfo($file, PATHINFO_FILENAME);
    if(class_exists($className)){
        $className::up($pdo);
        echo "Migration $className executee .!!.\n";
    } else {
        echo "class $className non trouvee dans le fichier $file.\n";
    }
}
echo "Migration cree avec success !! .\n";

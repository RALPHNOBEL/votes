<?php
// Variables Railway (automatiquement disponibles)
define("DATABASE_HOST", getenv('MYSQLHOST') ?: 'localhost');
define("DATABASE_PORT", getenv('MYSQLPORT') ?: '3306');
define("DATABASE_NAME", getenv('MYSQLDATABASE') ?: 'ges_vote');
define("DATABASE_USER", getenv('MYSQLUSER') ?: 'root');
define("DATABASE_PASSWORD", getenv('MYSQLPASSWORD') ?: '');

try {
    $db = new PDO(
        'mysql:host=' . DATABASE_HOST . 
        ';port=' . DATABASE_PORT . 
        ';dbname=' . DATABASE_NAME, 
        DATABASE_USER, 
        DATABASE_PASSWORD
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
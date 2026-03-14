<?php
define("DATABASE_HOST", "localhost");
define("DATABASE_NAME", "ges_vote");
define("DATABASE_USER", "root");
define("DATABASE_PASSWORD", "");
try{
    $db = new PDO('mysql:host='.DATABASE_HOST.';dbname='.DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
    return $db;
} catch(PDOException $e){
    die("Database connection failed: " . $e->getMessage());
}
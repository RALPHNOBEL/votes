<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', true);

// SESSIONS
ini_set('session.cookie_lifetime', false);
session_start();

// CONSTANTS - PATH dynamique (fonctionne local ET Railway)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
define('PATH_REQUIRE', __DIR__ . '/../');
define('PATH', $protocol . '://' . $host . '/');

// DATABASE - Variables d'environnement Railway
define("DATABASE_HOST", getenv('PGHOST') ?: getenv('MYSQLHOST') ?: 'localhost');
define("DATABASE_NAME", getenv('PGDATABASE') ?: getenv('MYSQLDATABASE') ?: 'ges_vote');
define("DATABASE_USER", getenv('PGUSER') ?: getenv('MYSQLUSER') ?: 'root');
define("DATABASE_PASSWORD", getenv('PGPASSWORD') ?: getenv('MYSQLPASSWORD') ?: '');
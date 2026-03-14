<?php

// A Enlever lors du deploiement
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', true);

// SESSIONS
ini_set('session.cookie_lifetime', false);
session_start();

// CONSTANTS

// PATH
define('PATH_REQUIRE', substr($_SERVER['SCRIPT_FILENAME'], 0, -9));
define('PATH', substr($_SERVER['PHP_SELF'], 0, -9));


// DATABASE INFORMATION
define("DATABASE_HOST", "localhost");
define("DATABASE_NAME", "ges_vote");
define("DATABASE_USER", "root");
define("DATABASE_PASSWORD", "");
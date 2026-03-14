<?php
    
    include_once '_config/config.php';
    include_once '_functions/functions.php';
    include_once '_classes/Autoloader.php';
    Autoloader::register();
    include_once '_config/db.php';

    require __DIR__ . '/vendor/autoload.php';


    // Definition de la page courante
    if(isset($_GET['page']) AND !empty($_GET['page'])) {
        $page = trim(strtolower($_GET['page']));
    } else{
        $page = 'home'; // Page par défaut
    }

    // Tableau des pages
    $allPages = scandir('controllers/');

    if(in_array($page. '_c.php', $allPages)){
        // Inclusion de notre page
        include_once 'controllers/' .$page. '_c.php';
        include_once 'views/' .$page. '_v.php';
    } else{
        echo 'Error 404: Page not found';
    }
    
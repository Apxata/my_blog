<?php 

    define("PRIVATE_PATH", dirname(__FILE__));
    define("SHARED_PATH", PRIVATE_PATH . '/shared');

    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    require_once('db_credentials.php');
    require_once('database_functions.php');
    require_once('classes/article.class.php');
    require_once('functions.php');
    require_once('validation_functions.php');

    $database = db_connect();
    Article::set_database($database);
    
?>
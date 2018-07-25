<?php 

    define("PRIVATE_PATH", dirname(__FILE__));
    define("SHARED_PATH", PRIVATE_PATH . '/shared');

    require_once('db_credentials.php');
    require_once('database_functions.php');
    require_once('classes/article.class.php');
    require_once('functions.php');

    $database = db_connect();
    Article::set_database($database);
    
?>
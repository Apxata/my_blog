<?php 

    define("PRIVATE_PATH", dirname(__FILE__));
    define("SHARED_PATH", PRIVATE_PATH . '/shared');

    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    // добавление функциональных файлов
    require_once('db_credentials.php');
    require_once('database_functions.php');
    require_once('functions.php');
    require_once('validation_functions.php');
    require_once('status_error_functions.php'); 

    // добавление классов
    require_once('classes/databaseobject.class.php');
    require_once('classes/article.class.php');
    require_once('classes/user.class.php');
    require_once('classes/session.class.php');
    require_once('classes/pagination.class.php');
    
	
    $database = db_connect();
    DatabaseObject::set_database($database);

    $session = new Session;
    
?>
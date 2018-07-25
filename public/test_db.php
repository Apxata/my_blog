<?php require_once('../private/initialize.php'); ?>

<?php 
    $articles = Article::find_all();
   
    var_dump($articles);

    echo "pre text: " . $row["preview_text"];
    
    include(SHARED_PATH . '/public_footer.php');
  ?>
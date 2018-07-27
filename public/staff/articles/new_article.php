<?php 
    require_once('../../../private/initialize.php'); 

    if(is_post_request()) {
        
        // создаем запись используя эти параметры

        $args=[];
        $args['subject'] = $_POST['subject'] ?? NULL;
        $args['full_text'] = $_POST['full_text'] ?? NULL;
        $args['visible'] = $_POST['visible'] ?? 0;

        $article = new Article($args);
        $result = $article->create();

        if($result == true) {
            $new_id = $article->id;
            echo  "Успешно добавлено";

        } else {

            echo  "Что-то пошло не так";
        }
    } else {
        $article = new Article;
    }

?>








<?php include(SHARED_PATH . '/staff_header.php'); ?>



<div class="main">
    <div class="content container">
      <div class="row">
        <div class="redaktor col-md-8 col-md-offset-1">
            <h2>Добавление новой статьи </h2>
            <form action="new_article.php" method="post">
                <?php include('form_fields.php'); ?>
                <div id="operations">
                <input class="btn btn-primary btn-block btn-lg" type="submit" value="Добавить статью" />
                </div>
                <!-- operations -->
            </form>    
        </div>
        <!-- redaktor -->
      </div>
        <!-- row  -->
    </div>
    <!-- content container -->
</div> 
    <!-- end of main  -->



    
    
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<?php 
    require_once('../../../private/initialize.php'); 
    login_required();

    
    if(is_post_request()) {
        
        // создаем запись используя эти параметры

        $args = $_POST['article'];

        // $args['subject'] = $_POST['subject'] ?? NULL;
        // $args['full_text'] = $_POST['full_text'] ?? NULL;
        // $args['visible'] = $_POST['visible'] ?? 0;

        $article = new Article($args);
        $result = $article->save();

        if($result == true) {
            $new_id = $article->id;
            $_SESSION['message'] = 'Новая статья успешно добавлена';
            redirect_to(url_for('/staff/articles/index.php?id=' . $new_id));
            
        } else {
                // ошибка
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
            <!-- выводим сообщение об ошибках если есть  -->
            <?php echo display_errors($article->errors); ?>

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
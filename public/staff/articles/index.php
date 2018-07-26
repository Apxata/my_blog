<?php require_once('../../../private/initialize.php'); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php 
    // ищем все статьи и выводим
    $articles = Article::find_all_visible();

    foreach($articles as $article) {
?>        
<div class="main">
    <div class="content container">
      <div class="row">
        <div class="article-list">
            <div class="article col-md-8 col-md-offset-1">
                    <h2 class="a-title"><?php echo h($article->subject); ?></h2>
                    <div class="a-info"><?php echo h($article->create_date); ?></div>
                    <div class="a-content">
                        <?php echo h($article->full_text); ?>               
                    </div>   <!-- a-content -->
                 
                    <div class="a-footer">
                    <div class="comments"> 10 комментариев </div>
                    <div class="btn btn-primary editing col-sm-offset-6">Редактировать</div>
                     </div> <!-- a-footer -->
            </div>
            <!-- article -->
         </div>
        <!-- article-list -->
      </div>
        <!-- row  -->
    </div>
    <!-- content container -->
</div> 
    <!-- end of main  -->
    <?php } ?>   
       <?php include(SHARED_PATH . '/staff_footer.php'); ?>
       
   
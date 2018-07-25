<?php require_once('../private/initialize.php'); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
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
                    </div>
                    <!-- a-content -->
                    <div class="a-footer">10 комментариев</div>
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
       <?php include(SHARED_PATH . '/public_footer.php'); ?>
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   
        <script src="js/myscript.js"></script>
        
    </body>
</html>
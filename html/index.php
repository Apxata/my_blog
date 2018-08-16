<?php require_once('../private/initialize.php'); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
<?php 
    //ищем статьи постранично
    if (isset($_GET['page'])){
        $current_page = $_GET['page'];
    } else {
        $current_page = 1 ;
    }
    $per_page = 10 ;
    $total_count = Article::count_all_visible();
    
    $pagination = new Pagination($current_page, $per_page, $total_count);

    $offset = $pagination->offset();
    $articles = Article::find_all_per_page_visible($per_page, $offset);


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
                        <?php
                        $Parsedown = new Parsedown();
                                                 
                         echo $Parsedown->text($article->full_text) ;
                         
                          ?>               
                    </div>
                    <!-- a-content -->
                    <div class="a-footer">0 комментариев</div>
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

    <?php } 
        
    $url = url_for('/index.php');
    echo $pagination->page_links();
    ?>   
        <!-- подключаем футер -->
       <?php  include(SHARED_PATH . '/public_footer.php'); ?>
    </body>
</html>
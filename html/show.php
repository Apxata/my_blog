<?php require_once('../private/initialize.php'); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
<?php 
    //ищем статьи постранично
    if (isset($_GET['article'])){
        $article_id = $_GET['article'];
    } else {
        redirect_to('index.php');
    }
    // $per_page = 10 ;
    // $total_count = Article::count_all_visible();
    
    // $pagination = new Pagination($current_page, $per_page, $total_count);

    // $offset = $pagination->offset();
    $article = Article::find_article_by_id($article_id);


   
?>        
<div class="main">
    <div class="content container">
      <div class="row">
        <div class="article-list col-md-8 col-md-offset-1 ">
            <div class="article ">
                    <h2 class="a-title"><?php echo h($article->subject); ?></h2>
                    <div class="a-info"><?php echo h($article->create_date); ?></div>
                    <div class="a-content">
                       
                        <?php
                        $Parsedown = new Parsedown();
                                                 
                         echo nl2br($Parsedown->text($article->full_text)) ;
                         
                          ?>       
                            
                    </div>
                    <!-- a-content -->
                    <div class="a-footer"><a href="show.php">0 комментариев</a></div>
            </div>  <!-- article -->
            <form>
            <textarea class="form-control" rows="1"></textarea>    
            <button type="submit" class="btn btn-default">Отправить</button>
            </form>


            <!-- вывод комментов  -->
            <div class="panel panel-primary">
            <div class="panel-heading">
                Никнейм
            </div>
            <div class="panel-body">Здесь будет написан коммент для новости</div>
            </div>
              
            </div><!-- comments    -->
          
         </div>
        <!-- article-list -->
      </div>
        <!-- row  -->
    </div>
    <!-- content container -->
</div> 
    <!-- end of main  -->

        
    <!-- $url = url_for('/index.php');
    echo $pagination->page_links();
       -->
        <!-- подключаем футер -->
       <?php  include(SHARED_PATH . '/public_footer.php'); ?>
    </body>
</html>
<?php 
    require_once('../../../private/initialize.php'); 
    

    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $article = Article::find_by_id($id);
    if($article == false) {
        redirect_to('index.php');
    }

    include(SHARED_PATH . '/staff_header.php');

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
                    <div class="editing col-sm-offset-6"><a href="edit.php?id=<?php echo h(u($article->id)); ?>">Редактировать</a></div>
                    <div class="visible"> Статья показывается:<?php if($article->visible == 1) {echo "ДА";} else { echo "НЕТ"; } ?></div>
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
   
       <?php include(SHARED_PATH . '/staff_footer.php'); ?>
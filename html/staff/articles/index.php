<?php 
    require_once('../../../private/initialize.php');
    login_required();
if (isset($_GET['page'])){
    $current_page = $_GET['page'];
} else {
    $current_page = 1 ;
}
$per_page = 15 ;
$total_count = Article::count_all();

$pagination = new Pagination($current_page, $per_page, $total_count);

 $offset = $pagination->offset();
 $articles = Article::find_all_per_page($per_page, $offset);

?>

<?php $page_title = 'Статьи'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

     
<div class="main">
    <div class="content container">
      <div class="row">
        <div class="article-list col-md-8 col-md-offset-1">
            <div class="add_article">
                <a href="new_article.php">Добавить статью</a>
            </div>
            <?php 
             foreach($articles as $article) {
            ?> 
            <div class="article">
            
                    <h2 class="a-title"><?php echo h($article->subject); ?></h2>
                    <div class="a-info"><?php echo h($article->create_date); ?></div>
                    <div class="a-content">
                        <?php  
                        $Parsedown = new Parsedown();
                        echo $Parsedown->text($article->full_text) ;
                         ?>             
                    </div>   <!-- a-content -->
                 
                    <div class="a-footer">
                    <div class="comments"> 0 комментариев </div>
                    <div class="editing col-sm-offset-6"><a href="edit.php?id=<?php echo h(u($article->id)); ?>">Редактировать</a></div>
                    <div class="visible"> Статья показывается:<?php if($article->visible == 1) {echo  "<span class=\"show\">ДА</span>";} else { echo "НЕТ"; } ?></div>
                     </div> <!-- a-footer -->
               
            </div>
            <!-- article -->
            <?php } ?>   
         </div>
        <!-- article-list -->
      
      </div>
        <!-- row  -->
    </div>
    <!-- content container -->
</div> 
    <!-- end of main  -->
  

<?php 
    $url = url_for('staff/articles/index.php');
    echo $pagination->page_links();
?>
   
       <?php include(SHARED_PATH . '/staff_footer.php'); ?>
       
   
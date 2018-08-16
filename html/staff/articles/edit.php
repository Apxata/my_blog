<?php

require_once('../../../private/initialize.php');
login_required();

if(!isset($_GET['id'])) {
  redirect_to('articles/index.php');
}
$id = $_GET['id'];
$article = Article::find_by_id($id);
if($article == false) {
  redirect_to('/article/index.php');
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['article'];
  $article->merge_attributes($args);
  $result = $article->save();

  if($result === true) {
    $_SESSION['message'] = 'Статья успешно отредактирована';
    redirect_to('/staff/articles/index.php');
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<?php $page_title = 'Edit article'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="main">
    <div class="content container">
      <div class="row">
        <div class="redaktor col-md-8 col-md-offset-1">
            <a class="btn btn-primary" href="<?php echo ('/staff/articles/index.php'); ?>">&laquo; Вернуться обратно</a>
         
              <h1>Редактирование статьи</h1>
                  <!-- выводим сообщение об ошибках если есть  -->
                  <?php echo display_errors($article->errors); ?>

              <form action="<?php echo ('/staff/articles/edit.php?id=' . h(u($id))); ?>" method="post">

                <?php include('form_fields.php'); ?>

                <div id="operations">
                  <input class="btn btn-primary" type="submit" value="Отредактировать" />
                </div>
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

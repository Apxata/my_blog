<?php require_once('../../../private/initialize.php'); ?>
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
<?php 
    require_once('../../../private/initialize.php'); 
    login_required();

    
    if(!isset($_GET['id'])) {
        redirect_to(url_for('/staff/users/index.php'));
      }
      $id = $_GET['id'];
      $user = User::find_by_id($id);
      if($user == false) {
        redirect_to(url_for('/staff/users/index.php'));
      }

    if(is_post_request()) {
       
        $args = $_POST['user'];
        $user->merge_attributes($args);
        $result = $user->save();

        if($result == true) {
            $_SESSION['message'] = 'Пользователь успешно обновлен';
            redirect_to(url_for('/staff/users/index.php'));
            
        } else {
                // ошибка
        }
    } else {
       
    }

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="main">
    <div class="content container">
      <div class="row">
        <div class="redaktor col-md-8 col-md-offset-1">
            <h2>Добавление нового пользователя </h2>
            <!-- выводим сообщение об ошибках если есть  -->
            <?php echo display_errors($user->errors); ?>

            <form class="form-horizontal" action="edit_user.php?id=<?php echo h($user->id); ?>" method="post">
                <?php include('form_fields.php'); ?>
                <div id="operations">
                    <div class="col-sm-offset-2 col-sm-10">
                    <input class="btn btn-block btn-lg" type="submit" value="Зарегать" />
                    </div>    <!-- col-sm-offset-2 col-sm-10 -->
             
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



    
    

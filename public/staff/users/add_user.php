<?php 
    require_once('../../../private/initialize.php'); 

    if(is_post_request()) {
        
        // $password = $_POST['user']['hashed_password'];
        // $hashed_pswd = password_hash($password,PASSWORD_DEFAULT);
        // $_POST['user']['hashed_password'] = $hashed_pswd;
        $_POST['user']['hashed_password'] = generate_hash($_POST['user']['hashed_password']);
        
        $args = $_POST['user'];
        
        // $args['subject'] = $_POST['subject'] ?? NULL;
        // $args['full_text'] = $_POST['full_text'] ?? NULL;
        // $args['visible'] = $_POST['visible'] ?? 0;

        $user = new User($args);
        $result = $user->save();

        if($result == true) {
            $new_id = $user->id;
            $_SESSION['message'] = 'Новый пользователь успешно добавлен';
            redirect_to(url_for('/staff/users/index.php'));
            
        } else {
                // ошибка
        }
    } else {
        $user = new User;
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

            <form class="form-horizontal" action="add_user.php" method="post">
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



    
    

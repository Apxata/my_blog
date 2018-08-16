<?php 
    require_once('../../private/initialize.php');


$errors = [];
$email = '';
$password = '';

if(is_post_request()) {

    if(isset($_POST['email'])){
        $email = $_POST['email'];
    } else {
        $email = '';
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
    } else {
        $password = '';
    }
}

    // Валидация

    if(is_blank($email)) {
        $errors[] = "Почта не может быть пустой";
    }
    if(is_blank($password)) {
        $errors[] = "Пароль не может быть пустым";
    }

    //если не было ошибок, пробуем залогиниться

    if(empty($errors)) {
        $user = User::find_by_email($email);
        // если почта найдена и пароль верный 
        if($user != false && $user->verify_pas($password)) {
            // помечаем пользователя как залогиненного 
            $session->login($user);
            redirect_to('articles/index.php');
        }else {
            // что-то пошло не так, выводим ошибку
            $errors[] = "Попытка входа была неуспешной.";
        }
    }

    $page_title = 'Страница входа';
?>
<?php include(SHARED_PATH . '/login_header.php'); ?>

<header class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Точка входа</h1>
                        <hr class="small">
                        <span class="subheading">Введите ваш email и пароль</span>
                    </div>
                </div>
            </div>
        </div>
</header>
    <?php  echo display_errors($errors); 
           
    ?>

<form action="login.php" method="post">
<table class="table">
    <tr class="info">
        <th>Параметр</th>
        <th>Значение</th>
    </tr>
    <tr>
        <td> Почта(логин)</td>
        <td><input id="email" type="email" name="email" value="<?php echo htmlentities($email); ?>  " required="required"></td>
        
    </tr>        
    <tr>
        <td> Пароль </td>
        <td><input id="password" type="password" name="password" value="" required="required"></td>
    </tr>  
    
</table>
     <div class="container-fluid">
          <input type="submit" name= "submit" value="Отправить" class="btn btn-primary col-lg-3 col-lg-offset-3" >   
    </div>
</form>

<?php 
include(SHARED_PATH . '/staff_footer.php'); ?>   


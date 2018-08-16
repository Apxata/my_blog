<?php 
    require_once('../../../private/initialize.php'); 
    login_required();
?>


<?php include(SHARED_PATH . '/staff_header.php'); ?>

     
<div class="main">
    <div class="content container">
        <div class="row">
           <div class="user col-md-8 col-md-offset-1">
            <!-- USER ADD MENU -->
           <div class="add_user">
            <a href="add_user.php">Добавить пользователя</a>
           </div>  <!-- user add -->

           <?php 
            // Searching for all users
            $users = User::find_all();
            ?>
            
        <h2>Список пользователей</h2>

        <table class="table table-bordered">
          <tr>
            <th>id</th>
            <th>Логин(почта)</th>
            <th>Дата регистрации</th>
            <th>Имя </th>
            <th>Фамилия</th>
            <th>Удален</th>
            <th>Редактировать</th>
          </tr>
  <?php foreach($users as $user) { ?>
          <tr>
            <td><?php echo h($user->id);?></td>
            <td><?php echo h($user->email);?></td>
            <td><?php echo h($user->reg_date);?></td>
            <td><?php echo h($user->first_name);?></td>
            <td><?php echo h($user->last_name);?></td>
            <td><?php echo h($user->deleted);?></td>
            <td><a href="edit_user.php?id=<?php echo h($user->id); ?>">Ред</a></td>
          </tr>
    <?php } // конец foreach ?>
        </table>
           </div>
            <!-- article -->
      </div>
        <!-- row  -->
    </div>
    <!-- content container -->
</div> 
    <!-- end of main  -->
     
       
   
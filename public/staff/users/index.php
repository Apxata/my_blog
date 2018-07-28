<?php require_once('../../../private/initialize.php'); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php 
    // ищем все статьи и выводим
    $users = User::find_all();

?>        
<div class="main">
    <div class="content container">
        <div class="row">
           <div class="article col-md-8 col-md-offset-1">
        <table class="table table-bordered">
          <tr>
            <th>id</th>
            <th>Логин(почта)</th>
            <th>Дата регистрации</th>
            <th>Имя </th>
            <th>Фамилия</th>
            <th>Удален</th>
          </tr>
  <?php foreach($users as $user) { ?>
          <tr>
            <td><?php echo h($user->id);?></td>
            <td><?php echo h($user->email);?></td>
            <td><?php echo h($user->reg_date);?></td>
            <td><?php echo h($user->first_name);?></td>
            <td><?php echo h($user->last_name);?></td>
            <td><?php echo h($user->deleted);?></td>

          </tr>
          
    <?php } // конец foreach ?>

        </table>
      
        <div class="add_user">
            <a href="add_user.php">Добавить пользователя</a>
        </div>  <!-- user add -->
          
           </div>
            <!-- article -->
      </div>
        <!-- row  -->
        <!-- row  -->
    </div>
    <!-- content container -->
</div> 


    <!-- end of main  -->
     
       
   
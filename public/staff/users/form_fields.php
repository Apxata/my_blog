    <?php 
        if(!isset($user)){
          redirect_to('index.php');
        }
    ?>
    
    <h2 class="a-title"></h2>
    
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Почта(логин)</label>
    <div class="col-sm-10">
      <input type="email" name="user[email]" class="form-control" id="inputEmail3" placeholder="Почта(логин)" value="<?php echo h($user->email);?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword1" class="col-sm-2 control-label">Пароль</label>
    <div class="col-sm-10">
      <input type="password" name="user[hashed_password]" class="form-control" id="inputPassword1" placeholder="пароль">
    </div>
  </div>
  <!-- <div class="form-group">
    <label for="inputPassword2" class="col-sm-2 control-label">Повторите пароль</label>
    <div class="col-sm-10">
      <input type="password" name="user[password2]" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
   </div> -->
   <div class="form-group">
    <label for="inlineRadio1 inlineRadio2" class="col-sm-2 control-label">Удален</label>
    <div class="col-sm-10">
        <input type="radio" name="user[deleted]" id="inlineRadio1" value="1" <?php if($user->deleted == 1){echo "checked";}  ?>> Да
        <input type="radio" name="user[deleted]" id="inlineRadio2" value="0"<?php if($user->deleted == 0){echo "checked";} ?>> Нет
     </div>
   </div>

       
 
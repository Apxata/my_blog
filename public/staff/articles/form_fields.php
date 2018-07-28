    <?php 
        if(!isset($article)){
          redirect_to('index.php');
        }
    ?>
    
    <h2 class="a-title"></h2>
    
    <input name="article[subject]" type="text" class="form-control" placeholder="Тема поста" value="<?php echo h($article->subject);?>">  
    <div class="a-content">
    <textarea name="article[full_text]" class="form-control" rows="20" cols="80" placeholder="Ваш текст"><?php echo h($article->full_text);?></textarea>             
    <hr>
    <p>Видимость</p>
    <label class="radio-inline">
    <input type="radio" name="article[visible]" id="inlineRadio1" value="1" <?php if($article->visible == 1){echo "checked";}  ?>> Видно
    </label>
    <label class="radio-inline">
    <input type="radio" name="article[visible]" id="inlineRadio2" value="0"<?php if($article->visible == 0){echo "checked";} ?>> Скрыто
    </label>
    </div>
    <hr>
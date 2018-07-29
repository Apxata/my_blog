<?php 
    class User extends DatabaseObject {

         static protected $table_name = 'users';
         static protected $db_columns = ['id', 'email', 'hashed_password', 'reg_date', 'first_name', 'last_name', 'deleted'];  
         public $errors = [];

         public $id;
         public $email;
         protected $hashed_password;
         public $password;
         public $confirm_password;
         public $reg_date;
         public $first_name;
         public $last_name;
         public $deleted;
         protected $password_required = true;

         public function __construct($args=[]) {

            if (isset($args['email'])) {
                $this->email = $args['email'];
            } else {
                $this->email = ''; 
            }
            if (isset($args['password'])) {
                $this->password = $args['password'];
            } else {
                $this->password = ''; 
            }
            if (isset($args['confirm_password'])) {
                $this->confirm_password = $args['confirm_password'];
            } else {
                $this->confirm_password = ''; 
            }
            if (isset($args['reg_date'])) {
                $this->reg_date = $args['reg_date'];
            } else {
                $this->reg_date = ''; 
            }
            if (isset($args['first_name'])) {
                $this->first_name = $args['first_name'];
            } else {
                $this->first_name = ''; 
            }

            if (isset($args['last_name'])) {
                $this->last_name = $args['last_name'];
            } else {
                $this->last_name = ''; 
            }

            if (isset($args['deleted'])) {
                $this->deleted = $args['deleted'];
            } else {
                $this->deleted = 0; 
            }
         }

         protected function validate() {
            $this->errors = [];
    
            if(is_blank($this->email)) {
                $this->errors[] = "Почта не может быть пустой";
            }elseif (!has_length($this->email, array('max' => 255))) {
                $this->errors[] = "Почта не может быть длинее 255 символов";
            }elseif (!has_valid_email_format($this->email)) {
                $this->errors[] = "Почта неверного формата";
            }elseif (has_unique_email($this->email, $this->id ?? 0)) {
                $this->errors[] = "Почта уже используется";
            }          
            
            if($this->password_required){

            if(is_blank($this->password)) {
                $this->errors[] = "пароль не может быть пустым";
            } elseif (!has_length($this->password, array('min' => 8))) {
                $this->errors[] = "Пароль может быть минимум 8 символов";
              } elseif (!preg_match('/[A-ZА-Я]/', $this->password)) {
                $this->errors[] = "Пароль должен содержать минимум 1 заглавный символ";
              } elseif (!preg_match('/[a-zа-я]/', $this->password)) {
                $this->errors[] = "Пароль должен содержать минимум 1 прописной символ";
              } elseif (!preg_match('/[0-9]/', $this->password)) {
                $this->errors[] = "Пароль должен содержать минимум 1 цифру";
            //   } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
            //     $this->errors[] = "Пароль должен содержать минимум 1 спец символ";
              } elseif (!preg_match('/^[A-Z0-9]+$/i', $this->password)) {
                  $this->errors[] = "Пароль может содержать только латинские буквы и цфры";
              }

            if(is_blank($this->confirm_password)) {
                $this->errors[] = "Введите свой пароль повторно";
            }elseif($this->password !== $this->confirm_password) {
                $this->errors[] = "Пароли не совпадают";
            }
        }
        return $this->errors;
            }

        static public function find_by_email($email){
            
                $email = self::$database->escape_string($email);
                $sql = "SELECT * FROM " . static::$table_name . " ";
                $sql .= "WHERE email = '$email' ";
                $object_array = static::find_by_sql($sql);
                if(!empty($object_array)){
                    return array_shift($object_array);
                } else {
                    return false;
                }
            }
        
         public function attributes(){
            $attributes = [];
              foreach(self::$db_columns as $column) {
                  if($column == 'id' or $column == 'reg_date'){
                      continue;
                  }
                  $attributes[$column] = $this->$column;
              }
          return $attributes;
          }

          protected function set_hashed_password() {
              $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
          }

          protected function create() {
            $this->set_hashed_password();
            return parent::create();

          }

          protected function update(){
              if($this->password != '' ) {
                  //validate
                  $this->set_hashed_password();
              }else {
                  // пропустить хеширование и проверку пароля
                  $this->password_required = false;
              }
            return parent::update();
          }
    
}

?>
<?php 
    class User extends DatabaseObject {

         static protected $table_name = 'users';
         static protected $db_columns = ['id', 'email', 'hashed_password', 'reg_date', 'first_name', 'last_name', 'deleted'];  
         public $errors = [];

         public $id;
         public $email;
         public $hashed_password;
         public $reg_date;
         public $first_name;
         public $last_name;
         public $deleted;

         public function __construct($args=[]) {

            if (isset($args['email'])) {
                $this->email = $args['email'];
            } else {
                $this->email = ''; 
            }
            if (isset($args['hashed_password'])) {
                $this->hashed_password = $args['hashed_password'];
            } else {
                $this->hashed_password = ''; 
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
                $this->errors[] = "почта не может быть пустой";
            }
            if(is_blank($this->hashed_password)) {
                $this->errors[] = "пароль не может быть пустым";
            }
            return $this->errors;
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
    
}

?>
<?php

class Comment extends DatabaseObject {

    static protected $table_name = 'comments';
    static protected $db_columns = ['id', 'user_id', 'date_create', 'comment', 'deleted'];

    public $errors =[];

    public $id;
    public $user_id;
    public $date_create;
    public $comment;
    public $deleted;

    public function __construct($args=[]) {
       
        if (isset($args['user_id'])) {
            $this->user_id = $args['user_id'];
        } else {
            $this->user_id = ''; 
        }
        
        if (isset($args['date_create'])) {
            $this->date_create = $args['date_create'];
        } else {
            $this->date_create = ''; 
        }

        if (isset($args['comment'])) {
            $this->comment = $args['comment'];
        } else {
            $this->comment = ''; 
        }

        if (isset($args['deleted'])) {
            $this->deleted = $args['deleted'];
        } else {
            $this->deleted = ''; 
        }
    }
   
    static public function find_all_per_page($per_page, $offset){
        //$offset = self::$database->escape_string($offset);
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " ORDER BY date_create DESC ";
        $sql .= " LIMIT {$per_page} ";
        $sql .= "OFFSET {$offset} ";
        $result = static::find_by_sql($sql);
        return $result;
    }

    static public function find_all_per_page_visible($per_page, $offset){
        //$offset = self::$database->escape_string($offset);
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE deleted = 0 ";
        $sql .= " ORDER BY date_create DESC ";
        $sql .= " LIMIT {$per_page} ";
        $sql .= " OFFSET {$offset} ";
        $result = static::find_by_sql($sql);
        return $result;
     }
    
     protected function validate() {
        $this->errors = [];
        if(is_blank($this->comment)) {
            $this->errors[] = "Комментарий не может быть пустым";
        }
        return $this->errors;
    }

    public function attributes(){
        $attributes = [];
          foreach(self::$db_columns as $column) {
              if($column == 'id' or $column == 'date_create'){
                  continue;
              }
              $attributes[$column] = $this->$column;
          }
      return $attributes;
      }

}
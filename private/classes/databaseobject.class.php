<?php 

class DatabaseObject {

     // start of active record 
     static protected $database;
     static protected $table_name = "";
     static protected $db_columns = [];
     public $errors = [];
 
     static public function set_database($database) {
         self::$database = $database;
     }
 
     static public function find_by_sql($sql){
         $result = self::$database->query($sql);
         if(!$result) {
             exit("Database query failed");
         }
 
         // result into object 
         $object_array = [];
         while($record = $result->fetch_assoc()) {
             $object_array[] = static::instantiate($record);
         }
         $result->free();
 
         return $object_array;
     }
 
     static public function find_all() {
         $sql = "SELECT * FROM " . static::$table_name;
         return static::find_by_sql($sql);
     }

     static public function count_all() {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = self::$database->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }
 
     static public function find_by_id($id) {
         $id = self::$database->escape_string($id);
         $sql = "SELECT * FROM " . static::$table_name . " ";
         $sql .= "WHERE id = $id ";
         $object_array = static::find_by_sql($sql);
         if(!empty($object_array)){
             return array_shift($object_array);
         } else {
             return false;
         }
 
     }
 
     static protected function instantiate($record) {
         $object = new static;
         foreach($record as $property => $value) {
             if(property_exists($object, $property)) {
                 $object->$property = $value;
             }
         }
         return $object;
     }
         // Старая версия создания записи
 
     // public function create() {
     //     $sql ="INSERT INTO articles (";
     //     $sql .= "author_id, preview_text, full_text, subject, visible ";
     //     $sql .= ")  VALUES (";
     //     $sql .= "'" . $this->author_id . "', ";
     //     $sql .= "'" . $this->preview_text . "', ";
     //     $sql .= "'" . $this->full_text . "', ";
     //     $sql .= "'" . $this->subject . "', ";
     //     $sql .= "'" . $this->visible . "'";
     //     $sql .= ")";
 
     //     $result = self::$database->query($sql);
     //     if($result) {
     //         $this->id = self::$database->insert_id;
     //     }
     //     return $result;
     // }
     protected function validate() {
         $this->errors = [];
        
         // каждый класс сам определяет ошибки
         return $this->errors;
     }
 
     protected function create() {
         $this->validate();
         if(!empty($this->errors)) {return false;}
 
         $attributes = $this->sanitized_attributes();
         $sql ="INSERT INTO " . static::$table_name . " (";
         $sql .= join(', ', array_keys($attributes));
         $sql .= ")  VALUES ('";
         $sql .= join("', '", array_values($attributes));
         $sql .= "')";
 
         $result = self::$database->query($sql);
         if($result) {
             $this->id = self::$database->insert_id;
         }
         return $result;
     }
 
     protected function update(){
         $this->validate();
         if(!empty($this->errors)) {return false;}
 
         $attributes = $this->sanitized_attributes();
         $attributes_pairs = [];
         foreach($attributes as $key => $value) {
             $attributes_pairs[] = "{$key}='{$value}'";
         }
 
         $sql = "UPDATE " . static::$table_name . " SET ";
         $sql .= join(', ', $attributes_pairs);
         $sql .=" WHERE id='" . self::$database->escape_string($this->id) . "'";
         $sql .="LIMIT 1";
         $result = self::$database->query($sql);
         return $result;
     }
 
     public function save() {
         if(isset($this->id)){
             return $this->update();
          } else {
              return $this->create();
          }
 
     }
 
     public function merge_attributes($args=[]){
         foreach($args as $key => $value) {
             if(property_exists($this, $key) && !is_null($value)) {
                 $this->$key = $value;
             }
         }
     }
 
     public function attributes(){
       $attributes = [];
         foreach(static::$db_columns as $column) {
             if($column == 'id'){
                 continue;
             }
             $attributes[$column] = $this->$column;
         }
     return $attributes;
     }
 
     protected function sanitized_attributes() {
         $sanitized = [];
         foreach($this->attributes() as $key=>$value) {
             $sanitized[$key] = self::$database->escape_string($value);
         }
         return $sanitized;
     }
 
     // end of active record 


}

?>
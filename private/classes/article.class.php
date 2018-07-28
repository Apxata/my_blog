<?php 

class Article extends DatabaseObject {

 
    static protected $table_name = 'articles';
    static protected $db_columns = ['id', 'author_id', 'create_date', 'last_edit_date', 'preview_text', 'full_text', 'subject', 'visible'];
    public $errors = [];

    public $id;
    public $author_id = 1;
    public $create_date = 0;
    public $last_edit_date = 0;
    public $preview_text;
    public $full_text;
    public $subject;
    public $visible;


    public function __construct($args=[]) {
       
        if (isset($args['author_id'])) {
            $this->author_id = $args['author_id'];
        } else {
            $this->author_id = 20; 
        }
        
        if (isset($args['create_date'])) {
            $this->create_date = $args['create_date'];
        } else {
            $this->create_date = ''; 
        }

        if (isset($args['last_edit_date'])) {
            $this->last_edit_date = $args['last_edit_date'];
        } else {
            $this->last_edit_date = ''; 
        }

        if (isset($args['preview_text'])) {
            $this->preview_text = $args['preview_text'];
        } else {
            $this->preview_text = ''; 
        }

        if (isset($args['full_text'])) {
            $this->full_text = $args['full_text'];
        } else {
            $this->full_text = ''; 
        }

        if (isset($args['subject'])) {
            $this->subject = $args['subject'];
        } else {
            $this->subject = ''; 
        }

        if (isset($args['visible'])) {
            $this->visible = $args['visible'];
        } else {
            $this->visible = ''; 
        }

    }

    // static public function set_database($database) {
    //     self::$database = $database;
    // }

    // static public function find_by_sql($sql){
    //     $result = self::$database->query($sql);
    //     if(!$result) {
    //         exit("Database query failed");
    //     }

    //     // result into object 
    //     $object_array = [];
    //     while($record = $result->fetch_assoc()) {
    //         $object_array[] = self::instantiate($record);
    //     }
    //     $result->free();

    //     return $object_array;
    // }

    static public function find_all() {
        $sql = "SELECT * FROM articles ORDER BY create_date DESC";
        return self::find_by_sql($sql);
    }

    static public function find_all_visible() {
        $sql = "SELECT * FROM articles WHERE visible = 1 ORDER BY create_date DESC";
        return self::find_by_sql($sql);
    }

    // static public function find_by_id($id) {
    //     $id = self::$database->escape_string($id);
    //     $sql = "SELECT * FROM articles WHERE id =$id";
    //     $object_array = self::find_by_sql($sql);
    //     if(!empty($object_array)){
    //         return array_shift($object_array);
    //     } else {
    //         return false;
    //     }

    // }

    // static protected function instantiate($record) {
    //     $object = new self;
    //     foreach($record as $property => $value) {
    //         if(property_exists($object, $property)) {
    //             $object->$property = $value;
    //         }
    //     }
    //     return $object;
    // }
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

        if(is_blank($this->subject)) {
            $this->errors[] = "Тема сообщения не может быть пустой";
        }
        if(is_blank($this->full_text)) {
            $this->errors[] = "Сообщение не может быть пустым";
        }
        return $this->errors;
    }

    // protected function create() {
    //     $this->validate();
    //     if(!empty($this->errors)) {return false;}

    //     $attributes = $this->sanitized_attributes();
    //     $sql ="INSERT INTO articles (";
    //     $sql .= join(', ', array_keys($attributes));
    //     $sql .= ")  VALUES ('";
    //     $sql .= join("', '", array_values($attributes));
    //     $sql .= "')";

    //     $result = self::$database->query($sql);
    //     if($result) {
    //         $this->id = self::$database->insert_id;
    //     }
    //     return $result;
    // }

    // protected function update(){
    //     $this->validate();
    //     if(!empty($this->errors)) {return false;}

    //     $attributes = $this->sanitized_attributes();
    //     $attributes_pairs = [];
    //     foreach($attributes as $key => $value) {
    //         $attributes_pairs[] = "{$key}='{$value}'";
    //     }

    //     $sql = "UPDATE articles SET ";
    //     $sql .= join(', ', $attributes_pairs);
    //     $sql .=" WHERE id='" . self::$database->escape_string($this->id) . "'";
    //     $sql .="LIMIT 1";
    //     $result = self::$database->query($sql);
    //     return $result;
    // }

    // public function save() {
    //     if(isset($this->id)){
    //         return $this->update();
    //      } else {
    //          return $this->create();
    //      }

    // }

    // public function merge_attributes($args=[]){
    //     foreach($args as $key => $value) {
    //         if(property_exists($this, $key) && !is_null($value)) {
    //             $this->$key = $value;
    //         }
    //     }
    // }

    public function attributes(){
      $attributes = [];
        foreach(self::$db_columns as $column) {
            if($column == 'id' or $column == 'create_date' or $column == 'last_edit_date'){
                continue;
            }
            $attributes[$column] = $this->$column;
        }
    return $attributes;
    }

    // protected function sanitized_attributes() {
    //     $sanitized = [];
    //     foreach($this->attributes() as $key=>$value) {
    //         $sanitized[$key] = self::$database->escape_string($value);
    //     }
    //     return $sanitized;
    // }

    // end of active record 




    



        // $this->author_id = $args['author_id'] ?? '20';
        // $this->create_date = $args['create_date'] //?? '';
        // $this->last_edit_date = $args['last_edit_date'] //?? '';
        // $this->preview_text = $args['preview_text'] //?? '';
        // $this->full_text = $args['full_text'] //?? '';
        // $this->subject = $args['subject'] //?? '';
        // $this->visible = $args['visible'] //?? '';

    
}

?>
<?php 

class Article {

    // start of active record 
    static protected $database;
    static protected $db_columns = ['id', 'author_id', 'create_date', 'last_edit_date', 'preview_text', 'full_text', 'subject', 'visible'];

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
            $object_array[] = self::instantiate($record);
        }
        $result->free();

        return $object_array;
    }

    static public function find_all() {
        $sql = "SELECT * FROM articles";
        return self::find_by_sql($sql);
    }

    static public function find_all_visible() {
        $sql = "SELECT * FROM articles WHERE visible = 1 ORDER BY create_date DESC";
        return self::find_by_sql($sql);
    }

    static protected function instantiate($record) {
        $object = new self;
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

    public function create() {
        $attributes = $this->sanitized_attributes();
        $sql ="INSERT INTO articles (";
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

    protected function sanitized_attributes() {
        $sanitized = [];
        foreach($this->attributes() as $key=>$value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }

    // end of active record 

    public $id;
    public $author_id = 1;
    public $create_date = 0;
    public $last_edit_date = 0;
    public $preview_text;
    public $full_text;
    public $subject;
    public $visible;


    public function __construct($args=[]) {

        $this->author_id = $args['author_id'] ?? '20';
        $this->create_date = $args['create_date'] ?? '';
        $this->last_edit_date = $args['last_edit_date'] ?? '';
        $this->preview_text = $args['preview_text'] ?? '';
        $this->full_text = $args['full_text'] ?? '';
        $this->subject = $args['subject'] ?? '';
        $this->visible = $args['visible'] ?? '';

    }
}

?>
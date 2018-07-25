<?php 

class Article {

    // start of active record 
    static protected $database;

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
        $sql = "SELECT * FROM articles WHERE visible = 1";
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
    // end of active record 

    public $id;
    public $author_id = 1;
    public $create_date = 0;
    public $last_edit_date = 0;
    public $preview_text;
    public $full_text;
    public $subject;
    public $visible;

}

?>
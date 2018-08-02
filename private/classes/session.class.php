<?php 

    class Session {
        private $user_id;
        public $email;
        private $last_login;
       

        public function __construct() {
            session_start();
            $this->check_stored_login();
        }

        public function login($user) {
            if($user) {
                //session fixation attack
                session_regenerate_id();
                $this->user_id = $_SESSION['user_id'] = $user->id;
                $this->email = $_SESSION['email']= $user->email;
                $this->last_login = $_SESSION['last_login'] = time();
            }
            return true;

        }

        public function is_logged_in() {
            return isset($this->user_id);
        }
        public function logout(){
            unset( $_SESSION['user_id']);
            unset( $_SESSION['email']);
            unset( $_SESSION['last_login']);
            unset ($this->user_id);
            unset ($this->email);
            unset ($this->last_login);
            return true;
        }
        
        private function check_stored_login() {
            if(isset($_SESSION['user_id']) and isset($_SESSION['email']) and isset($_SESSION['last_login'])) {
                $this->user_id = $_SESSION['user_id'];
                $this->email = $_SESSION['email'];
                $this->last_login = $_SESSION['last_login'];
            }
        }
   
    }

    ?>
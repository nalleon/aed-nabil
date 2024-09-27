<?php
    class Player{
        private $username;     
        private $userNum;

        public function __construct($username){
            $this->username = $username;
            $this->userNum = 0;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getUserNum(){
            return $this->userNum;
        }
    }

?>
<?php 
    class usuario {
        private $userName;
        private $userLogin;
        private $userPass;
        public function getUserName() {
            return $this->userName;
        }
        public function setUserName($sUserName) {
            $this->userName = $sUserName;
        }
        public function getUserLogin() {
            return $this->userLogin;
        }
        public function setUserLogin($sUserLogin) {
            $this->userLogin = $sUserLogin;
        }
        public function getUserPass() {
            return $this->userPass;
        }
        public function setUserPass($sUserPass) {
            $this->userPass = $sUserPass;
        }
    }

?>
    <?php

    class validation {

        public static function validateEmail($email) {

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email format";
            } 
        }

        public static function validatePassword($password, $confirm_password) {
            if($password != $confirm_password) {
                return "Passwords do not match";
            }
        }

        public static  function validatepasswordStrength($password) {
            if(strlen($password) < 8 || strlen($password) > 15) {
                return "Password must be at least 8 characters long";
            }
        }
    }


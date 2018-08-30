<?php

class SelectLoginAttempts extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectLoginAttempts";
    var $useTable = 'login_attempts'; //db=Teacher schema=master

   public function setLoginAttempts($ip, $userId) {
       try {
           $date = date('Y-m-d H:i:s');
           $query = "INSERT INTO master.login_attempts(user_id, time_stamp, ip_address, login_logout, lock_flag)
           VALUES ('$userId', '$date', '$ip', 'S', 'N');";
           if ($this->query($query)) {
               return true;
           } else {
               return false;
           }
       } catch (Exception $e) {
           //                echo 'Caught exception: ', $e->getMessage(), "\n";
       }
   }

}

?>
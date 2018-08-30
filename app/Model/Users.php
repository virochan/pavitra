<?php

class Users extends AppModel {

    var $name = "Users";

    public function encryptWebSrvc($string) {
        $strng = base64_encode(base64_encode(base64_encode($string)));
        return $strng;
    }

    public function decryptWebSrvc($string) {
        $strng = base64_decode(base64_decode(base64_decode($string)));
        return $strng;
    }

}

?>
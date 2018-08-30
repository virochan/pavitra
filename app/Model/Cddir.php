<?php
class Cddir extends AppModel {
    public $useDbConfig = 'use_db_Tech_master';
    var $name = "Cddir";
    var $useTable = 'cddir'; //db=Teacher schema=master
    public $virtualFields = array('code_type_value' => 'CONCAT(Cddir.code_type|| \'-\' ||Cddir.code_value)'); //Cddir.=model name
    
      public function getSamayojansSubject() {
        try {
//            $query = "SELECT  code_value,code_text
//                         FROM master.cddir
//                     WHERE  code_type ='SS' ";
//            echo "" . $query;
//            exit();
                         $query = "SELECT DISTINCT(subject_group_id) as code_value, subject_group_desc as code_text
                                    FROM master.tchr_apt_subject 
                                    ORDER By code_text
                                     ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
        
    }
    
      public function getReservationCat() {
        try {
            $query = "SELECT  code_value,code_text
                         FROM master.cddir
                     WHERE  code_type ='CT' ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
        
    }
}

?>
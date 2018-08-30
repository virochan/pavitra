<?php

class SelectSubjectStandardXiXii extends AppModel {

    var $name = 'SelectSubjectStandardXiXii';
    public $useDbConfig = 'use_db_Tech_master';
    public $useTable = 'shala_standard_medium_subject_xi_xii';  //db=Teacher schema=master

    public function findsubject($prof_level, $medium, $from, $user_id) {
        $result = $this->query("SELECT  schl_id, medium, sm.subject_code,  subject_name,  period
                        FROM master.shala_standard_medium_subject_xi_xii sm, master.shala_subject_jc sb 
                        WHERE schl_id='$user_id' 
                        and medium='$medium' 
                        and standard = '$from' 
                        and sm.subject_code=sb.subject_code");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

}
?>


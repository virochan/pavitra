<?php

class FindShalaarthRecordInfo extends AppModel {

    public $useDbConfig = 'default_db_shala';
    var $name = "FindShalaarthRecordInfo";
    var $useTable = 'shala_teacher'; //db=shala_live schema=schooldb

    public function get($udiseCd, $tchCd) {
        $query = "SELECT * FROM mst_dcps_emp  
        WHERE
        dcps_emp_id =  '" . $tchCd . "' 
        ";
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getUdiseTechEdit($udiseCd, $tchCd, $tchdob) {
        $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex, dob, caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar , tchcaste_desc, tchcat_desc, tchappstatus_desc
                FROM 
                udise.shala_teacher,
                master.shala_tchcaste,
                master.shala_tchcat,
                master.shala_tchappstatus
        WHERE
        udise.shala_teacher.caste  = master.shala_tchcaste.tchcaste_id            
        AND udise.shala_teacher.category  = master.shala_tchcat.tchcat_id   
        AND udise.shala_teacher.post_status  = CAST(master.shala_tchappstatus.tchappstatus_id as integer)    
        AND schcd= '" . $udiseCd . "' 
        AND tchcd = '" . $tchCd . "'
        AND dob = '" . $tchdob . "'
        AND ac_year = '2014-15'
                ";

        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getTecherData($schcd, $tchCd) {
        $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex, dob, caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar,tchcaste_desc
  FROM udise.shala_teacher,master.shala_tchcaste
WHERE
        shala_teacher.caste = shala_tchcaste.tchcaste_id      
        AND schcd= '" . $schcd . "' 
        AND tchcd = '" . $tchCd . "'
        AND ac_year = '2014-15'
        ";

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

}

?>
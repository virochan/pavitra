<?php

class FindUdiseRecordInfo extends AppModel {

    public $useDbConfig = 'default';
    var $name = "FindUdiseRecordInfo";
    var $useTable = 'shala_teacher'; //db=shala_live schema=schooldb

    public function get($udiseCd, $slno) {
        try{
          $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex, dob, caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar , tchcaste_desc, tchcat_desc, tchappstatus_desc,sanch_tch_id
                FROM 
                shala_live.shala_teacher,
                shala_live.shala_tchcaste,
                shala_live.shala_tchcat,
                shala_live.shala_tchappstatus
        WHERE
        shala_live.shala_teacher.caste  = shala_live.shala_tchcaste.tchcaste_id            
        AND shala_live.shala_teacher.category  = shala_live.shala_tchcat.tchcat_id   
        AND shala_live.shala_teacher.post_status  = CAST(shala_live.shala_tchappstatus.tchappstatus_id as integer)    
        AND schcd= '" . $udiseCd . "' 
        AND slno = " . $slno . "    
        AND ac_year = '2013-14'
        ";
//        echo "<br>".$query."<br>";exit();

        $result = $this->query($query);
        }
        catch(Exception $e)
        {
            echo "".$e;
        }
        if ($result != NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
        
    }

    //Fetch Udise Data after BEO Verfication
//    public function getUdiseData($udiseCd, $tchCd) {
//        $query =
//       "SELECT schcd, ac_year, tchcd, slno, tchname, sex, dob, caste, category, 
//       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
//       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
//       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
//       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
//       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
//       appointsub, stream, aadhaar , tchcaste_desc, tchcat_desc, tchappstatus_desc
//                FROM 
//                udise.shala_teacher,
//                master.shala_tchcaste,
//                master.shala_tchcat,
//                master.shala_tchappstatus
//        WHERE
//        udise.shala_teacher.caste  = master.shala_tchcaste.tchcaste_id            
//        AND udise.shala_teacher.category  = master.shala_tchcat.tchcat_id   
//        AND udise.shala_teacher.post_status  = CAST(master.shala_tchappstatus.tchappstatus_id as integer)    
//        AND schcd= '".$udiseCd."' 
//        AND tchcd = '".$tchCd."'
//        AND ac_year = '2014-15'
//        ";
//       
//        
//        
//        $result = $this->query($query);
//        if ($result <> NULL)
//            return $result;
//        else {
//            //$result=0;
//            return 0;
//        }
//    }

    public function getUdiseData($user_id, $tchr_cd_udise_master) {
        $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex, dob, caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar , tchcaste_desc, tchcat_desc, tchappstatus_desc,tchaqual_desc,tchaqual_id
                FROM 
                shala_live.shala_teacher,
                shala_live.shala_tchcaste,
                shala_live.shala_tchcat,
                shala_live.shala_tchappstatus,
                  shala_live.shala_tchaqual
        WHERE
        udise.shala_teacher.caste  = shala_live.shala_tchcaste.tchcaste_id            
        AND shala_live.shala_teacher.category  = shala_live.shala_tchcat.tchcat_id   
        AND shala_live.shala_teacher.post_status  = CAST(shala_live.shala_tchappstatus.tchappstatus_id as integer)    
        AND schcd= '" . $user_id . "' 
        AND tchcd = '" . $tchr_cd_udise_master . "'
        AND ac_year = '2013-14'
        ";



        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getUdiseTechEdit($tchr_mst_id, $tchr_cd_udise, $schl_cd_udisedob = '') {
        $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex, dob, caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar , tchcaste_desc, tchcat_desc, tchappstatus_desc
                FROM 
                shala_live.shala_teacher,
                shala_live.shala_tchcaste,
                shala_live.shala_tchcat,
                shala_live.shala_tchappstatus
        WHERE
        shala_live.shala_teacher.caste  = shala_live.shala_tchcaste.tchcaste_id            
        AND shala_live.shala_teacher.category  = shala_live.shala_tchcat.tchcat_id   
        AND shala_live.shala_teacher.post_status  = CAST(shala_live.shala_tchappstatus.tchappstatus_id as integer)    
        AND schcd= '" . $schl_cd_udisedob . "' 
        AND tchcd = '" . $tchr_cd_udise . "'
        AND ac_year = '2013-14'
                ";
        // AND dob = '".$tchdob."'
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
  FROM shala_live.shala_teacher,shala_live.shala_tchcaste
WHERE
        shala_teacher.caste = shala_tchcaste.tchcaste_id      
        AND schcd= '" . $schcd . "' 
        AND tchcd = '" . $tchCd . "'
        AND ac_year = '2013-14'
        ";

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getUdiseDataw($tchr_cd_udise_master, $sch_cd_udise_master) {
        $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex,caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar , tchcaste_desc, tchcat_desc, tchappstatus_desc,tchaqual_desc,tchaqual_id,dob AS date_of_br
                FROM 
                shala_live.shala_teacher,
                shala_live.shala_tchcaste,
                shala_live.shala_tchcat,
                shala_live.shala_tchappstatus,
                shala_live.shala_tchaqual
        WHERE
        shala_live.shala_teacher.caste  = shala_live.shala_tchcaste.tchcaste_id            
        AND shala_live.shala_teacher.category  = shala_live.shala_tchcat.tchcat_id   
        AND shala_live.shala_teacher.post_status  = CAST(shala_live.shala_tchappstatus.tchappstatus_id as integer)    
        AND schcd= '" . $tchr_cd_udise_master . "' 
        AND slno = '" . $sch_cd_udise_master . "'
        AND ac_year = '2013-14'
        ";



        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getUdiseDatafortchcombo($schl_id, $sanch_year, $tchr_slno='') {

        $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex, caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar , tchcaste_desc, tchcat_desc, tchappstatus_desc,tchaqual_desc,tchaqual_id,dob AS Date_of_br
                FROM 
                shala_live.shala_teacher
                JOIN
                shala_live.shala_tchcaste ON  shala_live.shala_teacher.caste  = shala_live.shala_tchcaste.tchcaste_id
                JOIN shala_live.shala_tchcat ON shala_live.shala_teacher.category  = shala_live.shala_tchcat.tchcat_id
                JOIN shala_live.shala_tchappstatus ON shala_live.shala_teacher.post_status  = CAST(shala_live.shala_tchappstatus.tchappstatus_id as integer)
                JOIN shala_live.shala_tchaqual ON shala_live.shala_teacher.qual_acad = shala_live.shala_tchaqual.tchaqual_id
        AND schcd= '" . $schl_id . "' 
        AND slno = '" . $tchr_slno . "'
        AND ac_year_udise = 2014 ";
       
//     echo  $query exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }
     public function  getUdiseDatafortchcombononslno($schl_id, $sanch_year){
       $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex, caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar , tchcaste_desc, tchcat_desc, tchappstatus_desc,tchaqual_desc,tchaqual_id,dob AS Date_of_br
                FROM 
                shala_live.shala_teacher
                JOIN
                shala_live.shala_tchcaste ON  shala_live.shala_teacher.caste  = shala_live.shala_tchcaste.tchcaste_id
                JOIN shala_live.shala_tchcat ON shala_live.shala_teacher.category  = shala_live.shala_tchcat.tchcat_id
                JOIN shala_live.shala_tchappstatus ON shala_live.shala_teacher.post_status  = CAST(shala_live.shala_tchappstatus.tchappstatus_id as integer)
                JOIN shala_live.shala_tchaqual ON shala_live.shala_teacher.qual_acad = shala_live.shala_tchaqual.tchaqual_id
        AND schcd= '" . $schl_id . "' 
        AND ac_year_udise = 2014 ";
       
//     echo  $query exit();
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
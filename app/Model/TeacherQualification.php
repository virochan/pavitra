<?php

class TeacherQualification extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "TeacherQualification";
    var $useTable = 'tchr_qual';

    function validation($data) {
        $errorString = '';

//          echo "<pre>".print_r($data,TRUE)."</pre>";exit();

        if ($data['hiddenqual'] == '') {
            $errorString.='<li style="padding-bottom: 5px;">Select Qualification Level.</li>';
        }
        if ($data['hiddendeg'] == '') {
            $errorString.='<li style="padding-bottom: 5px;">Select Examination/Degree.</li>';
        }
//        if($data['acad_qualification']['techr_year_pass'] == '' || $data['curryear'] == '' ){
//            $errorString.='<li style="padding-bottom: 5px;">Select Year.</li>';
//        }
        if ($data['acad_qualification']['techr_month_pass'] == '') {
            $errorString.='<li style="padding-bottom: 5px;">Select Month.</li>';
        }
        if ($data['acad_qualification']['techr_medium'] == '') {
            $errorString.='<li style="padding-bottom: 5px;">Select Medium.</li>';
        }
        if($data['acad_qualificationMainsubject']=='' ){
            $errorString.='<li style="padding-bottom: 5px;">Select Main Subject.</li>';
        }
        if ($data['acad_qualification']['techr_mark'] == '' && $data['acad_qualification']['techr_grade'] == '') {
            $errorString.='<li style="padding-bottom: 5px;">Enter Percentage or Grade.</li>';
        }

//       // if (trim($data['acad_qualification']['upload_cert_img']['name']) != '') {
//            $filename = $data['acad_qualification']['upload_cert_img']['name'];
//            $imageFileType = explode('.', $filename);
//            $filename = $data['acad_qualification']['upload_cert_img']['name'];
//
//            if ($this->fileUpload($filename, $imageFileType[1]) == 0) {
//                $errorString.='<li style="padding-bottom: 5px;">Invalid Certificate.</li>';
//            }
//        }


        return $errorString;
    }

    public function updatebyid($tid,$tchrsrilid, $recvdata, $filename, $curtm, $state, $board) {
        
        if (!empty($recvdata['acad_qualification']['Selecoptsub1'])) {
            $sub1 = $recvdata['acad_qualification']['Selecoptsub1'];
        } else {
            $sub1 = '0';
        }
        if (!empty($recvdata['acad_qualification']['Selecoptsub2'])) {
            $sub2 = $recvdata['acad_qualification']['Selecoptsub2'];
        } else {
            $sub2 = '0';
        } if (empty($recvdata['acad_qualification']['techr_mark'])) {
            $recvdata['acad_qualification']['techr_mark'] = '0';
        }

        if (isset($recvdata['acad_qualification']['techr_remark'])) {
            $remks = $recvdata['acad_qualification']['techr_remark'];
        } else {
            $remks = "";
        }
        $grade=trim($recvdata['acad_qualification']['techr_grade']);
        $grade=strtoupper($grade);
        $result = $this->query("update master.tchr_qual
                                    set tq_board_univ='" . $board . "',
                                    tq_pcnt='" . $recvdata['acad_qualification']['techr_mark'] . "',
                                    tq_pass_year='" . $recvdata['acad_qualification']['techr_year_pass'] . "', 
                                    tq_pass_month='" . $recvdata['acad_qualification']['techr_month_pass'] . "',
                                    tq_medium='" . $recvdata['acad_qualification']['techr_medium'] . "',
                                    tq_state_pass='" . $state . "',
                                    tq_grade='" . $grade . "',
                                    tq_maj_sub='" . $recvdata['acad_qualificationMainsubject'] . "',
                                    tq_min_sub1='" . $sub1 . "',    
                                    tq_min_sub2='" . $sub2 . "',
                                    tq_othr_sub='" . $recvdata['acad_qualification']['techr_othersub'] . "',
                                    tq_remarks='" . $remks . "',  
                                    verif_flag='E',
                                    upd_dtts='" . $curtm . "',
                                    tq_cert_loaded='Y',
                                    tq_cert_fname='" . $filename . "'
                                    where id='" . $tchrsrilid . "'
                                    and tq_qual_lvl='" . $recvdata['hiddenqual'] . "'
                                    and tq_degree='" . $recvdata['hiddendeg'] . "'");



        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function updatebyidnew($tid,$tchrsrilid, $recvdata, $filename, $curtm, $state, $board,$sid) {
        
        if (!empty($recvdata['acad_qualification']['Selecoptsub1'])) {
            $sub1 = $recvdata['acad_qualification']['Selecoptsub1'];
        } else {
            $sub1 = '0';
        }
        if (!empty($recvdata['acad_qualification']['Selecoptsub2'])) {
            $sub2 = $recvdata['acad_qualification']['Selecoptsub2'];
        } else {
            $sub2 = '0';
        } if (empty($recvdata['acad_qualification']['techr_mark'])) {
            $recvdata['acad_qualification']['techr_mark'] = '0';
        }

        if (isset($recvdata['acad_qualification']['techr_remark'])) {
            $remks = $recvdata['acad_qualification']['techr_remark'];
        } else {
            $remks = "";
        }
        $grade=trim($recvdata['acad_qualification']['techr_grade']);
        $grade=strtoupper($grade);
        $result = $this->query("update master.tchr_qual
                                    set tq_board_univ='" . $board . "',
                                    tq_pcnt='" . $recvdata['acad_qualification']['techr_mark'] . "',
                                    tq_pass_year='" . $recvdata['acad_qualification']['techr_year_pass'] . "', 
                                    tq_pass_month='" . $recvdata['acad_qualification']['techr_month_pass'] . "',
                                    tq_medium='" . $recvdata['acad_qualification']['techr_medium'] . "',
                                    tq_state_pass='" . $state . "',
                                    tq_grade='" . $grade . "',
                                    tq_maj_sub='" . $recvdata['acad_qualificationMainsubject'] . "',
                                    tq_min_sub1='" . $sub1 . "',    
                                    tq_min_sub2='" . $sub2 . "',
                                    tq_othr_sub='" . $recvdata['acad_qualification']['techr_othersub'] . "',
                                    tq_remarks='" . $remks . "',  
                                    verif_flag='E',
                                    srlid=".$sid.",
                                    upd_dtts='" . $curtm . "',
                                    tq_cert_loaded='Y',
                                    tq_cert_fname='" . $filename . "'
                                    where id='" . $tchrsrilid . "'
                                    and tq_qual_lvl='" . $recvdata['hiddenqual'] . "'
                                    and tq_degree='" . $recvdata['hiddendeg'] . "'");



        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }
    public function insertbyid($recvdata, $filename, $curtm, $state, $board, $qlytyp, $schcode,$sid) {
        $grade=trim($recvdata['acad_qualification']['techr_grade']);
        $grade=strtoupper($grade);
     
        if (!empty($recvdata['acad_qualificationSelecoptsub1'])) {
            $sub1 = $recvdata['acad_qualificationSelecoptsub1'];
        } else {
            $sub1 = '0';
        }
        if (!empty($recvdata['acad_qualificationSelecoptsub2'])) {
            $sub2 = $recvdata['acad_qualificationSelecoptsub2'];
        } else {
            $sub2 = '0';
        }if (empty($recvdata['acad_qualification']['techr_mark'])) {
            $recvdata['acad_qualification']['techr_mark'] = '0';
        }
        if($qlytyp=='A'){
             $result = $this->query("INSERT INTO master.tchr_qual (tchr_id,tq_qual_lvl,tq_degree,tq_board_univ,tq_medium,tq_state_pass,tq_pass_month,tq_pass_year,tq_pcnt,tq_grade,tq_maj_sub,tq_min_sub1,tq_min_sub2,tq_othr_sub,tq_remarks,tq_cert_fname,verif_flag,entry_dtts,upd_dtts,tq_cert_loaded,tq_qual_type,asst_auth,high_qual,srlid) VALUES  ('" . $recvdata['tchr_id'] . "','" . $recvdata['acad_qualification']['SelectedAcadQual'] . "','" . $recvdata['acad_qualificationTechrExam'] . "','" . $board . "','" . $recvdata['acad_qualification']['techr_medium'] . "','" . $state . "','" . $recvdata['acad_qualification']['techr_month_pass'] . "','" . $recvdata['acad_qualification']['techr_year_pass'] . "','" . $recvdata['acad_qualification']['techr_mark'] . "','" . $recvdata['acad_qualification']['techr_grade'] . "','" . $recvdata['acad_qualificationMainsubject'] . "','" . $sub1 . "','" . $sub2 . "','" . $recvdata['acad_qualification']['techr_othersub'] . "','" . $grade . "','" . $filename . "','E','" . $curtm . "','" . $curtm . "','Y','" . $qlytyp . "','" . $schcode . "','" .  $recvdata['acad_qualification']['HighQual'] . "',".$sid.")");
        }else{
            $result = $this->query("INSERT INTO master.tchr_qual (tchr_id,tq_qual_lvl,tq_degree,tq_board_univ,tq_medium,tq_state_pass,tq_pass_month,tq_pass_year,tq_pcnt,tq_grade,tq_maj_sub,tq_min_sub1,tq_min_sub2,tq_othr_sub,tq_remarks,tq_cert_fname,verif_flag,entry_dtts,upd_dtts,tq_cert_loaded,tq_qual_type,asst_auth,srlid) VALUES  ('" . $recvdata['tchr_id'] . "','" . $recvdata['acad_qualification']['SelectedAcadQual'] . "','" . $recvdata['acad_qualificationTechrExam'] . "','" . $board . "','" . $recvdata['acad_qualification']['techr_medium'] . "','" . $state . "','" . $recvdata['acad_qualification']['techr_month_pass'] . "','" . $recvdata['acad_qualification']['techr_year_pass'] . "','" . $recvdata['acad_qualification']['techr_mark'] . "','" . $grade . "','" . $recvdata['acad_qualificationMainsubject'] . "','" . $sub1 . "','" . $sub2 . "','" . $recvdata['acad_qualification']['techr_othersub'] . "','" . $recvdata['acad_qualification']['techr_remark'] . "','" . $filename . "','E','" . $curtm . "','" . $curtm . "','Y','" . $qlytyp . "','" . $schcode . "',".$sid.")");
        }

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function updatephbyid($tchrsrilid, $recvdata, $curtm, $imgflg, $state, $board) {
        if (!empty($recvdata['acad_qualification']['Selecoptsub1'])) {
            $sub1 = $recvdata['acad_qualification']['Selecoptsub1'];
        } else {
            $sub1 = '0';
        }
        if (!empty($recvdata['acad_qualification']['Selecoptsub2'])) {
            $sub2 = $recvdata['acad_qualification']['Selecoptsub2'];
        } else {
            $sub2 = '0';
        }if (empty($recvdata['acad_qualification']['techr_mark'])) {
            $recvdata['acad_qualification']['techr_mark'] = '0';
        }

        if (isset($recvdata['acad_qualification']['techr_remark'])) {
            $remks = $recvdata['acad_qualification']['techr_remark'];
        } else {
            $remks = "";
        }
         $grade=trim($recvdata['acad_qualification']['techr_grade']);
        $grade=strtoupper($grade);
        $result = $this->query("update master.tchr_qual
                                        set tq_board_univ='" . $board . "',
                                        tq_medium='" . $recvdata['acad_qualification']['techr_medium'] . "',  
                                        tq_pass_year='" . $recvdata['acad_qualification']['techr_year_pass'] . "', 
                                        tq_pass_month='" . $recvdata['acad_qualification']['techr_month_pass'] . "',
                                        tq_state_pass='" . $state . "',
                                        tq_pcnt='" . $recvdata['acad_qualification']['techr_mark'] . "',    
                                        tq_grade='" . $grade . "',
                                        tq_maj_sub='" . $recvdata['acad_qualificationMainsubject'] . "',
                                        tq_min_sub1='" . $sub1 . "',    
                                        tq_min_sub2='" . $sub2 . "',
                                        tq_othr_sub='" . $recvdata['acad_qualification']['techr_othersub'] . "',
                                        tq_remarks='" . $remks . "',
                                        verif_flag='E',
                                        upd_dtts='" . $curtm . "',
                                        tq_cert_loaded='" . $imgflg . "'
                                        where id='" . $tchrsrilid . "'
                                        and tq_qual_lvl='" . $recvdata['hiddenqual'] . "'
                                        and tq_degree='" . $recvdata['hiddendeg'] . "'");

        if ($result <> NULL) {

            return $result;
        } else {

            return 0;
        }
    }

    public function insertphbyid($recvdata, $curtm, $state, $board, $qlytyp, $schcode,$sid) {

           $grade=trim($recvdata['acad_qualification']['techr_grade']);
        $grade=strtoupper($grade);
        
        if (!empty($recvdata['acad_qualificationSelecoptsub1'])) {
            $sub1 = $recvdata['acad_qualificationSelecoptsub1'];
        } else {
            $sub1 = '0';
        }
        if (!empty($recvdata['acad_qualificationSelecoptsub2'])) {
            $sub2 = $recvdata['acad_qualificationSelecoptsub2'];
        } else {
            $sub2 = '0';
        }
        if (isset($recvdata['acad_qualification']['SelectedAcadQual']) && $recvdata['acad_qualification']['SelectedAcadQual'] != '') {
            $recvdata['acad_qualification']['SelectedAcadQual'] = $recvdata['acad_qualification']['SelectedAcadQual'];
        } else {
            $recvdata['acad_qualification']['SelectedAcadQual'] = '';
        }
        if (isset($recvdata['acad_qualificationTechrExam']) && $recvdata['acad_qualificationTechrExam'] != '') {
            $recvdata['acad_qualificationTechrExam'] = $recvdata['acad_qualificationTechrExam'];
        } else {
            $recvdata['acad_qualificationTechrExam'] = '';
        }
        if (empty($recvdata['acad_qualification']['techr_mark'])) {
            $recvdata['acad_qualification']['techr_mark'] = '0';
        }
        if($qlytyp=='A'){
       $result = $this->query("INSERT INTO tchr_qual (tchr_id,tq_qual_lvl,tq_degree,tq_board_univ,tq_medium,tq_state_pass,tq_pass_month,tq_pass_year,tq_pcnt,tq_grade,tq_maj_sub,tq_min_sub1,tq_min_sub2,tq_othr_sub,tq_remarks,verif_flag,entry_dtts,upd_dtts,tq_cert_loaded,tq_qual_type,asst_auth,high_qual,srlid) VALUES  ('" . $recvdata['tchr_id'] . "','" . $recvdata['acad_qualification']['SelectedAcadQual'] . "','" . $recvdata['acad_qualificationTechrExam'] . "','" . $board . "','" . $recvdata['acad_qualification']['techr_medium'] . "','" . $state . "','" . $recvdata['acad_qualification']['techr_month_pass'] . "','" . $recvdata['acad_qualification']['techr_year_pass'] . "','" . $recvdata['acad_qualification']['techr_mark'] . "','" . $grade. "','" . $recvdata['acad_qualificationMainsubject'] . "','" . $sub1 . "','" . $sub2 . "','" . $recvdata['acad_qualification']['techr_othersub'] . "','" . $recvdata['acad_qualification']['techr_remark'] . "','E','" . $curtm . "','" . $curtm . "','N','" . $qlytyp . "','" . $schcode . "','".$recvdata['acad_qualification']['HighQual']."',".$sid.")");
        }else{
          $result = $this->query("INSERT INTO tchr_qual (tchr_id,tq_qual_lvl,tq_degree,tq_board_univ,tq_medium,tq_state_pass,tq_pass_month,tq_pass_year,tq_pcnt,tq_grade,tq_maj_sub,tq_min_sub1,tq_min_sub2,tq_othr_sub,tq_remarks,verif_flag,entry_dtts,upd_dtts,tq_cert_loaded,tq_qual_type,asst_auth,srlid) VALUES  ('" . $recvdata['tchr_id'] . "','" . $recvdata['acad_qualification']['SelectedAcadQual'] . "','" . $recvdata['acad_qualificationTechrExam'] . "','" . $board . "','" . $recvdata['acad_qualification']['techr_medium'] . "','" . $state . "','" . $recvdata['acad_qualification']['techr_month_pass'] . "','" . $recvdata['acad_qualification']['techr_year_pass'] . "','" . $recvdata['acad_qualification']['techr_mark'] . "','" . $grade . "','" . $recvdata['acad_qualificationMainsubject'] . "','" . $sub1 . "','" . $sub2 . "','" . $recvdata['acad_qualification']['techr_othersub'] . "','" . $recvdata['acad_qualification']['techr_remark'] . "','E','" . $curtm . "','" . $curtm . "','N','" . $qlytyp . "','" . $schcode . "',".$sid.")");   
        }

        
      
        if ($result == NULL) {

            return $result;
        } else {

            return 0;
        }
    }

    public function acadmictechrlist($sclid) {

        $result = $this->query("select * from master.tch_master tm,master.tchr_qual tp where tm.tchr_id=tp.tchr_id AND tm.schl_id = '" . $sclid . "' AND tp.verif_flag='E' AND tq_cert_fname !='null'");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function academicforwrdtechrlist($sid) {

        $result = $this->query("select tm.tchr_id,tm.tchr_fname,tm.tchr_mname,tm.tchr_lname from master.tch_master tm,master.tchr_qual tp where tm.tchr_id=tp.tchr_id AND tp.verif_flag='F' AND (tm.schl_cd_shalarath='" . $sid . "' OR tm.schl_cd_udise='" . $sid . "')");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getschcode() {

        $schcodeudise = $this->query("SELECT asst_auth FROM  master.tchr_qual where verif_flag='F';");
        return( $schcodeudise);
    }

    public function deleteacadrecord($srid) {
//        echo $srid;
//       exit();
        $schcodeudise = $this->query("delete from  master.tchr_qual where id='" . $srid . "'");

        return( $schcodeudise);
    }

    function fileUpload($name, $type) {
        $uploadOk = 1;
        $newFileName = NULL;
        if (isset($name) && !empty($name)) {
            if (isset($type) && $type != '') {
                if ($type != "jpg" && $type != "png" && $type != "jpeg") {
                    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                    $uploadOk = 0;
                }
            }
        } else {
            $uploadOk = 1;
        }
        return $uploadOk;
    }

//    public function checkAcadQualificationDtlFowardCondition($schcd, $tchr_id) {
//        try {
////            tchr_qual.tchr_id,tchr_qual.tq_qual_type,tchr_qual.tq_qual_lvl,tchr_qual.verif_flag,tchr_qual.tq_cert_fname
//
//            $query = "SELECT tchr_qual.tchr_id,tchr_qual.tq_qual_type,tchr_qual.tq_qual_lvl,tchr_qual.tq_degree,tchr_qual.tq_maj_sub 
//                FROM master.tch_master,master.tchr_qual,master.tchr_entry_status
//                where 
//                    tch_master.tchr_id = tchr_entry_status.tchr_id
//                AND tch_master.tchr_id = tchr_qual.tchr_id
//                AND tch_master.schl_id='" . $schcd . "' 
//                AND tch_master.tchr_id='" . $tchr_id . "'
//                AND tchr_qual.verif_flag = 'E'
//                AND tchr_qual.tq_cert_fname is not null
//                AND tchr_qual.tq_qual_type = 'A'
//                AND tchr_entry_status.de_acd_qual = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
//           
////            echo "" . $query;
////            exit();
//
//            $result = $this->query($query);
//
//            if ($result <> NULL) {
//                return $result;
//            } else {
//                return 0;
//            }
//        } catch (Exception $e) {
//            return 0;
//        }
//    }
    
     public function checkAcadQualificationDtlFowardCondition($schcd, $tchr_id) {
        try {
//            tchr_qual.tchr_id,tchr_qual.tq_qual_type,tchr_qual.tq_qual_lvl,tchr_qual.verif_flag,tchr_qual.tq_cert_fname

            $query = "SELECT tchr_qual.tchr_id,tchr_qual.tq_qual_type,tchr_qual.tq_qual_lvl,tchr_qual.tq_degree,tchr_qual.tq_maj_sub 
                FROM master.tch_master,master.tchr_qual,master.tchr_entry_status
                where 
                    tch_master.tchr_id = tchr_entry_status.tchr_id
                AND tch_master.tchr_id = tchr_qual.tchr_id
                AND tch_master.schl_id='" . $schcd . "' 
                AND tch_master.tchr_id='" . $tchr_id . "'
                AND tchr_qual.verif_flag = 'E'
                AND tchr_qual.tq_qual_type = 'A'
                AND tchr_entry_status.de_acd_qual = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
           
//            echo "" . $query;
//            exit();

            $result = $this->query($query);

            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }
    
    public function checkProfQualificationDtlFowardCondition($schcd, $tchr_id) {
        try {
//            tchr_qual.tchr_id,tchr_qual.tq_qual_type,tchr_qual.tq_qual_lvl,tchr_qual.verif_flag,tchr_qual.tq_cert_fname
 
            $query = "SELECT tchr_qual.tchr_id,tchr_qual.tq_qual_type,tchr_qual.tq_qual_lvl,tchr_qual.tq_degree,tchr_qual.tq_maj_sub 
                FROM master.tch_master,master.tchr_qual,master.tchr_entry_status
                where 
                    tch_master.tchr_id = tchr_entry_status.tchr_id
                AND tch_master.tchr_id = tchr_qual.tchr_id
                AND tch_master.schl_id='" . $schcd . "' 
                AND tch_master.tchr_id='" . $tchr_id . "'
                AND tchr_qual.verif_flag = 'E'
                AND tchr_qual.tq_qual_type = 'P'
                AND tchr_entry_status.de_prof_qual = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
           
//            echo "" . $query;
//            exit();

            $result = $this->query($query);

            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }
    
//    public function checkProfQualificationDtlFowardCondition($schcd, $tchr_id) {
//        try {
////            tchr_qual.tchr_id,tchr_qual.tq_qual_type,tchr_qual.tq_qual_lvl,tchr_qual.verif_flag,tchr_qual.tq_cert_fname
// 
//            $query = "SELECT tchr_qual.tchr_id,tchr_qual.tq_qual_type,tchr_qual.tq_qual_lvl,tchr_qual.tq_degree,tchr_qual.tq_maj_sub 
//                FROM master.tch_master,master.tchr_qual,master.tchr_entry_status
//                where 
//                    tch_master.tchr_id = tchr_entry_status.tchr_id
//                AND tch_master.tchr_id = tchr_qual.tchr_id
//                AND tch_master.schl_id='" . $schcd . "' 
//                AND tch_master.tchr_id='" . $tchr_id . "'
//                AND tchr_qual.verif_flag = 'E'
//                AND tchr_qual.tq_cert_fname is not null
//                AND tchr_qual.tq_qual_type = 'P'
//                AND tchr_entry_status.de_prof_qual = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
//           
////            echo "" . $query;
////            exit();
//
//            $result = $this->query($query);
//
//            if ($result <> NULL) {
//                return $result;
//            } else {
//                return 0;
//            }
//        } catch (Exception $e) {
//            return 0;
//        }
//    }

}

?>
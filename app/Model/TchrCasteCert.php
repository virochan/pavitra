<?php

class TchrCasteCert extends AppModel {

    var $name = 'TchrCasteCert';
    public $useDbConfig = 'use_db_Tech_master';
    public $useTable = 'tchr_caste_cert';  //db=Teacher schema=master

    function validation($data) {
        $errorString = '';
        $currentDate = date("d/m/Y");
        if (isset($data['addperdtl'])) {
            $data = $data['addperdtl'];

            /* if (empty($data['ta_caste'])) { 
              $errorString.='<li style="padding-bottom: 5px;">Select Caste.</li>';
              } */
            if (@$data['tc_categ'] != 1 && $data['asst_cst_flag'] != 'V') {
//                if ($this->isEmpty(trim($data['tc_religion'])) == '') {
//                    $errorString.='<li>Select Religion.</li>';
//                }
//                if ($this->isEmpty(trim($data['tc_categ'])) == '') {
//                    $errorString.='<li>Select Category .</li>';
//                }
//                if ($this->isEmpty(trim($data['tc_caste'])) == '') {
//                    $errorString.='<li>Select Caste .</li>';
//                }
//                if ($this->isEmpty(trim($data['cernumber'])) == '') {
//                    $errorString.='<li style="padding-bottom: 5px;">Fill Certificate No.</li>';
//                } else if (!preg_match($certificate_number, $data['cernumber'])) {
//                    $errorString.='<li style="padding-bottom: 5px;">Invalid Certificate No.</li>';
//                }
//                if ($this->isEmpty(trim($data['cer_date'])) == '') {
//                    $errorString.='<li style="padding-bottom: 5px;">Fill Certificate Date.</li>';
//                } else if ((($this->validateDate($data['cer_date'])) == 0)) {
//                    $errorString.='<li>Invalid Certificate Date.</li>';
//                }
////              else if (($this->DateGreater($data['cer_date'], $tchrbdate)) == 1) {
////                    $errorString.='<li>Certificate Date Can not be Smaller Than Teachers Birth Date.</li>';
////              }
//                else if (($this->DateGreater($currentDate, $data['cer_date'])) == 1) {
//                    $errorString.='<li style="padding-bottom: 5px;">Certificate Date Greater Than Current Date</li>';
//                }
//                if ($this->isEmpty(trim($data['issu_auth'])) == '') {
//                    $errorString.='<li style="padding-bottom: 5px;">Select Certificate Issuing Authority .</li>';
//                }
//                if ($this->isEmpty(trim($data['place'])) == '') {
//                    $errorString.='<li style="padding-bottom: 5px;">Fill Certificate Place   .</li>';
//                }

                if (isset($data['pdf_path']['name']) && trim($data['pdf_path']['name']) != '') {
                    $filename = $data['pdf_path']['name'];
                    $imageFileType = explode('.', $filename);
                    $filename = $data['pdf_path']['name'];

                    if ($this->fileUpload($filename, $imageFileType[1]) == 0) {
                        $errorString.='<li style="padding-bottom: 5px;">Invalid Certificate Type.</li>';
                    }
                }
                if (isset($data['uplod_cer_val']['name']) && trim($data['uplod_cer_val']['name']) != '') {
                    $filename = $data['uplod_cer_val']['name'];
                    $imageFileType = explode('.', $filename);
                    $filename = $data['uplod_cer_val']['name'];

                    if ($this->fileUpload($filename, $imageFileType[1]) == 0) {
                        $errorString.='<li style="padding-bottom: 5px;">Invalid  Certificate Validation Type.</li>';
                    }
                }
                /* else
                  if ($this->alphabets($data['place'])==0) {
                  $errorString.='<li style="padding-bottom: 5px;">Enter Valid Certificate Place</li>';
                  }
                  if ($this->alphaNumericDashUnderscore($data['remarks'])==0) {
                  $errorString.='<li style="padding-bottom: 5px;">Enter Valid Certificate Remarks</li>';
                  }
                  if (empty($data['cer_val_no'])) {
                  $errorString.='<li style="padding-bottom: 5px;">Fill Certificate Validation No.</li>';
                  }
                  if (empty($data['cer_val_date'])) {
                  $errorString.='<li style="padding-bottom: 5px;">Fill Certificate Validation Date.</li>';
                  }else
                  if (!($this->validateDate($data['cer_val_date']))) {
                  $errorString.='<li style="padding-bottom: 5px;">Invalid Certificate Validation Date .</li>';
                  }else
                  if ($this->CompaireTwoDate($data['cer_val_date'],$currentDate)) {
                  $errorString.='<li style="padding-bottom: 5px;">Certificate date greater than current</li>';
                  }else
                  if ($this->CompaireTwoDate($data['cer_date'],$data['cer_val_date'])) {
                  $errorString.='<li style="padding-bottom: 5px;">Certificate validation date should not be greater than cert date</li>';
                  }
                  if (empty($data['val_iss_auth'])) {
                  $errorString.='<li style="padding-bottom: 5px;">Select Certificate Validation Issuing Authority .</li>';
                  }
                  if (empty($data['tech_place'])) {
                  $errorString.='<li style="padding-bottom: 5px;">Fill Certificate Validation Place   .</li>';
                  }else
                  if ($this->alphabets($data['tech_place'])==0) {
                  $errorString.='<li style="padding-bottom: 5px;">Enter Valid Certificate Validation Place</li>';
                  }
                  /* if ($this->alphaNumericDashUnderscore($data['tech_remarks'])==0) {
                  $errorString.='<li style="padding-bottom: 5px;">Enter Valid Certificate Validation Remarks</li>';
                  } */
            }
        }

        //echo "<pre>"; echo $data['tchrid'];
        // else {	echo "Correct";}
        return $errorString;
    }

    function validateDate($check) {
        $pattern = "/(((0|1)[1-9]|2[1-9]|3[0-1])\/(0[1-9]|1[1-2])\/((19|20)\d\d))$/";
        $result = preg_match($pattern, $check);
        return $result;
    }

    function validatePanNo($check) {
        $pattern = "/^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/";
        $result = preg_match($pattern, $check);
        return $result;
    }

    function validateAccNo($check) {
        $pattern = "/^([0-9]{6})$/";
        $result = preg_match($pattern, $check);
        return $result;
    }

    function alphabets($check) {
        $result = preg_match('|^[a-zA-Z]*$|', $check);
        return $result;
    }

    function isEmpty($check) {
//        echo "check==".$check;exit();
        if ($check == '') {
            $result = 0;
        } else {
            $result = 1;
        }

        return $result;
    }

    function DateGreater($date1, $date2) {
        $date1 = split("\/", $date1);
        $date1 = $date1[0] . '-' . $date1[1] . '-' . $date1[2];
        $date1 = date('Ymd', strtotime($date1));

        $date2 = split("\/", $date2);
        $date2 = $date2[0] . '-' . $date2[1] . '-' . $date2[2];
        $date2 = date('Ymd', strtotime($date2));

        if ($date1 > $date2) {// || $date1 == $date2) {
            $result = 0;
        } else {
            $result = 1;
        }
        return $result;
    }

    function comparedates($maxr, $minr) {
        if ($maxr > $minr) {
            return true;
        } else {
            return false;
        }
    }

    function CompaireTwoDate1($tchr_serv_entry_dt, $tchr_curr_desig_dt) {
        $tchr_serv_entry_dt = split("\/", $tchr_serv_entry_dt);
        @$tchr_serv_entry_dt = $tchr_serv_entry_dt[0] . '-' . $tchr_serv_entry_dt[1] . '-' . $tchr_serv_entry_dt[2];
        $tchr_serv_entry_dt = date('mdY', strtotime($tchr_serv_entry_dt));

        $tchr_curr_desig_dt = split("\/", $tchr_curr_desig_dt);
        $tchr_curr_desig_dt = $tchr_curr_desig_dt[0] . '-' . $tchr_curr_desig_dt[1] . '-' . $tchr_curr_desig_dt[2];
        $tchr_curr_desig_dt = date('mdY', strtotime($tchr_curr_desig_dt));

        if (isset($tchr_serv_entry_dt) && isset($tchr_curr_desig_dt)) {
            if ($tchr_serv_entry_dt > $tchr_curr_desig_dt) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function CompaireTwoDate($tchr_serv_entry_dt, $tchr_curr_desig_dt) {
        $tchr_serv_entry_dt = split("\/", $tchr_serv_entry_dt);
        $tchr_curr_desig_dt = split("\/", $tchr_curr_desig_dt);

        if (isset($tchr_serv_entry_dt) && isset($tchr_curr_desig_dt)) {
            if (@($tchr_serv_entry_dt[0] > $tchr_curr_desig_dt[0]) && @($tchr_serv_entry_dt[1] > $tchr_curr_desig_dt[1]) && @($tchr_serv_entry_dt[2] > $tchr_curr_desig_dt[2])) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function alphaNumericDashUnderscore($check) {
        $result = preg_match('|^[a-zA-Z0-9()./]*$|', $check);
        return $result;
    }

    public function addperdtlteachers($schcd) {
        $schcodeudise = $this->query("SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND tch_master.schl_id='$schcd' AND tch_master.tchr_type='1' AND asst_flag='V' ORDER BY tchr_lname ");
        return( $schcodeudise);
    }

    public function addperdtl_non_teacher($schcd) {
        $schcodeudise = $this->query("SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND tch_master.schl_id='$schcd' AND tch_master.tchr_type='2' AND asst_flag='V' ORDER BY tchr_lname ");
        return( $schcodeudise);
    }

    public function forward_teacher_nonteacher($schcd) {
        $schcodeudise = $this->query("SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,schl_id,asst_flag,  tc_religion, tc_categ, tc_caste, tc_sub_castse, tc_cert_no, tc_cert_dt, tc_cert_auth, tc_cert_place, tc_cert_fname, tc_remarks, entry_dtts, asst_cst_auth, asst_cst_flag, supv_cst_auth, verif_cst_dtts, tc_cert_vld_no, tc_cert_vld_dt, tc_cert_vld_auth, tc_cert_vld_place, tc_cert_vld_fname, tc_vld_remarks, asst_cert_auth, asst_cert_flag,  supv_cert_auth, verif_cert_dtts 
                                            FROM master.tch_master m
                                            INNER JOIN master.tchr_caste_cert certm ON m.tchr_id = certm.tchr_id 
                                            where certm.asst_cst_flag = 'E' and m.schl_id = '" . $schcd . "'
                                             and certm.tc_caste is not null     
                                            and tc_categ!='1' order by m.tchr_lname");
        return $schcodeudise;
    }

    public function forward_valcert_dtls($schcd) {
        $schcodeudise = $this->query("SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,schl_id,asst_flag,tc_cert_vld_no,tc_cert_vld_dt, tc_cert_vld_auth, tc_cert_vld_place, tc_cert_vld_fname, tc_vld_remarks, asst_cert_auth, asst_cert_flag,  supv_cert_auth, verif_cert_dtts FROM master.tch_master m INNER JOIN master.tchr_caste_cert certm ON m.tchr_id = certm.tchr_id 
                where  certm.asst_cert_flag = 'E' and tc_categ!='1' and m.schl_id = '" . $schcd . "' order by m.tchr_lname");

        return $schcodeudise;
    }

    public function getschcode() {
        $schcodeudise = $this->query("SELECT asst_cst_auth FROM  master.tchr_caste_cert where asst_cst_flag='F';");
        // echo "SELECT asst_cert_auth FROM  master.tchr_caste_cert where asst_cst_flag='F';";
        return( $schcodeudise);
    }

    public function get_cert_schcode() {
        $schcodeudise = $this->query("SELECT asst_cert_auth FROM  master.tchr_caste_cert where asst_cert_flag='F' and asst_cst_flag='V';");
        return( $schcodeudise);
    }

    public function forwardcasteteacherlist($schcd) {
        $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND tch_master.schl_id='$schcd' AND tchr_caste_cert.asst_cst_flag='F'  ");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function certificateteacherlist($schcd) {
        $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND tch_master.schl_id='$schcd' AND tchr_caste_cert.asst_cert_flag='F'  ");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function findtchr($schlcd, $tid) {
        $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND tch_master.schl_id='$schlcd' AND tchr_caste_cert.tchr_id='$tid' AND tchr_caste_cert.asst_cst_flag='F' order by tchr_caste_cert.tchr_id asc");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function entire_verify($tid) {
        $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND  tchr_caste_cert.tchr_id='$tid' AND tchr_caste_cert.asst_cst_flag='F' order by tchr_caste_cert.tchr_id asc");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function entire_verify_caste_cluster($tid) {
        $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND  tchr_caste_cert.tchr_id='$tid' AND tchr_caste_cert.asst_cst_flag IN('F','R','V') order by tchr_caste_cert.tchr_id asc");
//echo "SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND  tchr_caste_cert.tchr_id='$tid' AND tchr_caste_cert.asst_cst_flag IN('F','R','V')  order by tchr_caste_cert.tchr_id asc ";
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function findcertifctetchr($schlcd, $tid) {
        try {
            $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  FROM master.tch_master JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id AND tch_master.schl_id='$schlcd' AND tchr_caste_cert.tchr_id='$tid' AND tchr_caste_cert.asst_cert_flag='F' order by tchr_caste_cert.tchr_id asc");
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }
//
    public function categry_tchr_list($schl_id,$tchr_type) {

        $qry="SELECT tchr_caste_cert.*,tch_master.*  
                            FROM master.tch_master 
                            JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id 
                            AND tch_master.schl_id= '$schl_id' 
                            AND tch_master.tchr_type=$tchr_type
                            ORDER BY tchr_lname";
        $res = $this->query($qry);
       
        if ($res <> NULL) {
            return $res;
            
        } else {
            return 0;
        }
    }


    public function categry_tchr_list_both($schl_id) {
        $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  
                        FROM master.tch_master 
                        JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id 
                        AND tch_master.schl_id= '$schl_id'
                        ORDER BY tchr_lname ");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function categry_school_tchr_list($schl_id, $tchr_type) {
        $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  
                        FROM master.tch_master 
                        JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id 
                        AND tch_master.schl_id= '$schl_id' 
                        AND tch_master.tchr_type=$tchr_type
                        ORDER BY tch_master.tchr_fname ");


        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function school_tchr_list($schl_id) {
        $result = $this->query("SELECT tchr_caste_cert.*,tch_master.*  
FROM master.tch_master 
JOIN master.tchr_caste_cert ON tch_master.tchr_id = tchr_caste_cert.tchr_id 
AND tch_master.schl_id= '$schl_id' 
ORDER BY tch_master.tchr_id ");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
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

    public function rqstrtntchrscst($tchrid) {

        $qry = "select tm.tchr_id,tc_religion,tc_categ,tc_caste,
            tc_cert_no ,tchr_fname,tchr_mname,tchr_lname,tc_remarks
            from master.tchr_caste_cert tc,master.tch_master tm
            where asst_cst_flag='V' and 
            tc.tchr_id='" . $tchrid . "'
            and tc.tchr_id=tm.tchr_id order by tchr_id";

        $res = $this->query($qry);

        return $res;
    }

    public function rtntchrscst($tchrid) {

        $qry = "select tm.tchr_id,tc_religion,tc_categ,tc_caste,
            tc_cert_no ,tchr_fname,tchr_mname,tchr_lname,tc_remarks
            from master.tchr_caste_cert tc,master.tch_master tm
            where asst_cst_flag='T' and 
            tc.tchr_id='" . $tchrid . "'
            and tc.tchr_id=tm.tchr_id order by tchr_id";

        $res = $this->query($qry);

        return $res;
    }

    public function getrtnflag() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM  master.tchr_caste_cert tc,master.tch_master tm
                            where tc.asst_cst_flag='T'
                            and tc.tchr_id=tm.tchr_id");

        return($flag);
    }

    public function getrtnflagvld() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM  master.tchr_caste_cert tc,master.tch_master tm
                            where tc.asst_cert_flag='T'
                            and tc.tchr_id=tm.tchr_id");

        return($flag);
    }
//      public function checkCasteFowardCondition($schcd, $tchr_id) {
//        try {
////            tchr_caste_cert.tchr_id,tchr_caste_cert.tc_categ,tchr_caste_cert.asst_cst_flag,tchr_caste_cert.tc_cert_fname,
//            $query = "SELECT tchr_caste_cert.tchr_id,
//                    CASE WHEN tchr_caste_cert.tc_categ !=1 THEN tc_cert_fname is not null 
//                    ELSE tc_cert_fname is null END as caste_flag
//                    FROM master.tch_master,master.tchr_caste_cert,master.tchr_entry_status
//                    where 
//                    tch_master.schl_id = tchr_entry_status.schl_id 
//                    AND tch_master.tchr_id = tchr_entry_status.tchr_id 
//                   AND tch_master.tchr_id = tchr_caste_cert.tchr_id 
//                   AND tch_master.schl_id='" . $schcd . "' 
//                    AND tch_master.tchr_id='" . $tchr_id . "'
//                    AND tchr_caste_cert.asst_cst_flag = 'E'
//                    AND tchr_entry_status.de_caste = 'Y'
//               "; // posttype 1=Teaching 2=Non-Teaching
////            echo "" . $query;
//            $result = $this->query($query);
//
//            if ($result != NULL) {
//                if (isset($result[0][0]['caste_flag'])) {
//                    if ($result[0][0]['caste_flag'] == 1) {
////                        echo "=====" . trim($result[0][0]['caste_flag']);
//                        return 1;
//                    } else {
//                        return 0;
//                    }
//                }
//            } else {
//                return 0;
//            }
//        } catch (Exception $e) {
//            return 0;
//        }
//    }
//    
//    public function checkCasteValidityFowardCondition($schcd, $tchr_id) {
//        try {
////            tchr_caste_cert.tchr_id,tchr_caste_cert.tc_categ,tchr_caste_cert.asst_cst_flag,tchr_caste_cert.tc_cert_fname,
//            $query = "SELECT tchr_caste_cert.tchr_id,
//                CASE WHEN tchr_caste_cert.tc_categ !=1 
//                THEN tc_cert_fname is not null 
//                ELSE tc_cert_fname is null END as caste_flag
//                    FROM
//                    master.tch_master,master.tchr_caste_cert,master.tchr_entry_status
//                    where 
//                    tch_master.schl_id = tchr_entry_status.schl_id 
//                    AND tch_master.tchr_id = tchr_entry_status.tchr_id 
//                   AND tch_master.tchr_id = tchr_caste_cert.tchr_id
//                   AND tch_master.schl_id='" . $schcd . "' 
//            AND tch_master.tchr_id='" . $tchr_id . "'
//            AND tchr_caste_cert.asst_cst_flag = 'E'
//            AND tchr_entry_status.de_caste_valid = 'Y'
//        "; // posttype 1=Teaching 2=Non-Teaching
////            echo "" . $query;
//            $result = $this->query($query);
//
//            if ($result != NULL) {
//                if (isset($result[0][0]['caste_flag'])) {
//                    if ($result[0][0]['caste_flag'] == 1) {
////                        echo "=====" . trim($result[0][0]['caste_flag']);
//                        return 1;
//                    } else {
//                        return 0;
//                    }
//                }
//            } else {
//                return 0;
//            }
//        } catch (Exception $e) {
//            return 0;
//        }
//    }


    public function checkCasteFowardCondition($schcd, $tchr_id) {
        try {
//            tchr_caste_cert.tchr_id,tchr_caste_cert.tc_categ,tchr_caste_cert.asst_cst_flag,tchr_caste_cert.tc_cert_fname,
            $query = "SELECT tchr_caste_cert.tchr_id 
                    FROM master.tch_master,master.tchr_caste_cert,master.tchr_entry_status
                    where 
                    tch_master.schl_id = tchr_entry_status.schl_id 
                    AND tch_master.tchr_id = tchr_entry_status.tchr_id 
                   AND tch_master.tchr_id = tchr_caste_cert.tchr_id 
                   AND tch_master.schl_id='" . $schcd . "' 
                    AND tch_master.tchr_id='" . $tchr_id . "'
                    AND tchr_caste_cert.asst_cst_flag = 'E'
                    AND tchr_entry_status.de_caste = 'Y'
               "; // posttype 1=Teaching 2=Non-Teaching
//            echo "" . $query;
            $result = $this->query($query);

            if ($result != NULL)
                return 1;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function checkCasteValidityFowardCondition($schcd, $tchr_id) {
        try {
//            tchr_caste_cert.tchr_id,tchr_caste_cert.tc_categ,tchr_caste_cert.asst_cst_flag,tchr_caste_cert.tc_cert_fname,
            $query = "SELECT tchr_caste_cert.tchr_id 
                    FROM
                    master.tch_master,master.tchr_caste_cert,master.tchr_entry_status
                    where 
                    tch_master.schl_id = tchr_entry_status.schl_id 
                    AND tch_master.tchr_id = tchr_entry_status.tchr_id 
                   AND tch_master.tchr_id = tchr_caste_cert.tchr_id
                   AND tch_master.schl_id='" . $schcd . "' 
            AND tch_master.tchr_id='" . $tchr_id . "'
            AND tchr_caste_cert.asst_cert_flag = 'E'
            AND tchr_entry_status.de_caste_valid = 'Y'
        "; // posttype 1=Teaching 2=Non-Teaching
//            echo "" . $query;
            $result = $this->query($query);

            if ($result != NULL)
                return 1;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

}

?>
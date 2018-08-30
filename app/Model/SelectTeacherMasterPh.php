<?php

class SelectTeacherMasterPh extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectTeacherMasterPh";
    var $useTable = 'tchr_ph'; //db=Teacher schema=master

    function validation($data) {
        $data = $data['ph'];
        $errorString = '';

        if ($this->notEmpty($data['datepicker'])) {
            $errorString.='<li>Enter Certificate Date.</li>';
        } else {
            if ($this->ValidDate($data['datepicker'])) {
                $errorString.='<li>Invalid Certificate Date.</li>';
            } else {
                if ($this->CompaireTwoDate($data['datepicker'], $data['tchr_birth_dt'])) {
                    $errorString.='<li>Enter Certificate Date Less than Birth Date.</li>';
                } else {
                    
                }
            }
        }

        if ($this->notEmpty($data['ph_cert_no'])) {
            $errorString.='<li>Enter valid Cirtificate No.</li>';
        }
        if ($this->notEmpty($data['tech_ph_persnt'])) {
            $errorString.='<li>Enter valid Disability Percentage.</li>';
        }
        if ($this->notEmpty($data['distype'])) {
            $errorString.='<li>Select Disability Type.</li>';
        }
        if ($this->notEmpty($data['tech_issu_authority'])) {
            $errorString.='<li>Select Issuing Authority.</li>';
        }
        return $errorString;
    }

    function pincode($value) {
        if (preg_match('/(4[0-9]|[4-9]\d|9[0-9]?100)/', $value)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function notEmpty($value) {
        if ($value == "") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function CompaireTwoDate($tchr_serv_entry_dt, $tchr_curr_desig_dt) {
        $tchr_serv_entry_dt = split("\/", $tchr_serv_entry_dt);
        $tchr_serv_entry_dt = $tchr_serv_entry_dt[2] . '' . $tchr_serv_entry_dt[1] . '' . $tchr_serv_entry_dt[0];
        // $tchr_serv_entry_dt = date('mdY', strtotime($tchr_serv_entry_dt));
        $tchr_curr_desig_dt = split("\-", $tchr_curr_desig_dt);
        $tchr_curr_desig_dt = $tchr_curr_desig_dt[0] . '' . $tchr_curr_desig_dt[1] . '' . $tchr_curr_desig_dt[2];
        if ($tchr_serv_entry_dt < $tchr_curr_desig_dt) {
            return TRUE;
        }
    }

    function ValidDate($date) {
        //$test_date = '03/22/2010';
        $test_arr = explode('/', $date);
        if (!checkdate($test_arr[1], $test_arr[0], $test_arr[2])) {
            return TRUE;
        }
    }

    public function updatebyid($tchr_id, $recvdata, $filename, $tchr_crtdt, $curtm) {
        $result = $this->query("update tchr_ph set  ph_disab_per=?, ph_cert_no=?, ph_cert_dt=?, ph_place = ?,ph_remarks=?,ph_cert_fname=?,ph_cd=?, ph_cert_auth=?,verif_flag=?,verif_dtstamp=?,ph_cert_loaded=? where tchr_id=?;", array($recvdata['ph']['tech_ph_persnt'], $recvdata['ph']['ph_cert_no'], $tchr_crtdt, $recvdata['ph']['tech_ph_place'], $recvdata['ph']['tech_ph_remark'], $filename, $recvdata['ph']['distype'], $recvdata['ph']['tech_issu_authority'], 'E', $curtm, 'Y', $tchr_id));

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function inserbyid($recvdata, $filename, $tchr_crtdt, $curtm) {
        $result = $this->query("INSERT INTO tchr_ph (tchr_id,ph_disab_per,ph_cert_no,ph_cert_dt,ph_place,ph_remarks,ph_cert_fname,ph_cd,ph_cert_auth,verif_flag,entry_dtstamp,verif_dtstamp,ph_cert_loaded) VALUES  ('" . $recvdata['tchr_id'] . "','" . $recvdata['ph']['tech_ph_persnt'] . "','" . $recvdata['ph']['ph_cert_no'] . "','" . $tchr_crtdt . "','" . $recvdata['ph']['tech_ph_place'] . "','" . $recvdata['ph']['tech_ph_remark'] . "','" . $filename . "','" . $recvdata['ph']['distype'] . "','" . $recvdata['ph']['tech_issu_authority'] . "','E','" . $curtm . "','" . $curtm . "','Y')");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function updatephbyid($tchr_id, $recvdata, $tchr_crtdt, $curtm, $imgflg) {
        $result = $this->query("update tchr_ph set  ph_disab_per=?, ph_cert_no=?, ph_cert_dt=?,ph_place=?, ph_remarks=?, ph_cd=?, ph_cert_auth=?,verif_flag=?,ph_cert_loaded=?,verif_dtstamp=? where tchr_id=?;", array($recvdata['ph']['tech_ph_persnt'], $recvdata['ph']['ph_cert_no'], $tchr_crtdt, $recvdata['ph']['tech_ph_place'], $recvdata['ph']['tech_ph_remark'], $recvdata['ph']['distype'], $recvdata['ph']['tech_issu_authority'], 'E', $imgflg, $curtm, $tchr_id));
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function insertphbyid($recvdata, $tchr_crtdt, $curtm) {
        $result = $this->query("INSERT INTO tchr_ph (tchr_id,ph_disab_per,ph_cert_no,ph_cert_dt,ph_place,ph_remarks,ph_cd,ph_cert_auth,verif_flag,ph_cert_loaded,entry_dtstamp,verif_dtstamp) VALUES  ('" . $recvdata['tchr_id'] . "','" . $recvdata['ph']['tech_ph_persnt'] . "','" . $recvdata['ph']['ph_cert_no'] . "','" . $tchr_crtdt . "','" . $recvdata['ph']['tech_ph_place'] . "','" . $recvdata['ph']['tech_ph_remark'] . "','" . $recvdata['ph']['distype'] . "','" . $recvdata['ph']['tech_issu_authority'] . "','E','N','" . $curtm . "','" . $curtm . "')");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function phtechrlist($sclid) {
        $result = $this->query("select * from master.tch_master tm,master.tchr_ph tp where tm.tchr_id=tp.tchr_id AND tm.schl_id = '" . $sclid . "' AND tp.verif_flag='E'");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function phforwrdtechrlist($sid) {
        $result = $this->query("select tm.tchr_id,tm.tchr_fname,tm.tchr_mname,tm.tchr_lname from master.tch_master tm,master.tchr_ph tp where tm.tchr_id=tp.tchr_id AND tp.verif_flag='F' AND tm.schl_id='" . $sid . "' ");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getschcode() {
        $schcodeudise = $this->query("SELECT asst_auth FROM  master.tchr_ph where verif_flag='F';");
        return( $schcodeudise);
    }

    public function phreportalllist($schl_id, $distype) {
        $result = $this->query("select tp.tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_type,tchr_birth_dt,tchr_curr_desg_cd,ph_disab_per,ph_cd,ph_cert_no,ph_cert_dt,schl_id,post_desc 
			from master.tch_master tm,master.tchr_ph tp,master.tchr_post_master tdg where tm.tchr_id=tp.tchr_id AND tm.tchr_curr_desg_cd=tdg.post_id AND tm.tchr_type=tdg.post_type AND tm.schl_id = '" . $schl_id . "' AND tp.ph_cd='" . $distype . "'");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function phreportlist($schl_id, $tchr_type, $distype) {
        $result = $this->query("select tp.tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_type,tchr_birth_dt,tchr_curr_desg_cd,ph_disab_per,ph_cd,ph_cert_no,ph_cert_dt,schl_id,post_desc
			 from master.tch_master tm,master.tchr_ph tp,master.tchr_post_master tdg where tm.tchr_id=tp.tchr_id AND tm.tchr_curr_desg_cd=tdg.post_id AND tm.tchr_type=tdg.post_type AND tm.schl_id = '" . $schl_id . "' AND tm.tchr_type = '" . $tchr_type . "' AND tp.ph_cd='" . $distype . "'");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function phreporttotallistbytype($schl_id, $tchr_type) {
        $result = $this->query("select tp.tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_type,tchr_birth_dt,tchr_curr_desg_cd,ph_disab_per,ph_cd,ph_cert_no,ph_cert_dt,schl_id,post_desc
			 from master.tch_master tm,master.tchr_ph tp,master.tchr_post_master tdg where tm.tchr_id=tp.tchr_id AND tm.tchr_curr_desg_cd=tdg.post_id AND tm.tchr_type=tdg.post_type AND tm.schl_id = '" . $schl_id . "' AND tm.tchr_type = '" . $tchr_type . "'");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function phreportofschool($schl_id) {
        $result = $this->query("select tp.tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_type,tchr_birth_dt,tchr_curr_desg_cd,ph_disab_per,ph_cd,ph_cert_no,ph_cert_dt,schl_id,post_desc
			 from master.tch_master tm,master.tchr_ph tp,master.tchr_post_master tdg where tm.tchr_id=tp.tchr_id AND tm.tchr_curr_desg_cd=tdg.post_id AND tm.tchr_type=tdg.post_type AND tm.schl_id = '" . $schl_id . "'");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }
    
    
     public function rqstrtntchrsph($tchrid){
        $qry="select tm.tchr_id,ph_cd,ph_cert_fname,ph_disab_per,ph_cert_no,
            ph_cert_dt,tchr_fname,tchr_mname,tchr_lname,ph_remarks
            from master.tchr_ph tp,master.tch_master tm
            where verif_flag='V' and 
            tp.tchr_id='".$tchrid."'
            and tp.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }
    
    public function getrtnflag() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM  master.tchr_ph tp,master.tch_master tm
                            where tp.verif_flag='T'
                            and tp.tchr_id=tm.tchr_id");
       
        return($flag);
    }
    
    public function clusterrtntchrsph($tchrid){
        $qry="select tm.tchr_id,ph_cd,ph_cert_fname,ph_disab_per,ph_cert_no,
            ph_cert_dt,tchr_fname,tchr_mname,tchr_lname,ph_remarks
            from master.tchr_ph tp,master.tch_master tm
            where verif_flag='T' and 
            tp.tchr_id='".$tchrid."'
            and tp.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }

    public function checkPhDetailsFowardCondition($schcd, $tchr_id) {
        try {
            $query = "SELECT tchr_ph.tchr_id 
                FROM master.tch_master,master.tchr_ph,master.tchr_entry_status
                where 
                    tch_master.tchr_id = tchr_entry_status.tchr_id
                AND tch_master.tchr_id = tchr_ph.tchr_id
                AND tch_master.schl_id='" . $schcd . "' 
                AND tch_master.tchr_id='" . $tchr_id . "'
                AND tchr_ph.verif_flag = 'E'
                
                AND tchr_entry_status.de_ph = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
//            echo "" . $query;
//            exit();

            $result = $this->query($query);

            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
	            } 
		    catch (Exception $e) {
		                return 0;
				        }
    }
    
//     public function checkPhDetailsFowardCondition($schcd, $tchr_id) {
//        try {
//            $query = "SELECT tchr_ph.tchr_id 
//                FROM master.tch_master,master.tchr_ph,master.tchr_entry_status
//                where 
//                    tch_master.tchr_id = tchr_entry_status.tchr_id
//                AND tch_master.tchr_id = tchr_ph.tchr_id
//                AND tch_master.schl_id='" . $schcd . "' 
//                AND tch_master.tchr_id='" . $tchr_id . "'
//                AND tchr_ph.verif_flag = 'E'
//                AND tchr_ph.ph_cert_fname is not null 
//                AND tchr_entry_status.de_ph = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
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
//	            } 
//		    catch (Exception $e) {
//		                return 0;
//				        }
//    }

}

?>
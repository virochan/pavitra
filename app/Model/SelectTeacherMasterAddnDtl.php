<?php

class SelectTeacherMasterAddnDtl extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectTeacherMasterAddnDtl";
    var $useTable = 'tchr_addnl_det'; //db=Teacher schema=master

    function validation($data) {
        $errorString = '';
        $currentDate = date("d/m/Y");

        if (isset($data['otherperdtl'])) {
            $data = $data['otherperdtl'];

            if (empty($data['ta_mother_tng'])) {
                $errorString.='<li style="padding-bottom: 5px;">Select Mother Tongue .</li>';
            }
            if (empty($data['ta_mari_stat'])) {
                $errorString.='<li style="padding-bottom: 5px;">Select Marital Status .</li>';
            }
            if (empty($data['ta_ele_card_no'])) {
                $errorString.='<li style="padding-bottom: 5px;">Enter Election Card No.</li>';
            }
            if (empty($data['ta_ex_serv'])) {
                $errorString.='<li style="padding-bottom: 5px;">Select Whether Ex-Servicemen Or Not ?.</li>';
            }
            /*  if (empty($data['ta_shikshan_sevak'])) {
              $errorString.='<li style="padding-bottom: 5px;">Select Whether Is Shikshan Sevak?.</li>';
              } */
            if (empty($data['ta_height_ft'])) {
                $errorString.='<li style="padding-bottom: 5px;">Enter Height in Feet.</li>';
            }
            if (empty($data['ta_height_inch'])) {
                $errorString.='<li style="padding-bottom: 5px;">Enter Height in Inch.</li>';
            }
            if (empty($data['ta_weight'])) {
                $errorString.='<li style="padding-bottom: 5px;">Enter Weight .</li>';
            }
            if (empty($data['ta_blood_grp'])) {
                $errorString.='<li style="padding-bottom: 5px;">Select Blood Group .</li>';
            }
            if (empty($data['ta_id_mark1'])) {
                $errorString.='<li style="padding-bottom: 5px;">Enter Identification Marks (#1)  .</li>';
            }
            if (empty($data['ta_id_mark2'])) {
                $errorString.='<li style="padding-bottom: 5px;">Enter Identification Marks (#2)  .</li>';
            }
            /* if (empty($data['ta_nontch_days'])) {
              $errorString.='<li style="padding-bottom: 5px;">Enter No. of working days.</li>';
              }
              if (empty($data['ta_cwsn_trng'])) {
              $errorString.='<li style="padding-bottom: 5px;">Enter CWSN.</li>';
              } */
        }
        //echo "<pre>"; echo $data['tchrid'];
        // else {	echo "Correct";}
        return $errorString;
    }

    function comparedates($maxr, $minr) {
        if ($maxr > $minr) {
            return true;
        } else {
            return false;
        }
    }

    function validateDate($date, $format = 'DD-MM-YYYY') {
        switch ($format) {
            case 'YYYY/MM/DD':
            case 'YYYY-MM-DD':
                list( $y, $m, $d ) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'YYYY/DD/MM':
            case 'YYYY-DD-MM':
                list( $y, $d, $m ) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'DD-MM-YYYY':
            case 'DD/MM/YYYY':
                @list( $d, $m, $y ) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'MM-DD-YYYY':
            case 'MM/DD/YYYY':
                list( $m, $d, $y ) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'DD-MM-YYYY':
            case 'DD/MM/YYYY':
                list( $m, $d, $y ) = preg_split('/[-\.\/ ]/', $date);
                break;

            case 'YYYYMMDD':
                $y = substr($date, 0, 4);
                $m = substr($date, 4, 2);
                $d = substr($date, 6, 2);
                break;

            case 'YYYYDDMM':
                $y = substr($date, 0, 4);
                $d = substr($date, 4, 2);
                $m = substr($date, 6, 2);
                break;

            default:
                throw new Exception("Invalid Date Format");
        }
        return checkdate($m, $d, $y);
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
            if (($tchr_serv_entry_dt[0] > $tchr_curr_desig_dt[0]) && ($tchr_serv_entry_dt[1] > $tchr_curr_desig_dt[1]) && ($tchr_serv_entry_dt[2] > $tchr_curr_desig_dt[2])) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function alphaNumericDashUnderscore($check) {
        $result = preg_match('|^[a-zA-Z0-9()./]*$|', $check);
        return $result;
        // return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    function alphabets($check) {
        $result = preg_match('|^[a-zA-Z]*$|', $check);
        return $result;
    }

    function convert_to_cm($feet, $inches = 0) {
        $inches = ($feet * 12) + $inches;
        return (int) round($inches / 0.393701);
    }

    public function forward_teacher_other_personal($schcd) {
        $schcodeudise = $this->query("SELECT m.tchr_id,tchr_lname,schl_id,asst_flag, adnl.*
        FROM master.tch_master m
        INNER JOIN master.tchr_addnl_det adnl ON m.tchr_id = adnl.tchr_id 
        where m.asst_flag = 'V'
        AND adnl.verif_flag = 'E' 
        and m.schl_id = '" . $schcd . "' 
        order by m.tchr_lname");

        return $schcodeudise;
    }

    public function get_personal_schcode() {
        $schcodeudise = $this->query("SELECT asst_auth FROM  master.tchr_addnl_det where verif_flag='F';");
        return( $schcodeudise);
    }

    public function certificateteacherlist($schcd) {
        $result = $this->query("SELECT tchr_addnl_det.*,tch_master.*  FROM master.tch_master JOIN master.tchr_addnl_det ON tch_master.tchr_id = tchr_addnl_det.tchr_id AND tch_master.schl_id='27280107902' AND tchr_addnl_det.verif_flag='F' ");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function findcertifctetchr($schlcd, $tid) {
        $result = $this->query("SELECT tchr_addnl_det.*,tch_master.* FROM master.tch_master JOIN master.tchr_addnl_det ON tch_master.tchr_id = tchr_addnl_det.tchr_id AND tch_master.schl_id='$schlcd' AND tchr_addnl_det.tchr_id='$tid' AND tchr_addnl_det.verif_flag='F' order by tchr_addnl_det.tchr_id asc");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    

}

?>
<?php

class TchrFmlyDet extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = 'TchrFmlyDet';
    var $useTable = 'tchr_fmly_det'; //db=Teacher schema=master

    public function get($tchrid) {
        $query = "Select MAX(CAST(tf_fam_id_no  as integer)) from master.tchr_fmly_det where tchr_id = '$tchrid' ";

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function deletefamilyrecord($srid) {
        $schcodeudise = $this->query("delete from  master.tchr_fmly_det where id='" . $srid . "'");
        return( $schcodeudise);
    }

    public function findteacher($tid) {
        $result = $this->query("SELECT tchr_fmly_det.*,tch_master.* 
FROM master.tch_master 
JOIN master.tchr_fmly_det ON tch_master.tchr_id = tchr_fmly_det.tchr_id
  AND tchr_fmly_det.tchr_id='$tid' 
   order by tchr_fmly_det.tchr_id asc");


        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function forward_family($schcd) {
        $result = $this->query("SELECT f.*, cd.code_value,cd.code_text
                                FROM master.tch_master m 
                                INNER JOIN master.tchr_fmly_det as f ON m.tchr_id = f.tchr_id
                                INNER JOIN master.cddir as cd ON f.tf_rel_cd = cd.code_value::numeric AND code_type = 'NR'
                                WHERE m.asst_flag IN ('U','V') 
                                AND m.schl_id = '" . $schcd . "'
                                AND f.asst_flag = 'E' 
                                ");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function verify_family($school_id,$tchr_id) {
        $result = $this->query("SELECT f.*, cd.code_value,cd.code_text
                                FROM master.tch_master m 
                                INNER JOIN master.tchr_fmly_det as f ON m.tchr_id = f.tchr_id
                                INNER JOIN master.cddir as cd ON f.tf_rel_cd = cd.code_value::numeric AND code_type = 'NR'
                                WHERE m.asst_flag IN ('U','V') 
                                AND m.schl_id = '" . $school_id . "' AND f.tchr_id = '" . $tchr_id . "'
                                AND f.asst_flag = 'F'  
                                ");

                                if ($result <> NULL) {
                                    return $result;
                                } else {
                                    return 0;
                                }
    }
    
    public function ClusterFindTeacher($schcd) {
        $result = $this->query("SELECT  distinct(m.tchr_id),m.tchr_fname,m.tchr_mname,m.tchr_lname,m.schl_id,m.asst_flag,m.tchr_type
                FROM master.tch_master m 
                WHERE  m.schl_id='" . $schcd . "' 
                AND  m.tchr_id in ( select tchr_id from master.tchr_fmly_det as f  where f.asst_flag = 'F'  and f.tchr_id = m.tchr_id )     ");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }
    public function getflag() {
        $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_fmly_det ts,master.tch_master tm
                                where ts.asst_flag='F'
                                and ts.tchr_id=tm.tchr_id");

        return($flag);
    }

    
      public function checkFamilyDetailsFowardCondition($schcd, $tchr_id) {
        try {
            $query = "SELECT tchr_fmly_det.tchr_id ,tchr_fmly_det.tf_fam_id_no
                FROM master.tch_master,master.tchr_fmly_det,master.tchr_entry_status
                where 
                    tch_master.tchr_id = tchr_entry_status.tchr_id
                AND tch_master.tchr_id = tchr_fmly_det.tchr_id
                AND tch_master.schl_id='" . $schcd . "' 
                AND tch_master.tchr_id='" . $tchr_id . "'
                AND tchr_fmly_det.asst_flag = 'E'
                AND tchr_fmly_det.tf_fam_id_no is not null 
                AND tchr_entry_status.de_fam_member = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
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
}

?>
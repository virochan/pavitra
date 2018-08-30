<?php

class SelectPfDcps extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectPfDcps";
    var $useTable = 'tchr_pay_pf_gis'; //db=Teacher schema=master

    public function getschcode() {
        $schcodeudise = $this->query("SELECT asst_auth FROM  master.tchr_pay_pf_gis where asst_flag='F';");
        return( $schcodeudise);
    }

    public function getschcode1($clucd) {
        $cluster_cd_match = substr($clucd, 0, 4);
//         echo "SELECT distinct (schl_id)  FROM  master.tch_master where asst_flag='F' and schl_id like '" . $cluster_cd_match . "%' ;"; 
//         exit();
        $schcodeudise = $this->query("SELECT DISTINCT (schl_id) FROM  master.tch_master where asst_flag='F' and schl_id like '" . $cluster_cd_match . "%' ;");
        return( $schcodeudise);
    }

    public function getschcodeeoverify($clucd,$eo_code) {
        $cluster_cd_match = substr($clucd, 0, 4);
          
          $eo_code_pri_sec = substr($eo_code, 6, 8); 
         if($eo_code_pri_sec =='01'){
            $highest_class_cond = "highest_class < 8 ";
         }
         else if($eo_code_pri_sec =='02'){
             $highest_class_cond = "highest_class >= 8 ";
         }
 
//         echo "SELECT DISTINCT (tm.schl_id)
//                                        FROM  master.tch_master  as tm
//                                       RIGHT JOIN shala.shala_all_school as sas ON tm.schl_id = sas.schcd AND sas.school_management = 2 AND sas.management_details = 19
//                                       where asst_flag='F' and $highest_class_cond and schl_id like '" . $cluster_cd_match . "%' ;";
//         exit();
         
//         AND sas.school_management = 2 AND sas.management_details = 19


        $schcodeudise = $this->query("SELECT DISTINCT (tm.schl_id)
                                        FROM  master.tch_master  as tm
                                       RIGHT JOIN shala.shala_all_school as sas ON tm.schl_id = sas.schcd  AND sas.school_management = 2 AND sas.management_details = 4
                                       where asst_flag='F' and $highest_class_cond and schl_id like '" . $cluster_cd_match . "%' ;");
        return( $schcodeudise);
    }

    public function checkPayPfFowardCondition($schcd, $tchr_id) {
        try {
            $query = "SELECT * 
                FROM master.tch_master,master.tchr_pay_pf_gis,master.tchr_entry_status
                where 
                tch_master.tchr_id = tchr_entry_status.tchr_id
             AND tch_master.tchr_id = tchr_pay_pf_gis.tchr_id
            AND tch_master.schl_id='" . $schcd . "' 
            AND tch_master.tchr_id='" . $tchr_id . "'
            AND tchr_pay_pf_gis.asst_flag = 'E'
           AND  tchr_pay_pf_gis.tp_pay_com_cd is not null
              AND tchr_entry_status.de_pay = 'Y'
                "; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query;exit();
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
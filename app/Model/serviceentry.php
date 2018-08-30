<?php

class serviceentry extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "serviceentry";
    var $useTable = "tchr_service_hist"; //db=Teacher schema=master
    
      public function checkServiceHistoryFowardCondition($schcd, $tchr_id) {
        try {
            $query = "SELECT tchr_service_hist.tchr_id,tchr_service_hist.tsh_from_dt 
                FROM master.tch_master,master.tchr_service_hist,master.tchr_entry_status
                where 
                    tch_master.tchr_id = tchr_entry_status.tchr_id
                AND tch_master.tchr_id = tchr_service_hist.tchr_id
                AND tch_master.schl_id='" . $schcd . "' 
                AND tch_master.tchr_id='" . $tchr_id . "'
                AND tchr_service_hist.verif_flag = 'E'
                AND tchr_service_hist.tsh_from_dt is not null 
                AND tchr_entry_status.de_serv_hist = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
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
    
    public function getflag() {
        $flag = $this->query("SELECT schl_id FROM  master.tchr_service_hist where verif_flag='F';");
        return($flag);
    }
    public function getflagretun() {
        $flag = $this->query("SELECT schl_id FROM  master.tchr_service_hist where verif_flag='V';");
        return($flag);
    }

}

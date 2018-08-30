<?php

class SelectTchrEntryStatus extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "tchrentrystatus";
    var $useTable = 'tchr_entry_status'; //db=Teacher schema=master

    public function getTeacherInfo($schcd) {
        $query = "Select tch_master.*,
                    tchr_post_master.post_desc,
                    tchr_entry_status.* 
        FROM 
                        master.tch_master 
          JOIN	master.tchr_post_master
         ON		tch_master.tchr_type=tchr_post_master.post_type 
                    AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id

          JOIN master.tchr_entry_status
        ON   (tchr_entry_status.tchr_id = tch_master.tchr_id)  

        WHERE 
                tch_master.schl_id='" . $schcd . "'  
        order by tch_master.tchr_id";
//     echo "".$query;      exit();     
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    } 
    
    
      public function checkEntryDetailsFowardCondition($tchr_id) {
        try {
            $query = "SELECT tchr_entry_status.tchr_id ,tchr_entry_status.de_cluster_fwd
                FROM master.tchr_entry_status 
                where 
                    tchr_entry_status.tchr_id='" . $tchr_id . "' 
                    AND tchr_entry_status.de_cluster_fwd = 'E'
                     AND tchr_entry_status.de_cluster_fwd != 'V' "; // posttype 1=Teaching 2=Non-Teaching
//            echo "" . $query;  exit();

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
} 
?>
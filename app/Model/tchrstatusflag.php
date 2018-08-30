<?php

class tchrstatusflag extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "tchrstatusflag";
    var $useTable = 'tchr_entry_status'; //db=Teacher schema=master

    public function getTchrInfopopup($tch_id) {
        $query = "Select tch_master.*,
tchr_post_master.post_desc,
tchr_entry_status.*
FROM
master.tch_master
JOIN master.tchr_post_master
ON tch_master.tchr_type=tchr_post_master.post_type
AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id

JOIN master.tchr_entry_status
ON (tchr_entry_status.tchr_id = tch_master.tchr_id)

WHERE
tch_master.tchr_id='" . $tch_id . "'
order by tch_master.tchr_id";
        
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

}

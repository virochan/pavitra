<?php

class SelectPostMapped extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectPostMapped";
    var $useTable = 'tchr_post_map'; //db=Teacher schema=master

    public function getMappedPost($schcd) {
        $query = "Select tchr_post_master.post_id,tchr_post_master.post_desc, count(post_id) as sum
                    from master.tch_master,
                         master.tchr_post_master,
                         master.tchr_post_map
                    where 
                         tch_master.schl_cd_shalarath = '" . $schcd . "'
                    AND  tch_master.tchr_id = tchr_post_map.tchr_id 
                    AND  tchr_post_master.post_id = CAST(tchr_post_map.tchr_post_cd as integer) 
                    group by tchr_post_master.post_id,tchr_post_master.post_desc";
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
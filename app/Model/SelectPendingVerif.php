<?php
class SelectPendingVerif extends AppModel {
    public $useDbConfig = 'use_db_Tech_master';
     var $name = "SelectPendingVerif";
    var $useTable = 'pending_verif';//db=Teacher schema=master 

    public function getPendingRecords($schl_cd) {
         $query = "Select * from 
                        master.verif_master,
                         master.pending_verif
                    where 
                         pending_verif.schl_id = '" . $schl_cd . "'
                    AND  pending_verif.menu_item = verif_master.verif_code
		    AND  pending_verif.pend_verif_flag='Y'";
//         echo "".$query;exit();
        
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
}
?>
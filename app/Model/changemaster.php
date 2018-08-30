<?php 
class changemaster extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "changemaster";
    var $useTable = 'change_mast'; //db=Teacher schema=master
    
    
    public function getflag() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM  master.change_mast cm,master.tch_master tm
                            where cm.verif_flag='E'
                            and cm.change_type='ST'
                            and cm.tchr_id=tm.tchr_id");
       
        return($flag);
    }
    public function gettchsclust($typ,$schcd) {
                 $flag = $this->query("SELECT tm.tchr_id,tchr_fname,tchr_mname,tchr_lname 
                  FROM master.change_mast cm,master.tch_master tm
                  where change_type='ST'
                  and cm.tchr_id=tm.tchr_id
                  and schl_id='".$schcd."'
                  and tchr_type='".$typ."'
                  and verif_flag='E';");
                 
                       
        return($flag);
    }
    
    
}
?>
<?php

class TchrTrng extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = 'TchrTrng';
    var $useTable = 'tchr_trng'; //db=Teacher schema=master

    public function training_teachers($schcd) {
        $schcodeudise = $this->query("SELECT tch_master.tchr_id,tchr_fname,tchr_mname,tchr_lname,schl_id,tchr_type,tchr_curr_desg_cd,asst_flag FROM master.tch_master 
WHERE tch_master.schl_id='$schcd' AND tch_master.tchr_type='1' AND asst_flag IN('M','U') ORDER BY tch_master.tchr_id ");
        return( $schcodeudise);
    }

    public function training_non_teacher($schcd) {
        $schcodeudise = $this->query("SELECT tch_master.tchr_id,tchr_fname,tchr_mname,tchr_lname,schl_id,tchr_type,tchr_curr_desg_cd,asst_flag FROM master.tch_master 
WHERE tch_master.schl_id='$schcd' AND tch_master.tchr_type='2' AND asst_flag IN('M','U') ORDER BY tch_master.tchr_id ");
        return( $schcodeudise);
    }

    function validDate($serv_entry_dt, $from_date) {
        $serv_entry_dt1 = strtotime($serv_entry_dt);
        $from_date1 = strtotime($from_date);
        
        //return 1;
        if ($serv_entry_dt1 > $from_date1) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function  deletetrainingrecord($srid){
      $schcodeudise=$this->query("delete from  master.tchr_trng where id='".$srid."'");
      
      return( $schcodeudise);
        
    }

}

?>
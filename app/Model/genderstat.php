<?php

class genderstat extends AppModel {

    public $useDbConfig = 'use_db_stat_data';
    var $name = "genderstat";
    var $useTable = 'stat_sm_gender'; //db=Teacher schema=master

    public function getSchAll($clucd = '') {
        $query = "SELECT sch_cd ,sch_name,ac_year as tchr_sanch_year,sum(sch_sm_tot) as sch_sm_tot,sum(sch_male_tot)as sch_male_tot, sum(sch_female_tot)as sch_female_tot, sum(sch_trans_tot)as sch_trans_tot
FROM  stat_data.stat_sm_gender 
WHERE clu_cd = '$clucd' 
GROUP BY sch_cd,tchr_sanch_year,sch_name order by sch_name";
//        echo "" . $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getSchhm($schcd = '', $tchr_gender_type = '') {
        $query = "select sg.sch_name,sg.sch_cd,tchr_fname,tchr_mname,tchr_lname,tchr_curr_desg_cd,tchr_edu_entry_dt,tchr_curr_sch_dt,tchr_birth_dt,sch_sm_tot,tchr_super_annuation_dt,tm.tchr_type,tm.tchr_gender from stat_data.stat_sm_gender sg 
                                                   Left Join master.tch_master tm  on sg.sch_cd=tm.schl_id
                                                   where tm.schl_id='$schcd' and tm.tchr_type=sg.tchr_type and tm.tchr_gender='$tchr_gender_type';";
//        echo "" . $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getSchhmall($schcd = '') {
        $query = "select sg.sch_name,sg.sch_cd,tchr_fname,tchr_mname,tchr_lname,tchr_curr_desg_cd,tchr_edu_entry_dt,tchr_curr_sch_dt,tchr_birth_dt,sch_sm_tot,tchr_super_annuation_dt,tm.tchr_type,tm.tchr_gender from stat_data.stat_sm_gender sg 
                                                   Left Join master.tch_master tm  on sg.sch_cd=tm.schl_id
                                                   where tm.schl_id='$schcd' and tm.tchr_type=sg.tchr_type;";
//        echo "" . $query;
//        exit();

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
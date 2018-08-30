
<?php

class StatSmCstcateg extends AppModel {

    public $useDbConfig = 'use_db_stat_data';
    var $name = "StatSmCstcateg";
    var $useTable = 'stat_sm_cstcateg'; //db=Teacher schema=master

     public function getSchClusterType($clucd = '', $tchr_type = '') {
        $query = "SELECT 
        sch_cd as schl_id,sch_name, tchr_type,sum(sch_gen_tot)as sch_gen_tot,
        sum(sch_sc_tot)as sch_sc_tot,sum(sch_st_tot)as sch_st_tot,sum(sch_obc_tot)as sch_obc_tot,sum(sch_vj_tot)as sch_vj_tot, 
        sum(sch_sbc_tot)as sch_sbc_tot,sum(sch_ntb_tot)as sch_ntb_tot,sum(sch_ntc_tot)as sch_ntc_tot, 
        sum(sch_ntd_tot)as sch_ntd_tot,sch_sm_tot                       
        FROM stat_data.stat_sm_castecateg
        WHERE  clu_cd='$clucd'  and tchr_type='$tchr_type' 
        GROUP BY schl_id,tchr_type,sch_name,sch_sm_tot
        order by  sch_name,tchr_type ";
//        echo "".$query;exit();
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
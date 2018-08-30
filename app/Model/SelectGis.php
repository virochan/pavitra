<?php



class SelectGis extends AppModel {
    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectGis";
    var $useTable = 'tchr_gis'; //db=Teacher schema=master
       
    public function fwdgistchrdtls($schcd){
              $qry="SELECT tg.tchr_id,tchr_fname,tchr_mname,tchr_lname, tp_gis_appl,cd.code_text as gapp, tp_gis_group,gg.code_text as ggrp ,tp_gis_memb_dt, tg.asst_flag,tp_remarks
                    FROM master.tchr_gis tg
                    LEFT JOIN master.tch_master tm on tg.tchr_id=tm.tchr_id
                    LEFT JOIN master.Cddir cd ON tg.tp_gis_appl = cd.code_value and cd.code_type='GA'
                    LEFT JOIN master.Cddir gg ON tg.tp_gis_group = gg.code_value and gg.code_type='GG'
                    where tg.asst_flag = 'E' and tm.schl_id = '".$schcd."'
                    order by tm.tchr_fname";
                $res=$this->query($qry);
            
                if ($res <> NULL) {
                    return $res;
                } else {
                    return 0;
                }
    }
    
    
    public function getflag() {
            $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_gis tg,master.tch_master tm
                                where tg.asst_flag='F'
                                and tg.tchr_id=tm.tchr_id");

            return($flag);
    }
    
    
    public function clusterfwdtchrsgis($tchrid){
            $qry="SELECT tg.tchr_id,tchr_fname,tchr_mname,tchr_lname, tp_gis_appl,cd.code_text as gapp, tp_gis_group,gg.code_text as ggrp ,tp_gis_memb_dt, tg.asst_flag,tp_remarks
                    FROM master.tchr_gis tg
                    LEFT JOIN master.tch_master tm on tg.tchr_id=tm.tchr_id
                    LEFT JOIN master.Cddir cd ON tg.tp_gis_appl = cd.code_value and cd.code_type='GA'
                    LEFT JOIN master.Cddir gg ON tg.tp_gis_group = gg.code_value and gg.code_type='GG'
                    where tg.asst_flag = 'F' and tm.tchr_id = '".$tchrid."'";

            $res=$this->query($qry);

            return $res;
    }
        
    public function rqstrtntchrsgis($tchrid){
            $qry="SELECT tg.tchr_id,tchr_fname,tchr_mname,tchr_lname, tp_gis_appl,cd.code_text as gapp, tp_gis_group,gg.code_text as ggrp ,tp_gis_memb_dt, tg.asst_flag,tp_remarks
                    FROM master.tchr_gis tg
                    LEFT JOIN master.tch_master tm on tg.tchr_id=tm.tchr_id
                    LEFT JOIN master.Cddir cd ON tg.tp_gis_appl = cd.code_value and cd.code_type='GA'
                    LEFT JOIN master.Cddir gg ON tg.tp_gis_group = gg.code_value and gg.code_type='GG'
                    where tg.asst_flag = 'V' and tm.tchr_id = '".$tchrid."'";

            $res=$this->query($qry);

            return $res;
    }  
    
    public function getrtnflag() {
            $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_gis tg,master.tch_master tm
                                where tg.asst_flag='T'
                                and tg.tchr_id=tm.tchr_id");

            return($flag);
    }
    
    
    public function clusterrtntchrsgis($tchrid){
            $qry="SELECT tg.tchr_id,tchr_fname,tchr_mname,tchr_lname, tp_gis_appl,cd.code_text as gapp, tp_gis_group,gg.code_text as ggrp ,tp_gis_memb_dt, tg.asst_flag,tp_remarks
                    FROM master.tchr_gis tg
                    LEFT JOIN master.tch_master tm on tg.tchr_id=tm.tchr_id
                    LEFT JOIN master.Cddir cd ON tg.tp_gis_appl = cd.code_value and cd.code_type='GA'
                    LEFT JOIN master.Cddir gg ON tg.tp_gis_group = gg.code_value and gg.code_type='GG'
                    where tg.asst_flag = 'T' and tm.tchr_id = '".$tchrid."'";

            $res=$this->query($qry);

            return $res;
        }
}
?>
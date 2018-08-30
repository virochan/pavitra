<?php

class SelectTeacherQual extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectTeacherQual";
    var $useTable = 'tchr_qual'; //db=Teacher schema=master

    
    public function getflag() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM  master.tchr_qual tq,master.tch_master tm
                            where tq.verif_flag='F'
                            and tq.tchr_id=tm.tchr_id");
       
        return($flag);
    }
    public function getrtnflag() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM  master.tchr_qual tq,master.tch_master tm
                            where tq.verif_flag='T'
                            and tq.tchr_id=tm.tchr_id");
       
        return($flag);
    }
    
    
    public function getrqstrtnflag() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM  master.tchr_qual tq,master.tch_master tm
                            where tq.verif_flag='V'
                            and tq.tchr_id=tm.tchr_id");
       
        return($flag);
    }
    public function findacaddetails($tchid, $type) {
    
        $result = $this->query("select distinct tt.tchaqual_desc,tq_othr_sub,tq_grade,tchr_id,code_text,tq_pcnt,tq_remarks,state_name,bu_name,tq_cert_fname,tq_pass_year,deg_text,tq_cert_loaded,medinstr_desc,ss.deg_subject as maj,rr.deg_subject as min1, pp.deg_subject as min2 ,tchr_qual.verif_flag from master.tchr_qual 
left join master.degree_sub_mast ss on ss.deg_cd=tq_degree and ss.deg_sub_cd=tq_maj_sub::numeric
left join master.degree_sub_mast rr on rr.deg_cd=tq_degree and rr.deg_sub_cd=tq_min_sub1::numeric
left join master.degree_sub_mast pp on pp.deg_cd=tq_degree and pp.deg_sub_cd=tq_min_sub2::numeric
left join master.shala_tchaqual tt on tt.tchaqual_id=tq_qual_lvl :: numeric,
master.cddir,master.shala_medinstr,master.board_univ_mast,master.state_census_2011,master.shala_tchaqual,master.degree_mast
where tchr_qual.tchr_id='" . $tchid . "' and tchr_qual.tq_qual_type='A'
and cddir.code_type='MH'
and tchr_qual.tq_pass_month=cddir.code_value
and tchr_qual.tq_medium=shala_medinstr.medinstr_id
and tchr_qual.tq_board_univ=board_univ_mast.bu_code
and tchr_qual.tq_state_pass=cast(state_census_2011.state_code as numeric)
and tchr_qual.tq_degree=degree_mast.deg_cd
");

        return $result;
    }

    public function findprofdetails($tchid, $type) {
        $result = $this->query("select distinct tt.tchaqual_desc,tq_othr_sub,tchr_id,tq_grade,code_text,tq_pcnt,tq_remarks,state_name,bu_name,tq_cert_fname,tq_pass_year,deg_text,tq_cert_loaded,medinstr_desc,ss.deg_subject as maj,rr.deg_subject as min1, pp.deg_subject as min2,tchr_qual.verif_flag from master.tchr_qual 
left join master.degree_sub_mast ss on ss.deg_cd=tq_degree and ss.deg_sub_cd=tq_maj_sub::numeric
left join master.degree_sub_mast rr on rr.deg_cd=tq_degree and rr.deg_sub_cd=tq_min_sub1::numeric
left join master.degree_sub_mast pp on pp.deg_cd=tq_degree and pp.deg_sub_cd=tq_min_sub2::numeric
left join master.shala_tchaqual tt on tt.tchaqual_id=tq_qual_lvl :: numeric,
master.cddir,master.shala_medinstr,master.board_univ_mast,master.state_census_2011,master.shala_tchaqual,master.degree_mast
where tchr_qual.tchr_id='" . $tchid . "' and tchr_qual.tq_qual_type='P'
and cddir.code_type='MH'
and tchr_qual.tq_pass_month=cddir.code_value
and tchr_qual.tq_medium=shala_medinstr.medinstr_id
and tchr_qual.tq_board_univ=board_univ_mast.bu_code
and tchr_qual.tq_state_pass=cast(state_census_2011.state_code as numeric)
and tchr_qual.tq_degree=degree_mast.deg_cd

");

        return $result;
    }
    
    public function fwdtchrsacadprof($schid){
        $qry="select tm.tchr_id,tq_qual_lvl,tq_cert_fname,tq_degree,tq_maj_sub,tq_cert_loaded,
            tq_pcnt,tq_grade,tchr_fname,tchr_mname,tchr_lname
            from master.tchr_qual tq,master.tch_master tm
            where verif_flag='E'
            and schl_id='".$schid."'
            and tq.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }
    
    public function clusterfwdtchrsacadprof($tchrid){
        $qry="select tm.tchr_id,tq_qual_lvl,tq_cert_fname,tq_degree,tq_maj_sub,tq_qual_type,
            tq_pcnt,tq_grade,tchr_fname,tchr_mname,tchr_lname
            from master.tchr_qual tq,master.tch_master tm
            where verif_flag='F' and 
            tq.tchr_id='".$tchrid."'
            and tq.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }
    
    public function clusterrtntchrsacadprof($tchrid){
        $qry="select tm.tchr_id,tq_qual_lvl,tq_cert_fname,tq_degree,tq_maj_sub,
            tq_pcnt,tq_grade,tchr_fname,tchr_mname,tchr_lname,tq_remarks
            from master.tchr_qual tq,master.tch_master tm
            where verif_flag='T' and 
            tq.tchr_id='".$tchrid."'
            and tq.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }
    
    public function rqstrtntchrsacadprof($tchrid){
        $qry="select tm.tchr_id,tq_qual_lvl,tq_cert_fname,tq_degree,tq_maj_sub,
            tq_pcnt,tq_grade,tchr_fname,tchr_mname,tchr_lname,tq_remarks
            from master.tchr_qual tq,master.tch_master tm
            where verif_flag='V' and 
            tq.tchr_id='".$tchrid."'
            and tq.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }
    
    public function getverifns($schcd,$tchr_type){
        $qry="SELECT tq.tchr_id,tq.verif_flag
            FROM master.tchr_qual tq, master.tch_master tm
            WHERE tm.tchr_id=tq.tchr_id
            and schl_id='".$schcd."'
            and tq.verif_flag='V'
            and tchr_type='".$tchr_type."'";

        $res=$this->query($qry);
        return $res;
        
    }

}

?>
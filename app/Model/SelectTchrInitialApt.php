<?php

class SelectTchrInitialApt extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectTchrInitialApt";
    var $useTable = 'tchr_initial_apt'; //db=Teacher schema=master

    
      function validation($data) {
        $errorString = '';


        if($data['initApptDtl']['appt_date'] == ''){
            $errorString.='<li style="padding-bottom: 5px;">Enter date of entry in Education Department.</li>';
        }
        if ($data['initApptDtl']['app_post_mode'] == '') {
            $errorString.='<li style="padding-bottom: 5px;">Select Mode of Getting Post.</li>';
        }
        if ($data['initApptDtl']['app_post'] == '') {
            $errorString.='<li style="padding-bottom: 5px;">Select Post of Initial Appointment.</li>';
        }
        if($data['initApptDtl']['recu_catgry']=='' ){
            $errorString.='<li style="padding-bottom: 5px;">Select Recruitment Category.</li>';
        }
        if ($data['initApptDtl']['soci_catgry']=='' ) {
            $errorString.='<li style="padding-bottom: 5px;">Select Social Category.</li>';
        }
        if ($data['initApptDtl']['apmnt_sub']=='' ) {
            $errorString.='<li style="padding-bottom: 5px;">Select Appointment Subject 1</li>';
        }
       


        return $errorString;
    }
    public function updatenomibyid($tchrid, $recvdata, $curtm, $sclcd) {
        $result = $this->query("update tchr_initial_apt set  tin_to_dt=?,tin_init_post=?,tin_init_post_mode=?,tin_recruit_categ=?,tin_social_categ=?,verif_dtstamp=?,asst_auth=? where tchr_id=?;", array($recvdata['initApptDtl']['appt_date'], $recvdata['initApptDtl']['app_post'], $recvdata['initApptDtl']['app_post_mode'], $recvdata['initApptDtl']['recu_catgry'], $recvdata['initApptDtl']['soci_catgry'], $curtm, $sclcd, $tchrid));
        //echo $result;
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }
    
     public function getinitrtnflag() {
        $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_initial_apt ti,master.tch_master tm
                                where ti.verif_flag='T'
                                and ti.tchr_id=tm.tchr_id");
       
        return($flag);
    }

    public function insertnomibyid($recvdata, $curtm, $sclcd) {
        //print '<pre>';print_r($recvdata);exit;

        $result = $this->query("INSERT INTO master.tchr_initial_apt(tchr_id,tin_to_dt, tin_init_post, tin_init_post_mode, tin_recruit_categ, tin_social_categ,entry_dtstamp, verif_dtstamp,asst_auth) VALUES  ('" . $recvdata['tchr_id'] . "','" . $recvdata['initApptDtl']['appt_date'] . "','" . $recvdata['initApptDtl']['app_post'] . "','" . $recvdata['initApptDtl']['app_post_mode'] . "','" . $recvdata['initApptDtl']['recu_catgry'] . "','" . $recvdata['initApptDtl']['soci_catgry'] . "','" . $curtm . "','" . $curtm . "','" . $sclcd . "')");
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function checkInitialAptDtlFowardCondition($schcd, $tchr_id) {
        try {
//            tchr_initial_apt.tchr_id,tchr_initial_apt.tin_init_post,tchr_initial_apt.verif_flag
            $query = "SELECT * 
                FROM master.tch_master,master.tchr_initial_apt,master.tchr_entry_status
                where 
                tch_master.tchr_id = tchr_entry_status.tchr_id
                AND tch_master.tchr_id = tchr_initial_apt.tchr_id
                AND tch_master.schl_id='" . $schcd . "' 
                AND tch_master.tchr_id='" . $tchr_id . "'
                AND tchr_initial_apt.verif_flag = 'E'
                AND  tchr_initial_apt.tin_init_post is not null
                AND tchr_entry_status.de_initial_apt = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
//            echo "" . $query;
//            exit();

            $result = $this->query($query);
            if ($result != NULL)
                return 1;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }
    
    
//     public function checkInitialAptDtlFowardCondition($schcd, $tchr_id) {
//        try {
////            tchr_initial_apt.tchr_id,tchr_initial_apt.tin_init_post,tchr_initial_apt.verif_flag
//            $query = "SELECT * 
//                FROM master.tch_master,master.tchr_initial_apt,master.tchr_entry_status
//                where 
//                tch_master.tchr_id = tchr_entry_status.tchr_id
//                AND tch_master.tchr_id = tchr_initial_apt.tchr_id
//                AND tch_master.schl_id='" . $schcd . "' 
//                AND tch_master.tchr_id='" . $tchr_id . "'
//                AND tchr_initial_apt.verif_flag = 'E'
//                AND  tchr_initial_apt.tin_init_post is not null
//                AND tchr_entry_status.de_initial_apt = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
////            echo "" . $query;
////            exit();
//
//            $result = $this->query($query);
//            if ($result != NULL)
//                return 1;
//            else
//                return 0;
//        } catch (Exception $e) {
//            return 0;
//        }
//    }
    
     public function fwdinit($schcd){
        try {
//            tchr_initial_apt.tchr_id,tchr_initial_apt.tin_init_post,tchr_initial_apt.verif_flag
            $query = "SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_type,schl_id,init.tchr_edu_entry_dt,tin_init_post,tin_init_post_mode,tin_recruit_categ,tin_social_categ,tin_init_sub_cd,tin_staff_type
                        FROM master.tch_master m
                        INNER JOIN master.tchr_initial_apt init ON m.tchr_id = init.tchr_id 
                        where m.schl_id = '".$schcd."' 
                        and verif_flag='E'
                        and init.tchr_edu_entry_dt is not null 
                        and tin_init_post is not null
                        and tin_init_post_mode is not null 
                        and tin_recruit_categ is not null 
                        and tin_social_categ is not null
                        and (tin_init_sub_cd is not null or tin_init_sub_cd!='') 
                        order by m.tchr_lname"; // posttype 1=Teaching 2=Non-Teaching
//            echo "" . $query;
//            exit();

            $result = $this->query($query);
            if ($result != NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
        
        
    }
    
 
    
    public function getflag() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM  master.tchr_initial_apt ti,master.tch_master tm
                            where ti.verif_flag='F'
                            and ti.tchr_id=tm.tchr_id");
       
        return($flag);
    }
    
      
    public function clusterfwdtchrsinit($tchrid){
        $qry="select tm.tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_type,schl_id,ti.tchr_edu_entry_dt,tin_init_post,tin_init_post_mode,tin_recruit_categ,tin_social_categ,tin_init_sub_cd,tin_staff_type
            from master.tchr_initial_apt ti,master.tch_master tm
            where verif_flag='F' and 
            ti.tchr_id='".$tchrid."'
            and ti.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }
    public function clusterrtntchrsinit($tchrid){
        $qry="select tm.tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_type,schl_id,ti.tchr_edu_entry_dt,tin_init_post,tin_init_post_mode,tin_recruit_categ,tin_social_categ,tin_init_sub_cd,tin_staff_type
            from master.tchr_initial_apt ti,master.tch_master tm
            where verif_flag='T' and 
            ti.tchr_id='".$tchrid."'
            and ti.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }
    
    public function rqstrtntchrsinit($tchrid){
        $qry="select tm.tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_type,schl_id,ti.tchr_edu_entry_dt,tin_init_post,tin_init_post_mode,tin_recruit_categ,tin_social_categ,tin_init_sub_cd,tin_staff_type
            from master.tchr_initial_apt ti,master.tch_master tm
            where verif_flag='V' and 
            ti.tchr_id='".$tchrid."'
            and ti.tchr_id=tm.tchr_id order by tchr_id";
        
        $res=$this->query($qry);
        
        return $res;
    }
    
 
}

?>
<?php

class sch_sanch_woking_staff extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "sch_sanch_woking_staff";
    var $useTable = 'sch_tot_sanch_working_staff'; //db=Teacher schema=master

    public function getPostScantionNewReq1($schcd, $tchr_type) {
        $query = "SELECT ss.tchr_curr_desg_cd,pm.post_desc
  FROM master.sch_tot_sanch_working_staff as ss
   join master.tchr_post_master as pm
  on ss.tchr_curr_desg_cd = pm.post_id
 and ss.tchr_type =pm.post_type
 and ss.tchr_type ='" . $tchr_type . "'
 where schl_id='" . $schcd . "' "; // posttype 1=Teaching 2=Non-Teaching  tch_sanch_tot != tch_work_tot 
        $postSanction = $this->query($query);
//        echo "".$query;exit();
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }
    
    
     public function getPostScantionNewReq($schcd, $tchr_type) {
         $global_ac_year = Configure::read('global_ac_year');
      $query_old = "SELECT sanch_sanction_post.schcd, 
                    sanch_sanction_post.posttype,
                    sanch_sanction_post.postid as tchr_curr_desg_cd,
                    sanch_sanction_post.aided_pyear,
                    sanch_sanction_post.partpaided_pyear,
                    sanch_sanction_post.unaided_pyear,
                    sanch_sanction_post.perunaided_pyear,
                    sanch_sanction_post.sf_pyear,
                    shala_post_master.post_desc as post_desc,
                    (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear + sanch_sanction_post.unaided_pyear +
                    sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $schcd . "' 
                        and ac_year='" . $global_ac_year . "'  and posttype=$tchr_type 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        order by post_id"; // posttype 1=Teaching 2=Non-Teaching
      
       $query = "SELECT post_id as tchr_curr_desg_cd,post_desc   FROM master.tchr_post_master
                where  post_type = $tchr_type "; // posttype 1=Teaching 2=Non-Teaching  
        
       $postSanction = $this->query($query);
//        echo "".$query;exit();
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
        
     }

    public function getPostScantionNewReqParaTchr($schcd, $tchr_type) {
        $query = "SELECT post_id as tchr_curr_desg_cd,post_desc   FROM master.tchr_post_master
                where  tchr_post_master.primary = 'Y' and post_type =1"; // posttype 1=Teaching 2=Non-Teaching  
        $postSanction = $this->query($query);
//        echo "".$query;exit();
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function updateNewRecuritment($schcd, $tchr_curr_desg_cd, $date, $tchr_type) {
        $query = "UPDATE master.sch_tot_sanch_working_staff
   SET  tch_work_tot=(tch_work_tot)+1 ,
   upd_dtstamp = '" . $date . "'
 WHERE  tchr_curr_desg_cd= $tchr_curr_desg_cd
 and  schl_id='" . $schcd . "' 
 and tchr_type ='" . $tchr_type . "'"; // posttype 1=Teaching 2=Non-Teaching
        $result = $this->query($query);
//        echo "".$query;exit();
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

}

?>
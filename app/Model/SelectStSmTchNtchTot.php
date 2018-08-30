<?php

class SelectStSmTchNtchTot extends AppModel {

    public $useDbConfig = 'use_db_stat_data';
    var $name = "SelectStSmTchNtchTot";
    var $useTable = 'st_sm_tch_ntch_tot'; //db=Teacher schema=stat_data

    public function getTchrTotal($schl_id = '') {
        $query = "SELECT t1.sch_cd, tchr_sum, non_tchr_sum 
FROM (SELECT sch_cd, ac_year, tchr_type, sch_sm_tot as tchr_sum FROM stat_data.st_sm_tch_ntch_tot as tq where sch_cd='" . $schl_id . "' AND tchr_type IN (1)) as t1
    LEFT JOIN
     (SELECT sch_cd, ac_year, tchr_type, sch_sm_tot as non_tchr_sum FROM stat_data.st_sm_tch_ntch_tot as t2 where sch_cd='" . $schl_id . "' AND tchr_type IN (2)) as t2
ON
    t1.sch_cd = t2.sch_cd";
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
    
    
    public function getstatsforschool($schcd){
        $qry="SELECT sch_cd, sch_name, clu_cd,
              MAX(CASE WHEN tchr_type = 1 THEN sch_sm_tot ELSE NULL END) AS tchr_sum_1,
              MAX(CASE WHEN tchr_type = 2 THEN sch_sm_tot ELSE NULL END) AS tchr_sum_2
              FROM stat_data.st_sm_tch_ntch_tot 
              where sch_cd='".$schcd."'
              group by sch_cd,sch_name, clu_cd
              order by sch_name";
        $result = $this->query($qry);
         if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
        
    }
    public function getstatsforcluster($clucd){
        $qry="SELECT sch_cd, sch_name, clu_cd,
              MAX(CASE WHEN tchr_type = 1 THEN sch_sm_tot ELSE NULL END) AS tchr_sum_1,
              MAX(CASE WHEN tchr_type = 2 THEN sch_sm_tot ELSE NULL END) AS tchr_sum_2
              FROM stat_data.st_sm_tch_ntch_tot 
              where  clu_cd='".$clucd."' 
              group by sch_cd,sch_name, clu_cd
              order by sch_name";
        $result = $this->query($qry);
         if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }
    
     public function clusterwisesnrstats($beo_cd = '',$tchr_type) {
            if($tchr_type=='1'){
                $tchr_type ="in ('1')";
            }else if($tchr_type=='2'){
                $tchr_type ="in ('2')";
            }else if($tchr_type=='3'){
                $tchr_type ="in ('1','2')";
            } 
            $query = "SELECT clu_cd,cluname,sum(snrgrade_notrecvd_tot)
                        FROM stat_data.st_tch_ntch_snrgrade_notrecvd ss
                        LEFT JOIN shala_live.shala_cluster sc on ss.clu_cd=sc.clucd
                        where blk_cd='".$beo_cd."'
                        and tchr_type $tchr_type
                        group by clu_cd,cluname
                        having sum(snrgrade_notrecvd_tot)>0
                        order by cluname";
    //        echo "".$query;exit();
            $clunames = $this->query($query);
           return $clunames;
            
        }
        
        public function schoolwisesnrstats($clucd,$tchr_type) {
            if($tchr_type=='1'){
                $tchr_type ="in ('1')";
            }else if($tchr_type=='2'){
                $tchr_type ="in ('2')";
            }else if($tchr_type=='3'){
                $tchr_type ="in ('1','2')";
            } 
            try {
                $query = "SELECT sch_cd,school_name,sum(snrgrade_notrecvd_tot)
                            FROM stat_data.st_tch_ntch_snrgrade_notrecvd
                            where clu_cd='".$clucd."'
                            and tchr_type $tchr_type
                            group by sch_cd,school_name
                            having sum(snrgrade_notrecvd_tot)>0
                            order by school_name;
                          ";  // posttype 1=Teaching 2=Non-Teaching
    //              echo "" . $query; exit();
                 $result = $this->query($query);

                    return $result;

            } catch (Exception $e) {
                return 0;
            }
        }

        public function clusterwiseselstats($beo_cd = '',$tchr_type) {
            if($tchr_type=='1'){
                $tchr_type ="in ('1')";
            }else if($tchr_type=='2'){
                $tchr_type ="in ('2')";
            }else if($tchr_type=='3'){
                $tchr_type ="in ('1','2')";
            } 
            $query = "SELECT clu_cd,cluname,sum(selgrade_notrecvd_tot)
                        FROM stat_data.st_tch_ntch_snrgrade_notrecvd ss
                        LEFT JOIN shala_live.shala_cluster sc on ss.clu_cd=sc.clucd
                        where blk_cd='".$beo_cd."'
                        and tchr_type $tchr_type
                        group by clu_cd,cluname
                        having sum(selgrade_notrecvd_tot)>0
                        order by cluname";
    //        echo "".$query;exit();
            $clunames = $this->query($query);
           return $clunames;
            
        }
        
        public function schoolwiseselstats($clucd,$tchr_type) {
            if($tchr_type=='1'){
                $tchr_type ="in ('1')";
            }else if($tchr_type=='2'){
                $tchr_type ="in ('2')";
            }else if($tchr_type=='3'){
                $tchr_type ="in ('1','2')";
            } 
            try {
                $query = "SELECT sch_cd,school_name,sum(selgrade_notrecvd_tot)
                            FROM stat_data.st_tch_ntch_snrgrade_notrecvd
                            where clu_cd='".$clucd."'
                            and tchr_type $tchr_type
                            group by sch_cd,school_name
                            having sum(selgrade_notrecvd_tot)>0
                            order by school_name;
                          ";  // posttype 1=Teaching 2=Non-Teaching
    //              echo "" . $query; exit();
                 $result = $this->query($query);

                    return $result;

            } catch (Exception $e) {
                return 0;
            }
        }
}

?>
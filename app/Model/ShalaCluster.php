<?php

class ShalaCluster extends AppModel {

    public $useDbConfig = 'default';
    var $name = "ShalaCluster";
//    var $useTable = 'steps_cluster'; //db=shala schema=sch
    var $useTable = 'shala_cluster';  //db=shala_live schema=master

    public function getcluwsname($inClaucdStr) {
        $query = "select DISTINCT ON(cluname) clucd,cluname from shala_live.shala_cluster where clucd IN " . $inClaucdStr;
//        echo "".$query;exit();
        $clunamew = $this->query($query);
        if ($clunamew <> NULL)
            return $clunamew;
        else {
            return 0;
        }
    }

        public function getcluwsnamePayReturn($beo_cd = '', $inClausStr) {
        $query = "select clucd from shala_live.steps_keyvar where clucd LIKE '$beo_cd%' AND schcd IN " . $inClausStr;
//        echo "".$query;exit();
        $clunamew = $this->query($query);
        if ($clunamew <> NULL)
            return $clunamew;
        else {
            return 0;
        }
    }
         public function clusterwisestats($beo_cd = '') {
            $query = "SELECT clu_cd,cluname,sum(shikshan_sevak_tot)
                        FROM stat_data.st_tch_ntch_shikshan_sevak ss
                        LEFT JOIN shala_live.shala_cluster sc on ss.clu_cd=sc.clucd
                        where blk_cd='".$beo_cd."'
                        and tchr_type='1'
                        group by clu_cd,cluname
                        having sum(shikshan_sevak_tot)>0
                        order by cluname";
    //        echo "".$query;exit();
            $clunames = $this->query($query);
           return $clunames;
            
        }

}

?>
<?php

class view_dist_stud_tchr extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "view_dist_stud_tchr";
    var $useTable = 'stat_sm_mapping'; //db=Teacher schema=master

    public function find_districtk_name($distcd) {
        $result = $this->query("select temp.dist_cd ,sd.distname ,sum(temp.schl_count_fill) as schl_count_filled,
	sum(temp.mapped_tot) as mapped_tot, sum(temp.updated_tot) as updated_tot, sum(temp.forarwded_tot) as forarwded_tot ,
	sum(temp.verify_tot) as verify_tot,sum(temp.rejected_tot) as rejected_tot,sum(temp.discrepancy_tot) as discrepancy_tot 
from(
	select substr(sch_cd,1,4) as dist_cd, COUNT(DISTINCT sch_cd) as schl_count_fill,
	sum(sch_mapped_tot) as mapped_tot, sum(sch_updated_tot) as updated_tot, sum(sch_forwarded_tot) as forarwded_tot ,
	sum(sch_verified_tot) as verify_tot,sum(sch_rejected_tot) as rejected_tot,sum(sch_discrepancy_tot) as discrepancy_tot 
	from stat_data.stat_sm_mapping  as sm
	 where ((sch_mapped_tot > 0 )  OR (sch_updated_tot > 0 ) OR (sch_forwarded_tot > 0 ) OR (sch_verified_tot > 0 ) OR (sch_rejected_tot > 0 ) OR (sch_discrepancy_tot > 0 )  
	  OR (sch_cluster_return_tot > 0 ) )
	group by substr(sch_cd,1,4)
UNION All
	select substr(tm.schl_id,1,4) as dist_cd,0 as schl_count_fill,
	0 as mapped_tot, 0 as updated_tot, 0 as forarwded_tot ,0 as verify_tot,0 as rejected_tot,0 as discrepancy_tot 
	from master.tch_master as tm   
	
	group by substr(tm.schl_id,1,4)
) as temp, 
shala_live.shala_district as sd 
where temp.dist_cd=sd.distcd and temp.dist_cd = '$distcd'
GROUP BY temp.dist_cd,sd.distname");



        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function find_block_name($distcd) {
        $query1 = "select blkcd,blkname,count(distinct(sch_cd )) as sch_cnt_sanch_manayta ,sum(sch_sm_tot) as tch_cnt_sanch_manayta,0 as filled_sch, 0 as filled_tchr from stat_data.stat_sm_mapping ,
shala_live.shala_block where blkcd = blk_cd and dist_cd = '$distcd' and   blkcd like '$distcd%' group by blkcd,blkname order by blkname";
        $result1 = $this->query($query1);
//	echo "<pre>" . print_r($result1, true) . "</pre>";exit();

        $query2 = "SELECT blk_cd,COUNT(DISTINCT sch_cd) as filled_sch,sum(sch_mapped_tot + sch_updated_tot + sch_forwarded_tot + sch_verified_tot + sch_rejected_tot + sch_discrepancy_tot + 
sch_cluster_return_tot) as filled_tchr FROM stat_data.stat_sm_mapping WHERE ((sch_mapped_tot > 0 ) OR (sch_updated_tot > 0 ) OR (sch_forwarded_tot > 0 )
 OR (sch_verified_tot > 0 ) OR (sch_rejected_tot > 0 ) OR (sch_discrepancy_tot > 0 ) OR (sch_cluster_return_tot > 0 ) )  and dist_cd = '$distcd' and   blk_cd like '$distcd%' group by blk_cd";

        $result2 = $this->query($query2);
//        echo "<pre>" . print_r($result2, true) . "</pre>";exit();

        $array_length1 = count($result1);
        $array_length2 = count($result2);

        for ($i = 0; $i < $array_length1; $i++) {
            for ($j = 0; $j < $array_length2; $j++) {
                if (trim($result1[$i][0]['blkcd']) == trim($result2[$j][0]['blk_cd'])) {
                    $result1[$i][0]['filled_sch'] = $result2[$j][0]['filled_sch'];
                    $result1[$i][0]['filled_tchr'] = $result2[$j][0]['filled_tchr'];
                }
            }
        }

        if ($result1 <> NULL) {
            return $result1;
        } else {
            return 0;
        }
    }

    public function find_cluster_name($distcd, $blkcd) {
        $query1 = "select clu_cd,cluname,count(distinct(sch_cd )) as sch_cnt_sanch_manayta ,sum(sch_sm_tot) as tch_cnt_sanch_manayta,0 as filled_sch, 0 as filled_tchr 
                    from stat_data.stat_sm_mapping ,
                    shala_live.shala_cluster
                    where clucd = clu_cd and  blk_cd = '$blkcd' 
                    group by clu_cd,cluname order by  cluname";
        $result1 = $this->query($query1);
//         echo "<pre>" . print_r($result1, true) . "</pre>";exit();

        $query2 = "SELECT clu_cd,COUNT(DISTINCT sch_cd) as filled_sch,sum(sch_mapped_tot + sch_updated_tot + sch_forwarded_tot + 
                   sch_verified_tot + sch_rejected_tot + sch_discrepancy_tot + sch_cluster_return_tot) as filled_tchr 
                   FROM stat_data.stat_sm_mapping
                   WHERE (sch_mapped_tot + sch_updated_tot+ sch_forwarded_tot + sch_verified_tot+ sch_rejected_tot + sch_discrepancy_tot+sch_cluster_return_tot ) >0  and  blk_cd = '$blkcd' 
                   group by clu_cd
                   order by  clu_cd";

        $result2 = $this->query($query2);
//        echo "<pre>" . print_r($result2, true) . "</pre>";exit();

        $array_length1 = count($result1);
        $array_length2 = count($result2);

        for ($i = 0; $i < $array_length1; $i++) {
            for ($j = 0; $j < $array_length2; $j++) {
                if (trim($result1[$i][0]['clu_cd']) == trim($result2[$j][0]['clu_cd'])) {
                    $result1[$i][0]['filled_sch'] = $result2[$j][0]['filled_sch'];
                    $result1[$i][0]['filled_tchr'] = $result2[$j][0]['filled_tchr'];
                }
            }
        }
//        echo "<pre>" . print_r($result1, true) . "</pre>"; exit();
        
        if ($result1 <> NULL) {
            return $result1;
        } else {
            return 0;
        }

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function find_blk_name($blkcd) {
        $result = $this->query(" select blkcd,blkname from shala_live.shala_block as sblk 
                                where blkcd = '$blkcd' ");



        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

}

?>
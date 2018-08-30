
<?php

class SelectStTchNtchMapping extends AppModel {

    public $useDbConfig = 'use_db_stat_data';
    var $name = "SelectStTchNtchMapping";
    var $useTable = 'st_tch_ntch_mapping'; //db=Teacher schema=master

    //    public function getCluserUnderBeoType($beocd = '', $tchr_type = '') {
//        $query1 = "SELECT 
//                        distinct(stntm.clu_cd), 
//                        sc.cluname,
//                       sum( stntm.sch_mapped_tot)as mapped_tot,
//                       sum( stntm.sch_updated_tot)as updated_tot,
//                       sum( stntm.sch_forwarded_tot)as forarwded_tot,
//                       sum( stntm.sch_verified_tot)as verify_tot,
//		      sum( stntm.sch_rejected_tot)as rejected_tot,
//		       sum( stntm.sch_discrepancy_tot)as discrepancy_tot,
//                       sum( stntm.sch_teching_tot) as tch_tot,
//                       sum( stntm.sch_non_teaching_tot) as nontch_tot,
//                        stntm.tchr_type
//                FROM 
//                       stat_data.st_tch_ntch_mapping as stntm
//                LEFT  JOIN shala_live.shala_cluster as sc
//		 ON stntm.clu_cd = sc.clucd 
//                WHERE   blk_cd='$beocd' and tchr_type='$tchr_type' 
//                 GROUP BY 
//                        stntm.clu_cd, stntm.tchr_type , sc.cluname
//                        order by  stntm.clu_cd, stntm.tchr_type";
////        echo "" . $query1;   
//        $result1 = $this->query($query1);
//
//        $query2 = "SELECT clu_cd,sum(sch_cnt) as sch_cn
//                    FROM stat_data.st_clu_sch_cnt 
//                    where  blk_cd='$beocd' 
//                    group by clu_cd";
//
////        echo "<br><br>" . $query2; exit();
//        $result2 = $this->query($query2);
//        $clustWiseSchool = array();
//
////        echo "<pre>" . print_r($result1, true) . "</pre>";
////        echo "<pre>" . print_r($result2, true) . "</pre>";
////        exit();
//
//        foreach ($result2 as $key => $val) {
//            $clustWiseSchool[trim($val[0]['clu_cd'])] = trim($val[0]['sch_cn']);
//        }
//        $i = 0;
//        foreach ($result1 as $key => $val) {
//            $result1[$i++][0]['sch_cn'] = $clustWiseSchool[trim($val[0]['clu_cd'])];
//        }
//
//        echo "<pre>" . print_r($result1, true) . "</pre>";
////        echo "<pre>" . print_r($result2, true) . "</pre>";
//        exit();
////        $result3 = array_intersect($result1,$result2);
////        echo "<pre>" . print_r($result3, true) . "</pre>";
////        exit();
//
//
//        if ($result <> NULL)
//            return $result;
//        else {
////$result=0;
//            return 0;
//        }
//    }
//
//    public function getCluserUnderBeoTypeAll($beocd = '') {//Please Remove harad coded tchr_type='1'  from query its wrong
//        $query = "SELECT 
//                       distinct(stntm.clu_cd),
//                        stntm.ac_year as tchr_sanch_year,
//                        sum(stntm.sch_mapped_tot)as mapped_tot,
//                        sum(stntm.sch_updated_tot)as updated_tot,
//                        sum(stntm.sch_forwarded_tot)as forarwded_tot,
//                        sum(stntm.sch_verified_tot)as verify_tot,
//                         sum(stntm.sch_rejected_tot)as rejected_tot,
//		       sum(stntm.sch_discrepancy_tot)as discrepancy_tot,
//                        sum(stntm.sch_teching_tot) as tch_tot,
//                        sum(stntm.sch_non_teaching_tot) as nontch_tot,
//                        stntm.tchr_type
//                  FROM  stat_data.st_tch_ntch_mapping as stntm
//                  WHERE stntm.blk_cd = '$beocd'  
//                 GROUP BY 
//                        stntm.clu_cd,stntm.ac_year,stntm.tchr_type order by stntm.clu_cd,stntm.tchr_type";
////        echo "".$query;exit();
//
//        $result = $this->query($query);
//        if ($result <> NULL)
//            return $result;
//        else {
////$result=0;
//            return 0;
//        }
//    }

    public function getCluserUnderBeoType($beocd = '', $tchr_type = '') {
        $query = "SELECT 
                      distinct(clu_cd),sc.cluname, 
                       sum(sch_mapped_tot) as mapped_tot,
                       sum(sch_updated_tot) as updated_tot,
                        sum(sch_forwarded_tot) as forarwded_tot,
                       sum(sch_verified_tot) as verify_tot,
                       sum(sch_rejected_tot) as rejected_tot,
                       sum(sch_discrepancy_tot) as discrepancy_tot,
                        sum(sch_cluster_return_tot) as cluster_return_tot,
                       sum(sch_sm_tot) as sch_sm_tot,
                       tchr_type
                FROM 
                       stat_data.stat_sm_mapping 
		LEFT JOIN shala_live.shala_cluster sc
		ON sc.clucd=clu_cd
                WHERE  blk_cd='$beocd' and tchr_type='$tchr_type' 
                GROUP BY  clu_cd,tchr_type,sc.cluname
                order by cluname";
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getCluserUnderBeoTypeAll($beocd = '') {//Please Remove harad coded tchr_type='1'  from query its wrong
        $query = "SELECT 
                      distinct(clu_cd),sc.cluname, 
                       sum(sch_mapped_tot) as mapped_tot,
                       sum(sch_updated_tot) as updated_tot,
                        sum(sch_forwarded_tot) as forarwded_tot,
                       sum(sch_verified_tot) as verify_tot,
                       sum(sch_rejected_tot) as rejected_tot,
                       sum(sch_discrepancy_tot) as discrepancy_tot,
                        sum(sch_cluster_return_tot) as cluster_return_tot,
                       sum(sch_sm_tot) as sch_sm_tot,
                       tchr_type
                FROM 
                       stat_data.stat_sm_mapping 
		LEFT JOIN shala_live.shala_cluster sc
		ON sc.clucd=clu_cd
                WHERE  blk_cd='$beocd'  
                GROUP BY  clu_cd,tchr_type,sc.cluname
                order by sc.cluname,tchr_type";
//        echo "".$query;exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getSchClusterType($clucd = '', $tchr_type = '') {
        $query = "SELECT 
                       sch_cd as schl_id,
                       sch_name,
                       sch_mapped_tot as mapped_tot,
                       sch_updated_tot as updated_tot,
                       sch_forwarded_tot as forarwded_tot,
                       sch_verified_tot as verify_tot,
                       sch_rejected_tot as rejected_tot,
                       sch_discrepancy_tot as discrepancy_tot,
                        sch_cluster_return_tot as cluster_return_tot,
                       sch_sm_tot,
                       tchr_type
                FROM 
                       stat_data.stat_sm_mapping 
                WHERE  clu_cd='$clucd' and tchr_type='$tchr_type' 
                order by sch_name";
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getSchClusterTypeAll($clucd = '') {
        $query = "SELECT 
                       sch_cd as schl_id,
                       sch_name,
                       sch_mapped_tot as mapped_tot,
                       sch_updated_tot as updated_tot,
                       sch_forwarded_tot as forarwded_tot,
                       sch_verified_tot as verify_tot,
                       sch_rejected_tot as rejected_tot,
                       sch_discrepancy_tot as discrepancy_tot,
                        sch_cluster_return_tot as cluster_return_tot,
                       sch_sm_tot,
                       tchr_type
                FROM 
                       stat_data.stat_sm_mapping 
                WHERE  clu_cd='$clucd'  
                order by sch_name,tchr_type";
//        echo "" . $query; exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getSchTypeHmReport($schcd = '', $tchr_type = '') {
        $query = "SELECT 
                      sch_cd as schl_id,
                      sch_name,
                      sch_mapped_tot as mapped_tot,
                      sch_updated_tot as updated_tot,
                      sch_forwarded_tot forarwded_tot,
                      sch_verified_tot as verify_tot,
                      sch_rejected_tot as rejected_tot, 
                      sch_discrepancy_tot as discrepancy_tot,
                       sch_cluster_return_tot as cluster_return_tot,
                      sch_sm_tot ,
                      tchr_type
                FROM
                       stat_data.stat_sm_mapping
                        WHERE 
                     sch_cd = '$schcd' and tchr_type=$tchr_type";
//        echo "----".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getSchTypeAllHmReport($schcd = '') {
        $query = "SELECT 
                      sch_cd as schl_id,
                      sch_name,
                      sch_mapped_tot as mapped_tot,
                      sch_updated_tot as updated_tot,
                      sch_forwarded_tot forarwded_tot,
                      sch_verified_tot as verify_tot,
                      sch_rejected_tot as rejected_tot, 
                      sch_discrepancy_tot as discrepancy_tot,
                       sch_cluster_return_tot as cluster_return_tot,
                      sch_sm_tot ,
                      tchr_type
                FROM
                       stat_data.stat_sm_mapping
                        WHERE 
                     sch_cd = '$schcd'  order by tchr_type";
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }
    
      public function getSchTypeTallyHmReport($schcd , $tchr_type) {
          $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT tmp1.posttype,postid,post_desc,SUM (tchr_count_sanch) as tchr_count_sanch , SUM (tchr_count_master ) as tchr_count_master
                            FROM 

                            (SELECT 
                            posttype ,postid, SUM (tchr_count_sanch) as tchr_count_sanch , SUM (tchr_count_master ) as tchr_count_master
                            FROM
                            (
                                    (SELECT 
                                            posttype ,postid,(SUM (A.aided_pyear + A.partpaided_pyear + A.unaided_pyear + A.perunaided_pyear + A.sf_pyear)) as tchr_count_sanch,0 as tchr_count_master
                                    FROM udise.sanch_sanction_post A
                                    WHERE 	    A.ac_year='" . $global_ac_year . "'  
                                            AND schcd = '$schcd'
                                                 AND posttype = '$tchr_type'
                                            AND ((A.aided_pyear + A.partpaided_pyear + A.unaided_pyear + A.perunaided_pyear + A.sf_pyear)>0)
                                    GROUP BY posttype , postid  
                                    )
                            UNION
                                    (SELECT  tchr_type , tchr_curr_desg_cd , 0as tchr_count_sanch ,count(tchr_id) as tchr_count_master
                                     FROM master.tch_master
                                     WHERE	 schl_id  = '$schcd'
                                            AND tchr_curr_desg_cd IS NOT NULL
                                            AND tchr_type = '$tchr_type'	 
                                            AND ((tchr_lname!='' and tchr_lname is not null ))
                                            GROUP BY tchr_type,tchr_curr_desg_cd   
                                    )
                            )as tmp 
                            GROUP BY tmp.posttype , tmp.postid 

                            )as tmp1

                            LEFT JOIN master.tchr_post_master as tpm ON  tmp1.posttype = tpm.post_type  AND tmp1.postid = tpm.post_id 
                            GROUP BY tmp1.posttype , tmp1.postid ,post_desc
                              ORDER BY  tmp1.posttype ,tmp1.postid";
//        echo "----".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }
    
    public function getSchTypeAllTallyHmReport($schcd = '') {
        $global_ac_year = Configure::read('global_ac_year');
            $query = "SELECT tmp1.posttype,postid,post_desc,SUM (tchr_count_sanch) as tchr_count_sanch , SUM (tchr_count_master ) as tchr_count_master
                            FROM 

                            (SELECT 
                            posttype ,postid, SUM (tchr_count_sanch) as tchr_count_sanch , SUM (tchr_count_master ) as tchr_count_master
                            FROM
                            (
                                    (SELECT 
                                            posttype ,postid,(SUM (A.aided_pyear + A.partpaided_pyear + A.unaided_pyear + A.perunaided_pyear + A.sf_pyear)) as tchr_count_sanch,0 as tchr_count_master
                                    FROM udise.sanch_sanction_post A
                                    WHERE 	    A.ac_year='" . $global_ac_year . "'  
                                            AND schcd = '$schcd'
                                            AND ((A.aided_pyear + A.partpaided_pyear + A.unaided_pyear + A.perunaided_pyear + A.sf_pyear)>0)
                                    GROUP BY posttype , postid  
                                    )
                            UNION
                                    (SELECT  tchr_type , tchr_curr_desg_cd , 0as tchr_count_sanch ,count(tchr_id) as tchr_count_master
                                     FROM master.tch_master
                                     WHERE	 schl_id  = '$schcd'
                                            AND tchr_curr_desg_cd IS NOT NULL
                                            AND ((tchr_lname!='' and tchr_lname is not null ))
                                            GROUP BY tchr_type,tchr_curr_desg_cd   
                                    )
                            )as tmp 
                            GROUP BY tmp.posttype , tmp.postid 

                            )as tmp1

                            LEFT JOIN master.tchr_post_master as tpm ON  tmp1.posttype = tpm.post_type  AND tmp1.postid = tpm.post_id 
                            GROUP BY tmp1.posttype , tmp1.postid ,post_desc
                              ORDER BY  tmp1.posttype ,tmp1.postid";
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }
    
    

    public function getSchoolTotalForBeo($beoCode = '') {
        $query = "SELECT count(sch_cd) FROM stat_data.stat_sm_cstcateg where blk_cd='$beoCode' and tchr_type=1";
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getSchoolTotalForCluster($clusterCode = '') {
        $query = "SELECT count(sch_cd) FROM stat_data.stat_sm_cstcateg where clu_cd='$clusterCode' and tchr_type=1";
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

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
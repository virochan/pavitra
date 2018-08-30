<?php

class SchoolInfoSanch extends AppModel {

    public $useDbConfig = 'default_db'; //db=shala_live schema=schooldb
    var $useTable = 'sanch_sanction_post';
    var $name = "SchoolInfoSanch";

    public function getSchoolInfoSanchPost($schcd) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT SUM(aided_pyear) as aided, 
                        SUM(partpaided_pyear)as partpaided,
                        SUM(unaided_pyear)as unaided,
                        SUM(perunaided_pyear)as perunaided, 
                        SUM(sf_pyear) as sf
                 FROM udise.sanch_sanction_post
                 where schcd='" . $schcd . "' 
                 AND ac_year='" . $global_ac_year . "'
                 AND  posttype=1"; // posttype 1=Teaching 2=Non-Teaching
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getSchoolInfoSanchPostNonTech($schcd) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT SUM(aided_pyear) as aided, 
                        SUM(partpaided_pyear)as partpaided,
                        SUM(unaided_pyear)as unaided,
                        SUM(perunaided_pyear)as perunaided, 
                        SUM(sf_pyear) as sf
                 FROM udise.sanch_sanction_post
                 where schcd='" . $schcd . "' 
                 AND ac_year='" . $global_ac_year . "'
                 AND  posttype=2"; // posttype 1=Teaching 2=Non-Teaching
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getSchoolInfoSanchPostNtech($schcd) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT SUM(aided_pyear) as aided, 
                        SUM(partpaided_pyear)as partpaided,
                        SUM(unaided_pyear)as unaided,
                        SUM(perunaided_pyear)as perunaided, 
                        SUM(sf_pyear) as sf
                 FROM udise.sanch_sanction_post
                 where schcd='" . $schcd . "' 
                 AND ac_year='" . $global_ac_year . "'
                 AND  posttype=2"; // posttype 1=Teaching 2=Non-Teaching
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getSchoolInfoStaffDtl($schcd) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT SUM(aided_pyear) as aided_staff,  
                SUM(partpaided_pyear) as partpaided_staff,  
                SUM(unaided_pyear) asunaided_staff, 
                SUM(perunaided_pyear) as perunaided_staff, 
                SUM(sf_pyear) as sf_staff
                FROM udise.working_staff_detail
                 where schcd='" . $schcd . "' 
                 AND ac_year='" . $global_ac_year . "'
                 AND  posttype=1"; // posttype 1=Teaching 2=Non-Teaching
        $SchoolInfoStaffDtl = $this->query($query);
        if ($SchoolInfoStaffDtl <> NULL)
            return $SchoolInfoStaffDtl;
        else {
            //$result=0;
            return 0;
        }
    }

    public function SchoolInfoStaffDtlNtech($schcd) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT SUM(aided_pyear) as aided_staff,  
                SUM(partpaided_pyear) as partpaided_staff,  
                SUM(unaided_pyear) asunaided_staff, 
                SUM(perunaided_pyear) as perunaided_staff, 
                SUM(sf_pyear) as sf_staff
                FROM udise.working_staff_detail
                 where schcd='" . $schcd . "' 
                 AND ac_year='" . $global_ac_year . "'
                 AND  posttype=2"; // posttype 1=Teaching 2=Non-Teaching
        $SchoolInfoStaffDtlNtech = $this->query($query);
        if ($SchoolInfoStaffDtlNtech <> NULL)
            return $SchoolInfoStaffDtlNtech;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getPostScantion($schcd) {
        $query = "SELECT sanch_sanction_post.schcd, 
                    sanch_sanction_post.posttype,
                    sanch_sanction_post.postid,
                    sanch_sanction_post.aided_pyear as aided_cyear,
                    sanch_sanction_post.partpaided_pyear as partpaided_cyear,
                    sanch_sanction_post.unaided_pyear as unaided_cyear,
                    sanch_sanction_post.perunaided_pyear as perunaided_cyear,
                    sanch_sanction_post.sf_pyear as sf_cyear,
                    shala_post_master.post_desc,
                    (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear + sanch_sanction_post.unaided_pyear + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $schcd . "'                      
                        and posttype=1 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        order by post_id"; // posttype 1=Teaching 2=Non-Teaching
        $postSanction = $this->query($query);
//        pr($query);
//        echo "".$query;exit();
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getPostScantionmgmt($schcd, $prevdesigid) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT sanch_sanction_post.schcd, 
                    sanch_sanction_post.posttype,
                    sanch_sanction_post.postid,
                    sanch_sanction_post.aided_pyear as aided_cyear,
                    sanch_sanction_post.partpaided_pyear as partpaided_cyear,
                    sanch_sanction_post.unaided_pyear as unaided_cyear,
                    sanch_sanction_post.perunaided_pyear as perunaided_cyear,
                    sanch_sanction_post.sf_pyear as sf_cyear,
                    shala_post_master.post_desc,
                    (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear + sanch_sanction_post.unaided_pyear + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $schcd . "'
                        and postid='" . $prevdesigid . "'
                        and ac_year='" . $global_ac_year . "' and posttype=1 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        order by post_id"; // posttype 1=Teaching 2=Non-Teaching
        $postSanction = $this->query($query);
//        echo "".$query;exit();
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getSanctionPostMgmtwiseBlock($beo_code, $post_id, $mgmt_id) {
        if ($mgmt_id == 1) {
            $sanch_mgmt_type = 'SSP.aided_pyear';
        } else if ($mgmt_id == 2) {
            $sanch_mgmt_type = 'SSP.partpaided_pyear';
        } else if ($mgmt_id == 3) {
            $sanch_mgmt_type = 'SSP.unaided_pyear';
        } else if ($mgmt_id == 4) {
            $sanch_mgmt_type = 'SSP.perunaided_pyear';
        } else if ($mgmt_id == 5) {
            $sanch_mgmt_type = 'SSP.sf_pyear';
        } else {
            $sanch_mgmt_type = 0;
        }

        $query = " SELECT SUM(EXCESS) as excess_within_block ,SUM(VACANT) as vacant_within_block ,block_code,SUM(total_eo_shifted_staff) as total_eo_shifted_staff
                    FROM 
                        (SELECT
                            CASE 
                                WHEN (SUM(tmp.total_filled_staff) > SUM(tmp.sanch_sanction_staff) )
                                THEN (SUM(tmp.total_filled_staff) - SUM(tmp.sanch_sanction_staff ) )
                                ELSE  0
                            END AS EXCESS,
                            CASE
                                WHEN (SUM(tmp.total_filled_staff) < SUM(tmp.sanch_sanction_staff) )
                                THEN (SUM(tmp.sanch_sanction_staff) - SUM(tmp.total_filled_staff ))
                                ELSE  0
                            END AS VACANT ,
                            block_code ,schl_id,total_eo_shifted_staff
                         FROM (
                                 (SELECT  count(tchr_id) as total_filled_staff,0 as sanch_sanction_staff ,substring(schl_id,1,6) as block_code,schl_id,0 as total_eo_shifted_staff
                                  FROM master.tch_master
                                  WHERE schl_id like '" . $beo_code . "%' AND tchr_type = 1 AND tchr_curr_desg_cd = $post_id AND tchr_mgmt_type = $mgmt_id    
                                   GROUP BY substring(schl_id,1,6) ,schl_id
                                 )
                                 UNION
                                ( SELECT  0 as  total_filled_staff  ,SUM(" . $sanch_mgmt_type . ") as sanch_sanction_staff,substring(schcd,1,6) as block_code ,schcd as schl_id,0 as total_eo_shifted_staff
                                    FROM    udise.sanch_sanction_post as SSP 
                                 WHERE   SSP.schcd like '" . $beo_code . "%' AND SSP.posttype = 1 AND SSP.postid = $post_id  
                                   GROUP BY substring(schcd,1,6) ,schcd
                                 )
                                 UNION
                                 (
                                 SELECT   0 as  total_filled_staff,0 as sanch_sanction_staff,substring(schl_id,1,6) as block_code,schl_id,count(tchr_id) as total_eo_shifted_staff
                                    FROM   samayojan.excess_shift as ES
                                 WHERE   ES.schl_id like '" . $beo_code . "%' AND ES.tchr_type = 1 AND ES.tchr_curr_desg_cd = $post_id AND ES.tchr_mgmt_type = $mgmt_id    
                                    GROUP BY substring(schl_id,1,6) ,schl_id
                                 )
                        )as tmp  GROUP BY block_code ,schl_id,total_eo_shifted_staff
                        ) as tmp1 GROUP BY block_code
                        ";
//        echo "" . $query; exit();// ,tchr_curr_sch_dt ASC
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getSchoolListSanctionPostMgmtwiseBlock($beo_code, $post_id, $mgmt_id) {
        if ($mgmt_id == 1) {
            $sanch_mgmt_type = 'SSP.aided_pyear';
        } else if ($mgmt_id == 2) {
            $sanch_mgmt_type = 'SSP.partpaided_pyear';
        } else if ($mgmt_id == 3) {
            $sanch_mgmt_type = 'SSP.unaided_pyear';
        } else if ($mgmt_id == 4) {
            $sanch_mgmt_type = 'SSP.perunaided_pyear';
        } else if ($mgmt_id == 5) {
            $sanch_mgmt_type = 'SSP.sf_pyear';
        } else {
            $sanch_mgmt_type = 0;
        }

        $query = "SELECT tmp1.EXCESS,tmp1.VACANT,tmp1.block_code,tmp1.schl_id,tmp1.total_eo_shifted_staff,SAS.school_name FROM (
                   SELECT
                            CASE 
                                WHEN (SUM(tmp.total_filled_staff) > SUM(tmp.sanch_sanction_staff) )
                                THEN (SUM(tmp.total_filled_staff) - SUM(tmp.sanch_sanction_staff ) )
                                ELSE  0
                            END AS EXCESS,
                            CASE
                                WHEN (SUM(tmp.total_filled_staff) < SUM(tmp.sanch_sanction_staff) )
                                THEN (SUM(tmp.sanch_sanction_staff) - SUM(tmp.total_filled_staff ))
                                ELSE  0
                            END AS VACANT ,
                            block_code ,schl_id,total_eo_shifted_staff
                         FROM (
                                 (SELECT  count(tchr_id) as total_filled_staff,0 as sanch_sanction_staff ,substring(schl_id,1,6) as block_code,schl_id,0 as total_eo_shifted_staff
                                  FROM master.tch_master
                                  WHERE schl_id like '" . $beo_code . "%' AND tchr_type = 1 AND tchr_curr_desg_cd = $post_id AND tchr_mgmt_type = $mgmt_id    
                                   GROUP BY substring(schl_id,1,6) ,schl_id
                                 )
                                 UNION
                                ( 
                                SELECT  total_filled_staff,
                                        (sum(tmp2.sm_actual_tchr)-sum(tmp2.sama_shift_tchr)) as sanch_sanction_staff,
                                        tmp2.block_code,
                                        tmp2.schl_id,
                                        tmp2.total_eo_shifted_staff
                                FROM
                                (
                                 (SELECT 0 as total_filled_staff,
                                         count(tchr_id) as sama_shift_tchr,
                                         0 as sm_actual_tchr,
                                         substring(new_trans_schl_id,1,6) as block_code ,
                                         new_trans_schl_id  as  schl_id,
                                         0 as total_eo_shifted_staff 
                                  FROM  samayojan.excess_shift as ES
                                  WHERE  
                                         ES.tchr_mgmt_type = $mgmt_id      
                                     AND ES.tchr_curr_desg_cd  = $post_id
                                     AND ES.new_trans_schl_id like  '" . $beo_code . "%'
                                  GROUP BY ES.new_trans_schl_id 
                                  )
                                  UNION 
                                 (SELECT  	0 as total_filled_staff,
                                                0 as sama_shift_tchr,
                                                SUM(" . $sanch_mgmt_type . ") as sm_actual_tchr , 
                                                substring(schcd,1,6) as block_code ,
                                                schcd as schl_id ,
                                                0 as total_eo_shifted_staff 
                                   FROM   udise.sanch_sanction_post as SSP 
                                   WHERE   	
                                                SSP.posttype = 1
                                            AND SSP.postid = $post_id
                                            AND SSP.schcd  like  '" . $beo_code . "%'
                                    GROUP BY	substring(schcd,1,6) ,schcd
                                 )
                                 ) tmp2 where tmp2.schl_id like  '" . $beo_code . "%'
                                 GROUP BY  tmp2.total_filled_staff,tmp2.block_code,tmp2.schl_id,tmp2.total_eo_shifted_staff
                                 )
                                 UNION
                                 (
                                 SELECT   0 as  total_filled_staff,0 as sanch_sanction_staff,substring(schl_id,1,6) as block_code,schl_id,count(tchr_id) as total_eo_shifted_staff
                                    FROM   samayojan.excess_shift as ES
                                 WHERE   ES.schl_id like '" . $beo_code . "%' AND ES.tchr_type = 1 AND ES.tchr_curr_desg_cd = $post_id AND ES.tchr_mgmt_type = $mgmt_id    
                                    GROUP BY substring(schl_id,1,6) ,schl_id
                                 )
                        )as tmp  GROUP BY block_code ,schl_id,total_eo_shifted_staff
                        ) as tmp1 
                        LEFT JOIN shala.shala_all_school as SAS ON tmp1.schl_id = SAS.schcd 
                        GROUP BY tmp1.EXCESS,tmp1.VACANT,tmp1.block_code,tmp1.schl_id,tmp1.total_eo_shifted_staff,SAS.school_name
                        having VACANT > 0
                         ORDER BY  SAS.school_name
                        
                       ";
//        echo "" . $query; exit();// ,tchr_curr_sch_dt ASC
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

// virochan module
public function getPostScantionYearTchr($schcd) {
        $query = "SELECT  max(CAST(substr(ac_year,1,4) as integer)) FROM udise.sanch_sanction_post where schcd='" . $schcd . "' ";
        $year = $this->query($query);
        $sanch_year = $year[0][0]['max'] . "-" . ((substr($year[0][0]['max'], 2, 4)) + 1);

        $query1 = "SELECT sanch_sanction_post.schcd, sanch_sanction_post.ac_year,
	    sanch_sanction_post.posttype,
	    sanch_sanction_post.postid,
	    sanch_sanction_post.aided_pyear,sanch_sanction_post.aided_pyear,
	    sanch_sanction_post.partpaided_pyear, sanch_sanction_post.partpaided_pyear,
	    sanch_sanction_post.unaided_pyear,sanch_sanction_post.unaided_pyear,
	    sanch_sanction_post.perunaided_pyear, sanch_sanction_post.perunaided_pyear,
	    sanch_sanction_post.sf_pyear, sanch_sanction_post.sf_pyear,
	    shala_post_master.post_desc,
	    (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear + sanch_sanction_post.unaided_pyear
            + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot,
	        (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear 
                + sanch_sanction_post.unaided_pyear + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot_p
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $schcd . "' 
                        and ac_year='" . $sanch_year . "' and posttype=1 
                        and ( (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
		      or  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  )
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        order by post_id"; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query1;exit();
        $postSanction = $this->query($query1);

//        if ($postSanction[0][0]['tot'] != 0)
//            $tchr_sanch_year = $year[0][0]['max'];
//        else if ($postSanction[0][0]['tot'] == 0) {
//              $tchr_sanch_year = $year[0][0]['max'] - 1;
//        }
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }
public function getPostScantionYearNonTchr($schcd) {
        $query = "SELECT  max(CAST(substr(ac_year,1,4) as integer)) FROM udise.sanch_sanction_post where schcd='" . $schcd . "' ";
        $year = $this->query($query);
        $sanch_year = $year[0][0]['max'] . "-" . ((substr($year[0][0]['max'], 2, 4)) + 1);

        $query1 = "SELECT      sanch_sanction_post.schcd, sanch_sanction_post.ac_year,
	    sanch_sanction_post.posttype,
	    sanch_sanction_post.postid,
	    sanch_sanction_post.aided_pyear,sanch_sanction_post.aided_pyear,
	    sanch_sanction_post.partpaided_pyear, sanch_sanction_post.partpaided_pyear,
	    sanch_sanction_post.unaided_pyear,sanch_sanction_post.unaided_pyear,
	    sanch_sanction_post.perunaided_pyear, sanch_sanction_post.perunaided_pyear,
	    sanch_sanction_post.sf_pyear, sanch_sanction_post.sf_pyear,
	    shala_post_master.post_desc,
	    (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear + sanch_sanction_post.unaided_pyear
            + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot,
	        (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear 
                + sanch_sanction_post.unaided_pyear + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot_p
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $schcd . "' 
                        and ac_year='" . $sanch_year . "' and posttype=2 
                        and ( (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
		      or  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  )
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        order by post_id"; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query1;exit();
        $postSanction = $this->query($query1);

//        if ($postSanction[0][0]['tot'] != 0)
//            $tchr_sanch_year = $year[0][0]['max'];
//        else if ($postSanction[0][0]['tot'] == 0) {
//              $tchr_sanch_year = $year[0][0]['max'] - 1;
//        }
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getnonPostScantion($schcd) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT sanch_sanction_post.schcd, 
                    sanch_sanction_post.posttype,
                    sanch_sanction_post.postid,
                    sanch_sanction_post.aided_pyear,
                    sanch_sanction_post.partpaided_pyear,
                    sanch_sanction_post.unaided_pyear,
                    sanch_sanction_post.perunaided_pyear,
                    sanch_sanction_post.sf_pyear,
                    shala_post_master.post_desc,
                    (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear + sanch_sanction_post.unaided_pyear + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $schcd . "' 
                        and ac_year='" . $global_ac_year . "' and posttype=2 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        "; // posttype 1=Teaching 2=Non-Teaching
        $postSanction = $this->query($query);
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function matchedpost($postid, $user_id) {
$global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT sanch_sanction_post.schcd,
                    sanch_sanction_post.posttype,
                    sanch_sanction_post.postid,
                    sanch_sanction_post.aided_pyear,
                    sanch_sanction_post.partpaided_pyear,
                    sanch_sanction_post.unaided_pyear,
                    sanch_sanction_post.perunaided_pyear,
                    sanch_sanction_post.sf_pyear,
                    shala_post_master.post_desc,
                    (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear + sanch_sanction_post.unaided_pyear + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $user_id . "'
                        and ac_year='" . $global_ac_year . "' and posttype=1 and postid=$postid
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0 
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        "; // posttype 1=Teaching 2=Non-Teaching
        $matchedpost = $this->query($query);
        if ($matchedpost <> NULL)
            return $matchedpost;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getPosttypeScantion($user_id) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT sanch_sanction_post.schcd, 
                    sanch_sanction_post.posttype,
                    sanch_sanction_post.postid,
                    sanch_sanction_post.aided_pyear,
                    sanch_sanction_post.partpaided_pyear,
                    sanch_sanction_post.unaided_pyear,
                    sanch_sanction_post.perunaided_pyear,
                    sanch_sanction_post.sf_pyear,
                    shala_post_master.post_desc
                   
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $user_id . "' 
                        and ac_year='" . $global_ac_year . "'    and posttype=1 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        "; // posttype 1=Teaching 2=Non-Teaching
        $postSanction = $this->query($query);
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getnonteachingPosttypeScantion($user_id) {
$global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT sanch_sanction_post.schcd, 
                    sanch_sanction_post.posttype,
                    sanch_sanction_post.postid,
                    sanch_sanction_post.aided_pyear,
                    sanch_sanction_post.partpaided_pyear,
                    sanch_sanction_post.unaided_pyear,
                    sanch_sanction_post.perunaided_pyear,
                    sanch_sanction_post.sf_pyear,
                    shala_post_master.post_desc
                   
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $user_id . "'
                        and ac_year='" . $global_ac_year . "' and posttype='2' 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        "; // posttype 1=Teaching 2=Non-Teaching
        $postSanction = $this->query($query);
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getPosttypecombo($user_id) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT sanch_sanction_post.postid,
                    shala_post_master.post_desc
                   
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $user_id . "' 
                        and ac_year='" . $global_ac_year . "' and posttype=1 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        "; // posttype 1=Teaching 2=Non-Teaching
        $postSanction = $this->query($query);
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function matchednonpost($postid, $user_id) {
$global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT sanch_sanction_post.schcd, 
                    sanch_sanction_post.posttype,
                    sanch_sanction_post.postid,
                    sanch_sanction_post.aided_pyear,
                    sanch_sanction_post.partpaided_pyear,
                    sanch_sanction_post.unaided_pyear,
                    sanch_sanction_post.perunaided_pyear,
                    sanch_sanction_post.sf_pyear,
                    shala_post_master.post_desc,
                    (sanch_sanction_post.aided_pyear+sanch_sanction_post.partpaided_pyear + sanch_sanction_post.unaided_pyear + sanch_sanction_post.perunaided_pyear + sanch_sanction_post.sf_pyear) as tot
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $user_id . "' 
                        and ac_year='" . $global_ac_year . "' and posttype=2 and postid=$postid
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        "; // posttype 1=Teaching 2=Non-Teaching
        $matchedpost = $this->query($query);
        if ($matchedpost <> NULL)
            return $matchedpost;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getPostdesig($user_id, $postsmdesig) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT 
                     shala_post_master.post_desc
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $user_id . "' 
                        and ac_year='" . $global_ac_year . "' and posttype=1 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        "; // posttype 1=Teaching 2=Non-Teaching
        $postSanction = $this->query($query);
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getPostnondesig($user_id, $postsmdesig) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT 
                     shala_post_master.post_desc
                   
                    FROM udise.sanch_sanction_post,udise.shala_post_master
                    where  schcd='" . $user_id . "' 
                        and ac_year='" . $global_ac_year . "' and posttype=2 
                        and  (aided_pyear+ partpaided_pyear+ unaided_pyear+ perunaided_pyear+sf_pyear)>0  
                        and sanch_sanction_post.posttype =shala_post_master.post_type
                        and  sanch_sanction_post.postid =shala_post_master.post_id
                        "; // posttype 1=Teaching 2=Non-Teaching
        $postSanction = $this->query($query);
        if ($postSanction <> NULL)
            return $postSanction;
        else {
            //$result=0;
            return 0;
        }
    }

    public function getRddInterstateStat($stadmin_id) {
        $global_ac_year = Configure::read('global_ac_year');
        $query = "SELECT tmp1.distcd,distname,tmp1.postid, SUM(tchr_count_sanch) as tchr_count_sanch ,SUM(tchr_count_working) as tchr_count_working
FROM 

(SELECT 
distcd,postid, SUM(tchr_count_sanch) as tchr_count_sanch ,SUM(tchr_count_working) as tchr_count_working
	FROM
	( 
		(SELECT  
			substr(ssp.schcd,1,4) as distcd ,
			ssp.postid,  
			(SUM (ssp.aided_cyear + ssp.partpaided_cyear + ssp.unaided_cyear + ssp.perunaided_cyear + ssp.sf_cyear)) as tchr_count_sanch,0 as tchr_count_working  
				FROM udise.sanch_sanction_post as ssp
				    INNER JOIN shala.shala_all_school as sas ON  sas.schcd = ssp.schcd  and sas.highest_class <= '8' and sas.management_details IN ('16','17','18') 
		    where 		ssp.ac_year='" . $global_ac_year . "'
				   AND  ssp.posttype = 1
				   AND  ssp.postid IN ('4','5','7')
			group by ssp.postid, substr(ssp.schcd,1,4) 
		) 
	UNION
		 (SELECT   
			 substr(tm.schl_id,1,4) as distcd ,
			 tm.tchr_curr_desg_cd, 
			 0 as tchr_count_sanch,
			 count(tm.tchr_id) as tchr_count_working  
				FROM  master.tch_master as tm
				 INNER JOIN shala.shala_all_school as sas ON  tm.schl_id = sas.schcd  and sas.highest_class <= '8' and sas.management_details IN ('16','17','18') 

			where 	 
						tm.tchr_type = 1
				   AND  tm.tchr_curr_desg_cd IN ('4','5','7')
			group by tm.tchr_curr_desg_cd, substr(tm.schl_id,1,4) 
		)
	)as tmp
GROUP BY distcd,postid  
) as tmp1

LEFT JOIN master.tchr_post_master as tpm ON tpm.post_id = tmp1.postid AND tpm.post_type='1'
LEFT JOIN shala_live.shala_district as sd ON tmp1.distcd = sd.distcd

GROUP BY tmp1.distcd,distname,tmp1.postid ";
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
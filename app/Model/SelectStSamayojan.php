

<?php

class SelectStSamayojan extends AppModel {

    public $useDbConfig = 'use_db_stat_data';
    var $name = "SelectStSamayojan";
    var $useTable = 'st_samayojan'; //  schema= samayojan

    public function getSchoolListBeoExcess($beo_code) {
        $query = "SELECT schl_id,SAS.school_name
   FROM (
  SELECT schl_id,posttype,postid,
		SUM(tot_filled_aided_cyear_master)tot_filled_aided_cyear_master,
		SUM(tot_filled_partpaided_cyear_master)tot_filled_partpaided_cyear_master,
		SUM(tot_filled_unaided_cyear_master)tot_filled_unaided_cyear_master,
		SUM(tot_filled_perunaided_cyear_master)tot_filled_perunaided_cyear_master,
		SUM(tot_filled_sf_cyear_master)tot_filled_sf_cyear_master,

		SUM(tot_surplus_aided_cyear_master)tot_surplus_aided_cyear_master,
		SUM(tot_surplus_partpaided_cyear_master)tot_surplus_partpaided_cyear_master,
		SUM(tot_surplus_unaided_cyear_master)tot_surplus_unaided_cyear_master,
		SUM(tot_surplus_perunaided_cyear_master)tot_surplus_perunaided_cyear_master,
		SUM(tot_surplus_sf_cyear_master)tot_surplus_sf_cyear_master,

		SUM(tot_sanction_aided_cyear_sanch)tot_sanction_aided_cyear_sanch,   
		SUM(tot_sanction_partpaided_cyear_sanch)tot_sanction_partpaided_cyear_sanch,   
		SUM(tot_sanction_unaided_cyear_sanch)tot_sanction_unaided_cyear_sanch,   
		SUM(tot_sanction_perunaided_cyear_sanch)tot_sanction_perunaided_cyear_sanch   ,
		SUM(tot_sanction_sf_cyear_sanch)tot_sanction_sf_cyear_sanch
		                              
			FROM(
			               (SELECT   TM.schl_id,TM.tchr_type as posttype,TM.tchr_curr_desg_cd as postid,
                           sum(CASE WHEN tchr_mgmt_type =1 THEN 1 ELSE 0 END)as tot_filled_aided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =2 THEN 1 ELSE 0 END)as tot_filled_partpaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =3 THEN 1 ELSE 0 END)as tot_filled_unaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =4 THEN 1 ELSE 0 END)as tot_filled_perunaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =5 THEN 1 ELSE 0 END)as tot_filled_sf_cyear_master,

			  0 as tot_surplus_aided_cyear_master,
			  0 as tot_surplus_partpaided_cyear_master,
			  0 as tot_surplus_unaided_cyear_master,
			  0 as tot_surplus_perunaided_cyear_master,
			  0 as tot_surplus_sf_cyear_master,

			  0 as tot_sanction_aided_cyear_sanch,				 
			  0 as tot_sanction_partpaided_cyear_sanch,				 
			  0 as  tot_sanction_unaided_cyear_sanch,					 
			  0  as tot_sanction_perunaided_cyear_sanch,					 
		          0 as tot_sanction_sf_cyear_sanch 
                            
                     FROM master.tch_master  as TM
                    WHERE   TM.schl_id like '" . $beo_code . "%' and tchr_type = 1
                     GROUP BY TM.tchr_type , TM.tchr_curr_desg_cd,TM.schl_id)
UNION

                 (SELECT  TM.schl_id,TM.tchr_type as posttype,TM.tchr_curr_desg_cd as postid,
                          0 as tot_filled_aided_cyear_master,
   			  0 as tot_filled_partpaided_cyear_master,
			  0 as tot_filled_unaided_cyear_master,
			  0 as tot_filled_perunaided_cyear_master,
			  0 as tot_filled_sf_cyear_master,
			
                          sum(CASE WHEN tchr_mgmt_type =1 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_aided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =2 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_partpaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =3 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_unaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =4 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_perunaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =5 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_sf_cyear_master,

                          0 as tot_sanction_aided_cyear_sanch,				 
			  0 as tot_sanction_partpaided_cyear_sanch,				 
			  0 as  tot_sanction_unaided_cyear_sanch,					 
			  0  as tot_sanction_perunaided_cyear_sanch,					 
		          0 as tot_sanction_sf_cyear_sanch
                            
                     FROM	  master.tch_master  as TM
                      WHERE   	  TM.schl_id like '" . $beo_code . "%' and tchr_type = 1
                     GROUP BY	 TM.tchr_type , TM.tchr_curr_desg_cd,TM.schl_id )
                     
 UNION
                       (SELECT SAS.schcd as schl_id,SSP.posttype,SSP.postid,

                         0 as tot_filled_aided_cyear_master,
   			  0 as tot_filled_partpaided_cyear_master,
			  0 as tot_filled_unaided_cyear_master,
			  0 as tot_filled_perunaided_cyear_master,
			  0 as tot_filled_sf_cyear_master,

			  0 as tot_surplus_aided_cyear_master,
			  0 as tot_surplus_partpaided_cyear_master,
			  0 as tot_surplus_unaided_cyear_master,
			  0 as tot_surplus_perunaided_cyear_master,
			  0 as tot_surplus_sf_cyear_master,
                      
			SSP.aided_pyear as tot_sanction_aided_cyear_sanch,				 
			SSP.partpaided_pyear as tot_sanction_partpaided_cyear_sanch,				 
			SSP.unaided_pyear as  tot_sanction_unaided_cyear_sanch,					 
			SSP. perunaided_pyear as tot_sanction_perunaided_cyear_sanch,					 
		        SSP.sf_pyear as tot_sanction_sf_cyear_sanch
   
		   FROM	     	shala.shala_all_school as SAS  
		   LEFT JOIN 	udise.sanch_sanction_post as SSP ON   SAS.schcd = SSP.schcd 
		   WHERE 	SAS.schcd like '" . $beo_code . "%' and SSP.posttype= 1 and SAS.management_details IN (16,17,18,20)
		   GROUP BY 	SAS.schcd,SSP.ac_year,SSP.posttype, SSP.postid,SSP.aided_pyear ,  SSP.partpaided_pyear ,  SSP.unaided_pyear,  SSP.perunaided_pyear , SSP.sf_pyear
ORDER BY postid )
) as temp

 GROUP BY schl_id,posttype,postid
ORDER BY postid
) as temp1
INNER JOIN shala.shala_all_school as SAS
ON temp1.schl_id = SAS.schcd
WHERE  SAS.management_details IN (16,17,18,20)

group by schl_id,postid,
		 tot_filled_aided_cyear_master,
   			   tot_filled_partpaided_cyear_master,
			   tot_filled_unaided_cyear_master,
			    tot_filled_perunaided_cyear_master,
			    tot_filled_sf_cyear_master,

			    tot_surplus_aided_cyear_master,
			    tot_surplus_partpaided_cyear_master,
			  tot_surplus_unaided_cyear_master,
			  tot_surplus_perunaided_cyear_master,
			  tot_surplus_sf_cyear_master,
                      
			 tot_sanction_aided_cyear_sanch,				 
			 tot_sanction_partpaided_cyear_sanch,				 
			 tot_sanction_unaided_cyear_sanch,					 
			 tot_sanction_perunaided_cyear_sanch,					 
		       tot_sanction_sf_cyear_sanch,SAS.school_name  

having (      (tot_sanction_aided_cyear_sanch      < (tot_filled_aided_cyear_master      - tot_surplus_aided_cyear_master))
         OR   (tot_sanction_partpaided_cyear_sanch < (tot_filled_partpaided_cyear_master - tot_surplus_partpaided_cyear_master))
         OR   (tot_sanction_unaided_cyear_sanch    < (tot_filled_unaided_cyear_master    - tot_surplus_unaided_cyear_master))
         OR   (tot_sanction_perunaided_cyear_sanch < (tot_filled_perunaided_cyear_master - tot_surplus_perunaided_cyear_master))
         OR   (tot_sanction_sf_cyear_sanch     	   < (tot_filled_sf_cyear_master         - tot_surplus_sf_cyear_master))
         )
	   ";  //IMP CHANGE COMPARISON CONDITION FOR DECLARTION OF SURPLUS STAFF
//        echo $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getPostListBeoExcess1234($beo_code) {
        $query = "SELECT schcd, school_name, lowest_class, highest_class, sanstha_code, 
                         ac_year, posttype, postid,tchr_post_master.post_desc, postwise_tot_sanch, postwise_tot_master,tchr_surplus
                  FROM   stat_data.st_samayojan
                  LEFT JOIN master.tchr_post_master
                  ON     st_samayojan.posttype = tchr_post_master.post_type
                  AND    st_samayojan.postid = tchr_post_master.post_id
                  WHERE  schcd like '" . $beo_code . "%'
                  AND    posttype =1 
                  AND    postwise_tot_sanch < (postwise_tot_master - tchr_surplus)";  //IMP CHANGE COMPARISON CONDITION FOR DECLARTION OF SURPLUS STAFF
//        echo $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getExcessPostListUnderSchool($schl_id) {
        $query = "SELECT schl_id,post_type,post_id,post_desc
   FROM (
  SELECT schl_id,posttype,postid,
		SUM(tot_filled_aided_cyear_master)tot_filled_aided_cyear_master,
		SUM(tot_filled_partpaided_cyear_master)tot_filled_partpaided_cyear_master,
		SUM(tot_filled_unaided_cyear_master)tot_filled_unaided_cyear_master,
		SUM(tot_filled_perunaided_cyear_master)tot_filled_perunaided_cyear_master,
		SUM(tot_filled_sf_cyear_master)tot_filled_sf_cyear_master,

		SUM(tot_surplus_aided_cyear_master)tot_surplus_aided_cyear_master,
		SUM(tot_surplus_partpaided_cyear_master)tot_surplus_partpaided_cyear_master,
		SUM(tot_surplus_unaided_cyear_master)tot_surplus_unaided_cyear_master,
		SUM(tot_surplus_perunaided_cyear_master)tot_surplus_perunaided_cyear_master,
		SUM(tot_surplus_sf_cyear_master)tot_surplus_sf_cyear_master,

		SUM(tot_sanction_aided_cyear_sanch)tot_sanction_aided_cyear_sanch,   
		SUM(tot_sanction_partpaided_cyear_sanch)tot_sanction_partpaided_cyear_sanch,   
		SUM(tot_sanction_unaided_cyear_sanch)tot_sanction_unaided_cyear_sanch,   
		SUM(tot_sanction_perunaided_cyear_sanch)tot_sanction_perunaided_cyear_sanch   ,
		SUM(tot_sanction_sf_cyear_sanch)tot_sanction_sf_cyear_sanch
		                              
			FROM(
			               (SELECT   TM.schl_id,TM.tchr_type as posttype,TM.tchr_curr_desg_cd as postid,
                           sum(CASE WHEN tchr_mgmt_type =1 THEN 1 ELSE 0 END)as tot_filled_aided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =2 THEN 1 ELSE 0 END)as tot_filled_partpaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =3 THEN 1 ELSE 0 END)as tot_filled_unaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =4 THEN 1 ELSE 0 END)as tot_filled_perunaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =5 THEN 1 ELSE 0 END)as tot_filled_sf_cyear_master,

			  0 as tot_surplus_aided_cyear_master,
			  0 as tot_surplus_partpaided_cyear_master,
			  0 as tot_surplus_unaided_cyear_master,
			  0 as tot_surplus_perunaided_cyear_master,
			  0 as tot_surplus_sf_cyear_master,

			  0 as tot_sanction_aided_cyear_sanch,				 
			  0 as tot_sanction_partpaided_cyear_sanch,				 
			  0 as  tot_sanction_unaided_cyear_sanch,					 
			  0  as tot_sanction_perunaided_cyear_sanch,					 
		          0 as tot_sanction_sf_cyear_sanch 
                            
                     FROM master.tch_master  as TM
                    WHERE   TM.schl_id like '" . $schl_id . "' and tchr_type = 1
                     GROUP BY TM.tchr_type , TM.tchr_curr_desg_cd,TM.schl_id)
UNION

                 (SELECT  TM.schl_id,TM.tchr_type as posttype,TM.tchr_curr_desg_cd as postid,
                          0 as tot_filled_aided_cyear_master,
   			  0 as tot_filled_partpaided_cyear_master,
			  0 as tot_filled_unaided_cyear_master,
			  0 as tot_filled_perunaided_cyear_master,
			  0 as tot_filled_sf_cyear_master,
			
                          sum(CASE WHEN tchr_mgmt_type =1 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_aided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =2 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_partpaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =3 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_unaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =4 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_perunaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =5 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_sf_cyear_master,

                          0 as tot_sanction_aided_cyear_sanch,				 
			  0 as tot_sanction_partpaided_cyear_sanch,				 
			  0 as  tot_sanction_unaided_cyear_sanch,					 
			  0  as tot_sanction_perunaided_cyear_sanch,					 
		          0 as tot_sanction_sf_cyear_sanch
                            
                     FROM	  master.tch_master  as TM
                      WHERE   	  TM.schl_id like '" . $schl_id . "' and tchr_type = 1
                     GROUP BY	 TM.tchr_type , TM.tchr_curr_desg_cd,TM.schl_id )
                     
 UNION
                       (SELECT SAS.schcd as schl_id,SSP.posttype,SSP.postid,

                         0 as tot_filled_aided_cyear_master,
   			  0 as tot_filled_partpaided_cyear_master,
			  0 as tot_filled_unaided_cyear_master,
			  0 as tot_filled_perunaided_cyear_master,
			  0 as tot_filled_sf_cyear_master,

			  0 as tot_surplus_aided_cyear_master,
			  0 as tot_surplus_partpaided_cyear_master,
			  0 as tot_surplus_unaided_cyear_master,
			  0 as tot_surplus_perunaided_cyear_master,
			  0 as tot_surplus_sf_cyear_master,
                      
			SSP.aided_pyear as tot_sanction_aided_cyear_sanch,				 
			SSP.partpaided_pyear as tot_sanction_partpaided_cyear_sanch,				 
			SSP.unaided_pyear as  tot_sanction_unaided_cyear_sanch,					 
			SSP. perunaided_pyear as tot_sanction_perunaided_cyear_sanch,					 
		        SSP.sf_pyear as tot_sanction_sf_cyear_sanch
   
		   FROM	     	shala.shala_all_school as SAS  
		   LEFT JOIN 	udise.sanch_sanction_post as SSP ON   SAS.schcd = SSP.schcd 
		   WHERE 	SAS.schcd like '" . $schl_id . "' AND SSP.posttype= 1 AND SAS.management_details IN (16,17,18,20)
		   GROUP BY 	SAS.schcd,SSP.ac_year,SSP.posttype, SSP.postid,SSP.aided_pyear ,  SSP.partpaided_pyear ,  SSP.unaided_pyear,  SSP.perunaided_pyear , SSP.sf_pyear
ORDER BY postid )
) as temp

 GROUP BY schl_id,posttype,postid
ORDER BY postid
) as temp1
INNER JOIN master.tchr_post_master as TPM
  ON   		  temp1.posttype = TPM.post_type
       AND        temp1.postid = TPM.post_id
 

group by schl_id,post_type,post_id,post_desc,
		 tot_filled_aided_cyear_master,
   			   tot_filled_partpaided_cyear_master,
			   tot_filled_unaided_cyear_master,
			    tot_filled_perunaided_cyear_master,
			    tot_filled_sf_cyear_master,

			    tot_surplus_aided_cyear_master,
			    tot_surplus_partpaided_cyear_master,
			  tot_surplus_unaided_cyear_master,
			  tot_surplus_perunaided_cyear_master,
			  tot_surplus_sf_cyear_master,
                      
			 tot_sanction_aided_cyear_sanch,				 
			 tot_sanction_partpaided_cyear_sanch,				 
			 tot_sanction_unaided_cyear_sanch,					 
			 tot_sanction_perunaided_cyear_sanch,					 
		       tot_sanction_sf_cyear_sanch

having (      (tot_sanction_aided_cyear_sanch      < (tot_filled_aided_cyear_master      - tot_surplus_aided_cyear_master))
         OR   (tot_sanction_partpaided_cyear_sanch < (tot_filled_partpaided_cyear_master - tot_surplus_partpaided_cyear_master))
         OR   (tot_sanction_unaided_cyear_sanch    < (tot_filled_unaided_cyear_master    - tot_surplus_unaided_cyear_master))
         OR   (tot_sanction_perunaided_cyear_sanch < (tot_filled_perunaided_cyear_master - tot_surplus_perunaided_cyear_master))
         OR   (tot_sanction_sf_cyear_sanch     	   < (tot_filled_sf_cyear_master         - tot_surplus_sf_cyear_master))
         )
	   ";  //IMP CHANGE COMPARISON CONDITION FOR DECLARTION OF SURPLUS STAFF
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getExcessPostMgmtListUnderPost($schl_id = '', $post_type = 0, $post_id = 0) {//GET EXCESS STAFF ONLY
        $query = "SELECT schl_id,posttype,postid,
	CASE
            WHEN (tot_sanction_aided_cyear_sanch<(tot_filled_aided_cyear_master - tot_surplus_aided_cyear_master)) THEN   (tot_filled_aided_cyear_master  - (tot_sanction_aided_cyear_sanch+ tot_surplus_aided_cyear_master))
		ELSE 0 
           END AS aided ,
        CASE
            WHEN (tot_sanction_partpaided_cyear_sanch < (tot_filled_partpaided_cyear_master - tot_surplus_partpaided_cyear_master)) THEN  (tot_filled_partpaided_cyear_master  - (tot_sanction_partpaided_cyear_sanch+ tot_surplus_partpaided_cyear_master))
		ELSE 0 
           END AS partpaided ,
           CASE
            WHEN  (tot_sanction_unaided_cyear_sanch    < (tot_filled_unaided_cyear_master    - tot_surplus_unaided_cyear_master)) THEN  (tot_filled_unaided_cyear_master  - (tot_sanction_unaided_cyear_sanch+ tot_surplus_unaided_cyear_master))
		ELSE 0 
           END AS unaided ,
           CASE
            WHEN (tot_sanction_perunaided_cyear_sanch < (tot_filled_perunaided_cyear_master - tot_surplus_perunaided_cyear_master)) THEN  (tot_filled_perunaided_cyear_master  - (tot_sanction_perunaided_cyear_sanch+ tot_surplus_perunaided_cyear_master))
		ELSE 0 
           END AS perunaided, 
           CASE
            WHEN (tot_sanction_sf_cyear_sanch      < (tot_filled_sf_cyear_master         - tot_surplus_sf_cyear_master)) THEN  (tot_filled_sf_cyear_master  - (tot_sanction_sf_cyear_sanch + tot_surplus_sf_cyear_master))
		ELSE 0 
           END AS sf 
 
   FROM (
  SELECT schl_id,posttype,postid,
		SUM(tot_filled_aided_cyear_master)tot_filled_aided_cyear_master,
		SUM(tot_filled_partpaided_cyear_master)tot_filled_partpaided_cyear_master,
		SUM(tot_filled_unaided_cyear_master)tot_filled_unaided_cyear_master,
		SUM(tot_filled_perunaided_cyear_master)tot_filled_perunaided_cyear_master,
		SUM(tot_filled_sf_cyear_master)tot_filled_sf_cyear_master,

		SUM(tot_surplus_aided_cyear_master)tot_surplus_aided_cyear_master,
		SUM(tot_surplus_partpaided_cyear_master)tot_surplus_partpaided_cyear_master,
		SUM(tot_surplus_unaided_cyear_master)tot_surplus_unaided_cyear_master,
		SUM(tot_surplus_perunaided_cyear_master)tot_surplus_perunaided_cyear_master,
		SUM(tot_surplus_sf_cyear_master)tot_surplus_sf_cyear_master,

		SUM(tot_sanction_aided_cyear_sanch)tot_sanction_aided_cyear_sanch,   
		SUM(tot_sanction_partpaided_cyear_sanch)tot_sanction_partpaided_cyear_sanch,   
		SUM(tot_sanction_unaided_cyear_sanch)tot_sanction_unaided_cyear_sanch,   
		SUM(tot_sanction_perunaided_cyear_sanch)tot_sanction_perunaided_cyear_sanch   ,
		SUM(tot_sanction_sf_cyear_sanch)tot_sanction_sf_cyear_sanch
		                              
			FROM(
			               (SELECT   TM.schl_id,TM.tchr_type as posttype,TM.tchr_curr_desg_cd as postid,
                           sum(CASE WHEN tchr_mgmt_type =1 THEN 1 ELSE 0 END)as tot_filled_aided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =2 THEN 1 ELSE 0 END)as tot_filled_partpaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =3 THEN 1 ELSE 0 END)as tot_filled_unaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =4 THEN 1 ELSE 0 END)as tot_filled_perunaided_cyear_master,
                           sum(CASE WHEN tchr_mgmt_type =5 THEN 1 ELSE 0 END)as tot_filled_sf_cyear_master,

			  0 as tot_surplus_aided_cyear_master,
			  0 as tot_surplus_partpaided_cyear_master,
			  0 as tot_surplus_unaided_cyear_master,
			  0 as tot_surplus_perunaided_cyear_master,
			  0 as tot_surplus_sf_cyear_master,

			  0 as tot_sanction_aided_cyear_sanch,				 
			  0 as tot_sanction_partpaided_cyear_sanch,				 
			  0 as  tot_sanction_unaided_cyear_sanch,					 
			  0  as tot_sanction_perunaided_cyear_sanch,					 
		          0 as tot_sanction_sf_cyear_sanch 
                       
                     FROM master.tch_master  as TM
                    WHERE   TM.schl_id like '" . $schl_id . "' and tchr_type = $post_type and  tchr_curr_desg_cd = $post_id
                     GROUP BY TM.tchr_type , TM.tchr_curr_desg_cd,TM.schl_id)
UNION

                 (SELECT  TM.schl_id,TM.tchr_type as posttype,TM.tchr_curr_desg_cd as postid,
                          0 as tot_filled_aided_cyear_master,
   			  0 as tot_filled_partpaided_cyear_master,
			  0 as tot_filled_unaided_cyear_master,
			  0 as tot_filled_perunaided_cyear_master,
			  0 as tot_filled_sf_cyear_master,
			
                          sum(CASE WHEN tchr_mgmt_type =1 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_aided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =2 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_partpaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =3 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_unaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =4 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_perunaided_cyear_master,
                          sum(CASE WHEN tchr_mgmt_type =5 AND tchr_surplus ='Y' THEN 1 ELSE 0 END)as tot_surplus_sf_cyear_master,

                          0 as tot_sanction_aided_cyear_sanch,				 
			  0 as tot_sanction_partpaided_cyear_sanch,				 
			  0 as  tot_sanction_unaided_cyear_sanch,					 
			  0  as tot_sanction_perunaided_cyear_sanch,					 
		          0 as tot_sanction_sf_cyear_sanch
                         
                     FROM	  master.tch_master  as TM
                      WHERE   	  TM.schl_id like '" . $schl_id . "' and tchr_type = $post_type and  tchr_curr_desg_cd = $post_id
                     GROUP BY	 TM.tchr_type , TM.tchr_curr_desg_cd,TM.schl_id )
                     
 UNION
                       (SELECT SAS.schcd as schl_id,SSP.posttype,SSP.postid,

                         0 as tot_filled_aided_cyear_master,
   			  0 as tot_filled_partpaided_cyear_master,
			  0 as tot_filled_unaided_cyear_master,
			  0 as tot_filled_perunaided_cyear_master,
			  0 as tot_filled_sf_cyear_master,

			  0 as tot_surplus_aided_cyear_master,
			  0 as tot_surplus_partpaided_cyear_master,
			  0 as tot_surplus_unaided_cyear_master,
			  0 as tot_surplus_perunaided_cyear_master,
			  0 as tot_surplus_sf_cyear_master,
                      
			SSP.aided_pyear as tot_sanction_aided_cyear_sanch,				 
			SSP.partpaided_pyear as tot_sanction_partpaided_cyear_sanch,				 
			SSP.unaided_pyear as  tot_sanction_unaided_cyear_sanch,					 
			SSP. perunaided_pyear as tot_sanction_perunaided_cyear_sanch,					 
		        SSP.sf_pyear as tot_sanction_sf_cyear_sanch

FROM	     	shala.shala_all_school as SAS  
		   LEFT JOIN 	udise.sanch_sanction_post as SSP ON   SAS.schcd = SSP.schcd 
		   WHERE 	SAS.schcd like '" . $schl_id . "' and posttype= $post_type and postid = $post_id
		   GROUP BY 	SAS.schcd,SSP.ac_year,SSP.posttype, SSP.postid,SSP.aided_pyear,SSP.partpaided_pyear,SSP.unaided_pyear,SSP.perunaided_pyear , SSP.sf_pyear
ORDER BY postid )
) as temp

 GROUP BY schl_id,posttype,postid
ORDER BY postid
) as temp1 

group by schl_id,postid,posttype,
		 tot_filled_aided_cyear_master,
   			   tot_filled_partpaided_cyear_master,
			   tot_filled_unaided_cyear_master,
			    tot_filled_perunaided_cyear_master,
			    tot_filled_sf_cyear_master,

			    tot_surplus_aided_cyear_master,
			    tot_surplus_partpaided_cyear_master,
			  tot_surplus_unaided_cyear_master,
			  tot_surplus_perunaided_cyear_master,
			  tot_surplus_sf_cyear_master,
                      
			 tot_sanction_aided_cyear_sanch,				 
			 tot_sanction_partpaided_cyear_sanch,				 
			 tot_sanction_unaided_cyear_sanch,					 
			 tot_sanction_perunaided_cyear_sanch,					 
		       tot_sanction_sf_cyear_sanch 

having (      (tot_sanction_aided_cyear_sanch      < (tot_filled_aided_cyear_master      - tot_surplus_aided_cyear_master))
         OR   (tot_sanction_partpaided_cyear_sanch < (tot_filled_partpaided_cyear_master - tot_surplus_partpaided_cyear_master))
         OR   (tot_sanction_unaided_cyear_sanch    < (tot_filled_unaided_cyear_master    - tot_surplus_unaided_cyear_master))
         OR   (tot_sanction_perunaided_cyear_sanch < (tot_filled_perunaided_cyear_master - tot_surplus_perunaided_cyear_master))
         OR   (tot_sanction_sf_cyear_sanch     	   < (tot_filled_sf_cyear_master         - tot_surplus_sf_cyear_master))
         )
	   ";  //IMP CHANGE COMPARISON CONDITION FOR DECLARTION OF SURPLUS STAFF
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getPostManagment($inMgmtCondition) {
        $query = "SELECT  code_value, code_text
                     FROM master.cddir where code_type like 'TM' AND code_value IN $inMgmtCondition ORDER BY code_value";
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSchoolListUnderPostExcess1234($beo_code, $post_type, $post_id) {
        $query = "SELECT schcd, school_name, lowest_class, highest_class, sanstha_code, 
                         ac_year, posttype, postid,tchr_post_master.post_desc, postwise_tot_sanch, postwise_tot_master,tchr_surplus
                  FROM   stat_data.st_samayojan
                  LEFT JOIN master.tchr_post_master
                  ON     st_samayojan.posttype = tchr_post_master.post_type
                  AND    st_samayojan.postid = tchr_post_master.post_id
                  WHERE  schcd like '" . $beo_code . "%'
                  AND    posttype =" . $post_type . "
                  AND  postid =" . $post_id . "
                  AND    postwise_tot_sanch < (postwise_tot_master - tchr_surplus)";  //IMP CHANGE COMPARISON CONDITION FOR DECLARTION OF SURPLUS STAFF
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getTeacherAllInformation($schl_id, $post_type, $post_id, $excessPostMgmtId) {
        if ($excessPostMgmtId == 1) {
            $sanch_mgmt_type = 'SSP.aided_pyear';
        } else if ($excessPostMgmtId == 2) {
            $sanch_mgmt_type = 'SSP.partpaided_pyear';
        } else if ($excessPostMgmtId == 3) {
            $sanch_mgmt_type = 'SSP.unaided_pyear';
        } else if ($excessPostMgmtId == 4) {
            $sanch_mgmt_type = 'SSP.perunaided_pyear';
        } else if ($excessPostMgmtId == 5) {
            $sanch_mgmt_type = 'SSP.sf_pyear';
        } else {
            $sanch_mgmt_type = 0;
        }

        $query = " SELECT   TM.*,TPM.post_desc,
                            age(current_date , tchr_birth_dt) as age, 
                            date_part('year',age(current_date, tchr_birth_dt)) as year,
                            date_part('month',age(current_date, tchr_birth_dt)) as month,
                            date_part('day',age(current_date, tchr_birth_dt)) as day," .
                $sanch_mgmt_type . " as sanch_sanction_staff
                   FROM         master.tch_master as TM
                   LEFT JOIN    master.tchr_post_master as TPM
                    ON		TM.tchr_type = TPM.post_type 
                            AND TM.tchr_curr_desg_cd = TPM.post_id
                   LEFT JOIN    udise.sanch_sanction_post as SSP 
		    ON           TM.schl_id = SSP.schcd 
                            AND  TM.tchr_type = SSP.posttype  
                            AND  TM.tchr_curr_desg_cd = SSP.postid
                    WHERE 
                                TM.schl_id = '" . $schl_id . "' 
                            AND TM.tchr_type = $post_type
                            AND TM.tchr_curr_desg_cd = $post_id
                            AND TM.tchr_mgmt_type = $excessPostMgmtId
                    ORDER BY year DESC,tchr_curr_sch_dt  DESC
                 ";
//        echo "" . $query; exit();// ,tchr_curr_sch_dt ASC
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getTeacherAllInformationCommitteeMember($schl_id) {
        $dist_cd = (substr($schl_id, 0, 4));
        $query = "SELECT  tchr_id, tcm_type FROM samayojan.committee_member where distcd  ='" . $dist_cd . "'
                  ";  //IMP CHANGE COMPARISON CONDITION FOR DECLARTION OF SURPLUS STAFF
//        echo $query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

}
?>
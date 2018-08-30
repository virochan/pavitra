<?php

$conn_string = "host=10.153.16.179 port=5432 dbname=Teacher user=postgres password=postgres";
$dbconn = pg_connect($conn_string);

$query = "delete from stat_data.stat_sm_ph";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());

$query = "delete from stat_data.st_tch_ntch_ph";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());

$query = "delete from stat_data.stat_sm_gender";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());

$query = "delete from stat_data.st_tch_ntch_gender";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());

$query = "delete from stat_data.st_tch_ntch_cstcateg";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());

$query = "delete from stat_data.stat_sm_cstcateg";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());

$query = "delete from stat_data.st_tch_ntch_mapping";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());


$query = "delete from stat_data.st_sm_tch_ntch_tot";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());


$query = "INSERT INTO stat_data.st_sm_tch_ntch_tot(
SELECT  sm.sch_cd,sh.school_name,sm.ac_year, sm.state_cd, sm.dist_cd, sm.blk_cd, sm.vil_cd, sm.clu_cd,sm.tchr_type,COALESCE(sum(sm.sch_sm_tot),0) AS sch_sm_tot
FROM   stat_data.st_sm_tch_ntch_post  sm
LEFT JOIN shala.shala_all_school sh ON sm.sch_cd = sh.schcd
Group by  sm.sch_cd, sm.ac_year, sm.state_cd, sm.dist_cd, sm.blk_cd, sm.clu_cd, sm.vil_cd , sm.tchr_type,sh.school_name)";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());

$query = "insert into stat_data.st_tch_ntch_gender(SELECT sk.sch_cd,sk.ac_year,
    COALESCE(ss.tchr_type,0)tchr_type,
    substr(sk.sch_cd::text, 1,2) AS state_cd,
    substr(sk.sch_cd::text, 1, 4) AS dist_cd,
    substr(sk.sch_cd::text, 1, 6) AS blk_cd,
    substr(sk.sch_cd::text, 1, 9) AS vil_cd,
    substr(sk.clu_cd::text, 1, 10) AS clu_cd,
        CASE
            WHEN ss.tchr_gender::integer = 1 THEN count(1)
            ELSE 0
        END AS sch_male_tot,
        CASE
            WHEN ss.tchr_gender::integer = 2 THEN count(1)
            ELSE 0
        END AS sch_female_tot,
        CASE
            WHEN ss.tchr_gender::integer = 3 THEN count(1)
            ELSE 0
        END AS sch_trans_tot
  FROM stat_data.st_sm_tch_ntch_tot sk
  LEFT JOIN master.tch_master ss ON sk.sch_cd = ss.schl_id and sk.tchr_type=ss.tchr_type and ss.asst_flag='V'
  GROUP BY substr(sk.sch_cd::text, 1, 4), substr(sk.sch_cd::text, 1, 6), sk.clu_cd, ss.schl_id, sk.sch_cd, ss.tchr_type, ss.tchr_gender,sk.ac_year
  ORDER BY ss.schl_id)";

$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());


$query = "insert into stat_data.stat_sm_gender(
   SELECT  sm.sch_cd,sh.school_name, sm.ac_year, sm.tchr_type, sm.state_cd, sm.dist_cd, sm.blk_cd, sm.vil_cd, sm.clu_cd,  COALESCE(sm.sch_sm_tot,0) AS sch_sm_tot,
           COALESCE(sum(sg.sch_male_tot),0)AS sch_male_tot, COALESCE(sum(sg.sch_female_tot),0)AS sch_female_tot, COALESCE(sum(sg.sch_trans_tot),0)AS sch_trans_tot
   FROM   stat_data.st_sm_tch_ntch_tot sm
   LEFT JOIN shala.shala_all_school sh ON sm.sch_cd = sh.schcd 
   LEFT JOIN stat_data.st_tch_ntch_gender sg ON (sm.sch_cd = sg.sch_cd and sm.tchr_type = sg.tchr_type)   
   Group by  sm.sch_cd, sm.ac_year, sm.tchr_type, sm.state_cd, sm.dist_cd, sm.blk_cd, sm.clu_cd, sm.vil_cd , sm.sch_sm_tot,sh.school_name)
";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());


$query = "INSERT INTO  stat_data.st_tch_ntch_ph(SELECT sk.sch_cd,
sk.ac_year,
COALESCE(ss.tchr_type,0)tchr_type,
substr(sk.sch_cd::text, 1,2) AS state_cd,
substr(sk.sch_cd::text, 1, 4) AS dist_cd,
substr(sk.sch_cd::text, 1, 6) AS blk_cd,
substr(sk.sch_cd::text, 1, 9) AS vil_cd,
substr(sk.clu_cd::text, 1, 10) AS clu_cd,
        CASE
            WHEN sc.ph_cd='1' THEN count(1)
            ELSE 0::bigint
        END AS sch_ortho_tot,
        CASE
            WHEN  sc.ph_cd='2' THEN count(1)
            ELSE 0::bigint
        END AS sch_deafanddumb_tot,
        CASE
          WHEN  sc.ph_cd='3' THEN count(1)
            ELSE 0::bigint
        END AS sch_visuallydisabled_tot
   FROM master.tchr_ph AS sc,stat_data.st_sm_tch_ntch_tot AS sk
   LEFT JOIN master.tch_master ss ON sk.sch_cd = ss.schl_id
   WHERE ss.tchr_id = sc.tchr_id and sk.tchr_type = ss.tchr_type and ss.asst_flag='V'
  GROUP BY sk.ac_year, substr(sk.sch_cd::text, 1, 4), substr(sk.sch_cd::text, 1, 6), sk.clu_cd, ss.schl_id, sk.sch_cd,sc.ph_cd,ss.tchr_type

  ORDER BY ss.schl_id)
";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());


$query = "INSERT INTO  stat_data.stat_sm_ph(SELECT  sm.sch_cd,sm.sch_name, sm.ac_year, sm.tchr_type, sm.state_cd, sm.dist_cd, sm.blk_cd, sm.vil_cd, sm.clu_cd,COALESCE(sch_sm_tot,0)sch_sm_tot,

        CASE
WHEN  sum(sg. sch_ortho_tot) > 0  THEN  sum(sg. sch_ortho_tot)
            ELSE 0::bigint
        END AS sch_ortho_tot,
        CASE
WHEN  sum(sg. sch_Deafanddumb_tot) > 0  THEN  sum(sg. sch_Deafanddumb_tot)
            ELSE 0::bigint
        END AS sch_Deafanddumb_tot,
        CASE
WHEN  sum(sg. sch_visuallydisabled_tot) > 0  THEN  sum(sg. sch_visuallydisabled_tot)
            ELSE 0::bigint
        END AS sch_visuallydisabled_tot

   FROM   stat_data.st_sm_tch_ntch_tot sm

   LEFT JOIN stat_data.st_tch_ntch_ph sg ON (sm.sch_cd = sg.sch_cd and sm.tchr_type = sg.tchr_type) 
   Group by  sm.sch_cd, sm.ac_year,sm.state_cd, sm.dist_cd, sm.blk_cd, sm.clu_cd, sm.vil_cd , sm.sch_sm_tot,sm.sch_name, sm.tchr_type)
";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());


$query = "INSERT INTO  stat_data.st_tch_ntch_cstcateg(SELECT sk.sch_cd,
sk.ac_year,
COALESCE(ss.tchr_type,0)tchr_type,

substr(sk.sch_cd::text, 1,2) AS state_cd,
substr(sk.sch_cd::text, 1, 4) AS dist_cd,
substr(sk.sch_cd::text, 1, 6) AS blk_cd,
substr(sk.sch_cd::text, 1, 9) AS vil_cd,
substr(sk.clu_cd::text, 1, 10) AS clu_cd,

        CASE
            WHEN sc.tc_categ  = 1  THEN count(1)
            ELSE 0::bigint
        END AS sch_gen_tot,
        CASE
            WHEN sc.tc_categ  = 2 THEN count(1)
            ELSE 0::bigint
        END AS sch_sc_tot,
        CASE
            WHEN sc.tc_categ  = 3 THEN count(1)
            ELSE 0::bigint
        END AS sch_st_tot,
        CASE
            WHEN sc.tc_categ  = 4 THEN count(1)
            ELSE 0::bigint
        END AS sch_obc_tot,
       CASE
       WHEN sc.tc_categ  = 10 THEN count(1)
            ELSE 0::bigint
        END AS sch_vj_tot,
       CASE
       WHEN sc.tc_categ  = 12 THEN count(1)
            ELSE 0::bigint
        END AS sch_sbc_tot,
       CASE
       WHEN sc.tc_categ  = 13 THEN count(1)
            ELSE 0::bigint
        END AS sch_ntb_tot,
       CASE
       WHEN sc.tc_categ  = 14 THEN count(1)
            ELSE 0::bigint
        END AS sch_ntc_tot,
       CASE
       WHEN sc.tc_categ  = 15 THEN count(1)
            ELSE 0::bigint
        END AS sch_ntd_tot,
       CASE
       WHEN sc.tc_categ  = 16 THEN count(1)
            ELSE 0::bigint
        END AS sch_spbc_tot

   FROM stat_data.st_sm_tch_ntch_tot sk
   LEFT JOIN master.tch_master ss ON sk.sch_cd = ss.schl_id ,master.tchr_caste_cert sc
   WHERE ss.tchr_id = sc.tchr_id and ss.asst_flag='V'
  GROUP BY sk.ac_year, substr(sk.sch_cd::text, 1, 4), substr(sk.sch_cd::text, 1, 6), sk.clu_cd, ss.schl_id, sk.sch_cd, ss.tchr_type, sc.tc_categ

  ORDER BY ss.schl_id)";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error()); 



$query = "INSERT INTO stat_data.stat_sm_cstcateg(SELECT  sm.sch_cd,sm.sch_name, sm.ac_year, sm.tchr_type, sm.state_cd, sm.dist_cd, sm.blk_cd, sm.vil_cd, sm.clu_cd,sm.sch_sm_tot, 

        CASE
WHEN  sum(sg.sch_gen_tot) > 0  THEN  sum(sg.sch_gen_tot)
            ELSE 0::bigint
        END AS sch_gen_tot,
        CASE
WHEN  sum(sg.sch_sc_tot) > 0  THEN  sum(sg.sch_sc_tot)
            ELSE 0::bigint
        END AS sch_sc_tot,
        CASE
WHEN  sum(sg.sch_st_tot) > 0  THEN  sum(sg.sch_st_tot)
            ELSE 0::bigint
        END AS sch_st_tot,
        CASE
WHEN  sum(sg.sch_obc_tot) > 0  THEN  sum(sg.sch_obc_tot)
            ELSE 0::bigint
        END AS sch_obc_tot,
        CASE
WHEN  sum(sg.sch_vj_tot) > 0  THEN  sum(sg.sch_vj_tot)
            ELSE 0::bigint
        END AS sch_vj_tot,
        CASE
WHEN  sum(sg.sch_sbc_tot) > 0  THEN  sum(sg.sch_sbc_tot)
            ELSE 0::bigint
        END AS sch_sbc_tot,
        CASE
WHEN  sum(sg.sch_ntb_tot) > 0  THEN  sum(sg.sch_ntb_tot)
            ELSE 0::bigint
        END AS sch_ntb_tot,
        CASE
WHEN  sum(sg.sch_ntc_tot) > 0  THEN  sum(sg.sch_ntc_tot)
            ELSE 0::bigint
        END AS sch_ntc_tot,        
        CASE
WHEN  sum(sg.sch_ntd_tot) > 0  THEN  sum(sg.sch_ntd_tot)
            ELSE 0::bigint
        END AS sch_ntd_tot,  
        CASE
WHEN  sum(sg.sch_spbc_tot) > 0  THEN  sum(sg.sch_spbc_tot)
            ELSE 0::bigint
        END AS sch_spbc_tot

   FROM   stat_data.st_sm_tch_ntch_tot sm

   LEFT JOIN stat_data.st_tch_ntch_cstcateg sg ON (sm.sch_cd = sg.sch_cd and sm.tchr_type = sg.tchr_type) 

   Group by  sm.sch_cd, sm.ac_year,  sm.state_cd, sm.dist_cd, sm.blk_cd, sm.clu_cd, sm.vil_cd , sm.sch_sm_tot,sm.sch_name, sm.tchr_type)";
$result = pg_query($query)
        or die('Query failed: ' . pg_last_error());

//$nandurbar = pg_fetch_array($result, null, PGSQL_ASSOC);

$query = "INSERT INTO stat_data.st_tch_ntch_mapping(SELECT sk.sch_cd,sk.sch_name,
sk.ac_year,
COALESCE(sk.tchr_type,0)tchr_type,
substr(sk.sch_cd::text, 1,2) AS state_cd,
substr(sk.sch_cd::text, 1, 4) AS dist_cd,
substr(sk.sch_cd::text, 1, 6) AS blk_cd,
substr(sk.sch_cd::text, 1, 9) AS vil_cd,
substr(sk.clu_cd::text, 1, 10) AS clu_cd,

CASE
WHEN ss.asst_flag = 'M' THEN count(1)
ELSE 0::bigint
END AS sch_mapped_tot,
CASE
WHEN ss.asst_flag = 'U' THEN count(1)
ELSE 0::bigint
END AS sch_updated_tot,
CASE
WHEN ss.asst_flag = 'F' THEN count(1)
ELSE 0::bigint
END AS sch_forwarded_tot,
CASE
WHEN ss.asst_flag = 'V' THEN count(1)
ELSE 0::bigint
END AS sch_verified_tot,

CASE
WHEN sk.tchr_type = '1' THEN sch_sm_tot
ELSE 0::bigint
END AS sch_teaching_tot,

CASE
WHEN sk.tchr_type = '2' THEN sch_sm_tot
ELSE 0::bigint
END AS sch_non_teaching_tot

FROM stat_data.st_sm_tch_ntch_tot sk
LEFT JOIN master.tch_master ss
ON  ss.tchr_type=sk.tchr_type and  ss.schl_id=sk.sch_cd and ss.asst_flag='V'
GROUP BY sk.ac_year,substr(sk.sch_cd::text, 1, 4), substr(sk.sch_cd::text, 1, 6), sk.clu_cd, ss.schl_id, sk.sch_cd, ss.tchr_type,ss.asst_flag,sk.tchr_type,sch_sm_tot,sk.sch_name
ORDER BY ss.schl_id)";
$result = pg_query($query)
        or die('Query failed: '. pg_last_error());

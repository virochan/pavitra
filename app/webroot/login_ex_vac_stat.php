<?php

//$conn_string = "host=10.153.16.179 port=5432 dbname=Teacher_19_08_2017 user=postgres password=postgres";
//$conn_string = "host=localhost port=5432 dbname=StudentDatabase user=postgres password=root";
$conn_string = "host=10.187.200.13 port=6432 dbname=teacher user=postgres password=pass@123";
$dbconn = pg_connect($conn_string);


$truncate_ex_vac_count = "truncate table samayojan.ex_vac_count";
$truncate_ex_vac_count = pg_query($truncate_ex_vac_count) or die('Query failed: ' . pg_last_error());

$truncate_ex_staff_count = "truncate table samayojan.ex_staff_count";
$truncate_ex_staff_count = pg_query($truncate_ex_staff_count) or die('Query failed: ' . pg_last_error());

$truncate_minorty_nonminority_count = "truncate table samayojan.minorty_nonminority_count";
$truncate_minorty_nonminority_count = pg_query($truncate_minorty_nonminority_count) or die('Query failed: ' . pg_last_error());


$insert_ex_staff_count = "insert into samayojan.ex_staff_count(select 
sanstha_code,schl_id,sd.distcd,sch_type,
CASE
WHEN asst_flag IN ('E','Z') THEN count(1)
ELSE 0::bigint
END AS entered,
CASE
WHEN asst_flag='R'::bpchar THEN count(1)
ELSE 0::bigint
END AS rejected,
CASE
WHEN asst_flag='F'::bpchar THEN count(1)
ELSE 0::bigint
END AS forwarded,
CASE
WHEN asst_flag IN ('V','A') THEN count(1)
ELSE 0::bigint
END AS verified,
minority_sanstha
from samayojan.smj_excesstch_det exv
LEFT JOIN shala_live.shala_district sd ON substr(exv.schl_id,1,4)=sd.distcd
group by sd.distcd,asst_flag,sanstha_code,schl_id,sch_type,minority_sanstha)";

$insert_ex_staff_count = pg_query($insert_ex_staff_count) or die('Query failed: ' . pg_last_error());


$insert_ex_vac_count = " insert into samayojan.ex_vac_count(select  
dist_code,eos_type,minority_sanstha,temp.schl_type,
entered,
rejected ,
forwarded ,
verified,
sanstha_prim_excess_e,
sanstha_prim_excess_r,
sanstha_prim_excess_f,
sanstha_prim_excess_v,
sanstha_prim_vac_e,
sanstha_prim_vac_r,
sanstha_prim_vac_f,
sanstha_prim_vac_v,
sanstha_sec_excess_e,
sanstha_sec_excess_r,
sanstha_sec_excess_f,
sanstha_sec_excess_v,
sanstha_sec_vac_e,
sanstha_sec_vac_r,
sanstha_sec_vac_f,
sanstha_sec_vac_v
from(
select temp.dist_code,temp.eos_type,minority_sanstha,temp.schl_type,
0 as entered,
0 as rejected ,
0 as forwarded ,
0 as verified,
sanstha_prim_excess_e,
sanstha_prim_excess_r,
sanstha_prim_excess_f,
sanstha_prim_excess_v,
sanstha_prim_vac_e,
sanstha_prim_vac_r,
sanstha_prim_vac_f,
sanstha_prim_vac_v,
sanstha_sec_excess_e,
sanstha_sec_excess_r,
sanstha_sec_excess_f,
sanstha_sec_excess_v,
sanstha_sec_vac_e,
sanstha_sec_vac_r,
sanstha_sec_vac_f,
sanstha_sec_vac_v
from (
select schl_type,dist_code,eos_type,minority_sanstha,
CASE
WHEN schl_type = '01' and eos_type = '1' and asst_flag IN ('E','Z') THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_prim_excess_e,

CASE
WHEN schl_type = '01' and eos_type = '1' and asst_flag='R'::bpchar THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_prim_excess_r,

CASE
WHEN schl_type = '01' and eos_type = '1' and asst_flag='F'::bpchar THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_prim_excess_f,

CASE
WHEN schl_type = '01' and eos_type = '1' and asst_flag IN ('V','A') THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_prim_excess_v,

CASE
WHEN schl_type = '01' and eos_type = '2' and asst_flag IN ('E','Z') THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_prim_vac_e,

CASE
WHEN schl_type = '01' and eos_type = '2' and asst_flag='R'::bpchar THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_prim_vac_r,

CASE
WHEN schl_type = '01' and eos_type = '2' and asst_flag='F'::bpchar THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_prim_vac_f,

CASE
WHEN schl_type = '01' and eos_type = '2' and asst_flag IN ('V','A') THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_prim_vac_v,

0 as sanstha_sec_excess_e,
0 as sanstha_sec_excess_r,
0 as sanstha_sec_excess_f,
0 as sanstha_sec_excess_v,
0 as sanstha_sec_vac_e,
0 as sanstha_sec_vac_r,
0 as sanstha_sec_vac_f,
0 as sanstha_sec_vac_v
from samayojan.eo_sanstha_ex_vac
group by dist_code,schl_type,eos_type,asst_flag,minority_sanstha

UNION

select schl_type,dist_code,eos_type,minority_sanstha,
0 as sanstha_prim_excess_e,
0 as sanstha_prim_excess_r,
0 as sanstha_prim_excess_f,
0 as sanstha_prim_excess_v,
0 as sanstha_prim_vac_e,
0 as sanstha_prim_vac_r,
0 as sanstha_prim_vac_f,
0 as sanstha_prim_vac_v,

CASE
WHEN schl_type = '02' and eos_type = '1' and asst_flag IN ('E','Z') THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_sec_excess_e,

CASE
WHEN schl_type = '02' and eos_type = '1' and asst_flag='R' ::bpchar THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_sec_excess_r,

CASE
WHEN schl_type = '02' and eos_type = '1' and asst_flag='F' ::bpchar THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_sec_excess_f,

CASE
WHEN schl_type = '02' and eos_type = '1' and asst_flag IN ('V','A') THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_sec_excess_v,

CASE
WHEN schl_type = '02' and eos_type = '2' and asst_flag IN ('E','Z') THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_sec_vac_e,

CASE
WHEN schl_type = '02' and eos_type = '2' and asst_flag='R' ::bpchar THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_sec_vac_r,

CASE
WHEN schl_type = '02' and eos_type = '2' and asst_flag='F' ::bpchar THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_sec_vac_f,

CASE
WHEN schl_type = '02' and eos_type = '2' and asst_flag IN ('V','A') THEN sum(eos_no_of_post)
ELSE 0::bigint
END AS sanstha_sec_vac_v
from samayojan.eo_sanstha_ex_vac
group by dist_code,schl_type,eos_type,asst_flag,minority_sanstha) temp 

UNION

select
substr(schl_id,1,4)dist_code,
'1' as eos_type,minority_sanstha,
sch_type as schl_type,
sum(entered),
sum(rejected),
sum(forwarded),
sum(verified),
0 as sanstha_prim_excess_e,
0 as sanstha_prim_excess_r,
0 as sanstha_prim_excess_f,
0 as sanstha_prim_excess_v,
0 as sanstha_prim_vac_e,
0 as sanstha_prim_vac_r,
0 as sanstha_prim_vac_f,
0 as sanstha_prim_vac_v,
0 as sanstha_sec_excess_e,
0 as sanstha_sec_excess_r,
0 as sanstha_sec_excess_f,
0 as sanstha_sec_excess_v,
0 as sanstha_sec_vac_e,
0 as sanstha_sec_vac_r,
0 as sanstha_sec_vac_f,
0 as sanstha_sec_vac_v
from samayojan.ex_staff_count where dist_code=substr(schl_id,1,4) 
group by dist_code,substr(schl_id,1,4),sch_type,minority_sanstha) temp 
group by dist_code,eos_type,temp.schl_type,sanstha_prim_excess_e,
sanstha_prim_excess_r,sanstha_prim_excess_f,sanstha_prim_excess_v,sanstha_prim_vac_e,sanstha_prim_vac_r,sanstha_prim_vac_f,sanstha_prim_vac_v,sanstha_sec_excess_e,
sanstha_sec_excess_r,sanstha_sec_excess_f,sanstha_sec_excess_v,sanstha_sec_vac_e,sanstha_sec_vac_r,sanstha_sec_vac_f,sanstha_sec_vac_v,entered,rejected ,forwarded ,verified,minority_sanstha
order by dist_code
)";
$insert_ex_vac_count = pg_query($insert_ex_vac_count) or die('Query failed: ' . pg_last_error());


$insert_minority_nonminority_count = "insert into samayojan.minorty_nonminority_count(select tmp.dist_code,tmp.eos_type,minority_sanstha,tmp.schl_type,
nonminority_sanstha_entered,
nonminority_sanstha_rejected,
nonminority_sanstha_forwarded,
nonminority_sanstha_verified,
minority_sanstha_entered,
minority_sanstha_rejected,
minority_sanstha_forwarded,
minority_sanstha_verified,
nonminority_sanstha_prim_excess_e,
nonminority_sanstha_prim_excess_r,
nonminority_sanstha_prim_excess_f,
nonminority_sanstha_prim_excess_v,
nonminority_sanstha_prim_vac_e,
nonminority_sanstha_prim_vac_r,
nonminority_sanstha_prim_vac_f,
nonminority_sanstha_prim_vac_v,
nonminority_sanstha_sec_excess_e,
nonminority_sanstha_sec_excess_r,
nonminority_sanstha_sec_excess_f,
nonminority_sanstha_sec_excess_v,
nonminority_sanstha_sec_vac_e,
nonminority_sanstha_sec_vac_r,
nonminority_sanstha_sec_vac_f,
nonminority_sanstha_sec_vac_v,
minority_sanstha_prim_excess_e,
minority_sanstha_prim_excess_r,
minority_sanstha_prim_excess_f,
minority_sanstha_prim_excess_v,
minority_sanstha_prim_vac_e,
minority_sanstha_prim_vac_r,
minority_sanstha_prim_vac_f,
minority_sanstha_prim_vac_v,
minority_sanstha_sec_excess_e,
minority_sanstha_sec_excess_r,
minority_sanstha_sec_excess_f,
minority_sanstha_sec_excess_v,
minority_sanstha_sec_vac_e,
minority_sanstha_sec_vac_r,
minority_sanstha_sec_vac_f,
minority_sanstha_sec_vac_v from (select tmp.dist_code,tmp.eos_type,minority_sanstha,tmp.schl_type,
0 as nonminority_sanstha_entered,
0 as nonminority_sanstha_rejected,
0 as nonminority_sanstha_forwarded,
0 as nonminority_sanstha_verified,
0 as minority_sanstha_entered,
0 as minority_sanstha_rejected,
0 as minority_sanstha_forwarded,
0 as minority_sanstha_verified,
sum(nonminority_sanstha_prim_excess_e)nonminority_sanstha_prim_excess_e,
sum(nonminority_sanstha_prim_excess_r)nonminority_sanstha_prim_excess_r,
sum(nonminority_sanstha_prim_excess_f)nonminority_sanstha_prim_excess_f,
sum(nonminority_sanstha_prim_excess_v)nonminority_sanstha_prim_excess_v,
sum(nonminority_sanstha_prim_vac_e)nonminority_sanstha_prim_vac_e,
sum(nonminority_sanstha_prim_vac_r)nonminority_sanstha_prim_vac_r,
sum(nonminority_sanstha_prim_vac_f)nonminority_sanstha_prim_vac_f,
sum(nonminority_sanstha_prim_vac_v)nonminority_sanstha_prim_vac_v,
sum(nonminority_sanstha_sec_excess_e)nonminority_sanstha_sec_excess_e,
sum(nonminority_sanstha_sec_excess_r)nonminority_sanstha_sec_excess_r,
sum(nonminority_sanstha_sec_excess_f)nonminority_sanstha_sec_excess_f,
sum(nonminority_sanstha_sec_excess_v)nonminority_sanstha_sec_excess_v,
sum(nonminority_sanstha_sec_vac_e)nonminority_sanstha_sec_vac_e,
sum(nonminority_sanstha_sec_vac_r)nonminority_sanstha_sec_vac_r,
sum(nonminority_sanstha_sec_vac_f)nonminority_sanstha_sec_vac_f,
sum(nonminority_sanstha_sec_vac_v)nonminority_sanstha_sec_vac_v,
sum(minority_sanstha_prim_excess_e)minority_sanstha_prim_excess_e,
sum(minority_sanstha_prim_excess_r)minority_sanstha_prim_excess_r,
sum(minority_sanstha_prim_excess_f)minority_sanstha_prim_excess_f,
sum(minority_sanstha_prim_excess_v)minority_sanstha_prim_excess_v,
sum(minority_sanstha_prim_vac_e)minority_sanstha_prim_vac_e,
sum(minority_sanstha_prim_vac_r)minority_sanstha_prim_vac_r,
sum(minority_sanstha_prim_vac_f)minority_sanstha_prim_vac_f,
sum(minority_sanstha_prim_vac_v)minority_sanstha_prim_vac_v,
sum(minority_sanstha_sec_excess_e)minority_sanstha_sec_excess_e,
sum(minority_sanstha_sec_excess_r)minority_sanstha_sec_excess_r,
sum(minority_sanstha_sec_excess_f)minority_sanstha_sec_excess_f,
sum(minority_sanstha_sec_excess_v)minority_sanstha_sec_excess_v,
sum(minority_sanstha_sec_vac_e)minority_sanstha_sec_vac_e,
sum(minority_sanstha_sec_vac_r)minority_sanstha_sec_vac_r,
sum(minority_sanstha_sec_vac_f)minority_sanstha_sec_vac_f,
sum(minority_sanstha_sec_vac_v)minority_sanstha_sec_vac_v 
from (SELECT dist_code, eos_type, minority_sanstha, schl_type,
CASE
WHEN schl_type = '01' and eos_type = '1' and minority_sanstha='1' THEN sum(sanstha_prim_excess_e)
ELSE 0::bigint
END AS nonminority_sanstha_prim_excess_e,

CASE
WHEN schl_type = '01' and eos_type = '1' and minority_sanstha='1' THEN sum(sanstha_prim_excess_r)
ELSE 0::bigint
END AS nonminority_sanstha_prim_excess_r,

CASE
WHEN schl_type = '01' and eos_type = '1' and minority_sanstha='1' THEN sum(sanstha_prim_excess_f)
ELSE 0::bigint
END AS nonminority_sanstha_prim_excess_f,

CASE
WHEN schl_type = '01' and eos_type = '1' and minority_sanstha='1' THEN sum(sanstha_prim_excess_v)
ELSE 0::bigint
END AS nonminority_sanstha_prim_excess_v,

CASE
WHEN schl_type = '01' and eos_type = '2' and minority_sanstha='1' THEN sum(sanstha_prim_vac_e)
ELSE 0::bigint
END AS nonminority_sanstha_prim_vac_e,

CASE
WHEN schl_type = '01' and eos_type = '2' and minority_sanstha='1' THEN sum(sanstha_prim_vac_r)
ELSE 0::bigint
END AS nonminority_sanstha_prim_vac_r,

CASE
WHEN schl_type = '01' and eos_type = '2' and minority_sanstha='1' THEN sum(sanstha_prim_vac_f)
ELSE 0::bigint
END AS nonminority_sanstha_prim_vac_f,

CASE
WHEN schl_type = '01' and eos_type = '2' and minority_sanstha='1' THEN sum(sanstha_prim_vac_v)
ELSE 0::bigint
END AS nonminority_sanstha_prim_vac_v,

CASE
WHEN schl_type = '02' and eos_type = '1' and minority_sanstha='1' THEN sum(sanstha_sec_excess_e)
ELSE 0::bigint
END AS nonminority_sanstha_sec_excess_e,

CASE
WHEN schl_type = '02' and eos_type = '1' and minority_sanstha='1' THEN sum(sanstha_sec_excess_r)
ELSE 0::bigint
END AS nonminority_sanstha_sec_excess_r,

CASE
WHEN schl_type = '02' and eos_type = '1' and minority_sanstha='1' THEN sum(sanstha_sec_excess_f)
ELSE 0::bigint
END AS nonminority_sanstha_sec_excess_f,

CASE
WHEN schl_type = '02' and eos_type = '1' and minority_sanstha='1' THEN sum(sanstha_sec_excess_v)
ELSE 0::bigint
END AS nonminority_sanstha_sec_excess_v,

CASE
WHEN schl_type = '02' and eos_type = '2' and minority_sanstha='1' THEN sum(sanstha_sec_vac_e)
ELSE 0::bigint
END AS nonminority_sanstha_sec_vac_e,

CASE
WHEN schl_type = '02' and eos_type = '2' and minority_sanstha='1' THEN sum(sanstha_sec_vac_r)
ELSE 0::bigint
END AS nonminority_sanstha_sec_vac_r,

CASE
WHEN schl_type = '02' and eos_type = '2' and minority_sanstha='1' THEN sum(sanstha_sec_vac_f)
ELSE 0::bigint
END AS nonminority_sanstha_sec_vac_f,

CASE
WHEN schl_type = '02' and eos_type = '2' and minority_sanstha='1' THEN sum(sanstha_sec_vac_v)
ELSE 0::bigint
END AS nonminority_sanstha_sec_vac_v,

0 as minority_sanstha_prim_excess_e,
0 as minority_sanstha_prim_excess_r,
0 as minority_sanstha_prim_excess_f,
0 as minority_sanstha_prim_excess_v,
0 as minority_sanstha_prim_vac_e,
0 as minority_sanstha_prim_vac_r,
0 as minority_sanstha_prim_vac_f,
0 as minority_sanstha_prim_vac_v,
0 as minority_sanstha_sec_excess_e,
0 as minority_sanstha_sec_excess_r,
0 as minority_sanstha_sec_excess_f,
0 as minority_sanstha_sec_excess_v,
0 as minority_sanstha_sec_vac_e,
0 as minority_sanstha_sec_vac_r,
0 as minority_sanstha_sec_vac_f,
0 as minority_sanstha_sec_vac_v

FROM samayojan.ex_vac_count
group by dist_code,schl_type,eos_type,minority_sanstha

UNION

SELECT dist_code, eos_type, minority_sanstha, schl_type,
0 as nonminority_sanstha_prim_excess_e,
0 as nonminority_sanstha_prim_excess_r,
0 as nonminority_sanstha_prim_excess_f,
0 as nonminority_sanstha_prim_excess_v,
0 as nonminority_sanstha_prim_vac_e,
0 as nonminority_sanstha_prim_vac_r,
0 as nonminority_sanstha_prim_vac_f,
0 as nonminority_sanstha_prim_vac_v,
0 as nonminority_sanstha_sec_excess_e,
0 as nonminority_sanstha_sec_excess_r,
0 as nonminority_sanstha_sec_excess_f,
0 as nonminority_sanstha_sec_excess_v,
0 as nonminority_sanstha_sec_vac_e,
0 as nonminority_sanstha_sec_vac_r,
0 as nonminority_sanstha_sec_vac_f,
0 as nonminority_sanstha_sec_vac_v,

CASE
WHEN schl_type = '01' and eos_type = '1' and minority_sanstha='2' THEN sum(sanstha_prim_excess_e)
ELSE 0::bigint
END AS minority_sanstha_prim_excess_e,

CASE
WHEN schl_type = '01' and eos_type = '1' and minority_sanstha='2' THEN sum(sanstha_prim_excess_r)
ELSE 0::bigint
END AS minority_sanstha_prim_excess_r,

CASE
WHEN schl_type = '01' and eos_type = '1' and minority_sanstha='2' THEN sum(sanstha_prim_excess_f)
ELSE 0::bigint
END AS minority_sanstha_prim_excess_f,

CASE
WHEN schl_type = '01' and eos_type = '1' and minority_sanstha='2' THEN sum(sanstha_prim_excess_v)
ELSE 0::bigint
END AS minority_sanstha_prim_excess_v,

CASE
WHEN schl_type = '01' and eos_type = '2' and minority_sanstha='2' THEN sum(sanstha_prim_vac_e)
ELSE 0::bigint
END AS minority_sanstha_prim_vac_e,

CASE
WHEN schl_type = '01' and eos_type = '2' and minority_sanstha='2' THEN sum(sanstha_prim_vac_r)
ELSE 0::bigint
END AS minority_sanstha_prim_vac_r,

CASE
WHEN schl_type = '01' and eos_type = '2' and minority_sanstha='2' THEN sum(sanstha_prim_vac_f)
ELSE 0::bigint
END AS minority_sanstha_prim_vac_f,

CASE
WHEN schl_type = '01' and eos_type = '2' and minority_sanstha='2' THEN sum(sanstha_prim_vac_v)
ELSE 0::bigint
END AS minority_sanstha_prim_vac_v,

CASE
WHEN schl_type = '02' and eos_type = '1' and minority_sanstha='2' THEN sum(sanstha_sec_excess_e)
ELSE 0::bigint
END AS minority_sanstha_sec_excess_e,

CASE
WHEN schl_type = '02' and eos_type = '1' and minority_sanstha='2' THEN sum(sanstha_sec_excess_r)
ELSE 0::bigint
END AS minority_sanstha_sec_excess_r,

CASE
WHEN schl_type = '02' and eos_type = '1' and minority_sanstha='2' THEN sum(sanstha_sec_excess_f)
ELSE 0::bigint
END AS minority_sanstha_sec_excess_f,

CASE
WHEN schl_type = '02' and eos_type = '1' and minority_sanstha='2' THEN sum(sanstha_sec_excess_v)
ELSE 0::bigint
END AS minority_sanstha_sec_excess_v,

CASE
WHEN schl_type = '02' and eos_type = '2' and minority_sanstha='2' THEN sum(sanstha_sec_vac_e)
ELSE 0::bigint
END AS minority_sanstha_sec_vac_e,

CASE
WHEN schl_type = '02' and eos_type = '2' and minority_sanstha='2' THEN sum(sanstha_sec_vac_r)
ELSE 0::bigint
END AS minority_sanstha_sec_vac_r,

CASE
WHEN schl_type = '02' and eos_type = '2' and minority_sanstha='2' THEN sum(sanstha_sec_vac_f)
ELSE 0::bigint
END AS minority_sanstha_sec_vac_f,

CASE
WHEN schl_type = '02' and eos_type = '2' and minority_sanstha='2' THEN sum(sanstha_sec_vac_v)
ELSE 0::bigint
END AS minority_sanstha_sec_vac_v

FROM samayojan.ex_vac_count
group by dist_code,schl_type,eos_type,minority_sanstha
order by dist_code,eos_type,schl_type) tmp 
group by tmp.dist_code,tmp.eos_type,minority_sanstha,tmp.schl_type

UNION 

select
substr(schl_id,1,4)dist_code,
'1' as eos_type,
minority_sanstha,
sch_type as schl_type,

CASE
WHEN minority_sanstha='1' THEN sum(entered)
ELSE 0::bigint
END AS nonminority_sanstha_entered,

CASE
WHEN minority_sanstha='1' THEN sum(rejected)
ELSE 0::bigint
END AS nonminority_sanstha_rejected,


CASE
WHEN minority_sanstha='1' THEN sum(forwarded)
ELSE 0::bigint
END AS nonminority_sanstha_forwarded,

CASE
WHEN minority_sanstha='1' THEN sum(verified)
ELSE 0::bigint
END AS nonminority_sanstha_verified,

CASE
WHEN minority_sanstha='2' THEN sum(entered)
ELSE 0::bigint
END AS minority_sanstha_entered,

CASE
WHEN minority_sanstha='2' THEN sum(rejected)
ELSE 0::bigint
END AS minority_sanstha_rejected,


CASE
WHEN minority_sanstha='2' THEN sum(forwarded)
ELSE 0::bigint
END AS minority_sanstha_forwarded,

CASE
WHEN minority_sanstha='2' THEN sum(verified)
ELSE 0::bigint
END AS minority_sanstha_verified,

0 as nonminority_sanstha_prim_excess_e,
0 as nonminority_sanstha_prim_excess_r,
0 as nonminority_sanstha_prim_excess_f,
0 as nonminority_sanstha_prim_excess_v,
0 as nonminority_sanstha_prim_vac_e,
0 as nonminority_sanstha_prim_vac_r,
0 as nonminority_sanstha_prim_vac_f,
0 as nonminority_sanstha_prim_vac_v,
0 as nonminority_sanstha_sec_excess_e,
0 as nonminority_sanstha_sec_excess_r,
0 as nonminority_sanstha_sec_excess_f,
0 as nonminority_sanstha_sec_excess_v,
0 as nonminority_sanstha_sec_vac_e,
0 as nonminority_sanstha_sec_vac_r,
0 as nonminority_sanstha_sec_vac_f,
0 as nonminority_sanstha_sec_vac_v,
0 as minority_sanstha_prim_excess_e,
0 as minority_sanstha_prim_excess_r,
0 as minority_sanstha_prim_excess_f,
0 as minority_sanstha_prim_excess_v,
0 as minority_sanstha_prim_vac_e,
0 as minority_sanstha_prim_vac_r,
0 as minority_sanstha_prim_vac_f,
0 as minority_sanstha_prim_vac_v,
0 as minority_sanstha_sec_excess_e,
0 as minority_sanstha_sec_excess_r,
0 as minority_sanstha_sec_excess_f,
0 as minority_sanstha_sec_excess_v,
0 as minority_sanstha_sec_vac_e,
0 as minority_sanstha_sec_vac_r,
0 as minority_sanstha_sec_vac_f,
0 as minority_sanstha_sec_vac_v
from samayojan.ex_staff_count where dist_code=substr(schl_id,1,4) 
group by dist_code,substr(schl_id,1,4),sch_type,minority_sanstha)tmp
order by dist_code,eos_type)";

$insert_minority_nonminority_count = pg_query($insert_minority_nonminority_count) or die('Query failed: ' . pg_last_error());

$FilePath = '/wwwroot/Education/samayojan/app/View/XML';
$dir = $FilePath;
chdir($dir);
$filename = "login_ex_vac_stat.xml";
$str = "";
$schl_sum = 0;
$tchr_sum = 0;
if (!$handle = fopen($filename, 'w')) {
    echo "Cannot open file ($filename)";
}
fclose($handle);

$str = $str . "<?xml version='1.0'?>\n";
$str = $str . "<STAT>\n";

$ex_vac_query1 = "select distinct(substr(eo_code,1,4)) dist_code,distname,substr(eo_code,7,8)schl_type,smj_minority_sanstha
from samayojan.smj_approval_det
LEFT JOIN shala_live.shala_district sd ON substr(eo_code,1,4)=distcd
group by dist_code,distname,schl_type,eo_code,smj_minority_sanstha order by distname";
$ex_vac_result1 = pg_query($ex_vac_query1) or die('Query failed: ' . pg_last_error());
$ex_vac_row1 = pg_fetch_all($ex_vac_result1);
$ex_vac_records1 = pg_num_rows($ex_vac_result1);

for ($j = 0; $j < $ex_vac_records1; $j++) {
    $dist_code = trim($ex_vac_row1[$j]['dist_code']);
    $schl_type = trim($ex_vac_row1[$j]['schl_type']);
    $sasntha_type = trim($ex_vac_row1[$j]['smj_minority_sanstha']);

    $dist_code_array[] = trim($ex_vac_row1[$j]['dist_code']);
    $schl_type_array[] = trim($ex_vac_row1[$j]['schl_type']);
    $sasntha_type_array[] = trim($ex_vac_row1[$j]['smj_minority_sanstha']);

//    echo "<pre>";
//    print_r($ex_vac_row_new);
}

$sasntha_type = '(';
if ($sasntha_type_array) {
    foreach ($sasntha_type_array AS $arr => $val) {
        $sasntha_type.="'" . trim($val) . "',";
    }
} else {
    $sasntha_type.="''";
}
$sasntha_type = trim($sasntha_type, ",");
$sasntha_type.=')';

$dist_code = '(';
if ($dist_code_array) {
    foreach ($dist_code_array AS $arr => $val) {
        $dist_code.="'" . trim($val) . "',";
    }
} else {
    $dist_code.="''";
}
$dist_code = trim($dist_code, ",");
$dist_code.=')';

$schl_type = '(';
if ($schl_type_array) {
    foreach ($schl_type_array AS $arr => $val) {
        $schl_type.="'" . trim($val) . "',";
    }
} else {
    $schl_type.="''";
}
$schl_type = trim($schl_type, ",");
$schl_type.=')';

$ex_vac_query_new = "select distinct(dist_code),distname,schl_type,minority_sanstha,
sum(nonminority_sanstha_entered)nonminority_sanstha_entered,
sum(nonminority_sanstha_rejected)nonminority_sanstha_rejected,
sum(nonminority_sanstha_forwarded)nonminority_sanstha_forwarded,
sum(nonminority_sanstha_verified)nonminority_sanstha_verified,
sum(minority_sanstha_entered)minority_sanstha_entered,
sum(minority_sanstha_rejected)minority_sanstha_rejected,
sum(minority_sanstha_forwarded)minority_sanstha_forwarded,
sum(minority_sanstha_verified)minority_sanstha_verified,
sum(nonminority_sanstha_prim_excess_e)nonminority_sanstha_prim_excess_e,
sum(nonminority_sanstha_prim_excess_r)nonminority_sanstha_prim_excess_r,
sum(nonminority_sanstha_prim_excess_f)nonminority_sanstha_prim_excess_f,
sum(nonminority_sanstha_prim_excess_v)nonminority_sanstha_prim_excess_v,
sum(nonminority_sanstha_prim_vac_e)nonminority_sanstha_prim_vac_e,
sum(nonminority_sanstha_prim_vac_r)nonminority_sanstha_prim_vac_r,
sum(nonminority_sanstha_prim_vac_f)nonminority_sanstha_prim_vac_f,
sum(nonminority_sanstha_prim_vac_v)nonminority_sanstha_prim_vac_v,
sum(nonminority_sanstha_sec_excess_e)nonminority_sanstha_sec_excess_e,
sum(nonminority_sanstha_sec_excess_r)nonminority_sanstha_sec_excess_r,
sum(nonminority_sanstha_sec_excess_f)nonminority_sanstha_sec_excess_f,
sum(nonminority_sanstha_sec_excess_v)nonminority_sanstha_sec_excess_v,
sum(nonminority_sanstha_sec_vac_e)nonminority_sanstha_sec_vac_e,
sum(nonminority_sanstha_sec_vac_r)nonminority_sanstha_sec_vac_r,
sum(nonminority_sanstha_sec_vac_f)nonminority_sanstha_sec_vac_f,
sum(nonminority_sanstha_sec_vac_v)nonminority_sanstha_sec_vac_v,
sum(minority_sanstha_prim_excess_e)minority_sanstha_prim_excess_e,
sum(minority_sanstha_prim_excess_r)minority_sanstha_prim_excess_r,
sum(minority_sanstha_prim_excess_f)minority_sanstha_prim_excess_f,
sum(minority_sanstha_prim_excess_v)minority_sanstha_prim_excess_v,
sum(minority_sanstha_prim_vac_e)minority_sanstha_prim_vac_e,
sum(minority_sanstha_prim_vac_r)minority_sanstha_prim_vac_r,
sum(minority_sanstha_prim_vac_f)minority_sanstha_prim_vac_f,
sum(minority_sanstha_prim_vac_v)minority_sanstha_prim_vac_v,
sum(minority_sanstha_sec_excess_e)minority_sanstha_sec_excess_e,
sum(minority_sanstha_sec_excess_r)minority_sanstha_sec_excess_r,
sum(minority_sanstha_sec_excess_f)minority_sanstha_sec_excess_f,
sum(minority_sanstha_sec_excess_v)minority_sanstha_sec_excess_v,
sum(minority_sanstha_sec_vac_e)minority_sanstha_sec_vac_e,
sum(minority_sanstha_sec_vac_r)minority_sanstha_sec_vac_r,
sum(minority_sanstha_sec_vac_f)minority_sanstha_sec_vac_f,
sum(minority_sanstha_sec_vac_v)minority_sanstha_sec_vac_v
from samayojan.minorty_nonminority_count evac
LEFT JOIN shala_live.shala_district sd ON dist_code=distcd
where dist_code IN $dist_code and schl_type IN $schl_type and minority_sanstha IN $sasntha_type
group by dist_code,distname,schl_type,minority_sanstha order by distname";
$ex_vac_result_new = pg_query($ex_vac_query_new) or die('Query failed: ' . pg_last_error());
$ex_vac_row_new = pg_fetch_all($ex_vac_result_new);

$ex_vac_query = "select distinct(dist_code),distname,schl_type,minority_sanstha,
sum(nonminority_sanstha_entered)nonminority_sanstha_entered,
sum(nonminority_sanstha_rejected)nonminority_sanstha_rejected,
sum(nonminority_sanstha_forwarded)nonminority_sanstha_forwarded,
sum(nonminority_sanstha_verified)nonminority_sanstha_verified,
sum(minority_sanstha_entered)minority_sanstha_entered,
sum(minority_sanstha_rejected)minority_sanstha_rejected,
sum(minority_sanstha_forwarded)minority_sanstha_forwarded,
sum(minority_sanstha_verified)minority_sanstha_verified,
sum(nonminority_sanstha_prim_excess_e)nonminority_sanstha_prim_excess_e,
sum(nonminority_sanstha_prim_excess_r)nonminority_sanstha_prim_excess_r,
sum(nonminority_sanstha_prim_excess_f)nonminority_sanstha_prim_excess_f,
sum(nonminority_sanstha_prim_excess_v)nonminority_sanstha_prim_excess_v,
sum(nonminority_sanstha_prim_vac_e)nonminority_sanstha_prim_vac_e,
sum(nonminority_sanstha_prim_vac_r)nonminority_sanstha_prim_vac_r,
sum(nonminority_sanstha_prim_vac_f)nonminority_sanstha_prim_vac_f,
sum(nonminority_sanstha_prim_vac_v)nonminority_sanstha_prim_vac_v,
sum(nonminority_sanstha_sec_excess_e)nonminority_sanstha_sec_excess_e,
sum(nonminority_sanstha_sec_excess_r)nonminority_sanstha_sec_excess_r,
sum(nonminority_sanstha_sec_excess_f)nonminority_sanstha_sec_excess_f,
sum(nonminority_sanstha_sec_excess_v)nonminority_sanstha_sec_excess_v,
sum(nonminority_sanstha_sec_vac_e)nonminority_sanstha_sec_vac_e,
sum(nonminority_sanstha_sec_vac_r)nonminority_sanstha_sec_vac_r,
sum(nonminority_sanstha_sec_vac_f)nonminority_sanstha_sec_vac_f,
sum(nonminority_sanstha_sec_vac_v)nonminority_sanstha_sec_vac_v,
sum(minority_sanstha_prim_excess_e)minority_sanstha_prim_excess_e,
sum(minority_sanstha_prim_excess_r)minority_sanstha_prim_excess_r,
sum(minority_sanstha_prim_excess_f)minority_sanstha_prim_excess_f,
sum(minority_sanstha_prim_excess_v)minority_sanstha_prim_excess_v,
sum(minority_sanstha_prim_vac_e)minority_sanstha_prim_vac_e,
sum(minority_sanstha_prim_vac_r)minority_sanstha_prim_vac_r,
sum(minority_sanstha_prim_vac_f)minority_sanstha_prim_vac_f,
sum(minority_sanstha_prim_vac_v)minority_sanstha_prim_vac_v,
sum(minority_sanstha_sec_excess_e)minority_sanstha_sec_excess_e,
sum(minority_sanstha_sec_excess_r)minority_sanstha_sec_excess_r,
sum(minority_sanstha_sec_excess_f)minority_sanstha_sec_excess_f,
sum(minority_sanstha_sec_excess_v)minority_sanstha_sec_excess_v,
sum(minority_sanstha_sec_vac_e)minority_sanstha_sec_vac_e,
sum(minority_sanstha_sec_vac_r)minority_sanstha_sec_vac_r,
sum(minority_sanstha_sec_vac_f)minority_sanstha_sec_vac_f,
sum(minority_sanstha_sec_vac_v)minority_sanstha_sec_vac_v
from samayojan.minorty_nonminority_count evac
LEFT JOIN shala_live.shala_district sd ON dist_code=distcd
group by dist_code,distname,schl_type,minority_sanstha order by distname";
$ex_vac_result = pg_query($ex_vac_query) or die('Query failed: ' . pg_last_error());
$ex_vac_row = pg_fetch_all($ex_vac_result);

//echo "<pre>";print_r($ex_vac_row);
$ex_vac_records = pg_num_rows($ex_vac_result);

//echo "<pre>";print_r($ex_vac_row_new); die;

//for ($j = 0; $j < count($ex_vac_row_new); $j++) {
//    $str = $str . "<dist_id>" . $ex_vac_row_new[$j]['dist_code'] . "</dist_id>\n";
//    $str = $str . "<dist_code>" . $ex_vac_row_new[$j]['distname'] . "</dist_code>\n";
//    $str = $str . "<sanstha_type>" . $ex_vac_row_new[$j]['minority_sanstha'] . "</sanstha_type>\n";
//    $str = $str . "<schl_type>" . $ex_vac_row_new[$j]['schl_type'] . "</schl_type>\n";
//    $str = $str . "<nonminority_sanstha_prim_excess_e>" . $ex_vac_row_new[$j]['nonminority_sanstha_prim_excess_e'] . "</nonminority_sanstha_prim_excess_e>\n";
//    $str = $str . "<nonminority_sanstha_prim_excess_r>" . $ex_vac_row_new[$j]['nonminority_sanstha_prim_excess_r'] . "</nonminority_sanstha_prim_excess_r>\n";
//    $str = $str . "<nonminority_sanstha_prim_excess_f>" . $ex_vac_row_new[$j]['nonminority_sanstha_prim_excess_f'] . "</nonminority_sanstha_prim_excess_f>\n";
//    $str = $str . "<nonminority_sanstha_prim_excess_v>" . $ex_vac_row_new[$j]['nonminority_sanstha_prim_excess_v'] . "</nonminority_sanstha_prim_excess_v>\n";
//    $str = $str . "<nonminority_sanstha_prim_vac_e>" . $ex_vac_row_new[$j]['nonminority_sanstha_prim_vac_e'] . "</nonminority_sanstha_prim_vac_e>\n";
//    $str = $str . "<nonminority_sanstha_prim_vac_r>" . $ex_vac_row_new[$j]['nonminority_sanstha_prim_vac_r'] . "</nonminority_sanstha_prim_vac_r>\n";
//    $str = $str . "<nonminority_sanstha_prim_vac_f>" . $ex_vac_row_new[$j]['nonminority_sanstha_prim_vac_f'] . "</nonminority_sanstha_prim_vac_f>\n";
//    $str = $str . "<nonminority_sanstha_prim_vac_v>" . $ex_vac_row_new[$j]['nonminority_sanstha_prim_vac_v'] . "</nonminority_sanstha_prim_vac_v>\n";
//    $str = $str . "<nonminority_sanstha_sec_excess_e>" . $ex_vac_row_new[$j]['nonminority_sanstha_sec_excess_e'] . "</nonminority_sanstha_sec_excess_e>\n";
//    $str = $str . "<nonminority_sanstha_sec_excess_r>" . $ex_vac_row_new[$j]['nonminority_sanstha_sec_excess_r'] . "</nonminority_sanstha_sec_excess_r>\n";
//    $str = $str . "<nonminority_sanstha_sec_excess_f>" . $ex_vac_row_new[$j]['nonminority_sanstha_sec_excess_f'] . "</nonminority_sanstha_sec_excess_f>\n";
//    $str = $str . "<nonminority_sanstha_sec_excess_v>" . $ex_vac_row_new[$j]['nonminority_sanstha_sec_excess_v'] . "</nonminority_sanstha_sec_excess_v>\n";
//    $str = $str . "<nonminority_sanstha_sec_vac_e>" . $ex_vac_row_new[$j]['nonminority_sanstha_sec_vac_e'] . "</nonminority_sanstha_sec_vac_e>\n";
//    $str = $str . "<nonminority_sanstha_sec_vac_r>" . $ex_vac_row_new[$j]['nonminority_sanstha_sec_vac_r'] . "</nonminority_sanstha_sec_vac_r>\n";
//    $str = $str . "<nonminority_sanstha_sec_vac_f>" . $ex_vac_row_new[$j]['nonminority_sanstha_sec_vac_f'] . "</nonminority_sanstha_sec_vac_f>\n";
//    $str = $str . "<nonminority_sanstha_sec_vac_v>" . $ex_vac_row_new[$j]['nonminority_sanstha_sec_vac_v'] . "</nonminority_sanstha_sec_vac_v>\n";
//    $str = $str . "<minority_sanstha_prim_excess_e>" . $ex_vac_row_new[$j]['minority_sanstha_prim_excess_e'] . "</minority_sanstha_prim_excess_e>\n";
//    $str = $str . "<minority_sanstha_prim_excess_r>" . $ex_vac_row_new[$j]['minority_sanstha_prim_excess_r'] . "</minority_sanstha_prim_excess_r>\n";
//    $str = $str . "<minority_sanstha_prim_excess_f>" . $ex_vac_row_new[$j]['minority_sanstha_prim_excess_f'] . "</minority_sanstha_prim_excess_f>\n";
//    $str = $str . "<minority_sanstha_prim_excess_v>" . $ex_vac_row_new[$j]['minority_sanstha_prim_excess_v'] . "</minority_sanstha_prim_excess_v>\n";
//    $str = $str . "<minority_sanstha_prim_vac_e>" . $ex_vac_row_new[$j]['minority_sanstha_prim_vac_e'] . "</minority_sanstha_prim_vac_e>\n";
//    $str = $str . "<minority_sanstha_prim_vac_r>" . $ex_vac_row_new[$j]['minority_sanstha_prim_vac_r'] . "</minority_sanstha_prim_vac_r>\n";
//    $str = $str . "<minority_sanstha_prim_vac_f>" . $ex_vac_row_new[$j]['minority_sanstha_prim_vac_f'] . "</minority_sanstha_prim_vac_f>\n";
//    $str = $str . "<minority_sanstha_prim_vac_v>" . $ex_vac_row_new[$j]['minority_sanstha_prim_vac_v'] . "</minority_sanstha_prim_vac_v>\n";
//    $str = $str . "<minority_sanstha_sec_excess_e>" . $ex_vac_row_new[$j]['minority_sanstha_sec_excess_e'] . "</minority_sanstha_sec_excess_e>\n";
//    $str = $str . "<minority_sanstha_sec_excess_r>" . $ex_vac_row_new[$j]['minority_sanstha_sec_excess_r'] . "</minority_sanstha_sec_excess_r>\n";
//    $str = $str . "<minority_sanstha_sec_excess_f>" . $ex_vac_row_new[$j]['minority_sanstha_sec_excess_f'] . "</minority_sanstha_sec_excess_f>\n";
//    $str = $str . "<minority_sanstha_sec_excess_v>" . $ex_vac_row_new[$j]['minority_sanstha_sec_excess_v'] . "</minority_sanstha_sec_excess_v>\n";
//    $str = $str . "<minority_sanstha_sec_vac_e>" . $ex_vac_row_new[$j]['minority_sanstha_sec_vac_e'] . "</minority_sanstha_sec_vac_e>\n";
//    $str = $str . "<minority_sanstha_sec_vac_r>" . $ex_vac_row_new[$j]['minority_sanstha_sec_vac_r'] . "</minority_sanstha_sec_vac_r>\n";
//    $str = $str . "<minority_sanstha_sec_vac_f>" . $ex_vac_row_new[$j]['minority_sanstha_sec_vac_f'] . "</minority_sanstha_sec_vac_f>\n";
//    $str = $str . "<minority_sanstha_sec_vac_v>" . $ex_vac_row_new[$j]['minority_sanstha_sec_vac_v'] . "</minority_sanstha_sec_vac_v>\n";
//    $str = $str . "<nonminority_sanstha_entered>" . $ex_vac_row_new[$j]['nonminority_sanstha_entered'] . "</nonminority_sanstha_entered>\n";
//    $str = $str . "<nonminority_sanstha_rejected>" . $ex_vac_row_new[$j]['nonminority_sanstha_rejected'] . "</nonminority_sanstha_rejected>\n";
//    $str = $str . "<nonminority_sanstha_forwarded>" . $ex_vac_row_new[$j]['nonminority_sanstha_forwarded'] . "</nonminority_sanstha_forwarded>\n";
//    $str = $str . "<nonminority_sanstha_verified>" . $ex_vac_row_new[$j]['nonminority_sanstha_verified'] . "</nonminority_sanstha_verified>\n";
//    $str = $str . "<minority_sanstha_entered>" . $ex_vac_row_new[$j]['minority_sanstha_entered'] . "</minority_sanstha_entered>\n";
//    $str = $str . "<minority_sanstha_rejected>" . $ex_vac_row_new[$j]['minority_sanstha_rejected'] . "</minority_sanstha_rejected>\n";
//    $str = $str . "<minority_sanstha_forwarded>" . $ex_vac_row_new[$j]['minority_sanstha_forwarded'] . "</minority_sanstha_forwarded>\n";
//    $str = $str . "<minority_sanstha_verified>" . $ex_vac_row_new[$j]['minority_sanstha_verified'] . "</minority_sanstha_verified>\n";
//}

for ($j = 0; $j < count($ex_vac_row); $j++) {
    $str = $str . "<dist_id>" . $ex_vac_row[$j]['dist_code'] . "</dist_id>\n";
    $str = $str . "<dist_code>" . $ex_vac_row[$j]['distname'] . "</dist_code>\n";
    $str = $str . "<sanstha_type>" . $ex_vac_row[$j]['minority_sanstha'] . "</sanstha_type>\n";
    $str = $str . "<schl_type>" . $ex_vac_row[$j]['schl_type'] . "</schl_type>\n";
    $str = $str . "<nonminority_sanstha_prim_excess_e>" . $ex_vac_row[$j]['nonminority_sanstha_prim_excess_e'] . "</nonminority_sanstha_prim_excess_e>\n";
    $str = $str . "<nonminority_sanstha_prim_excess_r>" . $ex_vac_row[$j]['nonminority_sanstha_prim_excess_r'] . "</nonminority_sanstha_prim_excess_r>\n";
    $str = $str . "<nonminority_sanstha_prim_excess_f>" . $ex_vac_row[$j]['nonminority_sanstha_prim_excess_f'] . "</nonminority_sanstha_prim_excess_f>\n";
    $str = $str . "<nonminority_sanstha_prim_excess_v>" . $ex_vac_row[$j]['nonminority_sanstha_prim_excess_v'] . "</nonminority_sanstha_prim_excess_v>\n";
    $str = $str . "<nonminority_sanstha_prim_vac_e>" . $ex_vac_row[$j]['nonminority_sanstha_prim_vac_e'] . "</nonminority_sanstha_prim_vac_e>\n";
    $str = $str . "<nonminority_sanstha_prim_vac_r>" . $ex_vac_row[$j]['nonminority_sanstha_prim_vac_r'] . "</nonminority_sanstha_prim_vac_r>\n";
    $str = $str . "<nonminority_sanstha_prim_vac_f>" . $ex_vac_row[$j]['nonminority_sanstha_prim_vac_f'] . "</nonminority_sanstha_prim_vac_f>\n";
    $str = $str . "<nonminority_sanstha_prim_vac_v>" . $ex_vac_row[$j]['nonminority_sanstha_prim_vac_v'] . "</nonminority_sanstha_prim_vac_v>\n";
    $str = $str . "<nonminority_sanstha_sec_excess_e>" . $ex_vac_row[$j]['nonminority_sanstha_sec_excess_e'] . "</nonminority_sanstha_sec_excess_e>\n";
    $str = $str . "<nonminority_sanstha_sec_excess_r>" . $ex_vac_row[$j]['nonminority_sanstha_sec_excess_r'] . "</nonminority_sanstha_sec_excess_r>\n";
    $str = $str . "<nonminority_sanstha_sec_excess_f>" . $ex_vac_row[$j]['nonminority_sanstha_sec_excess_f'] . "</nonminority_sanstha_sec_excess_f>\n";
    $str = $str . "<nonminority_sanstha_sec_excess_v>" . $ex_vac_row[$j]['nonminority_sanstha_sec_excess_v'] . "</nonminority_sanstha_sec_excess_v>\n";
    $str = $str . "<nonminority_sanstha_sec_vac_e>" . $ex_vac_row[$j]['nonminority_sanstha_sec_vac_e'] . "</nonminority_sanstha_sec_vac_e>\n";
    $str = $str . "<nonminority_sanstha_sec_vac_r>" . $ex_vac_row[$j]['nonminority_sanstha_sec_vac_r'] . "</nonminority_sanstha_sec_vac_r>\n";
    $str = $str . "<nonminority_sanstha_sec_vac_f>" . $ex_vac_row[$j]['nonminority_sanstha_sec_vac_f'] . "</nonminority_sanstha_sec_vac_f>\n";
    $str = $str . "<nonminority_sanstha_sec_vac_v>" . $ex_vac_row[$j]['nonminority_sanstha_sec_vac_v'] . "</nonminority_sanstha_sec_vac_v>\n";
    $str = $str . "<minority_sanstha_prim_excess_e>" . $ex_vac_row[$j]['minority_sanstha_prim_excess_e'] . "</minority_sanstha_prim_excess_e>\n";
    $str = $str . "<minority_sanstha_prim_excess_r>" . $ex_vac_row[$j]['minority_sanstha_prim_excess_r'] . "</minority_sanstha_prim_excess_r>\n";
    $str = $str . "<minority_sanstha_prim_excess_f>" . $ex_vac_row[$j]['minority_sanstha_prim_excess_f'] . "</minority_sanstha_prim_excess_f>\n";
    $str = $str . "<minority_sanstha_prim_excess_v>" . $ex_vac_row[$j]['minority_sanstha_prim_excess_v'] . "</minority_sanstha_prim_excess_v>\n";
    $str = $str . "<minority_sanstha_prim_vac_e>" . $ex_vac_row[$j]['minority_sanstha_prim_vac_e'] . "</minority_sanstha_prim_vac_e>\n";
    $str = $str . "<minority_sanstha_prim_vac_r>" . $ex_vac_row[$j]['minority_sanstha_prim_vac_r'] . "</minority_sanstha_prim_vac_r>\n";
    $str = $str . "<minority_sanstha_prim_vac_f>" . $ex_vac_row[$j]['minority_sanstha_prim_vac_f'] . "</minority_sanstha_prim_vac_f>\n";
    $str = $str . "<minority_sanstha_prim_vac_v>" . $ex_vac_row[$j]['minority_sanstha_prim_vac_v'] . "</minority_sanstha_prim_vac_v>\n";
    $str = $str . "<minority_sanstha_sec_excess_e>" . $ex_vac_row[$j]['minority_sanstha_sec_excess_e'] . "</minority_sanstha_sec_excess_e>\n";
    $str = $str . "<minority_sanstha_sec_excess_r>" . $ex_vac_row[$j]['minority_sanstha_sec_excess_r'] . "</minority_sanstha_sec_excess_r>\n";
    $str = $str . "<minority_sanstha_sec_excess_f>" . $ex_vac_row[$j]['minority_sanstha_sec_excess_f'] . "</minority_sanstha_sec_excess_f>\n";
    $str = $str . "<minority_sanstha_sec_excess_v>" . $ex_vac_row[$j]['minority_sanstha_sec_excess_v'] . "</minority_sanstha_sec_excess_v>\n";
    $str = $str . "<minority_sanstha_sec_vac_e>" . $ex_vac_row[$j]['minority_sanstha_sec_vac_e'] . "</minority_sanstha_sec_vac_e>\n";
    $str = $str . "<minority_sanstha_sec_vac_r>" . $ex_vac_row[$j]['minority_sanstha_sec_vac_r'] . "</minority_sanstha_sec_vac_r>\n";
    $str = $str . "<minority_sanstha_sec_vac_f>" . $ex_vac_row[$j]['minority_sanstha_sec_vac_f'] . "</minority_sanstha_sec_vac_f>\n";
    $str = $str . "<minority_sanstha_sec_vac_v>" . $ex_vac_row[$j]['minority_sanstha_sec_vac_v'] . "</minority_sanstha_sec_vac_v>\n";
    $str = $str . "<nonminority_sanstha_entered>" . $ex_vac_row[$j]['nonminority_sanstha_entered'] . "</nonminority_sanstha_entered>\n";
    $str = $str . "<nonminority_sanstha_rejected>" . $ex_vac_row[$j]['nonminority_sanstha_rejected'] . "</nonminority_sanstha_rejected>\n";
    $str = $str . "<nonminority_sanstha_forwarded>" . $ex_vac_row[$j]['nonminority_sanstha_forwarded'] . "</nonminority_sanstha_forwarded>\n";
    $str = $str . "<nonminority_sanstha_verified>" . $ex_vac_row[$j]['nonminority_sanstha_verified'] . "</nonminority_sanstha_verified>\n";
    $str = $str . "<minority_sanstha_entered>" . $ex_vac_row[$j]['minority_sanstha_entered'] . "</minority_sanstha_entered>\n";
    $str = $str . "<minority_sanstha_rejected>" . $ex_vac_row[$j]['minority_sanstha_rejected'] . "</minority_sanstha_rejected>\n";
    $str = $str . "<minority_sanstha_forwarded>" . $ex_vac_row[$j]['minority_sanstha_forwarded'] . "</minority_sanstha_forwarded>\n";
    $str = $str . "<minority_sanstha_verified>" . $ex_vac_row[$j]['minority_sanstha_verified'] . "</minority_sanstha_verified>\n";
}

$str = $str . "</STAT>";



if (!$handle = fopen($filename, 'a+')) {
    echo "Cannot open file ($filename)";
}
if (fwrite($handle, $str) === FALSE) {
    echo "Cannot write to file ($filename)";
}

fclose($handle);

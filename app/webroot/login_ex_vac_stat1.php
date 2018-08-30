<?php
//$conn_string = "host=10.153.16.179 port=5432 dbname=Teacher_22_07_2016 user=postgres password=postgres";
//$conn_string = "host=localhost port=5432 dbname=StudentDatabase user=postgres password=root";
$conn_string = "host=10.187.200.13 port=6432 dbname=teacher user=postgres password=pass@123";
$dbconn = pg_connect($conn_string);


$truncate_ex_vac_count = "truncate table samayojan.ex_vac_count";
$truncate_ex_vac_count = pg_query($truncate_ex_vac_count) or die('Query failed: ' . pg_last_error());


$truncate_ex_staff_count = "truncate table samayojan.ex_staff_count";
$truncate_ex_staff_count = pg_query($truncate_ex_staff_count) or die('Query failed: ' . pg_last_error());

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
END AS verified
from samayojan.smj_excesstch_det exv
LEFT JOIN shala_live.shala_district sd ON substr(exv.schl_id,1,4)=sd.distcd
group by sd.distcd,asst_flag,sanstha_code,schl_id,sch_type)";

$insert_ex_staff_count = pg_query($insert_ex_staff_count) or die('Query failed: ' . pg_last_error());


$insert_ex_vac_count = "insert into samayojan.ex_vac_count(
select  
dist_code,eos_type,temp.schl_type,
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
select temp.dist_code,temp.eos_type,temp.schl_type,
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
select schl_type,dist_code,eos_type,
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
group by dist_code,schl_type,eos_type,asst_flag

UNION

select schl_type,dist_code,eos_type,
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
group by dist_code,schl_type,eos_type,asst_flag) temp 

UNION

select
substr(schl_id,1,4)dist_code,
'1' as eos_type,
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
group by dist_code,substr(schl_id,1,4),sch_type) temp 
group by dist_code,eos_type,temp.schl_type,sanstha_prim_excess_e,
sanstha_prim_excess_r,sanstha_prim_excess_f,sanstha_prim_excess_v,sanstha_prim_vac_e,sanstha_prim_vac_r,sanstha_prim_vac_f,sanstha_prim_vac_v,sanstha_sec_excess_e,
sanstha_sec_excess_r,sanstha_sec_excess_f,sanstha_sec_excess_v,sanstha_sec_vac_e,sanstha_sec_vac_r,sanstha_sec_vac_f,sanstha_sec_vac_v,entered,rejected ,forwarded ,verified
)
";
$insert_ex_vac_count = pg_query($insert_ex_vac_count) or die('Query failed: ' . pg_last_error());


$FilePath = '/wwwroot/Education/samayojan/app/View/XML/';
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

//$ex_vac_query1 = "select distinct(dist_code)dist_code,distname,schl_type
//                  from samayojan.ex_vac_count
//                  LEFT JOIN shala_live.shala_district sd ON dist_code=distcd
//                  group by dist_code,distname,schl_type order by distname";
//$ex_vac_result1 = pg_query($ex_vac_query1) or die('Query failed: ' . pg_last_error());
//$ex_vac_row1 = pg_fetch_all($ex_vac_result1);
//$ex_vac_records1 = pg_num_rows($ex_vac_result1);

//for ($j = 0; $j < $ex_vac_records1; $j++) {
//    $dist_code = trim($ex_vac_row1[$j]['dist_code']);
//    $schl_type = trim($ex_vac_row1[$j]['schl_type']);
    $ex_vac_query_new = "select distinct(dist_code),distname,schl_type,
                         sum(entered)entered,
                         sum(forwarded)forwarded,
                         sum(rejected)rejected,
                         sum(verified)verified,
                         sum(sanstha_prim_excess_e)sanstha_prim_excess_e,
                         sum(sanstha_sec_excess_e) sanstha_sec_excess_e,
                         sum(sanstha_prim_excess_r)sanstha_prim_excess_r,
                         sum(sanstha_sec_excess_r) sanstha_sec_excess_r,
                         sum(sanstha_prim_excess_f)sanstha_prim_excess_f,
                         sum(sanstha_sec_excess_f) sanstha_sec_excess_f,
                         sum(sanstha_prim_excess_v)sanstha_prim_excess_v,
                         sum(sanstha_sec_excess_v) sanstha_sec_excess_v,
                         sum(sanstha_prim_vac_e)sanstha_prim_vac_e,
                         sum(sanstha_sec_vac_e) sanstha_sec_vac_e,
                         sum(sanstha_prim_vac_r)sanstha_prim_vac_r,
                         sum(sanstha_sec_vac_r) sanstha_sec_vac_r,
                         sum(sanstha_prim_vac_f)sanstha_prim_vac_f,
                         sum(sanstha_sec_vac_f) sanstha_sec_vac_f,
                         sum(sanstha_prim_vac_v)sanstha_prim_vac_v,
                         sum(sanstha_sec_vac_v) sanstha_sec_vac_v
                         from samayojan.ex_vac_count evac
                         LEFT JOIN shala_live.shala_district sd ON dist_code=distcd                        
                         group by dist_code,distname,schl_type order by distname";
//    where dist_code='$dist_code' and schl_type='$schl_type'
    $ex_vac_result_new = pg_query($ex_vac_query_new) or die('Query failed: ' . pg_last_error());
    $ex_vac_row_new = pg_fetch_all($ex_vac_result_new);

    $dist_code_array= trim($ex_vac_row1[$j]['dist_code']);
    $schl_type_array= trim($ex_vac_row1[$j]['schl_type']);
//}

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

$ex_vac_query = "select distinct(dist_code),distname,schl_type,
                 sum(entered)entered,
                 sum(forwarded)forwarded,
                 sum(rejected)rejected,
                 sum(verified)verified,
                 sum(sanstha_prim_excess_e)sanstha_prim_excess_e,
                 sum(sanstha_sec_excess_e) sanstha_sec_excess_e,
                 sum(sanstha_prim_excess_r)sanstha_prim_excess_r,
                 sum(sanstha_sec_excess_r) sanstha_sec_excess_r,
                 sum(sanstha_prim_excess_f)sanstha_prim_excess_f,
                 sum(sanstha_sec_excess_f) sanstha_sec_excess_f,
                 sum(sanstha_prim_excess_v)sanstha_prim_excess_v,
                 sum(sanstha_sec_excess_v) sanstha_sec_excess_v,
                 sum(sanstha_prim_vac_e)sanstha_prim_vac_e,
                 sum(sanstha_sec_vac_e) sanstha_sec_vac_e,
                 sum(sanstha_prim_vac_r)sanstha_prim_vac_r,
                 sum(sanstha_sec_vac_r) sanstha_sec_vac_r,
                 sum(sanstha_prim_vac_f)sanstha_prim_vac_f,
                 sum(sanstha_sec_vac_f) sanstha_sec_vac_f,
                 sum(sanstha_prim_vac_v)sanstha_prim_vac_v,
                 sum(sanstha_sec_vac_v) sanstha_sec_vac_v
                 from samayojan.ex_vac_count evac
                 LEFT JOIN shala_live.shala_district sd ON dist_code=distcd
                 where dist_code NOT IN (select substr(eo_code,1,4) dist_code from samayojan.smj_approval_det where substr(eo_code,1,4) IN $dist_code and substr(eo_code,7,8) IN $schl_type)
                 group by dist_code,distname,schl_type order by distname";
$ex_vac_result = pg_query($ex_vac_query) or die('Query failed: ' . pg_last_error());
$ex_vac_row = pg_fetch_all($ex_vac_result);
$ex_vac_records = pg_num_rows($ex_vac_result);

for ($j = 0; $j < count($ex_vac_row_new); $j++) {
    $str = $str . "<dist_id>" . $ex_vac_row_new[$j][0]['dist_code'] . "</dist_id>\n";
    $str = $str . "<dist_code>" . $ex_vac_row_new[$j][0]['distname'] . "</dist_code>\n";
    $str = $str . "<schl_type>" . $ex_vac_row_new[$j][0]['schl_type'] . "</schl_type>\n";
    $str = $str . "<sanstha_prim_excess_e>" . $ex_vac_row_new[$j][0]['sanstha_prim_excess_e'] . "</sanstha_prim_excess_e>\n";
    $str = $str . "<sanstha_prim_excess_r>" . $ex_vac_row_new[$j][0]['sanstha_prim_excess_r'] . "</sanstha_prim_excess_r>\n";
    $str = $str . "<sanstha_prim_excess_f>" . $ex_vac_row_new[$j][0]['sanstha_prim_excess_f'] . "</sanstha_prim_excess_f>\n";
    $str = $str . "<sanstha_prim_excess_v>" . $ex_vac_row_new[$j][0]['sanstha_prim_excess_v'] . "</sanstha_prim_excess_v>\n";
    $str = $str . "<sanstha_prim_vac_e>" . $ex_vac_row_new[$j][0]['sanstha_prim_vac_e'] . "</sanstha_prim_vac_e>\n";
    $str = $str . "<sanstha_prim_vac_r>" . $ex_vac_row_new[$j][0]['sanstha_prim_vac_r'] . "</sanstha_prim_vac_r>\n";
    $str = $str . "<sanstha_prim_vac_f>" . $ex_vac_row_new[$j][0]['sanstha_prim_vac_f'] . "</sanstha_prim_vac_f>\n";
    $str = $str . "<sanstha_prim_vac_v>" . $ex_vac_row_new[$j][0]['sanstha_prim_vac_v'] . "</sanstha_prim_vac_v>\n";
    $str = $str . "<sanstha_sec_excess_e>" . $ex_vac_row_new[$j][0]['sanstha_sec_excess_e'] . "</sanstha_sec_excess_e>\n";
    $str = $str . "<sanstha_sec_excess_r>" . $ex_vac_row_new[$j][0]['sanstha_sec_excess_r'] . "</sanstha_sec_excess_r>\n";
    $str = $str . "<sanstha_sec_excess_f>" . $ex_vac_row_new[$j][0]['sanstha_sec_excess_f'] . "</sanstha_sec_excess_f>\n";
    $str = $str . "<sanstha_sec_excess_v>" . $ex_vac_row_new[$j][0]['sanstha_sec_excess_v'] . "</sanstha_sec_excess_v>\n";
    $str = $str . "<sanstha_sec_vac_e>" . $ex_vac_row_new[$j][0]['sanstha_sec_vac_e'] . "</sanstha_sec_vac_e>\n";
    $str = $str . "<sanstha_sec_vac_r>" . $ex_vac_row_new[$j][0]['sanstha_sec_vac_r'] . "</sanstha_sec_vac_r>\n";
    $str = $str . "<sanstha_sec_vac_f>" . $ex_vac_row_new[$j][0]['sanstha_sec_vac_f'] . "</sanstha_sec_vac_f>\n";
    $str = $str . "<sanstha_sec_vac_v>" . $ex_vac_row_new[$j][0]['sanstha_sec_vac_v'] . "</sanstha_sec_vac_v>\n";
    $str = $str . "<entered>" . $ex_vac_row_new[$j][0]['entered'] . "</entered>\n";
    $str = $str . "<forwarded>" . $ex_vac_row_new[$j][0]['forwarded'] . "</forwarded>\n";
    $str = $str . "<rejected>" . $ex_vac_row_new[$j][0]['rejected'] . "</rejected>\n";
    $str = $str . "<verified>" . $ex_vac_row_new[$j][0]['verified'] . "</verified>\n";
}

for ($j = 0; $j < count($ex_vac_row); $j++) {
    $str = $str . "<dist_id>" . '' . "</dist_id>\n";
    $str = $str . "<dist_code>" . $ex_vac_row[$j]['distname'] . "</dist_code>\n";
    $str = $str . "<schl_type>" . $ex_vac_row[$j]['schl_type'] . "</schl_type>\n";
    $str = $str . "<sanstha_prim_excess_e>" . $ex_vac_row[$j]['sanstha_prim_excess_e'] . "</sanstha_prim_excess_e>\n";
    $str = $str . "<sanstha_prim_excess_r>" . $ex_vac_row[$j]['sanstha_prim_excess_r'] . "</sanstha_prim_excess_r>\n";
    $str = $str . "<sanstha_prim_excess_f>" . $ex_vac_row[$j]['sanstha_prim_excess_f'] . "</sanstha_prim_excess_f>\n";
    $str = $str . "<sanstha_prim_excess_v>" . $ex_vac_row[$j]['sanstha_prim_excess_v'] . "</sanstha_prim_excess_v>\n";
    $str = $str . "<sanstha_prim_vac_e>" . $ex_vac_row[$j]['sanstha_prim_vac_e'] . "</sanstha_prim_vac_e>\n";
    $str = $str . "<sanstha_prim_vac_r>" . $ex_vac_row[$j]['sanstha_prim_vac_r'] . "</sanstha_prim_vac_r>\n";
    $str = $str . "<sanstha_prim_vac_f>" . $ex_vac_row[$j]['sanstha_prim_vac_f'] . "</sanstha_prim_vac_f>\n";
    $str = $str . "<sanstha_prim_vac_v>" . $ex_vac_row[$j]['sanstha_prim_vac_v'] . "</sanstha_prim_vac_v>\n";
    $str = $str . "<sanstha_sec_excess_e>" . $ex_vac_row[$j]['sanstha_sec_excess_e'] . "</sanstha_sec_excess_e>\n";
    $str = $str . "<sanstha_sec_excess_r>" . $ex_vac_row[$j]['sanstha_sec_excess_r'] . "</sanstha_sec_excess_r>\n";
    $str = $str . "<sanstha_sec_excess_f>" . $ex_vac_row[$j]['sanstha_sec_excess_f'] . "</sanstha_sec_excess_f>\n";
    $str = $str . "<sanstha_sec_excess_v>" . $ex_vac_row[$j]['sanstha_sec_excess_v'] . "</sanstha_sec_excess_v>\n";
    $str = $str . "<sanstha_sec_vac_e>" . $ex_vac_row[$j]['sanstha_sec_vac_e'] . "</sanstha_sec_vac_e>\n";
    $str = $str . "<sanstha_sec_vac_r>" . $ex_vac_row[$j]['sanstha_sec_vac_r'] . "</sanstha_sec_vac_r>\n";
    $str = $str . "<sanstha_sec_vac_f>" . $ex_vac_row[$j]['sanstha_sec_vac_f'] . "</sanstha_sec_vac_f>\n";
    $str = $str . "<sanstha_sec_vac_v>" . $ex_vac_row[$j]['sanstha_sec_vac_v'] . "</sanstha_sec_vac_v>\n";
    $str = $str . "<entered>" . $ex_vac_row[$j]['entered'] . "</entered>\n";
    $str = $str . "<forwarded>" . $ex_vac_row[$j]['forwarded'] . "</forwarded>\n";
    $str = $str . "<rejected>" . $ex_vac_row[$j]['rejected'] . "</rejected>\n";
    $str = $str . "<verified>" . $ex_vac_row[$j]['verified'] . "</verified>\n";
}
$str = $str . "</STAT>";

if (!$handle = fopen($filename, 'a+')) {
    echo "Cannot open file ($filename)";
}
if (fwrite($handle, $str) === FALSE) {
    echo "Cannot write to file ($filename)";
}

fclose($handle);

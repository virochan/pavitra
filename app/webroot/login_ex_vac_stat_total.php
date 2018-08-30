<?php

//$conn_string = "host=10.153.16.179 port=5432 dbname=samayojan user=postgres password=postgres";
$conn_string = "host=10.187.200.13 port=6432 dbname=teacher user=postgres password=pass@123";
//$conn_string = "host=10.153.16.179 port=5432 dbname=Teacher_19_08_2017 user=postgres password=postgres";
$dbconn = pg_connect($conn_string);

$FilePath = '/wwwroot/Education/samayojan/app/View/XML';
$dir = $FilePath;
chdir($dir);
$filename = "login_ex_vac_stat_total.xml";
$str = "";
$schl_sum = 0;
$tchr_sum = 0;
if (!$handle = fopen($filename, 'w')) {
    echo "Cannot open file ($filename)";
}
fclose($handle);

$str = $str . "<?xml version='1.0'?>\n";
$str = $str . "<STAT>\n";


$ex_vac_query = "select distinct(dist_code),distname,minority_sanstha,
sum(nonminority_sanstha_entered)nonminority_sanstha_entered,
sum(nonminority_sanstha_rejected)nonminority_sanstha_rejected,
sum(nonminority_sanstha_forwarded)nonminority_sanstha_forwarded,
sum(nonminority_sanstha_verified)nonminority_sanstha_verified,
sum(minority_sanstha_entered)minority_sanstha_entered,
sum(minority_sanstha_rejected)minority_sanstha_rejected,
sum(minority_sanstha_forwarded)minority_sanstha_forwarded,
sum(minority_sanstha_verified)minority_sanstha_verified,
sum(nonminority_sanstha_prim_excess_e+nonminority_sanstha_sec_excess_e)nonminority_sanstha_excess_e,
sum(nonminority_sanstha_prim_excess_r+nonminority_sanstha_sec_excess_r)nonminority_sanstha_excess_r,
sum(nonminority_sanstha_prim_excess_f+nonminority_sanstha_sec_excess_f)nonminority_sanstha_excess_f,
sum(nonminority_sanstha_prim_excess_v+nonminority_sanstha_sec_excess_v)nonminority_sanstha_excess_v,
sum(nonminority_sanstha_prim_vac_e+nonminority_sanstha_sec_vac_e)nonminority_sanstha_vac_e,
sum(nonminority_sanstha_prim_vac_r+nonminority_sanstha_sec_vac_r)nonminority_sanstha_vac_r,
sum(nonminority_sanstha_prim_vac_f+nonminority_sanstha_sec_vac_f)nonminority_sanstha_vac_f,
sum(nonminority_sanstha_prim_vac_v+nonminority_sanstha_sec_vac_v)nonminority_sanstha_vac_v,
sum(minority_sanstha_prim_excess_e+minority_sanstha_sec_excess_e)minority_sanstha_excess_e,
sum(minority_sanstha_prim_excess_r+minority_sanstha_sec_excess_r)minority_sanstha_excess_r,
sum(minority_sanstha_prim_excess_f+minority_sanstha_sec_excess_f)minority_sanstha_excess_f,
sum(minority_sanstha_prim_excess_v+minority_sanstha_sec_excess_v)minority_sanstha_excess_v,
sum(minority_sanstha_prim_vac_e+minority_sanstha_sec_vac_e)minority_sanstha_vac_e,
sum(minority_sanstha_prim_vac_r+minority_sanstha_sec_vac_r)minority_sanstha_vac_r,
sum(minority_sanstha_prim_vac_f+minority_sanstha_sec_vac_f)minority_sanstha_vac_f,
sum(minority_sanstha_prim_vac_v+minority_sanstha_sec_vac_v)minority_sanstha_vac_v
from samayojan.minorty_nonminority_count
LEFT JOIN shala_live.shala_district ON dist_code=distcd
group by dist_code,distname,minority_sanstha order by distname";

$ex_vac_result = pg_query($ex_vac_query) or die('Query failed: ' . pg_last_error());
$ex_vac_row = pg_fetch_all($ex_vac_result);
//print_r($ex_vac_row);
//die();
$ex_vac_records = pg_num_rows($ex_vac_result);
for ($j = 0; $j < $ex_vac_records; $j++) {
    $str = $str . "<sanstha_type>" . $ex_vac_row[$j]['minority_sanstha'] . "</sanstha_type>\n";
    $str = $str . "<dist_code>" . $ex_vac_row[$j]['distname'] . "</dist_code>\n";
    $str = $str . "<nonminority_sanstha_entered>" . $ex_vac_row[$j]['nonminority_sanstha_entered'] . "</nonminority_sanstha_entered>\n";
    $str = $str . "<nonminority_sanstha_rejected>" . $ex_vac_row[$j]['nonminority_sanstha_rejected'] . "</nonminority_sanstha_rejected>\n";
    $str = $str . "<nonminority_sanstha_forwarded>" . $ex_vac_row[$j]['nonminority_sanstha_forwarded'] . "</nonminority_sanstha_forwarded>\n";
    $str = $str . "<nonminority_sanstha_verified>" . $ex_vac_row[$j]['nonminority_sanstha_verified'] . "</nonminority_sanstha_verified>\n";
    $str = $str . "<minority_sanstha_verified>" . $ex_vac_row[$j]['minority_sanstha_verified'] . "</minority_sanstha_verified>\n";
    $str = $str . "<minority_sanstha_entered>" . $ex_vac_row[$j]['minority_sanstha_entered'] . "</minority_sanstha_entered>\n";
    $str = $str . "<minority_sanstha_rejected>" . $ex_vac_row[$j]['minority_sanstha_rejected'] . "</minority_sanstha_rejected>\n";
    $str = $str . "<minority_sanstha_forwarded>" . $ex_vac_row[$j]['minority_sanstha_forwarded'] . "</minority_sanstha_forwarded>\n";
    $str = $str . "<minority_sanstha_verified>" . $ex_vac_row[$j]['minority_sanstha_verified'] . "</minority_sanstha_verified>\n";
    $str = $str . "<nonminority_sanstha_excess_e>" . $ex_vac_row[$j]['nonminority_sanstha_excess_e'] . "</nonminority_sanstha_excess_e>\n";
    $str = $str . "<nonminority_sanstha_excess_f>" . $ex_vac_row[$j]['nonminority_sanstha_excess_f'] . "</nonminority_sanstha_excess_f>\n";
    $str = $str . "<nonminority_sanstha_excess_r>" . $ex_vac_row[$j]['nonminority_sanstha_excess_r'] . "</nonminority_sanstha_excess_r>\n";
    $str = $str . "<nonminority_sanstha_excess_v>" . $ex_vac_row[$j]['nonminority_sanstha_excess_v'] . "</nonminority_sanstha_excess_v>\n";
    $str = $str . "<nonminority_sanstha_vac_e>" . $ex_vac_row[$j]['nonminority_sanstha_vac_e'] . "</nonminority_sanstha_vac_e>\n";
    $str = $str . "<nonminority_sanstha_vac_f>" . $ex_vac_row[$j]['nonminority_sanstha_vac_f'] . "</nonminority_sanstha_vac_f>\n";
    $str = $str . "<nonminority_sanstha_vac_r>" . $ex_vac_row[$j]['nonminority_sanstha_vac_r'] . "</nonminority_sanstha_vac_r>\n";
    $str = $str . "<nonminority_sanstha_vac_v>" . $ex_vac_row[$j]['nonminority_sanstha_vac_v'] . "</nonminority_sanstha_vac_v>\n";
    $str = $str . "<minority_sanstha_excess_e>" . $ex_vac_row[$j]['minority_sanstha_excess_e'] . "</minority_sanstha_excess_e>\n";
    $str = $str . "<minority_sanstha_excess_f>" . $ex_vac_row[$j]['minority_sanstha_excess_f'] . "</minority_sanstha_excess_f>\n";
    $str = $str . "<minority_sanstha_excess_r>" . $ex_vac_row[$j]['minority_sanstha_excess_r'] . "</minority_sanstha_excess_r>\n";
    $str = $str . "<minority_sanstha_excess_v>" . $ex_vac_row[$j]['minority_sanstha_excess_v'] . "</minority_sanstha_excess_v>\n";
    $str = $str . "<minority_sanstha_vac_e>" . $ex_vac_row[$j]['minority_sanstha_vac_e'] . "</minority_sanstha_vac_e>\n";
    $str = $str . "<minority_sanstha_vac_f>" . $ex_vac_row[$j]['minority_sanstha_vac_f'] . "</minority_sanstha_vac_f>\n";
    $str = $str . "<minority_sanstha_vac_r>" . $ex_vac_row[$j]['minority_sanstha_vac_r'] . "</minority_sanstha_vac_r>\n";
    $str = $str . "<minority_sanstha_vac_v>" . $ex_vac_row[$j]['minority_sanstha_vac_v'] . "</minority_sanstha_vac_v>\n";
}
$str = $str . "</STAT>";

if (!$handle = fopen($filename, 'a+')) {
    echo "Cannot open file ($filename)";
}
if (fwrite($handle, $str) === FALSE) {
    echo "Cannot write to file ($filename)";
}

fclose($handle);

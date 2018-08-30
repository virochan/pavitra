<?php

//$conn_string = "host=10.153.16.179 port=5432 dbname=samayojan user=postgres password=postgres";
$conn_string = "host=10.187.200.13 port=6432 dbname=teacher user=postgres password=pass@123";
//$conn_string = "host=10.153.16.179 port=5432 dbname=Teacher user=postgres password=postgres";
$dbconn = pg_connect($conn_string);

$FilePath = '/wwwroot/Education/samayojan/app/View/XML/';
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


$ex_vac_query = "select distinct(dist_code),distname,
sum(entered)entered,
sum(forwarded)forwarded,
sum(rejected)rejected,
sum(verified)verified,
sum(sanstha_prim_excess_e+sanstha_sec_excess_e)sanstha_excess_e,
sum(sanstha_prim_excess_r+sanstha_sec_excess_r)sanstha_excess_r,
sum(sanstha_prim_excess_f+sanstha_sec_excess_f)sanstha_excess_f,
sum(sanstha_prim_excess_v+sanstha_sec_excess_v)sanstha_excess_v,
sum(sanstha_prim_vac_e+sanstha_sec_vac_e)sanstha_vac_e,
sum(sanstha_prim_vac_r+sanstha_sec_vac_r)sanstha_vac_r,
sum(sanstha_prim_vac_f+sanstha_sec_vac_f)sanstha_vac_f,
sum(sanstha_prim_vac_v+sanstha_sec_vac_v)sanstha_vac_v
from samayojan.ex_vac_count
LEFT JOIN shala_live.shala_district ON dist_code=distcd
group by dist_code,distname order by distname";

$ex_vac_result = pg_query($ex_vac_query) or die('Query failed: ' . pg_last_error());
$ex_vac_row = pg_fetch_all($ex_vac_result);
//print_r($ex_vac_row);
//die();
$ex_vac_records = pg_num_rows($ex_vac_result);
for ($j = 0; $j < $ex_vac_records; $j++) {
    $str = $str . "<dist_code>" . $ex_vac_row[$j]['distname'] . "</dist_code>\n";
    $str = $str . "<excess_e>" . $ex_vac_row[$j]['sanstha_excess_e'] . "</excess_e>\n";
    $str = $str . "<excess_r>" . $ex_vac_row[$j]['sanstha_excess_r'] . "</excess_r>\n";
    $str = $str . "<excess_f>" . $ex_vac_row[$j]['sanstha_excess_f'] . "</excess_f>\n";
    $str = $str . "<excess_v>" . $ex_vac_row[$j]['sanstha_excess_v'] . "</excess_v>\n";
    $str = $str . "<vacant_e>" . $ex_vac_row[$j]['sanstha_vac_e'] . "</vacant_e>\n";
    $str = $str . "<vacant_r>" . $ex_vac_row[$j]['sanstha_vac_r'] . "</vacant_r>\n";
    $str = $str . "<vacant_f>" . $ex_vac_row[$j]['sanstha_vac_f'] . "</vacant_f>\n";
    $str = $str . "<vacant_v>" . $ex_vac_row[$j]['sanstha_vac_v'] . "</vacant_v>\n";
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

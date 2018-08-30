<?php

//$conn_string = "host=localhost port=5432 dbname=StudentDatabase user=postgres password=root";
$conn_string = "host=10.187.200.13 port=6432 dbname=teacher user=postgres password=pass@123";
$dbconn = pg_connect($conn_string);


$truncate_roster_count = "truncate table samayojan.roster_count";
$truncate_roster_count = pg_query($truncate_roster_count) or die('Query failed: ' . pg_last_error());

$insert_roster_count = "insert into samayojan.roster_count(select temp.roster_edn_level,sum(roster_primary_E) as roster_primary_E,sum(roster_primary_R) as roster_primary_R,sum(roster_primary_F) as roster_primary_F,sum(roster_primary_V) as roster_primary_V,
sum(roster_secondary_E) as roster_secondary_E,sum(roster_secondary_R) as roster_secondary_R,sum(roster_secondary_F) as roster_secondary_F,sum(roster_secondary_V) as roster_secondary_V
from (
select roster_edn_level,
CASE
WHEN roster_edn_level = 'P' and asst_flag = 'E'::bpchar OR asst_flag = 'Z'::bpchar THEN count(1)
ELSE 0::bigint
END AS roster_primary_E,
CASE
WHEN roster_edn_level = 'P' and asst_flag = 'R' ::bpchar THEN count(1)
ELSE 0::bigint
END AS roster_primary_R,
CASE
WHEN roster_edn_level = 'P' and asst_flag = 'F' ::bpchar THEN count(1)
ELSE 0::bigint
END AS roster_primary_F,
CASE
WHEN roster_edn_level = 'P' and asst_flag = 'V' ::bpchar THEN count(1)
ELSE 0::bigint
END AS roster_primary_V,

0 as roster_secondary_E,
0 as roster_secondary_R,
0 as roster_secondary_F,
0 as roster_secondary_V
from samayojan.roster_info 
group by roster_edn_level,asst_flag
UNION
select roster_edn_level,
0 as roster_primary_E, 
0 as roster_primary_R,
0 as roster_primary_F,
0 as roster_primary_V,
CASE
WHEN roster_edn_level = 'S' and asst_flag = 'E'::bpchar OR asst_flag = 'Z'::bpchar THEN count(1)
ELSE 0::bigint
END AS roster_secondary_E,
CASE
WHEN roster_edn_level = 'S' and asst_flag = 'R' ::bpchar THEN count(1)
ELSE 0::bigint
END AS roster_secondary_R,
CASE
WHEN roster_edn_level = 'S' and asst_flag = 'F' ::bpchar THEN count(1)
ELSE 0::bigint
END AS roster_secondary_F,
CASE
WHEN roster_edn_level = 'S' and asst_flag = 'V' ::bpchar THEN count(1)
ELSE 0::bigint
END AS roster_secondary_V
from samayojan.roster_info 
group by roster_edn_level,asst_flag) temp 
group by roster_edn_level)
";
$insert_roster_count = pg_query($insert_roster_count) or die('Query failed: ' . pg_last_error());





$FilePath = '/wwwroot/Education/samayojan/app/View/XML/';
$dir = $FilePath;

chdir($dir);
$filename = "login_page_stat.xml";
$str = "";
$schl_sum = 0;
$tchr_sum = 0;
if (!$handle = fopen($filename, 'w')) {
    echo "Cannot open file ($filename)";
}
fclose($handle);

$str = $str . "<?xml version='1.0'?>\n";
$str = $str . "<STAT>\n";

$roster_query = "select * from samayojan.roster_count";

$roster_result = pg_query($roster_query) or die('Query failed: ' . pg_last_error());
$roster_row = pg_fetch_all($roster_result);
$roster_records = pg_num_rows($roster_result);

for ($j = 0; $j < $roster_records; $j++) {
    $str = $str . "<roster_edn_level>" . $roster_row[$j]['roster_edn_level'] . "</roster_edn_level>\n";
    $str = $str . "<roster_primary_e>" . $roster_row[$j]['roster_primary_e'] . "</roster_primary_e>\n";
    $str = $str . "<roster_primary_r>" . $roster_row[$j]['roster_primary_r'] . "</roster_primary_r>\n";
    $str = $str . "<roster_primary_f>" . $roster_row[$j]['roster_primary_f'] . "</roster_primary_f>\n";
    $str = $str . "<roster_primary_v>" . $roster_row[$j]['roster_primary_v'] . "</roster_primary_v>\n";
    $str = $str . "<roster_secondary_e>" . $roster_row[$j]['roster_secondary_e'] . "</roster_secondary_e>\n";
    $str = $str . "<roster_secondary_r>" . $roster_row[$j]['roster_secondary_r'] . "</roster_secondary_r>\n";
    $str = $str . "<roster_secondary_f>" . $roster_row[$j]['roster_secondary_f'] . "</roster_secondary_f>\n";
    $str = $str . "<roster_secondary_v>" . $roster_row[$j]['roster_secondary_v'] . "</roster_secondary_v>\n";
}
$str = $str . "</STAT>";

if (!$handle = fopen($filename, 'a+')) {
    echo "Cannot open file ($filename)";
}
if (fwrite($handle, $str) === FALSE) {
    echo "Cannot write to file ($filename)";
}

fclose($handle);

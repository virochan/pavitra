<?php

//$conn_string = "host=localhost port=5432 dbname=StudentDatabase user=postgres password=root";
$conn_string = "host=10.153.16.179 port=5432 dbname=Teacher user=postgres password=postgres";
$dbconn = pg_connect($conn_string);


$FilePath = '../View/XML/';
$dir = $FilePath;
chdir($dir);
$filename = "districtwise.xml";
$str = "";
$schl_sum = 0;
$tchr_sum = 0;
if (!$handle = fopen($filename, 'w')) {
    echo "Cannot open file ($filename)";
}
fclose($handle);

$str = $str . "<?xml version='1.0'?>\n";
$str = $str . "<TEACHERDATA>\n";


/*$schl_query = "SELECT dis.distname , dis.distcd , vw_dis.sch_count,vw_dis.tchr_count
 FROM shala_live.shala_district as dis
 LEFT JOIN master.view_dist_stud_tchr as vw_dis  ON  vw_dis.dist_code = dis.distcd ORDER BY dis.distname";*/
 $schl_query = "SELECT distinct(dis.distname) , dis.distcd , sum(sch_count) as sch_count,sum(tchr_count) as tchr_count
				FROM shala_live.shala_district as dis
				LEFT JOIN master.view_dist_stud_tchr as vw_dis  ON  vw_dis.dist_code = dis.distcd
				GROUP BY dis.distname,dis.distcd
				ORDER BY dis.distname";
 
$schl_result = pg_query($schl_query) or die('Query failed: ' . pg_last_error());
$schl_row = pg_fetch_all($schl_result);
$num_records = pg_num_rows($schl_result);

for ($j = 0; $j < $num_records; $j++) {
    $str = $str . "<" . $schl_row[$j]['distname'] . ">\n";

    //$distname = htmlentities($schl_row[$j]['distname']);


    $str = $str . "<NAME>" . $schl_row[$j]['distname'] . "</NAME>\n";
    $str = $str . "<DISTCD>" . $schl_row[$j]['distcd'] . "</DISTCD>\n";
    $str = $str . "<SCHCNT>" . $schl_row[$j]['sch_count'] . "</SCHCNT>\n";
    $str = $str . "<TEACHERCNT>" . $schl_row[$j]['tchr_count'] . "</TEACHERCNT>\n";
    $str = $str . "</" . $schl_row[$j]['distname'] . ">\n";
}
$str = $str . "</TEACHERDATA>";


if (!$handle = fopen($filename, 'a+')) {
    echo "Cannot open file ($filename)";
}
if (fwrite($handle, $str) === FALSE) {
    echo "Cannot write to file ($filename)";
}

fclose($handle);
/* --------------------------------------------------neha --------------------------------------------- */
$query = "SELECT count(distinct schl_id) FROM master.tch_master";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$numschools = pg_fetch_array($result, null, PGSQL_ASSOC);
$numschools = floatval($numschools['count']);
$numschools = number_format($numschools);


$query = "SELECT count(tchr_id) FROM master.tch_master;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$numtchrs = pg_fetch_array($result, null, PGSQL_ASSOC);
$numtchrs = floatval($numtchrs['count']);
$numtchrs = number_format($numtchrs);

$FilePath = '../View/XML/';

$filename = "xmlschoolstchrs.xml";
$str = "";
if (!$handle = fopen($filename, 'w')) {
    echo "Cannot open file ($filename)";
}
fclose($handle);

$str = $str . "<?xml version='1.0'?>\n";
$str = $str . "<TCHRDATA>\n";

$str = $str . "<SCHCNT>" . $numschools . "</SCHCNT>\n";
$str = $str . "<TCHRCNT>" . $numtchrs . "</TCHRCNT>\n";
$str = $str . "</TCHRDATA>\n";


if (!$handle = fopen($filename, 'a+')) {
    echo "Cannot open file ($filename)";
}
if (fwrite($handle, $str) === FALSE) {
    echo "Cannot write to file ($filename)";
}
//}
fclose($handle);
?>
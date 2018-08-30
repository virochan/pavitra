<?php

//$conn_string = "host=localhost port=5432 dbname=StudentDatabase user=postgres password=root";
$conn_string = "host=10.153.16.179 port=5432 dbname=Teacher user=postgres password=root";
$dbconn = pg_connect($conn_string);

$query = "SELECT count(distinct schl_id) FROM master.tch_master";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$numschools = pg_fetch_array($result, null, PGSQL_ASSOC);

$numschools = number_format($numschools['count']);


$query = "SELECT count(tchr_id) FROM master.tch_master;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$numtchrs = pg_fetch_array($result, null, PGSQL_ASSOC);

$numtchrs = number_format($numtchrs['count']);
//echo "<pre>";
//print_r($numschools);
//print_r($numtchrs);
//exit;


            $FilePath='../View/XML/';
            $dir = $FilePath;
            chdir($dir); 		
            $filename = "xmlschoolstchrs.xml";		
            $str = "";
            if (!$handle = fopen($filename, 'w')) 
            {
                    echo "Cannot open file ($filename)";
            }	
            fclose($handle);
            
            $str=$str."<?xml version='1.0'?>\n";	
		$str=$str."<TCHRDATA>\n";
                
                $str=$str."<SCHCNT>".$numschools."</SCHCNT>\n";					
                $str=$str."<TCHRCNT>".$numtchrs."</TCHRCNT>\n";
                $str=$str."</TCHRDATA>\n";
                
             
            if (!$handle = fopen($filename, 'a+')) 
                {
                        echo "Cannot open file ($filename)";
                }
                if (fwrite($handle, $str) === FALSE) 
                {
                        echo "Cannot write to file ($filename)";
                }
		//}
		fclose($handle);
?>
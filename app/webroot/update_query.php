<?php

//$conn_string = "host=localhost port=5432 dbname=StudentDatabase user=postgres password=root";
$conn_string = "host=10.187.200.13 port=6432 dbname=teacher user=postgres password=pass@123";
$dbconn = pg_connect($conn_string);
 

//$update_query = "UPDATE samayojan.eo_sanstha_ex_vac as A
//   SET minority_sanstha=B.minority_sanstha
//FROM samayojan.sanstha_basic_info as B
// WHERE A.sanstha_code= trim(B.sanstha_code)
//";
//AND A.minority_sanstha is null OR A.minority_sanstha='';

$update_query = "DELETE FROM samayojan.eo_sanstha_ex_vac where eos_medium_id is null OR  eos_medium_id ='' ";
$update_query = pg_query($update_query) or die('Query failed: ' . pg_last_error());

 
 
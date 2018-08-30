<?php
class SelectSansthaBasicInfo extends AppModel {

    public $useDbConfig = 'use_db_samayojan_data';
    var $name = "SelectSansthaBasicInfo";
    var $useTable = 'sanstha_basic_info'; //  schema= shala

    public function getSansthaNameEo($dist_id) {
        $query = "SELECT sanstha_code,sanstha_name
                  FROM   samayojan.sanstha_basic_info
                  WHERE  sanstha_code like '" . $dist_id . "%'
                  ORDER BY sanstha_name";
//        echo "****".$query1; exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSansthaMinorityType($sanstha_code) {
        $query = "SELECT minority_sanstha
                  FROM   samayojan.sanstha_basic_info
                  WHERE  sanstha_code like '" . $sanstha_code . "%'
                   ";
//        echo "****".$query; exit();
        $result = $this->query($query);

//                 echo "<pre>".print_r($result,true)."</pre>"; exit();
        
        if ($result[0][0]['minority_sanstha'] == 1) {
//            echo "NON-MINOITY";
            $result1 = '1';
        } else {
//            echo "MINOITY";
            $result1 = '2';
        }
//         echo "" .$result1;
        if ($result <> NULL)
            return $result1;
        else {
            return 0;
        }
    }

}
?>
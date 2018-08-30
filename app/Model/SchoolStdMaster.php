<?php

class SchoolStdMaster extends AppModel {

    var $name = 'SchoolStdMaster';
    public $useDbConfig = 'default_db';
    var $useTable = 'shala_schmgtdet'; //db=shala_live schema=udise

    public function getSchoolStd($schcd) {
//        echo $query = "SELECT * FROM udise.steps_master,udise.shala_schmgtdet
//                where 
//                 steps_master.schmgt =   CAST(shala_schmgtdet.schmgt_udise_id as integer)
//                AND steps_master.schcd= '" . $schcd . "' 
//                AND steps_master.ac_year='2014-15'";


        $query = "SELECT SAS.schcd ,
  SAS.school_name as schname ,
  SAS.school_management ,
  SAS.management_details ,
  SAS.school_category  ,
  SAS.lowest_class as lowclass ,
  SAS.highest_class as highclass ,
  SAS.school_close  ,
  SAS.school_close_date  ,
  SAS.insert_date  ,
  SAS.update_date  ,
  SAS.clucd  , 
 SS.schmgtdet_id  ,
  SS.schmgtdet_desc ,
  SS.schmgt_parent ,
  SS.predefined  ,
  SS.visible_yn  ,
  SS.schmgt_udise_id ,
  SS.create_time 
  
    FROM shala.shala_all_school as SAS,udise.shala_schmgtdet as SS
                where 
                 SAS.management_details =     CAST(SS.schmgtdet_id as integer) 
                AND  SAS.schcd =  '" . $schcd . "' 
                ";

//schmgt_udise_id


        $result = $this->query($query);
//        echo "<pre>" . print_r($result, true) . "</pre>";
//        exit();
        if ($result <> NULL)
            return $result;
//        else 
//              throw new NotFoundException('Could not find that Data');
    }

    public function getSchoolStdacad($schcd) {
//        $query = "SELECT * FROM udise.steps_master,udise.shala_schmgtdet
//                where 
//                 steps_master.schmgt =   CAST(shala_schmgtdet.schmgt_udise_id as integer)
//                AND steps_master.schcd= '" . $schcd . "'";

        $query = "SELECT SAS.schcd ,
  SAS.school_name as schname ,
  SAS.school_management ,
  SAS.management_details ,
  SAS.school_category  ,
  SAS.lowest_class as lowclass ,
  SAS.highest_class as highclass ,
  SAS.school_close  ,
  SAS.school_close_date  ,
  SAS.insert_date  ,
  SAS.update_date  ,
  SAS.clucd  , 
 SS.schmgtdet_id  ,
  SS.schmgtdet_desc ,
  SS.schmgt_parent ,
  SS.predefined  ,
  SS.visible_yn  ,
  SS.schmgt_udise_id ,
  SS.create_time 
  FROM shala.shala_all_school,udise.shala_schmgtdet
                where 
                 SAS.management_details =     CAST(SS.schmgtdet_id as integer) 
                AND  SAS.schcd =  '" . $schcd . "' 
                ";
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
//        else 
//              throw new NotFoundException('Could not find that Data');
    }

}

?>
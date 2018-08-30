<?php

class SelectSchoolMedium extends AppModel {

    public $useDbConfig = 'default_db_shala';
    var $name = 'SelectSchoolMedium';
    var $useTable = 'shala_medium_basic_info'; //db= teacher  schema= shala  

    public function getSchoolMedium($schcode, $option_schl_type) {

        $global_ac_year = Configure::read('global_ac_year');

        if ($option_schl_type == 01) {
            $where_codi = " AND category='1' ";
        } else if ($option_schl_type == 02) {
            $where_codi = " AND category IN ('1','2') ";
        }

        if ($option_schl_type == 01) {
            $query = "SELECT DISTINCT(medium_of_instruct) as medinstr_id ,medinstr_desc
                  FROM   shala.shala_medium_basic_info  as SMBI
                  LEFT JOIN master.shala_medinstr as SM
                   ON SMBI.medium_of_instruct = CAST(SM.medinstr_id AS INTEGER)
                  WHERE  
                  SMBI.schcd like '" . $schcode . "%'
                      AND ac_year = '$global_ac_year'
                    $where_codi  
                  ORDER BY medinstr_desc";
        } else if ($option_schl_type == 02) {
            $query = "SELECT DISTINCT(medium_of_instruct) as medinstr_id ,medinstr_desc
                  FROM   shala.shala_medium_basic_info  as SMBI
                  LEFT JOIN master.shala_medinstr as SM
                   ON SMBI.medium_of_instruct = CAST(SM.medinstr_id AS INTEGER)
                  WHERE  
                  SMBI.schcd like '" . $schcode . "%'
                      AND ac_year = '$global_ac_year'
                    $where_codi  
                  ORDER BY medinstr_desc";
        }
//        echo "****" . $query;
//        exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    
      public function getSchoolMediumDydSanstha($schcode, $option_schl_type) {
        
        $global_ac_year = Configure::read('global_ac_year');

        if ($option_schl_type == 01) {
            $where_codi = " AND category='1' ";
        } else if ($option_schl_type == 02) {
            $where_codi = " AND category IN ('1','2') ";
        }

        if ($option_schl_type == 01) {
            $query = "SELECT DISTINCT(medium_of_instruct) as medinstr_id ,medinstr_desc
                         FROM             shala.shala_medium_basic_info  as SMBI
                                LEFT JOIN master.shala_medinstr as SM ON SMBI.medium_of_instruct = CAST(SM.medinstr_id AS INTEGER)
                  WHERE  
                             SMBI.schcd like '" . $schcode . "%'
                             AND ac_year = '$global_ac_year'
                             $where_codi  
                  ORDER BY medinstr_desc";
        } else if ($option_schl_type == 02) {
            $query = "SELECT DISTINCT(medium_of_instruct) as medinstr_id ,medinstr_desc
                         FROM            shala.shala_medium_basic_info  as SMBI
                               LEFT JOIN master.shala_medinstr as SM ON SMBI.medium_of_instruct = CAST(SM.medinstr_id AS INTEGER)
                  WHERE  
                             SMBI.schcd like '" . $schcode . "%'
                             AND ac_year = '$global_ac_year'
                             $where_codi  
                  ORDER BY medinstr_desc";
        }

         
//        echo "****".$query; exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
//    public function getSchoolMediumDydSanstha($schcode, $option_schl_type) {
//        $global_ac_year = Configure::read('global_ac_year');
//
//        if ($option_schl_type == 01) {
//            $select_codi = 'elementary as medinstr_id';
//            $where_codi = " AND elementary != '0'";
//            $cast = "elementary";
//        } else if ($option_schl_type == 02) {
//            $select_codi = 'secondary as medinstr_id';
//            $where_codi = " AND secondary != '0'";
//            $cast = "secondary";
//        }
//
//        if ($option_schl_type == 01) {
//            $query = "SELECT $select_codi ,medinstr_desc
//                  FROM   shala.shala_medium_basic_infoall  as SMBI
//                  LEFT JOIN master.shala_medinstr as SM
//                   ON SMBI.$cast = SM.medinstr_id
//                  WHERE  
//                  SMBI.schcd like '" . $schcode . "%'
//                    AND ac_year = '$global_ac_year'
//                    $where_codi  
//                  ORDER BY medinstr_desc";
//        } else if ($option_schl_type == 02) {
//            $query = "SELECT DISTINCT (medinstr_id),medinstr_desc FROM 
//(
//(SELECT secondary as medinstr_id ,medinstr_desc
//                  FROM   shala.shala_medium_basic_infoall  as SMBI
//                  LEFT JOIN master.shala_medinstr as SM
//                   ON SMBI.secondary = SM.medinstr_id
//                  WHERE  
//                  SMBI.schcd like '" . $schcode . "%'
//                     AND ac_year = '$global_ac_year'
//                     AND secondary != '0'  
//                  ORDER BY medinstr_desc)
//UNION
//
//(SELECT elementary as medinstr_id ,medinstr_desc
//                  FROM   shala.shala_medium_basic_infoall  as SMBI
//                  LEFT JOIN master.shala_medinstr as SM
//                   ON SMBI.elementary = SM.medinstr_id
//                  WHERE  
//                   SMBI.schcd like '" . $schcode . "%'
//                    AND ac_year = '$global_ac_year'
//                   AND elementary != '0'
//                  ORDER BY medinstr_desc)
//                  ) as tempo";
//        }
////        echo "****".$query; exit();
//        $result = $this->query($query);
//
//        if ($result <> NULL)
//            return $result;
//        else {
//            return 0;
//        }
//    }

}

?>
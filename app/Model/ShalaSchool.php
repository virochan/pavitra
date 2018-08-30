<?php

//

class ShalaSchool extends AppModel {

    public $useDbConfig = 'default_db_shala';
    var $name = 'ShalaSchool';
    var $useTable = 'shala_all_school'; //db= teacher  schema= shala  

     public function FindSchoolName($schcd) {

        try {
            $query = "SELECT DISTINCT(schcd),school_name  FROM shala.shala_all_school where schcd='$schcd' ";
               
            $result = $this->query($query);
            if ($result != NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }
    
    
    
    //NEW START
    
      public function getDistListForSansthaVerify($sanstha_code) {
        $query = "SELECT distcd,distname 
                  FROM shala_live.shala_district
                   WHERE distcd IN
                             (SELECT DISTINCT(substr(schcd,1,4)) 
                             FROM shala.shala_all_school 
                             WHERE sanstha_code like '$sanstha_code%') 
                ";
//        echo "****".$query; exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
      //NEW END
    
    
    //OLD START
    public function getDistListForSanstha($sanstha_code) {
        $query = "SELECT distcd,distname 
                  FROM shala_live.shala_district
                   WHERE distcd IN
                             (SELECT DISTINCT(substr(schcd,1,4)) 
                             FROM shala.shala_all_school 
                             WHERE sanstha_code like '$sanstha_code%') 
                ";
//        echo "****".$query; exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
     public function getSansthaListForEOros($eo_code) {
        $dist_cd = substr($eo_code, 0, 4);
        $schl_type = substr($eo_code, 6, 8);
        if ($schl_type == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($schl_type == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }
        $query = "SELECT DISTINCT (SBI.sanstha_code) ,SBI.sanstha_name 
                   FROM shala.shala_all_school as SAS 
                   LEFT JOIN samayojan.sanstha_basic_info as SBI 
                   ON SAS.sanstha_code = SBI.sanstha_code
                   WHERE schcd LIKE '$dist_cd%' AND SAS.$schl_type_condition
                   AND   length (SBI.sanstha_code) = 11 
                   and  SBI.minority_sanstha not in ('2','3')
                  
		   ORDER BY SBI.sanstha_name  
                ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
     public function getDistListForSansthaEo($sanstha_code,$eo_code) {
         
          $dist_cd = substr($eo_code, 0, 4);
        $schl_type = substr($eo_code, 6, 8);
        if ($schl_type == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($schl_type == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }
        
        $query = "SELECT DISTINCT distcd,distname 
                  FROM shala_live.shala_district
                   WHERE distcd IN
                             (SELECT DISTINCT(substr(schcd,1,4)) 
                             FROM shala.shala_all_school as SAS 
                             WHERE sanstha_code like '$sanstha_code%'
                                 AND SAS.$schl_type_condition
                                 AND SAS.schcd like '$dist_cd%') 
                ";
//        echo "****".$query; exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSansthaListForEO($eo_code) {
        $dist_cd = substr($eo_code, 0, 4);
        $schl_type = substr($eo_code, 6, 8);
        
        $minority_type_cond = SessionComponent::read('minority_type_cond');
//          echo  "-*-----".$minority_type_cond;
//       exit();
        
        if ($schl_type == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($schl_type == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }
        $query = "SELECT DISTINCT (SBI.sanstha_code) ,SBI.sanstha_name 
                   FROM shala.shala_all_school as SAS 
                   LEFT JOIN samayojan.sanstha_basic_info as SBI 
                   ON SAS.sanstha_code = SBI.sanstha_code
                   WHERE schcd LIKE '$dist_cd%' 
                       AND SAS.$schl_type_condition 
                       AND   length (trim(SBI.sanstha_code)) = 11
                       AND SBI.minority_sanstha IN  $minority_type_cond
                       ORDER BY SBI.sanstha_name 
                ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
      public function getSansthaListForDyd($dist_cd,$option_schl_type) {
//        $dist_cd = substr($dyd_code, 0, 4);
//        $schl_type = 01;
        $minority_type_cond = SessionComponent::read('minority_type_cond');
        if ($option_schl_type == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($option_schl_type == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }
        $query = "SELECT DISTINCT (SBI.sanstha_code) ,SBI.sanstha_name 
                   FROM shala.shala_all_school as SAS 
                   LEFT JOIN samayojan.sanstha_basic_info as SBI 
		   ON SAS.sanstha_code = SBI.sanstha_code
		    WHERE schcd LIKE '$dist_cd%'
		     AND SAS.$schl_type_condition 
                       AND   length (trim(SBI.sanstha_code)) = 11
                       AND SBI.minority_sanstha IN  $minority_type_cond
                       ORDER BY SBI.sanstha_name 
                ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
     public function getDistListForSansthaEoDyd($sanstha_code,$eo_code) {
         
          $dist_cd = substr($eo_code, 0, 4);
        $schl_type = substr($eo_code, 6, 8);
        if ($schl_type == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($schl_type == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }
        
        $query = "SELECT DISTINCT distcd,distname 
                  FROM shala_live.shala_district
                   WHERE distcd IN
                             (SELECT DISTINCT(substr(schcd,1,4)) 
                             FROM shala.shala_all_school as SAS 
                             WHERE sanstha_code like '$sanstha_code%'
                                 AND SAS.$schl_type_condition
                                 AND SAS.schcd like '$dist_cd%') 
                ";
//        echo "****".$query; exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
        public function getDistListForSansthaDydSanstha($sanstha_code) {
        $query = "SELECT distcd,distname 
                  FROM shala_live.shala_district
                   WHERE distcd IN
                             (SELECT DISTINCT(substr(schcd,1,4)) 
                             FROM shala.shala_all_school 
                             WHERE sanstha_code like '$sanstha_code%') 
                ";
//        echo "****".$query; exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
    
   

}

?>
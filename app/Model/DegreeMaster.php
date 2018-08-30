<?php

class DegreeMaster extends AppModel {
        public $useDbConfig = 'use_db_Tech_master';
         var  $name= "DegreeMaster";
         var $useTable = 'degree_mast'; //db=Teacher schema=master
         
         public function savedata($degcd,$degtext,$qtyp,$qlvl){
             $qry="INSERT INTO master.degree_mast(
                    deg_cd, deg_text, deg_qual_type, deg_qual_level)
            VALUES (".$degcd.",'".$degtext."','".$qtyp."',".$qlvl.")";
             $res=$this->query($qry);
             if($res<>null){
                 return 1;
             }else{
                 return 0;
             }
             
         }
        
          public function selectlevel($qt){
             $qry="SELECT deg_cd, deg_text, deg_qual_type, deg_qual_level,tchaqual_desc
                    FROM master.degree_mast, master.shala_tchaqual
                  where deg_qual_type = '$qt' 
                  and deg_qual_level = tchaqual_id order by deg_qual_level";
//             echo $qry;
//             die;
             $res=$this->query($qry);
             if($res<>null){
                 return $res;
             }else{
                 return 0;
             }
             
         }
         public function updtdata($degcd,$degname,$qlvl){
//            $qry=" UPDATE master.degree_mast,master.shala_tchaqual
//                   SET deg_text='".$degname."'
//                   WHERE deg_cd='".$degcd."' AND deg_qual_level = '".$qlvl."' ";
             
             $qry ="UPDATE master.degree_mast
                SET  deg_text='".$degname."', deg_qual_level='".$qlvl."'
                WHERE deg_cd='".$degcd."'";
            
             $res=$this->query($qry);
             if($res<>null){
                 return 1;
             }else{
                 return 0;
             }
         }
          public function deletecd($degcd){
//        echo $bcode;echo $bname;echo $board;echo $st;
//        exit;
                $query="DELETE FROM master.degree_mast WHERE deg_cd=".$degcd;
                $res=$this->query($query);
                if ($res <> NULL) {
                            return 1;
                } else {
                            return 0;
                }
          }
          
      public function getqualdegs($qualtyp){
     $qry="select deg_cd,deg_text
           FROM master.degree_mast
           Where deg_qual_type = '".$qualtyp."'
           order by deg_qual_level";
   
            $res=$this->query($qry);
            if($res <> NULL){
                return $res;
            }else{
                return 0;
            }
      
    }
    

}


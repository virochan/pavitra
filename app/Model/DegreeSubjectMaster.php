<?php

class DegreeSubjectMaster extends AppModel {
    public $useDbConfig = 'use_db_Tech_master';
         var  $name= "DegreeSubjectMaster";
         var $useTable = 'degree_sub_mast';  //db=Teacher schema=master
         
   public function selectdegree($qdeg){
   $qry="SELECT deg_cd, deg_sub_cd, deg_subject,udise_cd,tchsubtaught_desc,tchsubtaught_id
        FROM master.degree_sub_mast,udise_data.shala_tchsub_taught 
        where deg_cd = '".$qdeg."'
        and udise_cd= tchsubtaught_id   
	order by deg_sub_cd";
   
            $res=$this->query($qry);
            if($res <> NULL){
                return $res;
            }else{
                return 0;
            }
//       
    }
    
     public function maximum($qdeg,$qt){
             $qry="SELECT max(deg_sub_cd)
                    FROM master.degree_sub_mast
                  where deg_cd='".$qdeg."'and deg_qual_type = '".$qt."'" ;
//                 echo $qry;
//                 exit;
                               $res=$this->query($qry);
                               if($res<>null){
                                   return $res;
                               }else{
                                   return 0;
                               }
             
         }  
         
         public function savedata($qdeg,$sub_cd,$sub_text,$qtyp,$ud_cd){
             $qry="INSERT INTO master.degree_sub_mast(
                    deg_cd,deg_sub_cd, deg_subject,deg_qual_type,udise_cd)
            VALUES (".$qdeg.",".$sub_cd.",'".$sub_text."','".$qtyp."',".$ud_cd.")";
             $res=$this->query($qry);
             if($res<>null){
                 return 1;
             }else{
                 return 0;
             }
             
         }
         
         public function updtdata($sub_cd,$sub_text,$ud_cd){
            $qry=" UPDATE master.degree_sub_mast
                   SET deg_subject='".$sub_text."',udise_cd='".$ud_cd."'
                   WHERE deg_sub_cd='".$sub_cd."'";
            
             $res=$this->query($qry);
             if($res<>null){
                 return 1;
             }else{
                 return 0;
             }
         }
}
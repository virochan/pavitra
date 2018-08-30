<?php
class SelectTchrMastPost extends AppModel {
    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectTchrMastPost";
    var $useTable = 'tchr_post_master'; //db=Teacher schema=master
    
    
    public function findposts($res){
            $cnt=count($res);
            $postsarr=array();
            
             for($i=0;$i<$cnt;$i++){
                if(isset($res[$i][0]['tchr_curr_desg_cd'])){
                    $qry="select * from master.tchr_post_master where post_type='".$res[$i][0]['tchr_type']."' and post_id='".$res[$i][0]['tchr_curr_desg_cd']."'";
                    $posts=$this->query($qry);
                   
                    array_push($postsarr,$posts[0][0]['post_desc']);
                }else{
                 array_push($postsarr,'--');
                }
           }
           return $postsarr;
     }
     
     public function findpostsmapunmap($res){
            $cnt=count($res);
            $postsarr=array();
            
             for($i=0;$i<$cnt;$i++){
                if(isset($res[$i]['SelectTeacherMaster']['tchr_curr_desg_cd'])){
                    $qry="select * from master.tchr_post_master where post_type='".$res[$i]['SelectTeacherMaster']['tchr_type']."' and post_id='".$res[$i]['SelectTeacherMaster']['tchr_curr_desg_cd']."'";
                    $posts=$this->query($qry);
                   
                    array_push($postsarr,$posts[0][0]['post_desc']);
                }else{
                 array_push($postsarr,'-');
                }
           }
           return $postsarr;
     }
}
?>
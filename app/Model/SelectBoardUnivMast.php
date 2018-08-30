<?php

class SelectBoardUnivMast extends AppModel {

   public $useDbConfig = 'use_db_Tech_master';
   var $name = "SelectBoardUnivMast";
   var $useTable = 'board_univ_mast'; //db=Teacher schema=master

    public function findboarddetails($st,$board){
            $query="SELECT bu_code, bu_name, bu_type,state_cd,state_name
                    FROM master.board_univ_mast,master.state_census_2011
                    where state_cd='".$st."'
                    and bu_type='".$board."'
                    and state_cd=state_code::numeric
                    order by bu_code";
            $res=$this->query($query);
            if ($res <> NULL) {
                    return $res;
            } else {
                    return 0;
            }
    }
    
    public function savedata($st,$board,$bcode,$bname){
//        echo $bcode;echo $bname;echo $board;echo $st;
//        exit;
        $query="insert into master.board_univ_mast values(".$bcode.",'".$bname."','".$board."',".$st.")";
        $res=$this->query($query);
        if ($res <> NULL) {
                    return 1;
        } else {
                    return 0;
        }
    }
    public function updtdata($st,$board,$bucode,$bname){
//        echo $bcode;echo $bname;echo $board;echo $st;
//        exit;
        $query="UPDATE master.board_univ_mast
                SET bu_name='".$bname."', bu_type='".$board."', state_cd=".$st."
                WHERE bu_code=".$bucode;
        $res=$this->query($query);
        if ($res <> NULL) {
                    return 1;
        } else {
                    return 0;
        }
    }
    public function deletecd($bucode){
//        echo $bcode;echo $bname;echo $board;echo $st;
//        exit;
        $query="DELETE FROM master.board_univ_mast WHERE bu_code=".$bucode;
        $res=$this->query($query);
        if ($res <> NULL) {
                    return 1;
        } else {
                    return 0;
        }
    }
    
    public function findmax(){
        $query="SELECT max(bu_code)
                FROM master.board_univ_mast";
        
        $res=$this->query($query);
        if ($res <> NULL) {
                    return $res;
        } else {
                    return 0;
        }
    }

}
?>
<?php

class ShalaBlock extends AppModel {

    public $useDbConfig = 'default';
    var $name = "ShalaBlock";
    var $useTable = 'shala_block';  //db=shala_live schema=master

    public function getbeoname($inClaucdStr) {
        $query = "select DISTINCT ON(blkname) blkcd,blkname from shala_live.shala_block where blkcd IN " . $inClaucdStr;
//        echo "".$query;exit();
        $clunamew = $this->query($query);
        if ($clunamew <> NULL)
            return $clunamew;
        else {
            return 0;
        }
    }

    public function getblocknames($eoCd, $inClausStr) {
        $query = "select  shala_block.blkcd,shala_block.blkname
                   from  shala.shala_block
                    where  shala_block.blkcd IN" . $inClausStr;

//        $query = "select shala_block.blkcd,shala_all_school.schcd from shala.shala_block,shala.shala_all_school where shala_block.blkcd LIKE '$eoCd%' AND shala_all_school.schcd IN " . $inClausStr;
//        echo "" . $query;
//        exit();
        $cluswcd = $this->query($query);
        if ($cluswcd <> NULL)
            return $cluswcd;
        else {
            return 0;
        }
    }

    public function getblocknamesSession($user_id) {
        $query = "select  blkcd,blkname FROM shala.shala_block WHERE  blkcd = '" . $user_id . "'";

        $BlockName = $this->query($query);
        if ($BlockName <> NULL)
            return $BlockName;
        else {
            return 0;
        }
    }

}

?>
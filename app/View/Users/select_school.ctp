<?php
//echo "role=".$user_role;exit();
if ($user_role == 'login_roles6') {
    $i = 1;
    //echo "<pre>".print_r($schools , true)."</pre>";
    foreach ($schools as $school):
        ?>
        <div class="schoolinfo" id="<?php echo $school['ShalaSchool']['schcd']; ?>"
             onclick="javascript:disply_record(this.id);" ><?PHP echo $i . " . ( " . $school['ShalaSchool']['schcd'] . " ) " . $school['ShalaSchool']['school_name']; ?>
        </div>
        <?php
        $i++;
    endforeach;
}

if ($user_role == 'login_roles5') {
//    echo "<pre>".print_r($cluster_list , true)."</pre>";exit();
    $i = 1;
        foreach ($cluster_list as $cluster_list):
        ?>
        <div class="schoolinfo" id="<?php echo $cluster_list['ShalaCluster']['clucd']; ?>">
            <?PHP echo $i . " . ( " . $cluster_list['ShalaCluster']['clucd'] . " ) " . $cluster_list['ShalaCluster']['cluname']; ?>
        </div>
        <?php
        $i++;
    endforeach;
}

if ($user_role == 'login_roles4') {
//    echo "<pre>".print_r($block_list , true)."</pre>";exit();
    $i = 1;
        foreach ($block_list as $block_list):
        ?>
        <div class="schoolinfo" id="<?php echo $block_list['Block']['blkcd']; ?>">
            <?PHP echo $i . " . ( " . $block_list['Block']['blkcd'] . " ) " . $block_list['Block']['blkname']; ?>
        </div>
        <?php
        $i++;
    endforeach;
}





 
?>


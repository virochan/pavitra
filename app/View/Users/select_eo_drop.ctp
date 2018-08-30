<?php
//echo $this->Form->input('eo_drop_id', array('options' => $district_list, 'empty' => '-- Select Eo Level --',
//                                    'id'=>'dist_id','label' => 'District &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: ',
//                                    'class'=>'selectbox')); 

echo $this->Form->input('eo_drop_id', array('options' => array('EO Primary', 'EO Secondary','EO Higher Secondary'),'empty' => '-- Select EO Level --','label' => 'Level &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;:', 'class'=>'selectbox'));
?>

<!--<select name="eo_drop_id" id="eo_drop_id">
    <option value="">-- Select Eo Level --</option>
    <option value="1">EO Primary</option>
    <option value="2">EO Secondary</option>
</select>-->

<?php


?>
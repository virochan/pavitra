
<?php

//PR($shalaudisetchtype);
echo $this->Form->input('shalaudisetchtype', array('options' => $shalaudisetchtype, 'label' => false, 'empty' => 'Select Post', 'id' => 'shalaudisetchtypecombo'));
for ($i = 0; $i < count($sanstha_data); $i++) {
    echo $sanstha_data[$i][0]['post_desc'] . "=" . $sanstha_data[$i][0]['eos_no_of_post'];
}
?>
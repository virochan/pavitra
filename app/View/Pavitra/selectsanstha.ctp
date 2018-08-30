<?php

if (!empty($sanstha_list)) {
    echo $this->Form->input('sanstha_code', array('options' => $sanstha_list, 'empty' => '-- Select Sanstha --',
        'id' => 'sanstha_code', 'label' => 'Select Sanstha &nbsp; &nbsp;:&nbsp; &nbsp;', 'style' => 'width:67%;',
        'class' => 'selectbox'));
}
?>
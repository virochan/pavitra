<?php
if (!empty($schools)) {
    echo $this->Form->input('sch_cd', array('options' => $schools, 'empty' => '-- Select School --',
        'id' => 'sch_cd', 'label' => 'Select School', 'style' => 'width:40%;',
        'class' => 'selectbox'));
}
?>
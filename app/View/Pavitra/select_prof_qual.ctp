<?php

if (isset($all_prof_qual_lvl)) {
    echo $this->Form->input('prof_qual', array('options' => $all_prof_qual_lvl, 'label' => false, 'empty' => '-- Select Prof. Qual--', 'style' => 'width:80% !important', 'id' => 'prof_qual'));
}
?>

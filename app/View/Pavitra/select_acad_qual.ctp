<?php

if (isset($all_acad_qual)) {
    echo $this->Form->input('acad_qual', array('options' => $all_acad_qual, 'label' => false, 'empty' => '-- Select Academic Qual--', 'style' => 'width:80% !important', 'id' => 'acad_qual'));
}
?>

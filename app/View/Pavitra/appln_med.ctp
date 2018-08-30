<?php

if (isset($all_med_list)) {
    echo $this->Form->input('apln_med', array('options' => $all_med_list, 'label' => false, 'empty' => '-- Select Medium--', 'style' => 'width:80% !important', 'id' => 'apln_med'));
}
?>

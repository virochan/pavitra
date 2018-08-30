<?php

if (isset($all_desg_opt)) {
    echo $this->Form->input('apln_desg', array('options' => $all_desg_opt, 'label' => false, 'empty' => '-- Select Designation--', 'style' => 'width:80% !important', 'id' => 'apln_desg'));
}
?>

<?php

if (isset($all_subj_opt)) {
    echo $this->Form->input('apln_subj', array('options' => $all_subj_opt, 'label' => false, 'empty' => '-- Select Subject--', 'style' => 'width:80% !important', 'id' => 'apln_subj'));
}
?>

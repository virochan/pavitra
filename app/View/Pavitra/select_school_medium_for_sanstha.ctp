<?php

if (isset($FindedSchoolMedium)) {
    echo $this->Form->input('school_medium_code', array('options' => $FindedSchoolMedium, 'label' => false, 'empty' => '-- Select Medium--', 'style' => 'width:80% !important', 'id' => 'school_medium_code'));
}
?>

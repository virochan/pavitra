<?php
 if (!empty($desig_list)){
        echo $this->Form->input('desig_cd', array('options' => $desig_list, 'empty' => '-- Select Designation --',
            'id' => 'desig_cd', 'label' => 'Select Designation &nbsp;&nbsp;:&nbsp;&nbsp;', 'style' => 'width:50%;',
            'class' => 'selectbox'));
 }
        
        ?>
<?php
if (!empty($med_list)) {
                    echo $this->Form->input('med_cd', array('options' => $med_list, 'empty' => '-- Select Medium --',
                        'id' => 'med_cd', 'label' => 'Select Medium &nbsp; &nbsp;:&nbsp; &nbsp;', 'style' => 'width:40%;',
                        'class' => 'selectbox'));
                } 
        ?>
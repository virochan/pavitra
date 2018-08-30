
<?php
if(count($all_sub_list)=='1'){

    echo $this->Form->input('adv_subj_cd', array('options' => $all_sub_list, 'label' => false,  'style' => 'width:80% !important', 'id' => 'adv_subj_cd'));
}
else{
    echo $this->Form->input('adv_subj_cd', array('options' => $all_sub_list, 'label' => false, 'empty' => '-- Select Subject--', 'style' => 'width:80% !important', 'id' => 'adv_subj_cd'));
}
?>
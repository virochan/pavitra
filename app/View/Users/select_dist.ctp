<?php 

//print_r($district_list);
echo $this->Form->input('dist_id', array('options' => $district_list, 'empty' => '-- Select Districttt --',
                                    'id'=>'dist_id','label' => 'District &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: ',
                                    'class'=>'selectbox')); 
 ?>
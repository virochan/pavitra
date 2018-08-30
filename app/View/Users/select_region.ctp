<?php 

//print_r($district_list);
echo $this->Form->input('region_id', array('options' => $region, 'empty' => '-- Select Region --',
                                    'id'=>'region_id','label' => 'Region &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;: ',
                                    'class'=>'selectbox')); 
 ?>
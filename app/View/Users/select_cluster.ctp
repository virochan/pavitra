<?php 
echo $this->Form->input('Cluster', array('options' => $cluster_list, 'empty' => '-- Select Cluster--',
                                    'id'=>'cluster_id','label' => 'Cluster &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; :', 
                                    'style' => 'margin-left:5px','class'=>'selectbox')); 
 ?>

<?php 
if(!empty($allbordunitys)){
    
echo $this->Form->input('acad_qualificationTechrBoard', array('options' =>$allbordunitys,'style'=>'width:465px;', 'label' => false, 'empty' => '-- Select University --'));

}else{
    
  echo $this->Form->input('acad_qualificationTechrBoard', array('options' => array('23' => 'Not Available'),'style'=>'width:465px;', 'label' => false, 'empty' => '-- Select University --'));
  
}
?>  

 <?php
if (isset($FindedSchoolName)) {
    ?>
    <table width="100%" height="35px">
        <tr>
            <td  width="30%" style="text-align: right;"> 
                <?php echo __('Select School'); ?>  <span style="float:right">&nbsp;:&nbsp;</span>
            </td>
            <td width="50%">  
                <?php
                echo $this->Form->input('school_code', array('options' => $FindedSchoolName, 'label' => false, 'empty' => '-- Select School--',
                    'id' => 'school_code', 'style' => 'width:500px;'));
                ?>         
            </td>
        </tr>
    </table> 
    <?php
}
?>

<table class="table b_table" width="100%" id="eoroster">
    <tr id="sanstha">
        <td class="col-xs-2" colspan="2" align="center">Select Sanstha <span style="float:right;font-weight:bold">:</span> </td>
        <td class="col-xs-6" colspan="6"> 
            <?php
            echo $this->Form->input('sanstha', array('options' => $sanstha_array, 'id' => 'sanstha', 'label' => false, 'empty' => '-- Select Sanstha--', 'style' => 'width:100%; float: left;'));
            ?>    
        </td>
        <td class="col-xs-4" colspan="4"></td>
    </tr>
</table>
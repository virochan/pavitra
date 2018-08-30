<?php
 ini_set('memory_limit',-1);
    echo $this->fetch('script');
    echo $this->Html->script('jquery.js');
    echo $this->Html->script('jquery.dataTables.js');
    echo $this->fetch('css');
    echo $this->Html->css('jquery.dataTables.css');
?>


<script>
    $(document).ready(function () {

        $("input[type='submit']").click(function () {
            var selection = $('#selection').val();
            selection = selection.toLowerCase();
            var str = selection.trim();
            var schema_id = $('#schema_id').val();


            if (str != '')
            {

                if (schema_id == 'none')
                {
                    alert('Please Select Schema');
                    return false;
                }




            } else {
                alert('Please Enter Valid Query');
                return false;
            }

        });

    });

</script>
<style>
.table-details td
{
	padding:0.5%;
	border: solid 1px rgb(225, 225, 225);
}
</style>
<br>
<?php //echo $this->Form->create('query_result', array('url' => array('controller' => 'Techs', 'action' => 'query_result'))); ?>

<table class="table-details" border="1" width="95%" align="center" style="width:96%; margin: 0 auto !important;border-collapse:collapse;">
    <tr>
        <td width="10%">Database</td>
        <td>     
            <select id="database_id" name="database_name" style="padding:5px;height: 30px;">
                <option value="StudentDatabase">Teacher </option>
            </select>
<?php echo $this->Html->link(__('Logout'), array("controller" => 'users', "action" => "logout")); ?>
        </td>        
    </tr>
    <tr>
        <td>Schema</td>      
        <td>
            <select id="schema_id" name="schema_name" style="padding:5px;height: 30px;">
                <option value="none">--Select Schema--</option>
                <?php 
                    $comboString = '';             
                    foreach ($schema as $comboData):
                        foreach ($comboData as $item):
                        $comboString .='<option value="' . trim($item['schema_name']) . '">' . trim($item['schema_name']) . '</option>';
                        endforeach;
                    endforeach;
                    echo $comboString;
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="4" height="25px">Query</td>       
    </tr>
    <tr>
        <td colspan="4">
             <?php echo $this->Form->input('query_selection', array('type' => 'textarea','id'=>'selection','rows'=>'7','cols'=>'110','label' => false)); ?>
        </td>          
    </tr>

</table>

<br>
<table  width="50%" style="margin:0% auto;">
    <tr>
        <td id="submit" colspan="4" align="center"> <?php echo $this->Form->submit('Execute Query',array('id'=>'execute')); ?></td>          
    </tr>
</table>
<div id="Qresult123">
    
</div>
<?php // echo $this->Form->end(); ?>

<script>
                

        $("#execute").click(function () {
            var query = $("#selection").val();
            
            jQuery.post('query_result', {query: query}, function (data) {
              
                $('#Qresult123').html(data);
               
            });
           
        });

</script>
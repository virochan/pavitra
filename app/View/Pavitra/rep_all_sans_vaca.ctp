<?php
//echo "---------" . $get_sanstha_minority_type;
echo $this->Html->script('jquery-1.7.2');
echo $this->Html->script('jquery.ui.datepicker');
echo $this->Html->script('common');
echo $this->Html->script('teaching_nonteaching_form');
//echo $this->Html->css('styles');
echo $this->Html->css('style_pavitra');
echo $this->Html->css('style_menu_ch_beo_pavitra');
echo $this->Html->css('bootstrap.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.form.min');
echo $this->Html->script('https://www.google.com/jsapi'); //**********************https://www.google.com/jsapi
echo $this->Html->script('map_and_language');
echo $this->Html->script('validations');
echo $this->Html->css('jquery.ui.all');
echo $this->Html->script('jquery.ui.core');
echo $this->Html->script('jquery.ui.widget');
echo $this->Html->script('calendar_common');
echo $this->Html->script('castevalidation');
echo $this->Html->script('teaching_nonteaching_form');
echo $this->Html->script('calendar_common');
echo $this->Session->flash();
?>
<style>
    .input.text > input{width:154px;}
    th{min-height:61px !important;}
    select{width:100% !important;}
/*    legend{width:16% !important}*/
    .subformhead{border: 1px solid #8492dd;
                 padding: 2px 10px;
                 border-radius: 7px;
                 box-shadow: 0 0 15px #a3b5de inset;}

     .legend_title{width:15%;}
    
</style>

<script>
    $(document).ready(function () {
       
        
        $("#view_vaca").click(function () {
            var flag=1;
            
            var sans_cd=$('#sans_cd').val();
                if(sans_cd==''){
                    alert('Please Select Sanstha');
                    return false;
                }

        });

    });
</script>

<div>
    <?php echo $this->Form->create('rep_all_sans_vaca', array('url' => array('controller' => 'Pavitras', 'action' => 'PvAllSansthaVacaPdf'),'target' => '_blank' , 'enctype' => 'multipart/form-data')); ?>
    <table class="table b_table" style="border-collapse:collapse;width:100%;margin-bottom:0px;">
        
        <tr>
            <td class="col-xs-9" colspan="9"> </td>
            
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="view_vaca"  type="submit" name="submit"  value="<?php echo __('View'); ?>" /></td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="cancel_tch_personal" type="button" value="<?php echo __('Cancel'); ?>" /></td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="caste_hm_exit" type="button" value="<?php echo __('Exit'); ?>"/></td>

        </tr>
   
     
    </table>

    <?php echo $this->Form->end(); ?>
</div>




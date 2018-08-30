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
    select{width: 238px !important;}
/*    legend{width:16% !important}*/
    .subformhead{border: 1px solid #8492dd;
                 padding: 2px 10px;
                 border-radius: 7px;
                 box-shadow: 0 0 15px #a3b5de inset;}

     .legend_title{width:15%;}
    
</style>

<div id="content">
    <?php echo $this->Form->create('forward_adv', array('url' => array('controller' => 'Pavitras', 'action' => 'advertise_fwd'), 'enctype' => 'multipart/form-data')); ?>
    <table class="table note">
        <tr>
            <td style="padding:2px 12px">
                <span class="notehead"><?php echo __('Note :'); ?></span> 
            </td>
        </tr>
    </table>
   
    <div style="height:505px;width:100%;clear:both;">
        <div class="form_content" align="center">
            <div class="map_head" style="height:auto">
                <h3> Forward Advertisement Data </h3>
                <div class="table-responsive"> 
                    <table class="table b_table" style="border-collapse:collapse;width:100%;margin-bottom:0px;">

                        <tr>
                            <td class="col-xs-3" colspan="3">Advertisement for Education level <span style="float:right;font-weight:bold">:</span></td>
                            <td class="col-xs-6" colspan="6">
                                <div style="float:left;">
                                    <input type="radio" name="edu_level" id="tchr_type1" value="1" >
                                    <label id="1">Primary</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="edu_level" id="tchr_type2" value="2">
                                    <label id="2">Secondary / Higher Secondary</label>
                                </div>
                            </td>
                            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="fwd_advertise"  type="submit" name="submit"  value="<?php echo __('Forward'); ?>" /></td>
                            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="cancel_tch_personal" type="button" value="<?php echo __('Cancel'); ?>" /></td>
                            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="caste_hm_exit" type="button" value="<?php echo __('Exit'); ?>"/></td>

                        </tr>

                    </table>
                </div>
            </div>
          
            <div id='list' style="float:left">
            </div>
      
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#adv_fwd_detail').hide();
  
        var todays_date = new Date();

        $("#caste_hm_exit").click(function () {
            var url = 'sanstha';
            $(location).attr('href', url);
        });


        $("input[name=edu_level]").on("change", function () {
            $('#adv_fwd_detail').show();
            $('#desg_cd').val('');
            var ac = $('input:radio[name=edu_level]:checked').val();
  
            jQuery.post('DispFwdAdv', {ac: ac}, function(data) {
//            alert(data);
            $('#list').html(data);
        });

        });
        

        
//        save_advertise
        $("#fwd_advertise").click(function () {
            var flag=1;
            var x = document.getElementById("tchr_type1").checked;
            var y = document.getElementById("tchr_type2").checked;
            if ((x == false) && (y == false)) {
                alert('Please Select Education Level');
                return false;
            }
            var edu_level = $('input:radio[name=edu_level]:checked').val();
        });
        
      
        
        
        
    });

</script>
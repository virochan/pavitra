<style>
    .td_grid, .th_grid {
        padding:4px !important;
        border: 1px solid #A5BFDE !important;
        text-align: center;
    }

    #eoroster
    {
        border-collapse:collapse;

    }
    #eoroster td
    {
        padding:0.3%;
    }
    .overlay_srch {
        background: rgba(0, 0, 0, 0.69) none repeat scroll 0 0;
        height: 100%;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        display:none;
    }

    .overlay_srch > div#overlay_srch {
        background:rgba(237, 240, 240,0.9);
        border:solid 1px white;
        border-radius: 6px;
        left: 30%;
        padding: 1% 2%;
        position: absolute;
        top: 21%;
        width:45%;
        height:400px;
    }
    #img
    {
        width: 36%;
        height: auto;
        margin-top: 10%;
        margin-left: 32%;
    }
    #exit_search
    {
        cursor: pointer;
        position: absolute;
        top: 130px;
        right: 24%;
    }
    img#close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }
    .total_col{cursor:pointer;background: #5F7CB7;border-top: 3px solid #215799;border-bottom: 2px solid #215799;}
    h3{margin-bottom: 0px;}
    .table{margin-bottom:0px;}
    label{font-weight:500 !important}
    .b_table tr td{border-top:none !important;}
</style>

	          
<?php echo $this->Form->create('advertise_aprv', array('url' => array('controller' => 'Pavitras', 'action' => 'advertise_aprv'))); ?>

<input type="hidden" name="sess_val" value="<?php echo $user_id; ?>" id="sess_val"/> 
<?php echo $this->Form->input('asst_flag', array('type' => 'hidden', 'value' => '')); ?>
<?php
if (!empty($roster_edn_level)) {
    echo $this->Form->input('edu_lvl', array('type' => 'hidden', 'value' => $roster_edn_level, 'id' => 'edu_lvl'));
}
?>

<div style="height:595px;width:100%;padding:5px;clear:both;">
    <div class="form_content" align="center">
        <div class="map_head" style="min-height:115px;height:auto">
            <h3> Approve Advertisement For Sanstha</h3>
            <table class="table b_table" width="100%" id="eoroster">
                <tr>
                    <td class="col-xs-2" colspan="2" align="center">Select Sanstha <span style="float:right;font-weight:bold">:</span> </td>
                    <td class="col-xs-8" colspan="8"> 
                        <?php
                        echo $this->Form->input('sanstha', array('options' => $array_sanstha, 'id' => 'sanstha', 'label' => false, 'empty' => '-- Select Sanstha--', 'style' => 'width:100%; float: left;'));
                        ?>    
                    </td>
                    <td class="col-xs-2" colspan="2"></td>
                    
                </tr>
                <tr>
                    <td class="col-xs-2" colspan="2" align="center">Education Level <span style="float:right;font-weight:bold">:</span></td>
                    <td class="col-xs-4" colspan="4">
                        
                            <input type="radio" name="edu_level" id="tchr_type1" value="1" >
                            <label id="1">Primary</label>
                      
                            <input type="radio" name="edu_level" id="tchr_type2" value="2">
                            <label id="2">Secondary / Higher Secondary</label>
                       
                    </td>
                    <td class="col-xs-2" colspan="2">Select Staff  <span style="float:right;font-weight:bold">:</span></td>
                    <td class="col-xs-2" colspan="2">
                        <?php
                        $options = array('3' => 'Teaching');
                        echo $this->Form->input('staff_group', array('options' => $options, 'id' => 'staff_group', 'label' => false, 'empty' => '-- Select Staff--', 'style' => 'width:100%; float: left;'));
                        ?>   
                    </td>
                    <td class="col-xs-2" colspan="2"></td>
                </tr>
                <tr>
                    <td class="col-xs-2" colspan="2" align="center"> Select Staff Type <span style="float:right;font-weight:bold">:</span></td>
                    <td class="col-xs-4" colspan="4"> <input type="radio" name="staff_type" id="tchr_type" value="1" checked>
                        <label id="1">Teaching Staff</label></td>
                   <td class="col-xs-4" colspan="4">
                    <td class="col-xs-1"> 
                        <input  type="submit" name="submit" id="roster_submit" value="Save" class="btn btn-sm logbutton2"></td>
                      <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm logbutton2">
                       
                    </td>

                </tr>

            </table> 

        </div>
        <div style="margin-top:8px !important; width:100%;height:30px;">
  
            <div style="float:right;width:20%;">
                <table width="82%" border="0" style="border-collapse:collapse;margin-left:0%;">

                    <tr>
                        <td width="8%">
                            <span class="clus_btn">
                                Reject &nbsp;<input type="checkbox"  id="selectrjct" value="R" name="select"/>
                            </span>
                        </td>

                        <td width="8%">
                            <span class="clus_btn">
                                Approve &nbsp;<input type="checkbox"  id="selectvfy" value="A" name="select"/> 
                            </span>
                        </td>
                    </tr>
                </table>
            </div>      			 	 
        </div>

        <div id='list' style="float:left">
        </div>

</div>


<?php echo $this->Form->end(); ?>
<script>
    $(document).ready(function () {

        var edu_lvl = $('#edu_lvl').val();
        if (edu_lvl == 'P') {
            $('#tchr_type2').attr('disabled', true);

        }
        else {
            $('#tchr_type1').attr('disabled', true);
        }
        $('input:radio[id=tchr_type][value=2]').attr('disabled', true);
        $("#caste_teaching").click(function () {
            $('input:radio[id=tchr_type][value=1]').prop('checked', true);
        });
   
        var numpattern = /^[0-9]*$/;
        var sess_val = $('#user_id').val();
        $("#caste_hm_exit").click(function () {
            var url = 'eduofficer';
            $(location).attr('href', url);
        });
        $("#staff_group").change(function () {
            var ac = $('input:radio[name=edu_level]:checked').val();
            var sanstha_code = $('#sanstha').val();
            
            jQuery.post('DispAppAdv', {ac: ac,sanstha_code:sanstha_code}, function(data) {
//            alert(data);
            $('#list').html(data);
        });
            
        });
 
        $("#selectvfy").change(function () {
            var flag = $('#selectvfy').val();
            if ($(this).is(":checked")) {
                $('#pv_rost_verfAsstFlag').val(flag);
                $('#selectrjct').prop('disabled', 'disabled');
            } else {
                $('#pv_rost_verfAsstFlag').val('');
                $('#selectrjct').prop('disabled', false);
            }
        });
        $("#selectrjct").change(function () {
            var flag = $('#selectrjct').val();
            if ($(this).is(":checked")) {
                $('#pv_rost_verfAsstFlag').val(flag);
                $('#selectvfy').prop('disabled', 'disabled');
                $('#remarkid').hide();
                $('#resonid').show();
            } else {
                $('#pv_rost_verfAsstFlag').val('');
                $('#selectvfy').prop('disabled', false);
                $('#remarkid').show();
                $('#resonid').hide();
            }
        });
    });
</script>
<?php
echo $this->Html->script('jquery-1.7.2');
echo $this->Html->script('jquery.ui.datepicker');
echo $this->Html->css('jquery.ui.all');
echo $this->Html->script('jquery.ui.core');
echo $this->Html->css('bootstrap.min');
echo $this->Html->script('bootstrap.min');
?>

<style>
    .table{margin-bottom: 0px}
    .table_extract{margin-bottom: 10px;}    
</style>

<script>
    $(document).ready(function () {
        $("#roster_cancel").click(function () {
            location.reload();
        });

        $("#caste_hm_exit").click(function () {
            var url = 'sanstha';
            $(location).attr('href', url);
        });

        $("input[name=edu_level]").on("change", function () {
            var ac = $('input:radio[name=edu_level]:checked').val();
            if(ac=='1'){
                var lvl='Primary';
            }
            else{
                var lvl='Secondary';
            }
            jQuery.post('ChkVcntCnt', {ac: ac}, function (data) {
                if (data.trim() != '') {
                    alert("Data has been extracted once.");
                    $("input").prop('disabled', true);
                    $("#roster_cancel").prop('disabled', false);
                }
                
            });
            jQuery.post('GetVacaDet', {ac: ac}, function (data) {
                var str=data.split("+");
               
                if (str[0] == 'error') {
                    alert("Samayojan for this sanstha has not been done for "+lvl+" level. Hence no data available for extraction");
                    $("input").prop('disabled', true);
                    $("#roster_cancel").prop('disabled', false);
                }
                else {
                    $('#list').html(data);
                }
            });
        });

        $("#roster_submit").click(function () {
            var flag = 1;
            var x = document.getElementById("tchr_type1").checked;
            var y = document.getElementById("tchr_type2").checked;
            if ((x == false) && (y == false)) {
                alert('Please Select Education Level');
                return false;
            }
        });

    });
</script>


<?php echo $this->Form->create('pv_vaca_det', array('url' => array('controller' => 'Pavitras', 'action' => 'save_vaca_det'), 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="sess_val" value="<?php echo $sanstha_code; ?>" id="sess_val"/> 

<table class="table note">
    <tr>
        <td style="padding: 2px 12px;">
            <span class="notehead"><?php echo __('Note :'); ?></span> 
        </td>

    </tr>
</table>



<div style="width:100%;padding:5px;clear:both;">
    <div class="form_content" align="center">
        <div class="map_head" style="min-height:115px;height:auto">
            <h3> Extract Vacancy Details from Samayojan</h3>
            <div class="table-responsive">
                <table class="table b_table" id="rostertable" style="border-collapse:collapse;">
                    <tr>
                        <td class="col-xs-2" colspan="2">Education Level <span style="float:right;font-weight:bold">:</span></td>
                        <td class="col-xs-3" colspan="3">
                            <div style="float:left;">
                                <input type="radio" name="edu_level" id="tchr_type1" value="1" >
                                <label id="1">Primary</label>
                            </div>
                            <div style="float:left;">
                                <input type="radio" name="edu_level" id="tchr_type2" value="2">
                                <label id="2">Secondary / Higher Secondary</label>
                            </div>
                        </td>
                        <td class="col-xs-3" colspan="3">
                        <td class="col-xs-1" style="text-align:center;"><input  type="submit" name="submit" id="roster_submit" value="Extract" class="btn btn-sm logbutton2"></td>
                        <td class="col-xs-1" style="text-align:center;"><input  type="button" name="cancel" id="roster_cancel" value="Cancel" class="btn btn-sm btn-primary logbutton2"></td>
                        <td class="col-xs-1" style="text-align:center;"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm btn-primary logbutton2">
                    </tr>
                </table>

            </div>
        </div>
        <div id='list' style="float:left">
        </div>

    </div>
    <?php //echo $this->Form->end();       ?>  


</div>
<?php echo $this->Form->end(); ?>


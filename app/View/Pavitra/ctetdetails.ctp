<style>
    .legend_title{width:15%;}
</style>
<?php echo $this->Form->create('apply_posn', array('url' => array('controller' => 'Pavitras', 'action' => 'savectetdetails'))); ?>
<div>
    <fieldset class="myfieldset">
        <legend><div class="legend_title"><?php echo __('Central TET Details');?></div></legend>
        <div class="table-responsive fielddata">
            <table class="table b_table" id="fieldtable">
                <tr>             
                    <td class="col-xs-2" colspan="2">
                        <?php echo __('Appeared For Central TET?'); ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                    </td>

                    <td class="col-xs-2" colspan="2">
                        <?php if (!empty($check[0]['TetExmDet']['pv_tet_appeard'])) { ?>
                            <div style="float:left;padding-left:10px;">
                                <input type="radio" name="tet" id="tety" value='1'<?php if (trim($check[0]['TetExmDet']['pv_tet_appeard']) == '1') { ?> checked<?php } ?>>
                                <label><?php echo __('Yes');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tet" id="tetn" value='2'<?php if (trim($check[0]['TetExmDet']['pv_tet_appeard']) == '2') { ?> checked<?php } ?>>
                                <label><?php echo __('No');?></label>
                            </div>
                        <?php } else { ?>
                            <div style="float:left;padding-left:10px;">
                                <input type="radio" name="tet" id="tety" value='1'>
                                <label><?php echo __('Yes');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tet" id="tetn" value='2'>
                                <label><?php echo __('No');?></label>
                            </div>
                        <?php } ?>
                    </td>

                    <td class="col-xs-8"></td>
                </tr>
            </table>
        </div>
    </fieldset> 

    <div  id="exam1">
        <fieldset class="myfieldset">
            <legend><div class="legend_title"><?php echo __('First Paper');?></div></legend>
            <table class="table b_table">
                <tr>
                    <td class="col-xs-3" colspan="3">
                        <?php echo __('Appeared For First Paper?'); ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td class="col-xs-6" colspan="6">
                        <?php if (!empty($check[0]['TetExmDet']['pv_tet_exm_1'])) { ?>
                            <div style="float:left; padding-left:10px;" >
                                <input type="radio" name="tetpapper1" id="tetpapperyes1" value='1' <?php if (trim($check[0]['TetExmDet']['pv_tet_exm_1']) == '1') { ?> checked<?php } ?>>
                                <label><?php echo __('Yes');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tetpapper1" id="tetpapperno1" value='2' <?php if (trim($check[0]['TetExmDet']['pv_tet_exm_1']) == '2') { ?> checked<?php } ?>>
                                <label><?php echo __('No');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tetpapper1" id="tetpappernotapplicable1" value='3' <?php if (trim($check[0]['TetExmDet']['pv_tet_exm_1']) == '3') { ?> checked<?php } ?>>
                                <label><?php echo __('Not Applicable');?></label>
                            </div>
                        <?php } else { ?>
                            <div style="float:left; padding-left:10px;" >
                                <input type="radio" name="tetpapper1" id="tetpapperyes1" value='1'>
                                <label><?php echo __('Yes');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tetpapper1" id="tetpapperno1" value='2'>
                                <label><?php echo __('No');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tetpapper1" id="tetpappernotapplicable1" value='3'>
                                <label><?php echo __('Not Applicable');?></label>
                            </div>
                        <?php } ?>
                    </td>
                    <td class="col-xs-3" colspan="3"></td>

                </tr>
            </table>
            <table id="tetpapper1" class="table b_table">
                <tr>
                    <td class="col-xs-3" colspan="3" align="left">
                        <label><?php echo __('Central TET Number');?> </label><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span> 
                    </td>
                    <td class="col-xs-3" colspan="3">
                        <?php if (!empty($check[0]['TetExmDet']['pv_exm_id_1'])) { ?>
                            <div style="float:left;" id="tetnumer1">
                                <input type="text" name="tetpappernumber1" id="tetpappernumber1" style="width:100%" value=<?php echo $check[0]['TetExmDet']['pv_exm_id_1']; ?>>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div style="float:left;" id="tetnumer1">
                                <input type="text" name="tetpappernumber1" id="tetpappernumber1" style="width:100%">
                            </div>
                        <?php } ?>
                    </td>
                    <td class="col-xs-2" colspan="2"><?php echo __('Name');?><span style="float:right;margin-right:10px">:&nbsp;&nbsp;&nbsp;</span> </td>
                    <td class="col-xs-4" colspan="4"></td>
                </tr>
                <tr>
                    <td class="col-xs-3" colspan="3" align="left">
                        <label><?php echo __('Year Of Passing');?> </label> <span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td class="col-xs-3" colspan="3">
                        <div style="float:left;" id="tetyear1">
                            <input type="text" name="tetpapperyear1" id="tetpapperyear1" style="width:100%">
                        </div>
                    </td>
                    <td class="col-xs-2" colspan="2"><?php echo __('Eligible yes / No');?>  <span style="float:right;margin-right:10px">:&nbsp;&nbsp;&nbsp;</span> </td>
                    <td class="col-xs-4" colspan="4"></td>
                </tr>
            </table>
            </fiedset>
    </div>

    <div  id="exam2">
        <fieldset class="myfieldset">
            <legend><div class="legend_title"><?php echo __('Second Paper')?></div></legend>
            <table class="table b_table">
                <tr>
                    <td class="col-xs-3" colspan="3">
                        <?php echo __('Appeared For Second Paper?'); ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td class="col-xs-6" colspan="6">
                        <?php if (!empty($check[0]['TetExmDet']['pv_tet_exm_2'])) { ?>
                            <div style="float:left;padding-left: 10px;" >
                                <input type="radio" name="tetpapper2" id="tetpapperyes2" value='1' <?php if (trim($check[0]['TetExmDet']['pv_tet_exm_2']) == '1') { ?> checked<?php } ?>>
                                <label><?php echo __('Yes');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tetpapper2" id="tetpapperno2" value='2' <?php if (trim($check[0]['TetExmDet']['pv_tet_exm_2']) == '2') { ?> checked<?php } ?>>
                                <label><?php echo __('No');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tetpapper2" id="tetpappernotapplicable2" value='3' <?php if (trim($check[0]['TetExmDet']['pv_tet_exm_2']) == '3') { ?> checked<?php } ?>>
                                <label>Not Applicable</label>
                            </div>
                        <?php } else { ?>
                            <div style="float:left;padding-left: 10px;" >
                                <input type="radio" name="tetpapper2" id="tetpapperyes2" value='1'>
                                <label><?php echo __('Yes');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tetpapper2" id="tetpapperno2" value='2'>
                                <label><?php echo __('No');?></label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="tetpapper2" id="tetpappernotapplicable2" value='3'>
                                <label>Not Applicable</label>
                            </div>

                        <?php } ?>
                    </td>
                    <td class="col-xs-3" colspan="3"></td>
                </tr>
            </table>
            <table class="table b_table" id="tetpapper2">
                <tr>
                    <td class="col-xs-3" colspan="3" align="left">
                        <label>Central TET Number</label><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span> 
                    </td>
                    <td class="col-xs-3" colspan="3">
                        <?php if (!empty($check[0]['TetExmDet']['pv_exm_id_1'])) { ?>
                            <div style="float:left;" id="tetnumer2">
                                <input type="text" name="tetpappernumber2" id="tetpappernumber2" style="width:100%" value="<?php echo $check[0]['TetExmDet']['pv_exm_id_2']; ?>">
                            </div>
                        <?php } else { ?>
                            <div style="float:left;" id="tetnumer2">
                                <input type="text" name="tetpappernumber2" id="tetpappernumber2" style="width:100%">
                            </div>
                        <?php } ?>
                    </td>
                    <td class="col-xs-2" colspan="2"> Name  <span style="float:right;margin-right:10px">:&nbsp;&nbsp;&nbsp;</span></td>
                    <td class="col-xs-4" colspan="4"></td>
                </tr>
                <tr>
                    <td class="col-xs-3" colspan="3" align="left">
                        <label>Year Of Passing:</label><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td class="col-xs-3" colspan="3">
                        <div style="float:left;" id="tetyear2">
                            <input type="text" name="tetpapperyear2" id="tetpapperyear2" style="width:100%">
                        </div>
                    </td>
                    <td class="col-xs-2" colspan="2">Eligible yes / No <span style="float:right;margin-right:10px">:&nbsp;&nbsp;&nbsp;</span></td>
                    <td class="col-xs-4" colspan="4"></td>

                </tr>

            </table>
            </fiedset>
    </div>
    <div>
        <table>
            <tr>
                <td class="col-xs-5"></td>
                <td class="col-xs-4"></td>
                <td><input  type="submit" name="Save" id="save" value="Save" class="btn btn-sm logbutton2"></td>
                <td><input  type="button" name="Cancel" id="Cancel" value="Cancel" class="btn btn-sm logbutton2"></td>
            </tr>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#exam1").hide();
        $("#exam2").hide();
        $("#tetpapper1").hide();
        $("#tetpapper2").hide();
        $("input[name='tet']").on('click', function() {
            var x = $("input[name='tet']:checked").val();
            if (x == '1') {
                $("#exam1").show();
                $("#exam2").show();

            }
            if (x == '2') {
                $("#exam1").hide();
                $("#exam2").hide();
            }
        });
        var x = $("input[name='tet']:checked").val();
        if (x == '1') {
            $("#exam1").show();
            $("#exam2").show();

        }
        if (x == '2') {
            $("#exam1").hide();
            $("#exam2").hide();
        }
        $("input[name='tetpapper1']").on('click', function() {
            var x = $("input[name='tetpapper1']:checked").val();
            if (x == '2' || '3') {
                $("#tetpapper1").hide();
            }
            if (x == '1') {
                $("#tetpapper1").show();
            }
        });
        var x = $("input[name='tetpapper1']:checked").val();
        if (x == '2' || '3') {
            $("#tetpapper1").hide();
        }
        if (x == '1') {
            $("#tetpapper1").show();
        }
        $("input[name='tetpapper2']").on('click', function() {
            var x = $("input[name='tetpapper2']:checked").val();
            if (x == '2' || '3') {
                $("#tetpapper2").hide();
            }
            if (x == '1') {
                $("#tetpapper2").show();
            }
        });
        var x = $("input[name='tetpapper2']:checked").val();
        if (x == '2' || '3') {
            $("#tetpapper2").hide();
        }
        if (x == '1') {
            $("#tetpapper2").show();
        }
        $('#save').on('click', function() {
            var tet = $("input[name='tet']:checked").val();
            if (tet == undefined) {
                alert("Please Select Appeared For TET.");
                return false;
            }
            var papperone = $("input[name='tetpapper1']:checked").val();
            var pappertwo = $("input[name='tetpapper2']:checked").val();
            var tetpappernumber1 = $('#tetpappernumber1').val();
            var tetpapperyear1 = $('#tetpapperyear1').val();
            var tetpappernumber2 = $('#tetpappernumber2').val();
            var tetpapperyear2 = $('#tetpapperyear2').val();
            if (tet == 1) {
                if (papperone == 1) {
                    if (tetpappernumber1 == '' && tetpapperyear1 == '') {
                        alert("Enter TET Number for First Papper");
                        return false;
                    }
                } else if (papperone == undefined) {
                    alert("Select Appropriate Option Button for First Papper");
                    return false;
                }
                if (pappertwo == 1) {
                    if (tetpappernumber2 == '' && tetpapperyear2 == '') {
                        alert("Enter TET Number for Second Papper");
                        return false;
                    }
                } else if (pappertwo == undefined) {
                    alert("Select Appropriate Option Button for Second Papper");
                    return false;
                }
            }
        });
        $('#tetpappernumber1').on('blur', function() {
            var papperoneid = $('#tetpappernumber1').val();
            jQuery.post('checkpapperonedata', {papperoneid: papperoneid}, function(data) {
                $('#tetpapper1').html(data);
            });
        });
        $('#tetpappernumber1').on('change', function() {
            var papperoneid = $('#tetpappernumber1').val();
            jQuery.post('checkpapperonedata', {papperoneid: papperoneid}, function(data) {
                $('#tetpapper1').html(data);
            });
        });
        var papperoneid = $('#tetpappernumber1').val();
        if (papperoneid != '') {
            var papperoneid = $('#tetpappernumber1').val();
            jQuery.post('checkpapperonedata', {papperoneid: papperoneid}, function(data) {
                $('#tetpapper1').html(data);
            });
        }
        $('#tetpappernumber2').on('blur', function() {
            var pappertwoid = $('#tetpappernumber2').val();
            jQuery.post('checkpappertwodata', {pappertwoid: pappertwoid}, function(data) {
                $('#tetpapper2').html(data);
            });
        });
        var pappertwoid = $('#tetpappernumber2').val();
        if (pappertwoid != '') {
            var pappertwoid = $('#tetpappernumber2').val();
            jQuery.post('checkpappertwodata', {pappertwoid: pappertwoid}, function(data) {
                $('#tetpapper2').html(data);
            });
        }
    });
</script>

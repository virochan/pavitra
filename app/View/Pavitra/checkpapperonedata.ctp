<?php if (!empty($check)) { ?>
    <table id="tetpapper1" class="table b_table">
        <tr>
            <td class="col-xs-3" colspan="3" align="left">
                <label>TET Number </label><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span> 
            </td>
            <td class="col-xs-3" colspan="3">
                <div style="float:left;" id="tetnumer1">
                    <input type="text" name="tetpappernumber1" id="tetpappernumber1" style="width:100%" value=<?php echo $papperoneid ?>>
                </div>
            </td>
            <td class="col-xs-2" colspan="2"> Name<span style="float:right;margin-left:5px">:</span></td>
            <td class="col-xs-4" colspan="4"><?php echo $check[0]['TetData']['pv_apptn_fname'] . " " . $check[0]['TetData']['pv_apptn_mname'] . " " . $check[0]['TetData']['pv_apptn_lname']; ?></td>
        </tr>
        <tr>
            <td class="col-xs-3" colspan="3" align="left">
                <label>Year Of Passing </label> <span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td class="col-xs-3" colspan="3">
                <div style="float:left;" id="tetyear1">
                    <input type="text" name="tetpapperyear1" id="tetpapperyear1" style="width:100%" value="<?php echo $check[0]['TetData']['pv_exm_year_1']; ?>" readonly> 
                </div>
            </td>
            <td class="col-xs-3" colspan="3">Eligible yes / No :
                <input type="text" name="Eligibility1" id="Eligibility1" style="width:45%" value="<?php echo $check[0]['TetData']['pv_exm_qualify_1']; ?>" readonly>
            </td>
            <td class="col-xs-4" colspan="4"></td>
        </tr>
    </table>
<?php } else { ?>
    <table id="tetpapper1" class="table b_table">
        <tr>
            <td class="col-xs-3" colspan="3" align="left">
                <label><?php echo __('TET Number'); ?> </label><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span> 
            </td>
            <td class="col-xs-3" colspan="3">
                <div style="float:left;" id="tetnumer1">
                    <input type="text" name="tetpappernumber1" id="tetpappernumber1" style="width:100%">
                </div>
            </td>
            <td class="col-xs-2" colspan="2"><?php echo __('Name'); ?><span style="float:right;margin-right:10px">:&nbsp;&nbsp;&nbsp;</span> </td>
            <td class="col-xs-4" colspan="4"></td>
        </tr>
        <tr>
            <td class="col-xs-3" colspan="3" align="left">
                <label><?php echo __('Year Of Passing'); ?> </label> <span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td class="col-xs-3" colspan="3">
                <div style="float:left;" id="tetyear1">
                    <input type="text" name="tetpapperyear1" id="tetpapperyear1" style="width:100%">
                </div>
            </td>
            <td class="col-xs-2" colspan="2"><?php echo __('Eligible yes / No'); ?>  <span style="float:right;margin-right:10px">:&nbsp;&nbsp;&nbsp;</span> </td>
            <td class="col-xs-4" colspan="4"></td>
        </tr>
    </table>
<?php } ?>

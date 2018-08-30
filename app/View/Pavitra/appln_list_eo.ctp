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

	          
<?php echo $this->Form->create('appln_data', array('url' => array('controller' => 'Pavitras', 'action' => ''))); ?>

<input type="hidden" name="sess_val" value="<?php echo $user_id; ?>" id="sess_val"/> 


<div style="height:595px;width:100%;padding:5px;clear:both;">
    <div class="form_content" align="center">
        <div class="map_head" style="min-height:115px;height:auto">
            <h3> Approve Advertisement For Sanstha</h3>
            <table class="table b_table" width="100%" id="eoroster">
                <tr>
                    <td class="col-xs-2" colspan="2" align="center">Select Sanstha <span style="float:right;font-weight:bold">:</span> </td>
                    <td class="col-xs-8" colspan="8"> 
                        <?php
                        echo $this->Form->input('apln_sans', array('options' => $array_sanstha, 'id' => 'apln_sans', 'label' => false, 'empty' => '-- Select Sanstha--', 'style' => 'width:100%; float: left;'));
                        ?>    
                    </td>
                </tr>
                <tr>
                    <td class="col-xs-2" colspan="2" align="center">Select Medium <span style="float:right;font-weight:bold">:</span> </td>
                    <td class="col-xs-4" colspan="4"> 
                        <span id='SchoolMediumSpan'>
                            <select  style="width:80%!important;">
                                <option>------Select Medium------</option>

                            </select>
                        </span>
                    </td>
                    <td class="col-xs-2" colspan="2" align="center">Select Designation <span style="float:right;font-weight:bold">:</span> </td>
                    <td class="col-xs-4" colspan="4"> 
                        <span id='DesgSpan'>
                            <select  style="width:80%!important;">
                                <option>------Select Designation------</option>

                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="col-xs-2" colspan="2" align="center">Select Subject <span style="float:right;font-weight:bold">:</span> </td>
                    <td class="col-xs-4" colspan="4"> 
                        <span id='SubjSpan'>
                            <select  style="width:80%!important;">
                                <option>------Select Subject------</option>

                            </select>
                        </span>
                    </td>
                    <td class="col-xs-4" colspan="4">
                    <td class="col-xs-1"><input  type="button" name="submit" id="check_data" value="Go" class="btn btn-sm logbutton2"></td>
                    <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm logbutton2"></td>
                </tr>


            </table> 

        </div>
        <div id='list' style="float:left">
        </div>
        <div id="main_table">
        <div class="table-responsive" >
            <table class="table table_extract" border="0" style="width:100%; background:#fff;margin-top:15px;">
                <thead>    
                    <tr>
                        <th class="col-xs-1" rowspan="2">Sr. No</th>
                        <th class="col-xs-2" colspan="2" rowspan="2">Applicant Name</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Date of Birth</th>
                        <th class="col-xs-2" colspan="2">Qualification</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Marks</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Caste Category</th>
                        <th class="col-xs-2" colspan="2" rowspan="2">Applied for Post</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Subject</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Status</th>
                       <!-- <th width="33" class="th_grid" style="line-height: 15px;"> <?php //echo __('Class To');                                                                                                                                                                                                    ?> </th>-->
                    </tr>
                    <tr>
                        <th class="col-xs-1" >Acad.</th>
                        <th class="col-xs-1" >Prof.</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php
                    if (!empty($check)) {

                        ?><?php
                        $cnt = 1;
                        for ($i = 0; $i < count($check); $i++) {
                            ?>

                        <tr>
                            <td class="col-xs-1" style="width:4.33333333%"><?php echo $cnt; ?></td>
                            <td class="col-xs-2"  colspan="2" ><?php echo $check[$i]['0']['appl_fname']. ' ' .$check[$i]['0']['appl_mname'].' '. $check[$i]['0']['appl_lname']; ?></td>
                            <td class="col-xs-1"><?php echo $check[$i]['0']['pv_apptn_dob']; ?></td>
                            <td class="col-xs-1"><?php echo '' ?></td>
                            <td class="col-xs-1"><?php echo '' ?></td>
                            <td class="col-xs-1"><?php echo '' ?></td>
                            <td class="col-xs-1"><?php echo '' ?></td>
                            <td class="col-xs-2" colspan="2"><?php echo $check[$i]['0']['post_desc']; ?></td>
                            <td class="col-xs-1"><?php echo ''?></td>
                            <td class="col-xs-1"><?php echo $check[$i]['0']['flag_text']; ?></td>

                       
                        </tr>
                        <?php $cnt++;
                    }
                    ?>
                <?php } else {


                    ?><tr> <td class="col-xs-12" ><div><?php echo "No records found";
            }
                ?></div></td></tr>                                   
            </tbody>
                  
            </table>  
        </div>	
    </div>


</div>
</div>

<?php echo $this->Form->end(); ?>

<script>
    $(document).ready(function() {
        $('#apln_sans').on('change', function() {
            var apln_sans = $('#apln_sans :selected').val();
            jQuery.post('ApplnMed', {apln_sans: apln_sans}, function(data) {
                $('#SchoolMediumSpan').html(data);
                $('#apln_med').on('change', function() {
                    var apln_med = $('#apln_med :selected').val();
                     jQuery.post('ApplnDesg', {apln_sans: apln_sans,apln_med:apln_med}, function(data) {
                        $('#DesgSpan').html(data);

                         $('#apln_desg').on('change', function() {
                            var apln_desg = $('#apln_desg :selected').val();
                             jQuery.post('ApplnSubj', {apln_sans: apln_sans,apln_med:apln_med,apln_desg:apln_desg}, function(data) {
                                $('#SubjSpan').html(data);
                            });
                        });

                    });
                });
            });
        });
        
        
       $("#check_data").click(function () {
            var apln_sans = $('#apln_sans :selected').val();
            var apln_med = $('#apln_med :selected').val();
            var apln_desg = $('#apln_desg :selected').val();
            var apln_subj = $('#apln_subj :selected').val();
            
            if(apln_sans==''){
                alert('Please select sanstha');
                return false;
            }
            if(apln_med==''){
                alert('Please select medium');
                return false;
            }
            if(apln_desg==''){
                alert('Please select designation');
                return false;
            }
            if(apln_subj==''){
                alert('Please select subject');
                return false;
            }
            
            jQuery.post('CheckApplnRec', {apln_sans: apln_sans,apln_med:apln_med,apln_desg:apln_desg,apln_subj:apln_subj}, function(data) {
                    $('#list').html(data);
            });
       });
    });
</script>
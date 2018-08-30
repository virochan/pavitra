<style>
    .table-fixed thead{width:98%;}
    .table-fixed thead tr th{text-align: center;border-left:1px solid #ddd;}
    .table-fixed tbody tr td{border-left:1px solid #92b2f4;font-size: 12px !important}
    .table-fixed tbody{height:140px;}
    .logbutton2{padding:2px 12px;margin:2px;}
   
</style>

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
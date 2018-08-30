<?php
echo $this->Html->script('jquery-1.7.2');
echo $this->Html->script('jquery.ui.datepicker');
echo $this->Html->css('jquery.ui.all');
echo $this->Html->script('jquery.ui.core');
echo $this->Html->css('bootstrap.min');
echo $this->Html->script('bootstrap.min');
?>
<style>
    .td_grid, .th_grid {
        padding:4px !important;
        border: 1px solid #E1A09F !important;
        text-align: left;
    }
    .tr_grid:nth-of-type(2n+1)
    {
        background:#fff !important;	
    }

    #abc {
        width:100%;
        height:100%;
        top:0;
        left:0;
        display:none;
        position:fixed;
        background-color:rgba(0,0,0,0.5);
        overflow:auto
    }

    img#close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }

    div #popimg {
        position:absolute;
        left:40%;
        top:5%;
        font-family:'Raleway',sans-serif;
    }

    #rostertable td
    {
        padding:0.5%;
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
    .total_col{cursor:pointer;background:#FEC6C6;border-top:3px solid #DB7474;border-bottom:2px solid #DB7474;}
    h3{margin-bottom: 0px;}
    .table{margin-bottom:0px;}
    label{font-weight:500 !important}
    .b_table tr td{border-top:none !important;}
</style>
<script>
    $(document).ready(function () {
        $('input:text').prop('readonly', true);
        $(function () {
            $("#datepicker").datepicker({
                showOn: "button",
                buttonImage: "../img/calender.gif",
                buttonImageOnly: true,
                buttonText: "Select date"
            });
        });



        $("#overlay_srch").hide();
        $("#img_close").hide();

        var numpattern = /^[0-9]*$/;
        //$('input:radio[id=tchr_type][value=2]').attr('disabled', true);
        var sess_val = $('#sess_val').val();
        $('#view').hide();
        $('#map_container').hide();
        json_data();
        $('.price').each(function () {
            if ($(this).val() == '') {
                $(this).val('0');
            }
        });
        $('.work').each(function () {
            if ($(this).val() == '') {
                $(this).val('0');
            }
        });
        var p_sum = 0;
        $('.vcnt').each(function () {
            if ($(this).val() == '') {
                $(this).val('0');
            } else {
                if ($(this).val() != '') {
                    p_sum += Number($(this).val());
                }
//                $('#SamayojanVacntSum').val(p_sum);
            }
        });
        $('#pv_rostersansSancSum').val('0');
        $('#pv_rostersansWrkSum').val('0');
//        $('#SamayojanVacntSum').val('0');


        if (sess_val.indexOf('SC') >= 0) {
            //$('#tchr_type1').attr('checked','true');
        } else if (sess_val.indexOf('CB') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        } else if (sess_val.indexOf('EO') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        } else if (sess_val.indexOf('DD') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        }

        $("#caste_teaching").click(function () {
            $('input:radio[id=tchr_type][value=1]').prop('checked', true);
        });
        $("#caste_nonteaching").click(function () {
            $('input:radio[id=tchr_type][value=2]').prop('checked', true);
        });
        $("#roster_cancel").click(function () {
//            $('.price').each(function() {
//                $(this).val('0');
//            });
//            $('.work').each(function() {
//                $(this).val('0');
//            });
//            $('.vcnt').each(function() {
//                $(this).val('0');
//            });
//            $('#datepicker').val('');
//            $('#pv_rostersansSancSum').val('0');
//            $('#pv_rostersansWrkSum').val('0');
//            $('#SamayojanVacntSum').val('0');
            location.reload();
        });
        $(".price").change(function () {
            if (numpattern.test($(this).val()) == false) {
                alert("ERR...Invalid  Sanctioned post ...");
                $(this).val('0');
            }
            /*if ($(this).val() < 0 || $(this).val() > 9999 ) {
             alert("ERR...Invalid  Sanctioned post ...");
             $(this).val('0');
             }*/
            var price_id = $(this).attr('id');
            var arr = price_id.split('_');
            var work_val = Number($('#work_' + arr[1]).val());
            var price_val = Number($(this).val());
//            alert(price_val);
            if (price_val == 0) {
                var p_sum = 0;
                var v_sum = 0;
                var a = price_val - work_val;
                $('#vcnt_' + arr[1]).val(a);
                $('.price').each(function () {
                    p_sum += Number($(this).val());
                });
                $('#pv_rostersansSancSum').val(p_sum);
                $('.vcnt').each(function () {
                    if ($(this).val() != '') {
                        v_sum += Number($(this).val());
                    }
                });
//                $('#SamayojanVacntSum').val(v_sum);
            }
            if (price_val != '') {
                var dif = Number(price_val - work_val);
                $('#vcnt_' + arr[1]).val(dif);
                var p_sum = 0;
                var v_sum = 0;
                $('.price').each(function () {
                    if ($(this).val() != '') {
                        p_sum += Number($(this).val());
                    }
                });
                $('#pv_rostersansSancSum').val(p_sum);
                //v sum
                $('.vcnt').each(function () {
                    if ($(this).val() != '') {
                        v_sum += Number($(this).val());
                    }
                });
//                $('#SamayojanVacntSum').val(v_sum);
            } else if ($(this).val() == '')
            {
                $(this).val('0');
                var p_sum = 0;
                var v_sum = 0;
                $('.price').each(function () {
                    if ($(this).val() != '') {
                        p_sum += Number($(this).val());
                    }
                    $('#pv_rostersansSancSum').val(p_sum);
                    var price_new = Number($('#price_' + arr[1]).val());
                    var work_new = Number($('#work_' + arr[1]).val());
                    $('#vcnt_' + arr[1]).val(price_new - work_new);
                    //v sum
                    $('.vcnt').each(function () {
                        if ($(this).val() != '') {
                            v_sum += Number($(this).val());
                        }
                    });
//                    $('#SamayojanVacntSum').val(v_sum);
                });
            }
        });
        $(".work").change(function () {

            if (numpattern.test($(this).val()) == false) {
                alert("ERR...Invalid  Working Saff...");
                $(this).val('0');
            }
            var work_val = Number($(this).val());
            var work_id = $(this).attr('id');
            var arr = work_id.split('_');
            var price_val = Number($('#price_' + arr[1]).val());

            if (work_val > price_val) {
                alert('Err...Teaching staff cannot be more than sanctioned post...');
                $(this).val('0');
                $('#vcnt_' + arr[1]).val(price_val);

            }
            else {
                if (price_val == '0') {
                    var a = price_val - work_val;
                    $('#vcnt_' + arr[1]).val(a);
                    var w_sum = 0;
                    var v_sum = 0;
                    $('.work').each(function () {
                        if ($(this).val() != '') {
                            w_sum += Number($(this).val());
                        }
                    });
                    $('#pv_rostersansWrkSum').val(w_sum);

                    $('.vcnt').each(function () {
                        if ($(this).val() != '') {
                            v_sum += Number($(this).val());
                        }
                    });
//                $('#SamayojanVacntSum').val(v_sum);
                } else
                if (price_val != '' || price_val != '0') {// alert("aaaa");
                    if ($(this).val() == '') {
                        $(this).val('0');
                    }
                    var dif = Number(price_val - work_val);
                    $('#vcnt_' + arr[1]).val(dif);
                    var w_sum = 0;
                    var v_sum = 0;
                    $('.work').each(function () {
                        if ($(this).val() != '') {
                            w_sum += Number($(this).val());
                        }
                    });
                    $('#pv_rostersansWrkSum').val(w_sum);
                    //v sum
                    $('.vcnt').each(function () {
                        if ($(this).val() != '') {
                            v_sum += Number($(this).val());
                        }
                    });
//                $('#SamayojanVacntSum').val(v_sum);
                } else if ($(this).val() == '') {
                    $(this).val('0');
                    var W_sum = 0;
                    var v_sum = 0;
                    $('.work').each(function () {
                        if ($(this).val() != '') {
                            W_sum += Number($(this).val());
                        }
                        $('#pv_rostersansWrkSum').val(W_sum);
                        var price_new = Number($('#price_' + arr[1]).val());
                        var work_new = Number($('#work_' + arr[1]).val());
                        $('#vcnt_' + arr[1]).val(price_new - work_new);
                        //v sum
                        $('.vcnt').each(function () {
                            if ($(this).val() != '') {
                                v_sum += Number($(this).val());
                            }
                        });
//                    $('#SamayojanVacntSum').val(v_sum);
                    });
                }
                /*else{
                 alert("ERR...Enter the Sanctioned post for this category");
                 }*/
            }
        });
        $("#tchr_type1").click(function () {
            $('#staff_group').trigger('change');
        });
        $("#tchr_type2").click(function () {
            $('#staff_group').trigger('change');
        });
        $("#caste_hm_exit").click(function () {
            var url = 'sanstha';
            $(location).attr('href', url);
        });
        $("#staff_group").change(function () {
            var staff_group = $('#staff_group').val();
            var edu_level = $('input:radio[name=edu_level]:checked').val();
            var tchr_type = $('#tchr_type').val();
            jQuery.post('exc_get_staff_avail', {staff_group: staff_group, roster_edn_level: edu_level, tchr_type: tchr_type}, function (data) {
                if (data.trim() == 'error') {
                    $('#datepicker').val('');
                    $('#view').hide();
                    $('#mycontainer1').hide();
                    $('#SamayojanUplodimg').val('');
                    $('#pdf_path').val('');
                    $('.price').each(function () {
                        $(this).val('0');
                    });
                    $('.work').each(function () {
                        $(this).val('0');
                    });
                    $('.vcnt').each(function () {
                        $(this).val('0');
                    });
                    $('#pv_rostersansSancSum').val('0');
                    $('#pv_rostersansWrkSum').val('0');
                    alert("No Data Available for this sanstha.");
                    $('input:radio[name=edu_level]:checked').prop('checked', false);
                    location.reload();
                } else {
                    json_data();
                }
            });
        });

        $("#roster_submit").click(function () {
            var flag = 1;
            if (!($('input:radio[name=edu_level]:checked').val() == '1' || $('input:radio[name=edu_level]:checked').val() == '2')) {
                flag = 0;
                alert("ERR...Select Education Level");
            } else if (!$('input:radio[name=staff_type]:checked').val() == '1') {
                flag = 0;
                alert("ERR...Select Staff Type");
            } else if ($('#staff_group').val() == '') {
                flag = 0;
                alert("ERR...Select Staff Group");
            } else if ($('#datepicker').val() == '') {
                flag = 0;
                alert("ERR...Select Date");
            }
            else if (($('#pdf_path').val() == '') && ($("#popup").attr('src') == '')) {
                flag = 0;

                alert("ERR...Upload Roster Order");
            }
            else {
                var sum = 0;
                $('.price').each(function () {
                    if ($(this).val() != '') {
                        sum += Number($(this).val());
                    }
                });
                if (sum == 0) {
                    flag = 0;
                    alert("ERR...Fill atleast one Sanctioned post");
                }
            }
            if (flag == 0) {
                return false;
            }
        });
//        $('#SamayojanRosterForm').ajaxForm({url: 'roster_save', type: 'post',
//            success: function(data) {
//                alert("Data Saved Successfully.");
//                json_data();
//            }
//        });
        function json_data() {
            var flag = '';
            var sanstha_code = '';
            var mgmt_type = '';
            var roster_edn_level = '';
            var tchr_type = '';
            var staff_group = '';
            var sc_sanc_tot = '';
            var st_sanc_tot = '';
            var vja_sanc_tot = '';
            var ntb_sanc_tot = '';
            var ntc_sanc_tot = '';
            var ntd_sanc_tot = '';
            var obc_sanc_tot = '';
            var sbc_sanc_tot = '';
            var gen_sanc_tot = '';
            var sc_work_tot = '';
            var st_work_tot = '';
            var vja_work_tot = '';
            var ntb_work_tot = '';
            var ntc_work_tot = '';
            var ntd_work_tot = '';
            var obc_work_tot = '';
            var sbc_work_tot = '';
            var gen_work_tot = '';
            var roster_file_name = '';
            var rst_last_upd_dt = '';
            var p_sum = 0;
            var w_sum = 0;
            var v_sum = 0;
            var session_user_id = $('#sess_val').val(); // alert($('#sess_val').val());	
//            var edu_level = $('#tchr_type1').val();
            var edu_level = $('input:radio[name=edu_level]:checked').val();
            tchr_type = $('#tchr_type').val();
            staff_group = $('#staff_group').val();
            if (staff_group != '') {
                staff_group = staff_group;
            } else {
                staff_group = 1;
            }

            jQuery.post(window.webroot + 'Pavitras/exc_get_roster_data', {session_user_id: session_user_id, staff_group: staff_group,
                roster_edn_level: edu_level, tchr_type: tchr_type}, function (data) {

                $.each(data, function (key, val) {
                    $.each(val, function (key, val) {
                        $.each(val, function (key, val) {
                            $.each(val, function (key, val) {

                                if (key === 'mgmt_type') {

                                }
                                if (key === 'roster_edn_level') {
                                    if (val == 'P') {
                                        $('#tchr_type1').attr('checked', 'true');
                                    } else {
                                        $('#tchr_type2').attr('checked', 'true');
                                    }
                                }
                                if (key === 'tchr_type') {
                                    if (val == '1') {
                                        $('#tchr_type').attr('checked', 'true');
                                    } else {
                                        //$('#tchr_type2').attr('checked', 'true');
                                    }
                                }
                                if (key === 'staff_group') {
                                    $('#staff_group option[value=' + $.trim(val) + ']').attr("selected", "selected");
                                }
                                if (key === 'rst_last_upd_dt') {
                                    var arr = val.split('-');
                                    date = arr[2] + "/" + arr[1] + "/" + arr[0];
                                    $("#datepicker").val(date);
                                }
                                if (key === 'roster_file_name') {
                                    roster_file_name = val;
                                    $("#img_name").val(roster_file_name);
                                }
                                if (key === 'sc_sanc_tot') {
                                    sc_sanc_tot = val;
                                    $("#price_1").val(val);
                                }
                                if (key === 'sc_work_tot') {
                                    sc_work_tot = val;
                                    $("#work_1").val(val);
                                }
                                if (key === 'st_sanc_tot') {
                                    st_sanc_tot = val;
                                    $("#price_2").val(val);
                                }
                                if (key === 'st_work_tot') {
                                    st_work_tot = val;
                                    $("#work_2").val(val);
                                }
                                if (key === 'vja_sanc_tot') {
                                    vja_sanc_tot = val;
                                    $("#price_3").val(val);
                                }
                                if (key === 'vja_work_tot') {
                                    vja_work_tot = val;
                                    $("#work_3").val(val);
                                }
                                if (key === 'ntb_sanc_tot') {
                                    ntb_sanc_tot = val;
                                    $("#price_4").val(val);
                                }
                                if (key === 'ntb_work_tot') {
                                    ntb_work_tot = val;
                                    $("#work_4").val(val);
                                }
                                if (key === 'ntc_sanc_tot') {
                                    ntc_sanc_tot = val;
                                    $("#price_5").val(val);
                                }
                                if (key === 'ntc_work_tot') {
                                    ntc_work_tot = val;
                                    $("#work_5").val(val);
                                }
                                if (key === 'ntd_sanc_tot') {
                                    ntd_sanc_tot = val;
                                    $("#price_6").val(val);
                                }
                                if (key === 'ntd_work_tot') {
                                    ntd_work_tot = val;
                                    $("#work_6").val(val);
                                }
                                if (key === 'obc_sanc_tot') {
                                    obc_sanc_tot = val;
                                    $("#price_7").val(val);
                                }
                                if (key === 'obc_work_tot') {
                                    obc_work_tot = val;
                                    $("#work_7").val(val);
                                }
                                if (key === 'sbc_sanc_tot') {
                                    sbc_sanc_tot = val;
                                    $("#price_8").val(val);
                                }
                                if (key === 'sbc_work_tot') {
                                    sbc_work_tot = val;
                                    $("#work_8").val(val);
                                }
                                if (key === 'gen_sanc_tot') {
                                    gen_sanc_tot = val;
                                    $("#price_9").val(val);
                                }
                                if (key === 'gen_work_tot') {
                                    gen_work_tot = val;
                                    $("#work_9").val(val);
                                }
                                if (key === 'asst_flag') {
                                    if (val === 'R') {
                                        alert("This record is rejected by EO");
                                    }
                                    if (val === 'V') {
                                        flag = 'V';
                                    }
                                }

                            });
                        });
                    });
                });
//                if (flag === 'V') {
//                    alert("Roster already verified");
//                    $("input").prop('disabled', true);
//                }
                // image 1

//                if (roster_file_name) {
//                    $('#mycontainer1').show();
//                    $('#view').show();
//                    $("#SamayojanUplodimg").val(roster_file_name);
//                    $('#close').show();
//                    var newImage = $('<img align="center" height="150" width="483" id="popimg"/>');
////                    alert(newImage);
//                    newImage.attr('src', window.webroot + 'STADMIN_UPLOADS/' + roster_file_name);
//                    $('#abc').append(newImage);
//                    d = new Date();
//                    $("#popup").attr("src", window.webroot + 'STADMIN_UPLOADS/' + roster_file_name + '?' + d.getTime());
//                    $("#popup").attr("src", "/myimg.jpg?"+d.getTime());
//                } else {
//                    $("#mycontainer1").hide();
//                    $("#view").hide();
//                    $('#close').hide();
//                    $("#SamayojanUplodimg").val('');
//                }

                if (roster_file_name) {
                    var newImage = $('<img align="left" height="30" width="58" id="popup" onClick="div_show()" />');
                    newImage.attr('src', window.webroot + 'STADMIN_UPLOADS/' + roster_file_name);
                    // newImage.attr('src', window.webroot + 'nfsshare/STADMIN_UPLOADS/' + roster_file_name);
                    $('#mycontainer1').html('');
                    $('#mycontainer1').append(newImage);
                    d = new Date();
                    $("#popup").attr("src", window.webroot + 'STADMIN_UPLOADS/' + roster_file_name + '?' + d.getTime());
                    // $("#popup").attr("src", window.webroot + 'nfsshare/STADMIN_UPLOADS/' + roster_file_name + '?' + d.getTime());
                } else {
                    $('#mycontainer1').hide();
                    $('#view').hide();
                }

                if (sc_sanc_tot != '' && sc_work_tot != '') {
                    sc_diff = sc_sanc_tot - sc_work_tot;
                    $("#vcnt_1").val(sc_diff);
                }
                if (st_sanc_tot != '' && st_work_tot != '') {
                    st_diff = st_sanc_tot - st_work_tot;
                    $("#vcnt_2").val(st_diff);
                }
                if (vja_sanc_tot != '' && vja_work_tot != '') {
                    vja_diff = vja_sanc_tot - vja_work_tot;
                    $("#vcnt_3").val(vja_diff);
                }
                if (ntb_sanc_tot != '' && ntb_work_tot != '') {
                    ntb_diff = ntb_sanc_tot - ntb_work_tot;
                    $("#vcnt_4").val(ntb_diff);
                }
                if (ntc_sanc_tot != '' && ntc_work_tot != '') {
                    ntc_diff = ntc_sanc_tot - ntc_work_tot;
                    $("#vcnt_5").val(ntc_diff);
                }
                if (ntd_sanc_tot != '' && ntd_work_tot != '') {
                    ntd_diff = ntd_sanc_tot - ntd_work_tot;
                    $("#vcnt_6").val(ntd_diff);
                }
                if (obc_sanc_tot != '' && obc_work_tot != '') {
                    obc_diff = obc_sanc_tot - obc_work_tot;
                    $("#vcnt_7").val(obc_diff);
                }
                if (sbc_sanc_tot != '' && sbc_work_tot != '') {
                    sbc_diff = sbc_sanc_tot - sbc_work_tot;
                    $("#vcnt_8").val(sbc_diff);
                }
                if (gen_sanc_tot != '' && gen_work_tot != '') {
                    gen_diff = gen_sanc_tot - gen_work_tot;
                    $("#vcnt_9").val(gen_diff);
                }


                $('.price').each(function () {
                    if ($(this).val() != '') {
                        p_sum += Number($(this).val());
                    }
                });
                $('#pv_rostersansSancSum').val(p_sum);
                $('.work').each(function () {
                    if ($(this).val() != '') {
                        w_sum += Number($(this).val());
                    }
                });
                $('#pv_rostersansWrkSum').val(w_sum);
                $('.vcnt').each(function () {
                    if ($(this).val() != '') {
                        v_sum += Number($(this).val());
                    }
                });
//                $('#SamayojanVacntSum').val(v_sum);
            }, 'json');
        }
        $("#datepicker").change(function () {

            var todays_date = new Date();
            var roster_date = $(this).val();
            var date = roster_date.substring(0, 2);
            var month = roster_date.substring(3, 5);
            var year = roster_date.substring(6, 10);
            date = year + '-' + month + '-' + date;
            var roster_dt = new Date(date);
            var d = new Date("2012-05-31");
            if (d > roster_dt) {
                alert("Err....Entered date can not be less than 31/05/2012");
                $(this).val('');

            }

            if (roster_dt > todays_date) {
                alert("Err....Enter To date Greater than today's date.")
                $(this).val('');

            }

        });
    });
</script>
<script type="text/javascript">
    function div_show() {
        var a = $("#popup").attr('src');
        var extension = a.substr((a.lastIndexOf('.') + 1));
        var ext = extension.substr(extension, 3);
        if (ext === 'pdf') {
            window.open(a);
        }
        else {
            $("#overlay_srch").show();
            $("#overlay_srch").html("<img id='img' src=" + a + "/>");
            $("#img_close").show();
        }
    }
    function div_hide() {
        $("#overlay_srch").hide();
        $("#img_close").hide();

    }

</script>

<?php echo $this->Form->create('pv_rostersans', array('url' => array('controller' => 'Pavitras', 'action' => 'incert_roster_data'), 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="sess_val" value="<?php echo $sansthacode; ?>" id="sess_val"/> 
<?php echo $this->Form->input('uplodimg', array('label' => false, 'type' => 'hidden', 'value' => '', 'name' => 'uplodimg')); ?>

<table class="table note">
    <tr>
        <td>
            <span class="notehead"><?php echo __('Note :'); ?></span> 
        </td>
        <td>
            <!--        1.Please select a teacher who has been transfered from your school to some other school either in the same district or some other district.<br/>
                        2.After confirming please press detach button.Before detaching a teacher please confirm the data of the same teacher is verified by there cluster.<br/>
                        3.Once the teacher has been detached he will not be available for any kind of data updation in old school.<br/>
                        4.Only after detaching the same teacher will be available to that school where he is currently transfered that headmaster of school will attach the same teacher.-->
        </td>
    </tr>
</table>



    <div style="width:100%;padding:5px;clear:both;">
        <div class="form_content" align="center">
            <div class="map_head" style="min-height:115px;height:auto">
                <h3> Extract Roster Details</h3>
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

                            <td class="col-xs-2" colspan="2">Select Staff Type <span style="float:right;font-weight:bold">:</span></td>
                            <td class="col-xs-2" colspan="2"> 

                                <input type="radio" name="staff_type" id="tchr_type" value="1" checked>
                                <label id="1">Teaching Staff</label>

                            </td>
                            <td class="col-xs-3" colspan="3"></td>
                        </tr>

                        <tr> 
                            <td class="col-xs-2" colspan="2">Select Staff Group <span style="float:right;font-weight:bold">:</span></td>
                            <td class="col-xs-3" colspan="3">
                                <?php
                                $options = array('3' => 'Teaching');
                                echo $this->Form->input('staff_group', array('options' => $options, 'id' => 'staff_group', 'label' => false, 'style' => 'width: 85%; float: left;'));
                                ?>  
                            </td>
                            <td class="col-xs-2" colspan="2">Roster Data as on Date <span style="float:right;font-weight:bold">:</span></td>

                            <td class="col-xs-2" colspan="2"><?php echo $this->Form->input('rst_last_upd_dt', array('label' => false, 'autocomplete' => 'off', 'id' => 'datepicker', 'type' => 'text', 'placeholder' => 'DD/MM/YYYY', 'style' => 'margin-right:3px;width:122px;', 'maxlength' => '30')); ?>   </td>
                            </td>
                            <td class="col-xs-1" style="text-align:center;"><input  type="submit" name="submit" id="roster_submit" value="Accept" class="gobutton" style="float:left;margin-right:1px;"></td>
                            <td class="col-xs-1" style="text-align:center;"><input  type="button" name="cancel" id="roster_cancel" value="Cancel" class="gobutton" style="float:left;margin-right:1px;"></td>
                            <td class="col-xs-1" style="text-align:center;"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="gobutton" style="float:left;margin-right:1px;">

                            </td>
        <!--                    <td class="col-xs-2" colspan="2" style="text-align:center;">
                                <div class="" style="float:left;width:100%;">
                                    <input  type="submit" name="submit" id="roster_submit" value="Accept" class="gobutton" style="float:left;margin-right:1px;">
                                    <input  type="button" name="cancel" id="roster_cancel" value="Cancel" class="gobutton" style="float:left;margin-right:1px;">
                                    <input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="gobutton" style="float:left;margin-right:1px;">
                                </div>
                            </td>-->
                        </tr>
                    </table>

                </div>
            </div>

            <div class="table-responsive" style="margin-top:5px;">
                <table class="table_grid" border="0" style="width:70%; background:#fff">
                    <thead>
                        <tr class="tr_grid">
                            <th class="th_grid col-xs-1" style=""><div align="center" class="clorclas">Sr. No</div></th>
                    <th class="th_grid col-xs-2"><div align="center" class="clorclas">Category Name</div> </th>
                    <th class="th_grid col-xs-3" style=""> <div align="center" class="clorclas">Sanctioned post to be filled as per roster</div> </th>
                    <th class="th_grid col-xs-3"><div align="center" class="clorclas">Total Working Saff <br/>(Approved by EO / Dy. Director )</div></th>
                    <th class="th_grid col-xs-3"><div align="center" class="clorclas">Total Vacant Staff</div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td  style="text-align:center" class="td_grid col-xs-1">1</td>
                            <td class="td_grid col-xs-2" style="text-align:center">SC</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('sc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_1')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('sc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_1')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('sc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'readonly', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_1')); ?></td>
                        </tr>

                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td class="td_grid col-xs-1" style="text-align:center">2</td>
                            <td class="td_grid col-xs-2" style="text-align:center">ST</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('st_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_2')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('st_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_2')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('st_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_2', 'readonly')); ?></td>
                        </tr>

                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td  style="text-align:center" class="td_grid col-xs-1">3</td>
                            <td class="td_grid col-xs-2" style="text-align:center">VJA</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('vja_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_3')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('vja_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_3')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('vja_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_3', 'readonly')); ?></td>
                        </tr>

                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td  style="text-align:center" class="td_grid col-xs-1">4</td>
                            <td class="td_grid col-xs-2" style="text-align:center">NTB</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntb_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_4')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntb_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_4')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntb_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_4', 'readonly')); ?></td>
                        </tr>

                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td  style="text-align:center" class="td_grid col-xs-1">5</td>
                            <td class="td_grid col-xs-2" style="text-align:center">NTC</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_5')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_5')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_5', 'readonly')); ?></td>
                        </tr>

                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td class="td_grid col-xs-1"  style="text-align:center" height="22">6</td>
                            <td class="td_grid col-xs-2" style="text-align:center">NTD</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntd_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_6')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntd_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_6')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('ntd_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_6', 'readonly')); ?></td>

                        </tr>

                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td  style="text-align:center" class="td_grid col-xs-1">7</td>
                            <td class="td_grid col-xs-2" style="text-align:center">OBC</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('obc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_7')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('obc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_7')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('obc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_7', 'readonly')); ?></td>

                        </tr>

                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td  style="text-align:center" class="td_grid col-xs-1">8</td>
                            <td class="td_grid col-xs-2" style="text-align:center">SBC</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('sbc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_8')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('sbc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_8')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('sbc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_8', 'readonly')); ?></td>
                        </tr>

                        <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                             ?>">
                            <td  style="text-align:center" class="td_grid col-xs-1">9</td>
                            <td class="td_grid col-xs-2" style="text-align:center">General</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('gen_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_9')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('gen_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_9')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('gen_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_9', 'readonly')); ?></td>
                        </tr>

                        <tr class="Subjectdtl total_col" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                            ?>">
                            <td  style="text-align:center" class="td_grid col-xs-1">&nbsp;</td>
                            <td class="td_grid col-xs-2" style="text-align:center">Total</td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('sanc_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php echo $this->Form->input('wrk_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;')); ?></td>
                            <td class="td_grid col-xs-3" style="text-align:center"><?php // echo $this->Form->input('vacnt_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;'));                                 ?></td>
                        </tr>
                    </tbody>
                </table>  
            </div>	
        </div>
        <?php //echo $this->Form->end();       ?>  
    


    <div class="overlay_srch" id="overlay_srch">
        <div id="search_box">
        </div>
    </div>
   </div>
<?php echo $this->Form->end(); ?>
<script>
    $(document).ready(function () {
        $("#roster_Delete").click(function () {
            var edu_level = $('input:radio[name=edu_level]:checked').val();
            var staff_group = $('#staff_group').val();
            var staff_type = $('input:radio[name=staff_type]:checked').val();
            var x = confirm("Are you sure you want to delete the record?");
            if (x == true) {
                jQuery.post('roster_delete', {edu_level: edu_level, staff_group: staff_group, staff_type: staff_type}, function (data) {
                    alert("Data Deleted Successfully");
                    location.reload();
                });
            } else {
                location.reload();
            }
        });
    });
</script>

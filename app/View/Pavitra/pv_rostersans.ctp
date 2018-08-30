<?php
echo $this->Html->script('jquery-1.7.2');
echo $this->Html->script('jquery.ui.datepicker');
echo $this->Html->css('jquery.ui.all');
echo $this->Html->script('jquery.ui.core');
echo $this->Html->css('bootstrap.min');
echo $this->Html->script('bootstrap.min');
?>

<style>
.table{margin-bottom: 0px;}    
</style>
<script>
    $(document).ready(function () {

        $(function () {
            $("#datepicker").datepicker({
                showOn: "button",
                buttonImage: "../img/calender.gif",
                buttonImageOnly: true,
                buttonText: "Select date"
            });
        });

        $('#main_table').hide();

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
                $('#pv_rostersansVacntSum').val(p_sum);
            }
        });
        $('#pv_rostersansSancSum').val('0');
        $('#pv_rostersansWrkSum').val('0');
        $('#pv_rostersansVacntSum').val('0');
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
                $('#pv_rostersansVacntSum').val(v_sum);
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
                $('#pv_rostersansVacntSum').val(v_sum);
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
                    $('#pv_rostersansVacntSum').val(v_sum);
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

//            if (work_val > price_val) {
//                alert('Err...Teaching staff cannot be more than sanctioned post...');
//                $(this).val('0');
//                $('#vcnt_' + arr[1]).val(price_val);
//
//            }
//            else {
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
                    $('#pv_rostersansVacntSum').val(v_sum);
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
                    $('#pv_rostersansVacntSum').val(v_sum);
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
                        $('#pv_rostersansVacntSum').val(v_sum);
                    });
                }
                /*else{
                 alert("ERR...Enter the Sanctioned post for this category");
                 }*/
//            }
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
            $('#main_table').show();
            jQuery.post('get_staff_avail', {staff_group: staff_group, roster_edn_level: edu_level, tchr_type: tchr_type}, function (data) {
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
//                    $('#SamayojanVacntSum').val('0');
                    $('#pv_rostersansVacntSum').val('0');
                } else {
                    json_data();
                }
            });
        });

        $("#roster_submit").click(function () {
            var img_name_hid = $('#img_name').val();
            
            var img_path = $('#pdf_path').val();
     
           if(img_path==''){
               img_name = $('#img_name').val();
           }
           else{
              
                var img_name = $('#pdf_path').val();
                if ((img_name == ' ') || (img_name == '')) {
                    alert('Please Select jpg/jpeg file to upload');
                    return false;
                }
                var a = img_name.split(".");
                var fname1 = a[1].split("\\");
                if ((fname1 == 'jpg') || (fname1 == 'jpeg')) {
                }

                else {
                    alert('Err...Please upload jpg/jpeg file');
                    return false;
                }
           }
          
          


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
            if(edu_level=='1'){
                $("#tchr_type1").prop('disabled', false);
                $("#tchr_type2").prop('disabled', true);
            }
            else if(edu_level=='2'){
                $("#tchr_type1").prop('disabled', true);
                $("#tchr_type2").prop('disabled', false);
            }
            tchr_type = $('#tchr_type').val();
            staff_group = $('#staff_group').val();
            if (staff_group != '') {
                staff_group = staff_group;
            } else {
                staff_group = 1;
            }

            jQuery.post(window.webroot + 'Pavitras/get_roster_data', {session_user_id: session_user_id, staff_group: staff_group,
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
                                    $("#hid_dt").val(date);
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
                                    
                                    $("#flg_val").val(val);
                                    if (val === 'R') {
                                        alert("This record has been rejected by EO");
                                    }
                                    if (val === 'U') {
                                        alert("This record has been unverified by EO");
                                    }
                                    if (val === 'F') {
                                        alert("Roster already forwarded.Data cannot be changed");
                                        $("input").prop('disabled', true);
                                        $("#caste_hm_exit").prop('disabled', false);
                                        $("#roster_cancel").prop('disabled', false);
                                        
                                    }
                                    if (val === 'V') {
                                        alert("Roster data has been verified by EO. Data cannot be updated");
                                        $("input").prop('disabled', true);
                                        $("#caste_hm_exit").prop('disabled', false);
                                        $("#roster_cancel").prop('disabled', false);
                                    }
                                }
                                if(key==='roster_remarks'){
                                    var reason=val; 
                                    var flg_val=$("#flg_val").val();
                                    if(flg_val==='R'){
                                    alert("Reason for rejection :"+reason);
                                    }
                                }
                                var flg_val=$("#flg_val").val();
                                    if(flg_val==='E'){
                                        var prv_dt=$("#datepicker").val();
                                        var d = new Date()
                                        var m = d.getMonth()+1;
//                                        alert(m);
//                                        var m='11';
                                        var y = d.getFullYear();
                                       
                                       if(m=='1'||m=='2'||m=='3'){
                                           
                                           var mnth='01';
                                       }
                                       else if(m=='4'||m=='5'||m=='6'){
                                           var mnth='04';
                                       }
                                        else if(m=='7'||m=='8'||m=='9'){
                                           var mnth='07';
                                       }
                                         else if(m=='10'||m=='11'){
                                           var mnth='10';
                                       }
                                       else{
                                           
                                           var mnth='12';
                                       }
                                       
                                       var new_date='01'+"/"+mnth+"/"+y;
//                                       alert(new_date);
                                            $("#datepicker").val(new_date);
                                            $("#hid_dt").val(new_date);
                                        $("#datepicker").attr( 'readOnly' , 'true' );
                                        $("#datepicker").datepicker('disable');
                                    }
                            });
                        });
                    });
                });

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
                $('#pv_rostersansVacntSum').val(v_sum);
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

<?php echo $this->Form->create('pv_rostersans', array('url' => array('controller' => 'Pavitras', 'action' => 'roster_save'), 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="sess_val" value="<?php echo $sansthacode; ?>" id="sess_val"/> 
<?php echo $this->Form->input('uplodimg', array('label' => false, 'type' => 'hidden', 'value' => '', 'name' => 'uplodimg')); ?>
<table class="table note">
    <tr>
        <td style="padding: 2px 12px;">
            <span class="notehead"><?php echo __('Note :'); ?></span> 
        </td>
<!--        <td>
                    1.Please select a teacher who has been transfered from your school to some other school either in the same district or some other district.<br/>
                        2.After confirming please press detach button.Before detaching a teacher please confirm the data of the same teacher is verified by there cluster.<br/>
                        3.Once the teacher has been detached he will not be available for any kind of data updation in old school.<br/>
                        4.Only after detaching the same teacher will be available to that school where he is currently transfered that headmaster of school will attach the same teacher.
        </td>-->
    </tr>
</table>

<div>
    <div>
        <div class="form_content" align="center">
            <div class="map_head" style="min-height:115px;height:auto">
                <h3> Roster Form</h3>
                <div class="table-responsive">
                    <table class="table b_table" id="rostertable" style="border-collapse:collapse;">
                        <tr>
                            <td class="col-xs-2" colspan="2">Education Level <span style="float:right;font-weight:bold">:</span></td>
                            <td class="col-xs-4" colspan="4">
                                
                                    <input type="radio" name="edu_level" id="tchr_type1" value="1" >
                                    <label id="1">Primary</label>
                                
                            
                                    <input type="radio" name="edu_level" id="tchr_type2" value="2">
                                    <label id="2">Secondary / Higher Secondary</label>
                              
                            </td>

                            <td class="col-xs-2" colspan="2">Select Staff Type <span style="float:right;font-weight:bold">:</span></td>
                            <td class="col-xs-2" colspan="2"> 

                                <input type="radio" name="staff_type" id="tchr_type" value="1" checked>
                                <label id="1">Teaching Staff</label>

                            </td>
                            <td class="col-xs-2" colspan="2"></td>
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
                            <input type="hidden" id="hid_dt" name="hid_dt" value="">

                          
                               
                            <td class="col-xs-1"><input  type="submit" name="submit" id="roster_submit" value="Save" class="btn btn-sm logbutton2"></td>
                                    <!--<input  type="button" name="Delete" id="roster_Delete" value="Delete" class="logbutton2
                                    " style="float:left;margin-right:-2px;">-->
                                      <td class="col-xs-1"><input  type="button" name="cancel" id="roster_cancel" value="Cancel" class="btn btn-sm logbutton2"></td>
                                    <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm logbutton2">
                                
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div id="main_table">
                <div class="table-responsive" >
                    <table class="table table_extract" border="0" style="width:80%; background:#fff;margin-top:15px;">
                        <thead>    
                            <tr>
                                <th class="col-xs-1">Sr. No</th>
                                <th class="col-xs-2" colspan="2">Category Name </th>
                                <th class="col-xs-3" colspan="3"> Sanctioned post(As per roster) </th>
                                <th class="col-xs-3" colspan="3">Total Working Saff Approved </th>
                                <th class="col-xs-3" colspan="3">Total Excess/Vacant Staff</th>
                               <!-- <th width="33" class="th_grid" style="line-height: 15px;"> <?php //echo __('Class To');                                                                                                                                                                                                    ?> </th>-->

                            </tr>
                        </thead>
                        <tbody>
                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td class="col-xs-1">1</td>
                                <td class="col-xs-2" colspan="2">SC</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_1')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_1')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'readonly', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_1')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td class="col-xs-1">2</td>
                                <td class="col-xs-2" colspan="2">ST</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('st_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_2')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('st_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_2')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('st_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_2', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td class="col-xs-1">3</td>
                                <td class="col-xs-2" colspan="2">VJA</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('vja_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_3')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('vja_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_3')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('vja_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_3', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td class="col-xs-1">4</td>
                                <td class="col-xs-2" colspan="2">NTB</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntb_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_4')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntb_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_4')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntb_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_4', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td class="col-xs-1">5</td>
                                <td class="col-xs-2" colspan="2">NTC</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_5')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_5')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_5', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td class="col-xs-1" >6</td>
                                <td class="col-xs-2" colspan="2">NTD</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntd_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_6')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntd_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_6')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntd_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_6', 'readonly')); ?></td>

                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td   class="col-xs-1">7</td>
                                <td class="col-xs-2" colspan="2">OBC</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('obc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_7')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('obc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_7')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('obc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_7', 'readonly')); ?></td>

                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td   class="col-xs-1">8</td>
                                <td class="col-xs-2" colspan="2">SBC</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sbc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_8')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sbc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_8')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sbc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_8', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                                                                                                                                                                    ?>">
                                <td   class="col-xs-1">9</td>
                                <td class="col-xs-2" colspan="2">General</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('gen_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_9')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('gen_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_9')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('gen_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_9', 'readonly')); ?></td>
                            </tr>

                            <tr class="Subjectdtl total_col" id="<?php //echo $post['SubjectTaught']['id']; ?>">

                                <td class="col-xs-3" colspan="3" style="color:#fff;font-weight:600">Total</td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sanc_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50','readonly', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('wrk_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50','readonly', 'style' => 'width:40% !important; text-transform: uppercase;text-align:center;')); ?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('vacnt_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50','readonly', 'style' => 'width:50% !important; text-transform: uppercase;text-align:center;')); ?></td>
                            </tr>
                            <input type="hidden" id="flg_val" name="flg_val" value="">
                        </tbody>
                    </table>  
                </div>	

                <div class="table-responsive map_container" style="padding-left: 15% ! important; width: 100% ! important;">
                    <table class="table b_table">
                        <tr>
                            <td><div style="float:left;padding-top:3px;color:#000;">Roster File Upload :&nbsp;&nbsp;&nbsp;</div>
                                <?php echo $this->Form->input('pdf_path', array('type' => 'file', 'label' => '', 'id' => 'pdf_path', 'style' => 'float:left;')); ?>
                            </td>
                            <td rowspan="2">
                                <div style="width:40% ! important;padding-left:7% ! important;color:#000;" class="map_container1" >
                                    <div id="view" style="float:left;padding-top:8px;">View Rostser File : &nbsp;</div>
                                    <div id="mycontainer1">
                                    </div>   
                                    <input type="hidden" id="img_name" name="img_name" value="">
                                </div>    

                            </td>

                        </tr>
                        <tr>

                            <td style="text-align:left;padding-left:9%;">(upload only JPEG/JPG File)</td>

                        </tr>
                    </table>

                </div>

            </div>


        </div>


        <?php //echo $this->Form->end();       ?>  
    </div>

    <div class="overlay_srch" id="overlay_srch">
        <div id="search_box">


        </div>
    </div>
    <div id="img_close">
        <a id="popupBoxClose"><img style="cursor: pointer; position: absolute; right: 24%; top: 18%;" src="../img/close.png" id="exit_search" height="40" width="40" onclick='div_hide()'></a>
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

<?php
if (isset($FindedSchoolPosts)) {
    ?>
    <table width="100%" height="35px">
        <tr>
            <td>  
                <?php
                echo $this->Form->input('school_posts_code', array('options' => $FindedSchoolPosts, 'label' => false, 'empty' => '-- Select Post--',
                    'id' => 'school_posts_code', 'style' => 'width:80%;'));
                ?>         
            </td>
        </tr>
    </table> 
    <?php
}
?>

<script>
    $(document).ready(function() {
        $('#school_posts_code').on('change', function() {

            var sanstha_dist_cd = $('#sanstha_dist_cd :selected').val();
            var option_schl_type = $('#option_schl_type :selected').val();
            var school_medium_code = $('#school_medium_code :selected').val();
            var schl_id = $('#schl_id :selected').val();
            var schl_name = $('#schl_name').val();
            var school_posts_code = $('#school_posts_code :selected').val();
            if (sanstha_dist_cd == '') {
                alert("Please Select District.");
            }
            else if (option_schl_type == '') {
                alert("Please Select School Type.");
            }
            else if (schl_id == '' || schl_name == '') {
                alert("Please Enter Valid School Code.");
            }
            else if (school_medium_code == '') {
                $('#sanch_total').val('');
                $('#proposed_total').val('');
                $('#sanch_proposed_total').val('');
                $('#eos_online_posts').val('');
                $('#eos_offline_posts').val(0);
                $('#eos_online_offline_tot_posts').val('');
                $('#excess_vacant_cal_posts').val('');
                $('#no_of_excess_vancant_posts').val('');
                $('#option_subject_code').val('');
                alert("Please Select Medium.");
            }
            else if (school_posts_code == '') {
                alert("Please Select Post.");
            }
            else {
                var school_medium_code = $('#school_medium_code :selected').val();
                var school_posts_code = $('#school_posts_code :selected').val();
                var schcode = $('#schl_id').val();
                jQuery.post('SelectExcessVacantRadio', {school_medium_code: school_medium_code, school_posts_code: school_posts_code, schcode: schcode}, function(data) {

                    $('#sanch_total').val('');
                    $('#proposed_total').val('');
                    $('#sanch_proposed_total').val('');
                    $('#no_of_excess_vancant_posts').val('');
                    $('#option_subject_code').val('');
                    $('#excess_vacant_cal_posts').val('');
                    $('#reservation_category').val('');

                    if (school_posts_code == '4' || school_posts_code == '5') {
                        var len = $("#option_subject_code").length;

                        for (var i = 0; i < len; i++) {
                            $("#option_subject_code option").show();
                        }
                        $("#option_subject_code option[value=" + 0 + "]").hide();
                    }
                    else {
                        var len = $("#option_subject_code").length;

                        for (var i = 0; i < len; i++) {
                            $("#option_subject_code option").hide();
                        }
                        $("#option_subject_code option[value=" + 0 + "]").show();
                    }

                    $.each(jQuery.parseJSON(data), function(i, obj) {
                        if (i == 'filled_no_of_excess_vancant_posts_hidden') {
                            window.filled_no_of_excess_vancant_posts_hidden = obj;
                            $('#filled_no_of_excess_vancant_posts_hidden').val(window.filled_no_of_excess_vancant_posts_hidden);
                        }
                        if (i == 'sanch_total') {
                            $('#sanch_total').val(obj);
                            window.sanch_total = Number(obj);
                        }
                        if (i == 'proposed_total') {
                            $('#proposed_total').val(obj);
                            var proposed_total = obj;
                            var sanch_proposed_total = (Number($('#sanch_total').val()) + Number($('#proposed_total').val()));
                            $('#sanch_proposed_total').val(sanch_proposed_total);
                        }
                        if (i == 'filled_data' && obj != '0') {
                            var tr = '';
                            var counter = 1;
                            $.each(obj, function(key, val) {
                                window.eos_online_posts = Number($.trim(val['0']['eos_online_posts']));
                                window.shifted_tchr_cnt = Number($.trim(val['0']['shifted_tchr_cnt']));
                                window.eos_offline_posts = Number($.trim(val['0']['eos_offline_posts']));
                                window.asst_flag = $.trim(val['0']['asst_flag']);
                                window.consider_vacancy_flag = $.trim(val['0']['consider_vacancy_flag']);
                                window.vac_crd_aft_smj = $.trim($.trim(val['0']['vac_crd_aft_smj']));
                                $('#aid_type').val($.trim(val['0']['aid_type_value']));
                                $('#option_subject_code').val($.trim(val['0']['eos_subject_cd']));

                                var radios = $.trim(val['0']['staff_type']);
                                if (radios === '1') {
                                    $("input[value='1']").prop('checked', true);
                                }
                                else {
                                    $("input[value='2']").prop('checked', true);
                                }
                                $('#no_of_excess_vancant_posts').val(val['0']['eos_no_of_post']);


                                var tr_id = $.trim(val['0']['dist_code']) + '~' + $.trim(val['0']['schl_type']) + '~' + $.trim(val['0']['eo_code']) + '~' + $.trim(val['0']['sanstha_code']) + '~' + $.trim(val['0']['schl_id']) + '~' + $.trim(val['0']['eos_medium_id']) + '~' + $.trim(val['0']['eos_desg_cd']) + '~' + $.trim(val['0']['eos_type']) + '~' + $.trim(val['0']['eos_online_posts']) + '~' + $.trim(val['0']['eos_offline_posts']) + '~' + $.trim(val['0']['eos_no_of_post']) + '~' + $.trim(val['0']['eos_subject_cd']) + '~' + $.trim(val['0']['asst_flag']) + '~' + ($.trim(val['0']['consider_vacancy_flag']) + '~' + ($.trim(val['0']['aid_type_value'])));
//                                tr += '<tr id=' + tr_id + '> <td class="col-xs-1">' + counter + '</td><td class="col-xs-4" colspan="4">' + val['0']['school_name'] + '</td><td class="col-xs-1">' + val['0']['post_desc'] + '</td><td class="col-xs-1">' + val['0']['medinstr_desc'] + '</td><td class="col-xs-1">' + val['0']['code_text'] + '</td><td class="col-xs-2" colspan="2">' + val['0']['eos_no_of_post'] + '</td><td class="col-xs-2" colspan="2">' + val['0']['aid_type'] + '</td><td class="col-xs-1"><input name="modify_btn" class="btn btn-sm logbutton2" type=button onclick="modify_btn_clicked(this)" value=Modify id=' + tr_id + '></td></tr>'
//                                <input name="delete_btn" class="btn btn-sm logbutton2" type=button onclick="delete_btn_click(this)" value=Delete id=' + tr_id + '>
                                tr += '<tr id=' + tr_id + '> <td class="col-xs-1">' + counter + '</td><td class="col-xs-1">' + val['0']['distname'] + '</td><td class="col-xs-4" colspan="4">' + val['0']['school_name'] + '</td><td class="col-xs-1">' + val['0']['post_desc'] + '</td><td class="col-xs-1">' + val['0']['medinstr_desc'] + '</td><td class="col-xs-1">' + val['0']['code_text'] + '</td><td class="col-xs-1" colspan="1">' + val['0']['eos_no_of_post'] + '</td><td class="col-xs-2" colspan="2">' + val['0']['aid_type'] + '</td><td class="col-xs-1"><input name="modify_btn" class="btn btn-sm logbutton2" type=button onclick="modify_btn_clicked(this)" value=Modify id=' + tr_id + '></td></tr>'
                                counter++;

                            });
                            $('#excess_vacancy_detail_tbl tbody').html('');
                            $('#excess_vacancy_detail_tbl tbody').html(tr);
                            if (tr != '') {
                                $('#vac_cr_during').val(0);
                                $('#eos_online_posts').val(window.eos_online_posts);
                                $('#eos_offline_posts').val(window.eos_offline_posts);
                                $('#post_filld_smj').val(window.shifted_tchr_cnt);
                                $('#vac_cr_during').val(window.vac_crd_aft_smj);
                                if (window.vac_crd_aft_smj == '') {
                                    window.vac_crd_aft_smj = 0;
                                }
                                var abc = (parseInt(window.sanch_total) - parseInt(window.eos_online_posts + window.shifted_tchr_cnt));
                                var total_vac = parseInt(window.vac_crd_aft_smj + parseInt(parseInt(window.sanch_total) - parseInt(window.eos_online_posts + window.shifted_tchr_cnt)));
//                                        (parseInt(window.vac_crd_aft_smj) + parseInt(window.sanch_total - (window.eos_online_posts + window.shifted_tchr_cnt)));
//                                alert(total_vac);
//                                alert(window.vac_crd_aft_smj);
//                                alert(window.sanch_total);
//                                alert(window.eos_online_posts);
//                                alert(window.shifted_tchr_cnt);

                                document.getElementById('total_vac_posts').value = total_vac;
                                var eos_online_offline_tot_posts = window.eos_online_posts + window.eos_offline_posts;

                                $('#eos_online_offline_tot_posts').val(eos_online_offline_tot_posts);
                                if (window.sanch_total > eos_online_offline_tot_posts) {//Vacant
                                    var radio_value = '2';
                                    $('#excess_vacant_cal_posts_text').text('Vacant');
                                    $('#enter_no_of_posts_span').text('Vacant');
                                    document.getElementById('excess_vacant_cal_posts').value = abc;
                                    $('#post_under_grad_tr').show();
                                    var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();
                                    if (get_sanstha_minority_type_hidden == '1') {

                                        $('#consider_vacancy_flag_tr').hide();
                                    }
                                    else if (get_sanstha_minority_type_hidden == '2') {

                                        $('#consider_vacancy_flag_tr').show();

                                        if (typeof window.consider_vacancy_flag !== 'undefined') {
                                            // your code here
                                            if (window.consider_vacancy_flag === 'Y') {
                                                $('#SamayojanConsiderVacancyMinorityY').prop('checked', true);
                                            } else {
                                                $('#SamayojanConsiderVacancyMinorityN').prop('checked', true);
                                            }
                                        }
                                    }
                                }
                            }
                            else {
                                $('#eos_online_posts').val(0);
                                $('#eos_offline_posts').val(0);
                                $('#eos_online_offline_tot_posts').val(0);
                                $('#excess_vacant_cal_posts_text').text('');
                                $('#post_under_grad_tr').show();
                                $('#filled_no_of_excess_vancant_posts_hidden').val(0);
                            }
                            if (window.asst_flag == 'R') {
                                alert("Data has been Rejected by EO");
                            }
                        }

                        if (i == 'filled_data' && obj == '0') {
                            var tr = '';
                            var counter = 1;
                            $('#vac_cr_during').attr('readonly', true);
                            $('#vac_cr_during').val('0');
                            $('#post_filld_smj').val('0');
                            $('#excess_vacant_cal_posts').val('0');
                            $('#total_vac_posts').val('0');



                        }
                    });
                    $('#vac_cr_during').on('focusout', function() {
                        var sanch_proposed_total = Number($('#sanch_proposed_total').val());
                        var sanch_total = Number($('#sanch_total').val());
                        var eos_online_posts = Number($('#eos_online_posts').val());
                        var eos_offline_posts = Number($('#eos_offline_posts').val());
                        var post_filld_smj = Number($('#post_filld_smj').val());
                        var vac_cr_during = Number($('#vac_cr_during').val());
                        var eos_online_offline_tot_posts = eos_online_posts + eos_offline_posts;
                        $('#eos_online_offline_tot_posts').val(eos_online_offline_tot_posts);
                        var aftersamayojanvac = sanch_total - (eos_online_offline_tot_posts + post_filld_smj);
                        var total_vacancy = (vac_cr_during + aftersamayojanvac);
                        if (total_vacancy >= sanch_total) {
                            alert("Err...Total Vanacy can not be greater than sancha sanctioned post.");
                            $('#vac_cr_during').val(0);
                            var sanch_proposed_total = Number($('#sanch_proposed_total').val());
                            var sanch_total = Number($('#sanch_total').val());
                            var eos_online_posts = Number($('#eos_online_posts').val());
                            var eos_offline_posts = Number($('#eos_offline_posts').val());
                            var post_filld_smj = Number($('#post_filld_smj').val());
                            var vac_cr_during = Number($('#vac_cr_during').val());
                            var eos_online_offline_tot_posts = eos_online_posts + eos_offline_posts;
                            $('#eos_online_offline_tot_posts').val(eos_online_offline_tot_posts);
                            var aftersamayojanvac = sanch_total - (eos_online_offline_tot_posts + post_filld_smj);
                            var total_vacancy = (vac_cr_during + aftersamayojanvac);
                            document.getElementById('total_vac_posts').value = total_vacancy;
                        }
                    });

                });
            }
//            $('#eos_online_posts').focus();
        });

        $('#eos_online_posts').on('focusout', function() {
            var sanch_total = $('#sanch_total').val();
            var proposed_total = $('#proposed_total').val();
            var sanch_proposed_total = $('#sanch_proposed_total').val();
            var eos_online_posts = $('#eos_online_posts').val();
            var eos_offline_posts = $('#eos_offline_posts').val();
            var Alphapattern = /^[0-9]+$/;
            if (Alphapattern.test(eos_online_posts) == false) {
                alert('Please Enter Only Digits.');
            }
            else if (sanch_total == '') {
                alert('No Entry for Sanction Post as per Sanch Manayata');
            }
            else if (proposed_total == '') {
                alert('No Entry for Proposed Post as per Sanch Manayata');
            }
            else if (sanch_proposed_total == '') {
                alert('No Entry for Total in Sanch Manayata');
            }
            else if (eos_online_posts == '') {
                alert('Enter Working Posts as per payment - Online ');
            }
            else if (eos_offline_posts == '') {
                alert('Enter Working Posts as per payment - Offline ');
            }
            else {
                var sanch_proposed_total = Number($('#sanch_proposed_total').val());
                var sanch_total = Number($('#sanch_total').val());
                var eos_online_posts = Number($('#eos_online_posts').val());
                var shifted_tchr_cnt = $('#post_filld_smj').val();
                var vac_crd_aft_smj = $('#vac_cr_during').val();
                var excess_vacant_cal_posts = $('#excess_vacant_cal_posts').val();
                var total_vac = (sanch_total - eos_online_posts);

                if (sanch_total > eos_online_posts) {//Vacant
                    var radio_value = '2';
                    $('#excess_vacant_cal_posts_text').text('Vacant');
                    $('#enter_no_of_posts_span').text('Vacant');               
                    document.getElementById('excess_vacant_cal_posts').value = total_vac;
                    document.getElementById('total_vac_posts').value = total_vac;
                    $('#post_under_grad_tr').show();
                    var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();
                    if (get_sanstha_minority_type_hidden == '1') {

                        $('#consider_vacancy_flag_tr').hide();
                    }
                    else if (get_sanstha_minority_type_hidden == '2') {

                        $('#consider_vacancy_flag_tr').show();

                        if (typeof window.consider_vacancy_flag !== 'undefined') {
                            // your code here
                            if (window.consider_vacancy_flag === 'Y') {
                                $('#SamayojanConsiderVacancyMinorityY').prop('checked', true);
                            } else {
                                $('#SamayojanConsiderVacancyMinorityN').prop('checked', true);
                            }
                        }
                    }
                }
            }
        });

        $('#no_of_excess_vancant_posts').on('focusout', function() {
            var no_of_excess_vancant_posts = Number($('#no_of_excess_vancant_posts').val());
            var excess_vacant_cal_posts = Number($('#total_vac_posts').val());
            var save_modify_delete = ($('#save_modify_delete').val());

            var Alphapattern = /^[0-9]+$/;
            if (Alphapattern.test(no_of_excess_vancant_posts) == false) {
                alert('Please Enter Only Digits.');
            }
            else if (no_of_excess_vancant_posts == '') {
                alert('Please Enter No.of Posts');
            }
            else if (no_of_excess_vancant_posts > excess_vacant_cal_posts) {
                alert('Please Enter Valid No.of Posts');
                $('#no_of_excess_vancant_posts2').focus();
            }
            if (save_modify_delete == 'Modify') {
                if ((no_of_excess_vancant_posts) > excess_vacant_cal_posts) {
                    alert('Please Enter Valid No.of Posts');
                    $('#no_of_excess_vancant_posts3').focus();
                }
            }
            else {
                if ((no_of_excess_vancant_posts) > excess_vacant_cal_posts) {
                    alert('Please Enter Valid No.of Posts');
                    $('#no_of_excess_vancant_posts3').focus();
                }
            }
        });

        $('#school_medium_code').on('change', function() {
            $('#school_posts_code').val('');
        });
    });

    function modify_btn_clicked(obj) {
        $('#save_modify_delete').val('Modify');
        $('#save_modify_delete_id').val(obj.id);
        $('#school_posts_code').click();
        var sanch_proposed_total = Number($('#sanch_proposed_total').val());
        var arr = obj.id.split('~');
        var asst_flag = arr[12];
        var get_sanstha_minority_type_hidden = arr[13];
//        alert(arr[14]);
        if (asst_flag == 'F') {
            alert("Data has been Forwarded To EO.So you Can not modify it. ");
        }
        else if (asst_flag == 'R') {
            alert("Data has been Rejected by EO.");

            $('#aid_type').val(arr[14]);
            $('#school_medium_code').val(arr[5]);
            $('#school_posts_code').val(arr[6]);
            var sanch_proposed_total = Number($('#sanch_proposed_total').val());
            $('#eos_online_posts').val(arr[8]);
            $('#eos_offline_posts').val(arr[9]);
            var eos_online_offline_tot_posts = Number(arr[8]) + Number(arr[9]);

            if (sanch_proposed_total > eos_online_offline_tot_posts) {//VACANT
                var radio_value = '2';
                var value = sanch_proposed_total - eos_online_offline_tot_posts;
                $('#excess_vacant_cal_posts_text').text('Vacant');
                document.getElementById('excess_vacant_cal_posts').value = value;
                var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();
                if (get_sanstha_minority_type_hidden == '1') {
                    $('#consider_vacancy_flag_tr').hide();
                }
                else if (get_sanstha_minority_type_hidden == '2') {
                    $('#consider_vacancy_flag_tr').show();
                    if (typeof arr[13] !== 'undefined') {

                        if (arr[13] === 'Y') {
                            $('#SamayojanConsiderVacancyMinorityY').prop('checked', true);
                        } else {
                            $('#SamayojanConsiderVacancyMinorityN').prop('checked', true);
                        }
                    }
                }
            }
            $('#option_subject_code').val(arr[11]);
            $('#no_of_excess_vancant_posts').val(arr[10]);
        }
        else if (asst_flag == 'V') {
            alert("Data has been Verified by EO.So you Can not modify it. ");
        }
        else if (asst_flag == 'A') {
            alert("Data has been Approved by EO.So you Can not modify it. ");
        }
        else if (asst_flag == 'Z' || asst_flag == 'C') {
            alert("This data is Filled / Updated by EO.So you Can not modify it. ");
        }
        else {
//            alert(arr);
            $('#aid_type').val(arr[14]);
            $('#school_medium_code').val(arr[5]);
            $('#school_posts_code').val(arr[6]);
            var sanch_proposed_total = Number($('#sanch_proposed_total').val());
            $('#eos_online_posts').val(arr[8]);
            $('#eos_offline_posts').val(arr[9]);
            var eos_online_offline_tot_posts = Number(arr[8]) + Number(arr[9]);

            if (sanch_proposed_total > eos_online_offline_tot_posts) {//VACANT
                var radio_value = '2';
                var value = sanch_proposed_total - eos_online_offline_tot_posts;
                $('#excess_vacant_cal_posts_text').text('Vacant');
                document.getElementById('excess_vacant_cal_posts').value = value;
                var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();
                if (get_sanstha_minority_type_hidden == '1') {
                    $('#consider_vacancy_flag_tr').hide();
                }
                else if (get_sanstha_minority_type_hidden == '2') {
                    $('#consider_vacancy_flag_tr').show();
                    if (typeof arr[13] !== 'undefined') {

                        if (arr[13] === 'Y') {
                            $('#SamayojanConsiderVacancyMinorityY').prop('checked', true);
                        } else {
                            $('#SamayojanConsiderVacancyMinorityN').prop('checked', true);
                        }
                    }
                }
            }
            $('#option_subject_code').val(arr[11]);
            $('#no_of_excess_vancant_posts').val(arr[10]);
        }
    }

</script>
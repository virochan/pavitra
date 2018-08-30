window.schl_id = '';
window.tchr_type = '';
window.tchr_type_main = '';
window.schl_name_selected = '';
window.schl_id_hm = '';
window.tchr_type_hm = '';
window.tchr_type_main_hm = '';
window.schl_name_selected_hm = '';
window.tchr_type_main_beo = '';
$(document).ready(function() {
    $('#mapping_reports_print').hide();
    $('#printreport').hide();
    $('#mapping_reports_hm_print').hide();
    $('#printreporthm').hide();
    $("#GoMappingReport").click(function() {
//        if ($('#tchr_type').is(':checked')) {
        window.tchr_type_main = $('#tchr_type:checked').val();
        jQuery.post('view_st_staff_mapped_stat_report', {tchr_type: tchr_type_main}, function(data) {
            $('#all_mapped_report_div').html(data);
            $('#mapped_list_report_div').hide();
            $('#mapping_reports_print').hide();
            $("#all_mapped_report tbody").delegate("tr", "click", function() {
//           alert("TR");
                var arr = $(this).attr('id');
                var arr1 = arr.split('~');
//                alert(arr1);
                window.schl_id = arr1[0]
                window.tchr_type = arr1[1];
                window.schl_name_selected = arr1[2];
                $("#all_mapped_report td:nth-child(2)").live("click", function() {
                    $('#mapped_list_report_div').html("");
                    $('#schl_id').val(window.schl_id);
                    $('#schl_name_selected').val(window.schl_name_selected);
                    $('#asst_flag_report').val('A');
                    $('#tchr_type_main_report').val(window.tchr_type_main);
                    $('#tchr_type_report').val(window.tchr_type);
                    jQuery.post('mapped_list_report', {schl_id: window.schl_id, asst_flag: 'A', tchr_type_main: tchr_type_main, tchr_type: window.tchr_type}, function(data) {
                        $('#mapped_list_report_div').html(data);
                        $('#mapped_list_report_div').show();
                        $('#printreport').show();
                        $('#mapping_reports_print').show();
                    });
                });
                $("#all_mapped_report td:nth-child(4)").live("click", function() {
//                    alert(window.schl_id +"   "+window.tchr_type);
                    $('#mapped_list_report_div').html("");
                    $('#schl_id').val(window.schl_id);
                    $('#schl_name_selected').val(window.schl_name_selected);
                    $('#asst_flag_report').val('M');
                    $('#tchr_type_main_report').val(window.tchr_type_main);
                    $('#tchr_type_report').val(window.tchr_type);
                    jQuery.post('mapped_list_report', {schl_id: window.schl_id, asst_flag: 'M', tchr_type_main: tchr_type_main, tchr_type: window.tchr_type}, function(data) {
                        $('#mapped_list_report_div').html(data);
                        $('#mapped_list_report_div').show();
                        $('#printreport').show();
                        $('#mapping_reports_print').show();
                    });
                });
                $("#all_mapped_report td:nth-child(5)").live("click", function() {
                    $('#mapped_list_report_div').html("");
                    $('#schl_id').val(window.schl_id);
                    $('#schl_name_selected').val(window.schl_name_selected);
                    $('#asst_flag_report').val('U');
                    $('#tchr_type_main_report').val(window.tchr_type_main);
                    $('#tchr_type_report').val(window.tchr_type);
                    jQuery.post('mapped_list_report', {schl_id: window.schl_id, asst_flag: 'U', tchr_type_main: tchr_type_main, tchr_type: window.tchr_type}, function(data) {
                        $('#mapped_list_report_div').html(data);
                        $('#mapped_list_report_div').show();
                        $('#printreport').show();
                        $('#mapping_reports_print').show();
                    });
                });
                $("#all_mapped_report td:nth-child(6)").live("click", function() {
                    $('#mapped_list_report_div').html("");
                    $('#schl_id').val(window.schl_id);
                    $('#schl_name_selected').val(window.schl_name_selected);
                    $('#asst_flag_report').val('F');
                    $('#tchr_type_main_report').val(window.tchr_type_main);
                    $('#tchr_type_report').val(window.tchr_type);
                    jQuery.post('mapped_list_report', {schl_id: window.schl_id, asst_flag: 'F', tchr_type_main: tchr_type_main, tchr_type: window.tchr_type}, function(data) {
                        $('#mapped_list_report_div').html(data);
                        $('#mapped_list_report_div').show();
                        $('#printreport').show();
                        $('#mapping_reports_print').show();
                    });
                });
                $("#all_mapped_report td:nth-child(7)").live("click", function() {
                    $('#mapped_list_report_div').html("");
                    $('#schl_id').val(window.schl_id);
                    $('#schl_name_selected').val(window.schl_name_selected);
                    $('#asst_flag_report').val('V');
                    $('#tchr_type_main_report').val(window.tchr_type_main);
                    $('#tchr_type_report').val(window.tchr_type);
                    jQuery.post('mapped_list_report', {schl_id: window.schl_id, asst_flag: 'V', tchr_type_main: tchr_type_main, tchr_type: window.tchr_type}, function(data) {
                        $('#mapped_list_report_div').html(data);
                        $('#mapped_list_report_div').show();
                        $('#printreport').show();
                        $('#mapping_reports_print').show();
                    });
                });
            });
        });
//        }
//        else {
//            alert("Please Select One Option");
//        }
    });
    
    $("#mapping_reports_print").click(function() {
        $("#TeacherMappingReportForm").submit(); //MappingReportPdf()
    });
    
     $("#mapping_reports_beo_print").click(function() {
         alert("114");
        $("#TeacherMappingBeoReportForm").submit(); //MappingReportPdfBeo()
    });
    
    $("#GoMappingReportHeadMaster").click(function() {
        window.tchr_type_main_hm = $('#tchr_type_hm:checked').val();
        jQuery.post('view_st_staff_mapped_stat_report_headmaster', {tchr_type_hm: tchr_type_main_hm}, function(data) {
            $('#all_mapped_report_hm_div').html(data);
            $('#mapped_list_report_hm_div').hide();
            $('#mapping_reports_hm_print').hide();
            $("#all_mapped_report_hm tbody").delegate("tr", "click", function() {
//           alert("TR");
                var arr = $(this).attr('id');
                var arr1 = arr.split('~');
//                alert(arr1);
                window.schl_id_hm = arr1[0]
                window.tchr_type_hm = arr1[1];
                window.schl_name_selected_hm = arr1[2];
                $("#all_mapped_report_hm td:nth-child(2)").live("click", function() {
                    $('#mapped_list_report_hm_div').html("");
                    $('#schl_id_hm').val(window.schl_id_hm);
                    $('#schl_name_selected_hm').val(window.schl_name_selected_hm);
                    $('#asst_flag_report_hm').val('A');
                    $('#tchr_type_main_report_hm').val(window.tchr_type_main_hm);
                    $('#tchr_type_report_hm').val(window.tchr_type_hm);
                    jQuery.post('mapped_list_report_head_master', {schl_id_hm: window.schl_id_hm, asst_flag_hm: 'A', tchr_type_main_hm: tchr_type_main_hm, tchr_type_hm: window.tchr_type_hm}, function(data) {
                        $('#mapped_list_report_hm_div').html(data);
                        $('#mapped_list_report_hm_div').show();
                        $('#printreporthm').show();
                        $('#mapping_reports_hm_print').show();
                    });
                });
                $("#all_mapped_report_hm td:nth-child(4)").live("click", function() {
//                    alert(window.schl_id_hm +"   "+window.tchr_type_hm);
                    $('#mapped_list_report_hm_div').html("");
                    $('#schl_id_hm').val(window.schl_id_hm);
                    $('#schl_name_selected_hm').val(window.schl_name_selected_hm);
                    $('#asst_flag_report_hm').val('M');
                    $('#tchr_type_main_report_hm').val(window.tchr_type_main_hm);
                    $('#tchr_type_report_hm').val(window.tchr_type_hm);
                    jQuery.post('mapped_list_report_head_master', {schl_id_hm: window.schl_id_hm, asst_flag_hm: 'M', tchr_type_main_hm: tchr_type_main_hm, tchr_type_hm: window.tchr_type_hm}, function(data) {
                        $('#mapped_list_report_hm_div').html(data);
                        $('#mapped_list_report_hm_div').show();
                        $('#printreporthm').show();
                        $('#mapping_reports_hm_print').show();
                    });
                });
                $("#all_mapped_report_hm td:nth-child(5)").live("click", function() {
                    $('#mapped_list_report_hm_div').html("");
                    $('#schl_id_hm').val(window.schl_id_hm);
                    $('#schl_name_selected_hm').val(window.schl_name_selected_hm);
                    $('#asst_flag_report_hm').val('U');
                    $('#tchr_type_main_report_hm').val(window.tchr_type_main_hm);
                    $('#tchr_type_report_hm').val(window.tchr_type_hm);
                    jQuery.post('mapped_list_report_head_master', {schl_id_hm: window.schl_id_hm, asst_flag_hm: 'U', tchr_type_main_hm: tchr_type_main_hm, tchr_type_hm: window.tchr_type_hm}, function(data) {
                        $('#mapped_list_report_hm_div').html(data);
                        $('#mapped_list_report_hm_div').show();
                        $('#printreporthm').show();
                        $('#mapping_reports_hm_print').show();
                    });
                });
                $("#all_mapped_report_hm td:nth-child(6)").live("click", function() {
                    $('#mapped_list_report_hm_div').html("");
                    $('#schl_id_hm').val(window.schl_id_hm);
                    $('#schl_name_selected_hm').val(window.schl_name_selected_hm);
                    $('#asst_flag_report_hm').val('F');
                    $('#tchr_type_main_report_hm').val(window.tchr_type_main_hm);
                    $('#tchr_type_report_hm').val(window.tchr_type_hm);
                    jQuery.post('mapped_list_report_head_master', {schl_id_hm: window.schl_id_hm, asst_flag_hm: 'F', tchr_type_main_hm: tchr_type_main_hm, tchr_type_hm: window.tchr_type_hm}, function(data) {
                        $('#mapped_list_report_hm_div').html(data);
                        $('#mapped_list_report_hm_div').show();
                        $('#printreporthm').show();
                        $('#mapping_reports_hm_print').show();
                    });
                });
                $("#all_mapped_report_hm td:nth-child(7)").live("click", function() {
                    $('#mapped_list_report_hm_div').html("");
                    $('#schl_id_hm').val(window.schl_id_hm);
                    $('#schl_name_selected_hm').val(window.schl_name_selected_hm);
                    $('#asst_flag_report_hm').val('V');
                    $('#tchr_type_main_report_hm').val(window.tchr_type_main_hm);
                    $('#tchr_type_report_hm').val(window.tchr_type_hm);
                    jQuery.post('mapped_list_report_head_master', {schl_id_hm: window.schl_id_hm, asst_flag_hm: 'V', tchr_type_main_hm: tchr_type_main_hm, tchr_type_hm: window.tchr_type_hm}, function(data) {
                        $('#mapped_list_report_hm_div').html(data);
                        $('#mapped_list_report_hm_div').show();
                        $('#printreporthm').show();
                        $('#mapping_reports_hm_print').show();
                    });
                });
            });
        });
    });
    $("#mapping_reports_hm_print").click(function() {
        $("#TeacherMappingHmReportForm").submit(); //MappingReportPdf()
    });

    $("#GoMappingReportBeo").click(function() {
        window.tchr_type_main_beo = $('#tchr_type_beo:checked').val();
        alert(window.tchr_type_main_beo);
        jQuery.post('view_st_staff_mapped_stat_report_beo', {tchr_type_beo: tchr_type_main_beo}, function(data) {
            $('#all_mapped_report_beo_div').html(data);
            $('#mapped_list_report_beo_div').hide();
             $('#mapped_list_report_beo_tchr_info').hide();
            $('#mapping_reports_beo_print').hide();//btn 
            
            

            $("#all_mapped_report_beo tbody").delegate("tr", "click", function(evt) {
                alert("TR CLUSTER NAME CLICKED");
                var arr = $(this).attr('id');
                var arr1 = arr.split('~');
//                alert(arr +"\n"+ arr1); //2728010001,1,2728010001
                window.clu_id = arr1[0] //2728010001
                window.tchr_type = arr1[1]; //1
                window.clu_name_selected = arr1[2]; //2728010001

                var $cell = $(evt.target).closest('td');
//                $("#all_mapped_report_beo td:nth-child(2)").live("click", function() {
                if ($cell.index() == 1) {
                    $('#mapped_list_report_beo_div').html("");
                    jQuery.post('mapped_list_report_beo', {clu_id: window.clu_id, asst_flag: 'A', tchr_type: window.tchr_type, tchr_type_main_beo: tchr_type_main_beo}, function(data) {
                        $('#mapped_list_report_beo_div').html(data);
                        $('#mapped_list_report_beo_div').show();

                        $("#all_mapped_report_schname_beo tbody").delegate("tr", "click", function(evt) {
                            alert("Clicked on School name");

                            var arr = $(this).attr('id');
                            var arr1 = arr.split('~');

                            window.schl_id = arr1[0]
                            window.tchr_type = arr1[1];
                            window.schl_name_selected = arr1[2];

                            $("#all_mapped_report_schname_beo td:nth-child(2)").live("click", function() {
                                alert("Second TD 22222.......");
                                $('#mapped_list_report_beo_tchr_info').html("");
                                $('#schl_id_beo').val(window.schl_id);
                                $('#schl_name_selected_beo').val(window.schl_name_selected);
                                $('#asst_flag_report_beo').val('A');
                                $('#tchr_type_main_report_beo').val(window.tchr_type_main_beo);
                                $('#tchr_type_report_hm').val(window.tchr_type);

                                jQuery.post('mapped_list_final_report_beo', {schl_id: window.schl_id, asst_flag: 'A',
                                    tchr_type_main: tchr_type_main_beo, tchr_type: window.tchr_type}, function(data) {
                                    $('#mapped_list_report_beo_tchr_info').html(data);
                                    $('#mapped_list_report_beo_tchr_info').show();
                                    $('#printreportbeo').show();//div
                                    $('#mapping_reports_beo_print').show();//btn
                                });

                                $("#all_mapped_report_schname_beo td:nth-child(4)").live("click", function() {
                                    alert("Second TD 4444 MMMMMMMM.......");
                                    $('#mapped_list_report_beo_tchr_info').html("");
                                    $('#schl_id_beo').val(window.schl_id);
                                    $('#schl_name_selected_beo').val(window.schl_name_selected);
                                    $('#asst_flag_report_beo').val('M');
                                    $('#tchr_type_main_report_beo').val(window.tchr_type_main_beo);
                                    $('#tchr_type_report_hm').val(window.tchr_type);
                                    jQuery.post('mapped_list_final_report_beo', {schl_id: window.schl_id, asst_flag: 'M',
                                        tchr_type_main: tchr_type_main_beo, tchr_type: window.tchr_type}, function(data) {
                                        $('#mapped_list_report_beo_tchr_info').html(data);
                                        $('#mapped_list_report_beo_tchr_info').show();
                                        $('#printreportbeo').show();//div
                                        $('#mapping_reports_beo_print').show();//btn
                                    });
                                });
                                $("#all_mapped_report_schname_beo td:nth-child(5)").live("click", function() {
                                    alert("Second TD 55555555 UUUUUUUU.......");
                                    $('#mapped_list_report_beo_tchr_info').html("");
                                    $('#schl_id_beo').val(window.schl_id);
                                    $('#schl_name_selected_beo').val(window.schl_name_selected);
                                    $('#asst_flag_report_beo').val('U');
                                    $('#tchr_type_main_report_beo').val(window.tchr_type_main_beo);
                                    $('#tchr_type_report_hm').val(window.tchr_type);
                                    jQuery.post('mapped_list_final_report_beo', {schl_id: window.schl_id, asst_flag: 'U',
                                        tchr_type_main: tchr_type_main_beo, tchr_type: window.tchr_type}, function(data) {
                                        $('#mapped_list_report_beo_tchr_info').html(data);
                                        $('#mapped_list_report_beo_tchr_info').show();
                                        $('#printreportbeo').show(); //div
                                        $('#mapping_reports_beo_print').show(); //btn
                                    });
                                });
                                $("#all_mapped_report_schname_beo td:nth-child(6)").live("click", function() {
                                    alert("Second TD 66666 FFFFFFF.......");
                                    $('#mapped_list_report_beo_tchr_info').html("");
                                    $('#schl_id_beo').val(window.schl_id);
                                    $('#schl_name_selected_beo').val(window.schl_name_selected);
                                    $('#asst_flag_report_beo').val('F');
                                    $('#tchr_type_main_report_beo').val(window.tchr_type_main_beo);
                                    $('#tchr_type_report_hm').val(window.tchr_type);

                                    jQuery.post('mapped_list_final_report_beo', {schl_id: window.schl_id, asst_flag: 'F',
                                        tchr_type_main: tchr_type_main_beo, tchr_type: window.tchr_type}, function(data) {
                                        $('#mapped_list_report_beo_tchr_info').html(data);
                                        $('#mapped_list_report_beo_tchr_info').show();
                                        $('#printreportbeo').show(); //div
                                        $('#mapping_reports_beo_print').show(); //btn
                                    });
                                });
                                $("#all_mapped_report_schname_beo td:nth-child(7)").live("click", function() {
                                    alert("Second TD 7777777 VVVVVV.......");
                                    $('#mapped_list_report_beo_tchr_info').html("");
                                    $('#schl_id_beo').val(window.schl_id);
                                    $('#schl_name_selected_beo').val(window.schl_name_selected);
                                    $('#asst_flag_report_beo').val('V');
                                    $('#tchr_type_main_report_beo').val(window.tchr_type_main_beo);
                                    $('#tchr_type_report_hm').val(window.tchr_type);
                                    jQuery.post('mapped_list_final_report_beo', {schl_id: window.schl_id, asst_flag: 'V',
                                        tchr_type_main: tchr_type_main_beo, tchr_type: window.tchr_type}, function(data) {
                                        $('#mapped_list_report_beo_tchr_info').html(data);
                                        $('#mapped_list_report_beo_tchr_info').show();
                                        $('#printreportbeo').show(); //div
                                        $('#mapping_reports_beo_print').show(); //btn
                                    });
                                });



                            });

                        });





                    });
                }

            });
        });
    });
    /*---------------- mayuri ---------------- */
    $("#GoReligionReport").click(function() {
        $("#school_id").val = '';
        $("#cast_category").val = '';
        $("#tchr_t").val = '';
        $('#tchr_religion_report_wrapper').hide();
        var tchr_type = $('#tchr_type:checked').val();
        $('#printreport').hide();
        jQuery.post('view_religion_stat_report', {tchr_type: tchr_type}, function(data) {
            $('#all_religion_report').html(data);
            $("#all_religion_report tbody").delegate("td", "click", function() {
                $('#religion_list_report_div').html('');
                var schl_id = $(this).attr('id');
                var res = schl_id.split("-");
                var schl_id = res[0];
                var st_cat = res[1];
                var tchr_type = res[2];
                if (tchr_type) {
                    tchr_type = tchr_type;
                } else {
                    tchr_type = res[1];
                }

                $("#school_id").val(schl_id);
                $("#cast_category").val(st_cat);
                $("#tchr_t").val(tchr_type);
                $("#all_religion_report td").live("click", function() {
                    jQuery.post('religion_list_report', {schl_id: schl_id, st_cat: st_cat, tchr_type: tchr_type}, function(data) {
                        $('#religion_list_report_div').html('');
                        $('#religion_list_report_div').html(data);
                        $('#printreport').show();
                        $("#religion_reports_print").show();
                    });
                });
                /*  $(".schoolcd").click(function () { alert("aaaa");
                 var schl_id = $(this).attr('id');
                 alert(schl_id);
                 var res = schl_id.split("-");
                 var schl_id = res[0];
                 var tchr_type = res[1];
                 
                 var st_cat = '';
                 jQuery.post('religion_list_report', {schl_id: schl_id, tchr_type: tchr_type, st_cat: st_cat}, function (data) {
                 $('#religion_list_report_div').html('');
                 $('#religion_list_report_div').html(data);
                 });
                 });*/

                /*$(".schoolcdtchr").click(function () {
                 var schl_id = $(this).attr('id');
                 
                 var res = schl_id.split("-");
                 var schl_id = res[0];
                 var tchr_ty = res[1];
                 
                 var st_cat = '';
                 
                 jQuery.post('religion_list_report', {schl_id: schl_id, tchr_ty: tchr_ty, st_cat: st_cat}, function (data) {
                 $('#religion_list_report_div').html('');
                 $('#religion_list_report_div').html(data);
                 });
                 });*/

            });
        });
    });
    $("#religion_reports_print").click(function() {
        $("#TeacherReligionReportForm").submit(); //MappingReportPdf()
    });
});
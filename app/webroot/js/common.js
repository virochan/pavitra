window.role = '';

$(document).ready(function () {
//Pravin's Code Start

    //Pravin's Code Start
    $("#select_role").change(function () {
        window.role = $('#select_role :selected').val();
        
//        if (window.role == 'regional_director') {
//            alert("Under Development.");
//        }

    });
    $('#LoginValidationsUserId').on('keyup', function () {
        if (window.role == '') {
            alert("Please Select Role.");
            $('#LoginValidationsUserId').val('');
        }
    });
    $('#LoginValidationsUserId').on('focusout', function () {
        var user_id = $('#LoginValidationsUserId').val(); //
         
        var flag = 1;
        var str = "";
        if (user_id != '') {
            if (window.role == 'head_master') {
                if (user_id.length != 11) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }
            else if (window.role == 'cluster_head') {
                if (user_id.length != 10) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }
            else if (window.role == 'beo_crc') {
                if (user_id.length != 6) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }
            else if (window.role == 'eo_only') {
                if (user_id.length != 8) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }
            else if (window.role == 'ao_only') {
                if (user_id.length != 6) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }
            else if (window.role == 'state_director') {
                if (user_id.length != 9) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }
            else if (window.role == 'sanstha_login') {
                if ((user_id.length != 11)) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
                else if (user_id.indexOf('SC') == -1) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }
            
             else if (window.role == 'deputy_director') {
                if ((user_id.length != 6)) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
                else if (user_id.indexOf('DD') == -1) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }
            
             else if (window.role == 'admin') {
                if (user_id.length < 3) {
                    flag = 0;
                    str = "\n Please Enter Valid User ID.";
                }
            }

        }

        if (!flag) {
            alert(str);
        }


    });


    $('#LoginValidationsPassword').on('keyup', function () {
        if (window.role == '') {
            alert("Please Select Role.");
            $('#LoginValidationsUserId').val('');
        }
    });

//LOGIN END




    $("#educationLevel").change(function () {
        $("#post_info_under_edu_level_div").hide();
        $("#school_info_under_sansta_div").hide();
        $("#teacher_info_under_edu_level_div").hide();

//        $('#cancel_suplus_teacher_declaration').prop('disabled', false);
//        $('#cancel_suplus_teacher_declaration').css("background", "gradient( linear, left top, left bottom, color-stop(5%, #FFFACB), color-stop(100%, #FDE28D) )");

        var educationLevel = $('#educationLevel :selected').val();

        jQuery.post('selectPostUnderEduLevel', {educationLevel: educationLevel}, function (data) {
            $("#school_info_under_sansta_div").hide();
            $("#teacher_info_under_edu_level_div").hide();
            $('#post_info_under_edu_level_div').html(data);
            $("#post_info_under_edu_level_div").show();
            $("#post_under_edu_level").change(function () {
                var seletedPostUnderEduLevel = $('#post_under_edu_level :selected').val();
                jQuery.post('selectSchoolUnderEduLevel', {educationLevel: educationLevel, seletedPostUnderEduLevel: seletedPostUnderEduLevel}, function (data) {

                    $("#school_info_under_sansta_div").hide();
                    $("#teacher_info_under_edu_level_div").hide();
                    $('#school_info_under_sansta_div').html(data);
                    $("#school_info_under_sansta_div").show();

                    $("#schoolCdUnderPost").change(function () {
                        var seletedSchoolCdUnderPost = $('#schoolCdUnderPost :selected').val();

                        jQuery.post('declareSurplusTeacher', {educationLevel: educationLevel, seletedPostUnderEduLevel: seletedPostUnderEduLevel, seletedSchoolCdUnderPost: seletedSchoolCdUnderPost}, function (data) {

                            $("#teacher_info_under_edu_level_div").hide();
                            $('#teacher_info_under_edu_level_div').html(data);
                            $("#teacher_info_under_edu_level_div").show();



                            $("#save_suplus_teacher_declaration").click(function () {
                                $("#SamayojanSurplusteacherdeclationForm").submit(); // setSurplusTeacher()
                            })




                        });

                    });
                });
            });
        });

    });



});

<?php
echo $this->Html->meta('icon');
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
echo $this->Html->script('jquery.min');
echo $this->Html->script('common');
echo $this->Html->script('jquery.md5');
// echo $this->Html->script('common');
// echo $this->Html->script('calendar_common');
?>

<script type="text/javascript">

    $(document).ready(function() {

        // When site loaded, load the Popupbox First
        loadPopupBox();

        $('#popupBoxClose').click(function() {
            unloadPopupBox();
        });

        $('#wrapper').click(function() {
            unloadPopupBox();
        });

        function unloadPopupBox() {    // TO Unload the Popupbox
            $('#popup_box').fadeOut("slow");
            $("#wrapper").css({// this is just for style        
                "opacity": "1"
            });
        }

        function loadPopupBox() {    // To Load the Popupbox
            $('#popup_box').fadeIn("slow");
            $("#wrapper").css({// this is just for style
                "opacity": "0.3"
            });
        }
    });
</script>  

<script type="text/javascript">

    function toggle_visibility(id) {
        var e = document.getElementById(id);
        if (e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
        var i;
        for (i = 1; i <= 4; i++) {

            if (i != id) {
                var e = document.getElementById(i);
                e.style.display = 'none';
            }
        }
    }
</script>

<style type="text/css">

    .b_table tr td {
        border-top: none !important;
    }
    #marqueecontainer
    {
        position: relative;
        height:145px; /*marquee height */
        overflow: hidden;
        padding: 2px;
        padding-left: 4px;
    }

    #popup_box
    { 
        display:none; /* Hide the DIV */
        position:fixed;  
        height:auto;
        width:70%;  
        background:rgba(161, 156, 156, 0.5); 
        left:15%;
        top:2%;
        z-index:100; 
        border: 2px solid #868484;
        padding:0.6%;
        -moz-box-shadow: 0 0 10px #EB2828;
        -webkit-box-shadow: 0 0 10px #EB2828;
        box-shadow: 0 0 10px #EB2828;
        border-radius:0.5em;

    }

    #popup_box p
    {
        font-size:1.3em !important; 
        color:#353333;
        line-height:27px;
        font-weight:bold;
    }

    #popup_box a
    {  
        cursor: pointer;  
        position: absolute;
        top: -9px;
        right: -11px;
    } 


    #popup_box i
    {
        color: #2272EA;
        font-style: normal;
        font-weight:bold;
    }
    #popup_box u
    {
        color:#D82A2A;	
    }
    #popup_box b
    {
        color:#FE3C3C;
        font-weight:bold;
    }
    /* This is for the positioning of the Close Link */
    #popupBoxClose 
    {
        right: 1px;
        top: 1px;
        position: absolute;
    }

    .innerpop
    {
        background-color:#fff;
        padding:0.5%;
        border: solid 1px #C2BEBE;
        text-align:left;
        height:560px;
        overflow:auto;
    }

    #popupBoxClose:active
    {
        position:retaltive;
        top:2px;
    }
    .overlay_srch
    {
        background: rgba(0, 0, 0, 0.69) none repeat scroll 0 0;
        height: 100%;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        z-index:9999;
    }

    #msgtable
    {
        border-collpase:collpase;
        width:100%;
    }

    #msgtable td
    {
        color:#353333;

    }

    #districtData tr:nth-child(even) {background:rgba(249,250,251,0.8);}
    #districtData tr:nth-child(odd) {background:rgba(255,255,255,0.8);}

    #districtData
    {
        border-collapse:collapse;
    }

    #districtData td
    {
        border: 1px solid #E9E7E7;
        padding:5px;
    }
    #schoolinfo_div
    {
        padding:0px 10px; 
    }
    b
    {
        font-size:12px;
    }

    /*-----------------------------fixed table header code ------------------------------------------*/

    #districtData td 
    {
        border-bottom: 1px solid #E9E7E7;
        padding: 5px;
        text-align: left; /* IE */
        cursor:pointer;
    }

    #districtData td + td 
    {
        border-left: 1px solid #E9E7E7;
    }


    #districtData th 
    {
        padding:0 5px;
        text-align:left; 
        font-size:13px !important;
        color:#fff;
        background-color: #3a7cb5;
        border:1px solid #ccc;
    }

    #districtData .header-background
    {
        border-bottom: 1px solid #F5F5F5;

        /* above this is decorative, not part of the test */

    }

    .styled-select select {
        padding:4px;
        margin:0px;
        border-radius:4px;
        box-shadow:0px 3px 0px #CCC, 0px -1px #FFF inset;
        background:#FFF none repeat scroll 0% 0%;
        color:#0C6475;
        outline:medium none;
        display:inline-block;
        -moz-appearance: none;
        webkit-appearance:none;
        appearance:none;
        cursor: pointer;
        border: 1px solid #CCC8C8;
        height: 35px;
        letter-spacing: 0.05em;
        font-size: 15px !important;

    }

    .styled-select select 
    {
        width:100%;
        height:34px;
        overflow:hidden;
        /* background:url(../img/new_arrow.png) no-repeat right #FFF; */
        border: 1px solid #ccc;
        margin-top:9px;
        margin-left:5px;
    }

    .styled-select option
    {
        margin: 8px 0px !important;
    }


    #districtData .header-background
    {
        background-color:#32A1B6;
        height: 30px; /* height of header */
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
    }

    #districtData 
    {
        background-color: white;
        width: 100%;
        overflow-x: hidden;
        overflow-y: auto;
    }

    #districtData .th-inner 
    {
        position: absolute;
        top: 0;
        line-height:18px; /* height of header */
        text-align: left;
        border-left: 1px solid #E4DDDD;
        padding-left: 5px;
        margin-left: -5px;
        color:#ffffff;
        font-size:12px;
    }

    #districtData .first .th-inner
    {
        border-left: none;
        padding-left: 6px;
    }

    .fixed-table-container 
    {
        width :100%;
        height:393px;
        border: 1px solid #F5F5F5;
        /* margin: 10px auto;*/
        background-color: white;
        /* above is decorative or flexible */
        position: relative; /* could be absolute or relative */
        padding-top: 30px; /* height of header */
    }

    .fixed-table-container-inner 
    {
        overflow-x: hidden;
        overflow-y: auto;
        height: 100%;
    }

    .header-background 
    {
        background-color:#5F7CB7;
        height:40px; /* height of header */
        position:absolute;
        top: 0;
        right: 0;
        left: 0;
        border: solid 1px #C9BA30;
        box-shadow: 0px 1px 1px #BDBBB8;
    }

    #districtData .first 
    {
        border-left: none;
        padding-left: 6px;
        width:1%;
    } 


    #districtData .second
    {
        border-left: none;
        padding-left:6px;
        width:1%;
    } 

    #districtData .fourth
    {
        border-left: none;
        padding-left: 6px;
        width:20%;
    } 

    /*--------------------------------code end-----------------------------------------------------*/


    .black_overlay
    {
        display: none;
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }

    .white_content 
    {
        display:none;
        position:absolute;
        top: 25%;
        left: 30%;
        width: 40%;
        height: auto;
        padding: 16px;
        border: 5px solid orange;
        background-color: white;
        z-index:1002;
        //overflow: auto;
        border-radius: 1em;
        box-shadow:0 0 10px #ccc inset;

    }
    .white_content h1{background:#eef7fe;border-bottom:2px solid #00437a;color:#00437a;font-size:1em;margin-bottom:10px;font-weight:normal;font-family:calibri; border-radius: 1em 1em 0 0 !important;}
    .white_content table{ font-size:0.8em !important; border-collapse: collapse;}
    .white_content table td{ padding:5px;}
    .td-label{ color:#00437a; font-weight:bold;}
    .white_content table td input[type=text]{ border: 1px solid #ccc; min-height: 20px !important; height:25px !important; border-radius:0.5em;}
    .white_content table td input[type=password]{ border: 1px solid #ccc; min-height: 20px !important; height:25px !important; border-radius:0.5em;}

    .black_overlay2
    {
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }

    .white_content2 
    {
        display: none;
        position: absolute;
        top: 20%;
        left: 11%;
        height: auto;
        padding: 22px;
        border: 5px solid #0a7489;
        background-color: #FFF;
        z-index: 1002;
        border-radius: 1em;
        box-shadow: 0px 0px 10px #CCC inset;
        width: 48%;
    }

    #logdetail td
    {
        padding:3.4% 2%;
        height:30px;
    }

    .login_roles .subrole
    {
        background-color:red;
        width:10px;
        height:20px;
    }

    #logdetail .input.text > input
    {
        /* border: solid 1px rgb(209, 208, 208); */
        height: 26px;

    }

    .logmenu
    {
        float:left;
        width: 100%;
        min-height: 30px;
        height:auto;
        overflow-y: auto;
        background-color: #f4f5f9;
        margin: -3px;
        box-shadow: 0 8px 6px -6px black;
        background-image: url("../img/backstrip.png");
        background-repeat: repeat;
        border-bottom: solid 1px #3E5C9A;
    }


    input[type=text]:focus, textarea:focus 
    {
        box-shadow: 0 0 10px rgba(27, 145, 163, 1);
        margin: 1px 1px 1px 0px;
        border: 1px solid rgba(27, 145, 168, 1);
    }

    #logdetail .input.password > input:focus {
        box-shadow: 0 0 5px rgba(27, 145, 163, 1);
        margin: 1px 1px 3px 0px;
        border: 1px solid rgba(27, 145, 168, 1);
    }

    #logdetail .input.password > input
    {
        height:27px !important;
        background-color: #FFF;
        border: 1px solid #D1D0D0;
        box-shadow:none;
    }

    #districtData td a:hover
    {
        color:#078299 !important;
        font-weight:normal;
        letter-spacing:0.01em;
    }

    .white_content2 h1{ background:#eef7fe; border-bottom:2px solid #00437a; color: #00437a; font-size: 1em; margin-bottom:10px; font-weight:normal; font-family: calibri; border-radius: 1em 1em 0 0 !important;}
    .white_content2 table{ font-size:0.8em !important; border-collapse: collapse;}
    .white_content2 table td{ padding: 5px;}

    .white_content2 table td input[type=text]{ border: 1px solid #ccc; min-height: 20px !important; height:25px !important; border-radius:0.5em;}
    .white_content2 table td input[type=password]{ border: 1px solid #ccc; min-height: 20px !important; height:25px !important; border-radius:0.5em;}
    #distdata table, #blkdata table, #cludata table{ width:100% !important; margin:0 !important;}
    #distdata table th, #blkdata table th, #cludata table th{ font-size:14px !important}
    /********** fieldset code ***********/
    .innerdiv_dist_list_fieldset{min-height:450px;height:auto;overflow-y: auto;width: 100%;border:1px solid #4A6BAE;border-radius:4px;box-shadow: 0 0 8px #727272;-webkit-box-shadow: 0 0 8px #727272;-moz-box-shadow: 0 0 8px #727272 ;}
    .table-fixed{
        border:2px;border-collapse:collapse;border-color:blue;width:100%;background:#fff url(../img/mahamap2.png) repeat left top
    }

    .table-fixed thead {
        width: 97%;
    }
    .table-fixed tbody {
        height: 337px;
        overflow-y: auto;
        width: 100%;
    }
    .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
        display: block;
    }
    .table-fixed tbody td, .table-fixed thead > tr> th {
        float: left;
        border-bottom-width: 0;
    }
    .log-button{
        background: #97deff;
        border-radius: 5px;
        padding: 5px 15px;
        border: 1px solid #94ADE1;

    }
    .active,.log-button:focus,.log-button:hover{
        background: #3e5c9a;
        border-radius: 5px;
        padding: 5px 15px;
        border: 1px solid #94ADE1;
        color:#FFFFFF;
    }
    .toggle-btn{width:100%;}
    .btn-toggle{width:49%;float:left;display:inline-block;}
    .log-button{width:95%;}

</style>

<script type="text/javascript">
    window.tokn = $.md5('<?php echo $saltKey; ?>');
    $(document).ready(function() {
        $('#LoginValidationsPassword').val('');
        $('#reload').click(function() {
            var captcha = $("#captcha_image");
            captcha.attr('src', captcha.attr('src') + '?' + Math.random());
            return false;
        });
        $('#close').click(function() {
            $('#lightDistData').hide();
            $('#fadeDistData').hide();
            $('#distdata,#blkdata,#schdata,#divdata,#studdata').html('');

        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $('#LoginValidationsCaptcha').keyup(function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
        });
//        $('#LoginValidationsCaptcha').keyup(function() {
//            if (this.value.match(/[^a-zA-Z]/g)) {
//                this.value = this.value.replace(/[^a-zA-Z]/g, '');
//            }
//        });
//        $('#LoginValidationsCaptcha').keyup(function() {
//            if (this.value.match(/[^a-zA-Z0-9]/g)) {
//                this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
//            }
//        });
    });
    function disply_district_data(id)
    {
        $('#cludata').hide();
        jQuery.post('../Users/get_dist_tchr_cnt', {distcd: id}, function(data) {
            $('#lightDistData').show();
            $('#fadeDistData').show();
            $('#distdata').html(data);
            $('#distdata').show();
            //alert(data);
            //window.open("../Reports/get_district_studcnt",'_blank','toolbar=0,location=no,menubar=0,height=600,width=900,left=300, top=300');          
        });
        //window.open("excel_admm_stat_blk_detail");
    }
</script>

<meta name="viewport" content="width=device-width, initial-scale=1"/>


<div id="maindiv" >
    <?php echo $this->Session->flash(); ?>
    <div id="innerdiv1">
        <div class="row">
            <div class="container"> 

                <div class="logmenu" align="center">
                    <div class="main_heading col-xs-6"> <img src="../img/pavitra.png"> Pavitra</div>
                    <div class="lang col-xs-6">
                        <ul>
                            <li>
                                <img src="../img/home.png" style="margin-top:0px;margin-left:0px;float:left;margin-right:9px;"/><a href="<?php echo $this->webroot; ?>"> Home &nbsp; | </a>
                            </li>

                            <li>
                                <img src="../img/user_icon.png" style="margin-top:0px;margin-left:0px;float:left;margin-right:9px;"/>
                                <span>Change Language to : </span>
                                <span id="laneng">
                                    <?php
                                    $lang_ses = $this->Session->read('Config.language', $this->params['language']);
                                    if ($lang_ses == 'eng') {
                                        echo "<span id='lanmar'>" . $this->Html->link('?????', array('language' => 'jpn')) . "</span>";

                                        echo $this->Session->read("lang");
                                    } else if ($lang_ses == 'jpn') {
                                        echo "<span id='laneng'>" . $this->Html->link('English', array('language' => 'eng')) . "</span>";
                                        echo $this->Session->read("lang");
                                    } else if ($lang_ses <> 'eng' && $lang_ses <> 'jpn') {
                                        echo "<span id='lanmar'>" . $this->Html->link('?????', array('language' => 'jpn')) . "</span>";
                                        echo $this->Session->read("lang");
                                    }
                                    ?> 
                                </span> 
                            </li>
                        </ul>
                    </div>
                </div>
            </div>    
        </div>

        <section class="contentbody">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:10px auto;">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">    
                    <div id="innerdiv2" style="width:100%">
                        <div class="toggle-btn">
                            <div class="btn-toggle" style="margin-right:1%">
                                <button type="button" class="log-button" onclick="show('login-form');" style="margin-bottom:2%;">Login Details</button>
                            </div>
                            <div class="btn-toggle" style="margin-left:1%">
                                <button type="button" class="log-button" onclick="show('registration-form');" style="margin-bottom:2%">Registration</button>
                            </div>

                        </div>
                        <div id="login-form">
                            <div class="role_menu" style="float:left;">
                                <div class="login_main" style="display:inline-block;width:30%;"><b> <?php echo __('Select Role :'); ?></b></div>
                                <div class="styled-select" style="width:64%;display:inline-block;">
                                    <select id='select_role'>
                                        <option value="">---------Select Role--------</option>
                                        <option value='Applicant' id='applicant'>Applicant</option>
                                        <!--<option value='Register' id='Guest'>Register</option>-->
                                        <option value='head_master' id='head_master'>Head Master</option>
                                        <option value='eo_only' id='eo_only'>EO</option>
                                        <option value='sanstha' id='sanstha'>Sanstha</option>
                                        <option value='director_deputy' id='director_deputy'>Deputy Director</option>
                                        <option value='director_pri' id='director_pri'>Director Primary</option>
                                        <option value='director_sec' id='director_sec'>Director Secondary</option>
                                    </select>
                                </div>
                            </div>

                            <fieldset class="myloginfield" style="border:none !important;" id="login">
                                <div class="lbl1">
                                    <h1><?php echo __('Login Details'); ?></h1>
                                </div>
                                <div class="display-records" id="my_login_school" >
                                    <?php echo $this->Form->create('LoginValidations', array('url' => array('controller' => 'LoginValidations', 'action' => 'LoginValidation'))); ?>
                                    <div class="errMsg" id="logErr"></div>
                                    <div class="succMsg" id="logSucc"></div>
                                    <table class="table b_table" id="logdetail" style="width:100%;margin:0px;"  border="0">

                                        <tr>
                                            <td class="col-xs-4" colspan="4">
                                                <?php echo __('User ID'); ?><span style="float:right;font-weight:bold">:</span></td>
                                            <td class="col-xs-8" colspan="8">
                                                <?php
                                                echo $this->Session->flash('form1');
                                                echo $this->Form->input('user_id', array('label' => false, 'type' => 'text', 'Maxlength' => '16', 'autocomplete' => 'off', 'style' => 'width:100% !important;background:#fff url(../img/login_icon.png) no-repeat left center;padding-left:13%;'));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-4" colspan="4">
                                                <?php echo __('Password'); ?> <span style="float:right;font-weight:bold">:</span></td>
                                            <td class="col-xs-8" colspan="8">
                                                <input type="hidden" autofill="off">
                                                <?php echo $this->Form->input('password', array('label' => false, 'Maxlength' => '75', 'type' => 'password', 'style' => 'width:100%!important;background:#fff url(../img/Password_icon.png) no-repeat left center;padding-left:13%;', 'autocomplete' => 'off')); ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="col-xs-4" colspan="4"><?php echo __('Captcha'); ?><span style="float:right;font-weight:bold">:</span></td>
                                            <td class="col-xs-8" colspan="8">
                                                <?php
                                                echo $this->Html->image(array('controller' => 'Users', 'action' => 'get_captcha'), array('id' => 'captcha_image'));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-4" colspan="4">&nbsp;</td>
                                            <td class="col-xs-8" colspan="8"> 
                                                <?php
                                                echo $this->Html->link('Reload Captcha', 'javascript:void(0);', array('id' => 'reload'));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-4" colspan="4">&nbsp;</td>
                                            <td class="col-xs-8" colspan="8"> 
                                                <?php
                                                echo $this->Form->input('captcha', array('label' => false, 'type' => 'text', 'placeholder' => 'Enter Captcha', 'autocomplete' => 'off', 'style' => 'width:100%!important; padding-left:3%;height:28px !important;'));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-6" colspan="6" align="right"> 
                                                <?php echo $this->Form->submit('Login', array('class' => array('loginSubmit', 'logbutton'), 'id' => 'login_page', 'style' => 'margin:5px;')); ?>
                                            </td> 
                                            <td class="col-xs-6" colspan="6" align="center">    
                                                <?php
                                                echo $this->Form->submit('Cancel', array('class' => array('loginCancle', 'logbutton'), 'type' => 'reset', 'id' => 'cancel_login_page', 'style' => 'float:left;margin:5px;'));
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php echo $this->Form->end(); ?>	
                                </div>
                            </fieldset>
                        </div>
                        <div id="registration-form" style="display:none">
                            <div class="role_menu" style="float:left;">
                                <div class="login_main" style="display:inline-block;width:30%;"><b> <?php echo __('Select Role :'); ?></b></div>
                                <div class="styled-select" style="width:64%;display:inline-block;">
                                    <select id='select_role'>
                                        <option value="">---------Select Role--------</option>
                                        <option value='Applicant' id='applicant'>Applicant</option>
                                    </select>
                                </div>
                            </div>

                            <fieldset class="myloginfield" style="border:none !important;" id="register">
                                <div class="lbl1">
                                    <h1><?php echo __('Registration Form'); ?></h1>
                                </div>
                                <div class="display-records" id="my_login_school" >
                                    <?php echo $this->Form->create('LoginValidationsotp', array('url' => array('controller' => 'LoginValidations', 'action' => 'LoginValidation'))); ?>
                                    <div class="errMsg" id="logErr"></div>
                                    <div class="succMsg" id="logSucc"></div>
                                    <table class="table b_table" id="logdetail" style="width:100%;margin:0px;"  border="0">
                                        <tr>
                                            <td class="col-xs-4" colspan="4">
                                                <?php echo __('User ID'); ?><span style="float:right;font-weight:bold">:</span></td>
                                            <td class="col-xs-8" colspan="8">
                                                <?php
                                                echo $this->Session->flash('form1');
                                                echo $this->Form->input('user_id_otp', array('label' => false, 'type' => 'text', 'Maxlength' => '16', 'style' => 'width:100% !important;background:#fff url(../img/login_icon.png) no-repeat left center;padding-left:13%;', 'id' => 'uder_id_otp'));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-4" colspan="4">
                                                <?php echo __('Password'); ?> <span style="float:right;font-weight:bold">:</span></td>
                                            <td class="col-xs-8" colspan="8">
                                                <input type="hidden" autofill="off">
                                                <?php echo $this->Form->input('password', array('label' => false, 'Maxlength' => '10', 'type' => 'password', 'style' => 'width:100%!important;background:#fff url(../img/Password_icon.png) no-repeat left center;padding-left:13%;', 'autocomplete' => 'off', 'id' => 'password_otp')); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-4" colspan="4">
                                                <?php echo __('Confirm Password'); ?> <span style="float:right;font-weight:bold;margin-top:-20px;">:</span></td>
                                            <td class="col-xs-8" colspan="8">
                                                <input type="hidden" autofill="off">
                                                <?php echo $this->Form->input('passwordconfirm', array('label' => false, 'Maxlength' => '10', 'type' => 'password', 'style' => 'width:100%!important;background:#fff url(../img/Password_icon.png) no-repeat left center;padding-left:13%;', 'autocomplete' => 'off')); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-4" colspan="4">
                                                <?php echo __('Mobile No.'); ?> <span style="float:right;font-weight:bold">:</span></td>
                                            <td class="col-xs-8" colspan="8">
                                                <input type="hidden" autofill="off">
                                                <?php echo $this->Form->input('mobilenumber', array('label' => false, 'type' => 'text', 'Maxlength' => '10', 'style' => 'width:100% !important;background:#fff', 'id' => 'mobilenumberotp')); ?>
                                                <span id="errmsg"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-4" colspan="4">
                                                <?php echo __('OTP'); ?> <span style="float:right;font-weight:bold">:</span></td>
                                            <td class="col-xs-4" colspan="4">
                                                <input type="hidden" autofill="off">
                                                <?php echo $this->Form->input('otp', array('label' => false, 'Maxlength' => '75', 'type' => 'password', 'style' => 'width:100%!important;background:#fff;padding-left:13%;', 'autocomplete' => 'off')); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-4" colspan="4"><?php echo __('Captcha'); ?><span style="float:right;font-weight:bold">:</span></td>
                                            <td class="col-xs-8" colspan="8">
                                                <?php
                                                echo $this->Html->image(array('controller' => 'Users', 'action' => 'get_captcha'), array('id' => 'captcha_image'));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-6" colspan="6"> 
                                                <?php
                                                echo $this->Html->link('Reload Captcha', 'javascript:void(0);', array('id' => 'reload'));
                                                ?>
                                            </td>

                                            <td class="col-xs-6" colspan="6"> 
                                                <?php
                                                echo $this->Form->input('captcha', array('label' => false, 'type' => 'text', 'placeholder' => 'Enter Captcha', 'autocomplete' => 'off', 'style' => 'width:100%!important; padding-left:3%;height:28px !important;'));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-xs-6" colspan="6" align="right"> 
                                                <?php echo $this->Form->submit('Login', array('class' => array('loginSubmit', 'logbutton'), 'id' => 'login_page_otp', 'style' => 'margin:5px;')); ?>
                                            </td> 
                                            <td class="col-xs-6" colspan="6" align="center">    
                                                <?php
                                                echo $this->Form->submit('Cancel', array('class' => array('loginCancle', 'logbutton'), 'type' => 'reset', 'id' => 'cancel_login_page_otp', 'style' => 'float:left;margin:5px;'));
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php echo $this->Form->end(); ?>	
                                </div>
                            </fieldset>
                        </div> 
                    </div>  
                </div>
        </section>
    </div>
</div> 
<script>
    $(document).ready(function() {
        var LoginsUserId = '';
        $("#login_page_otp").click(function(e) {
            var passwordStrengthRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
            $("#LoginValidationsotpLoginForm").attr('autocomplete', 'off');
            $("#LoginValidationsotpLoginForm input").each(function() {
                $(this).attr('autocomplete', 'off');
            });
            var mob = $("#mobilenumberotp").val();
            if (mob == '') {
                alert("Enter Valid Mobile Number.");
                return false;
            } else {
                var x = $("#mobilenumberotp").val();
                if (x < 7) {
                    alert("Enter correct Mobile Number (Starting with: 7/8/9)");
                    $("#mobilenumberotp").val('');
                    return false;
                }
                if (x.length < 10)
                {
                    alert("Mobile Number should not be less than 10-digits.");
                    $("#mobilenumberotp").focus();
                    $("#mobilenumberotp").val('');
                    return false;
                }
            }
            var LoginValidationsOtp = $('#LoginValidationsotpOtp').val();
            if (LoginValidationsOtp == '') {
                alert("Enter Valid OTP.");
                return false;
            }
            var LoginsPassword = $('#password_otp').val();
            var LoginsUserId = $('#uder_id_otp').val();
            var a = '1';
            if (a == '1') {
                var tknPwd = $('#password_otp').val();
                var md5TknPwd = $.md5(tknPwd);
//                var md5TknPwd = $.md5($.md5(tknPwd) + window.tokn);
                $('#password_otp').val(md5TknPwd);
                var postData = $("#LoginValidationsotpLoginForm").serializeArray();
                var formURL = $("#LoginValidationsotpLoginForm").attr("action");
                var url = '';
                var errMsg = '';
                var rdx = '';
                $.ajax({
                    url: $("#LoginValidationsotpLoginForm").attr("action"),
                    type: "POST",
                    data: postData,
                    dataType: 'json',
                    success: function(output) {
                        $.each(output, function(key, val) {
                            if (key == "error" && val != "")
                            {
                                alert(val);
                            }
                            if (key == "url" && val != "") {
                                window.location = val;
                            }
                        });
                    }
                });
            }
            else {
                if (LoginsPassword == '' || LoginsUserId == '') {
                    $('#logErr').html('User Id and Password Must not be blank.');
                }
                else {
                    $('#logErr').html('Password should contain at least 1 lowercase letter, 1 uppercase letter, 1 digit and 1 special character. The length of password should be at least 8 characters.');
                }
                $('#password_otp').val(LoginsPassword);
                $('#logErr').show();
            }
            e.preventDefault(); //STOP default action
        });

        $("#login_page").click(function(e) {
            var passwordStrengthRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
            $("#LoginValidationsLoginForm").attr('autocomplete', 'off');
            $("#LoginValidationsLoginForm input").each(function() {
                $(this).attr('autocomplete', 'off');
            });
            var LoginsPassword = $('#LoginValidationsPassword').val();
            var LoginsUserId = $('#LoginValidationsUserId').val();
            var a = '1';
            if (a == '1') {
                var tknPwd = $('#LoginValidationsPassword').val();
                if (LoginsUserId.length==16) {
                    var md5TknPwd = $.md5(tknPwd);
                }
                else {
                    var md5TknPwd = $.md5($.md5(tknPwd) + window.tokn);
                }
                $('#LoginValidationsPassword').val(md5TknPwd);
                var postData = $("#LoginValidationsLoginForm").serializeArray();
                var formURL = $("#LoginValidationsLoginForm").attr("action");
                var url = '';
                var errMsg = '';
                var rdx = '';
                $.ajax({
                    url: $("#LoginValidationsLoginForm").attr("action"),
                    type: "POST",
                    data: postData,
                    dataType: 'json',
                    success: function(output) {
                        $.each(output, function(key, val) {
                            if (key == "error" && val != "")
                            {
                                alert(val);
                            }
                            if (key == "url" && val != "") {
                                window.location = val;
                            }
                        });
                    }
                });
            }
            else {
                if (LoginsPassword == '' || LoginsUserId == '') {
                    $('#logErr').html('User Id and Password Must not be blank.');
                }
                else {
                    $('#logErr').html('Password should contain at least 1 lowercase letter, 1 uppercase letter, 1 digit and 1 special character. The length of password should be at least 8 characters.');
                }
                $('#LoginValidationsPassword').val(LoginsPassword);
                $('#logErr').show();
            }
            e.preventDefault(); //STOP default action
        });

        $("#LoginValidationsPasswordconfirm").blur(function(e) {
            var pwd = $("#password_otp").val();
            var cpwd = $("#LoginValidationsPasswordconfirm").val();
            alert(pwd);
            alert(cpwd);
            if (pwd != cpwd) {
                alert("Password Mismatch");
                $("#LoginValidationsPasswordconfirm").val('');
            }
        });

        $("#mobilenumberotp").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });

        $("#mobilenumberotp").blur(function() {
            var a = $(this).val();
            var x = a.charAt(0);
            if (x < 7) {
                alert("Enter correct Mobile Number (Starting with: 7/8/9)");
                $("#mobilenumberotp").val('');
            }
            if (a.length < 10)
            {
                alert("Mobile Number should not be less than 10-digits.");
                $("#mobilenumberotp").focus();
                $("#mobilenumberotp").val('');
                return false;
            }

            var mob = $("#mobilenumberotp").val();
            var LoginsUserId = $('#uder_id_otp').val();
            var tknPwd = $('#password_otp').val();
            var md5TknPwd = $.md5(tknPwd);
            var LoginsPassword = md5TknPwd;
            if (mob == '') {
                alert("Enter Valid Mobile Number.");
                return false;
            }
            jQuery.post('otp', {mob: mob, LoginsUserId: LoginsUserId, LoginsPassword: LoginsPassword}, function(data) {
                if (data == 1) {
                    alert("Already Registered.");
                    location.reload();
                } else {
                    alert("OTP Sent to above Entered Number.");
                }
            });
        });

        $("#cancel_login_page_otp").click(function(e) {
            var url = "login";
            $(location).attr('href', url);

        });

        $("#uder_id_otp").blur(function() {
            var LoginsUserId = $('#uder_id_otp').val();
            jQuery.post('checklogin', {LoginsUserId: LoginsUserId}, function(data) {
                if (data == 1) {
                    alert("Already Registered.");
                    location.reload();
                }
            });
        });
    });

</script>

<script type="text/javascript">
    function show(elementId) {
        document.getElementById("login-form").style.display = "none";
        document.getElementById("registration-form").style.display = "none";
        document.getElementById(elementId).style.display = "block";
    }
</script>
<script>
    $('.log-button').on('click', function() {
        var $el = $(this).addClass('active');
        setTimeout(function() {
            $el.removeClass('active');
        }, 1000);
    });
</script>

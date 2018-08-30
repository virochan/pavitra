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

    $(document).ready(function () {

        // When site loaded, load the Popupbox First
        loadPopupBox();

        $('#popupBoxClose').click(function () {
            unloadPopupBox();
        });

        $('#wrapper').click(function () {
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
    #content{min-height:530px;}
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
        color:#000;
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
        color:#073B4B;
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
        background-color:#FEF8C3;
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
        height: 30px;
        background-color: #FBF19E;
        margin: -3px;
        box-shadow: 0px 0px 5px #BFBABA;
        background-image: url("../img/backstrip.png");
        background-repeat: repeat;
        border-bottom: solid 1px #E0CF2E;
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
</style>

<script type="text/javascript">
    window.tokn = $.md5('<?php echo $saltKey; ?>');
    $(document).ready(function () {
        $('#LoginValidationsPassword').val('');
        $('#reload').click(function () {
            var captcha = $("#captcha_image");
            captcha.attr('src', captcha.attr('src') + '?' + Math.random());
            return false;
        });
        $('#close').click(function () {
            $('#lightDistData').hide();
            $('#fadeDistData').hide();
            $('#distdata,#blkdata,#schdata,#divdata,#studdata').html('');

        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#LoginValidationsCaptcha').keyup(function () {
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
        jQuery.post('../Users/get_dist_tchr_cnt', {distcd: id}, function (data) {
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
                <div class="logmenu">
                    <div class="main_heading">Pavitra</div>
                    <div class="lang">
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
            
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12" style="margin:20px auto;">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">    
                <div id="innerdiv2">
                    <div class="role_menu" style="float:left;">
                        <div class="login_main" style="display:inline-block;width:30%;"><b> <?php echo __('Select Role :'); ?></b></div>


                        <div class="styled-select" style="width:64%;display:inline-block;">
                            <select id='select_role'>
                                <option value="">---------Select Role--------</option>
                                <option value='guest' id='Guest'>Guest</option>
                                <option value='head_master' id='head_master'>Head Master</option>
                                <option value='eo_only' id='eo_only'>EO</option>
                                <option value='sanstha' id='sanstha'>Sanstha</option>
                                <option value='director_deputy' id='director_deputy'>Deputy Director</option>
                            </select>



                        </div>
                    </div>

                    <fieldset class="myloginfield" style="border:none !important;">

                        <div class="lbl1">
                            <h1><?php echo __('Login Details'); ?></h1>
                        </div>
                        <div class="display-records" id="my_login_school" >
                            <?php echo $this->Form->create('LoginValidations', array('url' => array('controller' => 'LoginValidations', 'action' => 'LoginValidation'))); ?>
                            <div class="errMsg" id="logErr"></div>
                            <div class="succMsg" id="logSucc"></div>
                            <table id="logdetail" style="width:95%;margin:0px;"  border="0">

                                <tr>
                                    <td style="width:30%;font-weight:bold;font-size:14px !important;">
                                        <?php echo __('User ID'); ?><span style="float:right">:</span></td>
                                    <td>
                                        <?php
                                        echo $this->Session->flash('form1');
                                        echo $this->Form->input('user_id', array('label' => false, 'type' => 'text', 'Maxlength' => '13', 'autocomplete' => 'off', 'style' => 'width:100% !important;background:#fff url(../img/login_icon.png) no-repeat left center;padding-left:13%;'));
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;font-size:14px !important;">
                                        <?php echo __('Password'); ?> <span style="float:right;">:</span></td>
                                    <td>
                                        <input type="hidden" autofill="off">
                                        <?php echo $this->Form->input('password', array('label' => false, 'Maxlength' => '75', 'type' => 'password', 'style' => 'width:100%!important;background:#fff url(../img/Password_icon.png) no-repeat left center;padding-left:13%;', 'autocomplete' => 'off')); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;font-size:14px !important;;"><?php echo __('Captcha'); ?><span style="float:right;">:</span></td>
                                    <td>
                                        <?php
                                        echo $this->Html->image(array('controller' => 'Users', 'action' => 'get_captcha'), array('id' => 'captcha_image'));
                                        ?>
                                    </td>
                                </tr>

                                <tr style="height:10px;">
                                    <td style="height:10px;">&nbsp;</td>
                                    <td style="height:10px;padding: 0% 4% !important;"> 
                                        <?php
                                        echo $this->Html->link('Reload Captcha', 'javascript:void(0);', array('id' => 'reload'));
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="height:10px;padding: 1% 3% !important;">&nbsp;</td>
                                    <td style="height:10px;padding: 1% 3% !important;"> 
                                        <?php
                                        echo $this->Form->input('captcha', array('label' => false, 'type' => 'text', 'placeholder' => 'Enter Captcha', 'autocomplete' => 'off', 'style' => 'width:100%!important; padding-left:3%;height:28px !important;'));
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="center" style="padding-left:30%"> 
                                        <?php echo $this->Form->submit('Login', array('class' => array('loginSubmit', 'logbutton'), 'id' => 'login_page', 'style' => 'float:left;margin:5px;')); ?>
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
            </div>  
            <!--        <div id="innerdiv_dist_list" style="float:left;margin-top:10px;width:58%;margin-left:1%;">
                        <fieldset style="width:100%;border:1px solid #D0D7D8;border-radius:4px; box-shadow:1px 2px 2px rgba(0,0,0,0.3) !important;">
                            <div class="lbl2" id="school_info_list" style="padding-left:2%; border-top-left-radius:10px;border-top-right-radius:10px;">
                                <img src="../img/graph.png" style="margin-top:7px;margin-left:0px;float:left;margin-right:9px;"/>
            <?php echo __('Data Entry Statistics'); ?></div>
                            <div class="display-records" id="schoolinfo_div" style="width:100%;overflow-y:auto;height:69%;">
            
                                <div class="fixed-table-container">
                                    <div class="header-background"></div>
                                    <div class="fixed-table-container-inner">
                                        <table id="districtData" style="border:2px;border-collapse:collapse;border-color:blue;width:100%;background:#fff url(../img/mahamap.png) repeat left top">
                                            <thead>
                                                <tr>
                                                    <th class="first">
                                            <div class="th-inner"><?php echo __('Sr. No.'); ?></div></th>
                                            <th  class="second">
                                            <div class="th-inner"><?php echo __('District'); ?></div></th>
                                            <th class="third">
                                            <div class="th-inner"><?php echo __('Entered by Schools'); ?></div></th>
                                            <th class="fourth">
                                            <div class="th-inner"><?php echo __('Total Staff'); ?></div></th>
                                            </tr>
                                            </thead>
            <?php
            $xmlString = '../View/XML/districtwise.xml';
            $xmlArray = Xml::toArray(Xml::build($xmlString));
            ?>  
                                            <tbody>
            <?php
            $j = 1;
            echo "<pre>";
//                                    print_r($xmlArray); die();
            foreach ($xmlArray['TEACHERDATA'] as $key => $value) {
                ?>
                                                                                                    <tr id="<?php echo $xmlArray['TEACHERDATA'][$key]['DISTCD']; ?>" onclick="javascript:disply_district_data(this.id);">                                    			<td align="right"><?php echo $j; ?></td>
                                                                                                        <td id="" align="left"><a href="#" style="color:#000;font-size:13px !important;"><?php echo $key; ?></a></td>
                                                                                                        <td id="" align="right"><a> --- </a></td>
                                                                                                        <td id="" align="right"> <a>----</a></td>
                                                                                                    </tr>
                <?php
                $j++;
            }
            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
            
                            </div>
            
                            <div id="lightDistData" class="white_content2" style="display:none;overflow: auto; width:85%">
                                <table width="100%" align="right" style="top: 0px; right: 0px; float: right; z-index: 999; position: absolute;">
                                    <tr>
                                        <td class="tbl_std" style="text-align:right" colspan="3">
                                            <input type="button" id="close" style="border-radius: 0.5em; border:1px solid #ccc; background:#666; color:#FFF; box-shadow:0 0 10px #333 inset; min-height:30px;"  class="new-button"  value="Close">
                                        </td>
                                    </tr>
                                </table>
                                <div id="distdata" style="display:none; margin-top:20px;"></div><br>
                                <div id="blkdata" style="display:none;"></div><br>
                                <div id="cludata" style="display:none;"></div><br>
                                <div id="schdata" style="display:none;"></div><br>
                                <div id="divdata" style="display:none;"></div><br>
                                <div id="studdata" style="display:none;"></div>
            
                            </div>
                            <div id="fadeDistData" class="black_overlay2"></div>
                        </fieldset>
                    </div> -->
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"> 
                <div id="innerdiv_dist_list">
                    
                      <fieldset style="height:450px;width: 100%;border:1px solid #F9A192;border-radius:4px;">

                        <div class="lbl2" id="school_info_list" style="padding-left:2%; border-top-left-radius:10px;border-top-right-radius:10px;">
                            <img src="../img/graph.png" style="margin-top:7px;margin-left:0px;float:left;margin-right:9px;"/>
                            <?php echo __('Data Entry Statistics'); ?>


                            <?php
                            App::uses('Xml', 'Utility');
                            $xmlString = '../View/XML/districtwise.xml';
//                $xmlString = '/wwwroot/Education/app/View/XML/districtwise.xml';
                            $xmlArray = Xml::toArray(Xml::build($xmlString));
                            date_default_timezone_set("Asia/Kolkata");
                            if (file_exists($xmlString)) {
                                $timeFileChhanged = date(filemtime($xmlString));
                            }
                            $date = date('Y-m-d H:i:s', strtotime('Wed, 21 Jul 2010 00:28:50 GMT')); //(g:ia)
                            ?> <div align="right;" style="float:right;margin-left: 5px;text-transform:none;">as on: <?php echo date('d/m/Y (g:i a)', $timeFileChhanged); ?></div></legend>
                        </div>
                        <div class="display-records" id="schoolinfo_div" style="width:100%;">

                            <div class="fixed-table-container">
                                <div class="header-background"></div>
                                <div class="fixed-table-container-inner">
                                    <table class="table" id="districtData" style="border:2px;border-collapse:collapse;border-color:blue;width:100%;background:#fff url(../img/mahamap.png) repeat left top">
                                        <thead>
                                            <tr>
                                        <th width="6%" class="first">
                                        <div class="th-inner"><?php echo __('Sr.<br>No.'); ?></div></th>
                                        <th width="33%"  class="second">
                                        <div class="th-inner"><?php echo __('District'); ?></div></th>
                                        <th width="1%" class="third">
                                        <div class="th-inner"><?php echo __('No. of <br>Schools'); ?></div></th>
                                        <th width="1%" class="third">
                                        <div class="th-inner"><?php echo __('No. of <br>Posts'); ?></div></th>
                                        <th width="2%" class="third">
                                        <div class="th-inner"><?php echo __('Data Entered<br>by Schools'); ?></div></th>
                                        <th width="1%" class="third">
                                        <div class="th-inner"><?php echo __('Staff <br> Entered'); ?></div></th>
                                        <th width="2%" class="third">
                                        <div class="th-inner"><?php echo __('% on<br> Schools'); ?></div></th>
                                        <th width="1%" class="third">
                                        <div class="th-inner"><?php echo __('% on<br> Posts'); ?></div></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $j = 1;
                                            echo "<pre>";
// print_r($xmlArray);die();
                                            foreach ($xmlArray['TEACHERDATA'] as $key => $value) {
                                                $schl_total = (($value['FILLEDSCHCNTMASTER']) / ($value['ACTUALSCHCNTSANCH'])) * 100;
                                                $posts_total = (($value['FILLEDTCHRCNTMASTER']) / ($value['ACTUALTCHRCNTSANCH'])) * 100;
                                                $schl_total_f = round($schl_total, 2);
                                                $posts_total_f = round($posts_total, 2);
                                                ?>
                                                <tr id="<?php echo $xmlArray['TEACHERDATA'][$key]['DISTCD']; ?>" onclick="javascript:disply_district_data(this.id);">
                                                    <td  align="right"><?php echo $j; ?></td>
                                                    <td id="<?php echo $key; ?>_Name" align="left"><a href="#" style="color:#00457C;font-size:13px;"><?php echo $key; ?></a></td>
                                                    <td id="<?php echo $key; ?>_Schcnt" align="right"><?php echo number_format(floatval($value['ACTUALSCHCNTSANCH'])) > 0 ? number_format(floatval($value['ACTUALSCHCNTSANCH'])) : 0; ?></a></td>
                                                    <td id="<?php echo $key; ?>_Schcnt" align="right"><?php echo number_format(floatval($value['ACTUALTCHRCNTSANCH'])) > 0 ? number_format(floatval($value['ACTUALTCHRCNTSANCH'])) : 0; ?></a></td>
                                                    <td id="<?php echo $key; ?>_Sch" align="right"><?php echo number_format(floatval($value['FILLEDSCHCNTMASTER'])) > 0 ? number_format(floatval($value['FILLEDSCHCNTMASTER'])) : 0; ?></a></td>
                                                    <td id="<?php echo $key; ?>_Teacher" align="right"><?php echo number_format(floatval($value['FILLEDTCHRCNTMASTER'])) > 0 ? number_format(floatval($value['FILLEDTCHRCNTMASTER'])) : 0; ?></a></td>
                                                    <td style="text-align: center;" id="<?php echo $key; ?>_Sch" align="right"><?php echo ($schl_total_f) > 0 ? ($schl_total_f) : 0; ?> %</td>
                                                    <td style="text-align: center;"  id="<?php echo $key; ?>_Teacher" align="right"><?php echo ($posts_total_f) > 0 ? ($posts_total_f) : 0; ?> %</td>
                                                </tr>
                                                <?php
                                                $j++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div id="lightDistData" class="white_content2" style="display:none;overflow: auto; width:90%">
                            <table width="100%" align="right" style="top: 0px; right: 0px; float: right; z-index: 999; position: absolute;">
                                <tr>
                                    <td class="tbl_std" style="text-align:right" colspan="3">
                                        <input type="button" id="close" style="border-radius: 0.5em; border:1px solid #ccc; background:#666; color:#FFF; box-shadow:0 0 10px #333 inset; min-height:30px;"  class="new-button"  value="Close">
                                    </td>
                                </tr>
                            </table>
                            <div id="distdata" style="display:none; margin-top:20px;"></div><br>
                            <div id="blkdata" style="display:none;"></div><br>
                            <div id="cludata" style="display:none;"></div><br>
                            <div id="schdata" style="display:none;"></div><br>
                            <div id="divdata" style="display:none;"></div><br>
                            <div id="studdata" style="display:none;"></div>

                        </div>
                        <div id="fadeDistData" class="black_overlay2"></div>
                    </fieldset>
                    
                    
                    
<!--                    <fieldset style="height:450px;width: 100%;border:1px solid #F9A192;border-radius:4px;">

                        <div class="lbl2" id="school_info_list" style="padding-left:2%; border-top-left-radius:10px;border-top-right-radius:10px;">
                            <img src="../img/graph.png" style="margin-top:7px;margin-left:0px;float:left;margin-right:9px;"/>
                            <?php echo __('Data Entry Statistics'); ?>


                            <?php
                            App::uses('Xml', 'Utility');
                            $xmlString = '../View/XML/districtwise.xml';
//                $xmlString = '/wwwroot/Education/app/View/XML/districtwise.xml';
                            $xmlArray = Xml::toArray(Xml::build($xmlString));
                            date_default_timezone_set("Asia/Kolkata");
                            if (file_exists($xmlString)) {
                                $timeFileChhanged = date(filemtime($xmlString));
                            }
                            $date = date('Y-m-d H:i:s', strtotime('Wed, 21 Jul 2010 00:28:50 GMT')); //(g:ia)
                            ?> <div align="right;" style="float:right;margin-left: 5px;text-transform:none;">as on: <?php echo date('d/m/Y (g:i a)', $timeFileChhanged); ?></div></legend>
                        </div>
                        <div class="display-records" id="schoolinfo_div" style="width:100%;">

                            <div class="fixed-table-container">
                                <div class="header-background"></div>
                                <div class="fixed-table-container-inner">
                                    <table class="table" id="districtData" style="border:2px;border-collapse:collapse;border-color:blue;width:100%;background:#fff url(../img/mahamap.png) repeat left top">
                                        <thead>
                                            <tr>
                                                <th width="6%" class="first">
                                        <div class="th-inner"><?php echo __('Sr.<br>No.'); ?></div></th>
                                        <th width="33%"  class="second">
                                        <div class="th-inner"><?php echo __('District'); ?></div></th>
                                        <th width="1%" class="third">
                                        <div class="th-inner"><?php echo __('No. of <br>Schools'); ?></div></th>
                                        <th width="1%" class="third">
                                        <div class="th-inner"><?php echo __('No. of <br>Posts'); ?></div></th>
                                        <th width="2%" class="third">
                                        <div class="th-inner"><?php echo __('Data Entered<br>by Schools'); ?></div></th>
                                        <th width="1%" class="third">
                                        <div class="th-inner"><?php echo __('Staff <br> Entered'); ?></div></th>
                                        <th width="2%" class="third">
                                        <div class="th-inner"><?php echo __('% on<br> Schools'); ?></div></th>
                                        <th width="1%" class="third">
                                        <div class="th-inner"><?php echo __('% on<br> Posts'); ?></div></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $j = 1;
                                            echo "<pre>";
// print_r($xmlArray);die();
                                            foreach ($xmlArray['TEACHERDATA'] as $key => $value) {
                                                $schl_total = (($value['FILLEDSCHCNTMASTER']) / ($value['ACTUALSCHCNTSANCH'])) * 100;
                                                $posts_total = (($value['FILLEDTCHRCNTMASTER']) / ($value['ACTUALTCHRCNTSANCH'])) * 100;
                                                $schl_total_f = round($schl_total, 2);
                                                $posts_total_f = round($posts_total, 2);
                                                ?>
                                                <tr id="<?php echo $xmlArray['TEACHERDATA'][$key]['DISTCD']; ?>" onclick="javascript:disply_district_data(this.id);">
                                                    <td  align="right"><?php echo $j; ?></td>
                                                    <td id="<?php echo $key; ?>_Name" align="left"><a href="#" style="color:#00457C;font-size:13px;"><?php echo $key; ?></a></td>
                                                    <td id="<?php echo $key; ?>_Schcnt" align="right"><?php echo number_format(floatval($value['ACTUALSCHCNTSANCH'])) > 0 ? number_format(floatval($value['ACTUALSCHCNTSANCH'])) : 0; ?></a></td>
                                                    <td id="<?php echo $key; ?>_Schcnt" align="right"><?php echo number_format(floatval($value['ACTUALTCHRCNTSANCH'])) > 0 ? number_format(floatval($value['ACTUALTCHRCNTSANCH'])) : 0; ?></a></td>
                                                    <td id="<?php echo $key; ?>_Sch" align="right"><?php echo number_format(floatval($value['FILLEDSCHCNTMASTER'])) > 0 ? number_format(floatval($value['FILLEDSCHCNTMASTER'])) : 0; ?></a></td>
                                                    <td id="<?php echo $key; ?>_Teacher" align="right"><?php echo number_format(floatval($value['FILLEDTCHRCNTMASTER'])) > 0 ? number_format(floatval($value['FILLEDTCHRCNTMASTER'])) : 0; ?></a></td>
                                                    <td style="text-align: center;" id="<?php echo $key; ?>_Sch" align="right"><?php echo ($schl_total_f) > 0 ? ($schl_total_f) : 0; ?> %</td>
                                                    <td style="text-align: center;"  id="<?php echo $key; ?>_Teacher" align="right"><?php echo ($posts_total_f) > 0 ? ($posts_total_f) : 0; ?> %</td>
                                                </tr>
                                                <?php
                                                $j++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div id="lightDistData" class="white_content2" style="display:none;overflow: auto; width:90%">
                            <table width="100%" align="right" style="top: 0px; right: 0px; float: right; z-index: 999; position: absolute;">
                                <tr>
                                    <td class="tbl_std" style="text-align:right" colspan="3">
                                        <input type="button" id="close" style="border-radius: 0.5em; border:1px solid #ccc; background:#666; color:#FFF; box-shadow:0 0 10px #333 inset; min-height:30px;"  class="new-button"  value="Close">
                                    </td>
                                </tr>
                            </table>
                            <div id="distdata" style="display:none; margin-top:20px;"></div><br>
                            <div id="blkdata" style="display:none;"></div><br>
                            <div id="cludata" style="display:none;"></div><br>
                            <div id="schdata" style="display:none;"></div><br>
                            <div id="divdata" style="display:none;"></div><br>
                            <div id="studdata" style="display:none;"></div>

                        </div>
                        <div id="fadeDistData" class="black_overlay2"></div>
                    </fieldset>-->
                </div> 
            </div>
        </div>
            
        </section>
    </div>
</div> 


<script>
//    $(document).ready(function() {
//        alert(window.role);
//    });
    $(function () {
        $("#login_page").click(function (e) {

            var passwordStrengthRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
            $("#LoginValidationsLoginForm").attr('autocomplete', 'off');
            $("#LoginValidationsLoginForm input").each(function () {
                $(this).attr('autocomplete', 'off');
            });
            var LoginsPassword = $('#LoginValidationsUserId').val();
            var LoginsUserId = $('#LoginValidationsPassword').val();
            var a = '1';
            if (a == '1') {

                var tknPwd = $('#LoginValidationsPassword').val();
                var md5TknPwd = $.md5($.md5(tknPwd) + window.tokn);
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
                    success: function (output) {
                        $.each(output, function (key, val) {
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

        $("#cancel_login_page").click(function (e) {
            var url = "login";
            $(location).attr('href', url);

        });

    });
</script>

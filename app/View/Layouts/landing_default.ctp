<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Teacher Module</title>
        <link href="teacher.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.cycle.all.js"></script> 
        <?php echo $this->Html->css('teacher'); ?>

        <script language="javascript">
            $(document).ready(function () {
                $('#slider1').cycle({
                    fx: 'fade', //'scrollLeft,scrollDown,scrollRight,scrollUp',blindX, blindY, blindZ, cover, curtainX, curtainY, fade, fadeZoom, growX, growY, none, scrollUp,scrollDown,scrollLeft,scrollRight,scrollHorz,scrollVert,shuffle,slideX,slideY,toss,turnUp,turnDown,turnLeft,turnRight,uncover,ipe ,zoom
                    speed: 'slow',
                    timeout: 2000
                });
            });
        </script>

<!--<script>
    $(document).ready(function() {
  $('#overlay_srch').show();
});
   
</script>-->
        <script type="text/javascript">

            /***********************************************
             * Cross browser Marquee II- © Dynamic Drive (www.dynamicdrive.com)
             * This notice MUST stay intact for legal use
             * Visit http://www.dynamicdrive.com/ for this script and 100s more.
             ***********************************************/

            var delayb4scroll = 2000 //Specify initial delay before marquee starts to scroll on page (2000=2 seconds)
            var marqueespeed = 2 //Specify marquee scroll speed (larger is faster 1-10)
            var pauseit = 1 //Pause marquee onMousever (0=no. 1=yes)?

            ////NO NEED TO EDIT BELOW THIS LINE////////////

            var copyspeed = marqueespeed
            var pausespeed = (pauseit == 0) ? copyspeed : 0
            var actualheight = ''

            function scrollmarquee() {
                if (parseInt(cross_marquee.style.top) > (actualheight * (-1) + 8))
                    cross_marquee.style.top = parseInt(cross_marquee.style.top) - copyspeed + "px"
                else
                    cross_marquee.style.top = parseInt(marqueeheight) + 8 + "px"
            }

            function initializemarquee() {
                cross_marquee = document.getElementById("vmarquee")
                cross_marquee.style.top = 0
                marqueeheight = document.getElementById("marqueecontainer").offsetHeight
                actualheight = cross_marquee.offsetHeight
                if (window.opera || navigator.userAgent.indexOf("Netscape/7") != -1) { //if Opera or Netscape 7x, add scrollbars to scroll and exit
                    cross_marquee.style.height = marqueeheight + "px"
                    cross_marquee.style.overflow = "scroll"
                    return
                }
                setTimeout('lefttime=setInterval("scrollmarquee()",30)', delayb4scroll)
            }

            if (window.addEventListener)
                window.addEventListener("load", initializemarquee, false)
            else if (window.attachEvent)
                window.attachEvent("onload", initializemarquee)
            else if (document.getElementById)
                window.onload = initializemarquee
        </script>

 
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

            #marqueecontainer
            {
                position: relative;
                height:145px; /*marquee height */
                overflow: hidden;
                padding: 2px;
                padding-left: 4px;
            }

        </style>

        <style>
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
        </style>

    </head>

    <body>

        <div id="wrapper">
            <div id="header">
                <div id="logo">

                    <div class="logo1"><img src="images/logo1.png" /></div>

                    <div class="middle">
                        <h1>School Education and Sports Department</h1>
                        <h3>Government of Maharashtra</h3>
                    </div>

                    <div class="logo2"><img src="images/right_edu.png"/></div>
                    <div class="logo3"><img src="images/logo2.png"/></div>


                </div>


            </div>
            <div id="Menu">
                <nav id="nav">
                    <ul>
                        <li><a href="#" onclick="toggle_visibility('1');">Home</a></li>
                        <li><a href="#" onclick="toggle_visibility('2');">About</a></li>
                        <li><a href="#" onclick="toggle_visibility('3');">Contact</a></li>
                        <li><a href="#" onclick="toggle_visibility('4');">Helpdesk</a></li>
                    </ul>
                </nav>

                <div class="container-4">
                    <input type="search" id="search" placeholder="Search..." />
                    <button class="icon"><i class="fa fa-search"></i></button>
                </div>

            </div> 

            <div id="content">
                <div id="left">
                    <div class="left_bubble">
                        <div class="rectangle1"><h2>Quick Links</h2></div>
                        <div class="triangle-l1"></div>
                        <div class="triangle-r1"></div>
                        <div id='homemenu'>
                            <ul>
                                <li><a href='#' >&nbsp;</a></li>
                                <li><a href='users/login' class="teacher">Pavitra</a></li>
                                <li><a href='users/login' class="teacher">Staff Portal</a></li>
                                <li><a href='#' class="samay">Samayojan</a></li>
                                <li><a href='#' class="implink">Important Links</a></li>
                                <li><a href='#' class="contact">Contact us</a></li>
                            </ul>
                        </div>
                    </div>

                    <div id="news">
                        <h3>News And Update</h3>
                        <div class="Newscontent">
                            <div id="marqueecontainer" onMouseover="copyspeed = pausespeed" onMouseout="copyspeed = marqueespeed">

                                <div id="vmarquee" style="position: absolute; width: 98%;">
                                    <p>No Data Available</p>
                                </div>
                            </div>
                        </div>   
                    </div>


                </div>
                <div id="middle">
                    <div id="1" style="display:block;">
                        <h2>Welcome to Staff (Teaching and Non-Teaching) Portal</h2>

                        <!--<div class="bgpattern" style="background-image: url(images/stripe.png); width:100%;height:8px;margin:10px 2px 10px 2px;"></div>
                        --><div class="slider">
                            <ul id="slider1">
                                <li><img border="0" src="images/image1.png"  alt="jQuery Image slider" title="jQuery Image slider"  style="width:740px!important;" /></li>
                                <li><img border="0" src="images/image2.png"  alt="jQuery Image slider" title="jQuery Image slider"  style="width:740px!important;"/></li>
                                <li><img border="0" src="images/image3.png"  alt="jQuery Image slider" title="jQuery Image slider" style="width:740px!important;"/></li>
                                <li><img border="0" src="images/image4.png"  alt="jQuery Image slider" title="jQuery Image slider" style="width:740px!important;" /></li>
                                <li><img border="0" src="images/image5.png"  alt="jQuery Image slider" title="jQuery Image slider" style="width:740px!important;"/></li>
                                <li><img border="0" src="images/image6.png"  alt="jQuery Image slider" title="jQuery Image slider" style="width:740px!important;"/></li>
                                <li><img border="0" src="images/image7.png"  alt="jQuery Image slider" title="jQuery Image slider" style="width:740px!important;"/></li>
                            </ul>
                        </div>
                        <!--<div class="bgpattern" style="background-image: url(images/stripe.png); width:100%;height:4px;margin:10px 2px 10px 2px;"></div>-->
                        <div class="total_section">
                            <?php
                            $get = file_get_contents('../View/XML/xmlschoolstchrs.xml');
                            $arr = simplexml_load_string($get);
                            $arr = json_decode(json_encode($arr), 1);
                            ?>
                            <div class="Tsection1">Data Entered by No. of Schools &nbsp;: &nbsp;<input type="text" style="text-align: center" size="4"  value="<?php echo $arr['SCHCNT']; ?>" readonly/> </div>
                            <div class="Tsection2">No.of Teaching and Non-Teaching Staff &nbsp;: &nbsp;<input type="text" style="text-align:center" size="4"  value="<?php echo $arr['TCHRCNT']; ?>" readonly /></div>
                        </div>
                        <p>
                            The word 'teacher' represents knowledge; transfer of the knowledge from the teacher to the taught. In fact, the foundation that builds a person in life is to great extent based on the knowledge he gets from his teacher. If there is somebody other than our parents who plays an important role in our mental development, it's our teachers. Foradian pays a tribute to the positive and inspiring role that holds the ladder that we all climb as students<br/>
                            <br/>

                        </p>
                    </div>
                    <div id="2" style="display:none;">Welcome to staff Portal </div>



                    <div id="3" style="display:none;">
                        <fieldset style="text-align:left;">
                            <legend>Contact us</legend>
                            <p><span>E-mail:</span>support.education@maharashtra.gov.in</p>
                            <br/>
                            <p><span>Help Line Numbers (Toll Free) :</span>18002331899</p>
                            <p><span>Help Line support:</span>18002330700</p>
                            <p><span>Help Line support:</span>18002330800</p>
                            <p><span>Help Line support:</span>18002331899</p>

                            <br/>
                            <p><span>Timing:</span> 08:00 AM - 08:00 PM (Only Working Day's)</p>

                        </fieldset>
                    </div>



                    <div id="4" style="display:none;">
                        <fieldset style="text-align:left;">
                            <legend>Helpdesk</legend>
                            <p>E-mail:support.education@maharashtra.gov.in</p>
                            <p>Help Line No:(Toll Free) 18002331899</p>
                            <p>Help Line support: 18002330700 </p>
                            <p>Help Line support: 18002330800</p>
                            <p>Help Line support: 18002331899 </p>
                            <p>Timing: 08:00 AM - 08:00 PM (Only Working Day's)</p>
                        </fieldset>

                    </div>
                </div>

                <div id="right">
                    <div id="container">
                        <div class="bubble">

                            <div class="rectangle"><h2>Key Persons</h2></div>
                            <div class="triangle-l"></div>
                            <div class="triangle-r"></div>
                            <div class="info">
                                <div class="key"><img alt="Shri Devendra Fadnavis" src="images/CM-Photo-2014.jpg" /> 
                                    <b>Shri Devendra Fadnavis</b><br />
                                    Hon'ble Chief Minister, Maharashtra State</div>

                                <div class="key"><img width="65px" alt="Shri Vinod Tawde" src="images/Vinod-Tawde.jpeg" /> 
                                    <b> Shri. Vinod Tawde </b><br />
                                    Hon'ble Minister, School Education & Sports Department</div>

                                <div class="key"><img src="images/nand-sharma.png" alt="Shri. Nand Kumar" width="61"/>   
                                    <b>Shri. Nand Kumar (I.A.S.)</b> <br />
                                    Principal Secretary, School Education & Sports Department</div>

                                <div class="key">
                                    <img width="61" src="images/Hon.jpg" alt="Shri. Dheeraj Kumar (I.A.S.)" />   
                                    <b>Shri. Dheeraj Kumar (I.A.S.) </b> <br />
                                    Commissioner (Education)</div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div id="footer1">
                <ul>
                    <li><a href="#">Disclaimer</a>|</li>
                    <li><a href="#">Terms & Conditions</a>|</li>
                    <li><a href="#">Privacy Policy</a>|</li>
                    <li><a href="#">Copyright Policy</a>|</li>
                    <li><a href="#">Hyperlink Policy</a>|</li>
                    <li><a href="#">Important Policy</a></li>
                </ul>

                <p>
                    <span>Copyright &copy; School Education and Sports Department.<br/>
                        Site Designed and Developed by<a href="http://www.nic.in" target="_blank">National Informatics Centre,Pune.</a></span>
                </p>
                <p><span>Website Contents and Data provided & Maintained by Department of Education and Sports, Government of Maharashtra.
                        <?php
                        $server_ip = $this->Session->read('server_ip');
                        if (isset($server_ip)) {
                            echo "" . $server_ip;
                        }
                        ?>
                    </span></p>




            </div>
        </div>

        <div id="popup_box">
            <a id="popupBoxClose"><img src="img/close.png" id="exit_search" height="40" width="40"></a>    
            <div class="innerpop">   

                <table id="msgtable" width="100%" border="0">
                    <tr>
                        <td valign="top"><p>१.</p></td>
                        <td valign="top">
                            <p>
                                शालेय शिक्षण व क्रीडा विभाग, शासन निर्णय, दिनांक १९ सप्टेंबर २०१६ अनुसार मूल्यांकनात पात्र घोषित करण्यात आलेल्या १६२८ खाजगी प्राथमिक व माध्यमिक शाळांना अनुदान देण्यासंदर्भात नमूद केलेल्या अटी व शर्ती मधील मुद्द्दा क्रमांक ७ अनुसार '' शाळेमधील सर्व शिक्षकांच्या आधारकार्डसह वैयक्तिक मान्यतेचे आदेश सरल प्रणालीत भरणे आवश्यक आहे. ''
                            </p></td>
                    </tr>

                    <tr>
                        <td valign="top"><p>२.</p></td>
                        <td><p>
                                त्या अनुषंगाने वरील शासन निर्णयानुसार अनुदानासाठी पात्र घोषित केलेल्या १६२८ शाळांना त्यांच्या शाळेतील सर्व शिक्षक व शिक्षकेतर कर्मचाऱ्यांची माहिती भरण्यासाठी Staff Portal सुरु केलेले आहे. सदरचे login फक्त शासन निर्णयातील नमूद शाळांसाठीच उपलब्ध केलेले आहे. सदरचे काम पूर्ण झाल्यानंतर उर्वरित शाळांसाठी यथावकाश login उपलब्ध केले जातील.  

                            </p></td>
                    </tr>

                    <tr>
                        <td valign="top"><p>३.</p></td>
                        <td><p>
                                सदर १६२८ शाळांनी त्यांच्या शाळातील ज्या शिक्षक व शिक्षकेतर कर्मचाऱ्यांची माहिती भरलेली नाही अशा शाळांनी सदरची माहिती तात्काळ Staff Portal वर भरावी. कोणत्याही कर्मचाऱ्यांची माहिती अपूर्ण राहणार नाही याची संबंधित शाळा व शिक्षणाधिकारी यांनी नोंद घ्यावी.
                            </p></td>
                    </tr>

                    <tr>
                        <td valign="top"><p>४.</p></td>
                        <td><p>
                               एखादया शिक्षक व शिक्षकेतर कर्मचा-याचे नाव Map From Udise मध्ये HM Login वर दिसत नसल्यास त्या कर्मचा-याची माहिती भरण्यासाठी Education Officer (Primary/Secondary) Login वर New Entry चे Form उपलब्ध करुन दिला आहे. तरी शाळांनी संबंधित शिक्षणाधिकारी कार्यालयाशी संपर्क साधून शिक्षणाधिकारी यांनी पडताळणी करुनच सदरची माहिती भरावी. 

                            </p></td>
                    </tr>

                    <tr>
                        <td valign="top"><p>५.</p></td>
                        <td><p>
                                 प्रत्येक शिक्षक व शिक्षकेतर कर्मचाऱ्याचा आधार क्रमांक (UID Number) भरणे Compulsory आहे. तसेच प्रत्येक शिक्षक व शिक्षकेतर कर्मचाऱ्याच्या नियुक्तीचे व वैयक्तिक मान्यतेच्या आदेशाची प्रत upload करणे Compulsory आहे. या व्यतिरिक्त इतर कोणतीही कागदपत्रे upload करावयाची नाहीत याची नोंद घ्यावी. 
                            </p></td>
                    </tr>
                    
                     <tr>
                        <td valign="top"><p>६.</p></td>
                        <td><p>
                                 शाळेने Staff Portal वर login करून 1.Personal Details 2.Caste and Certification 3.Initial Appointment Details 4.Qualification Details 5.Physically Handicapped Details ह्या 5-Screen वरील माहिती भरणे आवश्यक आहे. सदरची माहिती भरून ती केंद्रप्रमुख यांना Forward करावी. 
                            </p></td>
                    </tr>
                    
                      <tr>
                        <td valign="top"><p>७.</p></td>
                        <td><p>
                                केंद्रप्रमुख यांनी HM login वरून Forward केलेली माहिती तपासून Verify करावयाची आहे याची नोंद घ्यावी. 
                            </p></td>
                    </tr>


                </table>



            </div>
        </div>

    </body>
</html>

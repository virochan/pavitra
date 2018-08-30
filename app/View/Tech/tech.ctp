<!DOCTYPE html>
<html>
    <link rel="shortcut icon" href="../img/busy.gif"/>

    <title>
        Student Database System

    </title>
    <head>
        <?php echo $this->Html->charset(); ?>
        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
          echo $this->Html->script('jquery.min');
      

        echo $this->Html->css('layout4_setup');
        echo $this->Html->css('layout4_text');
    
        ?>
    </head>
    <body style="margin:0px">
        <!-- Main Page Container -->
        <div class="page-container">
            <!-- For alternative headers START PASTE here -->
            <!-- A. HEADER -->  
            <div id="header">  
<!--                            <div id="header-strip"></div>-->
                            <div id="logo-main">
                                <img src="<?php echo $this->webroot; ?>img/logo.png" alt="Government of Maharashtra" /><span> <?php echo __("School Education and Sports Department"); ?>
                                <br>
                                <small><?php echo __("Government of Maharashtra"); ?></small></span>
                                
                            </div>
<div id="rte">
                    <img src="<?php echo $this->webroot; ?>img/logEng.png" alt=""/>
                    
                </div>
                            <div id="emb">
                                <img src="<?php echo $this->webroot; ?>img/emb.png" alt="Government of India" />
                                <span><?php echo __('Student Portal'); ?></span>
                            </div>
                            <!--<div id="header-strip-bottom">
                                <img src="../img/top-bg2.jpg" alt="Site Logo" />
                            </div>-->
                            
                        </div>

            <script>
                $(function () {
                    var url = window.location.pathname,
                            urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
                    $('#displaymenu a').each(function () {
                        if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                            $('a').removeClass('menuactive');
                            $(this).addClass('menuactive');
                        }
                    });
                });
            </script><?php  $role= $this->Session->read("role"); ?>
            <div id="displaymenu">
                
                <a href="../Techs/query" class="menulink"><img src="../img/manager-50.png" border="0"><?php echo __('Tech Login Home');?></a>
                <a href="../Techs/changepassword" class="menulink"><img src="../img/reset.gif" border="0"><?php echo __('Reset User Password');?></a>
                <a href="../Users/logout" class="menulink"><img src="../img/exit.png" border="0"><?php echo __('Logout');?></a>


    


            </div>


            <div class="main">
                <!-- B.1 MAIN NAVIGATION -->

                <div id="content" style="min-height: 500px">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div> 
       <div id="footer2">
                             <a href="<?php echo $this->webroot; ?>Users/disclaimer">Disclaimer</a>
                             <a href="<?php echo $this->webroot; ?>Users/terms_condition">Terms & Conditions</a>  
                             <a href="<?php echo $this->webroot; ?>Users/privacy_policy">Privacy Policy</a>  
                             <a href="<?php echo $this->webroot; ?>Users/copyright">Copyright Policy</a>  
                             <a href="<?php echo $this->webroot; ?>Users/hyperlinks">Hyperlink Policy</a>  
                            
                        </div>
            </div>
            <!-- C. FOOTER AREA -->      
            <div id="footer">
                Copyright © 2015 DEPTEDU. All Rights Reserved 
                Website Designed & Developed by Software Development Unit, <a href="http://www.nic.in" target="_blank">National Informatics Centre Pune</a>. <br>
                Website Contents and Data Provided & Maintained by Department of Education and Sports, Government of Maharashtra <br>
                Best Viewed in IE-9 and Above, Google Chrome and Mozilla Firefox.
            </div>      
        </div> 
    </body>
</html>

      <script>
//            regular
//            address
//            birth
//            physical
//            $(document).ready(function () {
//                $(document)[0].oncontextmenu = function() { return false;}
//
//        $(document).mousedown(function(e){
//          if( e.button == 2 ) {
//             //alert('Sorry, this functionality is disabled!');
//             return false;
//           } else {
//             return true;
//            }
//
//        });});
               </script>
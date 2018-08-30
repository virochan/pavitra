
<?php
$cakeDescription = __d('cake_dev', 'Header Data');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
    <head>
        <meta charset="utf-8">
            <script>

                window.webroot = '<?php echo $this->webroot; ?>';

                function disply_record(id)
                {
//alert("123");
                    $(".selectbox").prop("disabled", true);
                    var id = id;
                    var vid = id;
                    // $('#user_id').val(id);
//                    $('#LoginValidationsUserId').val(vid);

                    $.ajax({
                        url: "SchoolData",
                        type: "POST",
                        data: {'id': id},
                        success: function (output) {
//                                alert(output);
//                            var current = $("#schoolinfo_div").html();
//                            alert(current);
                            $("#schoolinfo_div").html(output);
                        }
                    });
                }
            </script>

            <?php echo $this->Html->charset(); ?>
            <!-- disable iPhone inital scale -->
            <meta name="viewport" content="width=700px; initial-scale=1.0">

                <title>School Education and Sports Department</title>
                <?php
                echo $this->Html->meta('icon');
                echo $this->Html->css('bootstrap');
                echo $this->Html->css('bootstrap.min');
                echo $this->Html->css('style_pavitra');
//                echo $this->Html->script('https://www.google.com/jsapi'); 
//                  echo $this->Html->script('jsapi.js'); 
//                echo $this->Html->script('http://code.jquery.com/jquery-2.1.0.min.js');
//                echo $this->Html->script('http://code.jquery.com/jquery-1.10.2.min.js');
                echo $this->Html->script('jquery.min');
                echo $this->Html->script('bootstrap');
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('common');
                echo $this->fetch('css');
                echo $this->fetch('script');
                echo $this->fetch('meta');
                ?>

                </head>
                <body>
                <div class="container">   
                    
                    <div id="pagewrap">

                        <div id="header-strip">  


                            <div id="logo-main">
                                <div id="emb1">
                                    <img src="<?php echo $this->webroot; ?>img/logo.png" alt="Government of Maharashtra"></img>
                                </div>
                                <span> <?php echo __("School Education and Sports Department"); ?>
                                    <br>
                                        <small>Government of Maharashtra</small>
                                </span>
                            </div>



                           <!-- <div class="lang">
                                <span id="laneng">
                                    <?php
                                    $lang_ses = $this->Session->read('Config.language', $this->params['language']);
                                    if ($lang_ses == 'eng') {
                                      echo "<span id='lanmar'>" . $this->Html->link('मराठी', array('language' => 'jpn')) . "</span>";

                                        echo $this->Session->read("lang");
                                    } else if ($lang_ses == 'jpn') {
                                        echo "<span id='laneng'>" . $this->Html->link('English', array('language' => 'eng')) . "</span>";
                                        echo $this->Session->read("lang");
                                    } else if ($lang_ses <> 'eng' && $lang_ses <> 'jpn') {
                                        echo "<span id='lanmar'>" . $this->Html->link('मराठी', array('language' => 'jpn')) . "</span>";
                                        echo $this->Session->read("lang");
                                    }
                                    ?> 
                                </span> 
                            </div>-->
                            <div id="emb2">
                                <img src="<?php echo $this->webroot; ?>img/emb.png" alt="Government of India">
                            </div>

                            <?php /* ?> <span  style=" float: right; margin: 10px 10px 10px 10px;">   
                              <?php
                              echo $this->Html->link('English', array('language' => 'eng'));
                              echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                              echo $this->Html->link('मराठी', array('language' => 'jpn'));
                              echo $this->Session->read("lang");
                              ?>
                              </span><?php */ ?>
                        </div>
                        
                        <div id="content">
                            <?php
                            echo $this->Session->flash();
                            echo $this->fetch('content');
                            ?>
                        </div>

                        <div id="footer1">
                            <ul>
                                <li><?php echo $this->Html->link('Disclaimer', array('action' => 'disclaimer')); ?>|</li>
                                <li> <?php echo $this->Html->link('Terms & Conditions', array('action' => 'terms_conditions')); ?> |</li>
                                <li> <?php echo $this->Html->link('Privacy Policy', array('action' => 'privacy_policy')); ?> |</li>
                                <li> <?php echo $this->Html->link('Copyright Policy', array('action' => 'copyright_policy')); ?> |</li>
                                <li> <?php echo $this->Html->link('Hyperlink Policy', array('action' => 'hyperlink_policy')); ?> |</li>
                                <li>  <?php echo $this->Html->link('Important Policy', array('action' => 'important_links')); ?></li>
                            </ul>

                            <p>
                                <span>Copyright &copy; School Education and Sports Department.<br/>
                                    Site Designed and Developed by<a href="http://www.nic.in" target="_blank">National Informatics Centre,Pune.</a></span>
                            </p>
                            <p><span>Website Contents and Data provided & Maintained by Department of Education and Sports, Government of Maharashtra.</span></p>

                            <?php
                            $server_ip = $this->Session->read('server_ip');
                            if (isset($server_ip)) {
                                echo "" . $server_ip;
                            }
                            ?>

                            <?php echo $this->Form->end(); ?>
                        </div>

                    </div>

                    <!-- /#footer --> 
                </div> 
                </body>
                </html>










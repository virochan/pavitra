
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Header Data');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
    <head>
        <meta charset="utf-8">
            <script type="text/javascript" src="jquery-ui-1.10.4.custom.js"></script>
            <script type="text/javascript">
                window.webroot = '<?php echo $this->webroot; ?>';
            </script>
            <?php echo $this->Html->charset(); ?>
            <!-- disable iPhone inital scale -->
            <meta name="viewport" content="width=700px; initial-scale=1.0">
                <title>School Education and Sports Department</title>
                <?php
                echo $this->Html->script('jquery.min');
                echo $this->Html->meta('icon');
                echo $this->Html->css('style');
                echo $this->Html->script('common');
                echo $this->fetch('meta');
                echo $this->fetch('css');
                echo $this->fetch('script');
                echo $this->Html->meta('icon');
                echo $this->fetch('meta');
                echo $this->fetch('css');
                echo $this->fetch('script');
                echo $this->Html->css('style_menu');
                echo $this->Html->script('common');
                ?>

                </head>
                <body>
                    <div id="pagewrap">
                        <header>
                            <div id="header-strip"> 
                                <table class="headingTable" border="0" style="width: 100%;padding: 7px 0px 0px 0px ; ">
                                    <tr>
                                        <td style="color: #FFFFFF;width: 20%;text-align: left; ">  Teachers Portal</td>
                                        <td style="color: #FFFFFF;width: 60%;text-align: center;font-size: 20px; font-style: bold;" >School Education and Sports Department</td>
                                        <td style="color: #FFFFFF;width: 14%;text-align: right;"> Date :<?php echo date("d/m/Y"); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="example">
                                <nav>
                                    <ul  id="menu">

<!--<li> <?php // echo $this->Html->link('Address', array('action' => 'address'));      ?></li>-->       
                                        <!--  <li> <?php
                                        echo $this->Html->link('Logout', array("controller" => 'Users',
                                            "action" => "index"));
                                        ?> </li>  -->
                                        <li><?php echo $this->Html->link('Personal', array('action' => 'personalclusterhead')); ?> </li>
                                        <li><?php echo $this->Html->link('Cluster Head', array('action' => 'clusterheadVerifyReject')); ?> </li>
                                        <li> <?php echo $this->Html->link('PH Details ', array('action' => 'ph_report')); ?> </li> 
                                        <li> <?php //echo $this->Html->link('PH Details ', array('action' => 'ph_cluster'));      ?> </li> 
                                        <li><?php echo $this->Html->link('Caste Verify', array('action' => 'caste_cluster')); ?></li>
                                        <li><?php echo $this->Html->link('Certificate Verify', array('action' => 'certificate_cluster')); ?></li>
                                        <li><?php echo $this->Html->link('Religion Report', array('action' => 'religion_report')); ?></li>
                                        <li><?php echo $this->Html->link('Mapping Report', array('action' => 'mapping_report')); ?></li>
                                        <li><?php echo $this->Html->link('Logout', array("controller" => 'Users', "action" => "logout")); ?></li>


                                    </ul>



        <!--<input class="myButton"  id="logout_tch" type="button" value="Logout" style="text-align: right;float:right;" />-->



                                    <?php //echo $this->Html->link('Logout',array("controller" => 'Users', "action" => "index"));   ?>

                                </nav>
                            </div>
                        </header>	
                        <!-- /#pagewrap -->

                        <div id="content">


                            <?php echo $this->fetch('content'); ?>
                        </div>

                        <footer id="footer">

                            <p>Copyright &copy; School Education and Sports Department.  
                                <span style="float: right;">   Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Inormatics Centre, Pune</a>
                                    <?php
                                    $server_ip = $this->Session->read('server_ip');
                                    if (isset($server_ip)) {
                                        echo "" . $server_ip;
                                    }
                                    ?>
                                </span>
                            </p>

                        </footer>
                    </div>
                    <!-- /#footer -->            
                    <?php echo $this->Session->flash(); ?>
                </body>
                </html>










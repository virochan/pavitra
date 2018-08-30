<!doctype html>
	<?php
		echo $this->Html->meta('icon');

	
		echo $this->Html->css('jquery.ui.all');
		echo $this->Html->css('demos');
		
		echo $this->Html->script('jquery-1.7.2');
		echo $this->Html->script('jquery.ui.core');
		echo $this->Html->script('jquery.ui.widget');
		echo $this->Html->script('jquery.ui.datepicker');
		echo $this->Html->script('calendar_common');
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
<?php
echo $this->Form->create(false);
?>
   <div class="demo">       
		<?php echo $this->Form->input('datepicker',array('label'=>false,'id'=>'datepicker','type'=>'text','maxlength'=>'30')); ?>
   </div>
   
   
   <?php $this->pageTitle = __('pageTitle_home', true); ?>

<h1><?php __('welcome_heading'); ?></h1>
<?php __('lipsum'); ?><?php __('lipsum'); ?><?php __('lipsum'); ?><br/>
<?php __('lipsum'); ?><?php __('lipsum'); ?><?php __('lipsum'); ?><br/>
<?php __('footer_copyright'); ?> 

<!-- these links will change the language, but allow the user to stay on this page //-->
<?php echo $html->link($html->image('en_gb.gif'), '/lang/en-gb', null, null, false); ?>
<?php echo $html->link($html->image('zh_tw.gif'), '/lang/zh-tw', null, null, false); ?>
<?php echo $html->link($html->image('zh_cn.gif'), '/lang/zh-cn', null, null, false); ?>

<!-- these links will change the language, then forward the user to the /news page //-->
<?php echo $html->link($html->image('en_gb.gif'), '/en-gb/news', null, null, false); ?>
<?php echo $html->link($html->image('zh_tw.gif'), '/zh-tw/news', null, null, false); ?>
<?php echo $html->link($html->image('zh_cn.gif'), '/zh-cn/news', null, null, false); ?> 
            
			
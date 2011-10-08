<?php
/* SVN FILE: $Id: admin.ctp,v 1.2 2010-08-29 16:10:40 jpozdom Exp $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.console.libs.templates.skel.views.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 1.2 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2010-08-29 16:10:40 $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<?php e('<?xml version="1.0" encoding="UTF-8"?>'); ?>
<?php echo $html->docType('xhtml-strict'); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('app.title'); ?>:
		<?php echo $title_for_layout;?>
	</title>
	<?php
		echo $html->meta('icon');
		
		echo $javascript->link('utils.js');

		echo $javascript->link('jquery/jquery.js');
		echo $javascript->link('jquery/no_conflict.js');
		echo '<!-- http://docs.jquery.com/Using_jQuery_with_Other_Libraries -->';
		
		echo $javascript->link('jquery/jquery.bgiframe.js');	// Used by autocomplete and tooltip
		echo $javascript->link('jquery/jquery.dimensions.js');	// Required by tooltip and jdMenu		
		
		echo $html->css('/js/jquery/jquery.tooltip.css');
		echo $javascript->link('jquery/jquery.tooltip.js');
		echo $javascript->codeBlock('
			$j(function() {
				$j("a, input, img").tooltip({
					track: true,
					delay: 0,
					showURL: false,
					showBody: " - "
				});
			});
		');
		
		echo $html->css('jquery.jdMenu.css');
		echo $javascript->link('jquery/jquery.positionBy.js');	// Required by jdMenu
		echo $javascript->link('jquery/jquery.jdMenu.js');
		
		echo $javascript->link('jquery/jquery.form.js');		// Send forms via ajax
		
		echo $javascript->link('jquery/jqModal.js');
		echo $html->css('jqModal.css');
		echo $javascript->codeBlock('
			$j().ready(function() {
				$j("#deleteConfirmModalWindow").jqm({ajax: "@href", modal: true, trigger: "a.confirm", target: "#jqmContent"});
			});
		');
		
		echo $javascript->link('jquery/form_disable_enter.js');
		echo $javascript->link('jquery/collapsible_fieldsets.js');
		echo $javascript->link('jquery/close_messages.js');
		
		echo $html->css('/js/jquery/jquery-autocomplete/jquery.autocomplete.css');
		echo $javascript->link('jquery/jquery-autocomplete/jquery.autocomplete.js');
		
		echo $html->css('jquery.simple.tree.css');
		echo $javascript->link('jquery/jquery.simple.tree.js');
		
		echo $html->css('/js/slimbox-2.02/css/slimbox2.css');
		if ( Configure::read('debug') ) {
			echo $javascript->link('slimbox-2.02/src/slimbox2.js');
			echo $javascript->link('slimbox-2.02/src/autoload.js');
		} else {
			echo $javascript->link('slimbox-2.02/slimbox2.js');
		}
		
		echo $javascript->link(array(
			'date.js',
			'jquery.datePicker.js',
			'cake.datePicker.js'
		));
				
		echo $html->css('cake.generic');
		echo $html->css('generic.css');
		echo $html->css('forms.css');
		echo $html->css('paginators.css');
		echo $html->css('resources.css');
		echo $html->css('attachments.css');
		echo $html->css('comments.css');
		echo $html->css('datePicker.css');
				
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header" class="clear">
			<h1 class="left"><?php echo $html->link(__('app.title', true), '/');?></h1>
			<div id="user_menu" class="right">
				<!--  <cache:nocache> -->
				<?php if (User::get('id')): ?>
					<?php e($html->link(User::get('name'), array('controller' => 'usermanager', 'action' => 'view', User::get('id')))); ?>|
					<?php e($html->link(__('logout', true), array('controller' => 'users', 'action' => 'logout', 'admin' => false))); ?>					
				<?php else: ?>
					<?php e($html->link(__('sign up', true), array('controller' => 'users', 'action' => 'signup'))); ?>|
					<?php e($html->link(__('login', true), array('controller' => 'users', 'action' => 'login'))); ?>|
				<?php endif; ?>
				<!-- </cache:nocache> -->
			</div>
		</div>
		<div id="admin_main_menu">
			<?php //echo $this->element('admin_main_menu',
			//			array('cache' => '+1 day')); ?>
		</div>
		<div id="sub_header">
			<div id="breadcrumb">
				<?php echo $html->getCrumbs(); ?>
			</div>
		</div>
		<div id="content">
			<div id="body_admin">
				<?php					
/*
					if ($session->check('Message.auth')):
							$session->flash('auth');
					endif;
					
					if ($session->check('Message.flash')):
							$session->flash();
					endif;
*/
					
				?>
	
				<?php echo $content_for_layout;?>
			</div>
		</div>
		<div id="footer">
		
			<?php 
				echo $html->link(
							$html->image('xhtml_valid.jpg', array('id' => 'xhtml_valid', 'alt'=> __("XHTML 1.1 valid", true), 'style' => 'border: none;')),
							'http://validator.w3.org/check?uri=referer',
							null, null, false
						);
				echo '&nbsp;';
				echo $html->link(
							$html->image('css_valid.jpg', array('id' => 'css_valid', 'alt'=> __("CSS valid", true), 'style' => 'border: none;')),
							'http://jigsaw.w3.org/css-validator/check/referer',
							null, null, false
						);
				echo '&nbsp;';
				echo $html->link(
							$html->image('cake.power.gif', array('id' => 'cake_power', 'alt'=> __("CakePHP: the rapid development php framework", true), 'style' => 'border: none;')),
							'http://www.cakephp.org/',
							null, null, false
						);
			?>
		</div>
	</div>
	<div class="jqmWindow" id="deleteConfirmModalWindow">
		<div id="jqmTitle">
	    	<button class="jqmClose"><?php __('Close'); ?></button>
	    	<span id="jqmTitleText"></span>
		</div>
		<div id="jqmContent">
		</div>
	</div>
	<?php //echo $cakeDebug;?>
</body>
</html>

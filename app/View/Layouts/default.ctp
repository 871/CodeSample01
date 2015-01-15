<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$prjHelper = $this->Project;

if (!isset($title_for_layout))				throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);
if (!$prjHelper instanceof ProjectHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$prjHelper->setTitleForLayout($title_for_layout);

// タグ
$ulMenuLinks			= $prjHelper->getUlMenuLinks();
// テキスト
$textTitleName			= $prjHelper->getTextTitleName();
$textSystemName			= $prjHelper->getTextSystemName();
$textCopyright			= $prjHelper->getTextCopyright();
$textMenuTitle			= $prjHelper->getTextMenuTitle();
// システム
$sessionFlashMessage	= $prjHelper->getSessionFlashMessage();

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $textTitleName; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script src="/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
	<link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $textSystemName; ?></h1>
		</div>
		<div id="content">
			<?php echo $sessionFlashMessage; ?>			
			<?php echo $this->fetch('content'); ?>
			<div class="actions">
				<h3><?php echo $textMenuTitle; ?></h3>
				<?php echo $ulMenuLinks; ?>
			</div>
			<script>(function($){
				var elContent = 'div.index,div.form';
				var elActions = 'div.actions';
				
				var actionsHeigth = 0;
				$(elActions).each(function(i, e){
					actionsHeigth += $(e).height();
				});
				if ($(elContent).height() < actionsHeigth) {
					$(elContent).height(actionsHeigth);
				}
			})(jQuery);</script>
		</div>
		<div id="footer">
			<?php echo $textCopyright; ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>

<!DOCTYPE html>
<html>
<?php echo $this->getChild('head')->toHtml(); ?>
<body>
	<table width="100%">
		<tr>
			<td class="p-0 m-0">
				<?php echo $this->getChild('header')->toHtml(); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $this->getChild('message')->toHtml(); ?>
				<?php echo $this->getChild('content')->toHtml(); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $this->getChild('footer')->toHtml(); ?></td>
		</tr>
	</table>
</body>
</html>
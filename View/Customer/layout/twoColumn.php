<!DOCTYPE html>
<html>
<head>
	<title><?php /*echo $title;*/ echo 'Two column'; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body>
	<table border="1" width="100%">
		<tr>
			<td class="p-0 m-0" colspan="3"><?php echo $this->getChild('header')->toHtml(); ?></td>
		</tr>
		<tr>
			<td height="450px" width="15%">
				<?php echo $this->getChild('left')->toHtml(); ?>
			</td>
			<td width="85%">
				<?php echo $this->getChild('message')->toHtml(); ?>
				<?php echo $this->getChild('content')->toHtml(); ?>
			</td>
		</tr>
		<tr>
			<td height="100px" colspan="3"><?php echo $this->getChild('footer')->toHtml(); ?></td>
		</tr>
	</table>
</body>
</html>
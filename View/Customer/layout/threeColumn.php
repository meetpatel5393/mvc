<!DOCTYPE html>
<html>
<head>
	<title><?php echo 'Three column'; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="<?php echo $this->baseUrl('skin/Admin/Js/jquery-3.5.1.slim.js');?>"></script>
	<script type="text/javascript" src="<?php echo $this->baseUrl('skin/Admin/Js/mage.js');?>"></script>
	<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body>
	<table border="1" width="100%">
		<tr>
			<td class="p-0 m-0" colspan="3"><?php echo $this->getChild('header')->toHtml(); ?></td>
		</tr>
		<tr>
			<td height="450px" width="15%"><?php echo $this->getChild('left')->toHtml(); ?></td>
			<td width="70%"><?php echo $this->getChild('content')->toHtml(); ?></td>
			<td width="15%">Right</td>
		</tr>
		<tr>
			<td height="100px" colspan="3"><?php echo $this->getChild('footer')->toHtml(); ?></td>
		</tr>
	</table>
</body>
</html>
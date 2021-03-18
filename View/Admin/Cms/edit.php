<?php $arrayOfStatus = $this->getArrayOfStatus(); ?>
<?php $cmsPage = $this->getTableRow(); ?>
<form method="post" action="<?php echo $this->getUrl()->getUrl('save','Admin\Cms'); ?>" id="cmsForm">
<div class="container-fluid m-0 p-4">
	<div class="container-fluid m-0 p-2">
		<div class="col m-0 p-0">
			<div class="row m-0 p-1">
				<p>Title</p>
			</div>
			<div class="row m-0 p-1">
				<input type="text" name="cms[title]" value="<?php echo $cmsPage->title; ?>">
			</div>
		</div>
		<div class="col m-0 p-0">
			<div class="row m-0 p-1">
				<p>Identifier</p>
			</div>
			<div class="row m-0 p-1">
				<input type="text" name="cms[identifier]" value="<?php echo $cmsPage->identifier; ?>">
			</div>
		</div>
		<div class="col m-0 p-0">
			<div class="row m-0 p-1">
				<p>Content</p>
			</div>
			<div class="row m-0 p-1">
				<textarea name="cms[content]"><?php echo $cmsPage->content; ?></textarea>
			</div>
		</div>
		<div class="col m-0 p-0">
			<div class="row m-0 p-1">
				<p>Status</p>
			</div>
			<div class="col m-0 p-1">
				<?php foreach ($arrayOfStatus as $key => $value) : ?>
					<input type="radio" name="cms[status]" value="<?php echo $key; ?>"
					<?php if($cmsPage->status == $key && $cmsPage->pageId){ echo "checked"; } ?> >
					<?php echo $value; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col m-0 p-1">
			<div class="row m-0 p-1">
				<button type="button" class="btn btn-success" onclick="object.setCmsPage().load();">Add Page</button>
			</div>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	CKEDITOR.replace('cms[content]');
</script>
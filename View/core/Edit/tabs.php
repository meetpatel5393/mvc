<?php  $tabs = $this->getTabs(); ?>
<?php foreach ($tabs as $key => $value) : ?>
	<button class="btn btn-primary btn-block" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','',['tab'=>$key]); ?>').resetParams().load();"><?php echo($value['label']); ?></button>
<?php endforeach; ?>
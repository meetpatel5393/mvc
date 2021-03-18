<?php 

$tabs = $this->getTabs();
foreach ($tabs as $key => $value) { ?>
	<button class="btn btn-primary btn-block" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show',"Admin\Category",['tab'=>$key]); ?>').resetParams().load();"><?php echo($value['label']); ?></button>
<?php }

?>
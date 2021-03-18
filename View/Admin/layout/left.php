<div id="leftHtml">
<?php 

$child = $this->getChildren();
foreach ($child as $key => $value) {
	echo $value->toHtml();
}

?>	
</div>
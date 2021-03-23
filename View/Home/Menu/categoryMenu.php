<?php $collection = $this->getCollection()->getData(); ?>
<?php foreach ($collection as $key=> $value): ?>
	<li class="col-10">
		<?php if ($value->parentId == 0): ?>
			<b><?php echo $value->name.'<br>'; ?></b>
			<?php foreach ($collection as $key1 => $value1): ?>
				<?php if ($value->categoryId == $value1->parentId): ?>
					<?php echo $value1->name.'<br>'; ?>
				<?php endif ?>
			<?php endforeach ?>
			<?php echo '<hr>'; ?>
		<?php endif ?>
	</li>	
<?php endforeach ?>
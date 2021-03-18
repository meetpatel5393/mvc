<?php 
	$title = 'Category';
	$categorys = $this->getCategorys();
?>
<div class="container-fluid m-0 p-4">
	<div class="row m-0 p-1">
		<button class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Category',[],true);?>').resetParams().load();">Create Category</button>
	</div>
	<h3>Category Grid</h3>
	<div class="container-fluid m-0 p-1">
		<table class="table">
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Parent Id</th>
				<th>Description</th>
				<th>Status</th>
				<th colspan="2">Action</th>
			</tr>
			<?php if($categorys): ?>
				<?php foreach ($categorys->getData() as $key => $category) : ?>
					<tr>
						<td><?php echo $category->categoryId; ?></td>
						<td><?php echo $this->getPath($category->path); ?></td>
						<td><?php echo $category->parentId; ?></td>
						<td><?php echo $category->description; ?></td>
						<td><?php echo $category->status; ?></td>
						<td>
							<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','Admin\Category',['categoryId'=>$category->categoryId]);?>').resetParams().load();"><i class="fa fa-trash" aria-hidden="true"></i></button>

							<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Category',['categoryId'=>$category->categoryId]);?>').resetParams().load();"><i class='fa fa-pencil' aria-hidden='true'></i></button>
						</td>
						<td>
							<button class="btn p-2 m-0 <?php if($category->status==1){ echo 'btn-success';}else{ echo 'btn-danger';} ?>" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('changeStatus', 'Admin\Category', ['categoryId' => $category->categoryId]); ?>').resetParams().load();">
								<?php if ($category->status == 1): ?>
								<?php echo 'Enabled' ?>
								<?php else: ?>
								<?php echo 'Disabled' ?>
								<?php endif;?>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if($categorys == false) : ?>
				<?php echo "<center>No Category Available</center>";?>
			<?php endif; ?>
		</table>
	</div>
</div>
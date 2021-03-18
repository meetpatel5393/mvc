<?php $cmsPages = $this->getCmsPages()->getData(); ?>
<div class="container-fluid m-0 p-4 col justify-content-center">
	<div class="row m-0 p-1">
		<button class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show', 'Admin\Cms', [], true); ?>').resetParams().load();">Add Page</button>
	</div>
	<div class="row m-0 p-1">
		<h5>CMS Grid</h5>
	</div>
	<table class="table">
		<tr>
			<th>Page Id</th>
			<th>Identifier</th>
			<th>Status</th>
			<th>createdDate</th>
			<th colspan="2">Action</th>
		</tr>
		<?php if($cmsPages) : ?>
			<?php foreach ($cmsPages as $key => $cmsPage) : ?>
				<tr>
					<td><?php echo $cmsPage->pageId ; ?></td>
					<td><?php echo $cmsPage->identifier ; ?></td>
					<td><?php echo $cmsPage->status ; ?></td>
					<td><?php echo $cmsPage->createdDate ; ?></td>
					<td>
						<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete', 'Admin\Cms', ['pageId' => $cmsPage->pageId]); ?>').resetParams().load();"><i class="fa fa-trash" aria-hidden="true"></i></button>

						<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show', 'Admin\Cms', ['pageId' => $cmsPage->pageId]); ?>').resetParams().load();"><i class='fa fa-pencil' aria-hidden='true'></i></button>
					</td>
				</tr>
			<?php endforeach ; ?>
		<?php else : ?>
			<center><p>No Cms Pages Available</p></center>
		<?php endif; ?>
	</table>
</div>
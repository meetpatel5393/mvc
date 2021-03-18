<table width="100%">
	<tr>
		<td width="15%">
			<?php echo $this->getTabHtml(); ?>
		</td>
		<td width="85%">
			<div class="container-fluid m-0 p-4">
				<div class="container-fluid m-0 p-2">		
					<div id="tabContent">
						<form method="post" action="<?php echo $this->getFormUrl();?>" enctype="multipart/form-data" id="form">
							<?php echo $this->getTabContent(); ?>
						</form>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
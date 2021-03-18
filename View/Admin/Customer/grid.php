<?php  $customers = $this->getCustomers(); ?>
<div class="container-fluid m-0 p-4  col justify-content-center">
	<div class="row m-0 p-1">
		<button class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Customer',[],true);?>').resetParams().load();">Register</button>
	</div>
	<h3>Customer Grid</h3>
	<table class="table">
		<tr>
			<th>Customer Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Group Name</th>
			<th>Zip Code</th>
			<th colspan="2">Action</th>
		</tr>
		<?php if($customers) : ?>
			<?php foreach ($customers->getData() as $customer) : ?>
			<tr>
				<td><?php echo $customer->customerId; ?></td>
				<td><?php echo $customer->firstName; ?></td>
				<td><?php echo $customer->lastName; ?></td>
				<td><?php echo $customer->email; ?></td>
				<td><?php echo $customer->status; ?></td>
				<td><?php echo $customer->createdDate; ?></td>
				<td><?php echo $customer->name ?></td>
				<td><?php echo $customer->zipcode ?></td>
				<td>
					<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','Admin\Customer',['customerId'=>$customer->customerId]);?>').resetParams().load();"><i class="fa fa-trash" aria-hidden="true"></i></button>

					<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Customer',['customerId'=>$customer->customerId]);?>').resetParams().load();"><i class="fa fa-pencil" aria-hidden="true"></i></button>
				</td>
				<td>
					<button class="btn p-2 m-0 <?php if($customer->status==1){ echo 'btn-success';}else{ echo 'btn-danger';} ?>" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('changeStatus', 'Admin\Customer', ['customerId' => $customer->customerId]); ?>').resetParams().load();">
						<?php if ($customer->status == 1): ?>
						<?php echo 'Enabled' ?>
						<?php else: ?>
						<?php echo 'Disabled' ?>
						<?php endif;?>
					</button>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if(!$customers) : ?>
			<center><p>No Customer Available</p></center>
		<?php endif; ?>
	</table>
</div>
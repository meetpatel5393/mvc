<?php
	$title = 'Customer';
	$customer = $this->getCustomer();
	$arrayOfStatus = $this->getArrayOfStatus();
	$customerGroup = $this->getCustomerGroupArray()->getData();
?>
<div class="container-fluid m-0 p-2 row">
	<h3><?php if (!$customer->customerId) { echo "Customer Registration";} ?></h3>
	<h3><?php if ($customer->customerId) { echo "Update Customer Data";} ?></h3>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Customer Group</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<select name='customer[groupId]' required="">
			<?php foreach ($customerGroup as $key => $value) : ?>
				<option value="<?php echo $customerGroup[$key]->groupId ?>"><?php echo $customerGroup[$key]->name ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>First Name</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="text" name="customer[firstName]" required="" value="<?php echo $customer->firstName; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Last Name</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="text" name="customer[lastName]" required="" value="<?php echo $customer->lastName; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Email</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="email" name="customer[email]" required="" value="<?php echo $customer->email; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Password</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="password" name="customer[password]" required="">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Status</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<?php foreach ($arrayOfStatus as $key => $value): ?>
			<input type="radio" name="customer[status]" value="<?php echo $key; ?>" 
			<?php if($customer->customerId && $customer->status == $key) { echo 'checked';} ?> required="">
			<?php echo $value; ?>
		<?php endforeach; ?>
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<button type="button" onclick="object.setForm().load();" class="btn btn-success"><?php if (!$customer->customerId)  { echo "Register";} else {echo 'Update';} ?></button>
	</div>
</div>
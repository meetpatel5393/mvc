<div class="container-fluid m-0 p-2 row bg-primary text-white">
	<div class="container-fluid m-0 p-2 pl-4 col-md-2">
		<h2>Website Title</h2>
	</div>
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<a href="<?php echo $this->getUrl()->getUrl('index','index',null,true);?>" class="text-white">
		DashBoard</a>
	</div>
	<!-- Product -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Product');?>').resetParams().load();">Product</button>
	</div>
	<!-- Category -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Category');?>').resetParams().load();">Category</button>
	</div>
	<!-- Customer -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Customer');?>').resetParams().load();">Customer</button>
	</div>
	<!-- Customer Group -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Customer\Group');?>').resetParams().load();">Customer Group</button>
	</div>
	<!-- Payment -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Payment');?>').resetParams().load();">Payment</button>
	</div>
	<!-- Shipping  -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Shipping');?>').resetParams().load();">Shipping</button>
	</div>
	<!-- Admin -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Admin');?>').resetParams().load();">Admin</button>
	</div>
	<!-- Cms -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Cms');?>').resetParams().load();">Cms</button>
	</div>
	<!-- Attribute -->
	<div class="container-fluid m-0 p-0 col-md-1 my-auto">
		<button class="btn text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Attribute');?>').resetParams().load();">Attribute</button>
	</div>
</div>

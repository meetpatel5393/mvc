<center class='text-success'><?php echo $this->getMessage()->getSuccess(); ?></center>
<?php $this->getMessage()->clearSuccess(); ?>
<center class='text-danger'><?php  echo $this->getMessage()->getFailure(); ?></center>
<?php $this->getMessage()->clearFailure(); ?>
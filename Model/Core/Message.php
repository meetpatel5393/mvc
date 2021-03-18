<?php 

class Model_Core_Message
{
	protected $success;
	protected $failure;
	protected $notice;

	public function setSuccess($success) {
		$this->success = $success;
		return $this;
	}
	
	public function getSuccess() {
		return $this->success;
	}
	
	public function setFailure($failure) {
		$this->failure = $failure;
		return $this;
	}
	
	public function getFailure() {
		return $this->failure;
	}
	
	public function setNotice($notice) {
		$this->notice = $notice;
		return $this;
	}
	
	public function getNotice() {
		return $this->notice;
	}
}
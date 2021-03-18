<?php 
namespace Model\Core\Message;
trait Message
{
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

	public function clearSuccess(){
		unset($this->success);
		return $this;
	}
	
	public function clearFailure(){
		unset($this->failure);
		return $this;
	}
}
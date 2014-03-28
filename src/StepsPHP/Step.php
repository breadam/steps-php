<?php namespace Breadam\StepsPHP;

abstract class Step implements StepInterface{
	
	private $caller;
	private $scope;
	private $output;
	
	public function __construct(Step $caller = null){
		$this->caller = $caller;
	}
	
	private function reset(){
		$this->scope = array();
		$this->output = array();
	}
	
	protected function caller(){
		if(is_null($this->caller)){
			return false;
		}
		return $this->caller;
	}
	
	protected function output($key = null,$val = null){
		$num = func_num_args();
		
		if($num === 0){
			return $this->output;
		}
		
		if($num === 1){
			if(is_array($key)){
				$this->output = $key;
			}else{
				return $this->output[$key];
			}
			
		}
		
		$this->output[$key] = $val;
	}
	
	protected function scope($key = null,$val = null){
		$num = func_num_args();
		
		if($num === 1){
		
			if(isset($this->scope[$key])){
			
				return $this->scope[$key];
				
			}else if($this->caller){
			
				return $this->caller->scope($key);
			}
			return null;
		}
		
		$this->scope[$key] = $val;
	}
	
	public function call(array $input=null){
		
		$this->reset();
		
		if(!is_null($input)){
			foreach($input as $key => $val){
				$this->scope($key,$val);
			}
		}
		
		$args = array();
		$method = new \ReflectionMethod(get_class($this),"onCall");
		
		foreach($method->getParameters() as $parameter){
			$name = $parameter->getName();
			$args[] = $this->scope($name);
		}
		
		$method->setAccessible(true);
		$success = $method->invokeArgs($this,$args);
		$method->setAccessible(false);
		
		if($success === false){
			return false;
		}
		
		return $this->output();
	}
	
}
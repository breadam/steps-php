<?php namespace Breadam\StepsPHP;

abstract class Step{
	
	private $caller;
	private $output;
	private $scope;
	private $started = false;
	
	public function __construct(Step $caller = null){
		$this->caller = $caller;
	}
	
	public function __set($key,$val){
		$this->scope[$key] = $val;
	}
	
	public function call(array $input=array()){
		
		if(!$this->started){
			$this->scope = array();
			$this->output = array();
			$this->started = true;
		}
		
		$onCall = new \ReflectionMethod(get_class($this),"onCall");
		
		foreach($input as $key => $val){
			$this->scope[$key] = $val;
		}
		
		$args = array();
		foreach($onCall->getParameters() as $expected){
			$name = $expected->getName();
			$args[] = $this->scope($name);
		}
		
		$onCall->setAccessible(true);
		$success = $onCall->invokeArgs($this,$args);
		$onCall->setAccessible(false);
		
		$this->started = false;
		
		if($success === false){
			return false;
		}
		
		return $this->output;
	}
	
	protected function step($name,$out = false){
		$output = $this->callStep($name);
		
		$this->scope = array_merge($this->scope,$output);
		
		if($out){
			$this->output = array_merge($this->scope,$output);
		}
	}
	
	protected function out($key = null,$val = null){
		if(func_num_args() === 1){
			$output = $this->callStep($key);
			$this->output = array_merge($this->output,$output);	
			return;
		}
		
		$this->output[$key] = $val;
	}
	
	private function callStep($name){
		$stepName = "\\".implode("\\",explode(".",$name));
		
		if(!class_exists($stepName)){
			throw new Exception\StepNotFoundException;
		}
		
		$step = new $stepName($this);
		
		return $step->call();
	}
	
	private function scope($key){
		if(isset($this->scope[$key])){
			return $this->scope[$key];
		}else if(!is_null($this->caller)){
			return $this->caller->scope($key);
		}
		return null;
	}
}
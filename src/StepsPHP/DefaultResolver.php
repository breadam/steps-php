<?php namespace Breadam\StepsPHP;

class DefaultResolver implements ResolverInterface{
	
	private $className;
	private $stepName;
	
	public function resolve($name){
		
		$names = explode(".",$name);
		$this->stepName = array_pop($names);
		
		if(count($names) > 0){
			$this->className = "\\".implode("\\",$names);
		}else{
			$this->className = false;
		}
	}
	
	public function className(){
		return $this->className;
	}
	
	public function stepName(){
		return "step".$this->stepName;
	}
	
}

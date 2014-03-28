<?php namespace Breadam\StepsPHP;

abstract class Steps extends Step {
	
	protected $steps = array();
	
	public function step($name){
		
		$this->steps[] = $name;
	}
	
	protected function onCall(){
		
		$last = end($this->steps);
		
		foreach($this->steps as $no => $name){
			
			$step = new $name($this);
			
			$output = $step->call($this->scope());
			
			if($output === false){
				return false;
			}
			
			if($name == $last) {
				foreach($output as $key => $val){
					$this->output($key,$val); 
				}
        
			}else{
				foreach($output as $key => $val){
					$this->scope($key,$val);
				}
			}
		}
	}
	
}
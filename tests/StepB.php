<?php

require_once(__DIR__."/../vendor/autoload.php");

class StepB extends Breadam\Steps\Step {
	
	protected function onCall($add,$sub,$mul,$div,$c){
		
		$this->output("addition",$add);
		$this->output("subtraction",$sub);
		$this->output("multiplication",$mul);
		$this->output("division",$div);
		$this->output("c",$c);
	}
	
}
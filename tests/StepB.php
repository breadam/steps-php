<?php

require_once(__DIR__."/../vendor/autoload.php");

class StepB extends Breadam\StepsPHP\Step {
	
	protected function onCall($add,$sub,$mul,$div,$c){
		
		$this->out("addition",$add);
		$this->out("subtraction",$sub);
		$this->out("multiplication",$mul);
		$this->out("division",$div);
		$this->out("c",$c);
	}
	
}
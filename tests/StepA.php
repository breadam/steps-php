<?php

require_once(__DIR__."/../vendor/autoload.php");

class StepA extends Breadam\Steps\Step {
	
	protected function onCall($a,$b){
	
		$this->output("add",$a+$b);
		$this->output("sub",$a-$b);
		$this->output("mul",$a*$b);
		$this->output("div",$a/$b);
	}
	
}
<?php

require_once(__DIR__."/../vendor/autoload.php");
require_once("StepB.php");

class StepA extends Breadam\StepsPHP\Step {
	
	protected function onCall($a,$b){
		
		$this->add = $a+$b;
		$this->sub = $a-$b;
		$this->mul = $a*$b;
		$this->div = $a/$b;
		
		$this->step("StepB");
		$this->out("eben",12313);
		$this->out("StepB");
	}
	
}
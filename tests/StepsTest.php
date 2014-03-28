<?php

require_once("SimpleSteps.php");
require_once("StepA.php");
require_once("StepB.php");

class StepsTest extends PHPUnit_Framework_TestCase {
	
	public function testCall(){
		
		$steps = new SimpleSteps;
		
		$output = $steps->call(array(
			"a" => 12,
			"b" => 13,
			"c" => 14
		));
		
		$this->assertEquals(5,count($output));
		
	}
	
}
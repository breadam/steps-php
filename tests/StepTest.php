<?php

require_once("StepA.php");

class StepTest extends PHPUnit_Framework_TestCase {
	
	public function testCall(){
		
		$step = new StepA;
		$output = $step->call(array(
			"a" => 12,
			"b" => 13
		));
		
		$this->assertEquals(5,count($output));
		
	}
	
}
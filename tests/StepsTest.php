<?php

require("A.php");

class StepsTest extends PHPUnit_Framework_TestCase {
	
	public function testStep(){
		
		$steps = new \Breadam\StepsPHP\Steps(new \Breadam\StepsPHP\DefaultResolver);
		
		$steps->step("B.A.x");
		$steps->step("B.A.y");
		$steps->step("B.A.sum");
		
		$output = $steps->run(array(
			"x" => 1,
			"y" => 2
		));
		
		echo var_dump($output);
		
		$this->assertEquals(1,1);
		
	}
	
}
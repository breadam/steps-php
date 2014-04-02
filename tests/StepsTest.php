<?php

require("A.php");

class StepsTest extends PHPUnit_Framework_TestCase {
	
	public function testStep(){
		
		$steps = new \Breadam\StepsPHP\Steps;
		
		$steps->step("b.a.x");
		$steps->step("b.A.y");
		$steps->step("b.A.sum");
		
		$output = $steps->run(array(
			"x" => 1,
			"y" => 2,
			"a" => array(
				"b" => array(
					"c" => 3434
				)
			)
		));
		
		echo var_dump($output);
		
		$this->assertEquals(1,1);
		
	}
	
}
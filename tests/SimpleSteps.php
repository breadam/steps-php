<?php

require_once(__DIR__."/../vendor/autoload.php");

class SimpleSteps extends Breadam\Steps\Steps {
	
	protected $steps = array("StepA","StepB");
	
}
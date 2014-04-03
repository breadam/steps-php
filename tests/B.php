<?php namespace B;

class B extends \Breadam\StepsPHP\Steps{
	
	protected $steps = array(
		"b.b.x",
		"b.b.y",
		"b.b.sum"
	);
	
	public function stepx($steps,$x){
		$steps->x = $x+1;
	}
	
	public function stepY($steps,$y){
		$steps->y = $y+1;
	}
	
	public function stepSum($steps,$a_b_c,$y){
		$steps->call("b.a.x");
		$steps->out("b",$a_b_c);
	}
	
}
<?php namespace B;

class A{
	
	public function stepX($steps,$x){
		$steps->x = $x+1;
	}
	
	public function stepY($steps,$y){
		$steps->y = $y+1;
		$steps->call("B.A.sum");
	}
	
	public function stepSum($steps,$x,$y){
		$steps->call("B.A.x");
		$steps->out("b",654);
	}
	
}
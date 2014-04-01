<?php namespace B;

class A{
	
	public function stepX($steps,$x){
		$steps->x = $x+1;
	}
	
	public function stepY($steps,$y){
		$steps->y = $y+1;
	}
	
	public function stepSum($steps,$aBCD,$y){
		$steps->call("B.A.x");
		$steps->out("b",$aBC);
	}
	
}
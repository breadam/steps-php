<?php namespace Breadam\StepsPHP;

interface ResolverInterface{
	
	public function resolve($name);
	
	public function className();
	
	public function stepName();
}
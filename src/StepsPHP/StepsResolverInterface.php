<?php namespace Breadam\StepsPHP;

interface StepsResolverInterface{
	
	public function resolve($name);
	
	public function className();
	
	public function stepName();
}
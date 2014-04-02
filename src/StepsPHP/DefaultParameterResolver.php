<?php namespace Breadam\StepsPHP;

class DefaultParameterResolver implements ParameterResolverInterface{
	
	public function resolve($paramName){
		return explode("_",$paramName);
	}
}

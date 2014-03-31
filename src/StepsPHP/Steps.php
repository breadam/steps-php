<?php namespace Breadam\StepsPHP;

use ReflectionClass;
use ReflectionMethod;

class Steps{

	private $resolver;	
	private $scope;
	private $output;
	private $start = false;
	private $steps = array();
	private $alias = array();
	
	public function __construct(ResolverInterface $resolver = null){
		if(is_null($resolver )){
			$this->resolver = new DefaultResolver;
		}
	}
	
	public function __set($key,$val){
		$this->scope[$key] = $val;
	}
	
	public function step($name,$alias = null){
		$this->steps[] = $name;
		
		if(isset($alias)){	
			end($this->steps);
			$this->alias[$alias] = key($this->steps);
		}
	}
	
	public function out($arg,$val = null){
	
		if(func_num_args() === 1){
			
			if(is_array($arg)){
				
				$this->output = array_merge($this->output,$arg);
				
			}else if(is_string($arg)){
				$this->call($arg);
			}
		}else{
			
			$this->output[$arg] = $val;
			
		}
	}
	
	public function run(array $input = array()){
		
		if($this->start === false){
			$this->scope = array();
		}
		
		$this->start = true;
		
		$this->scope = array_merge($this->scope,$input);
		
		foreach($this->steps as $step){
			$this->output = array();
			$this->call($step);			
		}
		$this->start = false;
	
		return $this->output;
	}
	
	public function call($name){
		
		if(array_key_exists($name,$this->alias)){
			$name = $this->steps[$this->alias[$name]];	
		}
		
		$this->resolver->resolve($name);
		
		$className = $this->resolver->className();
		$stepName = $this->resolver->stepName();
		
		$class = new ReflectionClass($className);
		
		$step = $class->getMethod($stepName);
		$args = $this->prepareArguments($step);
		
		call_user_func_array($step->getClosure(new $className),$args);
		
		$this->scope = array_merge($this->scope,$this->output);
	}
	
	private function prepareArguments(ReflectionMethod $method){
		
		$args = array();
		
		foreach($method->getParameters() as $parameter){
		
			$paramName = $parameter->getName();
			
			if($paramName === "steps"){
				$args[] = $this;
			}else{
				if(array_key_exists($paramName,$this->scope)){
					$args[] = $this->scope[$paramName];
				}else{
					$args[] = null;
				}
			}
		}
		
		return $args;
	}
}

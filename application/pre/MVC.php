<?php

namespace Pre;

use RuntimeException;


trait MVC{
	
	protected static $register;
	
	public function getModel($model)
	{
		return Collector::getModel($model);
	}
	
	public function setRegister($key, $value)
	{
		Collector::setRegister($key, $value);
		return $this;
	}
	
	public function getRegister($key)
	{
		return Collector::getRegister($key);
	}
}
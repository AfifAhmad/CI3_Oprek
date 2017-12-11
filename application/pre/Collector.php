<?php

namespace Pre;


class Collector {
	
	protected static $models;
	protected static $register;
	
	public static function getModel($model)
	{
		if(is_null(self::$models)){
			self::$models = array();
		} 
		
		$index = strtolower($model);
		$buffer = explode("/", $index);
		$newname = "";
		foreach($buffer as $k=>$row){
			$newname .= ($k?"\\":"").ucfirst($row);
		}
		if(array_key_exists($newname, self::$models)){
			return self::$models[$newname];
		} else {
			$class = "Model\\".$newname;
			if(class_exists($class, true)){
				self::$models[$newname] = new $class;
				return self::$models[$newname];
			} else {
				throw new RuntimeException("Class model {$index} is not available");
			}
		}
	}
	
	public static function setRegister($key, $value)
	{
		if(is_null(self::$register)){
			self::$register = array();
		} 
		self::$register[$key] = $value;
	}
	
	public static function getRegister($key)
	{
		if(is_null(self::$register)){
			self::$register = array();
		} 
		if(array_key_exists($key, self::$register)){
			return self::$register[$key];
		} else {
			return null;
		}
	}
}
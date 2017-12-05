<?php

namespace Pre;

use RuntimeException;


trait MVC{
	
	public function getModel($model)
	{
		static $models;
		if(is_null($models)){
			$models = array();
		} 
		
		$index = strtolower($model);
		$buffer = explode("/", $index);
		$newname = "";
		foreach($buffer as $k=>$row){
			$newname .= ($k?"\\":"").ucfirst($row);
		}
		if(array_key_exists($newname, $models)){
			return $models[$newname];
		} else {
			$class = "Model\\".$newname;
			if(class_exists($class, true)){
				$models[$newname] = new $class;
				return $models[$newname];
			} else {
				throw new RuntimeException("Class model {$index} is not available");
			}
		}
	}
	
}
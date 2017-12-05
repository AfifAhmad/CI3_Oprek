<?php

namespace Controller\Coba2;

use Pre\Controller\Main;

class Bar extends Main{
	
	public function fooAction()
	{
		$model = $this -> getModel("Master/Language");
		print_r($model);die;
	}
	
}
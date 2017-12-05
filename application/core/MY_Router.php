<?php

class MY_Router extends CI_Router{

	public $class_file;
	
	protected function _set_request($segments = array())
	{
		if (empty($segments))
		{
			$this->_set_default_controller();
			return;
		}
		
		$segment_buffer = $segments;
		$arguments = array();
		while(true){
			if($segment_buffer){
				$class_path = explode(" ",ucwords(strtolower(implode(" ",$segment_buffer))));
				$path = implode("/", $class_path);
				$file_path = APPPATH."controllers/".$path.'.php';
				if(file_exists($file_path)){
					$class_controller = "Controller\\".implode('\\', $class_path);
					if(empty($arguments)){
						array_unshift($arguments, "index");
					}
					break;
				} else {
					array_unshift($arguments, array_pop($segment_buffer));
				}
			} else {
				break;
			}
		}
		if(!isset($class_controller)){
			$class_controller = "Controller\\Index";
			array_unshift($arguments, "index");
		}
		
		array_unshift($arguments, $class_controller);
		if ($this->translate_uri_dashes === TRUE)
		{
			$class_controller = str_replace('-', '_',$class_controller);
			if (isset($arguments[1]))
			{
				$arguments[1] = str_replace('-', '_', $arguments[1]);
			}
		}

		$this->set_class($class_controller);
		if (isset($arguments[1]))
		{
			$this->set_method($arguments[1]);
		}
		else
		{
			$arguments[1] = 'index';
		}
		

		$this->uri->rsegments = $arguments;
	}

	protected function _set_default_controller()
	{
		if (empty($this->default_controller))
		{
			show_error('Unable to determine what should be displayed. A default route has not been specified in the routing file.');
		}

		// Is the method being specified?
		if (sscanf($this->default_controller, '%[^/]/%s', $class, $method) !== 2)
		{
			$method = 'index';
		}
		
		

		$class = 'Controller\\'.implode('\\', explode(" ",ucwords(strtolower(implode(" ",explode('/', $class))))));


		$this->set_class($class);
		
		if ( ! file_exists(APPPATH.'controllers/'.$this->directory.$this->class_file.'.php'))
		{
			// This will trigger 404 later
			return;
		}
		
		$this->set_method($method);

		// Assign routed segments, index starting from 1
		$this->uri->rsegments = array(
			1 => $class,
			2 => $method
		);

		log_message('debug', 'No URI present. Default controller set.');
	}
	
	public function set_class($class)
	{
		$this->class = $class;
		$this->class_file = preg_replace("#^Controller\\\\#", "", $class);
	}
	
	public function set_method($method)
	{
		$this->method = $method."Action";
	}
}

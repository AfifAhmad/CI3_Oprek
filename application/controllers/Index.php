<?php

namespace Controller;

class Index extends \CI_Controller {
	
	public function indexAction()
	{
		$args = func_get_args();
		if(array_key_exists(0, $args)){
			if($args[0] == "steam.wallet"){
				echo "Steam Wallet";
			}
		}
	}
}
<?php

namespace Controller;

class Index extends \CI_Controller {
	
	public function indexAction($userpath)
	{
		print_r(func_get_args());die;
	}
}
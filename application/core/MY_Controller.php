<?php

class Sessioned_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!isSet($_SESSION["logged_in"]))
		{
			redirect("/backend/login");
			die();
		}
	}
}


<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
	public function index()
	{
		 //render frontend
		 return "hello there";
	}
}

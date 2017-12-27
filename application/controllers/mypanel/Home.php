<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once (APPPATH . 'controllers/mypanel/Secure_Controller.php');

class Home extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct('home');
	}

	public function index()
	{
		$this->load->view('mypanel/home');
	}

	public function logout()
	{
		$this->User->logout();
	}
}
?>
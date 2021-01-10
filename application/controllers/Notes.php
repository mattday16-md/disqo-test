<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller 
{
	public function index()
	{
		$this->determineLogin();
		
		$this->load->view("notes");
	}
	
	private function determineLogin()
	{
		$this->load->library('session');
		
		if(empty($this->session->loggedIn))
		{
			if(isset($_SERVER['PHP_AUTH_USER']))
			{
				$this->load->model("users");
				$al = $this->users->authenticateIt($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
				
				if($al)
				{
					$this->session->loggedIn = $al;
				}
				else
				{
					$this->sendLoginInfo();
				}
			}
			else
			{
				$this->sendLoginInfo();
			}
		}		
	}
	
	private function sendLoginInfo()
	{
		$this->output->set_header('WWW-Authenticate: Basic realm="Notes System"');
		$this->output->set_header('HTTP/1.0 401 Unauthorized');
		echo 'Invalid Login';
	}
}

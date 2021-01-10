<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model 
{
	public function index()
	{
		$this->determineLogin();
		
		$this->load->view("notes");
	}
	
	private function determineLogin()
	{
		$this->load->library('session');
		$this->load->database();
		
		if(empty($this->session->loginKey))
		{
			if(isset($_SERVER['PHP_AUTH_USER']))
			{
				$this->db->query("SELECT id FROM user WHERE 
			}
			else
			{
				$this->output->set_header('WWW-Authenticate: Basic realm="Notes System"');
				$this->output->set_header('HTTP/1.0 401 Unauthorized');
				echo 'Invalid Login';
			}
		}		
	}
}

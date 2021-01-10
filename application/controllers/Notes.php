<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller 
{
	public function index()
	{
		$this->determineLogin();
		$dt = array();
		
		$this->load->model("notesmodel");
		
		if(!empty($this->session->loggedInId))
		{
			$dt['notes'] = $this->notesmodel->getNotes($this->session->loggedInId);	
		}
		
		$this->load->view("notes", $dt);
	}
	
	public function saveNote()
	{
		
	}
	
	public function deleteNote()
	{
		
	}
	
	private function determineLogin()
	{
		$rt = false;
		$this->load->library('session');
		
		if(empty($this->session->loggedInId))
		{
			if(!empty($_SERVER['PHP_AUTH_USER']))
			{
				$this->load->model("usersModel");
				$al = $this->usersModel->authenticateIt($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
				
				if($al)
				{
					$this->session->loggedInId = $al;
					$rt = true;
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
		
		return $rt;
	}
	
	private function sendLoginInfo()
	{
		$this->output->set_header('WWW-Authenticate: Basic realm="Notes System"');
		$this->output->set_header('HTTP/1.0 401 Unauthorized');
		echo 'Invalid Login';
	//	exit;
	}
	
	private function getJSON()
	{
		return json_decode($this->input->raw_input_stream); 
	}
}

?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function getNotes($id)
	{
		$this->load->database();
		
		$npw = password_hash($pw, PASSWORD_DEFAULT);
		$rs = $this->db->query("SELECT id FROM user WHERE email = ? AND password = ?", array($un, $npw));
		$rw = $rs->row();
		
		return (isset($rw)) ? $rw['id'] : false;
	}
}

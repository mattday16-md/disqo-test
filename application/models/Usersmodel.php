<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usersmodel extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function authenticateIt($un, $pw)
	{
		$rt = false;
		
		$rs = $this->db->query("SELECT id,password FROM user WHERE email = ?", array($un));
		$rw = $rs->row();
		
		if(isset($rw))
		{
			$vr = password_verify($pw, $rw->password);
			
			if($vr)
			{
				$rt = $rw->id;
			}
		}
		
		return $rt;
	}
}

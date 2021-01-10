<?php defined('BASEPATH') OR exit('No direct script access allowed');

class NotesModel extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function getNotes($id)
	{
		$rt = array();
		
		$rs = $this->db->query("SELECT id,title,contents,create_time,last_update_time FROM note WHERE user = ?", array($id));
		
		foreach($rs->result() as $rw)
		{
			$rt[] = $rw;
		}
		
		return $rt;
	}
}

?>
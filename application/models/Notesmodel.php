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
	
	public function saveNote($id, $nid, $tt, $nt)
	{
		if(!empty($nid))
		{
			$this->db->query("UPDATE note SET title = ?, contents = ? WHERE id = ?", array($tt, $nt, $nid));
		}
		else
		{
			$this->db->query("INSERT INTO note (title,contents) VALUES (?, ?)", array($tt, $nt));
		}
		
		return true;
	}
}

?>
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
		$rt = true;
		
		try
		{
			if(!empty($nid))
			{
				$this->db->query("UPDATE note SET title = ?, contents = ? WHERE id = ?", array($tt, $nt, $nid));
				$rt = $nid;
			}
			else
			{
				$this->db->query("INSERT INTO note (user,title,contents) VALUES (?, ?, ?)", array($id, $tt, $nt));
				$rt = $this->db->insert_id();
			}
		}
		catch(Exception $x)
		{
			$rt = false;
		}
		
		return $rt;
	}
}

?>
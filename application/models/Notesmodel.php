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
			$rw->create_time = (new DateTime($rw->create_time))->format("Y-m-d H:i:s");
			$rw->last_update_time = (new DateTime($rw->last_update_time))->format("Y-m-d H:i:s");
			
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
				$this->db->query("UPDATE note SET title = ?, contents = ?, last_update_time = NOW() WHERE id = ?", array($tt, $nt, $nid));
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
	
	public function deleteNote($id)
	{
		$rt = true;
		
		try
		{
			$this->db->query("DELETE FROM note WHERE id = ?", array($id));
		}
		catch(Exception $x)
		{
			$rt = false;
		}
		
		return $rt;
	}
}

?>
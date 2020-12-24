
<?php

/**
 * @Author: juliarnasution
 * @Date:   2020-12-24 15:14:54
 * @Last Modified by:   Dell
 * @Last Modified time: 2020-12-24 17:20:29
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct()
	{
		
	}

	public function get($id=NULL)
	{
		if ($id) {
			$this->db->where('userid',$id);
			return $this->db->get('users')->row_array();
		}else{
			return $this->db->get('users')->result_array();
		}
	}

	public function add($data)
	{
		if ($data) {
			$this->db->insert('users',$data);
			return ($this->db->affected_rows()>0);
		}
		return false;
	}

	public function update($id, $data)
	{
		$this->db->where('userid',$id);
		$this->db->update('users',$data);
		return ($this->db->affected_rows()>0);
	}

	public function delete($id)
	{
		$this->db->where('userid',$id);
		$this->db->delete('users');
		return ($this->db->affected_rows()>0);
	}

}

/* End of file User.php */
/* Location: ./application/models/User.php */
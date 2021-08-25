<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Assets_model extends CI_Model {	

	function create($data=array()){
		$this->db->trans_start();
		$this->db->insert('assets',$data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}	

	function update($data=array(), $asset_id){
		$this->db->where('asset_id', $asset_id);
		$this->db->update('assets', $data);
		return true;
	}	

	function get_asset($asset_id){
		$query = $this->db->query("SELECT * FROM assets WHERE asset_id = '" . (int)$asset_id . "' ");
		return $query->row();
	}	

	function get_assets($data=array()){
		$sql = "SELECT * FROM assets WHERE 1=1";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return array();
		}
	}	

	public function get_total_asset($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM assets ";
		$query = $this->db->query($sql);
		return $query->row()->total;
	}	

	function delete($asset_id){
		$this->db->where('asset_id', $asset_id);
		$this->db->delete('assets');
		return true;
	}

}

?>
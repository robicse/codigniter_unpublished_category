<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class welcome_model extends CI_Model {
	
	public function select_all_published_category()
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('publication_status',1);
		$query_result=$this->db->get();
		$result=$query_result->result();
		return $result;
		//echo '<pre>';
		//print_r($result);
		//echo '</pre>';
	}
}
?>
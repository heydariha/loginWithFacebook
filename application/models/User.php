<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
#___________________________________________________
    function __construct() {
        parent::__construct();
    }
#___________________________________________________
    function getUser($userId='') {
        $query = $this->db->query("SELECT * FROM users WHERE IF('$userId' <> '',user_id = '$userId',1)");
        return $query->result_array();
    }

#___________________________________________________	
	function putUser(array $array)
	{
		$query	= "REPLACE INTO users (fb_id,fb_name,fb_profile_pic,fb_is_active) VALUES ( '{$array['fb_id']}' , '{$array['fb_name']}' , '{$array['fb_profile_pic']}' , '{$array['fb_is_active']} ')";
		$this->db->query($query);
		$result	= $this->db->error();

		$answer['result']	= $this->db->insert_id();
		$answer['error']	= '';
		
		if($result['code']>0)
		{
			$answer['result']	= 0;
			$answer['error']	= $this->db->error();
		}
		return $answer;
	}
#___________________________________________________
}

?>
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Facebook extends CI_Controller
{
//_________________________________________________
	function __construct()
	{

	}

	function fbFactory()
	{
		$obj		= get_instance();
		$fb		= new Facebook\Facebook([
				'app_id' =>$obj->config->config['facebook_app_id'],
				'app_secret' => $obj->config->config['facebook_app_secret'],
				'default_graph_version' => $obj->config->config['facebook_default_graph_version']
		]);
		return $fb;
	}
	
}

?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Facebook\FacebookSession;

class Login extends CI_Controller 
{
/*
*
* Show user information for logged users or redirect for login with facebook
*
*/
	public function index()
	{
		$fb		= $this->facebook->fbFactory();
		if($user = $this->facebook->checkIfLogedIn($fb))
		{
			$data['record']['fb_name']	= $user['name'];
			$data['record']['fb_profile_pic'] = "https://graph.facebook.com/v2.2/{$user['id']}/picture";
			$this->load->view('login/profile',$data);
		}
		else
		{
			$helper = $fb->getRedirectLoginHelper();
			$permissions = []; // Optional information that your app can access, such as 'email'
			$loginUrl = $helper->getLoginUrl(base_url('login/callback'), $permissions);
			$data['content']	= htmlspecialchars($loginUrl);
			$this->load->view('login/loginv',$data);
		}
	}
/*
*
* OAuth call back function
* login process and saving in to database
*
*/
	public function callback()
	{
		$fb	= $this->facebook->fbFactory();
		if($accessToken = $this->facebook->login($fb))
		{
			$record			= $this->facebook->getUser($fb,$accessToken);
			$result			= $this->user->putUser($record);
		}
		redirect('login');
	}
	
}

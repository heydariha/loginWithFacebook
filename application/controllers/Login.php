<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller 
{
	public function index()
	{
		$fb	= $this->facebook->fbFactory();
		$helper = $fb->getRedirectLoginHelper();
		$permissions = []; // Optional information that your app can access, such as 'email'
		$loginUrl = $helper->getLoginUrl(base_url('login/callback'), $permissions);
		$data['content']	= htmlspecialchars($loginUrl);
		$this->load->view('login/loginv',$data);
	}
	
	
	
	public function callback()
	{
		$fb	= $this->facebook->fbFactory();
		$helper = $fb->getRedirectLoginHelper();

		try
		{
			$accessToken = $helper->getAccessToken(base_url('login/callback'));
		} catch(Facebook\Exceptions\FacebookResponseException $e) 
		{
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) 
		{
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if (! isset($accessToken)) 
		{
			if ($helper->getError()) 
			{
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			}
			else
			{
				redirect('login');
			}
			exit;
		}

		$response = $fb->get('/me?fields=id,name', $accessToken->getValue());
		$user = $response->getGraphUser();

		$temp			= $response->getGraphUser();
		$record			= array('fb_id'=>$temp['id'],
								'fb_name'=>$temp['name'],
								'fb_profile_pic'=>"https://graph.facebook.com/v2.2/{$temp['id']}/picture",
								'fb_is_active'=>'1'
								);
		$result			= $this->user->putUser($record);
		$data['record']	= $record;
		$this->load->view('login/profile',$data);
	}
	
}

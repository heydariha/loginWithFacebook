<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class PAGE extends CI_Controller{
    var $HEAD			= '';
    var $FOOT			= '';
    var $DIRECTION	= 'ltr';
    var $title			= 'facebook Login';
    var $icon			= '';
    var $acse			= '';
    var $keyWord	= 'facebook Login';
//_________________________________________________
	function __construct()
	{
		// $it =& get_instance();
		// $it->authentication->checkSession();
	}
//_________________________________________________
    function headPage()
    {
        global $confArray;
        $HEAD = "<!DOCTYPE html>
        <head>
            <link rel='shortcut icon' href='{$this->icon}' type='image/ico'/>
			<title> {$this->title} </title>
			<meta name='keywords' content='{$this->keyWord}'>
			{$this->acse}
        </head>
        <body dir='{$this->DIRECTION}'>
        <div id='modalContentDiv'></div>
        <div id='ERROR'></div>";
        echo $HEAD.$this->HEAD;
    }
//_________________________________________________
    function footPage()
    {
//<div>Copyright © 2006 Company. All Rights Reserved. XHTML 1.1 | CSS | design/inspired by growldesign</div>
         $this->FOOT = "
		</body>
	</html>";
        echo $this->FOOT;
    }
}

?>
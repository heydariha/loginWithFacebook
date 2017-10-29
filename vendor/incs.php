<?php
# shows arrays
function print_arr($a_arg,$dir = "ltr")
{
    echo "<pre style='text-align:left;direction:ltr'>";
    print_r ($a_arg);
    echo  "</pre>";
}
//_______________________________________________________________________
function content($arr,$field,$default='')
{
	$default	= $default ? $default : Null;
	if(is_array($arr))
	{
		return isset($arr[$field]) ? $arr[$field] : $default;		
	}
	else
	if(is_object($arr))
	{
		return isset($arr->$field) ? $arr->$field : $default;
	}
}
//_______________________________________________________________________
//_______________________________________________________________________
?>
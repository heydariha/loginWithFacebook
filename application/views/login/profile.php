<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$page		= new PAGE();
$page->headPage();
?>


	<center>
		<img src='<?php echo $record['fb_profile_pic']; ?>' style='width:200px;height:200px;margin-top:150px'>
		<br>
		<?php  
			
			echo $record['fb_name'];
		?>
	<center>


<?php
$page->footPage();
?>
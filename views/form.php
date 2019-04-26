<?php
$ci =& get_instance();
$ci->load->helper("form");
$ci->load->helper("url");
echo form_open(uri_string(), null, $fields);
?>
<p style="text-align:center;">Parameters have been loaded!</p>
<p style="text-align:center;"><input type="submit" value="Run Tests"/></p>
<?=form_close();?>

<h3 style="text-align:center;"><?=$class?> <?=isset($function) ? "=>" : ""?> <?=isset($function) ? $function : ""?></h3>
<p style="text-align:center;"><?=$test_count?> Tests Carried Out.</p>
<p style="text-align:center;"><font color="green"><?=$passed_count?></font> Tests Passed.</p>
<p style="text-align:center;"><font color="<?=$failed_count > 0 ? "red" : "green"?>"><?=$failed_count?></font> Tests Failed.</p>
<?php if (isset($classes)) {?>
  <p style="text-align:center;"><?=$classes?> Class<?=($classes == 0 || $classes > 1) ? "es" : ""?>.</p>
<?php }?>
<?php if (isset($functions)) {?>
  <p style="text-align:center;"><?=$functions?> Function<?=($functions == 0 || $functions > 1) ? "s" : ""?>.</p>
<?php }?>


<?php if (ini_get("xdebug.profiler_enable")): ?>
	<a class="btn primary large" id="fuel_profiler_get_grind" onclick="window.location.hash='#profiler_tab_speed/grind';window.location.reload(true)">Run webgrind</a>
<?php endif; ?>
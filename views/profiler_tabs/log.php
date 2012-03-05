<?php
if (!isset($log)) {
	$log = array();
	foreach(\Profiler::get_combined_log() as $item) {
		if (!isset($filter) || array_search($item['type'],$filter) !== false) {
			$log[] = $item;
		}
	}
}
; ?>
<div class="left-column">

	<?php if (isset($overviews) && count($overviews)): ?>
		<div class="overviews">
			<?php foreach ($overviews as $overview): ?>
				<div class="item"><?php echo $overview; ?></div>
			<?php endforeach ?>
		</div>
	<?php endif; ?>

	<?php if (!isset($filter) || count($filter) != 1): ?>
		<div class="filters">
			<h4>Filters</h4>
			<ul class="filters">
				<li class="_all active" onclick="window.location.hash = '#profiler_tab_<?php echo $tab->get_id(); ?>/'"><div><strong>All:</strong> <?php echo count($log); ?> Message<?php echo count($log) == 1 ? "" : "s" ; ?></div></li>
				<?php foreach((isset($filter) ? $filter : \Profiler::get_log_types()) as $value): ?>
					<li class="<?php echo str_replace(" ","-",$value); ?>" onclick="window.location.hash = '#profiler_tab_<?php echo $tab->get_id(); ?>/<?php echo str_replace(" ","-",$value); ?>'"><div><strong><?php echo ucfirst($value); ?>:</strong> <?php echo count(\Profiler::get_log($value)); ?> Message<?php echo count(\Profiler::get_log($value)) == 1 ? "" : "s" ; ?></div></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>



	<div class="search">
		<h4>Search</h4>
		<input class="search" onkeyup="profiler_search(FuelPHProfiler.jQuery('#profiler_tab_content_<?php echo $tab->get_id(); ?> .log table'),FuelPHProfiler.jQuery(this).val())" />
	</div>

</div>

<div class="right-column">

	<div class="log" id="profiler_tab_<?php echo $tab->get_id(); ?>_log">
		<?php if (count($log)): ?>
			<table>
				<?php foreach ($log as $value): ?>
					<?php if (!isset($filter) || array_search($value['type'],$filter) !== false): ?>
						<tr class="<?php echo str_replace(" ","-", $value['type']); ?>">
							<th><?php echo ucfirst(str_replace(" ","&nbsp;",$value['type'])); ?></th>
							<td>
								<?php if ($value['type'] == 'inspect') : ?>
									<ul class="top"><?php profiler_branch(null,$value['message'],0,\Config::get('profiling.inspect_expand_tree',false)); ?></ul>
								<?php else: ?>
									<?php echo $value['message']; ?>
								<?php endif; ?>
							</td>
							<td class="data"><?php echo isset($value['time']) ? \Profiler::get_readable_time($value['time']) : ""; ?></td>
							<td class="data"><?php echo isset($value['data']) ? $value['data'] : (isset($value['memory']) ? \Profiler::get_readable_file_size($value['memory']) : (isset($value['timer']) ? \Profiler::get_readable_time($value['timer']) : "")); ?></td>
						</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</table>
		<?php else: ?>
			<p class="blank_slate">There are no log messages to display.</p>
		<?php endif; ?>

	</div>
</div>

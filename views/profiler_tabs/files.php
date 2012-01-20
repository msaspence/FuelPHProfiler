<div class="left-column">

	<div class="overviews">
		<div class="item"><?php echo count($files); ?> File<?php echo count($files) == 1 ? "" : "s"; ?></div>
		<div class="item">Total size: <?php echo \Profiler::get_readable_file_size($size); ?></div>
		<div class="item">Largest file: <?php echo \Profiler::get_readable_file_size($largest); ?></div>
	</div>

	<div class="search">
		<h4>Search</h4>
		<input class="search" onkeyup="profiler_search(jQuery('#profiler_tab_content_<?php echo $tab->get_id(); ?> .files table'),jQuery(this).val())" />
	</div>

</div>

<div class="right-column">

	<div class="files" id="profiler_tab_<?php echo $tab->get_id(); ?>_files">

		<table>
			<?php foreach ($files as $file): ?>
				<tr>
					<td><?php echo $file['name']; ?></td>
					<td class="data"><?php echo \Profiler::get_readable_file_size($file['size']); ?></td>
				</tr>
			<?php endforeach; ?>
		</table>

	</div>
</div>
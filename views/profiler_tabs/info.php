<div class="left-column">
	<div class="overviews">
		<div class="item"><?php echo $tab->get_fuel_version(); ?></div>
		<div class="item"><?php echo $tab->get_php_version(); ?></div>
		<div class="item"><?php echo $tab->get_app_version(); ?></div>
		<div class="item"><?php echo $tab->get_env(); ?></div>
	</div>
	<div class="search">
		<h4>Search</h4>
		<input id="profiler_tab_info_search" class="search" />
		<script type="text/javascript">
		var rows;
			jQuery("#profiler_tab_info_search").keyup(function() {

				jQuery.expr[':'].Contains = function(a, i, m) {
					return jQuery(a).text().toUpperCase()
						.indexOf(m[3].toUpperCase()) >= 0;
				};

				value = jQuery(this).val();
				content = jQuery('#profiler_tab_info_phpinfo')
				content.find('tr,h3').hide();
				rows = content.find("tr:Contains('"+value+"')");
				rows.show();
				rows.parents('table').prev('h3').show();
			});
		</script>
	</div>
</div>
<div class="right-column">
	<div class="phpinfo" id="profiler_tab_info_phpinfo">
		<?php foreach ($php_info as $key => $value): ?>
			<h3><?php echo $key == "General" ? "PHP Information" : $key; ?></h3>
			<table>
				<?php
					$columns = 1;
					foreach($value as $row_key => $row) {
						if (is_array($row)) {
							$columns = count($row);
						}
					}
				?>
				<?php foreach($value as $row_key => $row): ?>
					<tr>
						<th><?php echo $row_key; ?></th>
						<?php if (is_array($row)): ?>
							<?php foreach ($row as $cell): ?>
								<td><?php echo $cell; ?></td>
							<?php endforeach ?>
						<?php else: ?>
							<td colspan="<?php echo $columns; ?>"><?php echo $row; ?></td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endforeach ?>
	</div>
</div>

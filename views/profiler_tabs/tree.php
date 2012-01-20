
<div class="left-column">

	<?php if (isset($overviews) && count($overviews)): ?>
		<div class="overviews">
			<?php foreach ($overviews as $overview): ?>
				<div class="item"><?php echo $overview; ?></div>
			<?php endforeach ?>
		</div>
	<?php endif; ?>

	<div class="search">
		<h4>Search</h4>
		<input class="search" onkeyup="profiler_search(jQuery('#profiler_tab_content_<?php echo $tab->get_id(); ?> .nested .top'),jQuery(this).val())" />
	</div>

</div>

<div class="right-column">

	<div class="nested" id="profiler_tab_<?php echo $tab->get_id(); ?>_files">

			<?php $row = 0; $profiler_row = function ($key,$item,$nesting=0,$parent=0) use (&$profiler_row, &$row) { $row++; $this_row = $row; ?>
				<li class="nested_hidden <?php if (is_object($item) || is_array($item)) echo "has_nested_items"; ?>" data-parent="<?php echo $parent; ?>">
					<div class="key"><?php echo is_integer($key) ? "-" : $key; ?></div>
					<div class="value">
						<?php
							switch(gettype($item)) {
								case "string":
								case "float":
								case "integer":
									if (empty($item) && is_string($item)) {
										echo "<em class='fade'>Empty string</em>";
									} else {
										echo htmlentities($item);
									}
									break;
								case "boolean":
									echo $item ? "true" : "false";
									break;
								case "array":
									echo "<em>Array: ".count($item). " item". (count($item) == 1 ? "" : "s")."</em>";
									break;
								case "object":
									echo "<em>".get_class($item)."</em>";
									break;
								case "NULL":
									echo "<em class='fade'>NULL</em>";
									break;
							} ?>
					</div>
					<?php if (is_object($item) || is_array($item)): ?>
						<ul>
							<?php foreach ($item as $k2 => $i2): ?>
								<?php $profiler_row($k2, $i2, $nesting+1, $this_row); ?>
							<?php endforeach ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php } ?>

		<?php if (count($tree)): ?>
			<ul class="top">
				<?php foreach ($tree as $key => $item): ?>
					<?php $profiler_row($key,$item); ?>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p class="blank_slate">There are no items to display.</p>
		<?php endif; ?>

	</div>
</div>
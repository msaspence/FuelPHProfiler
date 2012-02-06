
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

		<?php if (count($tree)): ?>
			<ul class="top">
				<?php foreach ($tree as $key => $item): ?>
					<?php profiler_branch($key,$item,0,0); ?>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p class="blank_slate">There are no items to display.</p>
		<?php endif; ?>

	</div>
</div>
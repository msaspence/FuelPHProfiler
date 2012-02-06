<?php function profiler_branch ($key,$item,$nesting=0,$auto_expand=0) { ?>
	<li class="<?php echo $auto_expand!==true && ((is_array($item) && $auto_expand <= count($item)) || (is_object($item) && $auto_expand <= count(get_object_vars($item)))) ? "nested_hidden " : ""; ?><?php if (is_object($item) || is_array($item)) echo "has_nested_items"; ?>">
		<?php if (!is_null($key)): ?>
			<div class="key"><?php echo $key; ?></div>
		<?php endif; ?>
		<div class="value">
			<?php switch(gettype($item)) {
				case "string":
					if (empty($item) && is_string($item)) {
						echo "<em class='fade'>Empty string</em>";
					} else {
						echo '"'.htmlentities($item).'"';
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
				default:
					echo $item;
					break;
			} ?>
		</div>
		<?php if (is_object($item) || is_array($item)): ?>
			<ul>
				<?php foreach ($item as $k2 => $i2): ?>
					<?php profiler_branch($k2, $i2, $nesting+1,$auto_expand); ?>
				<?php endforeach ?>
			</ul>
		<?php endif; ?>
	</li>
<?php } ?>
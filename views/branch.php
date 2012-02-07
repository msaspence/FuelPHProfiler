<?php function profiler_branch ($key,$item,$nesting=0,$auto_expand=0) { ?>
	<li class="<?php echo $auto_expand!==true && ((is_array($item) && $auto_expand <= count($item)) || (is_object($item) && $auto_expand <= count(get_object_vars($item)))) ? "nested_hidden " : ""; ?><?php if (is_object($item) || is_array($item)) echo "has_nested_items"; ?>">
		<?php if (!is_null($key)): ?>
			<div class="key"><?php echo $key; ?></div>
		<?php endif; ?>
		<div class="value">
			<?php switch(gettype($item)) {
				case "string":
					if (empty($item) && is_string($item)) {
						echo "<span class='string'>\"\"</span>";
					} else {
						echo '<span class="string">"'.htmlentities($item).'"</span>';
					}
					break;
				case "boolean":
					echo "<span class='boolean'>";
					echo $item ? "true" : "false";
					echo "</span>";
					break;
				case "array":
					echo "<span class='array'>array (".count($item). " item". (count($item) == 1 ? "" : "s").")</span>";
					break;
				case "object":
					echo "<span class='object'>".get_class($item)."</em>";
					break;
				case "NULL":
					echo "<span class='null'>NULL</span>";
					break;
				case "integer":
				case "float":
				case "double":
					echo "<span class='number'>$item</span>";
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
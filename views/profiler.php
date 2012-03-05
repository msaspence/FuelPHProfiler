<?php echo \View::forge(__DIR__."/profiler.js.php",array('tabs'=>$tabs),false); ?>
<?php foreach ($tabs as $tab): ?>
	<?php if (method_exists($tab, 'get_js')): ?>
		<?php echo $tab->get_js(); ?>
	<?php endif; ?>
<?php endforeach ?>
<div id="fuel_profiler" style="display: none;">
	<div class="bar">
		<img class="logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAlCAYAAAC+uuLPAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpCRDQ5RDM0QjM5MjkxMUUxQUJFNzkyMEY5NkIxQTM2QSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpCRDQ5RDM0QzM5MjkxMUUxQUJFNzkyMEY5NkIxQTM2QSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkJENDlEMzQ5MzkyOTExRTFBQkU3OTIwRjk2QjFBMzZBIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkJENDlEMzRBMzkyOTExRTFBQkU3OTIwRjk2QjFBMzZBIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+3lfWyQAABaRJREFUeNqcl3uIVFUcx88dJ3czlR5KSbL9UaGikda6+GrVJEI0t2CTVHppZWSBGkXmg6CkRDPoIQRmho+1lRCLItyKEiFNsILFXipqZbuora25M7Nz554+v3t+M96ZnZkdu/DlnPM79/x+5/e8v+ulFllT8eOZh401Tcy6s6c8zzzKILRkRTwyxsQzlcucjsDNIocjm5U2hcUmmUB7vyIuPgw6nwwqebWv53mHGEeCI8baWziaRPN9rCeCNuv2/u6NkU1WrulCz9qROr+JI4s53oqWE5V2HXgO+rJehYqmZx7vVdNBnjGHGQc745g4OAfSShMGMZBC6G3GvVtWaEw07QVLfWsGgyR4CLSDK5XWxf4cxjZQxfzFcrx8rukNEqHcswyGg6UyD6zZAJqYb4jsb4FZM/T1up4DppTkJ4K7Eepba0ohY+3zAA3sOQ6t04PvsD6Vcfv9fSRmAiu0YwDL2RW61wNBzJpUuy2r6QjwgApayyX+Cg8G9iy0l/Sd2X5g7lAzv6K0O0EDdFMK3pEHM8XrgGd2M8wCv4MR4EI0hcCPYDjYy10m8748B0Ad+AFarSsF+U9QJpDGcqMZvrv5GnAh6hfQDZbrzeuZT9P915Q2GlpjMd6Wy3mH52V6FjtjdoEG8BMYLWUvuxFJ6z5gPxCNvmNjvGjL/hespxaejT74NAyEKCaABp2/Abpze+LTi4AU7steHXvTCKqA+RqlERP2viL8id4CJ2OCxWqKk2Bbnnl6BsUu6K26v4y1VLgW8I3SloTv2XwU+rQOxveqf9aCrmhE+z0jPAFe1vlUztczoq15VWlYwMwozIy8lEHzp3lJbvsH2FxBtRLsBkd1vkitJdoeAh48ny08E4skb42v+cXGJvBvUSE9tU2JVdQKM+FT6zttV6sLJuPHMXk+jaQCWtqB4CwB8bZUmqIoXr2aOPcn6AuvxzToPgW/uCqVr23WpwN4ea5eYAc43UtNLkQn2KaXbyRYrlYLvKf7RLGpyflUTXAXi+uBDz64RIFZyIfgPLgGPJJ2tA812PpFAjSn6VO+GyXUD1YYQIU4AY8vlU8jzGOadjuVNh/lqnwXvXZomNzOyc3FkjlaHMqBYrFT3x3L+kb19/aMi4dboY2S92JhbolPqafcaE9hIkdRgYn3wKdd0+5upe1jfkqtMd0FUmDG6+Z+cLIcU793nOG9ryPBI4LkY3FQabf76tNJegtJ6OB/+jOKbFmsyUgL4wR/prRRrKvjErVa/E+X7bO9sGKZmHxJyneQv+rYH1RLwxahDeHoVdjeJrKfqlK8RFCSpupc0pqBVZ7pF3ctYIlngJfr5cN7ur7ZjXKBVBwbH2dSA24upWECgR0pG/r1bAIfVHvYqKTGw3TsBFmF6nQ8Af4Rn+5TJ98j9i74ADiBSXvRtNL0coGutNsvUpdrdfxZio3W5OlKoyyajETvXj1EXpn6XHqowE4EWO0act0DhPPQE36PFnOcpqDMt+o4DIzR+VdakSwhbn+TBKbTe4Ex7CakCUr4NieosJ+RpyvtOvDsx4Bzy0Ef16KaFt/xXAntctAB7eNsnqaYrNKbyId4VZoQSGXy+qGSj9TYtNPyGTBTzbwuHVipw/NZz1PeqxHc7j5tjiCF+ZPQj4FZCWmJuYQHPgs4l+3yP8eP9E5hN/iWmv0A2JD7tEkwAItiC7DU9767yHp4vYsZbyj/j2yGMLzO+Y2ci4NvAX8FZgW0ZsZ+rI8zzmWdUFnhH1iWwWkIswL3pz0JPAHuBxulodaWsgMM1OZ7HO8uxAfXKgv5Ez8KPoqkXyspN5tfymN5l31zwsW/djVFNV+LFSb8BzVX5P9Dh3lXpR1+WYuDLTHPW0KadRQGYrzIAbmFmGcrqTEPa8xkPRRcpv+hSU38oOC8rNsQ0IJ2OzxpwL3iN/pPgAEAoVXXIKpv5uYAAAAASUVORK5CYII=" />
		<div class="tabs">
			<div class="tab_wrapper">
				<?php foreach ($tabs as $id => $tab): ?>
					<div class="tab" id="profiler_tab_<?php echo $id; ?>" data-tab="<?php echo $id; ?>" <?php if(method_exists($tab, 'get_icon') && $tab->get_icon()) { echo "style='background-image: url({$tab->get_icon()})'"; } ?>>
						<?php if ($id == "info"): ?>
							<table>
								<tr class="top">
									<td class="fuel_version first"><?php echo $tab->get_fuel_version(); ?></td>
									<td class="php_version"><?php echo $tab->get_php_version(); ?></td>
								</tr>
								<tr>
									<td class="app_version first"><?php echo $tab->get_app_version(); ?></td>
									<td class="env"><?php echo $tab->get_env(); ?></td>
								</tr>
							</table>
						<?php else: ?>
							<h3><?php echo $tab->get_title(); ?></h3>
							<h4><?php echo $tab->get_summary(); ?></h4>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="details">
		<div class="tabs">
			<img id="profiler_close" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACcAAAAnCAYAAACMo1E1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDoyNUI0QjU1RjM5RkIxMUUxODMyNENGQzQ2QUE1NTEzNiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDoyNUI0QjU2MDM5RkIxMUUxODMyNENGQzQ2QUE1NTEzNiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjI1QjRCNTVEMzlGQjExRTE4MzI0Q0ZDNDZBQTU1MTM2IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjI1QjRCNTVFMzlGQjExRTE4MzI0Q0ZDNDZBQTU1MTM2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+FKNpTAAAAthJREFUeNq8mNFn21EUx+9+nbyW8KP0qZRMSGVGn1adsjGpTWb7I/owqf0DY+8lo5S8j9G9jJVY5KGap1pfViulhDLCCGGUH2Pnxjftr9nv3HvP/d3s8BU/ufecj9z8zjn33Gm1WsrD5kiPoWXSImkBnz9JA3xekDrQH2mQu8L1D0kNQM0zaxahB3h+QxoB8D2p5xosclxXJn0hHZFeGsA4m8e+I/gph4ArkJqkH6SaCmM1+GvCvxdckfQVxzgLa8B/UQqnf/ZvpHU1W1tHnLIrXEz6TFpS/8eWEC+2wen/wD7SQ5YlOUG4/cuIWzDBNQ1HeU66R2p7grWx/9xwxE0OTuewLQPYI1Kf9MIDsI19ffjhALfA8Q/cjgVsgOcrIeAE7ArPAwvgzjSczvirDmBKCDgNphwAV8FzDccdZ4yamWU2QA4sXeZiw/GO4YqG7K+/65KqQkAbWNWSgDVPUcNtWMqIFNAFrGuqDODZiByrgCvg2wBg16lFw1Uc3zoXwHeBwLRVImGZsgGqQGDjshZ59GaTbqU6Q7BxD+gDN0kxGrBkWVeytUU2uJFnrTwhXVrWXGKdj/32hbOlC2klybJhhGI8C7C8gH0NdxoQbC4g4GkkuKq5ZP7vhrwpBexFuE8mOcEqeCvLSBt5ATVPR8MNSQc5wbqpDiMOAHgweSG07TGLjoVgSgh4zHy/l+7nOkw+qhraKQ7MFbDGVJkT8Nxq07eZ1uUDqS4EswHW4TerVdvOukP0mOPVDj6SngnBOMA6/GWBtdLZI8qgPmQA9zExkoBNAzYMYDrua9O9Vb/Cr5iqUcDNSAqWBuSGNxeIm9jGEb9Imw5FPZTpOM8R12mQc0a6zxxxSDtEnDPpCEwn5yek3RmB7cL/0Hd4mOBPupJjRpJVcVbgN/EdHt7qEEhPSWukTx494Aj71uDHqROSDqx7UHqaXlI3k/QFdTNJH2Dc4D1N/yvAAOcl1IPctlWLAAAAAElFTkSuQmCC" />
			<?php foreach ($tabs as $id => $tab): ?>
				<div class="tab_content" data-tab="<?php echo $id; ?>" id="profiler_tab_content_<?php echo $id; ?>" >
					<h2><?php echo $tab->get_title(); ?></h2>
					<?php if ($tab->output()): ?>
						<?php echo $tab->output(); ?>
					<?php else: ?>
						<p class="blank_slate">This tab has no content to display.<p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
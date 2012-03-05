<script type="text/javascript">
	(function($) {
		$().ready(function() {
			var fetch_grind = function() {
				if (window.location.hash === "#profiler_tab_speed/grind") {
					$.ajax({
						url: '<?php echo Uri::create("_fuel_profiler/latest_grind"); ?>',
						success: function(data, textStatus, jqXHR) {
							console.log(data);
						}
					});
				}
			}

			fetch_grind();

		});
	})(jQuery);
</script>
<script type="text/javascript">

	if (jQuery === undefined) {
		var jQuery_tag = document.createElement("script");
		jQuery_tag.setAttribute("type", "text/javscript");
		jQuery_tag.setAttribute("src", "https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js");
		document.getElementsByTagName("head")[0].appendChild(sheet);
	}

	(function($) {

		$().ready(function() {

			var sheet = document.createElement("style");
			sheet.setAttribute("type", "text/css");
			sheet.innerHTML = '<?php 
				echo str_replace(array("\n","'"),"",\View::forge(__DIR__.'/profiler.css')); /* "' */
				foreach($tabs as $tab) {
					if (method_exists($tab,"get_css")) {
						echo $tab->get_css();
					}
				}
			?>';
			document.getElementsByTagName("head")[0].appendChild(sheet);

			var fuel_profiler = $('#fuel_profiler');

			// Resize details
			calculate_details_height = function() {
				height = $(window).height();
				height = height - fuel_profiler.find('.bar').height() + 3;
				fuel_profiler.find('.details').css('height',height);
			}
			calculate_details_height();
			$(window).resize(function(){
				calculate_details_height();
			});

			var activate_tab = function(tab) {

				if ($(tab).length) {
					if ($(tab).hasClass('active') || !fuel_profiler.hasClass('open')) {
						fuel_profiler.toggleClass('open');
					}

					$(tab).addClass('active');
					$(tab).siblings().removeClass('active');
					$(".tab_content").removeClass('active');
					$(".tab_content[data-tab="+$(tab).data('tab')+"]").addClass('active');
				} else {
					fuel_profiler.toggleClass('open');
				}

			}

			fuel_profiler.find('.tab').click(function() {
				if (window.location.hash == "#"+$(this).attr('id')) {
					window.location.hash = "";
				} else {
					window.location.hash = "#"+$(this).attr('id');
				}
			});

			if (window.location.hash !== "") {
				activate_tab($(window.location.hash));
			}

			$(window).bind('hashchange', function() {
				activate_tab($(window.location.hash));
			});

			$('#profiler_close').click(function() {
				fuel_profiler.removeClass('open');
			});

			$('ul li.has_nested_items').click(function() {
				jQuery(this).toggleClass('nested_hidden');
				return false;
			});

			$('ul li.has_nested_items li:not(.has_nested_items)').click(function() {
				return false;
			});

		});

	})(jQuery);

	jQuery.expr[':'].profiler_icontains = function(a, i, m) {
		return jQuery(a).text().toUpperCase()
			.indexOf(m[3].toUpperCase()) >= 0;
	};
	var profiler_activate_filter = function (table,value,filter) {
		filter.siblings().removeClass('active');
		filter.addClass().addClass('active');
		table.find('tr').removeClass('filter_hidden');;
		table.find('tr:not(.'+value+')').addClass('filter_hidden');
	}

	var profiler_search = function (table,value,filter) {
		if (value === "") {
			table.removeClass('search_hidden search_show').find("tr,li").removeClass('search_hidden search_show');
		} else {
			rows = table.find("tr:profiler_icontains('"+value+"'),li:profiler_icontains('"+value+"')");
			table.find('tr,li').addClass('search_hidden').removeClass('search_show search_show_children');
			rows.removeClass('search_hidden');
			rows.addClass('search_show').parent('ul').addClass('search_show');
			table.find("li:has( > div:profiler_icontains('"+value+"'))").addClass('search_show_children');
		}
	}

</script>
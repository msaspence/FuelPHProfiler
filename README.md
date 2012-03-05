README
======

What is FuelPHProfiler?
-----------------

FuelPHPProfiler is a package for FuelPHP designed to improve the profiler.

What makes it better than the built in profiler?
-------------------------------------------------

FuelPHProfiler aims to add the following improvements:

 * FuelPHP style - The profiler's style matches the FuelPHP web site and error pages.
 * Modular - Profiler tabs can be implemented and added by apps or other packages
 * Overidable views - App developers can override the default tabs themes with their own output
 * Search and filter - Search outputs in the client using JavaScript
 * Stays open - Open tabs are track using the url hash, so refreshing the page will keep your position

Requirements
------------

FuelPHProfiler has been tested with FuelPHP 1.1

Installation
------------

You can install the package manually by downloading into to your packages directory or using [oil][1].

To enable you need to add the following two lines to your app/bootstrap.php's Autoloader::add_classes() call.

```php
Autoloader::add_classes(array(
	/* ... */
	'Profiler'	=> PKGPATH.'/fuelphprofiler/classes/profiler.php',
	'Console' 	=> PKGPATH.'/fuelphprofiler/classes/console.php',
	/* ... */
));

```

and add the following to your app/config/config.php (you will probably want to do this in app/config/development/config.php though)


```php
return array(
	/* ... */
	'profiling' => true,
	/* ... */
);

Configuring
------------

```php
return array(
	/* ... */
	'profiling' => array( // Whether to enable profiling defaults to false
		'tabs' => array( // An array of tab classes to display, in order. Implementing this will prevent other packages' profiler tabs from automatically appearing and you will have to add them to this array manually.
			'FuelPHProfiler\Tab\Info', // Displays PHP, App, FuelPHP version and env in summary. Displays searchable result of phpinfo() in content.
			'FuelPHProfiler\Tab\Console', // Displays combined output of profiler logs.
			'FuelPHProfiler\Tab\Speed', // Displays output of split (\Profiler::mark()) and timer (\Profiler::start_timer(),\Profiler::stop_timer()) logs
			'FuelPHProfiler\Tab\Query', // Displays output of query log (\Profiler::start(),\Profiler::stop())
			'FuelPHProfiler\Tab\Memory', // Displays output of memory log (\Profiler::start_memory())
			'FuelPHProfiler\Tab\Files', // Displays all files included
			'FuelPHProfiler\Tab\Config', // Displays FuelPHP configuration array
			'FuelPHProfiler\Tab\Session', // Displays session variables
			'FuelPHProfiler\Tab\Request', // Displays contents of $_REQUEST ($_POST, $_GET,$_COOKIE merged)
		),
		'disable' => array( // An array of tabs to disable, use this to control visible tabs with out worrying about custom package tabs appearing in the profiler
			/* ... */
		),
		'template' => PKGPATH.'fuelphprofiler/views/profiler.php', // Path to the main profile template file to be inserted before the closing body tag.
		'views' => array ( // An array of view files to override the view files for each tab where the key is the tab class and the value is the file name inside your app's view dir
			/* ... */
		)
		'session_summary' => 'username', // The $_SESSION variable to display in the session tab summary, if the variable is not set will display 'anonymous'. Set to false to display the number of items instead.
		'inspect_expand_tree' => 10, // The number of properties and values for which inspected objects and arrays should start closed. Set to false to start closed what ever, and true to start opened whatever, defaults to false.
	),
	/* ... */
);
```

Implementing additional tabs
----------------------------

You can add additional tabs by calling, probably the best place to do this is in your bootstrap.

```php
\Profiler::add_tab($tab_class)
```

Where $tab_class is a string of a class name to instantiate for the tab. The class must implement FuelPHProfiler\TabInterface and the following methods:
 * get_id() - should return a unique id for the tab
 * get_title() - should return a string to be used for the first line of the tab
 * get_summary() - should return a string to be used for the second line of the tab
 * output() - should return a string to be used for the content of the tab

The tab may also implement:
 * get_css() - should return a string of css, this css will affect the entire page so all selectors should be prefixed with "#fuel_profiler #profiler_tab_content_<return value of get_id>"
 * get_js() - should return a string of javascript
 * get_icon() - should return a string which is a data uri of a 16x16 image to be used as the tabs icon

You may wish to use either of the resuable tabs views that FuelPHProfiler provides, the tree view (as used by the request, session and config tabs) or the log view (as used by the console, speed, queries and memory tabs). To do this you should extend FuelPHProfiler\Tab which implements all of the methods required by FuelPHProfiler\TabInterface, instead you should set $title, $id, $icon, $summary as properties on your class. To choose which view to use you should set the $template property to either 'profiler_tabs/tree.php' or 'profiler_tabs/log.php'. To pass data to the view you should implement get_data() and it should return an array with the following key values:
 * overviews - an array of strings to display at the top of the left column in either view
 * tree - an array or object to make explorable for the tree view
 * log - an array of log messages to display for the log view, each log item should be an array of the following key values
  * type - the type of log message
  * message - the text of the log entry
  * time - the time into the request the message was logged
  * data - a second column to display after time (used by the memory tab to display memory usage)
 * filter - an array of log types the user can filter by

If you do not provide a log value for the log view the combined log from the FuelPHProfiler will be limited to the types in the file value.

This way you could use the profilers built in Profiler::log('custom_type',"My message") and a tab class like this:

```php
class MyTab extends FuelPHProfiler\Tab {
	$id = "my_tab";
	$title = "My Tab";
	$summary = "Summary";
	public function get_data() {
		return array(
			'filter' => array('custom_type');
		);
	}
}
```

This would create a profiler tab that just displays message logged with Profiler::log('custom_type',"My message")

API
---

```php
\Profiler::console($text[,$auto_open]); // log a message, if $auto_open is set to true the profiler will automatically open and if a single log message type is set to auto open it will filter by that type, defaults to false
\Profiler::inspect($text[,$auto_open]); // inspect a variable, if $auto_open is set to true the profiler will automatically open and if a single log message type is set to auto open it will filter by that type, defaults to true
\Profiler::mark($text); // log a point in time after the request
\Profiler::start_timer($id[,$text]); // start a timer, if $text isn't set id will be used
\Profiler::stop_timer($id); // stop a timer, $id must match the corresponding $id of the start_timer call
\Profiler::mark_memory($text); // log a point in time and the current memory usage
\Profiler::log($type,$text[,$time[,$auto_open]]); // log a message where $type is the group of messages, $text is the message, if $time is not provided the current time will be used, if it is it should be a timestamp in seconds from the start of the request, if $auto_open is set to true the profiler will automatically open, defaults to false
\Profiler::start($dbname,$sql); // Start timing a database query
\Profiler::stop(); // Stop the last database query timer, you can not start multiple query timers
```

Shorthand
---------

You can also use the short hand class and methods by adding  the following to your app/bootstrap.php

```php
Autoloader::add_classes(array(
	/* ... */
	'P'	=> PKGPATH.'/fuelphprofiler/classes/p.php',
	/* ... */
));
```

Theses are as follows

```php
\P::c($text[,$auto_open]); // log a message, if $auto_open is set to true the profiler will automatically open and if a single log message type is set to auto open it will filter by that type, defaults to false
\P::i($text[,$auto_open]); // inspect a variable, if $auto_open is set to true the profiler will automatically open and if a single log message type is set to auto open it will filter by that type, defaults to true
\P::m($text); // log a point in time after the request
\P::st($id[,$text]); // start a timer, if $text isn't set id will be used
\P::spt($id); // stop a timer, $id must match the corresponding $id of the start_timer call
\P::mm($text); // log a point in time and the current memory usage
\P::l($type,$text[,$time[,$auto_open]]); // log a message where $type is the group of messages, $text is the message, if $time is not provided the current time will be used, if it is it should be a timestamp in seconds from the start of the request, if $auto_open is set to true the profiler will automatically open, defaults to false
\P::s($dbname,$sql); // Start timing a database query
\P::sp(); // Stop the last database query timer, you can not start multiple query timers
```

Setting app name and version
----------------------------

In you app's bootstrap.php

```php
define('APP_NAME','My App');
define('APP_VERSION','0.1.0');

```



<?php



// Path to artisan
$artisan = realpath(__DIR__ . '/../eimager_app/artisan');

// Run the command
$output = shell_exec("php $artisan storage:link");

// Show output
echo "<pre>$output</pre>";

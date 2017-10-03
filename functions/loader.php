<?php
  // Get the current path info
  $function_path = pathinfo(__FILE__);

  // Loop through all php files within this functions directory...
  foreach ( glob($function_path['dirname'] . '/*.php') as $file) {
    // ... and if it's not loader.php, include it
    if ( basename($file) !== 'loader.php' ) {
      include $file;
    }
  }
?>

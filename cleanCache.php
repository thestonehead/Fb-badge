<?php 
  $files = glob("cache/*");
  $now   = time();

	foreach ($files as $file) {
		if (is_file($file)) {
			if ($now - filemtime($file) >= 60 * 60 * 24 ) { // 1 day
				unlink($file);
			}
		}
	}
?>
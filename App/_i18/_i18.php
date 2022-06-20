<?php // Needed to encode in UTF8 ààéàé //
  $filename  = $international.".php";
  // echo "filename : $filename";
  if (file_exists($filename)) {
    include($filename);
  }
?>
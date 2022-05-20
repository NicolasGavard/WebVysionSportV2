<?php
  $folder = '';
  dirToArray(__DIR__, '');

  function dirToArray($dir, $folder) {
    $cdir   = scandir($dir);
    foreach ($cdir as $key => $value){
      if (!in_array($value,array(".","..","index.php"))){
        if (is_dir($dir . DIRECTORY_SEPARATOR . $value)){
          echo '<b>'.$value.'</b><br>';
          dirToArray($dir . DIRECTORY_SEPARATOR . $value, $value);
        } else {
          echo ' - <a href="./'.$folder.'/'.$value.'">'.$value.'</a><br>';
        }
      }
    }
  }
?>
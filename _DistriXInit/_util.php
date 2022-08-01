<?php
function convertToScript(array $strings):string {
  $script = "<script sync>";
  foreach ($strings as $varName => $string) {
    if (strpos($string, "'") === FALSE) {
      $script .= " var ".$varName."='".$string."';";
    } else {
      $script .= ' var '.$varName.'="'.$string.'";';
    }
  }
  $script .= " </script>";
  return $script;
}

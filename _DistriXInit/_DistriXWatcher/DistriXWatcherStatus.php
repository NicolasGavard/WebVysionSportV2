<?php
include("DistriXWatcher.php");
$status = DistriXWatcher::status();
switch ($status) {
  case 0:
    echo "DistrixWatcher : Stopped<br/>";
    break;
  case 1:
    echo "DistrixWatcher : Available<br/>";
    break;
  default:
    echo "DistrixWatcher : status unknown<br/>";
    break;
}

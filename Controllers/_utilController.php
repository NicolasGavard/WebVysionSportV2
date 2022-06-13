<?php
function getErrorText(string $errorCode, array $datas):string {
  $errorText = "";
  $posStart = 0;

  foreach ($datas as $index => $data) {
    $needle = "{".$index."}";
    $pos = strpos($errorCode, $posStart);
    if ($pos !== FALSE) {
      $errorText .= substr($errorCode, $posStart, $pos-1);
      $errorText .= $data;
      $errorText .= substr($errorCode, ($pos-1) + strlen($needle));

      $posStart = $pos + strlen($needle) + strlen($data);
    } else {
      break;
    }
  }
  return $errorText;
}

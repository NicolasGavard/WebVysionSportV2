<?php // Needed to encode in UTF8 ààéàé //
function getStringAmount($amount, $replacedby)
{
//echo "**$amount**";
  $pointexiste = strpos($amount, '.') !== FALSE;
  $virguleexiste = strpos($amount, ',') !== FALSE;
//echo "**$pointexiste**";
  $txtaprespoint = "";
  if ($pointexiste)   $txtaprespoint = strstr($amount, '.');
  if ($virguleexiste) $txtaprespoint = strstr($amount, ',');
  
//echo "**$txtaprespoint**";
  $valueavantpoint = 0;
  if ($pointexiste || $virguleexiste)
  {
    if ($pointexiste || $virguleexiste)
      $valueavantpoint = 0 + substr($amount, 0, strpos($amount, '.'));
    else
      $valueavantpoint = 0 + substr($amount, 0, strpos($amount, ','));
  }
  else
    $valueavantpoint = $amount;
//echo "**$valueavantpoint**";

  if ($valueavantpoint)
  {
    $len = strlen($valueavantpoint);
    if ($len > 6)
    {
      if ($len > 9)
        $valueavantpoint = substr($valueavantpoint, 0, $len-9).$replacedby.substr($valueavantpoint, $len-9, $len-7).$replacedby.substr($valueavantpoint, $len-6, $len-4).$replacedby.substr($valueavantpoint, $len-3, $len);
      else
        $valueavantpoint = substr($valueavantpoint, 0, $len-6).$replacedby.substr($valueavantpoint, $len-6, $len-4).$replacedby.substr($valueavantpoint, $len-3, $len);
    }
    else
      if ($len > 3)
        $valueavantpoint = substr($valueavantpoint, 0, $len-3).$replacedby.substr($valueavantpoint, $len-3, $len);
  }
  $value = "" .$valueavantpoint . $txtaprespoint;
//echo "**$value*<br/>*";

  return $value;
}

function getUserStringDate($date, $daytext)
{
$ret = $a = $m = $j = "";

  if ($date > 0)
  {
    $a = substr($date,0,4);
    $m = intval(substr($date,4,2));
    $j = substr($date,6);

    $ret = "$j.$m.$a";
  }
  return $ret;
}

function getStringDate($date, $daytext)
{
 if ($date > 0)
 {
  $a = substr($date,0,4);
  $m = intval(substr($date,4,2));
  $j = substr($date,6);

  if (setlocale(LC_TIME, 'fr_FR') == '')
  {
    setlocale(LC_TIME, 'FRA');  //correction problème pour windows
    $format_jour = '%#d';
  } 
  else
    $format_jour = '%e';

  if ($daytext)
    return strftime("%A $format_jour %B %Y", strtotime($a.'-'.$m.'-'.$j));
  else
    return strftime("$format_jour %B %Y", strtotime($a.'-'.$m.'-'.$j));
 }
 else return "";
}

function getjmaDate($date)
{
$a = $m = $d = 0;
  if ($date > 0 && strlen($date)>6)
  {
    $a = intval(substr($date,0,4));
    $m = intval(substr($date,4,2));
    $d = intval(substr($date,6));
  }
  return array($a, $m, $d);
}

function getTimeFromString($timestring)
{
$time = 0;

  if (strpos($timestring, ':') > 0)
  {
    $hour = substr($timestring, 0, strpos($timestring, ':'));
    $min  = substr($timestring, strpos($timestring, ':')+1);
    $time = ($hour * 100) + $min;
  }
 
return $time;
}

function getStringFromTime($time)
{
$stringtime = "";
$hour = $min = $sec = "00";

  if (strlen($time) > 5)
  {
    $hour = substr($time, 0, 2);
    $min  = substr($time, 2, 2);
    $sec  = substr($time, 4, 2);
  }
  else
  {
    if (strlen($time) > 4)
    {
      $hour = substr($time, 0, 1);
      $min  = substr($time, 1, 2);
      $sec  = substr($time, 3, 2);
    }
    else
    {
      if (strlen($time) > 3)
      {
        $hour = substr($time, 0, 2);
        $min  = substr($time, 1, 2);
      }
      else
      {
        if (strlen($time) == 2)
          $hour = substr($time, 0, 2);
        else
        {
          if (strlen($time) == 1)
            $hour = substr($time, 0, 1);
        }
      }
    }
  }
  $stringtime = $hour.':'.$min.':'.$sec;
  return $stringtime;
}

function gethmsTime($time)
{
$hour = $minute = $seconde = 0;
 $hour = intval($time/10000);
 $minute = intval(($time-($hour*10000))/100);
 return array($hour, $minute, intval(substr($time,strlen($time)-2)));
}

function getCurrentNumDate()
{
 return date("Ymd");
}

function getCurrentNumTime()
{
 return date("His");
}

function getWebsiteURL()
{
  $isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");

  $port = (isset($_SERVER["SERVER_PORT"]) && 
          ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") 
          || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
        
  $port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';

  $path = substr($_SERVER["REQUEST_URI"], 0, 
                strlen($_SERVER["REQUEST_URI"])-(strlen(strrchr($_SERVER["REQUEST_URI"], '/'))));

  $url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.$path;

  return $url;
}

function generateRandomText($nbchar)
{
$txt = "";
  for ($indqr=0; $indqr<$nbchar; $indqr+=1)
  {
    $code = mt_rand(48, 122);
    if ($code < 58 || ($code > 64 && $code < 91) || $code > 96) 
      $txt .= chr($code);
  }
  return $txt;
}

?>
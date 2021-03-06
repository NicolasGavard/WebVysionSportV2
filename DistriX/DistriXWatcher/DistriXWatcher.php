<?php
// DistriX
include("../DistriXSvc/Config/DistriXSvcAuthData.php");
include("../DistriXSvc/Config/DistriXEnv.php");
include("../DistriXSvc/Const/DistriXSvcConst.php");
include("../DistriXSvc/Data/DistriXSvcAppData.php");
include("../DistriXSvc/Data/DistriXSvcData.php");
include("../DistriXSvc/Data/DistriXSvcErrorData.php");
include("../DistriXSvc/Data/DistriXSvcLayerData.php");
include("../DistriXSvc/Svc/DistriXSvc.php");
include("../DistriXSvc/Svc/DistriXSvcBase.php");
include("../DistriXSvc/Svc/DistriXSvcBusService.php");
include("../DistriXSvc/Svc/DistriXSvcCaller.php");
include("../DistriXSvc/Svc/DistriXSvcController.php");
include("../DistriXSvc/Svc/DistriXSvcDataService.php");
include("../DistriXSvc/DistriXSvcUtil.php");
include("../DistriXSvc/../DistriXApiToken/Data/DistriXApiTokenData.php");
// Data
include("Data/DistriXWatcherData.php");
// StorData
include(__DIR__ . "/Data/DistriXWatcherStorData.php");
// Storage
include("../DistriXDbConnection/DistriXPDOConnection.php");
include(__DIR__ . "/Storage/DistrixWatcherStor.php");
// Layer
include("Layers/DistriXWatcherSvcCaller.php");

if (!class_exists("DistriXWatcher", false)) {
  class DistriXWatcher
  {
    static $servicesData = [];

    public static function addToWatch(DistriXWatcherData $data)
    {
      self::$servicesData[] = $data;
    }

    public static function status()
    {
      $status = -1; // unknown
      $settingsContent = file_get_contents("./DistriXWatcherSettings.json");
      $jsonArray = json_decode($settingsContent, true);
      if (isset($jsonArray["DistriXWatcherRunning"])) {
        $status = $jsonArray["DistriXWatcherRunning"];
      }
      return $status;
    }

    public static function toggleOnOff()
    {
      $settingsContent = file_get_contents("./DistriXWatcherSettings.json");
      $jsonArray = json_decode($settingsContent, true);
      if (isset($jsonArray["DistriXWatcherRunning"])) {
        $jsonArray["DistriXWatcherRunning"] = !($jsonArray["DistriXWatcherRunning"]);
        $newSettingsContent = json_encode($jsonArray);
        file_put_contents("./DistriXWatcherSettings.json", $newSettingsContent);
      }
    }

    public static function start()
    {
      $shouldRun        = false; // true or false
      $loopInterval     = 0; // Seconds
      $stopHour         = 0; // Hour to exit the loop. Format : hhmmss.
      $adjustedStopHour = 0; // Hour + 2 * $loopInterval
      $currentTime      = 0;
      // Save in log file
      // Save in database

      list($shouldRun, $loopInterval, $stopHourString, $stopHour) = self::getSettings();
      if (strlen($stopHourString) > 0) {
        $adjustedStopHour = date('His', strtotime($stopHourString . ' +' . (2 * $loopInterval) . ' seconds'));
        // echo "stopHourString : $stopHourString<br/>";
        // echo "adjustedStopHour : $adjustedStopHour<br/>";
        // echo "stopHour : $stopHour<br/>";
      } else {
        $stopHour = -1;
      }
      $currentTime = date("His");

      self::getWatchFiles();

      $databasefile = "Db/Infodbwatcher.php";
      $dbConnection = new DistriXPDOConnection($databasefile, "");
      if (!empty(self::$servicesData) && is_null($dbConnection->getError())) {
        while ($shouldRun && ($currentTime < $adjustedStopHour || $stopHour == 0)) {
          set_time_limit(60);

          $startTime = hrtime(true);

          $distrixSvc = new DistriXSvc();

          foreach (self::$servicesData as $serviceData) {
            $watcherSvcCaller = new DistriXWatcherSvcCaller();
            $watcherSvcCaller->setServerAddress($serviceData->getServerAddress());
            $watcherSvcCaller->setServerCall($serviceData->getServerCall());
            $watcherSvcCaller->setServerDirectory($serviceData->getServerDirectory() . "/DistriX");
            $watcherSvcCaller->setServiceName("DistriXWatcher/Svc/DistriXWatcherSvc.php");
            $watcherSvcCaller->addParameter("Data", $serviceData);
            $distrixSvc->addToCall($serviceData->getFileToInclude(), $watcherSvcCaller);
          }
          $called = $distrixSvc->call();
          foreach (self::$servicesData as $serviceData) {
            list($outputOk, $output, $errorData) = $distrixSvc->getResult($serviceData->getFileToInclude());
            // var_dump($output);
            // var_dump($errorData);
            // echo "<br/>";
            if (!empty($output) && isset($output["Data"])) {
              if ($outputOk && $output["Data"] == $serviceData->getExpectedReturnValue()) {
                $serviceData->setAlive(true);
                $callTime = (hrtime(true) - $startTime) / 1e+6;
                $serviceData->setResponseTime($callTime);

                $storData = new DistriXWatcherStorData();

                $serviceName = $serviceData->getFileToInclude();
                $strToSearch = "/";
                $pos = strrpos($serviceData->getFileToInclude(), $strToSearch);
                if ($pos !== FALSE) {
                  $serviceName = substr($serviceName, $pos + strlen($strToSearch));
                }
                $storData->setService($serviceName);
                $storData->setWatchDate(DistriXSvcUtil::getCurrentNumDate());
                $storData->setWatchTime(DistriXSvcUtil::getCurrentNumTime());
                $storData->setRespoonseTime($callTime);
                list($insere, $id) = DistriXWatcherStor::save($storData, $dbConnection);
              } else {
                var_dump($errorData);
              }
            }
          }
          // var_dump(self::$servicesData);

          $stopTime = hrtime(true);

          $secondsToSleep = round($loopInterval - (($stopTime - $startTime) / 1e+9), PHP_ROUND_HALF_UP);
          // echo "secondsToSleep : $secondsToSleep<br/>";
          if ($secondsToSleep > 0) {
            sleep($secondsToSleep);
          }
          list($shouldRun, $loopInterval, $stopHourString, $stopHour) = self::getSettings();

          $currentTime = date("His");
          // break;
        }
        echo "<br/>The Watcher is stopped.<br/>";
      }
    }
    // End of start
    private static function getWatchFiles()
    {
      $watchFilesDir = "WatchFiles";
      if (is_dir($watchFilesDir)) {
        $files = scandir($watchFilesDir);
        foreach ($files as $file) {
          if (!is_dir($file)) {
            include($watchFilesDir . "/" . $file);
            if (isset($data)) {
              self::addToWatch($data);
            }
          }
        }
      }
    }
    private static function getSettings()
    {
      $shouldRun      = false;
      $loopInterval   = 0;
      $stopHourString = 0;
      $stopHour       = 0;

      $string = file_get_contents("./DistriXWatcherSettings.json");
      $json_a = json_decode($string, true);
      foreach ($json_a as $key => $value) {
        if ($key == "DistriXWatcherRunning") {
          $shouldRun = $value;
        }
        if ($key == "DistriXWatcherLoopInterval") {
          $loopInterval = $value;
        }
        if ($key == "DistriXWatcherStopHour") {
          $stopHourString = $value;
          $stopHour = date('His', strtotime($stopHourString));
        }
      }
      return array($shouldRun, $loopInterval, $stopHourString, $stopHour);
    }
    // End of getSettings
  }
}

<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXLogger', false)) {
  class DistriXLogger
  {
    const LOG_MESSAGE = "LOG_MESSAGE";
    const LOG_INFO    = "LOG_INFO";
    const LOG_ERROR   = "LOG_ERROR";
    const LOG_WARNING = "LOG_WARNING";

    static $typeData = null;

    public static function isLoggerRunning(string $loggerSettings, $element): array
    {
      $loggerRunning = false;
      $error = new DistriXSvcErrorData();

      if (file_exists($loggerSettings)) {
        include($loggerSettings);
        if (isset($DistriXLoggerSettings["running"]) && isset($DistriXLoggerSettings["running"][$element])) {
          $loggerRunning = $DistriXLoggerSettings["running"][$element];
          $typeData = new DistriXLoggerTypeData($DistriXLoggerSettings);
          self::$typeData = $typeData;
        } else {
          // Error
        }
      } else {
        // Error
      }
      return array($loggerRunning, $error);
    }

    public static function log(DistriXLoggerInfoData $loggerInfoData, DistriXLoggerEmailData $loggerEmailData = null): ?DistriXSvcErrorData
    {
      $logFilename   = "";
      $errorData     = null;

      if (!is_null(self::$typeData)) {
        $logFilename = self::$typeData->getLogFilename();
        $logFormatStrings = explode(" ", self::$typeData->getLogFormat());

        if (self::$typeData->getLogDaily()) {
          $logFilename .= "_" . $loggerInfoData->getLogDate();
        }
        $logFilename .= self::$typeData->getLogExtension();

        $setForLogging = ($loggerInfoData->getLogType() == self::LOG_MESSAGE && self::$typeData->getLogMessage());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_INFO && self::$typeData->getLogInfo());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_ERROR && self::$typeData->getLogError());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_WARNING && self::$typeData->getLogWarning());

        if ($setForLogging) {
          $fHandler = null;
          if (self::$typeData->getLogAppend()) {
            $fHandler = fopen($logFilename, 'a');
          } else {
            $fHandler = fopen($logFilename, 'w');
          }
          if ($fHandler !== FALSE) {
            $logData = $loggerInfoData->getLogData();
            if (is_array($logData)) {
              foreach ($logData as $dataToLog) {
                if (!is_null($logFormatStrings) && $logFormatStrings !== FALSE) {
                  $messageToLog = "";
                  foreach ($logFormatStrings as $logFormatString) {
                    $logFormatStringTrimmed = trim($logFormatString, " [ ]");
                    $method = "getLog$logFormatStringTrimmed";
                    if ($logFormatStringTrimmed != "Parameters" && $logFormatStringTrimmed != "Message") {
                      $messageToLog .= "[$logFormatStringTrimmed-" . $loggerInfoData->$method() . "]";
                    } else {
                      if ($logFormatStringTrimmed == "Parameters") {
                        $messageToLog .= "[$logFormatStringTrimmed-" . json_encode($loggerInfoData->$method()) . "]";
                      }
                      if ($logFormatStringTrimmed == "Message") {
                        $messageToLog .= " " . $logData;
                      }
                    }
                  }
                  fwrite($fHandler, $messageToLog . "\r\n");
                } else {
                  fwrite($fHandler, $dataToLog . "\r\n");
                }
              }
            } else {
              if (!is_null($logFormatStrings) && $logFormatStrings !== FALSE) {
                $messageToLog = "";
                foreach ($logFormatStrings as $logFormatString) {
                  $logFormatStringTrimmed = trim($logFormatString, " [ ]");
                  $method = "getLog$logFormatStringTrimmed";
                  if ($logFormatStringTrimmed != "Parameters" && $logFormatStringTrimmed != "Message") {
                    $messageToLog .= "[$logFormatStringTrimmed-" . $loggerInfoData->$method() . "]";
                  } else {
                    if ($logFormatStringTrimmed == "Parameters") {
                      $messageToLog .= "[$logFormatStringTrimmed-" . json_encode($loggerInfoData->$method()) . "]";
                    }
                    if ($logFormatStringTrimmed == "Message") {
                      $messageToLog .= " " . $logData;
                    }
                  }
                }
                fwrite($fHandler, $messageToLog . "\r\n");
              } else {
                fwrite($fHandler, $logData . "\r\n");
              }
            }
            fclose($fHandler);
          } else {
            // Error
          }
          if (!is_null($loggerEmailData)) {
            $toEmail = $loggerEmailData->getLogEmail();
            $subject = $loggerEmailData->getLogEmailSubject();
            $message  = "[" . date('D Y-m-d H:i:s') . "] [application " . $loggerInfoData->getLogApplication() . "]";
            $message .= " [function " . $loggerInfoData->getLogFunction() . "]" . "\n\r" . $logData;
            $message  = wordwrap($message, 200, "\r\n");
            $headers = $loggerEmailData->getLogEmailSender();
            // mail($to_email,$subject,$message,$headers);
            if (!@mail($toEmail, $subject, $message, $headers)) {
              $logData  = "Failed to connect to mailserver, verify your SMTP and smtp_port\r\n";
              $logData .= "Email : $toEmail - Sender : " . $loggerEmailData->getLogEmailSender() . "\r\n";
              $logData = DistriXSvcUtil::getCurrentNumDate() . " " . DistriXSvcUtil::getCurrentNumTime() . " " . $logData . "\r\n";
              $fHandler = fopen($logFilename, 'a+');
              if ($fHandler !== FALSE) {
                fwrite($fHandler, $logData);
                fclose($fHandler);
              } else {
                // Error
              }
            }
          }
        }
      } else {
        // Error
      }
      return $errorData;
    }
    // $to_email = 'iterror@ekim.fr';
    // $subject  = '['.date('D Y-m-d H:i:s').'] [client '.$_SERVER['REMOTE_ADDR'].'] [pazziria '.$idPos.'] [application '.$application.'] [function '.$function.']';
    // $message  = wordwrap("[".date('D Y-m-d H:i:s')."] [client ".$_SERVER['REMOTE_ADDR']."] [pazziria ".$idPos."] [application '.$application.'] [function ".$function."]"."\n\r".$arMsg, 200, "\r\n");
    // $headers  = 'From: pazziria@pazzi.co';
    // // mail($to_email,$subject,$message,$headers);
    // if(!@mail($to_email,$subject,$message,$headers)){
    //   $arMsg = "Failed to connect to mailserver, verify your SMTP and smtp_port";
    //   $stEntry.=$arLogData['log_datetime']." ".$arMsg."\r\n";  
    //   $stCurLogFileName = date('Ymd').'_'.$application.'_errorlog.txt';  
    //   $fHandler = fopen('../../ErrorLog/'.$stCurLogFileName,'a+');  
    //   fwrite($fHandler,$stEntry);  
    //   fclose($fHandler);
    // }
  }
}

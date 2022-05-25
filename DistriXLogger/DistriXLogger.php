<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXLogger', false)) {
  class DistriXLogger
  {
    const LOG_EMERGENCY = 'LOG_EMERGENCY';
    const LOG_CRITICAL  = 'LOG_CRITICAL';
    const LOG_ERROR     = "LOG_ERROR";
    const LOG_ALERT     = 'LOG_ALERT';
    const LOG_WARNING   = "LOG_WARNING";
    const LOG_NOTICE    = 'LOG_NOTICE';
    const LOG_INFO      = "LOG_INFO";
    const LOG_DEBUG     = 'LOG_DEBUG';

    static $typeData = null;

    public static function isLoggerRunning(string $loggerSettings, $element): array
    {
      $loggerRunning = false;
      $error = new DistriXSvcErrorData();

      if (file_exists($loggerSettings)) {
        include($loggerSettings);
        if (isset($DistriXLoggerSettings["running"]) && strlen($element) == 0) {
          $loggerRunning = $DistriXLoggerSettings["running"];
        } else {
          if (isset($DistriXLoggerSettings["running"][$element])) {
            $loggerRunning = $DistriXLoggerSettings["running"][$element];
          }
        }
        if ($loggerRunning) {
          $typeData = new DistriXLoggerTypeData($DistriXLoggerSettings);
          self::$typeData = $typeData;
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

        $setForLogging = ($loggerInfoData->getLogType() == self::LOG_EMERGENCY && self::$typeData->getLogEmergency());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_CRITICAL && self::$typeData->getLogCritical());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_ERROR && self::$typeData->getLogError());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_ALERT && self::$typeData->getLogAlert());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_WARNING && self::$typeData->getLogWarning());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_NOTICE && self::$typeData->getLogNotice());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_INFO && self::$typeData->getLogInfo());
        $setForLogging = $setForLogging || ($loggerInfoData->getLogType() == self::LOG_DEBUG && self::$typeData->getLogDebug());

        if ($setForLogging) {
          $fHandler = null;
          if (self::$typeData->getLogAppend()) {
            $fHandler = fopen($logFilename, 'a');
          } else {
            $fHandler = fopen($logFilename, 'w');
          }
          if ($fHandler !== FALSE) {
            $logData = $loggerInfoData->getLogData();
            $context = $loggerInfoData->getLogContext();
            if (is_array($logData)) {
              foreach ($logData as $dataToLog) {
                if (!is_null($logFormatStrings) && $logFormatStrings !== FALSE) {
                  $messageToLog = "";
                  foreach ($logFormatStrings as $logFormatString) {
                    $logFormatStringTrimmed = trim($logFormatString, " [ ]");
                    $method = "getLog$logFormatStringTrimmed";
                    if ($logFormatStringTrimmed != "Message") {
                      $messageToLog .= "[$logFormatStringTrimmed-" . $loggerInfoData->$method() . "]";
                    } else {
                      if (!empty($context)) {
                        $posOpen = strpos($logData, "{");
                        while ($posOpen !== FALSE) {
                          $posClose = strpos($logData, "}", $posOpen);
                          if ($posClose !== FALSE) {
                            $contextName = substr($logData, $posOpen + 1, $posClose - ($posOpen + 1));
                            foreach ($context as $contextValue) {
                              if ($contextValue == $contextName) {
                                $newLogData  = substr($logData, 0, $posOpen);
                                $newLogData .= $contextValue;
                                $newLogData .= substr($logData, ($posClose + 1));
                                $logData = $newLogData;
                              }
                            }
                          } else {
                            break; // No } found. So nothing to replace. Team 28-Mar-22
                          }
                        }
                      }
                      $messageToLog .= " " . $logData;
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
                  if ($logFormatStringTrimmed != "Message") {
                    $messageToLog .= "[$logFormatStringTrimmed-" . $loggerInfoData->$method() . "]";
                  } else {
                    if (!empty($context)) {
                      $posOpen = strpos($logData, "{");
                      while ($posOpen !== FALSE) {
                        $posClose = strpos($logData, "}", $posOpen);
                        if ($posClose !== FALSE) {
                          $contextName = substr($logData, $posOpen + 1, $posClose - ($posOpen + 1));
                          foreach ($context as $contextValue) {
                            if ($contextValue == $contextName) {
                              $newLogData  = substr($logData, 0, $posOpen);
                              $newLogData .= $contextValue;
                              $newLogData .= substr($logData, ($posClose + 1));
                              $logData = $newLogData;
                            }
                          }
                        } else {
                          break; // No } found. So nothing to replace. Team 28-Mar-22
                        }
                      }
                    }
                    $messageToLog .= " " . $logData;
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

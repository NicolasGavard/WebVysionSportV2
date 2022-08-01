<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('PHP_D_Logger', false)) {
  class PHP_D_Logger
  {
    public static function log(PHP_D_LoggerTypeData $loggerTypeData, PHP_D_LoggerInfoData $loggerInfoData, PHP_D_LoggerEmailData $loggerEmailData = null)
    {
      $logFilename = $loggerTypeData->getLogFilename();
      if ($loggerTypeData->getLogDaily()) {
        $logFilename .= "_" . $loggerTypeData->getLogDate();
      }

      $fHandler = null;
      if ($loggerTypeData->getLogAppend())
        $fHandler = fopen($logFilename, 'a');
      else
        $fHandler = fopen($logFilename, 'w');

      if ($fHandler !== FALSE) {
        $logData = $loggerInfoData->getLogData();
        if (is_array($logData)) {
          foreach ($logData as $dataToLog) {
            fwrite($fHandler, $dataToLog . "\r\n");
          }
        } else
          fwrite($fHandler, $logData . "\r\n");
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
          $logData = PHP_D_SvcUtil::getCurrentNumDate() . " " . PHP_D_SvcUtil::getCurrentNumTime() . " " . $logData . "\r\n";
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


    //     $stEntry="";  
    //     $arLogData['log_datetime'] = '['.date('D Y-m-d H:i:s').'] [Ip Adress '.$_SERVER['REMOTE_ADDR'].'] [pazziria '.$idPos.'] [application '.$application.'] [function '.$function.']';  
    //     $arLogData['log_datetime'] = '['.date('D Y-m-d H:i:s').'] [Ip Adress '.$_SERVER['REMOTE_ADDR'].'] [pazziria '.$idPos.'] [application '.$application.'] [function '.$function.']';  
    //     $arLogData['log_datetime'] = '['.date('D Y-m-d H:i:s').'] [Ip Adress '.$_SERVER['REMOTE_ADDR'].'] [pazziria '.$idPos.'] [application '.$application.'] [function '.$function.']';  
    //     $arLogData['log_datetime'] = '['.date('D Y-m-d H:i:s').'] [Ip Adress '.$_SERVER['REMOTE_ADDR'].'] [pazziria '.$idPos.'] [application '.$application.'] [function '.$function.']';  
    //     if (is_array($arMsg)) {
    //   foreach($arMsg as $msg){
    //     $stEntry.=$arLogData['log_datetime']." ".$msg."\r\n";  
    //   }
    // } else {   //concatenate msg with datetime  
    //   $stEntry.=$arLogData['log_datetime']." ".$arMsg."\r\n";  
    // }
    // $stCurLogFileName = $this->getLogFilename();
    // if ($this->getLogDaily())
    // $stCurLogFileName .= "_".$this->getLogDate();

    // $fHandler = fopen('../../ErrorLog/'.$stCurLogFileName,'a+');  
    // fwrite($fHandler,$stEntry);  
    // fclose($fHandler);

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

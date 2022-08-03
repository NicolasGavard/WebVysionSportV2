<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists('DistriXDeployer', false)) {
  class DistriXDeployer
  {
    const DEPLOYER_MESSAGE = "DEPLOYER_MESSAGE";
    const DEPLOYER_INFO    = "DEPLOYER_INFO";
    const DEPLOYER_ERROR   = "DEPLOYER_ERROR";
    const DEPLOYER_WARNING = "DEPLOYER_WARNING";

    public static function getPropertyFile(string $line): string {
      return substr($line,-4,4);
    }
    
    public static function breakdownFileConfig(): object {
      include("data/DistriXDeployerConfigData.php");
      include("data/DistriXDeployerConfigEnvironmentData.php");
      include("data/DistriXDeployerConfigServerData.php");

      $lines        = array();
      $fileReleases = '../../DistrixDeployer/DistrixDeployer.config';
      $fp           = @fopen(__DIR__ . $fileReleases, "r");
      if ($fp) {
        while (($buffer = fgets($fp, 4096)) !== false) {
          $lines[] = $buffer;
        }
        fclose($fp);
      }    

      $presConfig         = $presServ         = $presBackup       = $presApp      = false;
      $presServInt        = $presServVal      = $presServVer      = $presServProd = false;
      $buildVersion       = $deploymentTrace  = $nameApplication  = '';
      $maxFilesAtOne      = $maxParallel      = 0;
      $configEnvironment  = $configServer     = array();
      
      for ($nbLine = 0; $nbLine < count($lines); $nbLine++) {
        if (stripos($lines[$nbLine], '[CONFIG]') !== false) {
          $distriXDeployerConfigData  = new DistriXDeployerConfigData();
          $presConfig                 = true;
        }
        if ($presConfig) {
          if (stripos($lines[$nbLine], "BuildVersion") !== false) {
            $buildVersion = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
            $distriXDeployerConfigData->setBuildVersion($buildVersion);
          }
          if (stripos($lines[$nbLine], "DeploymentTrace") !== false) {
            $deploymentTrace = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
            $distriXDeployerConfigData->setDeploymentTrace($deploymentTrace);
          }
          if (stripos($lines[$nbLine], "MaxFilesAtOne") !== false) {
            $maxFilesAtOne = (int) trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
            $distriXDeployerConfigData->setMaxFilesAtOne($maxFilesAtOne);
          }
          if (stripos($lines[$nbLine], "MaxParallel") !== false) {
            $maxParallel = (int) trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
            $distriXDeployerConfigData->setMaxParallel($maxParallel);
            $presConfig = false;
          }
        }
        
        if (stripos($lines[$nbLine], '[INT]') !== false)  {$presServInt = true; $sender = ''; $receiver = '';}
        if ($presServInt) {
          $presServVer = $presServVal = $presServProd = false;
          if (stripos($lines[$nbLine], "Sender") !== false) {
            $sender = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
          } 
          if (stripos($lines[$nbLine], "Receiver") !== false) {
            $receiver = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
          }
          if ($sender != "" && $receiver != "") {
            $distriXDeployerConfigEnvironmentData = new DistriXDeployerConfigEnvironmentData();
            $distriXDeployerConfigEnvironmentData->setEnvironment('INT');
            $distriXDeployerConfigEnvironmentData->setSender($sender);
            $distriXDeployerConfigEnvironmentData->setReceiver($receiver);
            $configEnvironment[] = $distriXDeployerConfigEnvironmentData;
            $distriXDeployerConfigData->setEnvironments($configEnvironment);
          }
        }
       
        if (stripos($lines[$nbLine], '[VER]')   !== false)  {$presServVer = true; $sender = ''; $receiver = '';}
        if ($presServVer) {
          $presServInt = $presServVal = $presServProd = false;
          if (stripos($lines[$nbLine], "Sender") !== false) {
            $sender = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
          } 
          if (stripos($lines[$nbLine], "Receiver") !== false) {
            $receiver = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
          }
          if ($sender != "" && $receiver != "") {
            $distriXDeployerConfigEnvironmentData = new DistriXDeployerConfigEnvironmentData();
            $distriXDeployerConfigEnvironmentData->setEnvironment('VER');
            $distriXDeployerConfigEnvironmentData->setReceiver($receiver);
            $distriXDeployerConfigEnvironmentData->setSender($sender);
            $configEnvironment[] = $distriXDeployerConfigEnvironmentData;
          }
        }

        if (stripos($lines[$nbLine], '[VAL]')   !== false)  {$presServVal = true; $sender = ''; $receiver = '';}
        if ($presServVal) {
          $presServInt = $presServVer = $presServProd = false;
          if (stripos($lines[$nbLine], "Sender") !== false) {
            $sender = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
          }
          if (stripos($lines[$nbLine], "Receiver") !== false) {
            $receiver = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
          }
          if ($sender != "" && $receiver != "") {
            $distriXDeployerConfigEnvironmentData = new DistriXDeployerConfigEnvironmentData();
            $distriXDeployerConfigEnvironmentData->setEnvironment('VAL');
            $distriXDeployerConfigEnvironmentData->setSender($sender);
            $distriXDeployerConfigEnvironmentData->setReceiver($receiver);
            $configEnvironment[] = $distriXDeployerConfigEnvironmentData;
          }
        }

        if (stripos($lines[$nbLine], '[PROD]')   !== false)  {$presServProd   = true; $sender = ''; $receiver = '';}
        if ($presServProd) {
          $presServInt = $presServVer = $presServVal = false;
          if (stripos($lines[$nbLine], "Sender") !== false) {
            $sender = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
          } 
          if (stripos($lines[$nbLine], "Receiver") !== false) {
            $receiver = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
          }
          if ($sender != "" && $receiver != "") {
            $distriXDeployerConfigEnvironmentData = new DistriXDeployerConfigEnvironmentData();
            $distriXDeployerConfigEnvironmentData->setEnvironment('PROD');
            $distriXDeployerConfigEnvironmentData->setSender($sender);
            $distriXDeployerConfigEnvironmentData->setReceiver($receiver);
            $configEnvironment[] = $distriXDeployerConfigEnvironmentData;
          }
        }
        
        if (stripos($lines[$nbLine], '[SERVERS]') !== false)  {$presServ = true;}
        if ($presServ) {
          $presServInt = $presServVer = $presServVal = $presServProd = false;
          if (stripos($lines[$nbLine], '  [Backup]') !== false)           { $presBackup = true; }
          if (stripos($lines[$nbLine], ' [')   !== false && !$presBackup) { $presApp    = true; }
          
          if ($presApp){  
            if($nameApplication == '') {
              $configBackup     = array();
              $nameApplication  = trim(substr($lines[$nbLine], 2, strlen($lines[$nbLine])-5));
              $distriXDeployerConfigServerData = new DistriXDeployerConfigServerData();
              $distriXDeployerConfigServerData->setApplication($nameApplication);
            }
            
            if (stripos($lines[$nbLine], 'MAIN_SRV') !== false) {
              $distriXDeployerConfigServerData->setServer(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, -1));
            }
            if (stripos($lines[$nbLine], 'MAIN_FOLDER') !== false) {
              $distriXDeployerConfigServerData->setFolder(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, -1));
              $presApp          = false;
              $nameApplication  = '';
            }
          }
          
          if ($presBackup) {
            if (stripos($lines[$nbLine], ' SRV') !== false) {
              $distriXDeployerConfigServerBackupData =  new DistriXDeployerConfigServerData();
              $distriXDeployerConfigServerBackupData->setServer(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, -1));
            }
            if (stripos($lines[$nbLine], ' FOLDER') !== false) {
              $distriXDeployerConfigServerBackupData->setFolder(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, -1));
              $configBackup[] = $distriXDeployerConfigServerBackupData;
              $distriXDeployerConfigServerData->setBackup($configBackup);
              $configServer[] = $distriXDeployerConfigServerData;
              $presBackup = false;
            }
          }
        }
        $distriXDeployerConfigData->setServers($configServer);
      }
      return $distriXDeployerConfigData;
    }

    public static function breakdownFileRealise(string $fileReleases, array $listFileDisregard = array()): object {
      include("data/DistrixDeployerData.php");
      include("data/DistriXDeployerElementData.php");
      include("data/DistrixDeployerPackageBuildData.php");
      include("data/DistrixDeployerPackageData.php");
      include("data/DistriXDeployerTransferElementData.php");
      include("data/DistriXDeployerTransferErrorData.php");

      $environmentToDeploy = '';
      if (stripos($fileReleases, '/Release/') !== false) {
        $environmentToDeploy = 'INT';
      }
      if (stripos($fileReleases, '/Release/INT/') !== false) {
        $environmentToDeploy = 'VER';
      }
      if (stripos($fileReleases, '/Release/VER/') !== false) {
        $environmentToDeploy = 'VAL';
      }
      if (stripos($fileReleases, '/Release/VAL/') !== false) {
        $environmentToDeploy = 'PROD';
      }

      $distrixDeployerData = new DistrixDeployerData();
      $distrixDeployerData->setDeploymentFile($fileReleases);
      $distrixDeployerData->setEnvironmentToDeploy($environmentToDeploy);
      $distriXDeployerElementData = new DistriXDeployerElementData();
      $distrixDeployerPackageBuildData = new DistrixDeployerPackageBuildData();
      
      $lines  = array();
      $fp     = @fopen(__DIR__ . $fileReleases, "r");
      if ($fp) {
        while (($buffer = fgets($fp, 4096)) !== false) {
          $lines[] = $buffer;
        }
        fclose($fp);
      }
      
      $releaseName  = '';
      $cards        = $deployerElement = array();
      $presCard     = $presModules  = $presModule = $presBuild = $presFileFolder = $presExculde = false;
      $posLine      = 0;

      for ($nbLine = 0; $nbLine < count($lines); $nbLine++) {
        for ($nbLineDisregard = 0; $nbLineDisregard < count($listFileDisregard); $nbLineDisregard++) {
          if ($listFileDisregard[$nbLineDisregard] == $nbLine) {
            $presName = false;
            
            if (stripos($lines[$nbLine], '[Cards]') !== false) {$presCard = true; $posLine = $nbLine;}
            if ($presCard) {$cards[] = $lines[$nbLine]; $presCard = false;}
            
            if (stripos($lines[$nbLine], '[Modules]') !== false) {$presModules = true; $posLine = $nbLine;}
            if ($presModules) {
              if (stripos($lines[$nbLine], '[Module]') !== false) {$presModule = true; $posLine = $nbLine;}
              
              if ($presModule) {
                if (stripos($lines[$nbLine], "name=") !== false) {$presName = true; $posLine = $nbLine;}
                if ($presName) {
                  $releaseName  = trim(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, strlen($lines[$nbLine])));
                  $distrixDeployerData->setModuleName($releaseName);
                }
                
                if (stripos($lines[$nbLine], "[build]") !== false) {
                  $presBuild                        = true;
                  $distrixDeployerPackageBuildData  = new DistrixDeployerPackageBuildData();
                  $distrixDeployerPackageBuildData->setToDeploy(true);
                  $posLine                          = $nbLine;
                }
                
                if ($presBuild) {
                  if (stripos($lines[$nbLine], "folderFrom") !== false) {
                    $distrixDeployerPackageBuildData->setFolderFrom(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, -1));
                    $posLine = $nbLine;
                  } else if (stripos($lines[$nbLine], "folderTo") !== false) {
                    $distrixDeployerPackageBuildData->setFolderTo(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, -1));
                    $posLine = $nbLine;
                  } else if (stripos($lines[$nbLine], "folderProd") !== false) {
                    $distrixDeployerPackageBuildData->setFolderProd(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, -1));
                    $posLine = $nbLine;
                  } else if (stripos($lines[$nbLine], "version") !== false) {
                    $distrixDeployerPackageBuildData->setVersion(substr($lines[$nbLine], stripos($lines[$nbLine], '=') + 1, -1));
                    $posLine = $nbLine;
                  }
                  
                  $distrixDeployerPackageData = new DistrixDeployerPackageData();
                  $distrixDeployerPackageData->setName($releaseName);
                  $distrixDeployerPackageData->setToDeploy(true);
                  $distrixDeployerPackageData->setDeployerBuild($distrixDeployerPackageBuildData);
                }
                
                if (stripos($lines[$nbLine], "[") !== false  && !$presName && $posLine < $nbLine) {             
                  $presExculde              = false;
                  $presFileFolder           = true;
                  $deployerTransferElement  = array();
                  $deployerExcludeElement   = array();
                  
                  $distriXDeployerElementData = new DistriXDeployerElementData();
                  $distriXDeployerElementData->setElement(substr(trim($lines[$nbLine]), 1, -1));
                  $distriXDeployerElementData->setToDeploy(true);
                }
                
                if (stripos($lines[$nbLine], "[") === false && $presFileFolder && !$presName && $posLine < $nbLine) {
                  $isFile = $isDir = $isSql = $isCreateOnly = false;
                  
                  if (stripos($lines[$nbLine], ".") !== false)            { $isFile=true; }
                  if (stripos($lines[$nbLine], ".") === false)            { $isDir=true; }
                  if (stripos($lines[$nbLine], ".sql") !== false)         { $isSql=true; }
                  if (stripos($lines[$nbLine], "--createOnly") !== false) { $isCreateOnly=true; }
    
                  $distriXDeployerTransferElementData = new DistriXDeployerTransferElementData();
                  $distriXDeployerTransferElementData->setElement(trim($lines[$nbLine]));
                  $distriXDeployerTransferElementData->setIsFile($isFile);
                  $distriXDeployerTransferElementData->setIsDir($isDir);
                  $distriXDeployerTransferElementData->setIsSql($isSql);
                  $distriXDeployerTransferElementData->setIsCreateOnly($isCreateOnly);
                  $distriXDeployerTransferElementData->setError(array());
                  $deployerTransferElement[] = $distriXDeployerTransferElementData;
                }
                
                if (stripos($lines[$nbLine], "[Excludes]") !== false) {$presExculde = true; $posLine = $nbLine;}
                if ($presExculde && $posLine < $nbLine) {
                  if (stripos($lines[$nbLine], ".") !== false)            { $isFile=true; }
                  if (stripos($lines[$nbLine], ".") === false)            { $isDir=true; }
                  if (stripos($lines[$nbLine], ".sql") !== false)         { $isSql=true; }
                  if (stripos($lines[$nbLine], "--createOnly") !== false) { $isCreateOnly=true; }
    
                  $distriXDeployerTransferElementData = new DistriXDeployerTransferElementData();
                  $distriXDeployerTransferElementData->setElement($lines[$nbLine]);
                  $distriXDeployerTransferElementData->setIsFile($isFile);
                  $distriXDeployerTransferElementData->setIsDir($isDir);
                  $distriXDeployerTransferElementData->setIsSql($isSql);
                  $distriXDeployerTransferElementData->setIsCreateOnly($isCreateOnly);
                  $distriXDeployerTransferElementData->setError(array());
                  $deployerExcludeElement[] = $distriXDeployerTransferElementData;
                }
    
                if (isset($lines[$nbLine]) && ($nbLine + 1) == count($lines) || stripos($lines[$nbLine + 1], "[") !== false && !$presName && $posLine < $nbLine) {
                  $distriXDeployerElementData->setTransferElements($deployerTransferElement);
                  $distriXDeployerElementData->setExcludeElements($deployerExcludeElement);
                  $deployerElement[] = $distriXDeployerElementData;
                }
              }
            }
            break;
          }
        }
      }
      $distrixDeployerPackageData->setDeployerElements($deployerElement);
      $distrixDeployerPackage[] = $distrixDeployerPackageData;
      $distrixDeployerData->setDeployerPackages($distrixDeployerPackage);
      return $distrixDeployerData;
    }

    public static function startUpgradeRealise(DistrixDeployerConfigData $distrixDeployerConfigData, DistrixDeployerData $distrixDeployerData): bool {
      print_r($distrixDeployerConfigData);
      echo '<br><br>';
      print_r($distrixDeployerData);
      return true;
    }

    public static function downloadToEnvironment(array $listFiles): array {
      include("Layers/DistriXDeployerSvcCaller.php");
      $listFilesReturn = array();
      if (!empty($listFiles)) {
        $deployerSvcCall = new DistriXDeployerSvcCaller();
        $deployerSvcCall->setServerAddress($listFiles[0]->getSenderServerAdress());
        $deployerSvcCall->setServerDirectory($listFiles[0]->getSenderServerDirectory());
        $deployerSvcCall->setServiceName("../DistrixDeployer/Svc/DistriXDeployerSvcDownloadToDataSvc.php");
        $deployerSvcCall->addParameter('data', $listFiles);
        list($outputok, $output, $errorData) = $deployerSvcCall->call();            //print_r($output);  
        if ($outputok && !empty($output) > 0 && isset($output["ListDownloadedFiles"])) {
          $listFilesReturn = $output["ListDownloadedFiles"];
        }
      }
      return $listFilesReturn;
    }

    public static function uploadToEnvironment(array $listFiles): bool {
      include("Layers/DistriXDeployerSvcCaller.php");
      $confirmedFilesTransfert = false;
      if (!empty($listFiles)) {
        $deployerSvcCall = new DistriXDeployerSvcCaller();
        $deployerSvcCall->setServerAddress($listFiles[0]->getReceiverServerAdress());
        // $deployerSvcCall->setServerDirectory($listFiles[0]->getReceiverServerDirectory());
        $deployerSvcCall->setServerDirectory($listFiles[0]->getSenderServerDirectory());
        $deployerSvcCall->setServiceName("../DistrixDeployer/Svc/DistriXDeployerSvcUploadToDataSvc.php");
        $deployerSvcCall->addParameter('data', $listFiles);
        list($outputok, $output, $errorData) = $deployerSvcCall->call();            //print_r($output);  
        if ($outputok && !empty($output) > 0 && isset($output["ConfirmedFilesTransfert"])) {
          $confirmedFilesTransfert = $output["ConfirmedFilesTransfert"];
        }
      }
      return $confirmedFilesTransfert;
    }
  }
}


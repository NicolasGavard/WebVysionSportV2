<?php // Needed to encode in UTF8 ààéàé //
if (!class_exists("DistriXSvcUtil", false)) {
  class DistriXSvcUtil
  {
    public static function setArray(array $getData, int $getDataInd, string $setDataType): array
    {
      $setData = array();
      $setMethodsArray = array();

      if (is_array($getData) && $getDataInd > 0 && $setDataType != null) {
        list($getMethods, $setMethodsArray) = self::findMethods($getData[0], $setDataType);
        for ($indS = 0; $indS < $getDataInd; $indS++) {
          $data = self::setGetMethods($getData[$indS], $getMethods, $setMethodsArray, $setDataType);
          $setData[] = $data;
        }
      }
      return array($setData, count($setData));
    }
    // End of setArray

    public static function setData($getData, string $setDataType): ?object
    {
      $data = null;
      if ($getData != null && $setDataType != null) {
        list($getMethods, $setMethodsArray) = self::findMethods($getData, $setDataType);
        $data = self::setGetMethods($getData, $getMethods, $setMethodsArray, $setDataType);
      }
      return $data;
    }
    // End of setData

    private static function setGetMethods($getData, array $getMethods, array $setMethodsArray, string $setDataType): object
    {
      $data = new $setDataType();

      foreach ($getMethods as $getMethod) {
        $setFromGetMethod = "s" . substr($getMethod, 1);
        if (isset($setMethodsArray[$setFromGetMethod])) {
          $data->$setFromGetMethod($getData->$getMethod());
        }
      }
      return $data;
    }

    private static function findMethods($getData, string $setDataType): array
    {
      $setMethodsArray = [];

      $getMethods = get_class_methods($getData);
      $getMethodsInd = count($getMethods);
      $getMethods = array_splice($getMethods, 1, $getMethodsInd);

      $startRemove = 0;
      foreach ($getMethods as $getMethod) {
        if (substr($getMethod, 0, 3) == "set") {
          break;
        }
        $startRemove++;
      }
      $getMethods = array_splice($getMethods, 0, $startRemove);
      $setMethods = get_class_methods(new $setDataType());
      foreach ($setMethods as $setMethod) {
        $setMethodsArray[$setMethod] = 1;
      }
      return array($getMethods, $setMethodsArray);
    }

    public static function getCurrentNumDate(): int
    {
      return date("Ymd");
    }

    public static function getCurrentNumTime(): int
    {
      return date("His");
    }

    public static function generateRandomText(int $nbchar, bool $onlyNumeric = false): string
    {
      $txt = "";
      for ($indqr = 0; $indqr < $nbchar; $indqr += 1) {
        $code = mt_rand(48, 122);
        if ($code < 58 || ($code > 64 && $code < 91) || $code > 96) {
          $txt .= chr($code);
        } else {
          if (!$onlyNumeric && (($code > 64 && $code < 91) || ($code > 96 && $code < 123))) {
            $txt .= chr($code);
          }
        }
      }
      return $txt;
    }

    public static function getTopDirectory(): string
    {
      $dirSep = DIRECTORY_SEPARATOR;
      $nb     = substr_count($_SERVER['PHP_SELF'], $dirSep);
      if ($nb == 0) {
        $dirSep = "/";
        $nb = substr_count($_SERVER['PHP_SELF'], $dirSep);
      }
      if ($nb > 1) {
        $nb -= 2;
      }
      return str_repeat("../", $nb);
    }
  }
}

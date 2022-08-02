<?php
if (!class_exists('DistriXCrypto', false)) {
  class DistriXCrypto extends PDO
  {
    public static function encode(string $data, string $key): string
    {
      $encodedData = "";
      $cipher      = "AES-128-CBC";

      $ivlen = openssl_cipher_iv_length($cipher);
      $iv = openssl_random_pseudo_bytes($ivlen);
      $cipherText = openssl_encrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
      $hmac = hash_hmac('sha256', $cipherText, $key, true);
      $cipherText = base64_encode($iv . $hmac . $cipherText);

      if ($cipherText !== FALSE) {
        $encodedData = trim($cipherText);
      }
      return $encodedData;
    }
    /* End function encode */

    public static function decode(string $data, string $key): string
    {
      $decodedData = "";
      $cipher      = "AES-128-CBC";
      $sha2len     = 32;

      $c = base64_decode($data);
      $ivlen = openssl_cipher_iv_length($cipher);
      $iv = substr($c, 0, $ivlen);
      $hmac = substr($c, $ivlen, $sha2len);
      $ciphertext_raw = substr($c, $ivlen + $sha2len);
      $decrypted = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
      $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
      if (hash_equals($hmac, $calcmac)) // timing attack safe comparison
      {
        $decodedData = $decrypted;
      }
      return $decodedData;
    }
    /* End function decode */

    public static function encodeOneWay(string $txNormal): string
    {
      $bDifferent = false;
      $uiTotal = $uiRemainder = 0;
      $wi = $wj = $wCount = $wCharOter = 0;
      $cChar = $txCrypte = "";

      $len = strlen($txNormal);
      for ($indT = 0; $indT < $len; $indT++) {
        $uiTotal += ord($txNormal[$indT]);
        $wi++;
      }
      //while($txNormal[$wi]) $uiTotal += $txNormal[$wi++];

      if ($wi == 0) { // Rien à faire si chaîne vide
        return "";
      }
      $uiRemainder = $uiTotal % $wi;
      if ($uiTotal == ($uiTotal - $uiRemainder)) {
        $uiRemainder = 2;
      }
      $wCount = ord($txNormal[0]) % $wi;
      if ($wCount == 0 || $wCount >= $wi) {
        $wCount = 2;
      }
      $wi = 0;
      for ($indT = 0; $indT < $len; $indT++) {
        if (ord($txNormal[$wi]) % $uiRemainder == 0 && $wCharOter != $wCount) {
          $wCharOter++;
          $bDifferent = true;
        } else {
          $cChar = ord($txNormal[$wi]) + $uiRemainder;
          if ($cChar > 30 && $cChar < 127) {
            $txCrypte[$wj++] = chr($cChar);
            $bDifferent = true;
          } else {
            $txCrypte[$wj++] = $txNormal[$wi];
          }
        }
        $wi++;
      }
      if (!$bDifferent) { // si on est ici alors wi toujours > 0  ==> Pas de problème
        $txCrypte[0]       = $txNormal[$wi - 1];
        $txCrypte[$wi - 1] = $txNormal[1];
      }
      return $txCrypte;
    }
    // End of cryptOneWay

    public static function checksumApply(string $toBeChecksumed, array $places): string
    {
      $checksumString = $toBeChecksumed;
      $len = strlen($checksumString);
      if (is_array($places) && !empty($places) && $len > $places[count($places) - 1]) {
        $total = 0;
        $nbPlaces = count($places);

        $total = self::checksumGetTotal($toBeChecksumed, $places);
        $totalLen = strlen($total);
        $total = "" . $total;

        $firstIndex = 0;
        if ($totalLen >= $nbPlaces) {
          $firstIndex = $totalLen - $nbPlaces;
        }
        $nbPlacesToZero = $nbPlaces - $totalLen;
        if ($nbPlacesToZero < 0) {
          $nbPlacesToZero = 0;
        }
        for ($indPlaces = 0; $indPlaces < $nbPlaces; $indPlaces++) {
          if (isset($checksumString[$places[$indPlaces]])) {
            if ($nbPlacesToZero > 0) {
              $checksumString[$places[$indPlaces]] = "0";
              $nbPlacesToZero--;
            } else {
              $checksumString[$places[$indPlaces]] = $total[$firstIndex++];
            }
          }
        }
      }
      return $checksumString;
    }
    // End of checkSumApply

    public static function checksumValidate(string $checksumString, array $places): string
    {
      $validated = false;
      $len = strlen($checksumString);
      if (is_array($places) && !empty($places) && $len > $places[count($places) - 1]) {
        $total         = 0;
        $totalElements = [];
        $nbPlaces      = count($places);

        for ($indElem = 0; $indElem < $nbPlaces; $indElem++) {
          $totalElements[$indElem] = "";
        }
        $total = self::checksumGetTotal($checksumString, $places);
        $totalLen = strlen($total);
        $total = "" . $total;
        $firstIndex = 0;
        if ($totalLen >= $nbPlaces) {
          $firstIndex = $totalLen - $nbPlaces;
        }
        $nbPlacesToZero = $nbPlaces - $totalLen;
        if ($nbPlacesToZero < 0) {
          $nbPlacesToZero = 0;
        }
        for ($indPlaces = 0; $indPlaces < $nbPlaces; $indPlaces++) {
          if (isset($checksumString[$places[$indPlaces]])) {
            if ($nbPlacesToZero > 0) {
              $totalElements[$places[$indPlaces]] = "0";
              $nbPlacesToZero--;
            } else {
              $totalElements[$places[$indPlaces]] = $total[$firstIndex++];
            }
          }
        }
        $validated = true;
        foreach ($places as $place) {
          if ($checksumString[$place] != $totalElements[$place]) {
            $validated = false;
            break;
          }
        }
      }
      return $validated;
    }
    // End of checksumValidate

    private static function checksumGetTotal(string $checksumString, array $places): int
    {
      $total = 0;
      $len   = strlen($checksumString);

      for ($indqr = 0; $indqr < $len; $indqr += 1) {
        $notFound = true;
        foreach ($places as $place) {
          if ($indqr == $place) {
            $notFound = false;
          }
        }
        if ($notFound) {
          $code = $checksumString[$indqr];
          if (is_numeric($code)) {
            $total += ($code * 1);
          } else {
            $total += ord($checksumString[$indqr]);
          }
        }
      }
      $total = $total * 3;
      $total = floor((($total / 1.7) + $len) * 1.5);
      return $total;
    }
  }
}

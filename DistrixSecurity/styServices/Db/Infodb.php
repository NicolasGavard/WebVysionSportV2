<?php
switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    $host   = "unpwYzCr0FzJqw5nTxHLDB+xf/RmuTaxpk7vbssBqjI9AW9SmzEItMl/NC7d/B/kYF37rNYqzRncihXJ/pAbyw==";
    $user   = "6a4LUouHb3u2BM3ul+vKrrlehg+3GLBkR2UklQpOgz5yvX6wHc9Lh6p8JK0xwOqW65eHoNjDrPq7Y3mAN8H37Q==";
    $passBD = "6a4LUouHb3u2BM3ul+vKrrlehg+3GLBkR2UklQpOgz5yvX6wHc9Lh6p8JK0xwOqW65eHoNjDrPq7Y3mAN8H37Q==";
    $bdd    = "KX1PpMC9ojjRo1tHRVmtCg3ZkvIFnhq/hr4hF5lCZSpnyjn82DTLZ/JsAjrZd6d8BpFkL90mirpSnp6u1Rf8Zw==";
    break;
  case DISTRIX_ENV_VER:
    $host   = "pazzidxsty.mysql.db";
    $user   = "pazzidxsty";
    $passBD = "EkimPazziSty2019";
    $bdd    = "pazzidxsty";
    break;
  case DISTRIX_ENV_VAL:
    $host   = "jmgxvdmsty.mysql.db";
    $user   = "jmgxvdmsty";
    $passBD = "EkimPazziSty2021";
    $bdd    = "jmgxvdmsty";
    break;
  case DISTRIX_ENV_PROD:
    $host   = "";
    $user   = "";
    $passBD = "";
    $bdd    = "";
    break;
  default:
    break;
}

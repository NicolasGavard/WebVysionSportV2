<?php
switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    // $host   = "127.0.0.1";
    $host   = "hcBk38b3M5PsEvU8Y/cU78B/W/y+PCZ4wpwHx4oMQhKjx2obGviWatv5pp1yEW3DTEdl/lF9Gj2Kd2to2lUoag==";
    // $user   = "root";
    $user   = "6a4LUouHb3u2BM3ul+vKrrlehg+3GLBkR2UklQpOgz5yvX6wHc9Lh6p8JK0xwOqW65eHoNjDrPq7Y3mAN8H37Q==";
    // $passBD = "root";
    $passBD = "6a4LUouHb3u2BM3ul+vKrrlehg+3GLBkR2UklQpOgz5yvX6wHc9Lh6p8JK0xwOqW65eHoNjDrPq7Y3mAN8H37Q==";
    // $bdd    = "devsty";
    $bdd    = "diksVtQnWpAMsmOImrEHr/cs+98EVokYMQNVpI3OfM5E3IUmNjQuJZlfBqBZri4F+fZKyqV/QT8XrtXMN5yS9w==";
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

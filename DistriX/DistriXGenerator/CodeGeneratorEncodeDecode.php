<?php
session_start();

include(__DIR__ . "/../DistriXCrypto/DistriXCrypto.php");

function encode(string $data, string $keyAes): string
{
  return DistriXCrypto::encode($data, $keyAes);
}

function decode(string $data, string $keyAes): string
{
  return DistriXCrypto::decode($data, $keyAes);
}

// $keyAes = "c1c2c3c4c5c6c7c8d1d2d3d4d5d6d7d8c1c2c3c4c5c6c7c8d1d2d3d4d5d6d7d8";
$keyAes = "";
$encode = true;
$data = "";
$resp = [];

if (@$_POST["key"]) {
  $keyAes = $_POST["key"];
}
if (@$_POST["decode"]) {
  $encode = false;
}
if (@$_POST["data"]) {
  $data = $_POST["data"];
}
if ($encode) {
  $data = encode($data, $keyAes);
} else {
  $data = decode($data, $keyAes);
}
$resp["data"] = $data;
echo json_encode($resp);

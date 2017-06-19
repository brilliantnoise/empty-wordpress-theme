<?php
$uri = $_SERVER['REQUEST_URI'];
$pieces = explode("/", $uri);
$res = $pieces[1]."/wp-admin";
if ($pieces[1] != '') $res = "/".$res;

header("Location: ".$res); /* Redirect browser */
exit();
?>
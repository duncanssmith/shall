<?php

$now = date("l j F Y ");
#$now = date("l d F Y");
$month = date("F");
$year = date("Y");
	
	$cols = 4;
	$debug = 0;
	$tablesdebug = 0;
	$debugFoo = 0;
	$imagesOn = 1;
	$smallimagesOn = 0;
	$textOn = 1;
	$infoOn = 0;
	$xmlOn = 0;
	$xmlFile = "info/sh.xml";

if ($debug) {
	$hue00 = "#aaaaaa";
	$hue01 = "#cccccc";
	$hue02 = "#bbbbbb";
	$border = 1;
	$cellpa = 0;
	$cellsp = 0;
} else {
	$border = 0;
	$cellpa = 0;
	$cellsp = 0;
	$hue00 = $hue01 = $hue02 = "#ffffff";
}

if ($imagesOn) {
	$dir = "64";
} else {
	$dir = "64";
}

?>

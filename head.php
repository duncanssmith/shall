<?php 
    #session_start();
    #$sid=session_id();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="en">
    <head>
        <link rel = "shortcut icon" href = "images/spacer.gif" />
        <link rel = "stylesheet" href = "css/main.css" type = "text/css">

        <?php //BOOTSTRAP CSS AND JS 
        /*
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <?php */ //BOOTSTRAP CSS AND JS ?>

        <meta http-equiv = "Content-Type" content = "text/html; charset=iso-8859-1">
        <meta name = "search" content = "yes">
        <?php /*!--
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        -->
        */?>
        <title><?php echo $sitename;?></title>

<?php
	
    if ($xmlOn) {
    	#$p =& new xmlParser();
    	#$p->parse($xmlFile);
    	#$p->parse('http://domain.com/rss.xml');
    	#echo "<script language=\"javascript\">\n";
    	#print_r($p->output);
    	#echo "\n</script>";
    	include 'artwork.php';
    }
	
	if ($thisPage == "index.php") {
		$section = "Home";
		$layout = "layout1";
	} else if ($thisPage == "sh_000.php") {
		$section = "Cv";
		$layout = "layout1";
	} else if ($thisPage == "sh_001.php") {
		$section = "Banners";
		$layout = "layout2";
	} else if ($thisPage == "sh_002.php") {
		$section = "Catalogues";
		$layout = "layout2";
	} else if ($thisPage == "sh_003.php") {
		$section = "Greyfriars";
		$layout = "layout2";
	} else if ($thisPage == "sh_004.php") {
		$section = "Roma";
		$layout = "layout2";
	} else if ($thisPage == "sh_005.php") {
		$section = "ThomasBewick";
		$layout = "layout2";
	} else if ($thisPage == "sh_006.php") {
		$section = "Printed";
		$layout = "layout2";
	} else if ($thisPage == "sh_007.php") {
		$section = "GoldDust";
		$layout = "layout2";
	} else if ($thisPage == "sh_008.php") {
		$section = "Ornament";
		$layout = "layout2";
	} else if ($thisPage == "sh_009.php") {
		$section = "Starmaps";
		$layout = "layout2";
	} else if ($thisPage == "sh_010.php") {
		$section = "World";
		$layout = "layout2";
	} else if ($thisPage  ==  "sh_011.php") {
		$section = "Histories";
		$layout = "layout2";
	} else if ($thisPage  ==  "sh_012.php") {
		$section = "Current";
		$layout = "layout3";
	} else if ($thisPage == "sh_013.php") {
		$section = "All";
	} // SPECIAL CASE B
	else if ($thisPage == "sh_014.php") {
		$section = "Selected";
	} // SPECIAL CASE A
	else if ($thisPage == "sh_015.php") {
		$section = "Omitted";
	} else if ($thisPage == "sh_016.php") {
		$section = "New20051031";
	} else if ($thisPage == "sh_017.php") {
		$section = "CurrentA";
		$layout = "layout2";
	} else if ($thisPage == "sh_018.php") {
		$section = "CurrentB";
		$layout = "layout2";
	} else if ($thisPage == "sh_019.php") {
		$section = "CurrentC";
		$layout = "layout2";
	} else if ($thisPage == "sh_020.php") {
		$section = "CurrentD";
		$layout = "layout2";
	} else if ($thisPage == "sh_021.php") {
		$section = "CurrentE";
		$layout = "layout2";
	} else if ($thisPage == "sh_022.php") {
		$section = "CurrentF";
		$layout = "layout2";
	} else if ($thisPage == "sh_023.php") {
		$section = "Texts";
		$layout = "layout1";
	} else if ($thisPage == "sh_024.php") {
		$section = "CurrentG";
		$layout = "layout4";
	} else { ; }

	$sectionTextArray=sprintf("%sInfo",$section);
	$TextArray=sprintf("%sText",$section);
	build_js_image_array($section,$$section,$all,$Omitted,$imagesOn);
	build_js_text_array($section,$$section,$$sectionTextArray);
?>
        <?php /*<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js" type = "text/javascript"></script> */ ?>
        <script src = "js/sh.js"> </script>
        <script src = "js/layer.js"> </script>
        <?php /*<script src = "js/vendor/jquery-1.11.1.min.js"> </script>*/ ?>
        <script src = "js/jsddm.js"> </script>

    </head>
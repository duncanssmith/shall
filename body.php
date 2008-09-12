<body>
<?php
	$duncan=false;
	if(($debug)&&($duncan)){
		echo "<p>Session ID:[".$sid."]</p>\n";
		echo "<pre>SESSION:";
		print_r($_SESSION);
		echo "</pre>\n";
	}
?>
<?php include "menu.php";?>

<!-- header -->
<div id="header">

<!-- 0 --> 
<?php
	if(!$debug){
		echo "<a href=\"#\"><img src=\"images/logo.gif\" border=\"0\"></a>\n";
	}else{
		echo "<a href=\"#\"><img src=\"images/blank_logo.gif\" border=\"1\"></a>\n";

	}
?>
<br/>
<br/>
<br/>

<h1><?php echo $sectionNames[$section];?></h1>

<!-- end header -->
</div>

<!-- content -->
<div id="content">

<?php

	if(!(isset($section))){
		echo "&nbsp;\n";
	} else {
		if($section=="Selected"){
			$omitted_set=$Omitted;
		}else{
			$omitted_set=NULL;
		}
		#layout(4,4,3,100,100);

		if($layout=="layout1"){

			$dir="160";
			$dir="326";
			if($debug){
				echo "layout:[".$layout."]\n";
				echo "dir:[".$dir."]<br/>";
				echo "section:[".$section."]<br/>\n";
				echo "TextArray:[".$TextArray."]<br/>\n";
				echo "sectionTextArray:[".$sectionTextArray."]<br/>\n";
			}
			layout1(
				$dir,
				$$section,
				$section,
				$$TextArray,
				$$sectionTextArray,
				$textFiles);

		}else if($layout=="layout3"){

			$dir="326";

			if($debug){
				echo "layout:[".$layout."]\n";
				echo "dir:[".$dir."]<br/>";
				echo "section:[".$section."]<br/>\n";
				echo "TextArray:[".$TextArray."]<br/>\n";
				echo "sectionTextArray:[".$sectionTextArray."]<br/>\n";
			}

			layout3(
				$dir,
				$$section,
				$section,
				$textFiles,
				$$TextArray,
				$$sectionTextArray);

		}else if ($layout=="layout2"){

			$dir="64";

			if($debug){
				echo "layout:[".$layout."]\n";
				echo "dir:[".$dir."]<br/>";
				echo "section:[".$section."]<br/>\n";
				echo "TextArray:[".$TextArray."]<br/>\n";
				echo "sectionTextArray:[".$sectionTextArray."]<br/>\n";
			}
			layout2(
				$dir,
				$$section,
				$omitted_set,
				$textFiles,
				$$TextArray,
				$$sectionTextArray);
		}

		$len=sizeof($$section);
		$olen=sizeof($Omitted);
	}
	if((($layout=="layout1")||($layout=="layout3"))&&($textOn)){
		show_text( $$section,
			$textFiles,
			$$TextArray);
		}
?>
<!-- end content -->
</div>
<div id="sidebar">
	<?php 

		if(is_file($soundbiteFiles[$section])){
			#echo "<h6>".$sectionNames[$section]."</h6>\n";
			include $soundbiteFiles[$section];
		}
		$a=sprintf("$%sText",$section);
		for($i=0;$i<sizeof($$a);$i++){
			echo "<div>\n";
				include $$a[$i];
			echo "</div>\n";
		}


	if($textOn){
		if($layout=="layout2"){
			show_text(
				$$section,
				$textFiles,
				$$TextArray);
		}
	}else{
		echo "<p>text is switched off</p>";
	}
		
		/*
		if($imagesOn){
			$directory=64;
			show_images(
				$directory, 
				$image_set, 
				$section, 
				$omitted_set);
		}else{
			echo "<p>images are switched off (show_images())</p>";
		}
		*/
	?>
</div>

<!-- footer -->
<div id="footer">
<?php echo $dateline;?>
	|
<?php echo $itingline;?>

<!-- end footer -->
</div>
</body>
</html>

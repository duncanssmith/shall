<body>
<?php
	$duncan=true;
	if (($debug)&&($duncan)) {
		echo "<p>Session ID:[".$sid."]</p>\n";
		echo "<pre>SESSION:";
		print_r($_SESSION);
		echo "</pre>\n";
	}
?>
    <div id="container">
        <!-- header -->
        <div id="header">

<!-- 0 --> 
<?php
	if (!$debug) {
		echo "<div id=\"logo\"><a href=\"index.php\"><img src=\"images/logo_2011.png\" border=\"0\"></a></div>\n";
	} else {
		#echo "<a href=\"#\"><img src=\"images/blank_logo.gif\" border=\"1\"></a>\n";
	}
  
?>
            <!-- end header -->
            <div id="menu">
                <?php include "new_menu.php";?>
            </div>
            </div>

            <!-- content -->
            <div id="content_container">
                <div id="left_sidebar"> 
                    <h4><?php echo $sectionNames[$section];?></h4>
                </div>
                <div id="content">

<?php
	if (!(isset($section))) {

		echo "&nbsp;\n";
	
	} else {
	
		if ($section=="Selected") {
	
			$omitted_set=$Omitted;
	
		} else {
	
			$omitted_set=NULL;
	
		}
		#layout(4,4,3,100,100);

		if ($layout=="layout1") {

			$dir="326";
			
			if ($debug) {

				echo "layout:[".$layout."]\n";
				echo "dir:[".$dir."]<br>";
				echo "section:[".$section."]<br>\n";
				echo "TextArray:[".$TextArray."]<br>\n";
				echo "sectionTextArray:[".$sectionTextArray."]<br>\n";
			
			}
			
			layout1(
				$dir,
				$$section,
				$section,
				$$TextArray,
				$$sectionTextArray,
				$textFiles);

		} else if ($layout=="layout3") {

			$dir="326";

			if ($debug) {
				echo "layout:[".$layout."]\n";
				echo "dir:[".$dir."]<br>";
				echo "section:[".$section."]<br>\n";
				echo "TextArray:[".$TextArray."]<br>\n";
				echo "sectionTextArray:[".$sectionTextArray."]<br>\n";
			}

			layout3(
				$dir,
				$$section,
				$section,
				$textFiles,
				$$TextArray,
				$$sectionTextArray);

		} else if ($layout=="layout2") {

			$dir="64";

			if ($debug) {
				echo "layout:[".$layout."]\n";
				echo "dir:[".$dir."]<br>";
				echo "section:[".$section."]<br>\n";
				echo "TextArray:[".$TextArray."]<br>\n";
				echo "sectionTextArray:[".$sectionTextArray."]<br>\n";
			}
			layout2 (
				$dir,
				$$section,
				$omitted_set,
				$textFiles,
				$$TextArray,
				$$sectionTextArray);

		} else if ($layout=="layout4") {

			$dir="160";

			if ($debug) {
				echo "layout:[".$layout."]\n";
				echo "dir:[".$dir."]<br>";
				echo "section:[".$section."]<br>\n";
				echo "TextArray:[".$TextArray."]<br>\n";
				echo "sectionTextArray:[".$sectionTextArray."]<br>\n";
			}
			layout4(
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
	if ( ( ($layout=="layout1") || ($layout=="layout3") ) && ($textOn) ) {
		show_text( $$section,
			$textFiles,
			$$TextArray);
		}
?>
<!-- end content -->
                </div>
                <div id="sidebar">

	<?php 

		if (is_file($soundbiteFiles[$section])){
			#echo "<h6>".$sectionNames[$section]."</h6>\n";
                        #echo "<div id=\"infotext\">\n";
			echo "<br>\n";
			include $soundbiteFiles[$section];
			#echo "</div>\n";
		}
		$a=sprintf("$%sText",$section);
		for($i=0;$i<sizeof($$a);$i++){
			echo "<div>\n";
				include $$a[$i];
			echo "</div>\n";
		}


	if ($textOn){
		if ($layout=="layout2"){
			show_text(
				$$section,
				$textFiles,
				$$TextArray);
		}
	} else {
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
                    	|
                    <?php echo $emailine;?>
                    	|
                    <?php echo $emailine2;?>
                    <!-- end footer -->
                </div>
            </div>
        </div>
    </body>
</html>

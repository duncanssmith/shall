<?php
$sitename="Sharon Hall";
$date=date('d m Y');
$year=date('Y');
$time=date('B');

function layout(
	$rows,
	$cols,
	$depth,
	$width,
	$height){
	
	echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";
	for($j=0;$j<$rows;$j++){
		echo "<tr>\n";
		for($i=0;$i<$cols;$i++){
			echo "<td>\n";
				echo "<p>".$rows." ".$cols." ".$depth." ".$width." ".$height."</p>\n";	
				if($depth>0){
					#$depth-=$depth;
					layout($rows-1,$cols-1,$depth-1,$width/2,$height/2);
				}
			echo "</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
}

function build_js_text_array(
	$setname,
	$set,
	$textarray){

	include "globals.php";
	$setname=$section;

	$len=sizeof($set);
	
	echo "<script language=\"javascript\">\n";	
	echo "<!--".$len." Length of array\n\n";
	#echo "[".$setname."]\n";
	echo "\tvar arraylen=".$len.";\n";
	echo "\tvar i=0;\n";
	echo "\tvar itemtext=new Array;\n";

	for($i=0;$i<$len;$i++){
		echo "\titemtext[".$i."]=\"".$textarray[$set[$i]]."\";\n";
		#echo "\titemtext[".$i."]=\"".$textarray[$set[$i]]."\";\n";
		#echo "\titemtext[".$i."]=\"".$a[$i]."\";\n"; 
	} 
	/*
	for($i=0;$i<$len;$i++){
		echo "\tDUNCAN[".$i."]=\"".$textarray[$set[$i]]."\";\n";
	}
	*/
	echo "\n-->\n";
	echo "</script>\n";	
}

function build_js_image_array(
	$section,
	$set,
	$all,
	$omitted,
	$imagesOn){

	if($section=="All"){
		$len=$all;
	}else if($section=="Selected"){
		$len=($all - sizeof($omitted));
		$all=false;
		$len=240;
	}else{
		$len=sizeof($set);
		$all=false;
	}

	if($imagesOn){
		$swapdir=326;
		$zoomdir=640;
	}else{
		$swapdir=120;
		$zoomdir=326;
	}

	echo "<script language=\"javascript\">\n";	
	echo "<!--\n";
	echo "\tvar arraylen=".$len.";\n";
	echo "\tvar i=0;\n";
	echo "\tvar swap=new Array;\n";

	for($i=0;$i<$len;$i++){
		$array[$i]=$set[$i];
	}

	if($all){
		for($i=0;$i<$len;$i++){
			$image=sprintf("images/%04d/sh_%04d.jpg",$swapdir,$i+1);
			echo "\tswap[".$i."]=\"".$image."\";\n";
		}
		echo "\n";
		echo "\tvar zoom=new Array;\n";
		for($i=0;$i<$len;$i++){
			$image=sprintf("images/%04d/sh_%04d.jpg",$zoomdir, $i+1);
			echo "\tzoom[".$i."]=\"".$image."\";\n";
		}
	}
	else if($section == "Selected"){
		echo "\tvar zoom=new Array;\n";
		echo "\n//len ";
		echo $len;
		echo "\n";
		for($i=0,$j=0,$k=0;$i<$len;$i++,$k++){
			if($i+1==(int)$omitted[$j]){
				$j++;
				$k--;
			}else{
				$tmp_t=sprintf("images/%04d/sh_%04d.jpg",$swapdir,$i+1);
				$tmp_f=sprintf("images/%04d/sh_%04d.jpg",$zoomdir,$i+1);
				echo "\tswap[".$k."]=\"".$tmp_t."\";\n";
				echo "\tzoom[".$k."]=\"".$tmp_f."\";\n";
			}
		}
		echo "\n";
	}
	else {
		for($i=0;$i<$len;$i++){
			echo "\tswap[".$i."]=\"images/".$swapdir."/sh_".$set[$i].".jpg\";\n";
		}
		echo "\n";
		echo "\tvar zoom=new Array;\n";
		for($i=0;$i<$len;$i++){
			echo "\tzoom[".$i."]=\"images/".$zoomdir."/sh_".$set[$i].".jpg\";\n";
		}
	}	
	echo "-->\n";
	echo "</script>\n";	
} 


function build_image_selector(
	$section,
	$set,
	$sectionArrayTxt){

	include "globals.php";

	if($set[0]==0){$set[0]=3;}

	if($section=="All"){$set[0]=1;}
	else if($section=="Selected"){$set[0]=3;}

	if($imagesOn){
		$image=sprintf("images/326/sh_%04d.jpg",$set[0]);
	}else{
		$image=sprintf("images/64/sh_%04d.jpg",$set[0]);
	}

	if($imagesOn){
		echo "<script language=\"javascript\">\n<!--\nvar newwindow; var zoom_count=0;\n-->\n</script>\n";
		echo "<img src=\"".$image."\" onClick=\"javascript: pop_zoom('".$$set."',640); return false;\" name=\"swapImage\" alt=\"".$image."\" border=\"0\">\n";
	}else{
		echo "<script language=\"javascript\">\n<!--\nvar newwindow; var zoom_count=0;\n-->\n</script>\n";
		echo "<img src=\"".$image."\" onClick=\"javascript: pop_zoom('".$$set."',160); return false;\" name=\"swapImage\" alt=\"".$image."\" border=\"0\">\n";
	}
		$arraytxt=$sectionArrayTxt[$set[0]];

	include "layer.php";
}

function layout1(
	$dir,
	$image_set,
	$section,
	$TextArray,
	$sectionTextArray,
	$textFiles){

	include "globals.php";

	$directory=$dir;


		show_images(
			$directory, 
			$image_set, 
			$section, 
			$omitted_set);

		echo "<br/><br/>\n";

		#show_text( $section, $textFiles, $TextArray);

	
}
function layout2(
	$dir,
	$image_set,
	$omitted_set,
	$textFiles,
	$TextArray,
	$sectionTextArray){

	include "globals.php";

	$directory=$dir;

	$max=$all;
	$min=1;
	$range=($max-$min);

	if($imagesOn){
		echo "<div id=\"imgmain\">\n";
		build_image_selector(
			$section,
			$image_set,
			$sectionTextArray);
		echo "</div>\n";

	}else{
		echo "<p>images are switched off (image_selector())</p>";
	}
		
	if($imagesOn){
		echo "<div id=\"imgarray\">\n";
		show_images(
			$directory, 
			$image_set, 
			$section, 
			$omitted_set);
		echo "</div>\n";
	}else{
		echo "<p>images are switched off (show_images())</p>";
	}

	echo "<br/><br/>\n";
	
	if($textOn){
		#show_text( $section, $textFiles, $TextArray);
	}else{
		echo "<p>text is switched off</p>";
	}
	#show_images($directory, $image_set, $section, $omitted_set);

}

function show_images(
	$dir, 
	$image_set, 
	$section, 
	$omitted_set){

	include "globals.php";

	$number_of_images=0;
	$number_of_images_omitted=0;

	$directory=$dir;



	#decide what to do...
	$temp=$debug;
	$debug=0;

	if($image_set){
		$number_of_images=sizeof($image_set);
	}else{
		$number_of_images=$all;
	}
	if($omitted_set){
		$number_of_images_omitted=sizeof($omitted_set);
	}else{
		$number_of_images_omitted=0;
	}


	if($debug){
		echo "<p>number_of_images:[".$number_of_images."]<br/>omitted_set:[".$omitted_set."]<br/>\n";
		echo "number_of_images_omitted:[".$number_of_images_omitted."]</p><br/>\n";
		echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\n";
	} else {
		if($temp){
			echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\n";
		}else{
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
		}
	}

	$debug=$temp;
	if($number_of_images_omitted > 0){
		if($debug){
			echo "<td colspan=".$cols."><p>omitting the following images:</p>\n";
			echo "<p>";
			for($i=0;$i<$number_of_images_omitted;$i++){
				if($i%($cols*3)==0){
					echo "</p><p>";
				}
				echo " ".$omitted_set[$i]." ";
			}
			echo "</p></td>\n";
		}

		for($i=0,$j=0,$k=1;$i<$number_of_images;$i++,$k++){
			if(($k%$cols==1)&&(!$newrow)){
				if($i==0){echo "<tr>";}else{echo "</tr><tr>\n";};
				#echo "</tr><tr>\n";
				$newrow=TRUE;
			}
			if($i+1==(int)$omitted_set[$j]){
				$j++;
				$k--;
			}else{
				echo "<td>&nbsp;\n";
				$image=sprintf("images/%s/sh_%04d.jpg",$directory, $i+1);
				$name=sprintf("sh_%04d.jpg",$i+1);
				$title=sprintf("%04d",$i+1);
				echo "<a href=\"".$thisPage."\" onClick=\"sameimg(".($k-1).");createlayer(".($k-1).");return false\">";
				if($imagesOn){
					echo "<img src=\"".$image."\" title=\"".$name."\" alt=\"".$image."\" border=\"0\">\n";
				}else{
					#$directory="64";
					$image=sprintf("images/%s/sh_%04d.jpg",$directory, $i+1);
					echo "<img src=\"".$image."\" title=\"".$name."\" alt=\"".$image."\" border=\"0\">\n";
				}
				if($infoOn){
					echo $title;
				}
				echo "</a>\n";
				echo "</td>\n";
				$newrow=FALSE;
			}
		}
		$i=$k-1;
	} else if ($number_of_images==$all){

		for($i=0;$i<$number_of_images;$i++){
			if($i%$cols==0){
				if($i==0){echo "<tr>";}else{echo "</tr><tr>\n";};
				#echo "</tr><tr>\n";
			}
				echo "<td>&nbsp;\n";
				$image=sprintf("images/%s/sh_%04d.jpg",$directory, $i+1);
				$name=sprintf("sh_%04d.jpg",$i+1);
				$title=sprintf("%04d",$i+1);
				echo "<a href=\"".$thisPage."\" onClick=\"sameimg(".($i).");createlayer(".($i).");return false\">";
				if($imagesOn){
					echo "<img src=\"".$image."\" title=\"".$name."\" alt=\"".$image."\" border=\"0\">\n";
				}else{
					#$directory="64";
					$image=sprintf("images/%s/sh_%04d.jpg",$directory, $i+1);
					echo "<img src=\"".$image."\" title=\"".$name."\" alt=\"".$image."\" border=\"0\">\n";
					#echo $title;
				}
				if($infoOn){
					echo $title;
				}
				echo "</a>\n";
				echo "</td>\n";
		}
	} else {

		for($i=0;$i<$number_of_images;$i++){
			if($i%$cols==0){
				if($i==0){echo "<tr>";}else{echo "</tr><tr>\n";};
			}
				echo "<td>&nbsp;";

				if($i==0 && $debug && $tablesdebug){echo "+";}

				$image=sprintf("images/%s/sh_%04d.jpg",$directory, $image_set[$i]);
				$name=sprintf("sh_%04d.jpg",$image_set[$i]);
				$title=sprintf("%04d",$image_set[$i]);
				echo "<a href=\"".$thisPage."\" onClick=\"sameimg(".($i).");createlayer(".($i).");return false\">";
				if($imagesOn){
					echo "<img src=\"".$image."\" title=\"".$name."\" alt=\"".$image_set[$i]."\" border=\"0\">\n";
				}else{
					#$directory="64";
					$image=sprintf("images/%s/sh_%04d.jpg",$directory, $image_set[$i]);
					echo "<img src=\"".$image."\" title=\"".$name."\" alt=\"".$image_set[$i]."\" border=\"0\">\n";
					#echo $title;
				}
				if($infoOn){
					echo $title;
				}
				echo "</a>\n";
				if($debug && $i+1==$number_of_images && $tablesdebug){echo "-";}
				echo "</td>\n";
		}
	}
	$mod=$i%$cols;
	if($mod==0){$mod=$cols;}
	for($j=0;$j<($cols-($mod));$j++){
		if($debug){
			#echo "<td>i=".$i." j=".$j." i mod cols=".$i%$cols."&nbsp;</td>\n";
			echo "<td>Empty&nbsp;";
			if($j+1==($cols-($mod))&&($tablesdebug)){

				echo "-";

			}
			echo "</td>\n";	
		}else{
			echo "<td>&nbsp;</td>\n";
		}		
	}

	echo "</tr>\n";
	echo "</table>\n";


}

function show_text(
	$set,
	$textFiles,
	$textFilesArray){

	include "globals.php";

	$len=sizeof($textFilesArray);
	$slen=sizeof($set);

	for($i=0;$i<$len;$i++){
		$file = sprintf("%s",$textFilesArray[$i]);
		#echo $file;
		if($debug){
			echo "\nfile:[".$file."]\n";
		}
		if($textOn){
			if(file_exists($file)){
				include $file;
			}
			else{
				echo "&nbsp;";	
			}
		}
		echo "<br/>\n";
	}
}

function layout3(
	$dir,
	$image_set,
	$section,
	$textFiles,
	$textArray,
	$sectionTextArray){

	include "globals.php";

	if($imagesOn){
		$directory=$dir;
	}else{
		$directory=64;
	}

	echo "<div id=\"sectiontext\">\n";
	#show_text( $section, $textFiles, $textArray);
	echo "</div>\n";

	#$len=sizeof($textArray);
	$len=sizeof($image_set);

	#echo "<script language=\"javascript\">\n<!--\nvar newwindow; var zoom_count=0;\n-->\n</script>\n";
	for($i=0;$i<$len;$i++){
		
		if($debug){
			#echo "\nfile:[".$file."]\n";
		}
		echo "<br/>\n";
		#include $file;
		/*=========*/
		#$directory=64;

		echo "<div>\n";

		$image=sprintf("images/%s/sh_%s.jpg",$directory,$image_set[$i]);
		echo "<img src=\"".$image."\"";
		echo " onClick=\"javascript: pop_zoom_2('".$section."',640,".$i."); return false;\" name=\"swapImage\" alt=\"sh_".$image_set[$i].".jpg\" border=\"0\">\n";
		/*=========*/
		echo "<br/>\n";
		if($infoOn){
			#echo "[";
			#echo $image_set[$i];
			#echo "]";
		}
		if($textOn){
			echo $textArray[$image_set[$i]];
			echo $sectionTextArray[$image_set[$i]];
			echo "\n";
			echo "<br/>\n";
			echo "<br/>\n";
		}
		echo "</div>\n";
	}
}

function show_section_text($set,$textFiles,$TextArray){
	#$set="current";
	include "globals.php";

	if(($debug)&&(!$textOn)){
		if($debug){
			$file=sprintf("text_.php");
		}
	}else{
		$file=sprintf("%s",$textFiles[$set]);
	}
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	#echo $file;
	#echo "<p>texton ".$textOn."<br/>debug ".$debug."</p><br/>";
	include $file;
}

?>

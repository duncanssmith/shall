<?php

include "configuration.php";
include "section_item_arrays_003.php";
#include "info/xml2html.csv";
#include "xml2html.php";

$itingline="\n<a href=\"mailto:itingdesign@googlemail.com\" class=\"capt\">web design &copy; iting 2005 - ".$year."</a>\n";
$dateline="\n<a href=\"\" class=\"capt\">".$now."</a>\n";
$emailine="\n<a href=\"mailto:sharonjhall@btinternet.com\" class=\"capt\">All site content &copy; Sharon Hall. All rights reserved</a>\n";
$emailine2="\n<a href=\"mailto:sharonjhall@btinternet.com\" class=\"capt\">Email Sharon Hall</a>\n";
/* total number of images */
$all=240;

//TEXTS ARRAYS
$HomeText=array( 'sh_text_000.php' );
$CvText=array( 
	'sh_text_014.php',
	'sh_text_015.php',
	'sh_text_024.php',
	'sh_text_016.php',
	'sh_text_017.php',
	'sh_text_019.php',
	#'sh_text_018.php',
	'sh_text_020.php'
 );
$TextsText=array(
	'sh_text_031.php',
	'sh_text_030.php',
	'sh_text_002.php',
	'sh_text_034.php',
	'sh_text_022.php',
	'sh_text_023.php',
	'sh_text_005.php',
	'sh_text_035.php',
	'sh_text_006.php',
	'sh_text_008.php',
	'sh_text_007.php',
	'sh_text_001.php',
	'sh_text_003.php',
	'sh_text_036.php',
	'sh_text_025.php',
	'sh_text_004.php',
	'sh_text_021.php'

	#'sh_text_032.php',
	#'sh_text_029.php',
	#'sh_text_028.php',
	#'sh_text_027.php',
	#'sh_text_000.php',
	#'sh_text_009.php',
	#'sh_text_010.php',
	#'sh_text_011.php',
	#'sh_text_012.php',
	#'sh_text_013.php',
	#'sh_text_014.php',
	#'sh_text_015.php',
	#'sh_text_016.php',
	#'sh_text_017.php',
	#'sh_text_018.php',
	#'sh_text_019.php',
	#'sh_text_020.php',
	#'sh_text_024.php',
	#'sh_text_026.php',
);
$CurrentText=array( 'sh_text_000.php');

$AllText=array('sh_text_999.php');
$SelectedText=array('sh_text_999.php');
$OmittedText=array('sh_text_999.php');
$New20051031Text=array( 'sh_text_999.php' );
$BannersText=array( 'sh_text_999.php' );
$CataloguesText=array( 'sh_text_999.php' );
$GreyfriarsText=array('sh_text_999.php');
$RomaText=array( 'sh_text_999.php' );
$RomaText=array( 'sh_text_999.php' );
$ThomasBewickText=array( 'sh_text_999.php' );
$PrintedText=array('sh_text_999.php');
$GoldDustText=array( 'sh_text_999.php' );
$OrnamentText=array('sh_text_999.php');
$StarmapsText=array( 'sh_text_999.php' );
$WorldText=array('sh_text_999.php');
$HistoriesText=array( 'sh_text_999.php');
$CurrentAText=array( 'sh_text_999.php' );
$CurrentBText=array( 'sh_text_999.php' );
$CurrentCText=array( 'sh_text_999.php' );
$CurrentDText=array( 'sh_text_999.php' );
$CurrentEText=array( 'sh_text_999.php');
$CurrentFText=array( 'sh_text_999.php');
$CurrentGText=array( 'sh_text_999.php');


//END TEXTS

$sectionNames=array(
	'Texts'=>'Selected texts and critical writings',
	'Home'=>'Home',
	'Cv'=>'Curriculum Vitae',
	'AllInfo'=>'Image Info',
	'All'=>'All 252 Images',
	'Selected'=>'Selected Images',
	'Banners'=>'Banners',
	'Roma'=>'Roma',
	'Histories'=>'Histories',
	'Printed'=>'Printed Paintings',
	'Greyfriars'=>'Greyfriars',
	'Starmaps'=>'Starmaps and Follies',
	'ThomasBewick'=>'Thomas Bewick and Other Allegories',
	'World'=>'The World Turned Upside Down',
	'GoldDust'=>'Gold Dust Pieces',
	'Catalogues'=>'Catalogues and Primers',
	'Ornament'=>'Ornament',
	'Current'=>'Archive',
	'CurrentA'=>'Grids',
	'CurrentB'=>'Loops',
	'CurrentC'=>'Surface/Connections, Holden Gallery',
	'CurrentD'=>'Multi Panels',
	'CurrentE'=>'Islington Mill Gallery',
	'CurrentF'=>'Combinations',
	'CurrentG'=>'Current Work',
	'Omitted'=>'Omitted Images',
	'New20051031'=>'Additions'
);

#$textFiles=array ( 'Texts'=>'text_All.php', 'Banners'=>'text_Banners.php', 'Catalogues'=>'text_Catalogues.php', 'Cv'=>'text_Cv.php', 'Current'=>'text_Current.php', 'CurrentA'=>'text_CurrentA.php', 'CurrentB'=>'text_CurrentB.php', 'CurrentC'=>'text_CurrentC.php', 'CurrentD'=>'text_CurrentD.php', 'CurrentE'=>'text_CurrentE.php', 'CurrentF'=>'text_CurrentF.php',	'GoldDust'=>'text_GoldDust.php', 'Greyfriars'=>'text_Greyfriars.php', 'Histories'=>'text_Histories.php', 'Home'=>'text_Home.php', 'Ornament'=>'text_Ornament.php', 'Printed'=>'text_Printed.php', 'Roma'=>'text_Roma.php', 'Starmaps'=>'text_Starmaps.php', 'ThomasBewick'=>'text_ThomasBewick.php', 'World'=>'text_World.php');

$soundbiteFiles=array (
	'Texts'=>'sb_text_Texts.php',
	'Banners'=>'sb_text_Banners.php',
	'Catalogues'=>'sb_text_Catalogues.php',
	'Cv'=>'sb_text_Cv.php',
	'Current'=>'sb_text_Current.php',
	'CurrentA'=>'sb_text_CurrentA.php',
	'CurrentB'=>'sb_text_CurrentB.php',
	'CurrentC'=>'sb_text_CurrentC.php',
	'CurrentD'=>'sb_text_CurrentD.php',
	'CurrentE'=>'sb_text_CurrentE.php',
	'CurrentF'=>'sb_text_CurrentF.php',
	'GoldDust'=>'sb_text_GoldDust.php',
	'Greyfriars'=>'sb_text_Greyfriars.php',
	'Histories'=>'sb_text_Histories.php',
	'Home'=>'sb_text_Home.php',
	'Ornament'=>'sb_text_Ornament.php',
	'Printed'=>'sb_text_Printed.php',
	'Roma'=>'sb_text_Roma.php',
	'Starmaps'=>'sb_text_Starmaps.php',
	'ThomasBewick'=>'sb_text_ThomasBewick.php',
	'World'=>'sb_text_World.php'
);

#$sections=array($sectionNames[0]);

#for($i=1;$i<sizeof($sectionNames);$i++){
	#$sections[]=$sectionNames[$i];
	#echo $sections[$i];
	#}


	#$range=$all;
#$rNum03=rand(1, $range);
#$rNum04=rand(1, $range);
#$rNum02=rand(1, $range);
#$rNum03=rand(1, $range);

srand((double) microtime() * ( 10000 ));
$range=1;
$rNum02=0;#rand(1, $range);

$a=array();
#$a[1]=sprintf("%04d",$rNum00);
#$a[2]=sprintf("%04d",$rNum01);
#$a[0]=sprintf("%04d",$rNum02);

$r1=array(
#'0252'
'0300',
'0300',
'0300'
#'0239',
#'0238',
#'0230',
#'0231',
#'0232',
#'0233',
#'0235',
#'0234',
#'0236',
#'0240',
#'0237' 
);

$Texts=array(
	#$r1[$rNum00],
	#$r2[$rNum01],
	$r1[$rNum02]
);
$Cv= array(
	#$r1[$rNum00],
	#$r2[$rNum01],
	$r1[$rNum02]
);
$Home= array(
	#$r1[$rNum00],
	#$r2[$rNum01],
	#$r1[$rNum02]
        '0300'
);
$Current= array(
	#$r1[$rNum00],
	#$r2[$rNum01],
	$r1[$rNum02]
);	

#	$a[0],$a[1],$a[2]);

#$All=array();
// The Selected array is obtained from the Omitted array, utilising the Total number of images
// and printing all of them unless they are present in the Omitted array.
#$Selected=array();

$Banners=array(
'0225',
'0046',
'0047',
'0219',
'0220'
);

$Catalogues=array(
'0011',
'0084',
'0085',
'0049',
'0048',
'0051',
'0053',
'0052',
'0054',
'0055',
'0217',
'0228',
'0056',
'0083',
'0122',
'0201'
);

$ThomasBewick=array(
'0202',
'0212',
'0211',
'0208',
'0204',
'0207',
'0063',
'0203',
'0210',
'0095',
'0070',
'0072',
'0214',
'0071',
'0069',
'0086'
);

$World=array(
'0209',
'0213',
'0218',
'0223',
'0224',
'0133',
'0138',
'0135',
'0134',
'0136',
'0137',
'0139'
);

$Greyfriars=array(
'0057',
'0058',
'0059',
'0060',
'0061',
'0062'
);

$Printed=array(
'0064',
'0067',
'0065', 
'0199', 
'0200', 
'0226', 
'0066', 
'0215'
);

$GoldDust=array(
'0014',
'0157',
'0073',
'0075',
'0096',
'0097',
'0098',
'0099',
'0100',
'0101',
'0102'
);

$Histories=array(
'0088',
'0087',
'0089',
'0229',
'0205',
'0206'
);

$Roma=array(
'0093',
'0068',
'0227'
);

$Ornament=array( 
'0106',
'0111',
'0123',
'0124',
'0216',
'0117',
'0120',
'0116',
'0080',
'0118',
'0079',
'0113',
'0119',
'0112',
'0121',
'0125',
'0108',
'0081',
'0082',
'0078'
);

$Starmaps=array(
'0127',
'0128',
'0129',
'0130',
'0131',
'0132',
'0198'
);

$CurrentA=array(
'0105',
'0107',
'0114',
'0115',
'0126',
'0110',
'0222',
'0109'
);

$CurrentB=array(
'0003',
'0004',
'0027',
'0026',
'0028',
'0034',
'0032',
'0037',
'0045',
'0043',
'0044',
'0038',
'0033',
'0041',
'0035',
'0031',
'0025',
'0158',
'0159',
'0160'
#'0161',
#'0185'
);

$CurrentC=array(
'0016',
'0018',
'0020',
'0021',
'0022',
'0023',
'0024'
);

$CurrentD=array(
'0142',
'0154',
'0141',
'0143',
'0182'
);

$CurrentE=array(
'0146',
'0147',
'0151',
'0150',
'0153'
);

$CurrentF=array(
'0239',
'0238',
'0230',
'0231',
'0232',
'0233',
'0235',
'0234',
'0236',
'0240',
'0237' 
);

$CurrentG=array(
 '0267',
 '0268',
 '0253',
 '0254',
 '0257',
 '0258',
 '0266',
 '0264',
 '0263',
 '0265',
 '0260',
 '0262',
 '0261',
 '0255',
 '0256',
 '0241',
 '0242',
 '0243',
 '0244',
 '0245',
 '0246',
 '0247',
 '0248',
 '0249',
 '0250',
 '0251',
 '0252'
);

#$New20051031=array( '0157', '0158', '0159', '0160', '0161', '0162', '0163', '0164', '0165', '0166', '0167', '0168', '0169', '0170', '0171', '0172', '0173', '0174', '0175', '0176', '0177', '0178', '0179', '0180', '0181', '0182', '0183', '0184', '0185', '0186', '0187', '0188', '0189', '0190', '0191', '0192', '0193', '0194', '0195', '0196', '0197', '0198', '0199', '0200', '0201', '0202', '0203', '0204', '0205', '0206', '0207', '0208', '0209', '0210', '0211', '0212', '0213', '0214', '0215', '0216', '0217', '0218', '0219', '0220', '0221', '0222', '0223', '0224', '0225', '0226', '0227', '0228', '0229');
#Remainder with OMITTED images included: 
#$Current_Work_2000_Date=array('1','2','3','4','5','6','7','8','9','10','12','13','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','50','77','78','90','91','92','106','109','110','111','114','115','125','126','140','141','142','143','144','145','146','147','148','149','150','151','152','153','154','155','156');

#$EmptySet=array();
#$Omitted=array( '0001', '0002', '0005', '0006', '0007', '0008', '0009', '0010', '0012', '0013', '0014', '0015', '0017', '0019', '0029', '0030', '0036', '0039', '0040', '0042', '0050', '0060', '0076', '0077', '0090', '0091', '0092', '0094', '0103', '0104', '0140', '0144', '0145', '0148', '0149', '0152', '0155', '0156', '0158', '0159', '0160', '0161', '0163', '0164', '0165', '0166', '0167', '0169', '0170', '0171', '0172', '0173', '0174', '0175', '0176', '0177', '0179', '0180', '0181', '0183', '0184', '0185', '0186', '0187', '0188', '0190', '0191', '0192', '0193', '0194', '0195', '0196', '0197'); 
?>

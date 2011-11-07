
<link rel="stylesheet" href="css/sh.css" type="text/css">
<script type='text/javascript'>

Menu1=new Array("Home","sh_000.php","",5,20,180);
  Menu1_1=new Array("CV","sh_001.php","",0,20,180);
  Menu1_2=new Array("All Images","sh_015.php","",0,20,0);
  Menu1_3=new Array("All Selected Images","sh_016.php","",0,20,220);
  Menu1_4=new Array("All Omitted Images","sh_017.php","",0,20,220);
  Menu1_5=new Array("Contact","sh_018.php","",0,20,220);

Menu2=new Array("Paintings","sh_002.php","",12,0,180);
  Menu2_1=new Array("Banners","sh_003.php","",0,20,220);
  Menu2_2=new Array("Catalogues and Primers","sh_004.php","",0,20,220);
  Menu2_3=new Array("Greyfriars","sh_005.php","",0,20,220);
  Menu2_4=new Array("Roma","sh_006.php","",0,20,220);
  Menu2_5=new Array("Thomas Bewick and other Allegories","sh_007.php","",0,20,220);
  Menu2_6=new Array("Printed Paintings","sh_008.php","",0,20,220);
  Menu2_7=new Array("Gold Dust Pieces","sh_009.php","",0,20,220);
  Menu2_8=new Array("Ornament","sh_010.php","",0,20,220);
  Menu2_9=new Array("Starmaps and Follies","sh_011.php","",0,20,220);
  Menu2_10=new Array("The World Turned Upside Down","sh_012.php","",0,20,220);
  Menu2_11=new Array("Histories","sh_013.php","",0,20,220);
  Menu2_12=new Array("Current Work 2000 to date","sh_014.php","",0,20,220);


var NoOffFirstLineMenus=2;	// Number of first level items
var LowBgColor='E8E8E8';		// Background color when mouse is not over
var LowSubBgColor='E8E8E8';	// Background color when mouse is not over on subs
var HighBgColor='FFFFFF';	// Background color when mouse is over
var HighSubBgColor='FFFFFF';	// Background color when mouse is over on subs
var FontLowColor='606060';	// Font color when mouse is not over
var FontSubLowColor='606060';	// Font color subs when mouse is not over
var FontHighColor='ffffff';	// Font color when mouse is over
var FontSubHighColor='ffffff';	// Font color subs when mouse is over
var BorderColor='E0E0E0';	// Border color
var BorderSubColor='E0E0E0';	// Border color for subs
var BorderWidth=1;		// Border width
var BorderBtwnElmnts=1;		// Border between elements 1 or 0
var FontFamily="Verdana, sans-serif"	        // Font family menu items
var FontSize=8;			// Font size menu items
var FontBold=0;			// Bold menu items 1 or 0
var FontItalic=0;		// Italic menu items 1 or 0
var MenuTextCentered='left';	// Item text position 'left', 'center' or 'right'
var MenuCentered='left';	// Menu horizontal position 'left', 'center' or 'right'
var MenuVerticalCentered='top';	// Menu vertical position 'top', 'middle','bottom' or static
var ChildOverlap=.2;		// horizontal overlap child/ parent
var ChildVerticalOverlap=.2;	// vertical overlap child/ parent
var StartTop=1;		// Menu offset x coordinate
var StartLeft=1;		// Menu offset y coordinate
var VerCorrect=0;		// Multiple frames y correction
var HorCorrect=0;		// Multiple frames x correction
var LeftPaddng=3;		// Left padding
var TopPaddng=2;		// Top padding
var FirstLineHorizontal=1;	// SET TO 1 FOR HORIZONTAL MENU, 0 FOR VERTICAL
var MenuFramesVertical=1;	// Frames in cols or rows 1 or 0
var DissapearDelay=1000;	// delay before menu folds in
var TakeOverBgColor=1;		// Menu frame takes over background color subitem frame
var FirstLineFrame='navig';	// Frame where first level appears
var SecLineFrame='space';	// Frame where sub levels appear
var DocTargetFrame='space';	// Frame where target documents appear
var TargetLoc='';		// span id for relative positioning
var HideTop=0;			// Hide first level when loading new document 1 or 0
var MenuWrap=1;			// enables/ disables menu wrap 1 or 0
var RightToLeft=0;		// enables/ disables right to left unfold 1 or 0
var UnfoldsOnClick=0;		// Level 1 unfolds onclick/ onmouseover
var WebMasterCheck=0;		// menu tree checking on or off 1 or 0
var ShowArrow=0;		// Uses arrow gifs when 1
var KeepHilite=1;		// Keep selected path highligthed
var Arrws=['tri.gif',5,10,'tridown.gif',10,5,'trileft.gif',5,10];	// Arrow source, width and height


/***********************************************************************
   DO NOT EDIT ANYTHING BELOW THIS LINE - IT WILL BREAK THE SCRIPT !
***********************************************************************/

var AgntUsr=navigator.userAgent.toLowerCase();
var DomYes=document.getElementById?1:0;
var NavYes=AgntUsr.indexOf('mozilla')!=-1&&AgntUsr.indexOf('compatible')==-1?1:0;
var ExpYes=AgntUsr.indexOf('msie')!=-1?1:0;
var Opr=AgntUsr.indexOf('opera')!=-1?1:0;
var Opr6orless=window.opera && navigator.userAgent.search(/opera.[1-6]/i)!=-1 //DynamicDrive.com added code
var DomNav=DomYes&&NavYes?1:0;
var DomExp=DomYes&&ExpYes?1:0;
var Nav4=NavYes&&!DomYes&&document.layers?1:0;
var Exp4=ExpYes&&!DomYes&&document.all?1:0;
var PosStrt=(NavYes||ExpYes)&&!Opr6orless?1:0;
var FrstLoc,ScLoc,DcLoc;
var ScWinWdth,ScWinHght,FrstWinWdth,FrstWinHght;
var ScLdAgainWin;
var FirstColPos,SecColPos,DocColPos;
var RcrsLvl=0;
var FrstCreat=1,Loadd=0,Creatd=0,IniFlg,AcrssFrms=1;
var FrstCntnr=null,CurrntOvr=null,CloseTmr=null;
var CntrTxt,TxtClose,ImgStr;
var Ztop=100;
var ShwFlg=0;
var M_StrtTp=StartTop,M_StrtLft=StartLeft;
var StaticPos=0;
var LftXtra=DomNav&&!Opr?LeftPaddng:0; //Changed for Opera
var TpXtra=DomNav?TopPaddng:0;
var M_Hide=Nav4?'hide':'hidden';
var M_Show=Nav4?'show':'visible';
var Par=parent.frames[0]&&FirstLineFrame!=SecLineFrame?parent:window;
var Doc=Par.document;
var Bod=Doc.body;
var Trigger=NavYes&&!Opr?Par:Bod; //Changed for Opera

MenuTextCentered=MenuTextCentered==1||MenuTextCentered=='center'?'center':MenuTextCentered==0||MenuTextCentered!='right'?'left':'right';
WbMstrAlrts=["Item not defined: ","Item needs height: ","Item needs width: "];

if(Trigger.onload)Dummy=Trigger.onload;
if(DomNav||Opr)Trigger.addEventListener('load',Go,false); //Changed for Opera
else Trigger.onload=Go;


</script>
<noscript>Your browser does not support script</noscript>

<!-- BEGIN LAYER //-->

<div id="theShowButton">
<a href="#" onClick="showMe();return false;" class="show_info">details</a>
</div>

<div id="theLayer">
<!-- 000 -->

<table border="0" bgcolor="#fefefe" width="100%" cellspacing="0" cellpadding="0" height="36">
 <tr>
  <td id="titleBar" width="100%">
 
  <ilayer width="100%" onSelectStart="return false;">
  <layer width="100%" onMouseover="isHot=true;if (isN4) ddN4(theLayer)" onMouseout="isHot=false">
  </layer>
  </ilayer>

  </td>
 <td valign="top">
  <a href="#" onClick="hideMe();return false;" class="show_info">X</a>
  &nbsp;
  </td>
  </tr>
  <tr>
  <td colspan="2">
 
<!-- OPEN CONTENT //-->  
	<div id="layerContent">
	<?php echo $arraytxt; ?>
	</div>
<!-- CLOSE CONTENT //-->
</td>
</tr>
</table>

<!-- 000 -->
</div>
<!-- END LAYER //--> 

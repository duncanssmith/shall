<?PHP
#<html>
#  <head>
#    <title>Artlist: xml parse example</title>
#  </head>
#  <body>

#    echo $_SERVER['PHP_SELF'];
#    This file will need to be updated! DS 20080818
#

  class Artlist{
    var $parser;
    var $record;
    var $current_field='';
    var $field_type;
    var $ends_record;
    var $records;

    function Artlist($filename){

      global $debug;

      if($debug['methods']){
        $thisFunction ="Artlist::Artlist($filename)";
        echo_functionname($thisFunction);
      }

      $this->parser = xml_parser_create();
      xml_set_object($this->parser, $this);
      xml_set_element_handler($this->parser, 'start_element','end_element');
      xml_set_character_data_handler($this->parser, 'cdata');

      // 1 = single field, 2 = array field, 3 = record container

      $this->field_type = array(
                                'art' => 3,
                                'title' => 1,
                                'ismn' => 1,
                                'author' => 2,
                                'category' => 2,
                                'pageid' => 1,
                                'subtitle' => 1,
                                'keyname' => 1,
                                'images' => 2,
                                'image' => 1,
                                'imagecenter' => 1,
                                'imagescore' => 1,
                                'illustration' => 1,
                                'price' => 1
                              );

      $this->ends_record = array('art' => true);

      $x = join("", file($filename));
      xml_parse($this->parser, $x);
      xml_parser_free($this->parser);
      }

      function start_element($p,$element,$attributes){

        global $debug;

        if($debug['methods']){
          $thisFunction ="Artlist::start_element(".$p.", ".$element.", attributes)";
          #echo_functionname($thisFunction);
        }

        $element = strtolower($element);
        #echo "<h1>element: ".$element."</h1>\n";
        if($this->field_type[$element] != 0){
          $this->current_field = $element;
        #echo "<h2>current_field: ".$this->current_field."</h2>\n";
        }else{
          $this->current_field = '';    
        }
      }

      function end_element($p,$element){

        global $debug;

        if($debug['methods']){
          $thisFunction ="Artlist::end_element(".$p.", ".$element.")";
          #echo_functionname($thisFunction);
        }

        $element = strtolower($element);
        if($this->ends_record[$element]){
          $this->records[] = $this->record;
          $this->record = array();
        }
        $this->current_field = '';    
      }

      function cdata($p,$text){

        global $debug;

        if($debug['methods']){
          $thisFunction ="Artlist::cdata(".$p.", ".$text.")";
          #echo_functionname($thisFunction);
        }

        if($this->field_type[$this->current_field] === 2 ) {
          $this->record[$this->current_field][] = $text;
        }elseif($this->field_type[$this->current_field] === 1){ 
          $this->record[$this->current_field] .= $text;
        }
      }

      function verify_order($p){

        global $debug;

        if($debug['methods']){
          $thisFunction ="Artlist::verify_order($p)";
          echo_functionname($thisFunction);
	}

	echo "<pre>";
	print_r ($p);
	echo "</pre>";

	for($i=0;$i<sizeof($p['attributes']);$i++){

		if($_POST[$p['attributes'][$i]['name']]==""){
			if($p['attributes'][$i]['required']){
				echo "<p>The ".$p['attributes'][$i]['label']." field is required - please go back to the previous page and complete this field.</p>";
			}
			
		}

	}

        return true;

      }

    function process_order($p){

        global $debug;

        if($debug['methods']){
          $thisFunction ="Artlist::process_order(POST)";
          echo_functionname($thisFunction);
        }

        build_session_purchase_data();

        validate_purchase_form();

       # include "include/orderforminstructions.inc";
        include "include/ordersumbitted.inc";
       # include "include/orderform.inc";

        #echo "<pre>";
        #print_r($_POST);
        #echo "</pre>";


    }

function get_customer_details($p){

      global $tables;
      global $debug;

      if($debug['methods']){
	$thisFunction ="get_customer_details(".$p['name']." array)";
	echo_functionname($thisFunction);
      }

      #for($i=0;$i<sizeof($p['attributes']);$i++){
#		echo "<p>".$p['attributes'][$i]['label']."</p>\n";
#      }

      generate_form($p,1);


  return true;
}

    function pre_process_order($p){

      global $debug;
      global $paypal_info;

        if($debug['methods']){
          $thisFunction ="Artlist::pre_process_order(POST)";
          echo_functionname($thisFunction);
        }

        $orders=array();
        $prices=array();
        $pk=array_keys($p);
        $subtotal=0.00;
        $total=0.00;

        for($i=0;$i<sizeof($p);$i++){
          if(strstr($pk[$i], 'quantity_')){
            $orders[$pk[$i]] = $p[$pk[$i]];
          }
        }
        
        #echo "<pre>";
        #print_r($_SESSION);
        #echo "</pre>";
        
        #echo "<pre>P:";
        #print_r($p);
        #echo "</pre>";

        #echo "<pre>PK:";
        #print_r($pk);
        #echo "</pre>";

        $i=0;
        foreach ($this->records as $art){
          # -------------------------------------------------
          # NB Have to replace spaces and '.'s in XML content 
          # because the POST array item names have replaced
          # all spaces and '.' with underscores!!!
          # -------------------------------------------------
          
          $itemnamecheck=str_replace(" ","_", "quantity_".$art['keyname']);
          $itemname=str_replace(".","_", $itemnamecheck);
          $prices[$itemname]=array();
          $prices[$itemname]['keyname']=$art['keyname'];
          $prices[$itemname]['price']=$art['price'];
          $i++;
          }

        #echo "<pre>Orders: ";
        #print_r($orders);
        #echo "</pre>";
        #echo "<pre>Prices: ";
        #print_r($prices);
        #echo "</pre>";

        $ok=array_keys($orders);
        #$rk=array_keys($prices);

        #echo "<pre>OK: ";
        #print_r($ok);
        #echo "</pre>";
        #echo "<pre>RK: ";
        #print_r($rk);
        #echo "</pre>";

        //-------------------------------------------------------------------------------------
        # echo "<div class=\"purchase_order_report\">\n<h1>Your Order</h1>\n";
        # printf("<p>%s %s %s<br/>", $p['title'], $p['fname'], $p['lname']);
        # printf("%s<br/>%s<br/>%s<br/>", $p['addr1'], $p['addr2'], $p['city']);
        # printf("%s<br/>tel: %s<br/>email %s<br/>", $p['pcode'], $p['phone'], $p['email']);
        //-------------------------------------------------------------------------------------
        # Check to see if there are any orders:
        for($i=0;$i<sizeof($orders);$i++){
          if($orders[$ok[$i]] > 0){
            $order_ok++;
          }
        }
          
        if($order_ok > 0){
          echo "<p>You have selected the following items:</p>";
         # form 1 
        #echo "<form name=\"pre_process_1\" action=\"".$_SERVER['SCRIPT_NAME']."?pageid=2.0\" method=\"post\">\n";
        echo "<table><tr>\n";
        echo "<th align=\"left\">Item</th><th align=\"left\">Quantity</th><th align=\"left\">Unit Price</th><th align=\"left\">Subtotal</th>\n";

        for($i=0;$i<sizeof($orders);$i++){
          #echo "<h6>".$ok[$i]."</h6>\n";
          #echo "<h6>".$prices[$ok[$i]]['price']."</h6>\n";
          if($orders[$ok[$i]] > 0){
            $subtotal=sprintf("%0.2f", (($prices[$ok[$i]]['price'])*($orders[$ok[$i]])) ); 

            printf("<tr><td>%s</td><td>%s</td><td>&pound;%0.2f</td><td>&pound;%0.2f</td>\n"
              ,$prices[$ok[$i]]['keyname']
              ,$orders[$ok[$i]]
              ,$prices[$ok[$i]]['price']
              ,$subtotal
            );
                
            #echo "<p>lookup price..[".$prices[$ok[$i]]['price']."]--- quantity: ".$orders[$ok[$i]]."  ".$ok[$i]." </p>";
            #echo "<p>subtotal: &pound;".$subtotal."</p>";
            $total+=$subtotal;
          }
        }

        for($i=0;$i<sizeof($paypal_info['pprange']);$i++){
          if(($total >= $paypal_info['pprange'][$i]['low'])&&
            ($total <= $paypal_info['pprange'][$i]['high'])){
            $postage=sprintf("%0.2f", $paypal_info['pprange'][$i]['pp']);
          }
	}
	$products_total=$total;
        $total+=$postage;
        $total=sprintf("%0.2f", $total);

        echo "</tr><td>&nbsp;</td><td>&nbsp;</td><td>Subtotal</td>";
        printf("<td>&pound;%0.2f</td>",$products_total);;
        echo "</tr><td>&nbsp;</td><td>&nbsp;</td><td>Post and Packing</td>";
        printf("<td>&pound;%0.2f</td>",$postage);;
        echo "</tr><td>&nbsp;</td><td>&nbsp;</td><td>Total</td>";
        printf("<td>&pound;%0.2f</td>",$total);;
	echo "</tr>\n</table>\n";

	echo "<p>Select \"amend order\" below to make changes, or \"continue\" to proceed with your order.</p>\n";

        echo "<a href=\"".$_SERVER['SCRIPT_NAME']."?pageid=2.0&amend=true\">amend order</a> |\n";
        echo "<a href=\"".$_SERVER['SCRIPT_NAME']."?pageid=2.0&continue=true\"> continue</a>\n";
        #echo "<label for=\"continue\">Continue</label><br>\n";
        #echo "<input type=\"submit\" name=\"submit\" value=\"amend order\"/>\n";

        #echo "</form>";

        #echo "<form name=\"pre_process_2\" action=\"".$_SERVER['SCRIPT_NAME']."?pageid=2.0\" method=\"post\">\n";

        for($i=0;$i<sizeof($orders);$i++){
          #echo "<h6>".$ok[$i]."</h6>\n";
          #echo "<h6>".$prices[$ok[$i]]['price']."</h6>\n";
          if($orders[$ok[$i]] > 0){
            $subtotal=(($prices[$ok[$i]]['price']) * ($orders[$ok[$i]])); 

  
            $_SESSION['order'][$i]=array(
              'keyname'=>$ok[$i],
              'item'=>$prices[$ok[$i]]['keyname'],
              'qty'=>$orders[$ok[$i]],
              'unitprice'=>$prices[$ok[$i]]['price'],
              'subtotal'=>$subtotal
            );

            #printf ("<input type=\"hidden\" name=\"item_%s\" value=\"%s\"/>\n"
            #  ,$prices[$ok[$i]]['keyname']
            #  ,$prices[$ok[$i]]['keyname']);
            #printf ("<input type=\"hidden\" name=\"qty_%s\" value=\"%s\"/>\n"
            #  ,$prices[$ok[$i]]['keyname']
            #  ,$orders[$ok[$i]]);
            #printf ("<input type=\"hidden\" name=\"unit_%s\" value=\"%0.2f\"/>\n"
            #  ,$prices[$ok[$i]]['keyname']
            #  ,$prices[$ok[$i]]['price']);
            #printf ("<input type=\"hidden\" name=\"subtotal_%s\" value=\"%0.2f\"/>\n"
            #  ,$prices[$ok[$i]]['keyname']
            #  ,$subtotal);
                
            #echo "<p>lookup price..[".$prices[$ok[$i]]['price']."]--- quantity: ".$orders[$ok[$i]]."  ".$ok[$i]." </p>";
            #echo "<p>subtotal: &pound;".$subtotal."</p>";
          }
        }

        #printf ("<input type=\"hidden\" name=\"pp\" value=\"%0.2f\"/>\n" ,$postage);
        #printf ("<input type=\"hidden\" name=\"total\" value=\"%0.2f\"/>\n" ,$total);

        #include "include/orderforminstructions.inc";
        #include "include/orderform.inc";
        #
        #generate_form($tables[0],1);

        #echo "<label for=\"confirm\">Confirm</label><br>\n";
        #echo "<input type=\"submit\" name=\"submit\" value=\"confirm\"/>\n";

        sort($_SESSION['order']);

        $_SESSION['order']['total']=sprintf("%0.2f", $total);
        $_SESSION['order']['postandpacking']=sprintf("%0.2f", $postage);

        #echo "</form>\n";

      }else{

        echo "<p>Nothing was selected</p>";
        echo "<br/><p><a href=\"".$_SERVER['SCRIPT_NAME']."?pageid=2.0\">return to order page</a></p>\n";

      }
  }

  function order_list(){

      global $paypal_info;
      global $debug;

      if($debug['methods']){
        $thisFunction ="Artlist::order_list()";
        echo_functionname($thisFunction);
      }

      if(isset($_GET['continue'])&&($_GET['continue']==true)){
        ; 
      }else{
	;
      }

#      #}elseif(isset($_GET['param'])&&($_GET['param']==true)){
#	      # keep SESSION array intact here also - it contains the order, and now we need
#	      # to add the customer details
#	      ; 
#      

      if(isset($_GET['amend'])&&($_GET['amend']==true)){
	      # keep SESSION array intact - it contains the order
	      ;
      }else{
        if(isset($_SESSION)){
          $y = array_keys($_SESSION);
          $i=0;
          foreach($y as $yelements){
            #echo "<p>".$yelements."</p>";
            if($yelements=="order"){
              array_splice($_SESSION,$i);
              echo "<p>Removed SESSION['order] array</p>\n";
            }
            $i++;
          }
        }
      }

      echo "<h1>Cadenzas Mail Order Form</h1>\n";
      echo "<h3>Please select your purchases</h3>\n";

      echo "<p>or click <a href=\"".$_SERVER['SCRIPT_NAME']."?pageid=2\"> here </a>to purchase securely using a credit or debit card with PayPal</p>\n";

      echo "<form name=\"select_qtys\" action=\"\" method=\"post\">\n";

      echo "<table border=\"0\"><tr><td>&nbsp</td><td>\n";


      echo "</td><td>&nbsp;</td></tr><tr>\n";

      foreach ($this->records as $art){

        $itemnamecheck=str_replace(" ","_", "quantity_".$art['keyname']);
        $itemname=str_replace(".","_", $itemnamecheck);

        echo "<tr valign=\"top\">";
          $authors = join(', ', $art['author']);
	  printf("<th align=\"left\" valign=\"top\">");
	  printf("<a href=\"%s\">
		  <img src=\"%s\" height=\"180\" alt=\"%s\" border=\"0\"/>
		  </th>\n",
                    $_SERVER['PHP_SELF'].'?pageid='. $art['pageid'],
                    $art['image'],
                    $art['title']
		  );
		  
		printf("<td align=\"left\" valign=\"top\"></a><br/><a href=\"%s\"><h3>%s</h3></a>\n",
                    $_SERVER['PHP_SELF'].'?pageid='. $art['pageid'],
		                $art['title']
	   	 );
	  
	  printf("<p class=\"details\">%s %s + postage and packing</p><br/>\n",
                    "£", $art['price']
	    );

          echo "<select name=\"quantity_".$art['keyname']."\">\n";
          for($j=0,$k=0;$j<sizeof($_SESSION['order']);$j++){
            if(isset($_SESSION['order'])&&
              (isset($_SESSION['order'][$j]['keyname']))&&
              ($_SESSION['order'][$j]['keyname']===$itemname)){

                  $k=$_SESSION['order'][$j]['qty'];
            }
          }

          for($i=0;$i<10;$i++){
            if($k==$i){
              echo "  <option value=\"".$i."\" selected=\"true\">".$i."</option>\n";
            }else{
              echo "  <option value=\"".$i."\">".$i."</option>\n";
            }
          }
          echo "</select>&nbsp;";

	        echo "<label for=\"quantity_".$art['keyname']."\">Select number of copies required</label>\n";
          echo "<br/>\n";

          echo "</td>\n";
          echo "</tr>\n";
	  }
      echo "</table><br/>\n";

      echo "<input type=\"reset\" name=\"reset\" value=\"clear form\"/>\n";
      echo "<input type=\"submit\" name=\"submit\" value=\"proceed\"/>\n";

      echo "</form></br>\n";

      # Now remove the SESSION['orders'] array for the old order!!!
      #
        if(isset($_SESSION)){
          $y = array_keys($_SESSION);
          $i=0;
          foreach($y as $yelements){
            #echo "<p>".$yelements."</p>";
            if($yelements=="order"){
              array_splice($_SESSION,$i);
              #echo "<p>Removed SESSION['order'] array</p>\n";
            }
            $i++;
          }
        }

    }

    function show_menu(){

      global $paypal_info;
      global $debug;
      global $pageid;

      if($debug['methods']){
        $thisFunction ="Artlist::show_menu()";
        echo_functionname($thisFunction);
      }

      echo "<table border=\"0\">\n";
        foreach ($this->records as $art){
        echo "<tr valign=\"top\">";
          $authors = join(', ', $art['author']);
	  printf("<th align=\"left\" valign=\"top\">");
	  printf("<a href=\"%s\">
		  <img src=\"%s\" height=\"180\" alt=\"%s\" border=\"0\"/>
		  </th>\n",
                    $_SERVER['PHP_SELF'].'?pageid='. $art['pageid'],
                    $art['image'],
                    $art['title']
		  );
		  
		printf("<td align=\"left\" valign=\"top\"></a><br/><a href=\"%s\"><h2>%s</h2></a><br/><br/>\n",
                    $_SERVER['PHP_SELF'].'?pageid='. $art['pageid'],
		    $art['title']
	   	 );
	  
	  printf("<p>%s</p><br/> <p class=\"details\">%s %s + postage and packing</p> <p class=\"details\">ISMN:%s</p> </td>\n",
                    #$authors,
                    $art['subtitle'],
                    "£",
                    $art['price'],
                    $art['ismn']
	    );
          #echo "</tr>\n";
    #printf("<td align=\"left\" valign=\"center\"><img src=\"%s\" alt=\"%s\" height=\"180\"></td>\n",$art['imagecenter'],$art['title']);
#
          echo "<td>\n";
          #echo "<div class=\"PayPalPayNow\">\n";
          echo "<h5>Buy now with PayPal</h5>\n";
          echo "<form name=\"_xclick\" target=\"paypal\" action=\"".$paypal_info['url']."\" method=\"post\">\n";
          #echo "<form name=\"_xclick\" target=\"\" action=\"\" method=\"post\">\n";
          echo "<input type=\"hidden\" name=\"cmd\" value=\"_cart\">\n";
          echo "<input type=\"hidden\" name=\"business\" value=\"".$paypal_info['cadenzas_business_email']."\">\n";
          echo "<input type=\"hidden\" name=\"currency_code\" value=\"GBP\">\n";
          echo "<input type=\"hidden\" name=\"item_name\" value=\"".$art['keyname'].", ISMN:".$art['ismn']."\">\n";
	        echo "<input type=\"hidden\" name=\"amount\" value=\"".$art['price']."\">\n";
          echo "<br/>\n";
          echo "<select name=\"quantity\">\n";
          for($i=1;$i<11;$i++){
            echo "  <option value=\"".$i."\">".$i."</option>\n";
          }
          echo "</select>&nbsp;";
	        echo "<label for=\"quantity\">Select number of copies</label>\n";
          echo "<br/>\n";
          echo "<input type=\"image\" src=\"".$paypal_info['payment_button']."\" border=\"0\" name=\"submit\" alt=\"Make payments with PayPal - it's fast, free and secure!\">\n";
	  echo "<label for=\"submit\">Purchase securely with PayPal</label>\n";
          echo "<input type=\"hidden\" name=\"add\" value=\"1\">\n";
          echo "</form></br>\n";
          #echo "<p>&pound;".$art['price']." plus P+P</p>\n";
          #echo "</div>\n";
          echo "</td>\n";
          echo "</tr>\n";
	  }
      echo "<tr>\n";
      echo "<td>&nbsp;</td>\n";
      echo "<td>&nbsp;</td>\n";
      echo "<td>\n";
      echo "<p><a href=\"".$_SERVER['PHP_SELF']."?pageid=2.0\">To purchase by mail order click here</a></p>\n";
      echo "</td>\n";
      echo "</tr>\n";
      echo "</table><br/>\n";

      }

      function show_art($pageid){

        global $paypal_info;
        global $debug;
        global $zoom;

      if($debug['methods']){
        $thisFunction ="Artlist::show_art($pageid)";
        echo_functionname($thisFunction);
      }

        foreach($this->records as $art){
          if($art['pageid'] !== $pageid){
            continue;
          }

          $authors = join(', ', $art['author']);
          $categories = join(', ', $art['category']);

          $zoom_data=array(
            $art['image'],
            $art['imagecenter'],
            $art['imagescore']
          );

          $zoom_more=array(
            'ISMN: '.$art['ismn'],
            'Illustration by '.$art['illustration'],
            'Sample page '.$authors
            );

          #build_js_zoom($zoom_data);

          printf("<h2>%s</h2><p> by %s</p>\n", $art['title'], $authors);
          printf("<p>%s</p>\n", $art['subtitle']);
          #printf("<p>Categories: %s</p>\n", $categories);

          echo "<table class=\"art\">\n<tr>\n";
          
          #printf("<img src=\"%s\" alt=\"%s\" width=\"140\"/>\n", $art['image'], $art['title']);
          for($i=0;$i<sizeof($zoom_data);$i++){
            echo "<td>";
            printf("<a class=\"popzoom\" href=\"\">");
 #           printf("<img src=\"%s\" onClick=\"javascript: pop_zoom('%s','%s','%s',680,900);return false;\" alt=\"%s\" height=\"240\"/>\n<br/><p>%s</p></a>\n", $zoom_data[$i], $zoom_data[$i], $art['title'], $zoom_more[$i], $art['title'], $zoom_more[$i]);
           printf("<img src=\"%s\" onClick=\"javascript: pop_zoom('%s','%s','%s',680,900);return false;\" alt=\"%s, %s\" height=\"240\"/>\n<br/><p>%s</p></a>\n", $zoom_data[$i], $zoom_data[$i], $art['title'], $zoom_more[$i], $art['title'], $zoom_data[$i],$zoom_more[$i]);
            echo "</td>\n";

          }
          echo "</tr></table>\n<br/>\n";

	        printf("<p>%s%s + postage and packing</p> <p>ISMN:%s<br/>Illustration: %s</p>\n",
                    "£",
                    $art['price'],
                    $art['ismn'],
                    $art['illustration']
                  );

          echo "<h5>Buy now</h5>\n";
          echo "<div class=\"PayPalPayNow\">\n";
          echo "<form name=\"_xclick\" target=\"paypal\" action=\"".$paypal_info['url']."\" method=\"post\">\n";
          #echo "<form name=\"_xclick\" target=\"\" action=\"\" method=\"post\">\n";
          echo "<select name=\"quantity\">\n";
          for($i=1;$i<11;$i++){
            echo "<option value=\"".$i."\">".$i."</option>\n";
          }
          echo "</select><br/>";
	        echo "<label for=\"quantity\">Number of copies</label>\n";
          echo "<br/>\n";
          echo "<input type=\"image\" src=\"".$paypal_info['payment_button']."\" border=\"0\" name=\"submit\" alt=\"Make payments with PayPal - it's fast, free and secure!\"><br/>\n";
	        echo "<label for=\"submit\">Purchase securely with PayPal</label>\n";
          echo "<input type=\"hidden\" name=\"cmd\" value=\"_cart\">\n";
          echo "<input type=\"hidden\" name=\"business\" value=\"".$paypal_info['cadenzas_business_email']."\">\n";
          echo "<input type=\"hidden\" name=\"currency_code\" value=\"GBP\">\n";
          echo "<input type=\"hidden\" name=\"item_name\" value=\"".$art['keyname'].", ISMN:".$art['ismn']."\">\n";
	        echo "<input type=\"hidden\" name=\"amount\" value=\"".$art['price']."\">\n";
          echo "<input type=\"hidden\" name=\"add\" value=\"1\">\n";
          echo "</form></br>\n";
          #echo "<p>&pound;".$art['price']." plus P+P</p>\n";
          echo "</div>\n";
          echo "<p>Back to the <a href=\"".$_SERVER['PHP_SELF']."\">list of titles</a>.</p>\n";
        }
     }
  };
     
  // main program code
        
#  </body>
#</html>
?>

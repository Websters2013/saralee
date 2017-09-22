<?php

// Product object

class Product {
  var $name;
  var $code;
   
  public function __construct($data) { 
    $this->name = $data['UPC_NAME'];
    $this->code = $data['UPC_CODE'];
  }
  
  public static function loadXML($url) {
    $products = array();
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $c = curl_exec($ch);
    //$c = file_get_contents($url);
    
    $parser = xml_parser_create();
    xml_parse_into_struct($parser,$c,$values,$tags);
    foreach ($tags as $k => $v) {
      if (strtolower($k) == "product") {
          $productRanges = $v;
          for ($i = 0; $i < count($productRanges); $i+=2) {
            $offset = $productRanges[$i] + 1;
            $len = $productRanges[$i + 1] - $offset;
            $data = array();
            $slice = array_slice($values, $offset, $len);
            for ($j = 0; $j < count($slice) ; $j++) {
              $data[$slice[$j]['tag']] = $slice[$j]['value'];
            }
            $products[] = new Product($data);
          }
      } else {
        continue;
      }
    }
    return $products;
  }
}

?>
<?php

// Store object

function stripCData($in) {
  //return str_replace('<![CDATA[','',str_replace(']]
}

class Store {
  var $storeID;
  var $phone;
  var $address;
  var $distance;
  var $city;
  var $name;
  var $state;
  var $zip;
   
  public function __construct($data) { 
    $this->storeID = $data['STORE_ID'];
    $this->phone = $data['PHONE'];
    $this->address = $data['ADDRESS'];
    $this->distance = $data['DISTANCE'];
    $this->city = $data['CITY'];
    $this->name = $data['NAME'];
    $this->state = $data['STATE'];
    $this->zip = $data['ZIP'];
  }
  
  public static function loadXML($url) {
    $stores = array();
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $contents = curl_exec($ch);
    
    $c = str_replace('<![CDATA[', '', str_replace(']]>', '', $contents));
    $parser = xml_parser_create();
    xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 ); 
    xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
    xml_parse_into_struct($parser,$c,$values,$tags);
    foreach ($tags as $k => $v) {
      if (strtolower($k) == "store") {
        $storeRanges = $v;
        for ($i = 0; $i < count($storeRanges); $i+=2) {
          $offset = $storeRanges[$i] + 1;
          $len = $storeRanges[$i + 1] - $offset;
          $data = array();
          $slice = array_slice($values, $offset, $len);
          for ($j = 0; $j < count($slice) ; $j++) {
            $data[$slice[$j]['tag']] = $slice[$j]['value'];
          }
          $stores[] = new Store($data);
        }
      } else {
        continue;
      }
    }
    preg_match('/<STORES COUNT=\"(\d+)\">/',$c,$matches);
    $storeCount = $matches[1];
    return array('stores' => $stores, 'count' => $storeCount);
  }
}

?>
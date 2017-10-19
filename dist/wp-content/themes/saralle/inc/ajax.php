<?php
add_action('wp_ajax_post', 'post_ajax');
add_action('wp_ajax_nopriv_post', 'post_ajax');
function post_ajax() {
	$post = $_GET['data'];
	$flag = $_GET['flag'];
	if($flag === 'faq') {
			echo '<!-- dropdown -->
            <div class="dropdown">';
				foreach (get_field('faq', $post) as $row_2) {
					echo '<div class="dropdown__item">
                    <div class="dropdown__title">' . $row_2['question'] . '</div>
                    <div class="dropdown__content">' . $row_2['answer'] . '</div>
                </div>';
				}
	echo '</div><!-- dropdown -->';
	} elseif ($flag === 'tips') {
		echo wpautop(get_post_field('post_content', $post));
	}

	exit;
}

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

add_action('wp_ajax_locator', 'locator_ajax');
add_action('wp_ajax_nopriv_locator', 'locator_ajax');
function locator_ajax() {
	$upc = $_GET['upc'];
	$zip = $_GET['zip'];
	$miles = $_GET['miles'];
	$page = $_GET['page'];
	$categories = $_GET['categories'];
	$pages = 4;

	$products = '';
	if (isset($upc) and isset($zip) and isset($miles)) {
		$xmlURL = "http://productlocator.infores.com/productlocator/servlet/ProductLocatorEngine?clientid=58&productfamilyid=SWGS&producttype=upc&storesperpage=".$pages."&storespagenum=" . $page . "&productid=".$upc."&zip=".$zip."&searchradius=".$miles;
		$storeRes = Store::loadXML($xmlURL);
		$stores = $storeRes['stores'];
		$storeCount = $storeRes['count'];
		$pagination = ceil($storeCount/$pages);

		foreach ($stores as $key => $value){
			//var_dump($value);
            if( !$value->storeID ) { continue; }
			$products .= '{
			"storeID":"'.$value->storeID.'",
			"phone":"'.$value->phone.'",
			"address": "'.strtolower($value->address).'",
			"distance":"'.$value->distance.'",
			"city":"'.ucfirst(strtolower($value->city)).'",
			"name":"'.strtolower($value->name).'",
			"state":"'.$value->state.'",
			"zip":"'.$value->zip.'"
			},';
		}
		if(!$storeCount) {
			$storeCount = 0;
		}
		echo '{"count":"'.$storeCount.'","pagination":"'.$pagination.'","products":['.substr($products,0,-1).']}';
	} elseif (isset($categories)) {

		$xmlURL = "http://productlocator.infores.com/productlocator/products/products.pli?client_id=58&brand_id=SWGS&group_id=" . $categories;

		$category = '';
		foreach (Product::loadXML($xmlURL) as $key => $value) {
			$category .= '{"name": "'.ucfirst(strtolower($value->name)).'","upc":"'.$value->code.'"},';
		}

		echo '{"category":"'.$categories.'","subcategories":['.substr($category,0,-1).']}';
	}

	exit;
}
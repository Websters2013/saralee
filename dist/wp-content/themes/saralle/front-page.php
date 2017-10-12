<?php
/*
Template Name: Home
*/
get_header();

require_once('product-pl.php');
require_once('store-pl.php');
$args = array(
  'taxonomy' => 'products_cat',
  'parent' => 0,
  'hide_empty' => false,
);
$res = get_terms($args);
$categories = array();

foreach ($res as $row) {
	$categories[] = array($row->slug,$row->name);
}

$catProducts = array();

foreach ($categories as $c) {
	$xmlURL = "http://productlocator.infores.com/productlocator/products/products.pli?client_id=58&brand_id=SWGS&group_id=" . $c[0];
	$catProducts[$c[0]] = Product::loadXML($xmlURL);
}

$locatorOn = false;

if (isset($_POST['upc']) and isset($_POST['zip']) and isset($_POST['miles'])) {
	$locatorOn = true;
	$xmlURL = "http://productlocator.infores.com/productlocator/servlet/ProductLocatorEngine?clientid=58&productfamilyid=SWGS&producttype=upc&storesperpage=10&storespagenum=" . $_POST['page'] . "&productid=" . $_POST['upc'] . "&zip=" . $_POST['zip'] . "&searchradius=" . $_POST['miles'];
	$storeRes = Store::loadXML($xmlURL);
	$stores = $storeRes['stores'];
	$storeCount = $storeRes['count'];
}

$post_id = 2;

$product_title_top = get_field('product_title_top', $post_id);
if($product_title_top) {
	$product_title_top = '<div>'.$product_title_top.'</div>';
}

$product_title_bottom = get_field('product_title_bottom', $post_id);
if($product_title_bottom) {
	$product_title_bottom = '<div><span>'.$product_title_bottom.'</span></div>';
}

$product = get_field('products', $post_id);


$recipes_title_top = get_field('recipes_title_top', $post_id);
if($recipes_title_top) {
	$recipes_title_top = '<div>'.$recipes_title_top.'</div>';
}

$recipes_title_bottom = get_field('recipes_title_bottom', $post_id);
if($recipes_title_bottom) {
	$recipes_title_bottom = '<div><span>'.$recipes_title_bottom.'</span></div>';
}

$recipes = get_field('recipes', $post_id);

$recipes_button_all = get_field('recipes_button_all', $post_id);
if($recipes_button_all['title'] && $recipes_button_all['url']) {
	$recipes_button_all = '<div class="recipes__all"><a href="'.$recipes_button_all['url'].'">'.$recipes_button_all['title'].'</a></div>';
}

?>

    <?php if(!empty($product) && $product_title_top && $product_title_bottom) { ?>
    <!-- products -->
    <div class="products">

        <!-- products__content -->
        <div class="products__content">

            <!-- products__title -->
            <div class="products__title">
               <?= $product_title_top.$product_title_bottom; ?>
            </div>
            <!-- /products__title -->

            <a href="#" class="products__prev">
                <svg viewBox="146 23 12 6"><path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/></svg>
            </a>

            <!-- products__swiper -->
            <div class="products__swiper swiper-container">

                <!-- swiper-wrapper -->
                <div class="swiper-wrapper">

                    <?php $counter = 0; foreach ($product as $row) {  if ($counter > 4) {continue;} ?>
                        <a href="<?= get_permalink($row); ?>" class="products__item swiper-slide">
                            <div class="products__img">
                                <?= get_the_post_thumbnail($row); ?>
                            </div>
                            <p><?= get_the_title($row); ?></p>
                        </a>
                    <?php $counter++; } ?>

                </div>
                <!-- /swiper-wrapper -->

            </div>
            <!-- /products__swiper -->

            <a href="#" class="products__next">
                <svg viewBox="146 23 12 6"><path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/></svg>
            </a>

        </div>
        <!-- /products__content -->

    </div>
    <!-- /products -->
    <?php } ?>

    <!-- playces -->
    <div class="places">

        <!-- places__layout -->
        <div class="places__layout">

            <!-- places__title -->
            <div class="places__title">
                <div><span>WHERE TO BUY</span></div>
                <div>our products</div>
            </div>
            <!-- /products__title -->

            <div id="main">
            <form id="productLocatorForm" name="productLocatorForm" autocomplete="off" method="post" action="">
                <fieldset>
                    <select id="agg" class="custom" name="group" tabindex="1"  onchange="updateProducts()">
                        <option value="0" selected="selected">Select Category</option>
                        <!--<option value="cheesecakes">Cheesecakes</option>-->
						<?php foreach ($categories as $c) { ?>
                          <option value="<?php echo $c[0]; ?>"><?php echo $c[1]; ?></option>
						<?php } ?>
                    </select>
                    <select id="upc" class="custom" name="upc" tabindex="2">
                        <option selected="selected" value="">Select Product</option>
                        <option value="3210003721">SARA LEE FRENCH CLASSIC CHEESECAKE</option>

                    </select>

                    <label for="zip"><span class="hide">zip code</span></label>
                    <input type="text" id="zip" name="zip" class="custom" value="<?php if (isset($_POST['zip'])) { echo $_POST['zip']; } else { ?>Zip Code<?php } ?>" title="Zip Code" size="6" maxlength="10" tabindex="3" />
                    <select class="custom" name="miles" tabindex="4">
                        <option selected="selected" value="5">5 Miles</option>
                        <option value="10">10 Miles</option>
                        <option value="15">15 Miles</option>
                        <option value="50">15+ Miles</option>
                    </select>
                    <button type="submit" name="form-go-btn" class="ready" tabindex="5" onclick="attemptSubmit(); return false;">Find Product</button>
                </fieldset>
                <input type="hidden" name="page" value="1" />
            </form>
            <div class="mapWrap">
			        <?php
			        if ($locatorOn) {
				        if ($storeCount > 0) {
					        $start = (intval($_POST['page']) - 1) * 10 + 1;
					        $end = (intval($_POST['page'])) * 10;
					        if ($end > $storeCount) { $end = $storeCount; }
					        ?>
                    <p>Showing results <?php echo $start; ?> - <?php echo $end; ?> out of <?php echo $storeCount; ?> stores within <?php echo $_POST['miles']; ?> miles of <?php echo $_POST['zip']; ?>.</p>
				        <?php } else { ?>
                    <p>There are no stores that carry that product within <?php echo $_POST['miles']; ?> miles of <?php echo $_POST['zip']; ?>.</p>
				        <?php }
			        } ?>
			        <?php if (isset($stores)) { ?>
                <div id="locatorWrap" >
                    <div id="locatorUI" style="height: 400px"></div><!--end #locatorUI-->
                </div><!--end #locatorWrap-->
                <div id="storeList">
					        <?php foreach ($stores as $s) { ?>
                      <a href="#" class="name-link" onclick="addMarker(map,'<?php echo $s->address . ', ' . $s->city . ', ' . $s->state . ' ' . $s->zip; ?>','<?php echo $s->name; ?><br /><?php echo $s->address; ?><br /><?php echo $s->city; ?>,<?php echo $s->state; ?> <?php echo $s->zip; ?>'); return false;"><?php echo $s->name; ?></a>
                      <span><?php echo $s->address; ?><br /><?php echo $s->city; ?>,<?php echo $s->state; ?> <?php echo $s->zip; ?><br /><?php echo $s->phone; ?></span>
                      <p><a target="_blank" href="http://maps.google.com/maps?q=<?php echo urlencode($s->address . ' ' . $s->city . ', ' . $s->state); ?>">Get Directions</a></p>
					        <?php } ?>
                    <p id="pagination">
							        <?php if ($storeCount > 0) {
							        $pages = ceil($storeCount/10);
							        foreach (range(1,$pages) as $i) {
								        if ($i != intval($_POST['page'])) {
									        ?>
                            <a href="#" onclick="changePage(<?php echo $i; ?>); return false;"><?php echo $i; ?></a>
								        <?php } else {
									        echo $i . ' ';
								        }
							        } ?>
                    </p>
				        <?php }
				        echo '</div>';
				        } ?>
                </div><!--end .mapWrap-->
            </div>
            </div>

        </div>
        <!-- /places__layout -->

    </div>
    <!-- /places -->

    <?php if(!empty($recipes) && $recipes_title_top && $recipes_title_bottom) { ?>
    <!-- recipes -->
    <div class="recipes">

        <!-- recipes__title -->
        <div class="recipes__title">
            <?= $recipes_title_top.$recipes_title_bottom; ?>

        </div>
        <!-- /recipes__title -->

        <div class="recipes__row">

	        <?php $counter = 0; foreach ($recipes as $row) { if ($counter > 4) {continue;} ?>
            <div class="recipes__item">
	            <?= get_the_post_thumbnail($row); ?>
                <div class="recipes__content">
                    <h3><?= get_the_title($row); ?></h3>
                    <p><?= get_the_excerpt($row); ?></p>
                    <a href="<?= get_permalink($row); ?>" class="btn btn_2">View Recipe</a>
                </div>
            </div>
            <?php $counter++;} ?>

        </div>

        <?= $recipes_button_all; ?>

    </div>
    <!-- /recipes -->
    <?php } ?>


    <?php get_template_part( '/contents/content', 'history'); ?>

    <script type="text/javascript">
        var catProducts = [];
				<?php
				foreach ($catProducts as $k => $v) {
					$strComponents = array();
					foreach ($v as $prod) {
						$strComponents[] = "['{$prod->code}','{$prod->name}']";
					}
					$str = implode(',',$strComponents);
					echo "catProducts['{$k}'] = [{$str}];\n";
				}
				?>
        var map;
        var markersArray = [];
        var windowArray = [];



        function addMarker(map,address,description) {
            gcc = new google.maps.Geocoder();
            gcc.geocode({address:address},function(results,status){
                if (status == google.maps.GeocoderStatus.OK) {
                    clearMarkers();
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: description
                    });
                    markersArray.push(marker);
                    var infoWindow = new google.maps.InfoWindow({content: description});
                    infoWindow.open(map,marker);
                    windowArray.push(infoWindow);
                }
            });
        }

        function attemptSubmit() {
            form = document.forms['productLocatorForm'];
            if (form.elements['group'].value == '' || form.elements['upc'].value == '' || form.elements['zip'].value == '' || form.elements['zip'].value == 'Zip Code') {
                return false;
            }
            else {
                form.submit();
            }
        }

        function changePage(page) {
            document.forms['productLocatorForm'].elements['page'].value = page;
            document.forms['productLocatorForm'].submit();
        }

        function clearMarkers() {
            if (markersArray) {
                for (i in markersArray) {
                    markersArray[i].setMap(null);
                }
            }
            if (windowArray) {
                for (i in windowArray) {
                    windowArray[i].close();
                }
            }
        }

        function initialize() {
			<?php if ($locatorOn) { ?>
            var options = {
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("locatorUI"),options);
				<?php
                if ($storeCount > 0)  {
                $s = $stores[0];
                ?>
            addMarker(map,'<?php echo $s->address . ', ' . $s->city . ', ' . $s->state . ' ' . $s->zip; ?>','<?php echo $s->name; ?><br /><?php echo $s->address; ?><br /><?php echo $s->city; ?>,<?php echo $s->state; ?> <?php echo $s->zip; ?>');
				<?php } else { ?>
            setPositionByAddress('<?php echo $_POST['zip']; ?>');
				<?php } ?>
            document.forms['productLocatorForm'].elements['group'].value = "<?php echo $_POST['group']; ?>";
            updateProducts();
            document.forms['productLocatorForm'].elements['upc'].value = "<?php echo $_POST['upc']; ?>";
            document.forms['productLocatorForm'].elements['miles'].value = "<?php echo $_POST['miles']; ?>";
			<?php } ?>

        }

        function setPositionByAddress(address) {
            gcc = new google.maps.Geocoder();
            gcc.geocode({address:address},function(results,status){
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                }
            });
        }

        function updateProducts() {
            var curCat = document.forms['productLocatorForm'].elements['group'].value;
            var select = document.getElementById('upc');
            select.options.length = 0;
            select.options[0] = new Option("Select Product","",false,true);
            count = 1;
            if (catProducts[curCat]) {
                for (i in catProducts[curCat]) {
                    select.options[count] = new Option(catProducts[curCat][i][1],catProducts[curCat][i][0],false,false);
                    count++;
                }
            }
        }
        $(window).load(initialize());

				<?php
				if (isset($_GET['upc']) and isset($_GET['cat']) and ($upc = $_GET['upc']) and ($pCat = $_GET['cat'])) {
				$cats = array('5' => 'pound-cakes', '17' => 'cheesecakes', '39' => 'cakes', '62' => 'sweet-breakfast', '72' => 'pies', '134' => 'specialties');
				if (isset($cats[$pCat])) {
				$pCatN = $cats[$pCat];
				?>
        document.forms['productLocatorForm'].elements['group'].value = '<?php echo $pCatN; ?>';
        updateProducts();
        document.forms['productLocatorForm'].elements['upc'].value = '<?php echo $upc; ?>';
				<?php
				}
				}
				?>
    </script>
<?php
get_footer();
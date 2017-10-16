<?php
$home_id = 2;
$contact_id = 30;

$logo = get_field('logo', $home_id);
if($logo) {
	$logo = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" title="'.$logo['title'].'">';
	if(is_front_page()) {
		$logo = '<h1 class="logo">'.$logo.'</h1>';
	} else {
		$logo = '<a href="'.get_home_url().'" class="logo">'.$logo.'</a>';
	}
}

$current_id = get_the_ID();

if(is_singular('tips') || is_page(165)){
$current_id = 165;
}
if(is_singular('faq') || is_page(177)){
$current_id = 177;
}
if(is_tax('products_cat')){
$current_id = 19;
}
$hero_title = get_field('hero_title', $current_id);
$hero_button = get_field('hero_button', $current_id);
$hero_image = get_field('hero_image', $current_id)['url'];
$hero_nav = get_field('hero_nav', $current_id);

if(is_singular('recipes')) {
$hero_title = get_field('hero_title_2', 13);
$hero_image = get_field('hero_image_2', 13)['url'];
}

if($hero_title) {
    if(is_front_page()) {
        $hero_title = '<div class="hero__title">'.$hero_title.'</div>';
    } elseif(is_singular('tips') || is_page(165) ||  is_page(13)) {
        $hero_title = '<h1 class="hero__title">'.$hero_title.'</h1>';
    } else {
        $hero_title = '<h1>'.$hero_title.'</h1>';
    }
}


if($hero_button) {
	$hero_button = '<a href="'.$hero_button['url'].'" class="btn btn_1">'.$hero_button['title'].'</a>';
}

$hero_nav_string = '';
if($hero_nav) {
    $hero_nav_string = '<nav class="hero__nav">';
    if(acf_is_array($hero_nav)) {
        foreach ($hero_nav as $row) {
            $hero_nav_string .= '<a href="'.get_permalink($row).'">'.get_the_title($row).'</a>';
        }
    } else {
         $hero_nav_string .= '<a href="'.get_permalink($hero_nav).'">'.get_the_title($hero_nav).'</a>';
    }
    $hero_nav_string .= '</nav>';

}
$hero_class = '';

if(is_front_page()) {
    $hero_class = '';
} elseif ( is_singular('tips') || is_page(165) || is_page(13)) {
    $hero_class = ' hero_centering';
} else {
    $hero_class = ' hero_min';
}

$show_categories_in_menu = get_field('show_categories_in_menu', $home_id);
$show_categories_in_menu_string = '';
if(!empty($show_categories_in_menu)) {
	$show_categories_in_menu_string .= '<div class="menu__subcategory"><ul>';
	foreach ($show_categories_in_menu as $row) {
	    if(!$row['category']) {continue;}
	    $image = get_field('image', 'products_cat_' . $row['category']->term_id);
	    $show_categories_in_menu_string .= '<li><a href="'.get_term_link($row['category']->term_id).'" class="menu__item">
                                                    <div class="menu__item-img">
                                                        <img src="'.$image['sizes']['thumbnail'].'" alt="'.$image['title'].'">
                                                    </div>
                                                    <p>'.$row['category']->name.'</p>
                                                </a>
                                            </li>';
	}
	$show_categories_in_menu_string .= '</ul></div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">

    <title>Title</title>

    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 10;
            background: rgba(255,255,255,1);
        }
        .preloader_loaded > div{
            opacity: 0;
        }
        .preloader__points {
            overflow: hidden;
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
            text-align: center;
        }
        .preloader__points span {
            display: inline-block;
            vertical-align: top;
            height: 10px;
            margin: 60px auto;
            width: 10px;
            background: #e30a27;
            border-radius: 10px;
            -webkit-animation: loading 1s infinite alternate 0s;
            animation: loading 1s infinite alternate 0s;
        }
        .preloader__points span:nth-of-type(1) {
            -webkit-animation-delay: 0s;
        }
        .preloader__points span:nth-of-type(2) {
            -webkit-animation-delay: 0.2s;
            background: #c40923;
        }
        .preloader__points span:nth-of-type(3) {
            -webkit-animation-delay: 0.4s;
            background: #a60922;
        }
        .preloader__points span:nth-of-type(4) {
            -webkit-animation-delay: 0.6s;
            background: #8c091f;
        }
        .preloader__points span:nth-of-type(5) {
            -webkit-animation-delay: 0.8s;
            background: #610717;
        }
        @-webkit-keyframes loading {
            0% {
                -webkit-transform: translateY(0);
                height: 10px;
                width: 10px;
            }
            100% {
                -webkit-transform: translateY(-20px);
                height: 20px;
                width: 20px;
            }
        }
        @keyframes loading {
            0% {
                transform: translateY(0);
                height: 10px;
                width: 10px;
            }
            100% {
                transform: translateY(-20px);
                height: 20px;
                width: 20px;
            }
        }
    </style>

	<?php wp_head(); ?>

</head>
<body data-action="<?php echo admin_url( 'admin-ajax.php' );?>" <?= 'class="' . join( ' ', get_body_class( $class ) ) . '"' ?> data-type="<?php if(is_singular('tips') || is_page_template('page-tips.php')) { echo 'tips'; } elseif (is_singular('faq') || is_page_template('page-faq.php')) { echo 'faq'; } ?>">

<!-- site -->
<div class="site">

    <!-- preloader -->
    <div class="preloader">
        <div class='preloader__points'>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- /preloader -->

    <!-- site__header -->
    <header class="site__header">

        <!-- site__header-layout -->
        <div class="site__header-layout">

            <!-- logo -->
			<?= $logo; ?>
            <!-- /logo -->

            <!-- mobile-menu -->
            <div class="mobile-menu">
                <div>
	            <?php
	            $menu_name = 'menu';
	            $locations = get_nav_menu_locations();
	            if( $locations && isset($locations[ $menu_name ]) ){
		            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		            $menu_items = wp_get_nav_menu_items( $menu );
		            ?>
                    <!-- menu -->
                    <nav class="menu">
                    <ul>
	                  <?php foreach ( (array) $menu_items as $key => $menu_item ){
	                      //var_dump($menu_item);
		                  $perm = get_the_permalink($menu_item->object_id);
		                  $active = '';
		                  if (is_page( $menu_item->object_id )) {
			                  $active = ' active ';
		                  }
		                  echo '<li><a href="'.$perm.'" class="menu__item'.$active.'">'.$menu_item->title.'</a>';
		                  if($show_categories_in_menu_string && ($menu_item->object_id === '19')) {
		                      echo $show_categories_in_menu_string;
		                  }
		                  echo '</li>';
	                  }
	                  ?>
	                  </ul>
                    </nav>
                    <!-- /menu -->
			      <?php }

		          $social_links = get_field('social_links', $contact_id);
		          if(!empty($social_links)) {?>
                  <!-- social -->
                  <div class="social">
	                  <?php
	                  foreach ( $social_links as $row ) {
		                  if(is_array($row['show_in'])) {
			                  if(!in_array('0', $row['show_in']) || empty($row['image'])) {
				                  continue;
			                  }
		                  }else {
			                  if($row['show_in'] !== '0' || empty($row['image'])) {
				                  continue;
			                  }
		                  }
		                  echo '<a class="social__item social__item-'.strtolower ($row['social_name']).'" href="'.$row['url'].'" target="_blank">'.file_get_contents($row['image']['url']).'</a>';
	                  }
	                  ?>
                  </div>
                  <!-- /social -->
								<?php } ?>


                <!-- search -->
                <div class="search">

                     <form class="search__form" action="<?= get_permalink(259); ?>" method="post">
                        <input type="input" placeholder="Search" name="search"/>
                        <button type="submit"></button>
                     </form>

                    <a href="#" class="search__open-btn">
                        <svg viewBox="47.5 15.5 14 14">
                            <path d="M9-10.214a3.5,3.5,0,0,1-3.5,3.5,3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5A3.5,3.5,0,0,1,9-10.214Zm4,6.5a1.006,1.006,0,0,0-.289-.7L10.031-7.1A5.487,5.487,0,0,0,11-10.214a5.5,5.5,0,0,0-5.5-5.5,5.5,5.5,0,0,0-5.5,5.5,5.5,5.5,0,0,0,5.5,5.5,5.487,5.487,0,0,0,3.117-.969L11.3-3.011a.98.98,0,0,0,.7.3A1.007,1.007,0,0,0,13-3.714Z" transform="translate(48 31.714)"/>
                        </svg>
                     </a>

                </div>
                <!-- /search -->
                </div>

            </div>
            <!-- /mobile-menu -->

            <!-- menu-btn -->
            <div class="mobile-menu-btn">
                <span></span>
            </div>
            <!-- /menu-btn -->

        </div>
        <!-- /site__header-layout -->

    </header>
    <!-- /site__header -->

    <?php if(!is_page_template('page-products.php') && $hero_image){ ?>
    <!-- hero -->
    <div class="hero <?= $hero_class; ?>" style="background-image: url(<?= $hero_image; ?>)">

        <?php
            if(is_front_page() || is_singular('tips') || is_page(165) || is_page(13)) { ?>
        <!-- hero_content -->
        <div class="hero__content">
            <?= $hero_title; ?>
	        <?= $hero_button; ?>
        </div>
        <!-- /hero_content -->
        <?php } else { echo $hero_title; } ?>

        <?= $hero_nav_string; ?>

        <?php if(is_singular('recipes')) { ?>
            <!-- hero__nav -->
            <nav class="hero__nav">
                <a href="<?= get_site_url(); ?>"><?= get_the_title(2); ?></a>
                <a href="<?= get_permalink(13); ?>"><?= get_the_title(13); ?></a>
                <a href="<?= get_permalink($current_id); ?>"><?= get_the_title($current_id); ?></a>
            </nav>
            <!-- /hero__nav -->

            <a href="<?= get_permalink(13); ?>" class="hero__back"><span>Find Recipes</span></a>
        <?php } ?>

    </div>
    <!-- /hero -->
    <?php } else {
        $hero_slider = get_field('hero_slider', $current_id);
        if(!empty($hero_slider)) { ?>
        <!-- hero -->
        <div class="hero-slider">

            <div class="swiper-container">
                <div class="swiper-wrapper">

                <?php foreach ($hero_slider as $row) { ?>
                    <div class="swiper-slide">
                        <div class="hero" style="background-image: url(<?= $row['image']['url']; ?>)">
                            <!-- hero_content -->
                            <div class="hero__content">
                                <div class="hero__title">
                                    <?= $row['title']; ?>
                                </div>
                            </div>
                            <!-- /hero_content -->
                        </div>
                    </div>
                <?php } ?>

                </div>
                <!-- Add Pagination -->
                <?php if(!is_front_page() && !is_page(13)) { ?>
                <div class="swiper-pagination"></div>
                <?php } ?>
            </div>
        </div>
        <!-- /hero -->
        <?php }} ?>
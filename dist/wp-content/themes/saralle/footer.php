<?php
$home_id = 2;

$logo = get_field('logo', $home_id);
if($logo) {
	$logo = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" title="'.$logo['title'].'">';
	if(is_front_page()) {
		$logo = '<div class="logo">'.$logo.'</div>';
	} else {
		$logo = '<a href="'.get_home_url().'" class="logo">'.$logo.'</a>';
	}
}
$contact_id = 30;


$footer_links = get_field('footer_links', $contact_id);
?><!-- site__footer -->
<div class="site__footer">

    <?= $logo; ?>

    <!-- site__footer-layout -->
    <div class="site__footer-layout">

        <!-- footer__navigation -->
        <div class="footer__navigation">
            <?php if(!empty($footer_links)){ ?>
            <ul>
                <?php foreach ($footer_links as $row) { ?>
                    <li><a href="<?= $row['link']['url']; ?>" target="<?= $row['link']['target']; ?>"><?= $row['link']['title']; ?></a></li>
                <?php } ?>
            </ul>
            <?php } ?>

            <div><?= get_field('copyright', $contact_id); ?></div>

	        <?php
	        $menu_name = 'menu_footer';
	        $locations = get_nav_menu_locations();
	        if( $locations && isset($locations[ $menu_name ]) ){
		        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		        $menu_items = wp_get_nav_menu_items( $menu );
		        ?>
            <ul>
				        <?php foreach ( (array) $menu_items as $key => $menu_item ){
					        $perm = get_the_permalink($menu_item->object_id);
					        $active = '';
					        if (is_page( $menu_item->object_id )) {
						        $active = 'active';
					        }
					        echo '<li><a href="'.$perm.'" class="'.$active.'">'.$menu_item->title.'</a></li>';
				        }
				        ?>
            </ul>
		        <?php
	        }
	        ?>

        </div>
        <!-- /footer__navigation -->

        <!-- sign-up -->
        <div class="sign-up">
            <p><?= get_field('form_title', $contact_id); ?></p>
            <?= do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
        </div>
        <!-- /sign-up -->
        <?php
      $social_links = get_field('social_links', $contact_id);
      if(!empty($social_links)) {
	      ?>
          <div class="social social_footer">
              <p>Connect with us on social media</p>
			      <?php
			      foreach ( $social_links as $row ) {
				      if(is_array($row['show_in'])) {
					      if(!in_array('1', $row['show_in']) || empty($row['image'])) {
						      continue;
					      }
				      }else {
					      if($row['show_in'] !== '1' || empty($row['image'])) {
						      continue;
					      }
				      }
				      echo '<a class="social__item social__item-'.strtolower ($row['social_name']).'" href="'.$row['url'].'" target="_blank">'.file_get_contents($row['image']['url']).'</a>';
			      }
			      ?>
          </div>
          <!-- /social -->
	      <?php
      }
      ?>
    </div>
    <!-- /site__footer-layout -->

</div>
<!-- /site__footer -->

</div>
<!-- /site -->

<?php wp_footer(); ?>


</body>
</html>
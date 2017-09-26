<?php
/*
Template Name: Contact
*/
get_header();

$current_id = get_the_ID();

$template = get_field('template_sidebar', $current_id);
$template_sidebar = '';
if(!empty($template)) {
    foreach ($template as $row) {
	    switch ($row['show_template']) {
          case '0':
	          $template_sidebar .= '<dl>
					<dt>'.$row['title'].'</dt>
					<dd><a href="'.$row['link']['url'].'">'.$row['link']['title'].'</a></dd>
				</dl>';
              break;
          case '1':
            $address = $row['address'];
            if(empty($address)) {
              continue;
            } else {
              foreach ($address as $row_2) {
                $address_string .= '<span>'.$row_2['item'].'</span>';
              }
            }
            $template_sidebar .= '<dl>
				<dt>'.$row['title'].'</dt>
				<dd><address>'.$address_string.'</address></dd>
			</dl>';
            break;
          case '2':
	          $social_links = get_field('social_links', 30);
	          $social_link = '';
	          if(empty($social_links)) {
	              continue;
              } else {
			          foreach ( $social_links as $row_2 ) {
				          if(is_array($row_2['show_in'])) {
					          if(!in_array('2', $row_2['show_in']) || empty($row_2['image'])) {
						          continue;
					          }
				          }else {
					          if($row_2['show_in'] !== '2' || empty($row_2['image'])) {
						          continue;
					          }
				          }
				          $social_link .= '<a class="social__item social__item-'.strtolower ($row_2['social_name']).'" href="'.$row_2['url'].'" target="_blank">'.file_get_contents($row_2['image']['url']).'</a>';
			          }
              }
            $template_sidebar .= '<dl>
					<dt>'.$row['title'].'</dt>
					<dd>
						<!-- social -->
						<div class="social">
							'.$social_link.'
						</div>
						<!-- /social -->
					</dd>
				</dl>';
			break;
        }
    }
}
?>
	<!-- contact-us -->
	<div class="contact-us">

		<!-- main-title -->
		<h2 class="main-title">
			<?= get_field('title', $current_id); ?>
		</h2>
		<!-- main-title -->

		<!-- contact-us__wrap -->
		<div class="contact-us__wrap">

			<!-- contact-us__form -->
			<div class="contact-us__form">

				<?= get_field('content', $current_id); ?>

				<?= do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]');?>
			</div>
			<!-- /contact-us__form -->

			<!-- contact-us__aside -->
			<aside class="contact-us__aside">
				<?= $template_sidebar; ?>
			</aside>
			<!-- /contact-us__aside -->

		</div>
		<!-- /contact-us__wrap -->

	</div>
	<!-- /contact-us -->
<?php
get_footer();